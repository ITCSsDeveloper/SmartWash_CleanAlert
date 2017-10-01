<?php
// For ALL WASH 
session_start();
include('dbms.php');
$obj = new dbms();

if (isset($_GET['WashInfo_name']))
{
	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		return;
	}
	if($_SESSION['z77'] !=  'F^%G7wbJ+%n+dfBF') 
	{ 
		header("Location: ../view/index.php?logout");
		return;
	}

	$WashToken = $_GET['WashInfo_name'];
	$id = $_SESSION['z77-id'];
	$email = $_SESSION['z77-email'];

	$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$WashToken'";
	$result = $obj->dbms_Select_nolog($sql_comm);

	if($result)
	{
		echo $result[0]->wash_name;
	}
	return;
}

else if (isset($_GET['WashInfo_water']))
{
	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		return;
	}
	if($_SESSION['z77'] !=  'F^%G7wbJ+%n+dfBF') 
	{ 
		header("Location: ../view/index.php?logout");
		return;
	}

	$WashToken = $_GET['WashInfo_water'];
	$id = $_SESSION['z77-id'];
	$email = $_SESSION['z77-email'];

	$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$WashToken'";
	$result = $obj->dbms_Select_nolog($sql_comm);

	if($result)
	{
		echo $result[0]->wash_water_level;
	}
	return;
}

else if (isset($_GET['WashInfo_process']))
{
	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		return;
	}
	if($_SESSION['z77'] !=  'F^%G7wbJ+%n+dfBF') 
	{ 
		header("Location: ../view/index.php?logout");
		return;
	}

	$WashToken = $_GET['WashInfo_process'];
	$id = $_SESSION['z77-id'];
	$email = $_SESSION['z77-email'];

	$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$WashToken'";
	$result = $obj->dbms_Select_nolog($sql_comm);

	if($result)
	{
		echo $result[0]->wash_process;
	}
	return;
}

else if (isset($_GET['WashInfo_time']))
{
	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		return;
	}
	if($_SESSION['z77'] !=  'F^%G7wbJ+%n+dfBF') 
	{ 
		header("Location: ../view/index.php?logout");
		return;
	}

	$WashToken = $_GET['WashInfo_time'];
	$id = $_SESSION['z77-id'];
	$email = $_SESSION['z77-email'];

	$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$WashToken'";
	$result = $obj->dbms_Select_nolog($sql_comm);

	if($result)
	{
		echo $result[0]->wash_time_remaing;
	}
	return;
}

else if (isset($_GET['WashInfo_power']))
{
	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		return;
	}
	if($_SESSION['z77'] !=  'F^%G7wbJ+%n+dfBF') 
	{ 
		header("Location: ../view/index.php?logout");
		return;
	}

	$WashToken = $_GET['WashInfo_power'];
	$id = $_SESSION['z77-id'];
	$email = $_SESSION['z77-email'];

	$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$WashToken'";
	$result = $obj->dbms_Select_nolog($sql_comm);

	if($result)
	{
		echo $result[0]->wash_power;
	}
	return;
}



?>