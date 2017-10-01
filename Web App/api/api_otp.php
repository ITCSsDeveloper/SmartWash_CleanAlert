<?php
session_start();

if(isset($_GET["getotp"]))
{
	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		exit();
	}

	include("../controller/dbms.php");
	$obj = new dbms();
	
	$otp_code = rand(100000,999999);
	$otp_member_id =  $_SESSION['z77-id'];
	date_default_timezone_set('Asia/Bangkok');
	$current_time = time();
	$otp_time_expired = time() + 30;

	$sql_comm = "SELECT * FROM `otp_tb` WHERE `otp_member_id` = '$otp_member_id' AND `otp_use` = '0' AND `otp_time_expired` > '$current_time'  ORDER BY `otp_id` DESC LIMIT 1";
	$result = $obj->dbms_select($sql_comm);
	if($result)
	{
		$otp_code = $result[0]->otp_code;
		$otp_exp = $result[0]->otp_time_expired_text;
		header("Location: ../view/index.php?smart_pay&otp=$otp_code&otp_exp=$otp_exp");
		exit();
	}

	while ($obj->dbms_select("SELECT * FROM `otp_tb` WHERE `otp_code` = $otp_code")) 
	{
		$otp_code = rand(100000,999999);
	}

	$otp_exp_text = date('d-m-Y_H:i:s',$otp_time_expired );
	$sql_comm = "INSERT INTO  `otp_tb` (`otp_id`, `otp_code`, `otp_member_id`, `otp_wash_id`, `otp_time_create`, `otp_time_expired`, `otp_time_expired_text`, `otp_use`) 
	VALUES (NULL, '$otp_code', '$otp_member_id', '', CURRENT_TIME(), '$otp_time_expired', '$otp_exp_text', '0');";
	if($obj->dbms_insert($sql_comm))
	{
		header("Location: ../view/index.php?smart_pay&otp=$otp_code&otp_exp=$otp_exp_text");
		exit();
	}
	else
	{
		header("Location: ../view/index.php?smart_pay&otp=Error");
		exit();
	}
}
else
{
	echo "<center> <h1>Request Invalid... <br>";
			echo "<button onclick='goBack()' style='height: 56px; width: 116px;'>Go Back</button> ";
			echo '
			<script>
			function goBack() {
			    window.history.back();
			}
			</script>';
			exit();
}
?>