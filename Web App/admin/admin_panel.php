<?php include("../checkAdmin.php"); ?>
<?php include("../checkRequest.php"); ?>
<?php
$result_topup = $obj->dbms_select("SELECT * FROM `topup_tb` ORDER BY `topup_tb`.`top_id` DESC LIMIT 50");

$result_report = $obj->dbms_select("SELECT error_report.* , member_tb.mem_name FROM error_report , member_tb 
	WHERE error_report.err_mem_id = member_tb.mem_id ORDER BY err_id DESC LIMIT 50");

$result_order = $obj->dbms_select("SELECT order_tb.* , member_tb.mem_name FROM order_tb , member_tb
	WHERE order_tb.order_member_id = member_tb.mem_id
	ORDER BY `order_id` DESC LIMIT 50");

$result_token = $obj->dbms_select("SELECT * FROM `wash_tb` ORDER BY `wash_tb`.`wash_id` DESC LIMIT 50");

$reslut_log_membre = $obj->dbms_select("SELECT * FROM `log_member_tb` ORDER BY `log_member_tb`.`log_id` DESC LIMIT 50");

?>

<div class="main-content-inner" class="fade active in">
	<div class="page-content">
		<div class="page-header">
			<h1>
				หน้าสำหรับผู้ดูแลระบบ
			</h1>
		</div>
		<div class="row">
			<!-- GEN CODE MONEY  -->
			<div class="col-xs-4" >
				<div class="widget-header">
					<h4 class="smaller">
						ลงทะเบีย
						<small>สำหรับสร้าง Token ให้กับเครื่องซักผ้า</small>
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<center>
							<form action="../controller/con_admin_genwashtoken.php" method="post">
								<h1><?php echo @$_SESSION['GenWashToken']; ?></h1>
								<button type="submit" name="GenWashToken" class="btn btn-info btn-sm">GenWashToken</button>
								<?php unset($_SESSION['GenWashToken']); ?>
							</form>
						</center>
					</div>
				</div>
			</div>

			<!-- TABLE TOPUP -->
			<div class="col-xs-8" id="topup" >
				<div class="widget-header">
					<h4 class="smaller">
						WashToken
					</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<table id="simple-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Token</th>
									<th>WashName</th>
									<th>Power</th>
									<th>Registed</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($result_token as $key => $value) { ?>
								<tr> 
									<td><?php echo $value->wash_id; ?></td>
									<td><?php echo $value->wash_token; ?></td>
									<td><?php echo $value->wash_name; ?></td>
									<td><?php echo $value->wash_power; ?></td>
									<td><?php echo $value->wash_registed; ?></td>
								</tr>
								<?php } ?>
								<?php if(!$result_token) {
									echo'<tr><td colspan="5"><center>ไม่มีข้อมูล</center></td></tr>';
								}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<br>
		<!-- GEN CODE WASH  -->
		<div class="col-xs-4" >
			<div class="widget-header">
				<h4 class="smaller">
					การเติมเงิน
					<small>สำหรับสร้างรหัสเติมเงิน</small>
				</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<center>
						<form action="../controller/con_topup_gencodemoney.php" method="post">
							<select name="value">
								<option value="50">50</option>
								<option value="100">100</option>
								<option value="300">300</option>
								<option value="500">500</option>
							</select>
							<button type="submit" name="gen_code_money" class="btn btn-info btn-sm">Create</button>
						</form>
					</center>
				</div>
			</div>
		</div>

		<!-- TABLE TOPUP -->
		<div class="col-xs-8" id="topup" >
			<div class="widget-header">
				<h4 class="smaller">
					ตารางจัดการ code topup
				</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<table id="simple-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>top_id</th>
								<th>top_code</th>
								<th>top_value</th>
								<th>time_create</th>
								<th>time_use</th>
								<th>userby</th>
								<th>delete</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result_topup as $key => $value) { ?>
							<tr> 
								<td><?php echo $value->top_id; ?></td>
								<td><?php echo $value->top_code; ?></td>
								<td><?php echo $value->top_value; ?></td>
								<td><?php echo $value->top_time_create; ?></td>
								<td><?php echo $value->top_time_use; ?></td>
								<td><?php echo $value->top_useby_mem_id ; ?></td>
								<td><?php echo $value->top_delete; ?></td>
								<td>
									<?php if($value->top_delete == 'No') { ?>
									<form action="../controller/con_topup_deletecodemoney.php" method="post">
										<input type="hidden" name="code_id" value="<?php echo $value->top_id; ?>">
										<?php if($value->top_useby_mem_id == '') { ?>
										<button class="btn btn-xs btn-danger" name="delete_code">
											<i class="ace-icon fa fa-trash-o bigger-120"></i>
										</button>
										<?php } ?>
									</form>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
							<?php if(!$result_topup) {
								echo'<tr><td colspan="8"><center>ไม่มีข้อมูล</center></td></tr>';
							}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row" id="report">
		<div class="col-xs-12" >
			<div class="widget-header">
				<h4 class="smaller">รายงานปัญหา<small>ปัญหาการใช้งานที่ส่งเข้ามา</small></h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<table id="simple-table" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>err_id</th>
								<th>err_time_create</th>
								<th>err_mem_id</th>
								<th>err_memname</th>
								<th>err_title</th>
								<th>err_mem_phone</th>
								<th>err_status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result_report as $key => $value) { ?>
							<tr> 
								<td><?php echo $value->err_id; ?></td>
								<td><?php echo $value->err_time_create; ?></td>
								<td><?php echo $value->err_mem_id; ?></td>
								<td><?php echo $value->mem_name; ?></td>
								<td><?php echo $value->err_title_menu; ?></td>
								<td><?php echo $value->err_mem_phone; ?></td>
								<td>
									<?php 
									if($value->err_read == 'unread') { ?>
									<form action="../controller/con_report.php" method="post">
										<input type="hidden" name="make_read_id" value="<?php echo $value->err_id; ?>">
										<button name="make_read">รับทราบ</button>
									</form>
									<?php 
								}else{ echo 'รับทราบแล้ว'; } ?>
							</td>
						</tr>
						<?php } ?>
						<?php if(!$result_report) {
							echo'<tr><td colspan="8"><center>ไม่มีข้อมูล</center></td></tr>';
						}?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> <!-- end row of report -->

<br>

<div class="row" id="order">
	<div class="col-xs-12" >
		<div class="widget-header">
			<h4 class="smaller">
				Order
				<small>การสั่งซื้อบัตร Clean Alert</small>
			</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>order_id</th>
							<th>order_create_date</th>
							<th>mem_name</th>
							<th>order_phone</th>
							<th>order_address</th>
							<th>order_status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($result_order as $key => $value) { ?>
						<tr> 
							<td><?php echo $value->order_id; ?></td>
							<td><?php echo $value->order_create_date; ?></td>
							<td><?php echo $value->mem_name; ?></td>
							<td><?php echo $value->order_phone; ?></td>
							<td><?php echo $value->order_address; ?></td>
							<td>
								<?php 
								if($value->order_status == 'unread') { ?>
								<form action="../controller/con_order.php" method="post">
									<input type="hidden" name="make_read_id" value="<?php echo $value->order_id; ?>">
									<button name="make_read">รับทราบ</button>
								</form>
								<?php 
							}
							else{ echo 'รับทราบแล้ว'; } ?>
						</td>
					</tr>
					<?php } ?>
					<?php if(!$result_order) {
						echo'<tr><td colspan="6"><center>ไม่มีข้อมูล</center></td></tr>';
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>



<br>

<div class="row" id="order">
	<div class="col-xs-12" >
		<div class="widget-header">
			<h4 class="smaller">
				Log Member
				<small>แสดงข้อมูลการดำเนินการของ Member ทุกคน</small>
			</h4>
		</div>
		<div class="widget-body">
			<div class="widget-main">
				<table id="simple-table" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>log_id</th>	
							<th>log_mem_id</th>	
							<th>log_wash_id</th>	
							<th>log_statement</th>	
							<th>log_coin_before</th>	
							<th>log_coin_use</th>	
							<th>log_coin_after</th>	
							<th>log_date_time</th>	
							<th>log_type</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($reslut_log_membre as $key => $value) { ?>
						<tr> 
							<td><?php echo $value->log_id; ?></td>	
							<td><?php echo $value->log_mem_id; ?></td>	
							<td><?php echo $value->log_wash_id; ?></td>	
							<td><?php echo $value->log_statement; ?></td>	
							<td><?php echo $value->log_coin_before; ?></td>	
							<td><?php echo $value->log_coin_use; ?></td>	
							<td><?php echo $value->log_coin_after; ?></td>	
							<td><?php echo $value->log_date_time; ?></td>	
							<td><?php echo $value->log_type; ?></td>
						</tr>
						<?php } ?>

						<?php if(!$reslut_log_membre) {
							echo'<tr><td colspan="9"><center>ไม่มีข้อมูล</center></td></tr>';
						}?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

