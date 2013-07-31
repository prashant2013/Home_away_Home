<html>

<head>


</head>


<body>




<?php
try {

 $objDb = new PDO('mysql:host=localhost;dbname=Neophytes', 'Neophytes', 'Neophytes');
 $objDb->exec('SET CHARACTER SET utf8');

 $sql = "SELECT DISTINCT State 
  FROM `indian_hotels`";
 $statement = $objDb->query($sql);
 $list = $statement->fetchAll(PDO::FETCH_ASSOC);

 } catch(PDOException $e) {
 echo 'There was a problem';
 }

 ?>    






<form action="" method="post">

	<select name="state" id="state" class="update">
        <option value="">Select State</option>
        <?php if (!empty($list)) { ?>
            <?php foreach($list as $row) { ?>
                <option value="<?php echo $row['State']; ?>">
                    <?php echo $row['State']; ?>
                </option>
            <?php } ?>
        <?php } ?>
    </select>	

	<select name="type" id="type" class="update">
	    <option value="">Select Type</option>
	</select>

</form>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>	
<script src="ajax.js" type="text/javascript"></script>
  
</body>
</html>
