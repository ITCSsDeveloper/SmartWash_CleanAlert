<?php include("../checkRequest.php"); ?>
<div class="main-content-inner">
		<div class="page-header">
			<h1>เปลี่ยนรหัสผ่าน</h1>
		</div>
		<div class="col-xs-1" ></div>
		<div class="col-xs-10" >
			<?php
				include('../notification.php');
			?>
		<form class="form-horizontal" role="form" action="../controller/con_member_passwordchange.php" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> รหัสผ่านปัจจุบัน  </label>
					<div class="col-sm-9">
						<input name="oldPasswordTxt" type="password" id="form-field-1" placeholder="" class="col-xs-12 col-sm-6" required>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> รหัสผ่านใหม่  </label>
					<div class="col-sm-9">
						<input name="newPasswordTxt"  type="password" id="form-field-1" placeholder="" class="col-xs-12 col-sm-6" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ยืนยันรหัสผ่านใหม่  </label>
					<div class="col-sm-9">
						<input name="renewPasswordTxt"  type="password" id="form-field-1" placeholder="" class="col-xs-12 col-sm-6" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
					<div class="col-sm-9">
						<label>
							<input name="form-field-checkbox" type="checkbox" class="ace" required>
							<span class="lbl">   ยืนยันการเปลี่ยนรหัสผ่าน</span>
						</label>
						<br>
						<label>*หลังจากเปลี่ยนรหัสผ่านสำเร็จ จะทำการ logout ใหม่อัตโนมัติ</label>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
					<div class="col-sm-5 col-xs-12">
						
						<label style="width: 92%;">
							<button name="password_change" type="submit" class="btn btn-sm btn-success" style="width: 100%;">
								เปลี่ยนรหัสผ่าน
							</button>
						</label>
						<label style="width: 92%;">
							<a href="javascript:history.back()" class="btn btn-sm btn-danger" style="width: 100%;">
								ยกเลิก
							</a>
						</label>
					</div>
				</div>
			</form>
		</div>
		<div class="col-xs-1" ></div>
</div>
