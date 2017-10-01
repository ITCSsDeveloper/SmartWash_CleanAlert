<?php
session_start();

if(isset($_POST['make_read'])) // for _ admin Level
{	
	if($_SESSION['z77-level'] != 'admin') { echo "Level Admin Only."; exit(); }

	$report_id = $_POST['make_read_id'];
	$sql_comm = "UPDATE  `error_report` SET `err_read` = 'read' WHERE `error_report`.`err_id` = $report_id";

	include('dbms.php');
	$obj = new dbms();

	if($obj->dbms_update($sql_comm))
	{
		header("Location: ../view/index.php?admin#report");
		return;
	}
	else
	{
		echo 'Update Make Read Error.';
		return;
	}
}
?>