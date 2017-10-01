<?php
	@session_start();
	if($_SESSION['z77-level'] != 'admin')
	{ 
		echo '<center><h1>admin only.</h1><br><a href="index.php?main">back to home.</a></center>'; exit(); 
	}
?>