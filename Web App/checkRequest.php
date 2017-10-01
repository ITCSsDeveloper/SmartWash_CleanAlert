<?php
	if(!isset($page))
	{
			echo "<center> <h1>Request Invalid... <br>";
			echo "<button onclick='goBack()' style='height: 56px; width: 116px;'>Go Back</button> ";
			echo '
			<script>
			function goBack() {
			    window.history.back();
			}
			</script>';
			exit();
	}
?>