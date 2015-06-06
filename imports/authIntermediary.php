<?php
/* 
	Authentication Permission Levels

	Engineer:
		+ Read migrationdash.php
		+ Access and write to newprogramdash.php

	Migration:
		+ Basic write to migrationdash.php
		+ Write to enditemdash.php
		+ Use action buttons on enditemdash.php

	Admin:
		+ Read all files
		+ Write all files
*/

// Get Details from URL Variable \\
$detailsLocal = $_GET["details"];
$detailsStrip = strip_tags(trim($detailsLocal));

// Check for ':' \\
if (strpos($detailsStrip, ':') !== FALSE) {
	// Split Into Two Variables \\
	$splitData = explode(':', $detailsStrip);
	$passwordLocal = $splitData[1];
	$usernameLocal = $splitData[0];

	// SQL Server Data \\
	include 'configData.php';

	// Create New Connection \\
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// SQL Query \\
	$sql = "SELECT userid, username, password, role FROM users WHERE username = \"$usernameLocal\"";
	$result = $conn->query($sql);

	// Check if Query Returned Rows \\
	if ($result->num_rows > 0) {
		// Uncomment for multiple roles
		/*if ($result->num_rows > 1) {
			echo "<select class=\"roleHidden\">";
			while ($row = $result->fetch_assoc()) {
				if ($row["username"] == $usernameLocal && $row["password"] == $passwordLocal) {
					echo "<h2 id=\"sqlGood\">GOOD".$row["role"]."</h2>";
					echo "<option id=\"option".$row["role"]."\">
						".$row["role"]."
					</option>";
				} else {
					echo "<h2 id=\"sqlError\">Error: Contact an admin. Your credentials in the database are corrupted.</h2>";
				}
			}
			echo "</select>";
		} else {*/
		// If Returned 1 Row \\
		if ($result->num_rows == 1) { // This second if was for multiple roles, but didn't feel like removing it in case we need that feature later
			while ($row = $result->fetch_assoc()) {
				// Permission Validation \\
				if ($row["username"] == $usernameLocal && $row["password"] == $passwordLocal) {
					if ($row["role"] == "eng") {
						$userRole = "engineer";
					} else if ($row["role"] == "mig") {
						$userRole = "migration";
					} else if ($row["role"] == "admin") {
						$userRole = "admin";
					} else {
						$userRole = "[Error: Your credentials in our database have been corrupted. Please contact an administrator.";
					}
					echo "<script type=\"text/javascript\">showGoodSuccess(".$userRole.");</script>";
				} else {
					echo "<script type=\"text/javascript\">showErrorCombination();</script>";
				}
			}	
		}
	} else {
		echo "<script type=\"text/javascript\">showErrorCredentials();</script>";
	}
	// Close Connection \\
	$conn->close();
} else {
	echo "<script type=\"text/javascript\">showErrorSpace();</script>";
}
?>