<?php include("../checkAdmin.php"); ?>
<?php

if(isset($_POST['GenWashToken']))
{
	$_toke = null;
	include('dbms.php');
	$obj = new dbms();

	do {
		$_toke = rand(100000,999999);
		$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$_toke'";
		$result = $obj->dbms_select($sql_comm) ;
		$count = count($result);

	} while ($count > 0);
	

	$sql_comm = "INSERT INTO  `wash_tb` 
	(`wash_id`, `wash_name`, `wash_location`, `wash_water_level`, 
		`wash_power`, `wash_time_remaing`, `wash_process`, 
		`wash_time_start`, `wash_token`, `wash_mem_id`, 
		`wash_date_register`, `wash_date_update`, `wash_registed`) 
		VALUES (NULL, '', '', '', '', '', '', '', '$_toke', '', CURRENT_TIME(), CURRENT_TIMESTAMP, 'NULL');";

		if($obj->dbms_insert($sql_comm))
		{
			$_SESSION['GenWashToken'] = $_toke;
			$obj->dbms_header('../view/index.php?admin');
		}
		else
		{
			echo "Error"; exit();
		}
}
?>