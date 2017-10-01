<?php include("../checkRequest.php"); ?>
<!-- #section:basics/navbar.dropdown -->
<div class="navbar-buttons navbar-header pull-right" role="navigation">
	<ul class="nav ace-nav">

		<?php include("notifycationbar.php"); ?>

		<li class="light-blue">
			<a data-toggle="dropdown" href="#" class="dropdown-toggle">
				<img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo" />
				<span class="user-info">
					<small>สวัสดี,</small>
					<?php echo $_SESSION['z77-name']; ?>
				</span>
				<i class="ace-icon fa fa-caret-down"></i>
			</a>

			<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
				<li>
					<a>
						<p id='coin_topbar'>ยอดเงินคงเหลือ : N/A</p>
						<p><b>Point :</b>  <?php echo $_SESSION['z77-point'];  ?>p</p>
					</a>
				</li>

				<?php if($_SESSION['z77-level'] == 'admin') { ?>
					<li class="divider"></li>
					<li><a href="?admin"><i class="ace-icon fa fa-cog"></i>สำหรับผู้ดูแล (admin)</a></li>
					<li><a href="?advertise"><i class="ace-icon fa fa-cog"></i>จัดการโฆษณา (admin)</a></li>
					<li><a href="?newsServer"><i class="ace-icon fa fa-cog"></i>จัดการข่าสาร (admin)</a></li>
					<li><a href="?promotion"><i class="ace-icon fa fa-cog"></i>จัดการโปรโมชั่น (admin)</a></li>
					<li><a href="?memberManage"><i class="ace-icon fa fa-cog"></i>จัดการสมาชิก (admin)</a></li>
					<li><a href="?testwash"><i class="ace-icon fa fa-cog"></i>Test Wash</a></li>
					<li><a href="?monitorWash"><i class="ace-icon fa fa-cog"></i>Monitor Wash</a></li>
					<li><a href="?testsurface"><i class="ace-icon fa fa-cog"></i>Test Surface</a></li>

					<li class="divider"></li>
					<li><a href="../update.php"><i class="ace-icon fa fa-cloud-download"></i>Reset Database</a></li>
					<li class="divider"></li>
				<?php } ?>
				<li class="divider"></li>

				<li><a href="?logout"><i class="ace-icon fa fa-power-off"></i>ออกจากระบบ</a></li>
			</ul>
		</li>
	</ul>
</div>