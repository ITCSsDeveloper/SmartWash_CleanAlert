<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
@session_start();
ini_set('max_execution_time', 60*5); //300 seconds = 5 minutes
$servername = "localhost";
$dbname = "itcssme_project";
$username = "itcssme_project";
$password = "Z2SW7jqNVdwtvnYE";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");


if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	exit();
} 

///////////////////////////////////////////////////////////////////////////////////////////////

$conn->query("DROP TABLE error_report");
$conn->query("CREATE TABLE IF NOT EXISTS `error_report` (
  `err_id` int(11) NOT NULL,
  `err_time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date_time @ id create',
  `err_mem_id` varchar(10) NOT NULL,
  `err_title_menu` varchar(30) NOT NULL,
  `err_description` text NOT NULL,
  `err_mem_phone` varchar(15) NOT NULL,
  `err_read` varchar(10) DEFAULT 'unread'
);");
$conn->query("DROP TABLE history_detail_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `history_detail_tb` (
  `hisd_id` int(11) NOT NULL,
  `hisd_roll_id` text NOT NULL,
  `hisd_wash_id` text NOT NULL,
  `hisd_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hisd_status` text NOT NULL
);");
$conn->query("DROP TABLE history_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `history_tb` (
  `his_id` int(11) NOT NULL,
  `his_mem_id` text NOT NULL,
  `his_wash_id` text NOT NULL,
  `his_awalk` text NOT NULL,
  `his_roll_id` text NOT NULL,
  `his_time_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `his_time_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `his_alert_type` text NOT NULL,
  `his_alert_phone` text NOT NULL
);");
$conn->query("DROP TABLE log_member_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `log_member_tb` (
  `log_id` int(11) NOT NULL,
  `log_mem_id` varchar(10) NOT NULL,
  `log_wash_id` varchar(10) DEFAULT NULL,
  `log_statement` varchar(100) NOT NULL,
  `log_coin_before` int(11) DEFAULT NULL,
  `log_coin_use` int(10) NOT NULL,
  `log_coin_after` int(11) DEFAULT NULL,
  `log_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_type` varchar(30) NULL
);");

$conn->query("DROP TABLE member_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `member_tb` (
  `mem_id` int(11) NOT NULL,
  `mem_name` varchar(30) NOT NULL,
  `mem_email` varchar(100) NOT NULL,
  `mem_date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mem_phone` varchar(15) NOT NULL,
  `mem_coin` int(5) DEFAULT NULL,
  `mem_password` varchar(50) NOT NULL,
  `mem_point` int(10) DEFAULT NULL,
  `mem_level` varchar(30) NOT NULL DEFAULT 'normal',
  `mem_token` text,
  `mem_notifycation` text,
  `mem_command_admin` text
);");
$conn->query("DROP TABLE order_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `order_tb` (
  `order_id` int(11) NOT NULL,
  `order_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_member_id` varchar(10) NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `order_address` varchar(500) NOT NULL,
  `order_phone` varchar(10) NOT NULL,
  `order_status` varchar(10) NOT NULL DEFAULT 'unread'
);");
$conn->query("DROP TABLE otp_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `otp_tb` (
  `otp_id` int(11) NOT NULL,
  `otp_code` text NOT NULL,
  `otp_member_id` text NOT NULL,
  `otp_wash_id` text,
  `otp_time_create` datetime NOT NULL,
  `otp_time_expired` text NOT NULL,
  `otp_time_expired_text` text,
  `otp_use` tinyint(1) NOT NULL DEFAULT '0'
);");
$conn->query("DROP TABLE topup_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `topup_tb` (
  `top_id` int(11) NOT NULL,
  `top_code` text NOT NULL,
  `top_value` text NOT NULL,
  `top_time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `top_time_use` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `top_useby_mem_id` text,
  `top_delete` varchar(11) DEFAULT 'No'
);");
$conn->query("DROP TABLE wash_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `wash_tb` (
  `wash_id` int(11) NOT NULL,
  `wash_name` text COMMENT 'ชื่อ เครื่อง',
  `wash_location` text COMMENT 'พิกัด ทีตั้ง ใช้ตอนแรก',
  `wash_water_level` text COMMENT 'สถานะ ระดับน้ำ',
  `wash_power` text COMMENT 'สถานะ การเปิด ปิด',
  `wash_time_remaing` text COMMENT 'เวลาที่เหลืออยู่',
  `wash_process` text COMMENT 'โปรเซสปัจจุบัน',
  `wash_time_start` text COMMENT 'เวลาที่เครื่องเริ่มทำงาน',
  `wash_token` varchar(60) DEFAULT NULL COMMENT 'รอรับจาก Server เอาไว้ Register เครื่องใหม่',
  `wash_device_id` text COMMENT '-- เครื่องที่ ลงชื่อเข้าใช้งาน',
  `wash_date_register` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่ลงทะเบียนเครื่อง',
  `wash_date_update` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT 'Update ล่าสุด',
  `wash_registed` varchar(15) DEFAULT 'NULL' COMMENT 'บอกว่าเครื่องนี้ ลงทะเบียนหรือยัง'
);");
$conn->query("DROP TABLE log_notifycation_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `log_notifycation_tb` (
  `notify_id` int(11) NOT NULL,
  `notify_type` varchar(50) NOT NULL,
  `notify_text` text NOT NULL,
  `notify_datetime` datetime NOT NULL,
  `notify_member_id` int(11) NOT NULL
);");

