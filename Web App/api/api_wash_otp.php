<?php
echo "<pre>"; 
if(isset($_POST["ajax_check_post"])) { var_export($_POST); exit(); }

if(isset($_POST["OTP_CODE"]))
{
	$current_time = time();
	$OTP_CODE = $_POST["OTP_CODE"];
	$WASH_ID = @$_POST["WASH_ID"];
	if($WASH_ID == "") {  $WASH_ID = "N/A"; }

	include("../controller/dbms.php");
	$obj = new dbms();

	$sql_comm = "SELECT * FROM `otp_tb` WHERE `otp_code` = '$OTP_CODE' AND otp_use = 0 AND otp_time_expired > $current_time ORDER BY `otp_id` DESC LIMIT 1";
	$result = $obj->dbms_select($sql_comm);
	if($result)
	{
		$otp_id = $result[0]->otp_id;
		$mem_id = $result[0]->otp_member_id;

		$sql_comm = "UPDATE  `otp_tb` SET `otp_wash_id` = '$WASH_ID', `otp_use` = '1' WHERE `otp_tb`.`otp_id` = $otp_id;";
		if($obj->dbms_update($sql_comm))
		{	
			$sql_comm = "UPDATE  `member_tb` SET `mem_notifycation` = '[START][NOTIFY][TICKER]Welcome to CleanAlert[TITLE]ยินดีต้อนรับสู่ CleanAlert[TEXT]คุณได้ล็อกอินเข้าสู่ระบบผ่าน OTP[END]' WHERE `member_tb`.`mem_id` = $mem_id";
			$obj->dbms_update($sql_comm);
			
			echo "YES";
		}
		else
		{
			echo "ERROR";
		}
	}
	else 
	{
		echo "NO"; // ใช้ไปแล้ว หรือ หมดอายุ
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