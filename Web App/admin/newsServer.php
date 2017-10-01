<?php include("../checkAdmin.php"); ?>
<?php include("../checkRequest.php"); ?>
			<?php 
			$sql_comm = "SELECT * FROM `news_server_tb` WHERE `softdelete` = '0' ORDER BY `news_server_tb`.`id` DESC";
			$newsServer = $obj->dbms_select($sql_comm);
			?>

			<div class="main-content-inner" class="fade active in">
				<div class="page-content">
					<?php include("../notification.php"); ?>
					<div class="row">
						<div class="col-xs-5 table-responsive">
							<h1>จัดการข่าวสาร</h1>
							<table class="table">
								<form action="../controller/con_admin_news_add.php" method="post" >
									<tr><td><label>โพสโดย</label></td>
										<td><input class="form-control"  type="text" name="postby" value="CleanAlert"></td></tr>
										<tr><td><label>หัวข้อข่าว</label></td>
											<td><input class="form-control" type="text" name="header"></td></tr>
											<tr><td><label>ข้อความ</label></td>
												<td><textarea class="form-control" name="text"></textarea></td></tr>
												<tr><td colspan="2"><input class="form-control" type="hidden" name="_token" value="<?php echo $_token; ?>">
													<button class="btn btn-success" name="news_add" type="submit" >submit</button></td></tr>
												</form>
											</table>
										</div>
									</div>

									<div class="row">
										<div class="col-xs-12 table-responsive">
											<h1>แสดงข่าวสารทั้งหมดในฐานข้อมูล</h1>
											<table  class="table table-striped table-bordered table-hover" >
												<tr>
													<th width="20%">DateTime</th>
													<th width="10%">PostBy</th>
													<th width="10%">header</th>
													<th width="50%">Text</th>
													<th width="10%"></th>
												</tr>
												<?php foreach ($newsServer as $key => $value) { ?>
												<tr>
													<td><?php echo $value->datetime; ?></td>
													<td><?php echo $value->postby; ?></td>
													<td><?php echo $value->header; ?></td>
													<td><?php echo $value->text; ?></td>
													<td><a href="../controller/con_admin_news_delete.php?delete=<?php echo $value->id; ?>&_token=<?php echo $_token; ?>">ลบ</a> </td>
												</tr>
												<?php } ?>
												<?php if(!$newsServer) { ?>
												<tr><td colspan="5"><center>ไม่มีข้อมูล</center></td></tr>
												<?php } ?>
											</table>
										</div>
									</div>
								</div>
							</div>