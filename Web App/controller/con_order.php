<?php
session_start();

if (isset($_POST['make_read']))
{
	if($_SESSION['z77-level'] != 'admin') { return; }

	$order_id = $_POST['make_read_id'];
	$sql_comm = "UPDATE  `order_tb` SET `order_status` = 'read' WHERE `order_tb`.`order_id` = $order_id";

	include('dbms.php');
	$obj = new dbms();
	if($obj->dbms_update($sql_comm))
	{
		header("Location: ../view/index.php?admin");
		return;
	}
	else
	{
		echo 'Update Make Read Error.';
		return;
	}
}

?>