<?php
	session_start();
	
	if(isset($_POST["TOKEN"]))
	{
		$TOKEN = $_POST["TOKEN"];

		$sql_comm = "SELECT `mem_notifycation` , `mem_id` FROM `member_tb` WHERE `mem_token` = '$TOKEN' LIMIT 1";
		include("../controller/dbms.php");
		$obj = new dbms();

		$result = $obj->dbms_select($sql_comm);
		if($result)
		{	
			$mem_notifycation = $result[0]->mem_notifycation;
			$mem_id = $result[0]->mem_id;

			$_SESSION["device_token"] = $TOKEN;

			if($mem_notifycation  == "" || $mem_notifycation == NULL) { return; }
			else 
			{ 
				echo $mem_notifycation ;
				$sql_comm = "UPDATE  `member_tb` SET `mem_notifycation` = NULL WHERE `member_tb`.`mem_id` = $mem_id;";
				$obj->dbms_update($sql_comm);
			}
			 exit();
		}
		else
		{
			echo "Fail";
			exit();
		}
	}
?>