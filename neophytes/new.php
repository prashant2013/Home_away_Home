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
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCOstliPZoOoz49NDKQE-ThLr8PTXN6u9E&sensor=true&region=IN"></script>
    <script>
	
	
var map;
var geocoder;
	function initialize() {
	var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(27, 72),
    mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
	}

	function codeAddress(address) {
	
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
      content: address
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
  </head>
  <body>
  
  <?php
	include 'connect.php';
	$state = $_POST["sstate"];
	echo $state;
	
	
	$q1 = "SELECT Address FROM `indian_hotels` WHERE State_id='$state'";
	$result = mysqli_query($con, $q1);
  
  	 
	while($row = mysqli_fetch_array($result))
	
	{
	
			
?>
	<script>
		
		codeAddress('<?php echo $row["Address"]; ?>');
		
	</script>
 
  
  
   <div id="panel">
      <input id="address" type="textbox" value="New Delhi, India">
      <input type="button" value="GO" onclick="codeAddress(document.getElementById('address').value)">
    </div> 
<div id="map-canvas"></div>
   
  </body>
</html>