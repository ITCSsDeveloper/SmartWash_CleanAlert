<?php
session_start();
if($_SESSION['z77-level'] != 'admin')
{ 
	echo '<center><h1>admin only.</h1><br><a href="index.php?main">back to home.</a></center>'; exit(); 
}

include("../controller/dbms.php");
$obj = new dbms();

if(isset($_POST["monitor_wash"]))
{
	$temp = '<tr>';
	// $temp .= '<td><b>id </b></td>';
	$temp .= '<td><b>token </b></td>';
	$temp .= '<td><b>power</b></td>';
	$temp .= '<td><b>name</b></td>';
	$temp .= '<td><b>location</b></td>'; 
	$temp .= '<td><b>water_level</b></td>';
	$temp .= '<td><b>time_remaing </b></td>';
	$temp .= '<td><b>process</b></td>';
	$temp .= '<td><b>time_start</b></td>';
	$temp .= '<td><b>mem_id </b></td>';
	$temp .= '<td><b>date_register</b></td>';
	$temp .= '<td><b>date_update </b></td>';
	// $temp .= '<td><b>registed</b></td>';
	$temp .= '</tr>';
	$sql_comm = "SELECT * FROM `wash_tb` ORDER BY `wash_id` ASC";
	$wash_table = $obj->dbms_select($sql_comm);
	foreach ($wash_table as $key => $value) 
	{
		$temp .= '<tr>';
		// $temp .= '<td>' . $value->wash_id .'</td>';
		$temp .= '<td>' . $value->wash_token .'</td>';
		$temp .= '<td>' . $value->wash_power.'</td>';
		$temp .= '<td>' . $value->wash_name.'</td>';
		$temp .= '<td>' . $value->wash_location.'</td>'; 
		$temp .= '<td>' . $value->wash_water_level.'</td>';
		$temp .= '<td>' . $value->wash_time_remaing .'</td>';
		$temp .= '<td>' . $value->wash_process.'</td>';
		$temp .= '<td>' . $value->wash_time_start.'</td>';
		$temp .= '<td>' . $value->wash_mem_id .'</td>';
		$temp .= '<td>' . $value->wash_date_register.'</td>';
		$temp .= '<td>' . $value->wash_date_update .'</td>';
		// $temp .= '<td>' . $value->wash_registed.'</td>';
		$temp .= '</tr>';
	}

	if(!$wash_table)
	{
		$temp .= '<tr><td colspan="11"><center>ไม่มีข้อมูล</center></td></tr>';
	}


	echo $temp;
}

elseif (isset($_POST['monitor_power'])) 
{
	$sql_comm = "SELECT wash_name,wash_process,wash_date_update FROM `wash_tb` WHERE wash_power = 'on' and wash_process != '' ORDER BY wash_id ASC";
	$wash_tb = $obj->dbms_select($sql_comm);

	$temp = '<tr>';
	$temp .= '<td><b>Name</b></td>';
	$temp .= '<td><b>Update</b></td>';
	$temp .= '<td><b>Process</b></td>';
	$temp .= '</tr>';

	foreach ($wash_tb as $key => $value) 
	{
		$temp .= '<tr>';
		$temp .= '<td>'. $value->wash_name . '</td>';
		$temp .= '<td>'. $value->wash_date_update . '</td>';
		$temp .= '<td>'. $value->wash_process . '</td>';
		$temp .= '</tr>';
	}

	if(!$wash_tb)
	{
		$temp .= '<tr><td colspan="3"><center>ไม่มีข้อมูล</center></td></tr>';
	}

	echo $temp;
}
?>




