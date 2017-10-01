<?php include("../checkAdmin.php"); ?>
<?php include("../checkRequest.php"); ?>
<?php $sql_comm = "SELECT `promotion_tb`.`value` FROM `promotion_tb` WHERE `id` = 1 AND `property` = 'multiplierPoint'";
$MPointValue = $obj->dbms_select($sql_comm)[0]->value; ?>


<div class="main-content-inner">
	<div class="row col-md-12"><?php include("../notification.php"); ?></div>
	<div class="row">
		<div class="col-md-6">
			<h1>โปรโมชั่นหลัก</h1>
			<hr>
			<form action="../controller/con_admin_multiplierPoint.php" method="post">
				<table>
					<input type="hidden" name="_token" value="<?php echo $_token; ?>">
					<label>Point ตัวคูณ : </label>
					<input type="text" name="multiplierPoint"  class="form-control" value="<?php echo $MPointValue; ?>" ></input>
					<label>รหัสผ่าน Admin : </label>
					<input type="password" name="password"  class="form-control" value="" ></input>
					<br>
					<button type="submit" name="changeMultiplierPoint" style="width: 50%" class="btn btn-success">ยืนยัน</button>
				</table>	
			</form>
		</div>
		<div class="col-md-4">
			<h1>ตัวอย่าง โปรโมชั่น</h1>
			<table class="table table-striped table-bordered table-hover" align="center">
				<tr><th>เติมเงิน</th><th>Point ที่ได้รับ</th><th>ตัวคูณ</th></tr>
				<tr><td>20</td><td><?php echo 20 * $MPointValue; ?></td><td><?php echo $MPointValue; ?></td></tr>
				<tr><td>50</td><td><?php echo 50* $MPointValue; ?></td><td><?php echo $MPointValue; ?></td></tr>
				<tr><td>100</td><td><?php echo 100* $MPointValue; ?></td><td><?php echo $MPointValue; ?></td></tr>
				<tr><td>300</td><td><?php echo 300* $MPointValue; ?></td><td><?php echo $MPointValue; ?></td></tr>
				<tr><td>500</td><td><?php echo 500* $MPointValue; ?></td><td><?php echo $MPointValue; ?></td></tr>
				<tr><td>1000</td><td><?php echo 1000* $MPointValue; ?></td><td><?php echo $MPointValue; ?></td></tr>
			</table>
		</div>
	</div>
	<hr>
<?php 
	$extra1  = $obj->dbms_select("SELECT * FROM `promotion_tb` WHERE `id` = 2 AND `property` = 'extra1'")[0]->value;
	$extra2  = $obj->dbms_select("SELECT * FROM `promotion_tb` WHERE `id` = 3 AND `property` = 'extra2'")[0]->value;
?>
	<div class="row">
		<div class="col-md-6">
			<h1>โปรโมชั่นเสริม</h1>
			<h4>ทำงานตามเงื่อนไข</h4>
			<form action="../controller/con_admin_extraPoint.php" method="post">
				<table class="table table-striped table-bordered table-hover" align="center">
					<input type="hidden" name="_token" value="<?php echo $_token; ?>">
					<tr><th>เงื่อนไข (จำนวณครั้ง)</th><th>จะได้รับ Point พิเศษ</th></tr>
					<tr><td>เมื่อสั่งซื้อบัตร SmartPay </td><td><input  class="form-control" value="<?php echo $extra1; ?>" name="extra1"></input></td></tr>
					<tr><td>เมื่อใช้บริการซักผ้า</td><td><input class="form-control" value="<?php echo $extra2; ?>" name="extra2"></input></td></tr>
					<tr><td>รหัสผ่าน Admin </td><td><input type="password" name="password" class="form-control" value="" ></input></td></tr>
				</table>
				<button name="changeExtraPoint" class="btn btn-success" style="width: 50%">ยืนยัน</button>
			</form>
		</div>
	</div>
</div>

