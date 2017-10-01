<?php include("../checkRequest.php"); ?>

<?php 
$sql_comm = "SELECT * FROM `news_server_tb` WHERE `softdelete` = '0' ORDER BY `news_server_tb`.`id` DESC LIMIT 2";
$newsServer = $obj->dbms_select($sql_comm);

$sql_comm = "SELECT * FROM `advertise_slide_tb` ORDER BY `advertise_slide_tb`.`id` ASC";
$slide = $obj->dbms_select($sql_comm);
$i = 0;
?>

<div class="main-content-inner">
	<div class="row" >
		<div class="col-xs-12" >
			<div class="alert alert-block alert-success" id="start_popup"  >
				<i class="ace-icon fa fa-check green"></i> ยินดีต้อนรับคุณ  <strong class="green"> <?php echo $_SESSION['z77-name']; ?> </strong>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-8">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php foreach ($slide as $key => $value) { ?>
					<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; $i++; ?>" class="<?php echo $value->active; ?>"></li>
					<?php } ?>
				</ol>
				<div class="carousel-inner">
					<?php foreach ($slide as $key => $value) { ?>
					<div class="item <?php echo $value->active; ?>">
						<a href='<?php echo $value->url; ?>'><img class="slide-image" src="../img/demo.png" alt="<?php echo $value->text; ?>"></a> 
					</div>
					<?php } ?>
				</div>
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
		</div>


		<div class="col-md-4">
			<div class="widget-header">
				<h4 class="widget-title lighter smaller">
					<i class="ace-icon fa fa-comment blue"></i>
					ข่าวจากทีมงาน
				</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class="dialogs ace-scroll">
						<div class="scroll-track scroll-active" style="display: block; height: 100px;">
							<div class="scroll-bar" style="height: 100px; top: 0px;"></div>
						</div>
						<div class="scroll-content" style="max-height: 500px;">
							<?php foreach ($newsServer as $key => $value) { ?>
							<div class="itemdiv dialogdiv">
								<div class="user">
									<img alt="John's Avatar" src="../assets/avatars/avatar4.png">
								</div>
								<div class="body">
									<div class="time">
										<i class="ace-icon fa fa-clock-o"></i>
										<span class="blue"><small><?php echo $value->datetime; ?></small></span>
									</div>
									<div class="name">
										<a href="#"><strong><?php echo $value->postby; ?></strong></a>
									</div>
									<div class="text"><strong><?php echo $value->header; ?></strong></div>
									<div class="text"><?php echo $value->text; ?></div>

									<div class="tools">
										<a href="<?php echo $value->url; ?>" class="btn btn-minier btn-info">
											<i class="icon-only ace-icon fa fa-share"></i>
										</a>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>
	<div class="row col-xs-12"><center><h3>โปรโมชั่นพิเศษ</h3></center></div>
	<div class="row">


		<div class="col-xs-6 col-sm-3 pricing-box">

			<div class="widget-box widget-color-dark">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">Basic Package</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<ul class="list-unstyled spaced2">
							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-times red"></i>
								Demo
							</li>
						</ul>

						<hr>
						<div class="price">
							$5
							<small>/month</small>
						</div>
					</div>

					<div>
						<a href="#" class="btn btn-block btn-inverse">
							<i class="ace-icon fa fa-shopping-cart bigger-110"></i>
							<span>Buy</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-6 col-sm-3 pricing-box">
			<div class="widget-box widget-color-orange">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">Starter Package</h5>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<ul class="list-unstyled spaced2">
							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
							Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
							Demo
							</li>
						</ul>

						<hr>
						<div class="price">
							$10
							<small>/month</small>
						</div>
					</div>

					<div>
						<a href="#" class="btn btn-block btn-warning">
							<i class="ace-icon fa fa-shopping-cart bigger-110"></i>
							<span>Buy</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-6 col-sm-3 pricing-box">
			<div class="widget-box widget-color-blue">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">Business Package</h5>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<ul class="list-unstyled spaced2">
							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>
						</ul>

						<hr>
						<div class="price">
							$15
							<small>/month</small>
						</div>
					</div>

					<div>
						<a href="#" class="btn btn-block btn-primary">
							<i class="ace-icon fa fa-shopping-cart bigger-110"></i>
							<span>Buy</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-6 col-sm-3 pricing-box">
			<div class="widget-box widget-color-green">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">Ultimate Package</h5>
				</div>

				<div class="widget-body">
					<div class="widget-main">
						<ul class="list-unstyled spaced2">
							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>

							<li>
								<i class="ace-icon fa fa-check green"></i>
								Demo
							</li>
						</ul>

						<hr>
						<div class="price">
							$25
							<small>/month</small>
						</div>
					</div>

					<div>
						<a href="#" class="btn btn-block btn-success">
							<i class="ace-icon fa fa-shopping-cart bigger-110"></i>
							<span>Buy</span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- /section:pages/pricing.large -->
	</div>


</div>





<script type="text/javascript">
	var count=1000;
	var counter=setInterval(timer, 500);
	function timer()
	{
		count = count-1;
		if (count <= 0)
		{
			document.getElementById('start_popup').style.display = 'none';
			return;
		}
	}
</script>