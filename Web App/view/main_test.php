<?php include("../checkRequest.php"); ?>

<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default">
	<script type="text/javascript">
		try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	</script>

	<div class="navbar-container" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="#" class="navbar-brand">
				<small>
					<i class="ace-icon fa fa-cogs green" style="margin-left: 0px;"></i>
					<span class="red">CleanAlert</span>
					<span class="white" id="id-text1">Web Service</span>
				</small>
			</a>
		</div>

		<?php include("navigator_top.php"); ?>

	</div>
</div>

<div class="main-container" id="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
	<div id="sidebar" class="sidebar                  responsive">
		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
		</script>

		<div class="sidebar-shortcuts" id="sidebar-shortcuts" dis>
			<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large" >
				<button class="btn btn-success"  disabled>
					<i class="ace-icon fa fa-signal"></i>
				</button>
				<button class="btn btn-info" disabled>
					<i class="ace-icon fa fa-pencil"></i>
				</button>
				<button class="btn btn-warning" disabled>
					<i class="ace-icon fa fa-users"></i>
				</button>
				<button class="btn btn-danger" disabled>
					<i class="ace-icon fa fa-cogs"></i>
				</button>
			</div>

			<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
				<span class="btn btn-success"></span>
				<span class="btn btn-info"></span>
				<span class="btn btn-warning"></span>
				<span class="btn btn-danger"></span>
			</div>
		</div>

		<ul class="nav nav-list">
			<?php include("navigator_list.php"); ?>
		</ul>

		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>

		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
		</script>
	</div>

	<div class="main-content">
		<div class="main-content-inner">
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>
				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-home home-icon"></i>
						<a href="?home">หน้าแรก</a>
					</li>
					<li class="active"><?php echo $_SESSION["page"] ?></li>
				</ul>
			</div>

			<div class="page-content">
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="ace-icon fa fa-cog bigger-130"></i>
					</div>
					<div class="ace-settings-box clearfix" id="ace-settings-box">
						<div class="pull-left width-50">
							<div class="ace-settings-item">
								<div class="pull-left">
									<select id="skin-colorpicker" class="hide">
										<option data-skin="no-skin" value="#438EB9">#438EB9</option>
										<option data-skin="skin-1" value="#222A2D">#222A2D</option>
										<option data-skin="skin-2" value="#C6487E">#C6487E</option>
										<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
									</select>
								</div>
								<span>&nbsp; Choose Skin</span>
							</div>

							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
								<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
							</div>

							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
								<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
							</div>

							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
								<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
							</div>

							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container"/>
								<label class="lbl" for="ace-settings-add-container">
									Inside
									<b>.container</b>
								</label>
							</div>
						</div>

						<div class="pull-left width-50">
							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
								<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
							</div>

							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
								<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
							</div>

							<div class="ace-settings-item">
								<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
								<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
							</div>
						</div>
					</div>
				</div>


				<div class="row" >
					<?php  
					include("main_content.php");
					?>
				</div>


				<div class="footer" >
					<div class="footer-inner">
						<div class="footer-content">
							<span class="bigger-120">
								<span class="blue bolder">CleanAlert</span>
								Group &copy; 2015-2016
							</span>
							&nbsp; &nbsp;
							<span class="action-buttons">
								<a href="#">
									<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
								</a>

								<a href="#">
									<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
								</a>

								<a href="#">
									<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
								</a>
							</span>
						</div>
					</div>
				</div>
				<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
					<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
				</a>
			</div><!-- /.main-container -->

			<script>
				function update_coin() 
				{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() 
					{
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
						{
							try {
								document.getElementById("coin_topbar").innerHTML = xmlhttp.responseText;
								document.getElementById("coin_ordercard").innerHTML = xmlhttp.responseText;
							}
							catch(err) {
							}
						}
					}
					xmlhttp.open("GET", "../ajax/ajax_coin_reloadcoin.php", true);
					xmlhttp.send();
				}
				var time = 1000;
				setInterval( function() { update_coin() }  , time);
			</script>