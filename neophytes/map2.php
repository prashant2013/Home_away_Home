<!DOCTYPE html>
<html>
<?php
    include 'connect.php';
		   if(isset($_GET["id"]))
		   {
		$ref=$_GET["id"];
		echo $qry= "SELECT State_id, Type FROM `indian_hotels` WHERE Name='$ref'";
		$result = mysqli_query($con, $qry);
		$state = $row['State_id'];
		$type = $row['Type'];
		echo $state;
		   }
		   else
		   {
		  $state = $_POST["sstate"];
		  $type = $_POST["stype"];
		 }
		 ?>
  <head>
    <title>Home Away From Home</title>
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
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&region=IN"></script>
    <script>
	

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
	
	
								//Initializing Google Maps
var map;
var markersArray = [];						
var geocoder;
	function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	var haightAshbury = new google.maps.LatLng(21.7679,78.8718);
	  var mapOptions = {
	    zoom: 4,
	    center: haightAshbury,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map =  new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	 directionsDisplay.setMap(map);
	 <?php
			
		
		
		  $output = array();
		  /*
		  $state = '07';
		  $type = 'S5';
		  */
		  if ($state == "00" & $type == "00")				//Query for All state and All Types
		  {
		  	$q1 = "SELECT ih.Name, ih.Address, gc.latlng, gc.latitude, gc.longitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.name = gc.name ;";
	
		  }
		  else if ($state == "00")						//Query for All state and Selected Types
		  {
		  	$q1 = "SELECT ih.Name, ih.Address, gc.latlng, gc.latitude, gc.longitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.name = gc.name WHERE Type='$type';";
	
		  }
		  else if ($type == "00")							//Query for Selected state and All Types
		  {
		  	$q1 = "SELECT ih.Name, ih.Address, gc.latlng, gc.latitude, gc.longitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.name = gc.name WHERE State_id='$state' ;";
	
		  }
		  else											//Query for Selected state and Selected Types
		  {
		  	$q1 = "SELECT ih.Name, ih.Address, gc.latlng, gc.latitude, gc.longitude FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.name = gc.name WHERE State_id='$state' AND Type='$type';";
		  	//$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE State_id='$state' AND Type='$type';";
		  }
	
		  $result = mysqli_query($con, $q1);
		  $num=mysqli_num_rows($result);
		  if($num==0)
		{
		?>

	alert ("Sorry, No Hotel of this type in Selected State!!");
	window.location="http://projects.iic.ac.in/nic/Neophytes/"
	
	<?php
	}
else
{		
		  
		  
		  
		  while($row = mysqli_fetch_array($result)) {
		  if(!empty($row['latitude']) && !empty($row['longitude'])) {
		  	echo "addMarker(" . $row['latitude'] . ", " . $row['longitude'] . ");";
		  }
		   }
			}?>
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
	
	

google.maps.event.addDomListener(window, 'load', initialize);
function getCurrentLoc() {
  // Try HTML5 geolocation
	  if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		   geocoder = new google.maps.Geocoder();
		   var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			geocoder.geocode({'latLng': latlng}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
		  if (results[1]) {
			document.getElementById('start').value = results[1]['formatted_address'];
		  } else {
			alert('No results found');
		  }
		} else {
		  alert('Geocoder failed due to: ' + status);
		}

	  });
	});
	}
}
getCurrentLoc();
function smoothZoom (map, max, cnt) {
    if (cnt >= max) {
            return;
        }
    else {
        z = google.maps.event.addListener(map, 'zoom_changed', function(event){
            google.maps.event.removeListener(z);
            self.smoothZoom(map, max, cnt + 1);
        });
        setTimeout(function(){map.setZoom(cnt)}, 80); // 80ms is what I found to work well on my system -- it might not work well on all systems
    }
}  
var yo='hello';
function addMarker(lat, lon) {
	var infowindow = new google.maps.InfoWindow({
	content: yo
	});
	var location = new google.maps.LatLng(lat,lon);
		
	//console.log(location);
	var marker = new google.maps.Marker({
	    position: location,
		animation: google.maps.Animation.DROP,
		map: map

		});
	 
	
	google.maps.event.addListener(marker, 'click', function() {
	//map.setZoom(8);
	map.setCenter(marker.getPosition());
	infowindow.open(map,marker);
	smoothZoom(map, 9, map.getZoom());
  });
  markersArray.push(marker);
}
	
$(document).ready(function() {
	$.post("try.php", { state: '<?php echo $_POST['sstate'] ?>', type: '<?php echo $_POST['stype'] ?>' })
	.done(function(data) {
		$('select#end').html(data);
	});
});

</script>
<meta name="google-translate-customization" content="9d12afee13a45f67-72eac76f985296c6-gaa5bb0ec65b03dca-18"></meta>
</head>
<body>
<div id="map-canvas"></div>						<!-- Get Directions -->
   
<div id="panel">
	<b>Start: </b>
	<input id="start" type="text" >
	
	<label> Select hotel</label>
		
	<select name="sh" id="end" method="POST">			
	</select>
	<input type="button" value="Go" onClick="calcRoute();" />
</div>
</body>
</html>
<!-- markersArray.push(marker);