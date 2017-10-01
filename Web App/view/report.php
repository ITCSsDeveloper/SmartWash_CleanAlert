<?php include("../checkRequest.php"); ?>
<div class="main-content-inner" class="fade active in">
		<div class="page-header">
			<h1> แจ้งปัญหาการใช้งาน </h1>
		</div>
		<div class="col-xs-12" >


			<?php include('../notification.php'); ?>


			<form class="form-horizontal" role="form" action="../controller/con_report_usersubmit.php" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">ประเภทของปัญหา </label>
					<div class="col-sm-9">
						<select name="titleTxt" id="number" style="width: 200px;" required>
							<option>เติมเงินไม่เข้า</option>
							<option>เครื่องทำงานผิดพลาด</option>
							<option>แจ้งเครื่องดับ</option>
							<option>ส่งข้อเสนอแนะ</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">รายระเอียด</label>
					<div class="col-sm-9">
						<textarea name="descriptionTxt" placeholder="ใส่รายระเอียดของปัญหาที่พบ (จำกัด 500 ตัวอักษร)" rows="4" cols="50" class="col-xs-12 col-sm-6" required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> เบอร์โทรศัพท์ติดต่อกลับ  </label>
					<div class="col-sm-9">
						<input name="phoneTxt" type="text" id="form-field-1"placeholder="เบอร์โทรศัพท์ต้องเป็นตัวเลยเท่านั้น และ มีความยาว 6-10 ตัว"  class="col-xs-12 col-sm-6" required>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
					<div class="col-sm-5 col-xs-12">
						<label style="width: 92%;">
							<button name="submit_report" type="submit" class="btn btn-sm btn-success" style="width: 100%;">
								ยืนยัน
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
