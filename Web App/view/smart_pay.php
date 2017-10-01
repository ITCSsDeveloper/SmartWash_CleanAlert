<?php include("../checkRequest.php"); ?>

<style type="text/css">
	.infobox .infobox-content {
		color: #555;
		max-width: 200px;
	}
</style>


<div class="main-content-inner" id="NO_android">
	<?php $barcode = md5($_SESSION['z77-id']); ?>
	<center>
		<br>
		<h2>เลือกช่องทางการชำระ</h2>
		<br>
		<a href="index.php?smart_pay&nfc">
			<div class="infobox infobox-purple2" style="width: 264px; height: 81px;">
				<div class="infobox-progress">
					<div class="easy-pie-chart percentage" data-percent="100" data-size="46" style="height: 46px; width: 46px; line-height: 45px;">
						<span class="percent">NFC
							<canvas height="46" width="46"></canvas>
						</span>
						<canvas height="46" width="46"></canvas>
					</div>
				</div>
				<div class="infobox-data">
					<span class="infobox-text">NFC</span>
					<div class="infobox-content">
						NFC สำหรับการชำระเงิน
					</div>
				</div>
			</div>
		</a>


		<a href="index.php?smart_pay&barcode">
			<div class="infobox infobox-blue2" style="width: 264px; height: 81px; ">
				<div class="infobox-progress">
					<div class="easy-pie-chart percentage" data-percent="100" data-size="46" style="height: 46px; width: 46px; line-height: 45px;">
						<span class="percent">code
							<canvas height="46" width="46"></canvas>
						</span>
						<canvas height="46" width="46"></canvas>
					</div>
				</div>
				<div class="infobox-data">
					<span class="infobox-text">Barcode</span>
					<div class="infobox-content">
						Barcode สำหรับการชำระเงิน
					</div>
				</div>
			</div>
		</a>

		<a href="../api/api_otp.php?getotp">
			<div class="infobox infobox-red" style="width: 264px; height: 81px; ">
				<div class="infobox-progress">
					<div class="easy-pie-chart percentage" data-percent="100" data-size="46" style="height: 46px; width: 46px; line-height: 45px;">
						<span class="percent">OTP
							<canvas height="46" width="46"></canvas>
						</span>
						<canvas height="46" width="46"></canvas>
					</div>
				</div>
				<div class="infobox-data">
					<span class="infobox-text">OTP</span>
					<div class="infobox-content">
						OTP สำหรับการชำระเงิน
					</div>
				</div>
			</div>
		</a>
	</center>
</div>

<?php if($_SESSION['z77-level'] != "admin") { ?>
<script type="text/javascript">
	var browser_name = navigator.userAgent;
	var n = browser_name.indexOf("ndroid");
	if(n == -1)
	{
		document.getElementById("NO_android").innerHTML = "<br><center><h1 style='color:red'>SmartPay ใช้ได้เฉพาะในแอพพลิเคชั่น CleanAlert เท่านั้น</h1><br><img src='../img/smartpay_android.png' width='20%' class='img-responsive'><br><br><br></center>";
	}
</script>
<?php } 
else {
	?>
	<div style="margin-top: 250px;">
		<?php 
		if(isset($_GET["otp"]) && isset($_GET["otp_exp"])) {  ?>
		<center>
			<h1><?php echo $_GET["otp"]; ?></h1>
			<small>Exp : <?php echo $_GET["otp_exp"]; ?></small>
		</center>
		<?php } ?>

		<center >
			<h1 style="color:red;">คุณกำลังใช้งานสิทธิ์ Admin </h1>
			<small style="color:red;">Admin เท่านั้นที่จะเห็นหน้า Smartpay บนเว็บไซต์</small>
		</center>
	</div>
	<?php } ?>
