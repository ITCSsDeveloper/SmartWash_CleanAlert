<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
@session_start();
include('../controller/dbms.php');
$obj = new dbms();
$result = array();
$result['api_return'] = "InvalidConnection"; 
$_SESSION['z77-name'] = "CleanAlertWash";
echo "<pre>"; 
if(isset($_POST["ajax_check_post"])) { var_export($_POST);exit(); }

// var_export($_POST);
// .add("RegisterDevice", "")
//                       .add("WashPassword", WashPassword)
//                       .add("WashToken", "123123123")
//                       .add("WashName", "Wash12222")
//                       .add("WashLocation", "77878798798798")
// $_POST['RegisterDevice'] = "";
// $_POST['WashPassword'] = "RpW1C0ToD5g6";
// $_POST['WashToken'] = "123123123";
// $_POST['WashName'] = "Wash12222";
// $_POST['WashLocation'] = "789879879879";

// $_POST['UpdateWashToServer'] = "";
// $_POST['WashPassword'] = "RpW1C0ToD5g6";
// $_POST['WashToken'] = "123123123";

// $_POST['StatusPower'] = "ON";
// $_POST['StatusWater'] = "LL";
// $_POST['StatusProcess'] = "SSS";
// $_POST['StatusTime'] = "aaaa";

//$_POST['tryconnect'] = "RpW1C0ToD5g6";

if($obj->dbms_insert_log(@$_SESSION['z77-name'],"Acess","API")) {}


if(isset($_POST['UpWash']))
{
	$fail = 0;
	if($_POST['WP'] != "RpW1C0ToD5g6" ){ echo json_encode($result); exit(); } 

	$WashToken = @$_POST['WT'];
	$StatusPower = @$_POST['SP'];
	$StatusWater = @$_POST['SW'];
	$StatusProcess = @$_POST['SPc'];
	$StatusTime = @$_POST['ST'];

	$sql_comm = "UPDATE  `wash_tb` 
	SET 
	`wash_power` = '$StatusPower', 
	`wash_water_level` = '$StatusWater', 
	`wash_time_remaing` = '$StatusTime', 
	`wash_process` = '$StatusProcess', 
	`wash_time_start` = '',
	`wash_date_update` = CURRENT_TIME() 
	WHERE `wash_tb`.`wash_token` = '$WashToken';";
	if($obj->dbms_update($sql_comm))
	{
		$result['api_return'] = "UpWash:T"; 
	}
	else
	{
		$result['api_return'] = "UpWash:F"; 
	}

	echo json_encode($result); 

	if($obj->dbms_insert_log(@$_SESSION['z77-name'],"UpdateWashToServer","API")) {}
	exit();
}

if(isset($_POST['tryconnect']))
{
	if($_POST['tryconnect'] == "RpW1C0ToD5g6")
	{
		$result['api_return'] = "ConnectServer:true"; 
	}
	else 
	{
		$result['api_return'] = "ConnectServer:false"; 
	}
	echo json_encode($result); 

		if($obj->dbms_insert_log(@$_SESSION['z77-name'],"TryConnect","API")) {}
		exit();
}

if(isset($_POST['RegisterDevice'])) 
{
	$fail = 0;
	if($_POST['WashPassword'] != "RpW1C0ToD5g6" ){ echo json_encode($result); exit(); } 
	
	$WashToken = @$_POST['WashToken'];
	$WashName = @$_POST['WashName'];
	$WashLocation = @$_POST['WashLocation'];

	if($WashToken == "" || $WashToken == null || $WashName == "" || $WashName == null) 
	{ $result['api_return'] = "RegisterDevice:false"; $fail = 1; } 

	if($fail == 0)
	{
		$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$WashToken' AND `wash_registed` = 'NULL'";
		if($obj->dbms_select($sql_comm))
		{
			$sql_comm = 
			"UPDATE  `wash_tb` 
			SET 
			`wash_name` = '$WashName', 
			`wash_location` = '$WashLocation',
			`wash_power` = 'null',  
			`wash_water_level` = 'null', 
			`wash_time_remaing` = 'null', 
			`wash_process` = 'null', 
			`wash_time_start` = 'null' ,
			`wash_registed` = 'REGISTED' 
			WHERE `wash_tb`.`wash_token` = $WashToken 
			AND `wash_tb`.`wash_registed` = 'NULL'";

			if($obj->dbms_update($sql_comm))
			{
				$result['api_return'] = "RegisterDevice:true";
			}
			else
			{
				$result['api_return'] = "RegisterDevice:false";
			}
		}
		else 
		{
			$result['api_return'] = "RegisterDevice:false";
		}
	}

	echo json_encode($result); 

	if($obj->dbms_insert_log(@$_SESSION['z77-name'],"RegisterDevice","API")) {}
		exit();
}

$result['api_return'] = "InvalidCommand"; 
echo json_encode($result);
exit();
?>