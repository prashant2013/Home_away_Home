<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
               div#hotels-list
               { width:370px;}
               div#hotels-list div.hotel
               { border-bottom:a40004 solid 1px; background:#c9f76f; padding:10px; margin-bottom:10px;}
               div#hotels-list div.hotel div.name
               { color:#008500; font-size:16px; font-family:Arial, Helvetica, sans-serif;font-weight:bold; float:left;margin-top:0px;}
			   div#hotels-list div.hotel div.address
               { color:#0; font-size:12px; font-family:Arial, Helvetica, sans-serif; width:240px;font-weight:bold; float:left;margin-right:10px;}
			   
			    a:link {
COLOR: #008500;
}
a:visited {
COLOR: #800080;
}
a:hover {
COLOR: #FF0000;
}
a:active {
COLOR: #00FF00;
}
			   
               </style>
               

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="design/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<title>Untitled Document</title>
</head>

<body>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="design/bootstrap/js/bootstrap.min.js"></script>
<script src="js/bootstrap-popover.js">
<script>
 var img = '<img src="<?php echo $row['img']; ?>" width="100" height="100"/>';

$("#blob").popover({ title: 'Look!  A bird image!', content: img });
 </script>

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
	
	
	
	
	$q1 = "select * from indian_hotels where State_id='$state' AND Type='$type'";
	
	$res = mysqli_query($con, $q1);
	

	
	while($row=mysqli_fetch_array($res))
	{

$field1=$row['Website'];
echo"<div id='hotels-list'>";
echo "<div class='hotel'>";
echo "<div class='name'>";
echo "<a href='$field1'>";
echo $row['Name'];
echo"</a>";
echo "</div>";
echo "<div class='address'>";
echo "<br>";
echo $row['Address'];
echo "</div>";
//echo "<div class='website'>";
//echo $row['Website'];
//echo "</div>";
 ?>
 <a href="#" id="blob" rel="popover" style="margin-top: 300px">
 <img src="<?php echo $row['img']; ?>" width="100" height="100"/></a>
<?php echo "<br>" ;

echo "</div>";
echo "</div>";
echo "</div>";


 
  

//echo $row["Address"]; 
//echo $row["Website"]; 



}

?>
</body>
</html>
