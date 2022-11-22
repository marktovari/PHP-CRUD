<?php
include('templates/header.php');

//Restrict access to the page
if (!isset($_SESSION['pwd'])) {
    //Redirect to another page if user isn't logged in
    header('Location:index.php');
    exit;
}

//Write Queries in SQL and put it in a string
$sql =  "SELECT * FROM `testtable`";

//Apply query through the PDO (PHP Data Object) using the built-in method, recording it in a variable
$stmt = $pdo->query($sql);
//Fetch the resulting columns as an associative array
$queryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit-update'])) {
    //Initalizing Variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];
    $id = $_SESSION['subjectID'];
    $img = $_POST['newImage'];

    //Leave the image unchanged if a new one isn't uploaded
    if (isset($img)) {
        
    }

    // SQL command to add the data.
    $sql = "UPDATE `testtable`
            SET
                `name` = ?,
                `email` = ?,
                `phone` = ?,
                `comment` = ?
            WHERE 1";
    // Apply the SQL Command via a PDO (PHP Data Object)
    $stmt = $pdo->prepare($sql);
    // Adding the values to the prepared statement
    $stmt->execute([$name, $email, $phone, $comment]);
    // $stmt->execute(['name' => $name,
    //                 'email' => $email,
    //                 'phone' => $phone,
    //                 'comment' => $comment,
    //             ]);

}

?>

<div>

	<!-- Display the data with the help of a PHP foreach loop, to echo it onto the page-->
	<div class="container">
		<!-- These values correspond to he field names inside of the DB -->
        <form class="" action="update.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" value="<?= $_SESSION['name'] ?>">
            <input type="text" name="email" value="<?= $_SESSION['email'] ?>">
            <input type="text" name="phone" value="<?= $_SESSION['phone'] ?>">
            <textarea row name="comment" rows="8" cols="80"><?= $_SESSION['comment'] ?></textarea>
            <input type="file" name="newImage"><p>leave empty if want unedited</p>
            <input type="submit" name="submit-update" value="Submit Update">
		</form>
	</div>

</div>

<?php include('templates/footer.php'); ?>
