<?php 
session_start();

if (isset($_POST['password_change']))
{
    $old_password = $_POST['oldPasswordTxt'];
    $new_password = $_POST['newPasswordTxt'];
    $renew_password = $_POST['renewPasswordTxt'];

    if($new_password != $renew_password)
    {
     $_SESSION["notify_type"] = "danger";
     $_SESSION["notify_string"] = "<i class='ace-icon fa fa-times'></i>  รหัสผ่านใหม่ ไม่ตรงกัน";
     header("Location: ../index.php?passwordchange");
     exit();
 }
 if(isset($_SESSION['z77-email']) != true)
 {
    header("Location: ../index.php?logout");
    exit();
}

$email = $_SESSION['z77-email'];
$id = $_SESSION['z77-id'];
$old_password = md5($old_password . 'F^%G7wbJ+%n+dfBF');
$new_encrypt_password = md5($new_password . 'F^%G7wbJ+%n+dfBF');

include('dbms.php');
$obj = new dbms();

$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_email` = '$email' AND `mem_password` = '$old_password'";
if($obj->dbms_select($sql_comm))
{
    $sql_comm = "UPDATE  `member_tb` SET `mem_password` = '$new_encrypt_password' 
    WHERE `member_tb`.`mem_id` = $id";

    if($obj->dbms_update($sql_comm))
    {
       $_SESSION["notify_type"] = "success";
       $_SESSION["notify_string"] = "<i class='ace-icon fa fa-check'></i>  เปลี่ยนรหัสผ่านสำเร็จ";

       $sql_comm = "INSERT INTO  `log_notifycation_tb` (`notify_id`, `notify_type`, `notify_text`, `notify_datetime`, `notify_member_id`, `notify_read`)
       VALUES (NULL, 'alert', 'คุณได้เปลี่ยนรหัสผ่าน', CURRENT_TIME(), '$id', '0');";
       $obj->dbms_insert($sql_comm);

       header("Location: ../index.php?passwordchange");
       exit();
   }
   else
   {
    $_SESSION["notify_type"] = "danger";
    $_SESSION["notify_string"] = "<i class='ace-icon fa fa-times'></i>  เปลี่ยนรหัสผ่านไม่สำเร็จ";
    header("Location: ../index.php?passwordchange");
    exit();
}
}
else
{
   $_SESSION["notify_type"] = "danger";
   $_SESSION["notify_string"] = "<i class='ace-icon fa fa-times'></i>  รหัสผ่านผิด";
   header("Location: ../index.php?passwordchange");
   exit();
}
}
?>