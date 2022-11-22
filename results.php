<?php
include('templates/header.php');

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
			<?php if ($_SESSION['pwd']): ?>
				<form class="" action="results.php" method="post">
					<input type="submit" name="delete" value="DELETE">
					<?php if(array_key_exists('delete', $_POST)) {
						/* In each iteration of the results in the foreach array,
						we output the delete button, so when it is pressed,
						it deletes the right row from the database */
							$sql = 'DELETE FROM testtable WHERE postID = '.$value['postID'];
							$stmt = $pdo->query($sql);
						}?>
					<input type="submit" name="edit" value="EDIT">
					<?php if(array_key_exists('edit', $_POST)) {
						$_SESSION['name'] = $value['name'];
						$_SESSION['email'] = $value['email'];
						$_SESSION['phone'] = $value['phone'];
						$_SESSION['comment'] = $value['comment'];
						$_SESSION['subjectID'] = $value['postID'];
						$_SESSION['old-image'] = $value['imageurl'];
						header('Location: update.php');
					}?>
				</form>
			<?php endif; ?>
		<?php endforeach ?>
	</div>

</div>

<?php include('templates/footer.php'); ?>
