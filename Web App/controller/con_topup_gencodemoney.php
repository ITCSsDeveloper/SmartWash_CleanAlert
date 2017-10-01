<?php 
session_start();

if(isset($_POST['gen_code_money']))
{
	if($_SESSION['z77-level'] != 'admin')
	{ 
		echo '<center><h1>admin only.</h1> <br> <a href="index.php?main">back to home.</a> </center>'; 
		return;
	}

	$money = $_POST['value'];
	$code = rand(100000,999999);

	include('dbms.php');
	$obj = new dbms();

	while ($obj->dbms_select("SELECT * FROM `topup_tb` WHERE `top_code` = '$code'")) 
	{
		$code = rand(100000,999999);
	}

	$sql_comm = 
	"INSERT INTO  `topup_tb` (`top_id`, `top_code`, `top_value`, `top_time_create`, `top_time_use`, `top_useby_mem_id`) 
	VALUES (NULL, '$code', '$money', CURRENT_TIMESTAMP, NULL, NULL);";

	if($obj->dbms_insert($sql_comm))
	{
		$obj->dbms_header('../view/index.php?admin');
	}
	else
	{
		echo "Error";
	}
}

?>