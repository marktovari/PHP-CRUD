<?php

	//Errors Array
	$errors = [
		'name-arrayKey' => '',
		'email-arrayKey' => '',
		'phone-arrayKey' => '',
	];


	if(isset($_POST['submit'])) {
// //FORM VALIDATION
	//Initializing Variables from the POST request
	$name = $_POST['name-formData'];
	$email = $_POST['email-formData'];
	$phone = $_POST['phone-formData'];


	//Function to prepare input
	function inputPrepare($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

	//String validation
	if ($name == '') {
        $errors["name-arrayKey"] = "Name is required";
    }

	//Email validation
	if ($email == '') {
        $errors["email-arrayKey"] = "Email is required";
    } else {
        $email = inputPrepare($email);
        // check that the e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email-arrayKey"] = "Invalid email format";
        }
    }

	//Phone Validation
	if ($phone == '') {
        $errors["phone-arrayKey"] = "Phone number required";
    } else {
        $phone = inputPrepare($phone);
		if (!preg_match ("/^[0-9]*$/", $phone)) {
			$errors["phone-arrayKey"] = "Numbers only";
		}
    }

	//Checking if there is no errors at all
	foreach ($errors as $key => $value) {
		if ($value == '') {
			$uploadReady = true;
		}
		 else {
			$uploadReady = false;
			break;
		}
	}

//DATABASE UPLOAD
	// $uploadReady = true;
	if ($uploadReady) {
		// SQL command to add the data. Note the backticks, and don't mix them up with the single quotations
		// phpMyAdmin can generate code too
		$sql = "INSERT INTO `test-table` (`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone');";

		// Apply the SQL Command
		$sendData = mysqli_query($connection, $sql);
	}
}

?>

<section class="">
	<form class="" action="index.php" method="POST">

		<label>Name</label>
		<!-- We echo out the $uploadData[$key], so when the user clicks the submit button, the data doesn't disappear -->
		<!-- This makes editing mistakes less frustrating -->
		<input type="text" name="name-formData" value="">
		<!-- This little div is there to show up the error message, like missing data, or wrong dataformat -->
		<div class="red-text"><?php echo $errors['name-arrayKey']; ?></div>

		<label>Email</label>
		<input type="text" name="email-formData" value="">
		<div class="red-text"><?php echo $errors['email-arrayKey']; ?></div>

		<label>Phone</label>
		<input type="text" name="phone-formData" value="">
		<div class="red-text"><?php echo $errors['phone-arrayKey']; ?></div>

		<input type="submit" name="submit" value="Submit" class="">
		<!-- Once this button is pressed, all the $uploadData['arrayKey'] turns into a POST request. Which is an associative array.-->
		<!-- So it can be accessed via $_POST[$key] with $key being as it was called in the 'name' tag of the input field in the form -->
		</div>
	</form>
</section>
