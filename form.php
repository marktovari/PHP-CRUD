<?php

// Initializing Upload Data Array
	$uploadData = [
		'name-arrayKey' => '',
		'email-arrayKey' => '',
		'phone-arrayKey' => '',
	];

	//Errors Array
	$errors = [
		'name-arrayKey' => '',
		'email-arrayKey' => '',
		'phone-arrayKey' => '',
	];

	//DB connection
	define('__ROOT__', dirname(__FILE__));
	//define('__ROOT__', dirname(dirname(__FILE__))); This is a file outside of the webroot with sensitive info to keep the info secure,
	require_once(__ROOT__.'\dbConnect.php'); //Delete this and use the line above

	if(isset($_POST['submit'])) {

	//FORM VALIDATION
		// $dataArraySize = sizeof($uploadData);
		// $uploadReady = false;
		// foreach ($uploadData as $key => $value) {
		// 	if($uploadData[$key] == '') {
		// 		$uploadReady = false;
		// 		$errors[$key] = 'Missing field';
		// 	} else {
		// 		$uploadReady = true;
		// 	}
		// }

	//DATABASE UPLOAD
		// if ($uploadReady) {
			//Initializing Variables
			$name = $_POST['name-formData'];
			$email = $_POST['email-formData'];
			$phone = $_POST['phone-formData'];

			// SQL command to add the data. Note the backticks, and don't mixe them up with the single quotations
			// phpMyAdmin can generate code too
			$sql = "INSERT INTO `test-table` (`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone');";

			// Apply the SQL Command
			$sendData = mysqli_query($connection, $sql);
			echo "Successful Upload";
		// }
	}



?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<section class="">
		<form class="" action="index.php" method="POST">

			<label>Name</label>
			<!-- We echo out the $uploadData[$key], so when the user clicks the submit button, the data doesn't disappear -->
			<!-- This makes editing mistakes less frustrating -->
			<!-- We also wrap them into htmlspecialchars for safety, so it won't try to change the page display -->
			<input type="text" name="name-formData" value="<?php echo htmlspecialchars($uploadData['name-arrayKey']) ?>">
			<!-- This little div is there to show up the error message, like missing data, or wrong dataformat -->
			<div class="red-text"><?php echo $errors['name-arrayKey']; ?></div>

			<label>Email</label>
			<input type="text" name="email-formData" value="<?php echo htmlspecialchars($uploadData['email-arrayKey']) ?>">
			<div class="red-text"><?php echo $errors['email-arrayKey']; ?></div>

			<label>Phone</label>
			<input type="text" name="phone-formData" value="<?php echo htmlspecialchars($uploadData['phone-arrayKey']) ?>">
			<div class="red-text"><?php echo $errors['phone-arrayKey']; ?></div>

			<div class="">
				<input type="submit" name="submit" value="Submit" class="">
				<!-- Once this button is pressed, all the $uploadData['arrayKey'] turns into a POST request. Which is an associative array.-->
				<!-- So it can be accessed via $_POST[$key] with $key being as it was called in the 'name' tag of the input field in the form -->
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>
