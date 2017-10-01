<?php include("../checkRequest.php"); ?>

<?php
$sql_comm = "SELECT * FROM `log_member_tb` WHERE `log_mem_id` = '". $_SESSION['z77-id'] ."'";
$result = $obj->dbms_select($sql_comm);
?>


<div class="main-content-inner">
	<div class="page-header">
		<h1>
			ประวัติการใช้งาน
		</h1>
	</div>
	<label>แสดงถึงการทำรายการทั้งหมดที่เกิดขึ้นกับระบบ</label>
		<table class="table table-striped table-bordered table-hover" width="100%">
			<tr>
				<th width="8%"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480" style="margin-right: 10px;">    วันเวลา </th>
				<th width="30%">รายการ</th>
				<th width="2%"><center>ประเภท</center></th>
				<th width="5%"><center>ค่าใช้จ่าย</center></th>
				<th width="5%"><center>ยอดคงเหลือ(ก่อน)</center></th>
				<th width="5%"><center>ยอดคงเหลือ(หลัง)</center></th>
				<th width="5%"><center>หมายเลขเครื่องซักผ้า</center></th>
			</tr>
		
			<?php foreach ($result as $key => $value) { ?>
			<tr>
				<td align="center"><?php echo $value->log_date_time; ?></td>
				<td><?php echo $value->log_statement; ?></td>
				<td align="center"><?php echo $value->log_type; ?></td>
				<td align="center"><?php echo $value->log_coin_use; ?></td>
				<td align="center"><?php echo $value->log_coin_before; ?></td>
				<td align="center"><?php echo $value->log_coin_after; ?></td>
				<td align="center"><?php echo $value->log_wash_id; ?></td>
			</tr>
			<?php } ?> 
			<?php if(count($result) <= 0) { ?> 
			<tr align="center">
				<td colspan="7">ไม่มีข้อมูล</td>
			</tr>
			<?php } ?>
		
	</table>
</div>
