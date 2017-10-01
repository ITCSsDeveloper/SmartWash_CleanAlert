<?php include("../checkRequest.php"); ?>
<script>
	function update_coin() 
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
				document.getElementById("coin_topbar").innerHTML = xmlhttp.responseText;
				document.getElementById("coin_ordercard").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "../ajax/ajax_coin_reloadcoin.php", true);
		xmlhttp.send();
	}
	var time = 1000;
	setInterval( function() { update_coin() }  , time);
</script>

<?php
$id = $_SESSION["z77-id"];
$sql_comm = "SELECT *  FROM `log_notifycation_tb` WHERE `notify_member_id` = '$id' AND `notify_read` = '0' or '1' ORDER BY `notify_id` DESC";
$notify_count = count($obj->dbms_select($sql_comm));
$all = $obj->dbms_select($sql_comm);

$sql_comm = "SELECT * FROM `log_notifycation_tb` WHERE `notify_type` = 'system' AND `notify_member_id` = '$id' AND `notify_read` = 1";
$type_system = $obj->dbms_select($sql_comm);

$sql_comm = "SELECT * FROM `log_notifycation_tb` WHERE `notify_type` = 'alert' AND `notify_member_id` = '$id' AND `notify_read` = 0 ORDER BY `notify_id` DESC";
$type_alert = $obj->dbms_select($sql_comm);
?>

