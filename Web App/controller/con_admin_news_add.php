<?php include("../checkAdmin.php"); ?>
<?php
if(isset($_POST["news_add"]))
{	
	$postby = @$_POST["postby"];
	$header = @$_POST["header"];
	$text   = @$_POST["text"];
	$url   = @$_POST["url"];

	include("../checkToken.php");
	checkToken($_POST["_token"]);

	if($postby == "" || $header == "" || $text == "") 
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "ต้องไม่มีค่าว่าง";
		header("Location: ../view/index.php?newsServer");
		exit();
	}
	
	include("dbms.php");
	$obj = new dbms();


	$sql_comm = "INSERT INTO `news_server_tb` (`id`, `datetime`, `postby`, `header`, `text`, `url`, `softdelete`)
	 VALUES (NULL, CURRENT_TIME(), '$postby', '$header', '$text', '$url', '0');";
	if($obj->dbms_insert($sql_comm))
	{
		$_SESSION["notify_type"] = "success";
		$_SESSION["notify_string"] = "เพิ่มข่าวสารสำเร็จ";
		header("Location: ../view/index.php?newsServer");
		exit();
	}
	else
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "ไม่สามารถเพิ่มข่าวสารได้";
		header("Location: ../view/index.php?newsServer");
		exit();
	}
}


?>