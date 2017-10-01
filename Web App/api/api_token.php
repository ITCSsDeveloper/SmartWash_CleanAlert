<?php 
	session_start();

	if(isset($_SESSION['z77']) != true ) 
	{
		header("Location: ../view/index.php?logout");
		exit();
	}
	if(!isset($_SESSION['z77-token'])) 
	{ 
		header("Location: ../view/index.php?logout");
		exit(); 
	}
	
	$token = $_SESSION['z77-token'];
    header("Location: ../view/index.php?main&token=$token");
    exit();

?>