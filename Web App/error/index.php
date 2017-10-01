<?php
@session_start();

	if(isset($_SESSION['z66-web_error']))
	{
		
		if($_SESSION['z66-web_error']  == '500' ) 
		{
			include('500.php');
		}
		else if ($_SESSION['z66-web_error'] == '404')
		{
			include('404.php');
		}
		else
		{
			include('500.php');
		}

		session_unset($_SESSION['z66-web_error']);
	}
	else
	{
		include('500.php');
	}

?>