<?php include("../checkRequest.php"); ?>
	<div class="col-sm-6">
	<h3 class="header smaller lighter green">Wash Monitoring</h3>

		<div class="row">
			<div class="col-xs-8">
				<p><b>WashName: </b><x id='wash_name'></x></p>
				<p><b>Power : </b><x id='wash_power'></x></p>
				<p><b>Water : </b><x id='wash_water'></x></p>
				<p><b>Process : </b><x id='wash_process'></x></p>
				<p><b>Remaining time : </b><x id='wash_time'></x></p>
	<script>
	var token = "854815";
		function updateName() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("wash_name").innerHTML = xmlhttp.responseText; }}
			xmlhttp.open("GET", "../controller/con_wash.php?WashInfo_name=" + token, true);
			xmlhttp.send();
		}

		function updatePower() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("wash_power").innerHTML = xmlhttp.responseText; }}
			xmlhttp.open("GET", "../controller/con_wash.php?WashInfo_power=" + token, true);
			xmlhttp.send();
		}

			function updateWater() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("wash_water").innerHTML = xmlhttp.responseText; }}
			xmlhttp.open("GET", "../controller/con_wash.php?WashInfo_water=" + token, true);
			xmlhttp.send();
		}

			function updateProcess() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("wash_process").innerHTML = xmlhttp.responseText; }}
			xmlhttp.open("GET", "../controller/con_wash.php?WashInfo_process=" + token, true);
			xmlhttp.send();
		}

		function updateTime() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("wash_time").innerHTML = xmlhttp.responseText; 
				}}
			xmlhttp.open("GET", "../controller/con_wash.php?WashInfo_time=" + token, true);
			xmlhttp.send();
		}

		var time = 1000;
		setInterval( function() { updateName() }  , time);
		setInterval( function() { updatePower() }  , time);
		setInterval( function() { updateWater() }  , time);
		setInterval( function() { updateProcess() }  , time);
		setInterval( function() { updateTime() }  , time);
	</script>
