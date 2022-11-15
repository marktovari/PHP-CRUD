<?php
include('templates/header.php');

if (isset($_POST['submit'])) {

    $user = $_POST['usr'];
    $passwd = $_POST['pwd'];
    $passwd = hash('sha256', $passwd);

    //See if there is a user in the database with this password
    $sql = "SELECT * FROM users WHERE userName='$user' AND userPwd='$passwd'";
    //Apply query through the PDO (PHP Data Object) using the built-in method, recording it in a variable
    $stmt = $pdo->query($sql);
    //Fetch the resulting columns as an associative array
    $queryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //If a result is found...
    if (!empty($queryArray)) {
        //Set a session variable for it
        $_SESSION['pwd'] = $queryArray[0]['userPwd'];
        //Then redirect to the form page
        header('Location:form.php');
    }
}

?>

<form class="" action="login.php" method="post">
    <input type="text" name="usr" value="" placeholder="Username">
    <input type="password" name="pwd" value="" placeholder="Password">
    <input type="submit" name="submit" value="Login">
</form>
