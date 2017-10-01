<?php
session_start();

// Soft delete code 
if(isset($_POST['delete_code']))
{
	if($_SESSION['z77-level'] != 'admin')
	{ 
		echo '<center><h1>admin only.</h1> <br> <a href="index.php?main">back to home.</a> </center>'; 
		return;
	}

	include('dbms.php');
	$obj = new dbms();

	$code_id = $_POST['code_id'];
	$sql_comm = "SELECT * FROM `topup_tb` WHERE `top_id` = $code_id";
	$result = $obj->dbms_select($sql_comm); 

	if($result)
	{
		if($result[0]->top_delete != 'Yes')
		{
			$sql_comm = "UPDATE  `topup_tb` SET `top_delete` = 'Yes' WHERE `topup_tb`.`top_id` = $code_id;";
			if($obj->dbms_update($sql_comm))
			{
				$obj->dbms_header('../view/index.php?tester');
			}
		}
		else
		{
			$sql_comm = "UPDATE  `topup_tb` SET `top_delete` = 'No' WHERE `topup_tb`.`top_id` = $code_id;";
			if($obj->dbms_update($sql_comm))
			{
				$obj->dbms_header('../view/index.php?tester');
			}
		}
	}
}

?>