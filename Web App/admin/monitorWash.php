<?php include("../checkAdmin.php"); ?>
<?php include("../checkRequest.php"); ?>
<script src="http://maps.googleapis.com/maps/api/js">  </script>

<script type="text/javascript">
	function initialize() {
		var map = new google.maps.Map(document.getElementById('googleMap'), {
			zoom: 15,
			center: {lat: 16.46035, lng: 102.81701 },
			mapTypeId: google.maps.MapTypeId.TERRAIN
		});

		var bounds = {
			north: 16.481793,
			south: 16.440107,
			east: 102.833690,
			west: 102.809443
		};
		map.fitBounds(bounds);

		var path = document.location.pathname;
		var dir = path.substring(0, path.lastIndexOf('/'));
		var image = "https://cdn0.iconfinder.com/data/icons/flatiligious-ii/32/washing-machine-32.png"; 
		var marker = new google.maps.Marker({
			position: {
				lat: 16.474782,
				lng: 102.823207 
			},
			map: map,
			icon: image
		});
		var temp = "นี้คือเครื่องซักผ้าของ GmTAN";
		attachSecretMessage(marker,temp);
	}

	function attachSecretMessage(marker, secretMessage) {
		var infowindow = new google.maps.InfoWindow({
			content: secretMessage
		});

		marker.addListener('click', function() {
			infowindow.open(marker.get('map'), marker);
		});
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>


<div class="main-content-inner" class="fade active in">
	<div class="page-content">
		<div class="page-header">
			<h1>แสดงการทำงานของเครื่อง</h1>
		</div>
		<div  class="row">  
			<div class="col-md-8" >
				<div id="googleMap" style="width:100%;height:450px;"></div>
			</div>
			<div class="col-md-4" >
				<div class="widget-header">
					<h4 class="smaller">Wash Power On</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<table id="ajax_wash_power" class="table table-striped table-bordered table-hover" width="100%"></table>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div  class="row">  
			<div class="widget-header">
				<h4 class="smaller">Monitor Wash All</h4>
			</div>
			<div class="widget-body" >
				<div class="widget-main" >
					<table id="ajax_wash_monitor" class="table table-striped table-bordered table-hover" width="100%"></table>
				</div>
			</div>
			
		</div>
	</div>
</div>




<script type="text/javascript">
	var time = 1000;

	window.onload = function(){
		ajax_wash_monitor();
		ajax_wash_power();
	};

	function ajax_wash_monitor()
	{
		try
		{
			$.post('../ajax/ajax_wash_monitor.php',{ monitor_wash:'' },
				function(data)
				{
					document.getElementById("ajax_wash_monitor").innerHTML =  data;
				});
		}
		catch(err) 
		{
		}
	};
	function ajax_wash_power()
	{
		try
		{
			$.post('../ajax/ajax_wash_monitor.php',{ monitor_power:'' },
				function(data)
				{
					document.getElementById("ajax_wash_power").innerHTML =  data;
				});
		}
		catch(err) 
		{
		}
	};
	
	setInterval( function() { ajax_wash_monitor() }  , time);
	setInterval( function() { ajax_wash_power() }  , time);
</script>
