<!DOCTYPE html>
<html lang="en">
<head>
	<title>CleanAlert</title>
	<meta charset="utf-8" />
	<meta http-equiv="CACHE-CONTROL" CONTENT="NO-CACHE">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<link rel="stylesheet" href="../assets/css/bootstrap.css" />
	<link rel="stylesheet" href="../assets/css/font-awesome.css" />
	<link rel="stylesheet" href="../assets/css/ace-fonts.css" />
	<link rel="stylesheet" href="../assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
	<script src="../assets/js/ace-extra.js"></script>
	<?php include("../devMode.php"); ?>
	<?php if($https = false){include("../reDirectHTTPS.php"); } ?>
	<?php $page = true;  ?>
	<?php session_start(); ?>
	<?php @$_token = md5(date("h:i:sa") . 'S!y7w&FSy5Q-~8=@' . @$_SESSION["z77-id"]); ?>
	<?php @$_SESSION["_token"] = @$_token; ?>
	<?php include("../controller/dbms.php"); ?>
	<?php $obj = new dbms(); ?>
	<?php include("../checkCommandAdmin.php"); ?>
</head>

<body  class="no-skin">
	<?php
				if(!isset($_SESSION['z77'])) // if No login -> login.php
				{ 
					header("Location: login.php?login");
					exit();
				}
				else
				{
					if($_SESSION['z77'] == 'F^%G7wbJ+%n+dfBF')
					{
						if(isset($_GET['logout'])) 
						{
							header('Location: ../controller/con_member_logout.php') ;
						}
						else if(isset($_GET['home'])) {	
							$_SESSION['z77-page']  = 'home';
							$_SESSION["page"] = "หน้าแรก";
						}
						else if(isset($_GET['dashbroad'])) {	
							$_SESSION['z77-page']  = 'dashbroad';
							$_SESSION["page"] = "กระดานข้อมูล";
						}
						else if (isset($_GET['topup'])){
							$_SESSION['z77-page']  = 'topup';
							$_SESSION["page"] = "เติมเงิน";
						}
						else if (isset($_GET['topup_history'])){
							$_SESSION['z77-page']  = 'topup_history';
							$_SESSION["page"] = "ประวัติการเติมเงิน";
						}
						else if (isset($_GET['smart_pay'])){
							$_SESSION['z77-page']  = 'smart_pay';
							$_SESSION["page"] = "ชำระเงินอัจฉริยะ";
						}
						else if (isset($_GET['order_card'])){
							$_SESSION['z77-page']  = 'order_card';
							$_SESSION["page"] = "สั่งซื้อบัตรอัจฉะริยะ";
						}
						else if (isset($_GET['help'])){
							$_SESSION['z77-page']  = 'help';
							$_SESSION["page"] = "คู่มือการใช้งาน";
						}
						else if (isset($_GET['report'])){
							$_SESSION['z77-page']  = 'report';
							$_SESSION["page"] = "แจ้งปัญหาการใช้งาน";
						}
						else if (isset($_GET['passwordchange'])){
							$_SESSION['z77-page']  = 'passwordchange';
							$_SESSION["page"] = "เปลี่ยนรหัสผ่าน";
						}
						else if (isset($_GET['activitylog'])){
							$_SESSION['z77-page']  = 'activitylog';
							$_SESSION["page"] = "ประวัติการใช้งาน";
						}
						else if (isset($_GET['admin'])){
							$_SESSION['z77-page']  = 'admin';
							$_SESSION["page"] = "หน้าสำหรับผู้ดูแลระบบ";
						}
						else if (isset($_GET['testwash'])){
							$_SESSION['z77-page']  = 'testwash';
							$_SESSION["page"] = "ทดสอบระบบ";
						}
						else if (isset($_GET['monitorWash'])){
							$_SESSION['z77-page']  = 'monitorWash';
							$_SESSION["page"] = "แสดงการทำงานของเครื่อง";
						}
						else if (isset($_GET['testsurface'])){
							$_SESSION['z77-page']  = 'testsurface';
							$_SESSION["page"] = "ทดสอบ หน้าเครื่อง";
						}
						else if (isset($_GET['advertise'])){
							$_SESSION['z77-page']  = 'advertise';
							$_SESSION["page"] = "จัดการโฆษณา";
						}
						else if (isset($_GET['newsServer'])){
							$_SESSION['z77-page']  = 'newsServer';
							$_SESSION["page"] = "จัดการข่าวสาร";
						}
						else if (isset($_GET['promotion'])){
							$_SESSION['z77-page']  = 'promotion';
							$_SESSION["page"] = "จัดการโปรโมชั่น";
						}	
						else if (isset($_GET['pointhistory'])){
							$_SESSION['z77-page']  = 'pointhistory';
							$_SESSION["page"] = "ประวัติการได้รับ Point";
						}
						else if (isset($_GET['RewardHistory'])){
							$_SESSION['z77-page']  = 'RewardHistory';
							$_SESSION["page"] = "ประวัติการแลกรางวัล";
						}
						else if (isset($_GET['agreement'])){
							$_SESSION['z77-page']  = 'agreement';
							$_SESSION["page"] = "ข้อตกลงในการใช้ซอฟต์แวร์";
						}
						else if (isset($_GET['memberManage'])){
							$_SESSION['z77-page']  = 'memberManage';
							$_SESSION["page"] = "จัดการสมาชิก";
						}
						else if (isset($_GET['session_clear'])){
							session_unset();
							echo "Session Clear";
							return;
						}
					}
					else 
					{ 
						echo 'Session Error !! --> code : session incorrect';
						echo '<center><h1>Try logout for delete all session.</h1> <br> <a href="index.php?logout">back to home.</a> </center>'; 
						return;
					}
					include('main_test.php');
				}
				?>

				<script type="text/javascript">
					window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");
				</script>
				
				<script type="text/javascript">
					if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
				</script>
				<script src="../assets/js/bootstrap.js"></script>

				<script src="../assets/js/jquery-ui.custom.js"></script>
				<script src="../assets/js/jquery.ui.touch-punch.js"></script>
				<script src="../assets/js/jquery.easypiechart.js"></script>
				<script src="../assets/js/jquery.sparkline.js"></script>
				<script src="../assets/js/flot/jquery.flot.js"></script>
				<script src="../assets/js/flot/jquery.flot.pie.js"></script>
				<script src="../assets/js/flot/jquery.flot.resize.js"></script>
				<script src="../assets/js/ace/elements.scroller.js"></script>
				<script src="../assets/js/ace/elements.colorpicker.js"></script>
				<script src="../assets/js/ace/elements.fileinput.js"></script>
				<script src="../assets/js/ace/elements.typeahead.js"></script>
				<script src="../assets/js/ace/elements.wysiwyg.js"></script>
				<script src="../assets/js/ace/elements.spinner.js"></script>
				<script src="../assets/js/ace/elements.treeview.js"></script>
				<script src="../assets/js/ace/elements.wizard.js"></script>
				<script src="../assets/js/ace/elements.aside.js"></script>
				<script src="../assets/js/ace/ace.js"></script>
				<script src="../assets/js/ace/ace.ajax-content.js"></script>
				<script src="../assets/js/ace/ace.touch-drag.js"></script>
				<script src="../assets/js/ace/ace.sidebar.js"></script>
				<script src="../assets/js/ace/ace.sidebar-scroll-1.js"></script>
				<script src="../assets/js/ace/ace.submenu-hover.js"></script>
				<script src="../assets/js/ace/ace.widget-box.js"></script>
				<script src="../assets/js/ace/ace.settings.js"></script>
				<script src="../assets/js/ace/ace.settings-rtl.js"></script>
				<script src="../assets/js/ace/ace.settings-skin.js"></script>
				<script src="../assets/js/ace/ace.widget-on-reload.js"></script>
				<script src="../assets/js/ace/ace.searchbox-autocomplete.js"></script>

				<script type="text/javascript">
					jQuery(function($) {
						$('.easy-pie-chart.percentage').each(function(){
							var $box = $(this).closest('.infobox');
							var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
							var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
							var size = parseInt($(this).data('size')) || 50;
							$(this).easyPieChart({
								barColor: barColor,
								trackColor: trackColor,
								scaleColor: false,
								lineCap: 'butt',
								lineWidth: parseInt(size/10),
								animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
								size: size
							});
						})

						$('.sparkline').each(function(){
							var $box = $(this).closest('.infobox');
							var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
							$(this).sparkline('html',
							{
								tagValuesAttribute:'data-values',
								type: 'bar',
								barColor: barColor ,
								chartRangeMin:$(this).data('min') || 0
							});
						});
						$.resize.throttleWindow = false;
						var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
						var data = [
						{ label: "social networks",  data: 38.7, color: "#68BC31"},
						{ label: "search engines",  data: 24.5, color: "#2091CF"},
						{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
						{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
						{ label: "other",  data: 10, color: "#FEE074"}
						]
						function drawPieChart(placeholder, data, position) {
							$.plot(placeholder, data, {
								series: {
									pie: {
										show: true,
										tilt:0.8,
										highlight: {
											opacity: 0.25
										},
										stroke: {
											color: '#fff',
											width: 2
										},
										startAngle: 2
									}
								},
								legend: {
									show: true,
									position: position || "ne", 
									labelBoxBorderColor: null,
									margin:[-30,15]
								}
								,
								grid: {
									hoverable: true,
									clickable: true
								}
							})
						}
						drawPieChart(placeholder, data);
						placeholder.data('chart', data);
						placeholder.data('draw', drawPieChart);

						var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
						var previousPoint = null;

						placeholder.on('plothover', function (event, pos, item) {
							if(item) {
								if (previousPoint != item.seriesIndex) {
									previousPoint = item.seriesIndex;
									var tip = item.series['label'] + " : " + item.series['percent']+'%';
									$tooltip.show().children(0).text(tip);
								}
								$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
							} else {
								$tooltip.hide();
								previousPoint = null;
							}

						});

						$(document).one('ajaxloadstart.page', function(e) {
							$tooltip.remove();
						});

						var d1 = [];
						for (var i = 0; i < Math.PI * 2; i += 0.5) {
							d1.push([i, Math.sin(i)]);
						}

						var d2 = [];
						for (var i = 0; i < Math.PI * 2; i += 0.5) {
							d2.push([i, Math.cos(i)]);
						}

						var d3 = [];
						for (var i = 0; i < Math.PI * 2; i += 0.2) {
							d3.push([i, Math.tan(i)]);
						}

						var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
						$.plot("#sales-charts", [
							{ label: "Domains", data: d1 },
							{ label: "Hosting", data: d2 },
							{ label: "Services", data: d3 }
							], {
								hoverable: true,
								shadowSize: 0,
								series: {
									lines: { show: true },
									points: { show: true }
								},
								xaxis: {
									tickLength: 0
								},
								yaxis: {
									ticks: 10,
									min: -2,
									max: 2,
									tickDecimals: 3
								},
								grid: {
									backgroundColor: { colors: [ "#fff", "#fff" ] },
									borderWidth: 1,
									borderColor:'#555'
								}
							});


						$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
						function tooltip_placement(context, source) {
							var $source = $(source);
							var $parent = $source.closest('.tab-content')
							var off1 = $parent.offset();
							var w1 = $parent.width();

							var off2 = $source.offset();
							if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
							return 'left';
						}


						$('.dialogs,.comments').ace_scroll({
							size: 300
						});

						var agent = navigator.userAgent.toLowerCase();
						if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
							$('#tasks').on('touchstart', function(e){
								var li = $(e.target).closest('#tasks li');
								if(li.length == 0)return;
								var label = li.find('label.inline').get(0);
								if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
							});

						$('#tasks').sortable({
							opacity:0.8,
							revert:true,
							forceHelperSize:true,
							placeholder: 'draggable-placeholder',
							forcePlaceholderSize:true,
							tolerance:'pointer',
							stop: function( event, ui ) {
								$(ui.item).css('z-index', 'auto');
							}
						}
						);
						$('#tasks').disableSelection();
						$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
							if(this.checked) $(this).closest('li').addClass('selected');
							else $(this).closest('li').removeClass('selected');
						});

						$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
							var offset = $(this).offset();

							var $w = $(window)
							if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
								$(this).addClass('dropup');
							else $(this).removeClass('dropup');
						});

					})
				</script>
				<link rel="stylesheet" href="../assets/css/ace.onpage-help.css" />
				<link rel="stylesheet" href="../docs/assets/js/themes/sunburst.css" />
				<script type="text/javascript"> ace.vars['base'] = '..'; </script>
				<script src="../assets/js/ace/elements.onpage-help.js"></script>
				<script src="../assets/js/ace/ace.onpage-help.js"></script>
				<script src="../docs/assets/js/rainbow.js"></script>
				<script src="../docs/assets/js/language/generic.js"></script>
				<script src="../docs/assets/js/language/html.js"></script>
				<script src="../docs/assets/js/language/css.js"></script>
				<script src="../docs/assets/js/language/javascript.js"></script>

			</body>
			</html>