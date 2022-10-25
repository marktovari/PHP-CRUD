<?php

	//DB connect
	define('__ROOT__', dirname(__FILE__));
	require_once(__ROOT__.'\dbConnect.php'); //This is a file outside of the webroot to keep the info secure, don't forget to change it

	//Write Queries in SQL and put it in a string
	$queryParmeter =  "SELECT * FROM `testtable`;";
	//Apply query through the opnened connection
	$queryResult = mysqli_query($connection, $queryParmeter);
	//Fetch the resulting columns as an associative array
	$queryArray = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

	// Clean data from memory for better performance, then close off the connection to the Database
	mysqli_free_result($queryResult);
	mysqli_close($connection);

?>

<div>

	<!-- Display the data with the help of a PHP foreach loop, to echo it onto the page-->
	<div class="container">
		<!-- These values correspond to he field names inside of the DB -->
		<?php foreach($queryArray as $data => $value): ?>
			<div class="">
				<div><?php echo htmlspecialchars($value['name']); ?></div>
				<div><?php echo htmlspecialchars($value['email']); ?></div>
				<div><?php echo htmlspecialchars($value['phone']); ?></div>
			</div>
		<?php endforeach ?>
	</div>

</div>
