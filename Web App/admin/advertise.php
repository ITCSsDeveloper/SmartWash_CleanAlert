		<?php include("../checkAdmin.php"); ?>
		<?php include("../checkRequest.php"); ?>

		<?php 
		$sql_comm = "SELECT * FROM `advertise_slide_tb` ORDER BY `id`";
		$Slide = $obj->dbms_select($sql_comm);
		?>

		<div class="main-content-inner" class="fade active in">
			<div class="page-content">
				<div class="row"><?php include("../notification.php"); ?></div>
				<div class="row">
					<div class="col-xs-5 table-responsive">
						<h1>เพิ่มโฆษณา  <small>สูงสุด 5 สไลด์</small></h1>
						<form action="../controller/con_admin_advertise_uploadSlide.php" method="post" enctype="multipart/form-data">
							<table class="table">
								<tr>
									<td>
										<label>ข้อความลิงค์ : </label>
									</td>
									<td>
										<input name="text"  class="form-control"  type="text">
									</td>
								</tr>
								<tr>
									<td>
										<label>URL :</label>
									</td>
									<td>
										<input name="url" class="form-control" type="text">
									</td>
								</tr>
								<tr>
									<td>
										<label>Upload : </label>
									</td>
									<td>
										<input name="fileToUpload" class="form-control"  type="file">
									</td>
								</tr>
								<tr>
									<td>
										<button name="upload_slide" type="submit" class="btn btn-info">Upload Slide</button>
									</td>
								</tr>
							</table>
						</form>
					</div>

					<div class="col-xs-7 table-responsive">
						<h1> จัดการ Slide </h1>
						<table class="table">
							<tr>
								<td width="30%">ข้อความ</td>
								<td width="30%">URL</td>
								<td width="3%">รูปภาพ</td>
								<td width="3%"></td>
							</tr>
							<?php foreach ($Slide as $key => $value) { ?>
							<tr>
								<td><?php echo ($value->text == "") ? "ไม่ได้ลบข้อมูล" : $obj->dbms_subString($value->text); ?></td>
								<td><?php echo ($value->url == "") ? "ไม่ได้ลบข้อมูล" : $obj->dbms_subString($value->url);  ?></td>
								<td align="center"><a href="" onclick="popup('../img/advertise/<?php echo $value->path; ?>','',480,640);">ดู</a></td>
								<td align="center"><a href="../controller/con_admin_advertise_deleteSlide.php?delete=<?php echo $value->id; ?>&path=<?php echo $value->path; ?>&_token=<?php echo $_token; ?>" >ลบ</a></td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function popup(url,name,windowWidth,windowHeight)
			{      
				myleft=(screen.width)?(screen.width-windowWidth)/2:100;   
				mytop=(screen.height)?(screen.height-windowHeight)/2:100;     
				properties = "width="+windowWidth+",height="+windowHeight;  
				properties +=",scrollbars=yes, top="+mytop+",left="+myleft;     
				window.open(url,name,properties);  
			}  
		</script>