<?php
session_start();
if(isset($_SESSION['z77']) != true ) 
{
	header("Location: ../view/index.php?logout");
	exit();
}

if(@$_GET["code"] != 'JIjjsu77isjUsa') 
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
$barcode = md5($_SESSION['z77-id']);
?>

<center>
	<br>
	<p>Barcode : <?php echo $_SESSION['z77-name']; ?></p><br>
	<img class="img-responsive" alt="YOucode" src="../barcode-master/barcode.php?text=<?php echo $barcode; ?>&orientation=vertical&size=100" width="40%" />
</center>