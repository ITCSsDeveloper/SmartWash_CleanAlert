<?php include("../checkRequest.php"); ?>
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



<li class="grey">
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">
		<i class="ace-icon fa fa-tasks"></i>
		<span class="badge badge-grey">1</span>
	</a>

	<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
		<li class="dropdown-header">
			<i class="ace-icon fa fa-check"></i>
			1 เครื่องกำลังทำาน
		</li>

		<li class="dropdown-content">
			<ul class="dropdown-menu dropdown-navbar">
				<li>
					<a href="#">
						<div class="clearfix">
							<span class="pull-left">Wash 001</span>
							<span class="pull-right">100%</span>
						</div>
						<div class="progress progress-mini">
							<div style="width:100%" class="progress-bar"></div>
						</div>
					</a>
				</li>
			</ul>
		</li>

		<li class="dropdown-footer">
			<a href="#">
				See tasks with details
				<i class="ace-icon fa fa-arrow-right"></i>
			</a>
		</li>
	</ul>
</li>

<li class="purple">
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">
		<i class="ace-icon fa fa-bell icon-animated-bell"></i>
		<span class="badge badge-important">8</span>
	</a>

	<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
		<li class="dropdown-header">
			<i class="ace-icon fa fa-exclamation-triangle"></i>
			8 Notifications
		</li>

		<li class="dropdown-content">
			<ul class="dropdown-menu dropdown-navbar navbar-pink">
				<li>
					<a href="#">
						<div class="clearfix">
							<span class="pull-left">
								<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
								New Comments
							</span>
							<span class="pull-right badge badge-info">+12</span>
						</div>
					</a>
				</li>

			</ul>
		</li>

		<li class="dropdown-footer">
			<a href="#">
				See all notifications
				<i class="ace-icon fa fa-arrow-right"></i>
			</a>
		</li>
	</ul>
</li>

<li class="green">
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">
		<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
		<span class="badge badge-success">5</span>
	</a>

	<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
		<li class="dropdown-header">
			<i class="ace-icon fa fa-envelope-o"></i>
			5 Messages
		</li>

		<li class="dropdown-content">
			<ul class="dropdown-menu dropdown-navbar">

				<li>
					<a href="#" class="clearfix">
						<img src="../assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
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

			</ul>
		</li>

		<li class="dropdown-footer">
			<a href="inbox.html">
				See all messages
				<i class="ace-icon fa fa-arrow-right"></i>
			</a>
		</li>
	</ul>
</li>