$conn->query("ALTER TABLE `log_notifycation_tb` ADD PRIMARY KEY (`notify_id`);");
$conn->query("ALTER TABLE `log_notifycation_tb` MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT;");
$conn->query("ALTER TABLE `log_notifycation_tb` ADD `notify_read` BOOLEAN NOT NULL DEFAULT FALSE AFTER `notify_member_id`;");
$conn->query("ALTER TABLE `error_report` ADD PRIMARY KEY (`err_id`);");
$conn->query("ALTER TABLE `history_detail_tb` ADD PRIMARY KEY (`hisd_id`);");
$conn->query("ALTER TABLE `history_tb` ADD PRIMARY KEY (`his_id`);");
$conn->query("ALTER TABLE `log_member_tb` ADD PRIMARY KEY (`log_id`);");
$conn->query("ALTER TABLE `member_tb` ADD PRIMARY KEY (`mem_id`);");
$conn->query("ALTER TABLE `order_tb` ADD PRIMARY KEY (`order_id`);");
$conn->query("ALTER TABLE `otp_tb` ADD PRIMARY KEY (`otp_id`);");
$conn->query("ALTER TABLE `topup_tb` ADD PRIMARY KEY (`top_id`);");
$conn->query("ALTER TABLE `wash_tb` ADD PRIMARY KEY (`wash_id`);");
$conn->query("ALTER TABLE `error_report` MODIFY `err_id` int(11) NOT NULL AUTO_INCREMENT;");
$conn->query("ALTER TABLE `history_detail_tb` MODIFY `hisd_id` int(11) NOT NULL AUTO_INCREMENT;");
$conn->query("ALTER TABLE `log_member_tb` MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;");
$conn->query("ALTER TABLE `order_tb` MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;");
$conn->query("ALTER TABLE `otp_tb` MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT;");
$conn->query("ALTER TABLE `topup_tb` MODIFY `top_id` int(11) NOT NULL AUTO_INCREMENT;");
$conn->query("ALTER TABLE `wash_tb` MODIFY `wash_id` int(11) NOT NULL AUTO_INCREMENT;");

$conn->query("INSERT INTO `member_tb` (`mem_id`, `mem_name`, `mem_email`, `mem_date_reg`, `mem_phone`, `mem_coin`, `mem_password`, `mem_point`, `mem_level`, `mem_token`, `mem_notifycation`, `mem_command_admin`) VALUES
(672003, 'Admin_tan', 'admin@mail.com', '2016-02-14 10:42:05', '0900303314', 1000, '9ef2a6e6d997a645897034c7a3342a2f', 1000, 'admin', '', '', NULL),
(958451, 'test', 'test@mail.com', '2016-02-14 10:34:22', '0900303333', 0, '9ef2a6e6d997a645897034c7a3342a2f', 0, 'normal', '', '', '');
");

$conn->query("DROP TABLE history_detail_tb");
$conn->query("DROP TABLE history_tb");
$conn->query("ALTER TABLE `wash_tb` CHANGE `wash_device_id` `wash_mem_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'User ที่กำลังใช้งาน';");

$conn->query("DROP TABLE news_server_tb");
$conn->query("CREATE TABLE IF NOT EXISTS `news_server_tb` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `postby` text,
  `header` text NOT NULL,
  `text` text,
  `url` text,
  `softdelete` tinyint(1) DEFAULT '0'
);");

$conn->query("INSERT INTO `news_server_tb` (`id`, `datetime`, `postby`, `header`, `text`, `url`, `softdelete`) VALUES
(1, '2016-02-09 15:06:26', 'CleanAlert', 'เปิดให้บริการ', 'ทางทีมงานยินดีต้อนรับทุกท่าน และ ขอขอบคุณที่ใช้บริการ CleanAlert', '', 0),
(2, '2016-02-09 15:07:21', 'CleanAlert', 'ปิดปรับปรุง', 'แจ้งปิดปรับปรุงเซิฟเวอร์ วันที่ 10 กุมภาพัน 2559 เวลา 15:00น  ถึง 21:00น', '', 0);
");

$conn->query("DROP TABLE advertise_slide_tb");
$conn->query("CREATE TABLE `advertise_slide_tb` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `text` text,
  `url` text,
  `path` text,
  `active` text
);");
$conn->query("INSERT INTO `advertise_slide_tb` (`id`, `text`, `url`, `path`, `active`) VALUES
(1, 'Demo1', 'https://www.google.co.th/', 'slide_1403821151.png', ''),
(2, 'Demo2', 'https://www.google.co.th/', 'slide_1261715380.png', 'active'),
(3, 'Demo3', '', 'slide_1346318244.png', '');");

$conn->query("DROP TABLE promotion_tb");
$conn->query("CREATE TABLE `promotion_tb` (
  `id` int(11) NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  `property` text NOT NULL,
  `value` text NOT NULL
)");
$conn->query("INSERT INTO `promotion_tb` (`id`, `property`, `value`) VALUES
(1, 'multiplierPoint', '0.5'),
(2, 'extra1', '0'),
(3, 'extra2', '0');");

$conn->query("DROP TABLE log_point_tb");
$conn->query("CREATE TABLE `log_point_tb` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mem_id` int(11) DEFAULT NULL,
  `description` text,
  `datetime` datetime DEFAULT NULL,
  `point` int(11) DEFAULT NULL
);");

$conn->query("DROP TABLE log_reward_tb");
$conn->query("CREATE TABLE `log_reward_tb` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mem_id` int(11) DEFAULT NULL,
  `description` text,
  `point` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
);");

$conn->close();
session_unset();
header("Location: index.php");

?>