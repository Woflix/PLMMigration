<!--
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
-->

<?php
$detailsLocal = $_GET["details"];
$detailsStrip = strip_tags(trim($detailsLocal));

if (strpos($detailsStrip, ':') !== FALSE) {
	$splitData = explode(':', $detailsStrip);
	$passwordLocal = $splitData[1];
	$usernameLocal = $splitData[0];

	include 'configData.php';

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT userid, username, password, role FROM users WHERE username = \"$usernameLocal\"";
	$result = $conn->query($sql);

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
		if ($result->num_rows == 1) { // This second if was for multiple roles, but didn't feel like removing it in case we need that feature later
			while ($row = $result->fetch_assoc()) {
				if ($row["username"] == $usernameLocal && $row["password"] == $passwordLocal) {
					if ($row["role"] == "eng") {
						$userRole = "Engineer";
					} else if ($row["role"] == "mig") {
						$userRole = "Migration";
					} else if ($row["role"] == "admin") {
						$userRole = "Admin";
					} else {
						$userRole = "[Error: Your credentials in our database have been corrupted. Please contact an administrator.";
					}
					echo "<h2 id=\"sqlGood\">You have successfully logged in with <span id=\"loginUserRole\">".$userRole."</span> level permissions.</h2>";
				} else {
					echo "<h2 id=\"sqlError\">Error: You have entered an invalid username and password combination.</h2>";
				}
			}	
		}
	} else {
		echo "<h2 id=\"sqlError\">Error: You have entered an invalid username or password.</h2>";
	}
	$conn->close();
} else {
	echo "<h2 id=\"sqlError\">Error: You have entered a space in either the username or password field.</h2>";
}
?>