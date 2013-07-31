<?php
include 'connect.php';

$state = $_POST["state"];
$type = $_POST["type"];
/*
$state = '07';
$type = 'S5';
*/
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
	$q1 = "SELECT ih.Name, ih.Address, gc.latlng FROM `indian_hotels` ih INNER JOIN `geocode` gc ON ih.name = gc.name WHERE State_id='$state' AND Type='$type';";
	//$q1 = "SELECT Address, Name FROM `indian_hotels` WHERE State_id='$state' AND Type='$type';";
}

$result = mysqli_query($con, $q1);
$output = '';
while($row = mysqli_fetch_array($result)) {
	$output .= "<option value=".$row['Address'].">".$row['Name']."</option>";
}
print $output;
?>
