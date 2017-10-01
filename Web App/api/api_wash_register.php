<?php 
if(isset($_POST["Register"]))
{	
	if($_POST["Register"] == "RpW1C0ToD5g6")
	{
		$TokenText 	  = @$_POST["TokenText"];
		$WashingText  = @$_POST["WashingText"];
		$LocationText = @$_POST["LocationText"];

		if($TokenText == "" || $WashingText == "" || $LocationText == "") { echo "[REG]ValueInvalid[END]"; exit(); }

		include("../controller/dbms.php");
		$obj = new dbms();

		$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_token` = '$TokenText' AND `wash_registed` != 'REGISTED'";
		$result = $obj->dbms_select($sql_comm);

		if($result)
		{	
			$id = $result[0]->wash_id;
			$sql_comm = "UPDATE `wash_tb` SET `wash_name` = '$WashingText', `wash_location` = '$LocationText', `wash_registed` = 'REGISTED' WHERE `wash_tb`.`wash_id` = $id;";
			$obj->dbms_update($sql_comm);
			echo "[REG]OK[END]";
			exit();
		}
		else
		{
			echo "[REG]NoToken[END]";
			exit();
		}
	}
	else
	{
		echo "[REG]Wrongpassword[END]";
		exit();
	}
}
?>