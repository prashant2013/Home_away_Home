<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
    </style>
	<link href="style.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&region=IN"></script>
    <script>
	

	var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
	
	
								//Initializing Google Maps
var map;
var geocoder;
	function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();

	
	var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(27, 72),
    mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);

	
	  
	}

	
									//Function to calculate Route to selected destination
	function calcRoute() {
		
	

  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}



									//Function to plot Addresses on Maps
	
	function codeAddress(address, name) {
	
	geocoder = new google.maps.Geocoder();
	geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
		  animation: google.maps.Animation.DROP,
          position: results[0].geometry.location,
		  title: address
		  		
      }); 
	   var infowindow = new google.maps.InfoWindow({
      content: name
		});
		google.maps.event.addListener(marker, 'click', function() {
		map.setZoom(8);
		map.setCenter(marker.getPosition());
		infowindow.open(map,marker);
		//codeAddress('Sydney, Australia');
		});
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}






google.maps.event.addDomListener(window, 'load', initialize);
//codeAddress('New Delhi, India');
//codeAddress('Rajasthan');
    </script>
	
	<meta name="google-translate-customization" content="9d12afee13a45f67-72eac76f985296c6-gaa5bb0ec65b03dca-18"></meta>
  </head>
  <body>
  
  <?php
	include 'connect.php';
	$state = $_POST["sstate"];
	$type = $_POST["stype"];
	
	
	
	if ($state == "00" & $type == "00")				//Query for All state and All Types
	{ 
	$q1 = "SELECT Address, Name FROM `indian_hotels`;";

	}

	else if ($state == "00")						//Query for All state and Selected Types
	{
	$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE Type='$type';";

	}
	
	else if ($type == "00")							//Query for Selected state and All Types
	{
	$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE State_id='$state';";

	}
	
	else											//Query for Selected state and Selected Types
	{
	
	
	$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE State_id='$state' AND Type='$type';";

	}

	
	
	
	
	$result = mysqli_query($con, $q1);
	$num=mysqli_num_rows($result);
											/* I am checking NULL value here */
	if($num==0)
	{
	?>
	<script>
	alert ("No results Found!!");
	window.location="http://projects.iic.ac.in/nic/Neophytes/"
	</script>
	<?php
	}
else
{										
	 
	while($row = mysqli_fetch_array($result))
	
	{
	
			
?>
	<script>
		
		codeAddress('<?php echo $row["Address"]; ?>', '<?php echo $row["Name"] ; ?>');
		
	</script>
    <?php

	}
}
	?>

  
  
   
	
	
<div id="map-canvas"></div>						<!-- Get Directions -->
   
   <div id="panel">
    <b>Start: </b>
    <input id="start" type="text" >

  
 
   
	<label> Select hotel</label>
	
	<select name="sh" id="end" method="POST" >			<!-- Drop Down for GET Direction -->
	<?php
	
	include 'connect.php';								//Fetching only those Hotels as selected by user
	$state = $_POST["sstate"];
	$type = $_POST["stype"];
	
	if ($state == "00" & $type == "00")	
	{ 
	$q1 = "SELECT Address, Name FROM `indian_hotels`;";

	}

	else if ($state == "00")
	{
	$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE Type='$type';";

	}
	
	else if ($type == "00")
	{
	$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE State_id='$state';";

	}
	
	else
	{
	
	
	$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE State_id='$state' AND Type='$type';";

	}
	
			$result = mysqli_query($con, $q1);
			
	while($row = mysqli_fetch_array($result))
	
	{
		echo "<option value='".$row['Address']."'>".$row['Name']."</option>";
		
	
	}
	
?>
	
		
		
	
    <input type="button" value="Go" onClick="calcRoute();"
    </select>
	
	
	
	
    </div>

   
   
   
  </body>
</html>