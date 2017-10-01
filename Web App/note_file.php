	<?php 
	if(@$_SESSION['z66-login-error'] == '01')
	{
		?>
		<div class="alert alert-danger" id="notifi-error" display='block'>
			<strong>
				<i class="ace-icon fa fa-times"></i>
				พบข้อผิดพลาด !
			</strong>
			<br>
			Username หรือ Password ไม่ถูกต้อง
			<br>
		</div>
		<?php
		session_unset($_SESSION['z66-login-error']);
	}
	?>
	<script type="text/javascript">
		var count=6;
		var counter=setInterval(timer, 1000);
		function timer()
		{
			count=count-1;
			if (count <= 0)
			{
				document.getElementById('notifi-error').style.display = 'none';
				return;
			}
		}
	</script>