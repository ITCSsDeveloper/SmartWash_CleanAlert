<?php
/*
	CheckToken Class By ITCS's Developer
	@ 10-02-2016

	Step1 : Declare in Header index
	-------------------------------------
	<?php @$_token = md5(date("h:i:sa") . 'S!y7w&FSy5Q-~8=@' . @$_SESSION["z77-id"]); ?>
	<?php @$_SESSION["_token"] = @$_token; ?>
	-------------------------------------

	Step2 : add Input Token into Form (When You Want to use)
	-------------------------------------
	<input type="hidden" name="_token" value="<?php echo $_token; ?>">
	-------------------------------------

	Step3 : Include Class and call function  (in Controller class)
	-------------------------------------
	include("../checkToken.php");
	checkToken($_POST["_token"]);
	-------------------------------------

*/
function checkToken($_token){
	@session_start();
	if($_SESSION["_token"] != $_token)
	{
		echo '<center><h1>Token Invalid.</h1> <br>'; 
		echo "<button onclick='goBack()' style='height: 56px; width: 116px;'>Go Back</button> ";
		echo '
		<script>
			function goBack() {
				window.history.back();
			}
		</script>';
		exit();
	}
}
?>