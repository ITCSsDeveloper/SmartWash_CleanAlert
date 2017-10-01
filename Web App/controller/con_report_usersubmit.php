<?php 
session_start();

if(isset($_POST['submit_report']))
{
	$titleTxt = $_POST['titleTxt'];
	$descriptionTxt = $_POST['descriptionTxt'];
	$phoneTxt = $_POST['phoneTxt'];

	if($titleTxt == ''){
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<strong><i class="ace-icon fa fa-times">กรุณาเลือกหัวข้อที่ต้องการรายงาน</i></strong>';
		header('Location: ../view/index.php?report');
		return;
	}
	else if(strlen($descriptionTxt) > 500){
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<strong><i class="ace-icon fa fa-times">ใส่รายระเอียดของปัญหาที่พบ (จำกัด 500 ตัวอักษร)</i></strong>';
		header('Location: ../view/index.php?report');
		return;
	}
	else if($phoneTxt == ''){
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<strong><i class="ace-icon fa fa-times">กรุณากรอกเบอร์โทรศัพท์ เพื่อให้เจ้าหน้าที่ทำการติดต่อกลับได้</i></strong>';
		header('Location: ../view/index.php?report');
		return;
	}
	else if (is_numeric($phoneTxt) == false || strlen($phoneTxt) > 10 || strlen($phoneTxt) < 6)
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<strong><i class="ace-icon fa fa-times">เบอร์โทรศัพท์ต้องเป็นตัวเลยเท่านั้น และ มีความยาว 6-10 ตัว</i></strong>';
		header('Location: ../view/index.php?report');
		return;
	}

	@include('dbms.php');
	$obj = new dbms();

	$sql_comm = 
	"INSERT INTO  `error_report` 
	(`err_id`, `err_time_create`, `err_mem_id`, `err_title_menu`, `err_description`, `err_mem_phone`, `err_read`) 
	VALUES (NULL, CURRENT_TIMESTAMP, '". $_SESSION['z77-id'] ."', '$titleTxt', '$descriptionTxt', '$phoneTxt', 'unread');";

	if($obj->dbms_insert($sql_comm))
	{
		$_SESSION["notify_type"] = "success";
		$_SESSION["notify_string"] = '<strong><i class="ace-icon fa fa-check">ทางทีมงานได้รับทราบปัญหาของท่านแล้ว โปรดรอการติดต่อกลับจากเจ้าหน้าที่ภายใน 24 ชม</i></strong>';
		header('Location: ../view/index.php?report');
		return;
	}
	else
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<strong><i class="ace-icon fa fa-times">เกิดข้อผิดพลาดในการส่งรายงานปัญหาการใช้งาน โปรดติอต่อเจ้าหน้าที่ดูแลระบบ</strong>';
		header('Location: ../view/index.php?report');
		return;
	}
}
?>