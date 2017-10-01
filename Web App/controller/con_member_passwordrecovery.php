<?php 
@session_start();

if(isset($_POST['password_recovery']))
{
	$email = $_POST['emailTxt'];
	include('dbms.php');
	$obj = new dbms();

	// Check email Available
	if($obj->dbms_select("SELECT * FROM `member_tb` WHERE `mem_email` = '$email'"))
	{
		session_unset();
		$_SESSION["notify_type"] = "success";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-check"></i>	<b>แจ้งเตือน!</b>
		<br>เราได้ทำการส่งตัวช่วยเหลือการกู้รหัสผ่านไปยัง Email ของท่านแล้ว  <br> ตรวจสอบ Email เพื่อดำเนินการขั้นตอนถัดไป';

		if(isset($_POST['forgot_mobile']))
			{ header("Location: ../view/forgot_mobile.php"); }
		else 
			{ header("Location: ../index.php"); }

		exit();
	}
	else 
	{
		session_unset();
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i>   <b>พบข้อผิดพลาด !</b>
		<br>ไม่มี Email นี้ในระบบ';

		if(isset($_POST['forgot_mobile']))
			{ header("Location: ../view/forgot_mobile.php"); }
		else 
			{ header("Location: ../index.php"); }
		return;
	}
}
?>