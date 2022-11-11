<?php
include('templates/header.php');

	//DB connect
	define('__ROOT__', dirname(__FILE__));
	//define('__ROOT__', dirname(dirname(__FILE__))); This is a file outside of the webroot with sensitive info to keep the info secure,
	require_once(__ROOT__.'\dbConnect.php'); //Delete this and use the line above in actual application

	//Write Queries in SQL and put it in a string
	$sql =  "SELECT * FROM `testtable`";

	//Apply query through the PDO (PHP Data Object) using the built-in method, recording it in a variable
	$stmt = $pdo->query($sql);
	//Fetch the resulting columns as an associative array
	$queryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
				<div><?php echo htmlspecialchars($value['comment']); ?></div>
				<div class="">
					<img src="images/<?=$value['imageurl']?>">
				</div>
			</div>
		<?php endforeach ?>
	</div>

</div>

<?php include('templates/footer.php'); ?>
