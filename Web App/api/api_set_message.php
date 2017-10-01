<?php
	function set_message($id,$message,$obj)
	{	
		$sql_comm = "UPDATE  `member_tb` SET `mem_notifycation` = '$message' WHERE `member_tb`.`mem_id` = $id;";
		if($obj->dbms_update($sql_comm))
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
?>