<?php
/*
This file has the sensitive data for connecting to the database
Place it outside of the webroot, and just require it, where needed.
Make sure the links in the require functions are correct
*/

//Connect
// $connection = mysqli_connect('host', 'username', 'password', 'database');
$connection = mysqli_connect('localhost', 'testuser', '123', 'testdb');
//Connection Error Display
if(!$connection){
    echo 'Connection error: '. mysqli_connect_error();
}
echo 'DB connect test'
?>
