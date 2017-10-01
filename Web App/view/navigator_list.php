<?php include("../checkRequest.php"); ?>
	<li class="<?php echo isset($_GET['home']) ? 'active' : '' ?>">
				<a href="?home">
					<i class="menu-icon fa fa-home home-icon"></i>
					<span class="menu-text"> หน้าแรก   </span>
				</a>
				<b class="arrow"></b>
			</li>

				<li class="<?php echo isset($_GET['dashbroad']) ? 'active' : '' ?>">
				<a href="?dashbroad">
					<i class="menu-icon fa fa-bar-chart-o"></i>
					<span class="menu-text"> กระดานข้อมูล   </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo isset($_GET['smart_pay']) ? 'active' : '' ?>">
				<a href="?smart_pay">
					<i class="menu-icon ace-icon fa fa-gavel"></i>
					<span class="menu-text"> ชำระเงินอัจฉริยะ   </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo isset($_GET['order_card']) ? 'active' : '' ?>">
				<a href="?order_card">
					<i class="menu-icon glyphicon glyphicon-tags"></i>
					<span class="menu-text"> สั่งซื้อบัตรอัจฉะริยะ   </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo isset($_GET['topup']) ? 'active' : '' ?>">
				<a href="?topup">
					<i class="menu-icon  fa fa-credit-card"></i>
					<span class="menu-text"> เติมเงิน   </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo isset($_GET['passwordchange']) ? 'active' : '' ?>">
				<a href="?passwordchange">
					<i class="menu-icon ace-icon fa fa-key"></i>
					<span class="menu-text"> เปลี่ยนรหัสผ่าน   </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo isset($_GET['activitylog']) || isset($_GET['topup_history'])
			 || isset($_GET['pointhistory']) || isset($_GET['RewardHistory'])  ? 'open' : '' ?>">
				<a href="#" class="dropdown-toggle">
					<i class="menu-icon glyphicon  glyphicon-time"></i>
					<span class="menu-text">
						ประวัติการใช้งาน
					</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<ul class="submenu">
					<li class="<?php echo isset($_GET['activitylog']) ? 'active' : '' ?>">
						<a href="index.php?activitylog" >
							<i class="menu-icon fa fa-caret-right"></i>
							ประวัติการใช้งาน
						</a>
					</li>
					<li class="<?php echo isset($_GET['topup_history']) ? 'active' : '' ?>">
						<a href="?topup_history">
							<i class="menu-icon fa fa-caret-right"></i>
							ประวัติการเติมเงิน
						</a>
					</li>
					<li class="<?php echo isset($_GET['pointhistory']) ? 'active' : '' ?>">
						<a href="?pointhistory">
							<i class="menu-icon fa fa-caret-right"></i>
							ประวัติการได้รับ Point
						</a>
					</li>
					<li class="<?php echo isset($_GET['RewardHistory']) ? 'active' : '' ?>">
						<a href="?RewardHistory">
							<i class="menu-icon fa fa-caret-right"></i>
							ประวัติการแลกรางวัล
						</a>
					</li>
				</ul>
			</li>

			<li class="<?php echo isset($_GET['report']) ? 'active' : '' ?>">
				<a href="?report">
					<i class="menu-icon fa fa-exclamation-circle"></i>
					<span class="menu-text"> แจ้งปัญหาการใช้งาน   </span>
				</a>
				<b class="arrow"></b>
			</li>

			<li class="<?php echo isset($_GET['help']) ? 'active' : '' ?>">
				<a href="?help">
					<i class="menu-icon  fa fa-info-circle"></i>
					<span class="menu-text"> คู่มือการใช้งาน   </span>
				</a>
				<b class="arrow"></b>
			</li>

				<li class="<?php echo isset($_GET['agreement']) ? 'active' : '' ?>">
				<a href="?agreement">
					<i class="menu-icon  fa fa-info-circle"></i>
					<span class="menu-text"> ข้อตกลงในการใช้งาน</span>
				</a>
				<b class="arrow"></b>
			</li>