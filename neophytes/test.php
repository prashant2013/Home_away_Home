<?php
	include 'connect.php';
	$state = "07";
	echo $state;
	$q1 = "SELECT Address FROM `indian_hotels` WHERE State_id = '$state' LIMIT 0 , 30";
	$result = mysqli_query($con, $q1);
  
  	 
	while($row = mysqli_fetch_array($result))
	{
		echo $row["Address"];
		}
		mysqli_close($con)
	?>

