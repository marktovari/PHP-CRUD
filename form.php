<?php
include('templates/header.php');

	//Log out by ending the session
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
	}

	//Restrict access to the page
	if (!isset($_SESSION['pwd'])) {
		//Redirect to another page if user isn't logged in
		header('Location:index.php');
		exit;
	}

	//Errors Array
	$errors = [
		'name-arrayKey' => '',
		'email-arrayKey' => '',
		'phone-arrayKey' => '',
		'comment-arrayKey' => '',
	];


	if(isset($_POST['submit'])) {
// //FORM VALIDATION
	//Initializing Variables from the POST request
	$name = $_POST['name-formData'];
	$email = $_POST['email-formData'];
	$phone = $_POST['phone-formData'];
	$comment = $_POST['comment-formData'];

	$pictureFilename = 		$_FILES['image-formData']['name'];
	$pictureSize = 			$_FILES['image-formData']['size'];
	$pictureError = 		$_FILES['image-formData']['error'];
	$pictureTemporaryName = $_FILES['image-formData']['tmp_name'];

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

	//Image Validation
	if ($pictureError != 0) { //Use the built-in error functionality of the PHP $_FILE global
        $errors["image-arrayKey"] = "Error with picture: {$pictureError}";
    } else if ($pictureSize > 1400000) {
		$errors["image-arrayKey"] = "Image bigger than recommended";
    } else {
		//If there are no errors begin the uploading of the file itself
		//First separate the extension from the filename and check if they are really pictures
		$pictureExtension = pathinfo($pictureFilename, PATHINFO_EXTENSION);
		$pictureExtension= strtolower($pictureExtension);
		$acceptedExtensions = ["jpg", "jpeg", "png", "gif"];

		if (in_array($pictureExtension, $acceptedExtensions)) {
			$pictureFilename = uniqid("IMG-", true).'.'.$pictureExtension; //Give it a new name, with the extension it had
			$uploadPath = 'images/'.$pictureFilename;
			move_uploaded_file($pictureTemporaryName, $uploadPath); //Move the file into the upload path
		}
	}

	//Checking if there is no errors at all
	foreach ($errors as $key => $value) {
		if ($value == '') {
			$uploadReady = true;
		} else {
			$uploadReady = false;
			echo "Upload failure, error in $key key as it shows $value value";
			break;
		}
	}

//DATABASE UPLOAD
	if ($uploadReady) {
		// SQL command to add the data.
		$sql = 'INSERT INTO testtable(name, email, phone, comment, imageurl) VALUES(:name, :email, :phone, :comment, :imageurl)';

		// Apply the SQL Command via a PDO (PHP Data Object)
		$stmt = $pdo->prepare($sql);
		// Adding the values to the prepared statement
		$stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'comment' => $comment, 'imageurl' => $pictureFilename]);
	}
}

?>

<section class="">
	<form class="" action="form.php" method="POST" enctype="multipart/form-data">

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

		<label>Comment</label>
		<textarea row name="comment-formData" rows="8" cols="80"></textarea>
		<div class="red-text"><?php echo $errors['comment-arrayKey']; ?></div>
		<!-- Image Upload -->
		<label>Image</label>
		<input type="file" name="image-formData">

		<input type="submit" name="submit" value="Submit" class="">
		<!-- Once this button is pressed, all the $uploadData['arrayKey'] turns into a POST request. Which is an associative array.-->
		<!-- So it can be accessed via $_POST[$key] with $key being as it was called in the 'name' tag of the input field in the form -->
		<input type="submit" name="logout" value="Logout">
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>
