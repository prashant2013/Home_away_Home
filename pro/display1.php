

<?php
include 'connect.php';
$st2 = $_POST ["button"];
echo $st2;
$result = mysqli_query($con,"SELECT * FROM TBL_NAME WHERE State='$st2'");

echo "<table border='1'>
<tr>
<th>Name</th>
<th>Address</th>
</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Address'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysqli_close($con);
?> 
