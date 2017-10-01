<?php include("../checkRequest.php"); ?>	
<?php
$mem_id = $_SESSION['z77-id'];
$result = $obj->dbms_select("SELECT *  FROM `topup_tb` WHERE `top_useby_mem_id` = '$mem_id' ORDER BY top_time_use DESC");
?>

<div class="main-content-inner" class="fade active in">
		<div class="page-header">
			<h1>
				ประวัติการเติมเงิน
			</h1>
		</div>
			<table class="table table-striped table-bordered table-hover" width="100%">
				<tr>
					<th width="5%">รหัสที่ใช้</th>
					<th width="5%">ราคา</th>
					<th width="10%">
						<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
						เติมเมื่อ
					</th>
				</tr>
				<?php foreach ($result as $key => $value) { ?>
				<tr>
					<td><?php echo $value->top_code; ?></td>
					<td><?php echo $value->top_value; ?></td>
					<td><?php echo $value->top_time_use; ?></td>
				</tr>
				<?php } ?>
				<?php if(count($result) <= 0) { ?> 
				<tr align="center">
					 <td colspan="3">ไม่มีข้อมูล</td>
				</tr>
				<?php } ?>
			
		</table>
	</div>
