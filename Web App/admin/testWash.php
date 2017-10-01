<?php include("../checkAdmin.php"); ?>
<?php include("../checkRequest.php"); ?>

<?php 
$sql_comm = "SELECT `wash_token` FROM `wash_tb` WHERE `wash_registed` = 'null' ORDER BY wash_id DESC";
$WashToken_NO_REGISTER = $obj->dbms_select($sql_comm);

$sql_comm = "SELECT `wash_token` FROM `wash_tb` WHERE `wash_registed` != 'null' ORDER BY wash_id DESC";
$WashToken_REGISTER = $obj->dbms_select($sql_comm);

$sql_comm = "SELECT * FROM `wash_tb` WHERE `wash_registed` != 'null' ORDER BY wash_id DESC";
$WashAll_FOR_OTP = $obj->dbms_select($sql_comm);
?>

<div class="main-content-inner" class="fade active in">
	<div class="page-content">
		<div class="row">
			<div class="col-xs-4">
				<b>POST to Server : </b> 
			</div>
			<div class="col-xs-4">
				<b>Server FeedBack : </b> 
			</div>
		</div>

		<div class="row">
			<div class="col-xs-4">
				<label id="Postfeedback"></label>
			</div>
			<div class="col-xs-4">
				<label id="feedback"></label>
			</div>
			<div class="col-xs-3">
			</div>
			<div class="col-xs-1">
				<br>
				<button class="btn btn-success" onClick= "javascript:location.reload();">รีเฟรช</button>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-4 table-responsive">
				<form class="table-responsive">
					<h1>Register Device</h1>
					<table class="table">
						<tr><td><label>WashPassword</label></td><td><input type="text" id="WashPassword" value="RpW1C0ToD5g6"></td></tr>
						<tr><td><label>WashToken</label></td><td>
							<select  id="WashToken" style="width: 80%;" >
								<option value=""></option>
								<?php foreach ($WashToken_NO_REGISTER as $key => $value) {
									echo "<option value='$value->wash_token'>$value->wash_token</option>";
								}?>
							</select>
						</td></tr>
						<tr><td><label>WashName</label></td><td><input type="text" id="WashName" value="Wash Test"></td></tr>
						<tr><td><label>WashLocation</label></td><td><input type="text" id="WashLocation" value="16.474782, 102.823207"></td></tr>
						<tr><td colspan="2"><button style="width: 100%;" class="btn btn-info" type="button"  onclick="registerSubmit()" id="RegisterDevice">SEND</button></td></tr>
					</table>
				</form>
			</div>

			<div class="col-xs-4 table-responsive">
				<form >
					<h1>Update Process</h1>
					<table class="table">
						<tr><td><label>WashPassword</label></td><td><input type="text" id="WP" value="RpW1C0ToD5g6"></td></tr>
						<tr><td><label>WashToken</label></td><td>
							<select   id="WT" style="width: 80%;" >
								<option value=""></option>
								<?php foreach ($WashToken_REGISTER as $key => $value) {
									echo "<option value='$value->wash_token'>$value->wash_token</option>";
								}?>
							</select>
						</td></tr>
						<tr><td><label>StatusPower</label></td><td>
							<select id="SP"  style="width: 80%;" >
								<option value=""></option>
								<option value="On">On</option>
								<option value="Off">Off</option>
							</select>
						</td></tr>
						<tr><td><label>StatusWater</label></td><td>
							<select id="SW"  style="width: 80%;" >
								<option value=""></option>
								<option value="S">S</option>
								<option value="M">M</option>
								<option value="L">L</option>
								<option value="XL">XL</option>
							</select>
						</td></tr>
						<tr><td><label>StatusProcess</label></td><td>	
							<select id="SPc"  style="width: 80%;" >
								<option value=""></option>
								<option value="แช่">แช่</option>
								<option value="ซัก">ซัก</option>
								<option value="ล้าง">ล้าง</option>
								<option value="ปั่น">ปั่น</option>
							</select>
						</td></tr>
						<tr><td><label>StatusTime</label></td><td><input type="text" id="ST"  value="45 min"></td></tr>
						<tr><td colspan="2"><button style="width: 100%;" class="btn btn-info" type="button" onclick="updateSubmit()" id="UpWash">SEND</button></td></tr>
					</table>
				</form>
			</div>

			<div class="col-xs-4 table-responsive">
				<form class="table-responsive" id="f1">
					<h1>Try Connect</h1>
					<table class="table">
						<tr><td><label>tryconnect</label></td><td><input type="text" id="tryconnect" value="RpW1C0ToD5g6"></td></tr>
						<tr><td colspan="2"><button class="btn btn-info" style="width: 100%;" type="button" onclick="tryconnectSubmit()">SEND</button></td></tr>
					</table>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-4 table-responsive">
				<form class="table-responsive" id="f1">
					<h1>OTP TEST</h1>
					<table class="table">
						<tr><td><label>WASH ID</label></td><td>
							<select   id="WASH_ID" style="width: 80%;" >
								<option value=""></option>
								<?php foreach ($WashAll_FOR_OTP as $key => $value) {
									echo "<option value='$value->wash_id'>ID = $value->wash_id ; TOKEN = $value->wash_token ; NAME = $value->wash_name ;</option>";
								}?>
							</select>
						</td></tr>
						<tr><td><label>OTP CODE</label></td><td><input type="text" id="OTP_CODE" value=""></td></tr>
						<tr><td colspan="2"><button class="btn btn-info" style="width: 100%;" type="button" onclick="submit_OTP()">SEND</button></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<form action="" method="post">

	<script language="javascript" type="text/javascript">

		function submit_OTP() {
			var WASH_ID = document.getElementById("WASH_ID").value;
			var OTP_CODE = document.getElementById("OTP_CODE").value;
			$.post('../api/api_wash_otp.php',{ WASH_ID:WASH_ID,OTP_CODE:OTP_CODE },
				function(data)
				{
					document.getElementById("feedback").innerHTML =  data;
				});
			$.post('../api/api_wash_otp.php',{ ajax_check_post:'',WASH_ID:WASH_ID,OTP_CODE:OTP_CODE },
				function(data)
				{
					document.getElementById("Postfeedback").innerHTML =  data;
				});
		};

		function tryconnectSubmit() {
			var temp = document.getElementById("tryconnect").value;
			$.post('../api/api_washing.php',{ tryconnect:temp },
				function(data)
				{
					document.getElementById("feedback").innerHTML =  data;
				});
			$.post('../api/api_washing.php',{ ajax_check_post:'',tryconnect:temp },
				function(data)
				{
					document.getElementById("Postfeedback").innerHTML =  data;
				});
		};

		function updateSubmit() {
			var v_WP = document.getElementById("WP").value;
			var v_WT = document.getElementById("WT").value;
			var v_SP = document.getElementById("SP").value;
			var v_SW = document.getElementById("SW").value;
			var v_SPc = document.getElementById("SPc").value;
			var v_ST = document.getElementById("ST").value;
			var v_UpWash = document.getElementById("UpWash").value;
			$.post('../api/api_washing.php',{ WP:v_WP,WT:v_WT,SP:v_SP,SW:v_SW,SPc:v_SPc,ST:v_ST,UpWash:v_UpWash },
				function(data)
				{
					document.getElementById("feedback").innerHTML =  data;
				});
			$.post('../api/api_washing.php',{ ajax_check_post:'',WP:v_WP,WT:v_WT,SP:v_SP,SW:v_SW,SPc:v_SPc,ST:v_ST,UpWash:v_UpWash },
				function(data)
				{
					document.getElementById("Postfeedback").innerHTML =  data;
				});
		};

		function registerSubmit() {
			var WashPassword = document.getElementById("WashPassword").value;
			var WashToken = document.getElementById("WashToken").value;
			var WashName = document.getElementById("WashName").value;
			var WashLocation = document.getElementById("WashLocation").value;
			var RegisterDevice = document.getElementById("RegisterDevice").value;
			$.post('../api/api_washing.php',{ WashPassword:WashPassword,WashToken:WashToken,WashName:WashName,WashLocation:WashLocation,RegisterDevice:RegisterDevice },
				function(data)
				{
					document.getElementById("feedback").innerHTML =  data;
				});	
			$.post('../api/api_washing.php',{ ajax_check_post:'', WashPassword:WashPassword,WashToken:WashToken,WashName:WashName,WashLocation:WashLocation,RegisterDevice:RegisterDevice },
				function(data)
				{
					document.getElementById("Postfeedback").innerHTML =  data;
				});
		};


	</script>
