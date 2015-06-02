<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "migration";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}/* else {
	echo "Connected.";
}*/

$programID = $_GET["programID"];

$sql = "SELECT originalname, renamedto, latestrev, datatype, jobsfolder FROM enditems WHERE programid=$programID";
$result = $conn->query($sql);

$counter = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr><td id=\"originalname:".$counter."\" contenteditable=\"true\">".$row["originalname"]."</td><td id=\"renamedto:".$counter."\" contenteditable=\"true\">".$row["renamedto"]."</td><td id=\"latestrev:".$counter."\" contenteditable=\"true\">".$row["latestrev"]."</td><td id=\"datatype:".$counter."\" contenteditable=\"true\">".$row["datatype"]."</td><td id=\"jobsfolder:".$counter."\"><a href=\"".$row["jobsfolder"]."\" title=\"Download from: ".$row["jobsfolder"]."\" target=\"_blank\">Download</a></td></tr>";
		$counter = $counter + 1;
	}
} else {
	echo "No data could be retrieved.";
}
$conn->close();
?>