<div class="main-container container">
	<div id="navbar" class="navbar navbar-default">
		<script type="text/javascript">
			try{ace.settings.check('navbar' , 'fixed')}catch(e){}
		</script>

		<div class="navbar-container container" id="navbar-container">
			<div class="navbar-header pull-left">
				<a href="index.php?main" class="navbar-brand">
					<small>
						<i class="ace-icon fa fa-cogs green" style="margin-left: 10px;"></i>
						<span class="red">CleanAlert</span>
						<span class="white" id="id-text1">Web Service</span>
					</small>
				</a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="grey">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="ace-icon fa fa-tasks"></i>
							<span class="badge badge-grey">4</span>
						</a>

						<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
							<li class="dropdown-header">
								<i class="ace-icon fa fa-check"></i>
								4 Tasks to complete
							</li>

							<li class="dropdown-content ace-scroll" style="position: relative;"><div class="scroll-track" style="display: none;"><div class="scroll-bar"></div></div><div class="scroll-content" style="max-height: 200px;">
								<ul class="dropdown-menu dropdown-navbar">
									<li>
										<a href="#">
											<div class="clearfix">
												<span class="pull-left">Software Update</span>
												<span class="pull-right">65%</span>
											</div>

											<div class="progress progress-mini">
												<div style="width:65%" class="progress-bar"></div>
											</div>
										</a>
									</li>

									<li>
										<a href="#">
											<div class="clearfix">
												<span class="pull-left">Hardware Upgrade</span>
												<span class="pull-right">35%</span>
											</div>

											<div class="progress progress-mini">
												<div style="width:35%" class="progress-bar progress-bar-danger"></div>
											</div>
										</a>
									</li>

									<li>
										<a href="#">
											<div class="clearfix">
												<span class="pull-left">Unit Testing</span>
												<span class="pull-right">15%</span>
											</div>

											<div class="progress progress-mini">
												<div style="width:15%" class="progress-bar progress-bar-warning"></div>
											</div>
										</a>
									</li>

									<li>
										<a href="#">
											<div class="clearfix">
												<span class="pull-left">Bug Fixes</span>
												<span class="pull-right">90%</span>
											</div>

											<div class="progress progress-mini progress-striped active">
												<div style="width:90%" class="progress-bar progress-bar-success"></div>
											</div>
										</a>
									</li>
								</ul>
							</div></li>

							<li class="dropdown-footer">
								<a href="#">
									See tasks with details
									<i class="ace-icon fa fa-arrow-right"></i>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="purple">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"  aria-expanded="true">
							<i class="ace-icon fa fa-bell icon-animated-bell"></i>
							<span class="badge badge-important"><?php echo $notify_count; ?></span>
						</a>

						<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
							<li class="dropdown-header">
								<i class="ace-icon fa fa-exclamation-triangle"></i>
								<?php  echo $notify_count; ?> การแจ้งเตือน
							</li>

							<li class="dropdown-content ace-scroll" style="position: relative;"><div class="scroll-track scroll-active" style="display: block; height: 200px;"><div class="scroll-bar" style="height: 111px; top: 0px;"></div></div><div class="scroll-content" style="max-height: 200px;">
								<ul class="dropdown-menu dropdown-navbar navbar-pink">
									<?php foreach ($all as $key => $value) {
										if($value->notify_type == "system") { $icon = "fa fa-cogs"; } 
										if($value->notify_type == "process") { $icon = "fa fa-credit-card"; } 
										?>
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-green <?php echo $icon; ?>"></i>
														<b><?php echo $value->notify_text; ?></b>
														<small style="margin-left: 32px;"><br><?php echo $value->notify_datetime; ?></small>
													</span>
													<span class="pull-right badge badge-info"></span>
												</div>
											</a>
										</li>
										<?php } ?>
									</ul>
								</div>
							</li>

							<li class="dropdown-footer">
								<a href="#">
									See all notifications
									<i class="ace-icon fa fa-arrow-right"></i>
								</a>
							</li>
						</ul>
					</li>

					<li class="green open">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
							<i class="ace-icon fa fa-envelope"></i>
							<span class="badge badge-success">5</span>
						</a>

						<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close" style="">
							<li class="dropdown-header">
								<i class="ace-icon fa fa-envelope-o"></i>
								5 Messages
							</li>

							<li class="dropdown-content ace-scroll" style="position: relative;"><div class="scroll-track scroll-active" style="display: block; height: 200px;"><div class="scroll-bar" style="height: 111px; top: 0px;"></div></div><div class="scroll-content" style="max-height: 200px;">
								<ul class="dropdown-menu dropdown-navbar">
									<li>
										<a href="#" class="clearfix">
											<img src="../assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar">
											<span class="msg-body">
												<span class="msg-title">
													<span class="blue">Alex:</span>
													Ciao sociis natoque penatibus et auctor ...
												</span>

												<span class="msg-time">
													<i class="ace-icon fa fa-clock-o"></i>
													<span>a moment ago</span>
												</span>
											</span>
										</a>
									</li>

									<li>
										<a href="#" class="clearfix">
											<img src="../assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar">
											<span class="msg-body">
												<span class="msg-title">
													<span class="blue">Susan:</span>
													Vestibulum id ligula porta felis euismod ...
												</span>

												<span class="msg-time">
													<i class="ace-icon fa fa-clock-o"></i>
													<span>20 minutes ago</span>
												</span>
											</span>
										</a>
									</li>

									<li>
										<a href="#" class="clearfix">
											<img src="../assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar">
											<span class="msg-body">
												<span class="msg-title">
													<span class="blue">Bob:</span>
													Nullam quis risus eget urna mollis ornare ...
												</span>

												<span class="msg-time">
													<i class="ace-icon fa fa-clock-o"></i>
													<span>3:15 pm</span>
												</span>
											</span>
										</a>
									</li>

									<li>
										<a href="#" class="clearfix">
											<img src="../assets/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar">
											<span class="msg-body">
												<span class="msg-title">
													<span class="blue">Kate:</span>
													Ciao sociis natoque eget urna mollis ornare ...
												</span>

												<span class="msg-time">
													<i class="ace-icon fa fa-clock-o"></i>
													<span>1:33 pm</span>
												</span>
											</span>
										</a>
									</li>

									<li>
										<a href="#" class="clearfix">
											<img src="../assets/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar">
											<span class="msg-body">
												<span class="msg-title">
													<span class="blue">Fred:</span>
													Vestibulum id penatibus et auctor  ...
												</span>

												<span class="msg-time">
													<i class="ace-icon fa fa-clock-o"></i>
													<span>10:09 am</span>
												</span>
											</span>
										</a>
									</li>
								</ul>
							</div></li>

							<li class="dropdown-footer">
								<a href="inbox.html">
									See all messages
									<i class="ace-icon fa fa-arrow-right"></i>
								</a>
							</li>
						</ul>
					</li>


					<li class="light-blue">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo">
							<span class="user-info">
								<small>สวัสดี,</small>
								<?php echo $_SESSION['z77-name']; ?>
							</span>
							<i class="ace-icon fa fa-caret-down"></i>
						</a>

						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
									<p id='coin_topbar'>ยอดเงินคงเหลือ : N/A</p>
									<p><b>Point :</b>  <?php echo $_SESSION['z77-point'];  ?>p</p>
								</li>
								<li class="divider"></li>
								<?php if($_SESSION['z77-level'] == 'admin') { ?>
								<li>
									<a href="?admin"><i class="ace-icon fa fa-cog"></i>สำหรับผู้ดูแล (admin)</a>
								</li>
								<li><a href="../update.php"><i class="ace-icon fa fa-cloud-download"></i>Reset Database</a></li>
								<li class="divider"></li>
								<?php } ?>

								<li><a href="?main"><i class="ace-icon fa fa-bar-chart-o"></i>กระดานข้อมูล (หน้าแรก)</a></li>
								<li><a href="?topup"><i class="ace-icon fa fa-credit-card"></i>เติมเงิน</a></li>

								<li class="divider"></li>

								<li><a href="?smart_pay"><i class="ace-icon fa fa-gavel"></i>ชำระเงินอัจฉริยะ</a></li>
								<li><a href="?order_card"><i class="glyphicon glyphicon-tags" style="margin-right: 5px;"></i></i>     สั่งซื้อบัตรอัจฉะริยะ</a></li>
								<li><a href="?activitylog"><i class="glyphicon  glyphicon-time"  style="margin-right: 5px;"></i>  ประวัติการใช้งาน</a></li>
								<li><a href="?topup_history"><i class="glyphicon  glyphicon-time"  style="margin-right: 5px;"></i>  ประวัติการเติมเงิน</a></li>

								<li class="divider"></li>

								<li><a href="?help"><i class="ace-icon fa fa-info-circle"></i>คู่มือการใช้งาน</a></li>
								<li><a href="?report"><i class="ace-icon fa fa-exclamation-circle"></i>แจ้งปัญหาการใช้งาน</a></li>
								<li><a href="?passwordchange"><i class="ace-icon fa fa-key"></i>เปลี่ยนรหัสผ่าน</a></li>

								<li class="divider"></li>

								<li><a href="?logout"><i class="ace-icon fa fa-power-off"></i>ออกจากระบบ</a></li>

							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>


		<?php include('main_load.php'); ?>