<?php 
@$sql_comm = "SELECT mem_command_admin FROM `member_tb` WHERE mem_id = " . @$_SESSION["z77-id"];
if(@$obj->dbms_select($sql_comm)[0]->mem_command_admin == "forceLogout")
{
	$sql_comm = "UPDATE `member_tb` SET `mem_command_admin` = '' WHERE `member_tb`.`mem_id` = " . @$_SESSION["z77-id"];
	$obj->dbms_update($sql_comm);
	echo "<script>alert('ถูกบังคบให้ออกจากระบบ); </script>";
	session_unset();
}
else if(@$obj->dbms_select($sql_comm)[0]->mem_command_admin == "block")
{
	session_unset();?>
	<script> alert('Username นี้ ถูก Block โดยระบบ \n ติดต่อสอบถาม 090-XXXXXXXX'); </script>
	<?php
	echo "Username นี้ ถูก Block โดยระบบ \n ติดต่อสอบถาม 090-XXXXXXXX";
	exit();
}
else if(@$obj->dbms_select($sql_comm)[0]->mem_command_admin == "banUser")
{
	session_unset();?>
	<script> alert('Username นี้ ถูก Ban โดยระบบ \n ติดต่อสอบถาม 090-XXXXXXXX'); </script>
	<?php
	echo "Username นี้ ถูก Ban โดยระบบ \n ติดต่อสอบถาม 090-XXXXXXXX";
	exit();
}
?>