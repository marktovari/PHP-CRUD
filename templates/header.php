<head>
	<title>Website</title>
  <link rel="stylesheet" type="text/css" href="templates/style.css">
</head>

<?php
//DB connect
define('__ROOT__', dirname(dirname(__FILE__))); //This is a file outside of the webroot with sensitive info to keep the info secure,
require_once(__ROOT__.'\dbConnect.php'); //Delete this and use the line above in actual application

session_start();

?>

<body>
	<nav>
	    <div>
				<!-- NAV Member -->
				<a href="results.php">Results</a>
	    </div>
	    <div>
				<!-- NAV Member -->
				<a href="login.php">Login</a>
	    </div>
	</nav>
