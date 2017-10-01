	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - CleanAlert</title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.css" />
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="../assets/css/ace.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.css" />
	</head>
	<body class="login-layout" background="../assets/css/images/meteorshower2.jpg">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-cogs green"></i>
									<span class="red">CleanAlert</span>
									<span class="white" id="id-text2">Web Service</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; Mega Project</h4>
							</div>
							<div class="space-6"></div>


							<?php
							include('../notification.php');
							?>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<center>
													<i class="ace-icon fa fa-coffee green"></i>&nbsp;&nbsp;ยินดีตอนรับ
												</center>
											</h4>
											<div class="space-6"></div>
											<form action="../controller/con_member_login.php" method="post" name="do_login">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" name="emailTxt"  required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="passwordTxt"  required />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>
													<div class="space"></div>
													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary" name="do_login">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">เข้าสู่ระบบ</span>
														</button>
													</div>
													<div class="space-4"></div>
												</fieldset>
											</form>
											<div class="space-6"></div>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													ลืมรหัสผ่าน
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													สมัครสมาชิก
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												กู้คืนรหัสผ่าน
											</h4>

											<div class="space-6"></div>
											<p>
												กรอกอีเมล์ที่ใช้สมัคร เพื่อทำการกู้รหัสผ่าน
											</p>

											<form action="../controller/con_member_passwordrecovery.php" method="post" name="password_recovery">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="emailTxt" type="email" class="form-control" placeholder="Email" required/>
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>
													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-danger" name="password_recovery" style="border-right-width: 95px;">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110" >ส่ง การกู้รหัส!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												กลับสู่หน้าล็อคอิน
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												สมัครสมาชิกใหม่
											</h4>

											<div class="space-6"></div>
											<p> กรอกข้อมูลของคุณ: </p>

											<form action="../controller/con_member_register.php" method="post" >
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="r_nameTxt" type="username" class="form-control" placeholder="Full Name" maxlength="30" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="r_phoneTxt" type="phone" class="form-control" placeholder="Phone" maxlength="12" required/>
															<i class="ace-icon fa fa-phone"></i>
														</span>
													</label>

													<hr>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="r_emailTxt" type="email" class="form-control" placeholder="Email" maxlength="40" required/>
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="r_passwordTxt" type="password" class="form-control" placeholder="Password" maxlength="40" required/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="r_rpasswordTxt" type="password" class="form-control" placeholder="Repeat password" maxlength="40" required/>
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" class="ace" required/>
														<span class="lbl">
															ฉันยอมรับ
															<a target="_blank" href="Terms_of_Use.html">เงื่อนไขการใช้งาน</a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">ล้างออก</span>
														</button>

														<button type="submit" class="width-65 pull-right btn btn-sm btn-success" name="register_member">
															<span class="bigger-110">สมัครสมาชิก</span>
															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												กลับสู่หน้าล็อคอิน
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.main-container -->
				<!-- basic scripts -->

				<!--[if !IE]> -->
				<script type="text/javascript">
					window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");
				</script>

				<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		$(document).on('click', '.toolbar a[data-target]', function(e) {
			e.preventDefault();
			var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			});
	});

			//you don't need this, just used for changing background
			jQuery(function($) {
				$('#btn-login-dark').on('click', function(e) {
					$('body').attr('class', 'login-layout');
					$('#id-text2').attr('class', 'white');
					$('#id-company-text').attr('class', 'blue');

					e.preventDefault();
				});
				$('#btn-login-light').on('click', function(e) {
					$('body').attr('class', 'login-layout light-login');
					$('#id-text2').attr('class', 'grey');
					$('#id-company-text').attr('class', 'blue');

					e.preventDefault();
				});
				$('#btn-login-blur').on('click', function(e) {
					$('body').attr('class', 'login-layout blur-login');
					$('#id-text2').attr('class', 'white');
					$('#id-company-text').attr('class', 'light-blue');

					e.preventDefault();
				});

			});
		</script>

	</body>