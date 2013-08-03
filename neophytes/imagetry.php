<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
body{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#0FF;
} 
               div#hotels-list
               { width:100%;
			   max-width:100%}
               div#hotels-list div.hotel
               { border-bottom:a40004 solid 1px; background:#000000; padding:10px; margin-bottom:10px;}
               div#hotels-list div.hotel div.name
               { color:#ffffff; font-size:16px; font-family:Arial, Helvetica, sans-serif;font-weight:bold; float:left;margin-top:0px;}
			   div#hotels-list div.hotel div.address
               { color:#ffffff; font-size:12px; font-family:Arial, Helvetica, sans-serif; width:240px;font-weight:bold; float:left;margin-right:10px;}
			    div#hotels-list div.hotel div.Phone
               { color:#81daf5; font-size:12px; font-family:Arial, Helvetica, sans-serif; width:240px;font-weight:bold; float:left;margin-right:10px;}
			   
			    a:link {
COLOR: #81daf5;
}
a:visited {
COLOR: #81daf5;
}
a:hover {
COLOR: #FF0000;
}
a:active {
COLOR: #ffffff;
}
.hotel-details {width:100%; background:#000000; padding:2px; margin-bottom:2px; position:relative; min-height:100px;}
.img-style{
	width:100px;
	height:100px;
	background-color:#999999;
	position:absolute;
	top:10px;
	left:10px;
}

.img-style img{
	height:100px;
	}

.hotel-details h2{
	font-size:18px;
	text-decoration:none;
	margin:0;
}

.hotel-details p{
	color:#FFFFFF;
	display:block;
}

.hotel-details td {
	color:#81daf5;
}
.rightSection{
	float:left;
	margin-left:110px;
}
 .icon-list{
	 list-style-type:none;
	 
 }
 .icon-list li{
	 float:left;
	 padding-right:5px;
	 display:inline-block;
	  }   
         </style>
               

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />
<title>Home Away From Home</title>
</head>

<body>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-popover.js"> </script>
<?php
	
$con=mysqli_connect("localhost","","","");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }




	$state = $_POST["sstate"];
	$type = $_POST["stype"];
	
	
	if ($state == "00" & $type == "00")				//Query for All state and All Types
	{ 
	$q1 = "SELECT * FROM `indian_hotels`;";

	}

	else if ($state == "00")						//Query for All state and Selected Types
	{
	$q1 = "SELECT * FROM `indian_hotels` WHERE Type='$type';";

	}
	
	else if ($type == "00")							//Query for Selected state and All Types
	{
	$q1 = "SELECT * FROM `indian_hotels` WHERE State_id='$state';";

	}
	
	else											//Query for Selected state and Selected Types
	{
	
	
	$q1 = "SELECT * FROM `indian_hotels` WHERE State_id='$state' AND Type='$type';";

	}

	
		
	$res = mysqli_query($con, $q1);
	
	$num=mysqli_num_rows($res);
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

	
	while($row=mysqli_fetch_array($res))
	{

$field1=$row['Website'];
echo "<div id='hotels-list'>";
	echo "<div class='hotel-details'>";
	echo "<div class='img-style'>";
	?>
     <img src="<?php echo $row['img']; ?>" height="100" width="100"/>
     <?php
	 echo "</div>";
	 echo "<div class='rightSection'>";
	 echo "<h2 class='name'>";
	 echo"<a href='$field1'>";
	 echo $row['Name'];
	 echo"</a>";
	 echo"</h2>";
	 echo"<p class='address'>";
	 echo $row['Address'];
	 echo"</p>";
				echo "<table width='300' cellpadding='0' cellspacing='0'>";
				echo "<tr>";
	 			echo "<td>";
	 			echo "<i class='icon-globe icon-white'>";
				 echo "</td>";
	 			echo "<td>";
	 			echo "<a href='$field1'>";
				echo $field1;
				echo"</a>";
	 			echo "</td>";
				echo "<tr>";
				echo "<td>";
				echo "<img src='Untitled-1.jpg' height='12' width='12'>";
				echo "</td>";
				echo "<td>";
				echo "<u>";
				echo $row['Phone'];
				echo "</u>";
				echo "</td>";
				echo "<tr>";
				echo "<td>";
				echo "<i class='icon-map-marker icon-white'>";
				echo "</td>";
				echo "<td>";
				echo "<u>";
				echo "<a href='map2.php?id=$row[Name]'>";
				echo "View In Map";
				echo "</a>";
				echo "</u>";
				echo "</td>";
				echo "</tr>";
				echo "</tr>";
				echo "</tr>";
				echo "</table>";
	 
	 /*echo "<ul class='icon-list'>";
	 	echo "<li>";
		echo "<i class='icon-globe icon-white'>";
		echo "</i>";
		echo "</li>";	
		echo "</li>";
		echo "<a href='$field1'>";
	    echo $field1; 
		echo "</a>";
		echo "</li>";
	 
	*/  echo "</div>";
echo "<br/>";
echo "<br/>";

	
		
			echo"<div style='clear:both;'>";
			echo"</div>";

echo "</div>";
echo "</div>";
	}
}
?>
</body>
</html>
