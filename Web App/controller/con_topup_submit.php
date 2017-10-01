<?php
session_start();
include("con_operation.php");


if(isset($_POST['topup_submit']))
{
	$code = $_POST['code_topup'];

	if($code == '') // reject value null
	{ 
		$_SESSION['zz-topup-error']= 'ไม่พบรหัสเติมเงิน';
		$obj->dbms_header('../view/index.php?topup');
	} 

	include("dbms.php");
	$obj = new dbms();
	
	$sql_comm = "SELECT * FROM `topup_tb` WHERE `top_code` = '$code' AND `top_useby_mem_id` is NULL AND `top_delete` = 'No' ORDER BY `top_id` DESC LIMIT 1";
	$result = $obj->dbms_select($sql_comm); // find code in db 

	if(!$result) // if code == null -> reject
	{ 
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>รหัสนี้ไม่มีอยู่ในระบบ หรือ ถูกใช้ไปแล้ว</b>';
		$obj->dbms_header('../view/index.php?topup');
	} 

	
	$top_id = $result[0]->top_id;
	$mem_id = $_SESSION['z77-id'];
	$coin = $result[0]->top_value;

	$sql_comm = "UPDATE  `topup_tb` SET `top_useby_mem_id` = '$mem_id' WHERE `topup_tb`.`top_id` = $top_id;";

	if($obj->dbms_update($sql_comm))
	{	
		$Operation = Operation($mem_id,"","เติมเงินจากบัตร",$coin,"+",$obj);
		if($Operation)
		{
			$_SESSION["notify_type"] = "success";
			$_SESSION["notify_string"] = '<strong><i class="ace-icon fa fa-check"></i> ขอแสดงความยืนดี</strong> <br>
			<b>	คุณเติมเงิน :</b>'.$coin.'฿<br>
			<b>	เมื่อ : </b>'. date("Y-m-d H:i:s") .'<br>
			<b></b>		<p id="coin_ordercard"> 0฿ </p> ';
			header("Location: ../view/index.php?topup");
		}
		else 
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>ไม่สามารถเติมเงินได้ โปรดติดต่อผู้ดูแล</b>';
			$obj->dbms_header('../view/index.php?topup');
		}
	}
	else 
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>ไม่สามารถเติมเงินได้ โปรดติดต่อผู้ดูแล</b>';
		$obj->dbms_header('../view/index.php?topup');
	}
}