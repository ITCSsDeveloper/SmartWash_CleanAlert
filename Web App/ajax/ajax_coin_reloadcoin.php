<?php
	@session_start();
	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		exit();
	}
	if($_SESSION['z77'] !=  'F^%G7wbJ+%n+dfBF') 
	{ 
		header("Location: ../view/index.php?logout");
		exit();
	}

	$id = $_SESSION['z77-id'];
	$email = $_SESSION['z77-email'];
	
	@include('../controller/dbms.php');
	@$obj = new dbms();

	$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_id` = $id AND `mem_email` = '$email'";
	$result = $obj->dbms_Select_nolog($sql_comm);
	if($result)
	{
		$_SESSION['z77-id'] = $result[0]->mem_id;
		$_SESSION['z77-name'] = $result[0]->mem_name;
		$_SESSION['z77-coin'] = $result[0]->mem_coin;
		$_SESSION['z77-point'] = $result[0]->mem_point;
		$_SESSION['z77-phone'] = $result[0]->mem_phone;
		$_SESSION['z77-email'] = $result[0]->mem_email;
		echo '<b>ยอดเงินคงเหลือ : </b>' . $_SESSION['z77-coin'] . '฿';
	}
?>