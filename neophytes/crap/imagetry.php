<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
body
		{font: 400 13px/1.5 "Lucida Grande","Lucida Sans Unicode","Lucida Sans",Verdana,sans-serif; color: #dde9ec; padding-bottom: 40px; background-color: #2d3033;}
		body .hotel-list
		{width: 90%; border: 9px solid #33373b; margin: 20px auto; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;}
		
		body .hotel-list .box
		{border: 1px solid #222527; background-color: #282b2e; padding: 20px;}
		
		body .hotel-list .box .hotelbox .image
		{float:left; margin-right:20px; margin-bottom:20px; border:2px #33CCFF}
			   
			   body .hotel-list .box .hotelbox .text h2
		{margin-bottom:5px;}
		body .hotel-list .box .hotelbox .text h2 a
		{font: 400 20px/1.5 "Lucida Grande","Lucida Sans Unicode","Lucida Sans",Verdana,sans-serif; color: #dde9ec; text-decoration:none; font-weight:bold;}
		body .hotel-list .box .splitter
		{margin: 0px -10px; border-bottom: 2px solid #35393c; clear:both;}
			   
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
	
$con=mysqli_connect("localhost","Neophytes","Neophytes","Neophytes");

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
echo "<div class='hotels-list'>";
echo "<div class='box'>";
	echo "<div class='hotelbox'>";
	echo "<div class='image'>";
	?>
     <img src="<?php echo $row['img']; ?>" height="120" width="192"/>
     <?php
	 echo "</div>";
	 echo "<div class='text'>";
	 echo "<h2>";
	 echo"<a href='$field1'>";
	 echo $row['Name'];
	 echo"</a>";
	 echo "</h2>";
	 echo "<br/>";
	 echo $row['Address'];
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
				echo "<a href='map2.php'>";
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
		echo "</div>";
		echo "<div class='splitter'>";                
        echo "</div>";

echo "</div>";
echo "</div>";
	}
}
?>
</body>
</html>
