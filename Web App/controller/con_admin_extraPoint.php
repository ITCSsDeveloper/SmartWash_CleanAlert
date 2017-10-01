<?php 
if(isset($_POST["changeExtraPoint"]))
{
	session_start();
	include("../checkToken.php");
	checkToken($_POST["_token"]);

	$extra1 = @$_POST["extra1"];
	$extra2 = @$_POST["extra2"];
	$password = @$_POST["password"];

	if($extra1 == "" || $extra2 == "" || $password == "")
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "พบค่าว่าง";
		header("Location: ../view/index.php?promotion");
		exit();
	}

	$password = md5($password . 'F^%G7wbJ+%n+dfBF');
	$email = $_SESSION["z77-email"];

	include("dbms.php");
	$obj = new dbms();

	$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_email` = '$email' AND `mem_password` = '$password'";
	if($obj->dbms_select($sql_comm))
	{
		$sql_comm1 = "UPDATE `promotion_tb` SET `value` = '$extra1' WHERE `promotion_tb`.`id` = 2;";
		$sql_comm2 = "UPDATE `promotion_tb` SET `value` = '$extra2' WHERE `promotion_tb`.`id` = 3;";
		if($obj->dbms_update($sql_comm1) && $obj->dbms_update($sql_comm2))
		{
			$_SESSION["notify_type"] = "success";
			$_SESSION["notify_string"] = "ปรับค่าสำเร็จ";
			header("Location: ../view/index.php?promotion");
			exit();
		}
		else 
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = "ไม่สามารถปรับค่าได้";
			header("Location: ../view/index.php?promotion");
			exit();
		}
	}
	else
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "รหัสผ่านไม่ถูกต้อง";
		header("Location: ../view/index.php?promotion");
		exit();
	}
}
?>