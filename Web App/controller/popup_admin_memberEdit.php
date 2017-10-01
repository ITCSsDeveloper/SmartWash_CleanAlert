<?php 
session_start();
include("../checkAdmin.php");
include("dbms.php");
$obj = new dbms();

if(isset($_POST["memberEdit"]))
{
	include("../checkToken.php");
	checkToken($_POST["_token"]);

	$password = @$_POST["password"];
	$password = md5($password . 'F^%G7wbJ+%n+dfBF');
	$email    = $_SESSION["z77-email"];

	$mem_id    = @$_POST["mem_id"];
	$mem_name  = @$_POST["mem_name"];
	$mem_email = @$_POST["mem_email"];
	$mem_phone = @$_POST["mem_phone"];
	$mem_level = @$_POST["mem_level"];
	$mem_command_admin = @$_POST["mem_command_admin"];

	$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_email` = '$email' AND `mem_password` = '$password'";
	if($obj->dbms_select($sql_comm))
	{
		$sql_comm = "UPDATE `member_tb` SET 
		`mem_name` = '$mem_name', 
		`mem_email` = '$mem_email', 
		`mem_phone` = '$mem_phone', 
		`mem_level` = '$mem_level',
		`mem_command_admin` = '$mem_command_admin' 
		WHERE `member_tb`.`mem_id` = $mem_id;";

		if($obj->dbms_update($sql_comm))
		{
			$_SESSION["notify_type"] = "success";
			$_SESSION["notify_string"] = "แก้ไขสำเร็จ";
		}
		else
		{
			$_SESSION["notify_type"] = "danger";
			$_SESSION["notify_string"] = "แก้ไขไม่สำเร็จ";
		}
	}
	else {
		$_SESSION["notify_type"] = "danger";
		$_SESSION["notify_string"] = "รหัสผ่านผิด";
	}
}

else if(isset($_GET["id"]))
{
	include("../checkToken.php");
	checkToken($_GET['_token']);

	$id = @$_GET["id"];
	$sql_comm = "SELECT * FROM `member_tb` WHERE `mem_id` = $id";
	$member = $obj->dbms_select($sql_comm);
}
else 
{
	exit(); 
}
?>


<title>CleanAlert</title>
<meta charset="utf-8" />
<meta http-equiv="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="overview &amp; stats" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link rel="stylesheet" href="../assets/css/bootstrap.css" />
<link rel="stylesheet" href="../assets/css/font-awesome.css" />
<link rel="stylesheet" href="../assets/css/ace-fonts.css" />
<link rel="stylesheet" href="../assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

<?php @$_token = md5(date("h:i:sa") . 'S!y7w&FSy5Q-~8=@' . @$_SESSION["z77-id"]); ?>
<?php @$_SESSION["_token"] = @$_token; ?>

<?php 
if(isset($_SESSION["notify_type"]))
{
	include("../notification.php");
	exit();	
}
?>

<form action="" method="post">
	<h1>Edit member <small>Admin Only</small></h1>
	<hr>
	<table class="table table-striped table-bordered table-hover" width="100%">
		<tr><th>id</th><td><?php echo $member[0]->mem_id ; ?></td></tr>	
		<tr><th>name</th><td><input class="form-control" type="text" name="mem_name" value="<?php echo $member[0]->mem_name ; ?>" ></td></tr>	
		<tr><th>email</th><td><input class="form-control" type="text" name="mem_email" value="<?php echo $member[0]->mem_email ; ?>" ></td></tr>	
		<tr ><th>date_reg</th><td><input class="form-control" type="text" name="mem_date_reg" value="<?php echo $member[0]->mem_date_reg ; ?>" readonly></td></tr>		
		<tr><th>phone</th><td><input class="form-control" type="text" name="mem_phone" value="<?php echo $member[0]->mem_phone ; ?>" ></td></tr>		
		<tr><th>coin</th><td><input class="form-control" type="text" name="mem_coin" value="<?php echo $member[0]->mem_coin ; ?>" readonly ></td></tr>	
		<tr><th>point</th><td><input class="form-control" type="text" name="mem_point" value="<?php echo $member[0]->mem_point ; ?>"  readonly></td></tr>		
		<tr><th>level</th><td>
			<select name="mem_level" class="form-control">
				<option value="normal" <?php echo ($member[0]->mem_level == 'normal') ? "selected" : ""; ?>>normal</option>
				<option value="admin" <?php echo ($member[0]->mem_level == 'admin') ? "selected" : ""; ?>>admin</option>
			</select>
		</td></tr>
		<tr><th>command</th><td>
		<select name="mem_command_admin" class="form-control">
				<option value="" <?php echo ($member[0]->mem_command_admin == '') ? "" : ""; ?>></option>
				<option value="block" <?php echo ($member[0]->mem_command_admin == 'block') ? "block" : ""; ?>>block</option>
				<option value="forceLogout" <?php echo ($member[0]->mem_command_admin == 'forceLogout') ? "forceLogout" : ""; ?>>forceLogout</option>
				<option value="banUser" <?php echo ($member[0]->mem_command_admin == 'banUser') ? "banUser" : ""; ?>>banUser</option>
			</select>
			</td></tr>
	</table>
	<input type="hidden" name="mem_id" value="<?php echo $member[0]->mem_id; ?>"></input>
	<input type="hidden" name="_token" value="<?php echo $_token;?>"></input>
	<center>
		<br>
		<input type="password" class="form-group" name="password" placeholder="Admin Password" required></input>
		<button type="submit" class="btn btn-success" name="memberEdit" style="width: 80%">Edit</button>
	</center>
</form>
