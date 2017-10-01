<?php 
session_start();

if(isset($_POST['do_login']))
{
	$email = $_POST['emailTxt'];
	$password = $_POST['passwordTxt'];
	$check_awalk = @$_POST['check_awalk'];
	$password = md5($password . 'F^%G7wbJ+%n+dfBF');

	include('dbms.php');
	$obj = new dbms();
	
	$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_email` = '$email' AND `mem_password` = '$password'";
	$result = $obj->dbms_select($sql_comm);

	if($result)
	{
		if(@$result[0]->mem_command_admin == "banUser")
		{
			session_unset();
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = "Username นี้ถูก Ban จากระบบ <br> สอบถามเพิ่มเติมโทร 09-xxxxxxx";
			header("Location: ../index.php");
			exit();
		}

		session_unset();
		$_SESSION['z77'] = 'F^%G7wbJ+%n+dfBF';
		$_SESSION['z77-id'] = $result[0]->mem_id;
		$_SESSION['z77-name'] = $result[0]->mem_name;
		$_SESSION['z77-coin'] = $result[0]->mem_coin;
		$_SESSION['z77-point'] = $result[0]->mem_point;
		$_SESSION['z77-phone'] = $result[0]->mem_phone;
		$_SESSION['z77-email'] = $result[0]->mem_email;
		$_SESSION['z77-level'] = $result[0]->mem_level;

		$token = md5($_SESSION['z77-id'] + 7);
		$token = md5($token . "7");
		$token = hash('sha256', $token);
		$_SESSION['z77-token'] = $token;
		$id = $_SESSION['z77-id'];

		$sql_comm = "UPDATE  `member_tb` SET `mem_token` = '$token' WHERE `member_tb`.`mem_id` = $id;";
		$obj->dbms_update($sql_comm);

		$sql_comm = "UPDATE  `member_tb` SET `mem_notifycation` = '[START][NOTIFY][TICKER]Welcome to CleanAlert[TITLE]ยินดีต้อนรับสู่ CleanAlert[TEXT]คุณได้ล็อกอินเข้าสู่ระบบ[END]' WHERE `member_tb`.`mem_id` = $id";
		$obj->dbms_update($sql_comm);

		$sql_comm = "INSERT INTO  `log_notifycation_tb` (`notify_id`, `notify_type`, `notify_text`, `notify_datetime`, `notify_member_id`, `notify_read`)
		VALUES (NULL, 'system', 'คุณได้เข้าสู่ระบบ', CURRENT_TIME(), '$id', '1');";
		$obj->dbms_insert($sql_comm);
		
		header("Location: ../view/index.php?home&token=$token");
		exit();
	}
	else
	{
		session_unset();
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "เข้าสู่ระบบไม่สำเร็จ";
		header("Location: ../index.php");
		exit();
	}
}
?>