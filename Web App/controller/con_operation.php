<?php	
// Operation 
function Operation($id,$wash_id = "ไม่มี",$statement,$value,$type,$obj)
{
	$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_id` = '$id' ORDER BY `mem_notifycation` LIMIT 1";
	$memberData = $obj->dbms_select($sql_comm);

	if(!$memberData) { echo "No Member Data"; exit(); }

	$coin_before = $memberData[0]->mem_coin;  // เงินในระบบก่อนดำเนินการ
	$coin_use    = $value; 					  // เงินที่ดำเนินการ

	if($type == "-") { $coin_after = ($coin_before - $coin_use); $type = "ลด"; }
	if($type == "+") { $coin_after = ($coin_before + $coin_use); $type = "เพิ่ม";}

	$sql_comm = "INSERT INTO  `log_member_tb` 
	(`log_id`, `log_mem_id`, `log_wash_id`, `log_statement`, `log_coin_before`, `log_coin_use`, `log_coin_after`, `log_date_time`, `log_type`)
	VALUES ('', '$id', '$wash_id', '$statement', '$coin_before', '$coin_use', '$coin_after', CURRENT_TIMESTAMP, '$type');";
	$obj->dbms_insert($sql_comm);

	$sql_comm = "UPDATE  `member_tb` SET `mem_coin` = '$coin_after' WHERE `member_tb`.`mem_id` = $id";
	if($obj->dbms_update($sql_comm))
	{
		$sql_comm = "UPDATE  `member_tb` SET `mem_notifycation` = '[START][NOTIFY][TICKER]Clean Alert แจ้งเตือน[TITLE]$statement $coin_use บาท [TEXT]ยอดเงินคงเหลือ : $coin_after บาท[END]' WHERE `member_tb`.`mem_id` = $id";
		$obj->dbms_update($sql_comm);

		$sql_comm = "INSERT INTO  `log_notifycation_tb` (`notify_id`, `notify_type`, `notify_text`, `notify_datetime`, `notify_member_id`, `notify_read`)
		VALUES (NULL, 'process', '$statement $coin_use บาท', CURRENT_TIME(), '$id', '0');";
		$obj->dbms_insert($sql_comm);

		return true;
	}
	else
	{
		return false;
	}
}

function OperationGetIP()
{
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
		$ip = $forward;
	}
	else
	{
		$ip = $remote;
	}

	return $ip;
}

?>