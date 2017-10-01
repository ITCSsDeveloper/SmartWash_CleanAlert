<?php include("../checkRequest.php"); ?>
<?php
// var_export($_SESSION);
	if(isset($_SESSION['z77-page']))
	{	
		if($_SESSION['z77-page'] == 'home')
		{
			include('home.php');
		}
		if($_SESSION['z77-page'] == 'dashbroad')
		{
			include('dashbroad.php');
		}
		else if($_SESSION['z77-page'] == 'topup')
		{
			include('topup.php');
		}
		else if($_SESSION['z77-page'] == 'topup_history')
		{
			include('topup_history.php');
		}
		else if($_SESSION['z77-page'] == 'smart_pay')
		{
			include('smart_pay.php');
		}
		else if($_SESSION['z77-page'] == 'order_card')
		{
			include('order_card.php');
		}
		else if($_SESSION['z77-page'] == 'help')
		{
			include('help.php');
		}
		else if($_SESSION['z77-page'] == 'report')
		{
			include('report.php');
		}
		else if($_SESSION['z77-page'] == 'passwordchange')
		{
			include('passwordchange.php');
		}
		else if($_SESSION['z77-page'] == 'activitylog')
		{
			include('activitylog.php');
		}
		else if($_SESSION['z77-page'] == 'pointhistory')
		{
			include('pointhistory.php');
		}	
		else if($_SESSION['z77-page'] == 'RewardHistory')
		{
			include('RewardHistory.php');
		}
		else if($_SESSION['z77-page'] == 'agreement')
		{
			include('agreement.php');
		}
		

		else if($_SESSION['z77-page'] == 'admin')
		{
			include('../admin/admin_panel.php');
		}
		else if($_SESSION['z77-page'] == 'testwash')
		{
			include('../admin/testWash.php');
		}	
		else if($_SESSION['z77-page'] == 'monitorWash')
		{
			include('../admin/monitorWash.php');
		}
		else if($_SESSION['z77-page'] == 'testsurface')
		{
			include('../admin/testSurface.php');
		}
		else if($_SESSION['z77-page'] == 'advertise')
		{
			include('../admin/advertise.php');
		}
		else if($_SESSION['z77-page'] == 'newsServer')
		{
			include('../admin/newsServer.php');
		}
		else if($_SESSION['z77-page'] == 'promotion')
		{
			include('../admin/promotion.php');
		}
		else if($_SESSION['z77-page'] == 'memberManage')
		{
			include('../admin/memberManage.php');
		}


		
		else if(isset($_GET["test"]))
		{
			include('test.php');
		}

		
	}
	?>