<?php
	// Connect to database
	$conn = new mysqli("localhost", "user2", "0000", "ua2");

	if (!$conn) {
		echo "Failed to connect to MySQL: " . $conn->error();
		die();
	}
?>
