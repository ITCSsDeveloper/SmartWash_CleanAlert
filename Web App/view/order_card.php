<?php include("../checkRequest.php"); ?>
<div class="main-content-inner" class="fade active in">
		<div class="page-header">
			<h1>
				สั่งซื้อบัตรอัจฉะริยะ
			</h1>
		</div>
		<div class="col-xs-12" >
			<?php include('../notification.php'); ?>

			<div class="well well-lg">
				<h4 class="blue"><small> สวัสดีคุณ, </small><?php echo $_SESSION['z77-name']; ?> </h4>
				นี้เป็นระบบสั่งซื้อบัตรอัจฉริยะ สำหรับใช้งานกับเครื่องซักผ้า CleanAlert <br>
				ค่าใช้จ่ายสำหรับการสั่งซื้อคือ <strong>30฿/บัตร</strong> โดยเราจะตัดเงินจากบัญชีของคุณ <br>
				โปรดระบุรายระเอียดการจัดส่งด้านล่างนี้เลยค่ะ
			</div>

			<div class="alert alert-warning">
				<strong><label id='coin_ordercard'></label></strong>
				<?php  
				if($_SESSION['z77-coin'] < 30) 
				{ 
					echo '<br> ยอดเงินของคุณไม่เพียงพอกรุณา <a href="index.php?topup">เติมเงิน</a>';
					return;
				} ?>
			</div>

			<form class="form-horizontal" role="form" action="../controller/con_order_usersubmit.php" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ชื่อ - นามสกุล  </label>
					<div class="col-sm-9">
						<input name="nameTxt" type="text" id="form-field-1" placeholder="ชื่อจริง-นามสกุลจริง" class="col-xs-12 col-sm-6" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ที่อยู่จัดส่ง  </label>
					<div class="col-sm-9">
						<textarea rows="4" name="addressTxt" cols="50" class="col-xs-12 col-sm-6" placeholder="ที่อยู่จัดส่งจำกัด 500 ตัวอักษร" required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> เบอร์โทรศัพท์ติดต่อกลับ  </label>
					<div class="col-sm-9">
						<input name="phoneTxt" type="text" id="form-field-1"  placeholder="เบอร์โทรศัพท์ต้องเป็นตัวเลยเท่านั้น และ มีความยาว 6-10 ตัว"  class="col-xs-12 col-sm-6" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
					<div class="col-sm-9">
						<label>
							<input name="form-field-checkbox" type="checkbox" class="ace" required>
							<span class="lbl">   ฉันตรวจสอบข้อมูล และต้องการสั่งซื้อบัตรอัจฉริยะแล้ว <strong>30฿/บัตร</strong> แล้ว</span>
						</label>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
					<div class="col-sm-5 col-xs-12">

						<label style="width: 92%;">
							<button name="submit_order" type="submit" class="btn btn-sm btn-success" style="width: 100%;">
								สั่งซื้อ
							</button>
						</label>
						<label style="width: 92%;">
							<a href="index.php?main" class="btn btn-sm btn-danger" style="width: 100%;">
								ยกเลิก
							</a>
						</label>
					</div>
				</div>
			</form>
		</div>
</div>
