<?php 
session_start();
include("con_operation.php");

if(isset($_POST['submit_order']))
{
	$nameTxt = $_POST['nameTxt'];
	$addressTxt = $_POST['addressTxt'];
	$phoneTxt = $_POST['phoneTxt'];

	if($nameTxt == '' || strlen($nameTxt) > 100){
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>กรุณากรอกชื่อ</b>';
		header('Location: ../view/index.php?order_card');
		exit();
	}
	else if($addressTxt == '' || strlen($addressTxt) > 100){
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>กรุณากรอกที่อยู่จัดส่ง</b>';
		header('Location: ../view/index.php?order_card');
		exit();
	}
	else if(strlen($addressTxt) > 500){
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>ที่อยู่จัดส่งจำกัด 500 ตัวอักษร</b>';
		header('Location: ../view/index.php?order_card');
		exit();
	}
	else if($phoneTxt == ''){
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>กรุณากรอกเบอร์โทรศัพท์</b>';
		header('Location: ../view/index.php?order_card');
		exit();
	}
	
	if (is_numeric($phoneTxt) == false || strlen($phoneTxt) > 10 || strlen($phoneTxt) < 6)
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> <b>เบอร์โทรศัพท์ต้องเป็นตัวเลยเท่านั้น และ มีความยาว 6-10 ตัว</b>';
		header('Location: ../view/index.php?order_card');
		exit();
	}
	
	@include('dbms.php');
	$obj = new dbms();

	$sql_comm = 
	"INSERT INTO  `order_tb` 
	(`order_id`, `order_create_date`, `order_member_id`, `order_name`, `order_address`, `order_phone`, `order_status`) 
	VALUES (NULL, CURRENT_TIMESTAMP, '". $_SESSION['z77-id'] ."', '". $nameTxt ."', '". $addressTxt ."', '". $phoneTxt ."', 'unread');";
	if($obj->dbms_insert($sql_comm))
	{	
		$id = $_SESSION['z77-id'];
		$Operation = Operation($id,"","สั่งซื้อบัตร SmartCard",30,"-",$obj);

		if($Operation) 
		{
				$_SESSION["notify_type"] = "success";
				$_SESSION["notify_string"] = '<i class="ace-icon fa fa-check"></i> ระบบได้รับข้อมูลการสั่งซื้อเรียบร้อยแล้ว รอเจ้าหน้าที่ติดต่อกลับ';
				header('Location: ../view/index.php?order_card');
				exit();
		}
		else
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> เกิดข้อผิดพลาดระหว่างการหักเงิน โปรดติดต่อผู้ดูแลระบบ';
			header('Location: ../view/index.php?order_card');
			exit();
		}
	}
	else 
	{
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = '<i class="ace-icon fa fa-times"></i> เกิดข้อผิดพลาดระหว่างการสั่งซื้อ โปรดติดต่อผู้ดูแลระบบ';
		header('Location: ../view/index.php?order_card');
		exit();
	}
}
?>