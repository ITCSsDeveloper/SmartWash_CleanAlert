<?php include("../checkRequest.php"); ?>

<div class="main-content-inner" class="fade active in">
		<div class="page-header">
			<h1>
				เติมเงิน
			</h1>
		</div>
		<div class="col-xs-12" >
			<div class="well well-sm">
				<b>สิทธิพิเศษ</b> <br>
				- รับ SMS ฟรี ขณะอยู่ต่างประเทศ <br>
				- โทรกลับ Call Center +6689 100 1331 ฟรี <br>
				- รับไมล์/แต้มสะสม สำหรับโรงแรมและสายการบินชั้นนำฟรี เมื่อมีการโทรออกจากเครือข่ายที่รวมรายการ   ดูรายละเอียด และสมัครได้ที่ www.travellingconnect.com (ดูรายละเอียดเพิ่มเติม)<br> สมัคร บริการโทรศัพท์ข้ามแดนระหว่างประเทศได้ง่ายๆ ผ่านหลากหลายช่องทาง ทั้งทาง Call Center 1331   ทรูช้อป/ทรูมูฟ เอช ช้อป ทุกสาขา  หรือ กด *112*2# โทรออก (ดูรายละเอียดเพิ่มเติม)
			</div>

			<?php
			include('../notification.php');
			?>

			<hr>
			<form class="form-horizontal" role="form" action="../controller/con_topup_submit.php" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ใส่รหัสเติมเงิน  </label>
					<div class="col-sm-8 col-xs-12">
						<input name="code_topup" type="text" id="form-field-1" placeholder="XXXX-XXXX-XX-X" class="col-xs-8" required>
						&nbsp; 
						<button name="topup_submit" type="submit"  class="btn btn-sm btn-success" class="col-xs-4"  block>เติมเงิน</button>
					</div>
				</div>
			</form>
			<hr>
		</div>

		<div class="row">
			<center> 
				<a href="index.php?topup_history">
					<button class="btn btn-yellow" >
						ดูประวัติการเติมเงิน
						<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					</button>
				</a>
			</center>
		</div>
</div>