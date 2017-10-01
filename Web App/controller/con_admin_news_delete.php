<?php include("../checkAdmin.php"); ?>
<?php
if(isset($_GET["delete"]))
{
	$id = $_GET["delete"];
	include("../checkToken.php");
	checkToken($_GET["_token"]);

	if($id == "")
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "ไม่พบรายการที่จะลบ";
		header("Location: ../view/index.php?newsServer");
		exit();
	}


	include("dbms.php");
	$obj = new dbms();
	$sql_comm = "UPDATE `news_server_tb` SET `softdelete` = '1' WHERE `news_server_tb`.`id` = $id;";
	if($obj->dbms_update($sql_comm))
	{
		$_SESSION["notify_type"] = "success";
		$_SESSION["notify_string"] = "ลบรายการสำเร็จ";
		header("Location: ../view/index.php?newsServer");
		exit();
	}
	else
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "ลบรายการไม่สำเร็จ";
		header("Location: ../view/index.php?newsServer");
		exit();
	}
}
?>