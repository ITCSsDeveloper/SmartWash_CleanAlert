<?php
if(isset($_POST["changeMultiplierPoint"]))
{
	session_start();
	include("../checkToken.php");
	checkToken($_POST["_token"]);

	$password = @$_POST["password"];
	$multiplierPoint = @$_POST["multiplierPoint"];

	if($password == "" || $multiplierPoint == "")
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "พบค่าว่าง";
		header("Location: ../view/index.php?promotion");
		exit();
	}

	include("dbms.php");
	$obj = new dbms();

	$password = md5($password . 'F^%G7wbJ+%n+dfBF');
	$email = $_SESSION["z77-email"];

	$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_email` = '$email' AND `mem_password` = '$password'";
	if($obj->dbms_select($sql_comm))
	{
		$sql_comm = "UPDATE `promotion_tb` SET `value` = '$multiplierPoint' WHERE `promotion_tb`.`id` = 1;";
		if($obj->dbms_update($sql_comm))
		{
			$_SESSION["notify_type"] = "success";
			$_SESSION["notify_string"] = "แก้ไขตัวคูณสำเร็จ";
			header("Location: ../view/index.php?promotion");
			exit();
		}
		else
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = "ไม่สามารถ แก้ไขตัวคูณได้";
			header("Location: ../view/index.php?promotion");
			exit();
		}
	}
	else
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "รหัสผ่าน Admin ไม่ถูกต้อง";
		header("Location: ../view/index.php?promotion");
		exit();
	}
}
?>