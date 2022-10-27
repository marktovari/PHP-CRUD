
	<footer>
		<div>&copy; Copyright Date Name</div>
	</footer>

		<?php
		// Clean data from memory for better performance, then close off the connection to the Database
		mysqli_free_result($queryResult);
		mysqli_close($connection);
	?>
</body>
