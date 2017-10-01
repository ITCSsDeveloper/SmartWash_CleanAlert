<?php 
session_start();


if(isset($_POST['register_member']))
{
	session_unset();

	$email = $_POST['r_emailTxt'];
	$name = $_POST['r_nameTxt'];
	$phone = $_POST['r_phoneTxt'];
	$coin = 0;
	$username = $_POST['r_emailTxt'];
	$password = $_POST['r_passwordTxt'];
	$re_password = $_POST['r_rpasswordTxt'];

	//Check Phone is Number
	if(is_numeric($phone) == false)
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i>
		<b>พบข้อผิดพลาด !</b><br>หมายเลขโทรศัพท์ไม่ถูกต้อง<br>หมายเลขโทรศัพท์ต้องเป็นตัวเลขเท่านั้น';
		header("Location: ../index.php");
		exit();
	}
	// Check password not match
	if($password != $re_password)
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i>
		<b>พบข้อผิดพลาด !</b><br>Password ไม่ตรงกัน';
		header("Location: ../index.php");
		exit();
	}

	include('dbms.php');
	$obj = new dbms();

	// Check email unique
	if($obj->dbms_select("SELECT * FROM `member_tb` WHERE `mem_email` = '$email'"))
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i>
		<b>พบข้อผิดพลาด !</b><br>Email ถูกใช้งานแล้ว';
		header("Location: ../index.php");

		exit();
	}
	else 
	{
		$code = rand(100000,999999);
		while ($obj->dbms_select("SELECT * FROM `member_tb` WHERE `mem_id` = $code")) 
		{
			$code = rand(100000,999999);
		}
		
		$encrypt_password = md5($password . 'F^%G7wbJ+%n+dfBF');
		$sql_comm = 
		"INSERT INTO  `member_tb` (`mem_id`, `mem_name`, `mem_email`, `mem_date_reg`, `mem_phone`, `mem_coin`, `mem_password`) 
		VALUES ('$code', '$name', '$email', CURRENT_TIMESTAMP, '$phone', '$coin', '$encrypt_password');"; 

		if($obj->dbms_insert($sql_comm))
		{
			$_SESSION["notify_type"] = "success";
			$_SESSION["notify_string"] = '<i class="ace-icon fa fa-check"></i>
			<b>ขอแสดงความยินดี !</b><br>การสมัครสมาชิกของคุณสำเร็จแล้ว';
			header("Location: ../index.php");
			exit();
		}
		else 
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i>
			<b>พบข้อผิดพลาด !</b><br>หมายเลขโทรศัพท์ไม่ถูกต้อง<br>	หมายเลขโทรศัพท์ต้องเป็นตัวเลขเท่านั้น';
			header("Location: ../index.php");
			exit();
		}
	}
}
?>