<?php
	session_start();
	include("dbms.php");
	include("con_operation.php");

	$obj = new dbms();

	$id = $_SESSION['z77-id'];

	$sql_comm = "UPDATE  `member_tb` SET `mem_token` = NULL WHERE `member_tb`.`mem_id` = $id;";
	$obj->dbms_update($sql_comm);

	$sql_comm = "INSERT INTO  `log_notifycation_tb` (`notify_id`, `notify_type`, `notify_text`, `notify_datetime`, `notify_member_id`, `notify_read`)
	VALUES (NULL, 'system', 'คุณได้ออกจากระบบ', CURRENT_TIME(), '$id', '1');";
	$obj->dbms_insert($sql_comm);


	session_unset();
	header("Location: ../view/login.php?login");
	exit();
?>