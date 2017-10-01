<?php include("../checkAdmin.php"); ?>

<?php
if(isset($_GET["delete"]))
{	
	include("../checkToken.php");
	checkToken($_GET["_token"]);


	if($_GET["delete"] == "")
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "ไม่พบรายการที่จะลบ";
		header("Location: ../view/index.php?advertise");
		exit();
	}

	include("dbms.php");
	$obj = new dbms();

	$adv_id = $_GET["delete"];
	$path = $_GET["path"];

	$sql_comm =  "DELETE FROM `advertise_slide_tb` WHERE `id` = $adv_id";
	if($obj->dbms_delete($sql_comm))
	{
		$flgDelete = unlink("../img/advertise/$path");
		$_SESSION["notify_type"] = "success";
		$_SESSION["notify_string"] = "ลบรายการเรียบร้อยแล้ว";
		header("Location: ../view/index.php?advertise");
		exit();
		
	}
	else
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "เกิดข้อผิดพลาด ไม่สามารถลบรายการนี้ได้";
		header("Location: ../view/index.php?advertise");
		exit();
	}
}
?>