<?php 
$sql_comm ="SELECT * FROM `log_point_tb` WHERE `log_point_tb`.`mem_id` = '".$_SESSION["z77-id"]."' ORDER BY `id` DESC";
$PointTable = $obj->dbms_select($sql_comm);
?>


<div class="main-content-inner" class="fade active in">
	<div class="page-header">
		<h1>
			แสดงประวัติการรับ Point
		</h1>
	</div>
	<div class="col-xs-12" >
		<table class="table table-striped table-bordered table-hover" width="100%">
			<tr>
			<th width="5%"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480" style="margin-right: 10px;"> วันที่</th>
			<th width="20%">รายการ</th>
			<th width="5%">POINT</th>
			</tr>
			<?php foreach ($PointTable as $key => $value): ?>
				<tr>
					<td><?php echo $value->datetime; ?></td>
					<td><?php echo $value->description; ?></td>
					<td><?php echo $value->point; ?></td>
				</tr>
			<?php endforeach ?>

			<?php if(!$PointTable) { ?> 
				<tr><td colspan="3"><center>ไม่มีข้อมูล</center></td>
			<?php } ?>
		</table>
	</div>
</div>
