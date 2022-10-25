<?php

// Initializing Upload Data Array
	$uploadData = [
		'name' => '',
		'email' => '',
		'phone' => '',
	];

	//Errors Array
	$errors = [
		'name' => '',
		'email' => '',
		'phone' => '',
	];

	//DB connection
	define('__ROOT__', dirname(__FILE__));
	//define('__ROOT__', dirname(dirname(__FILE__))); This is a file outside of the webroot with sensitive info to keep the info secure,
	require_once(__ROOT__.'\dbConnect.php'); //Delete this and use the line above

	if(isset($_POST['submit'])){

	//DATABASE UPLOAD
		//Initializing Variables
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		// SQL command to add the data. Note the backticks, and don't mixe them up with the single quotations
		// phpMyAdmin can generate code too
		$sql = "INSERT INTO `database-table` (`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone');";

		// Apply the SQL Command
		$sendData = mysqli_query($connection, $sql);
		echo "Successful Upload";
	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<section class="">

		<form class="" action="form.php" method="POST">

			<label>Name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($uploadData['name']) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>

			<label>Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($uploadData['email']) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>

			<label>Phone</label>
			<input type="text" name="phone" value="<?php echo htmlspecialchars($uploadData['phone']) ?>">
			<div class="red-text"><?php echo $errors['phone']; ?></div>

			<div class="">
				<input type="submit" name="submit" value="Submit" class="">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
