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

$sql = "SELECT programid, programname, assignedto, start, end FROM programs";
$result = $conn->query($sql);

$counter = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr><td id=\"programid:".$counter."\"><a href=\"enditemdash.php?programID=".$row["programid"]."\" target=\"_blank\">".$row["programid"]."</a></td><td id=\"programname:".$counter."\" contenteditable=\"true\">".$row["programname"]."</td><td id=\"assignedto:".$counter."\" contenteditable=\"true\">".$row["assignedto"]."</td><td id=\"start:".$counter."\" contenteditable=\"true\">".$row["start"]."</td><td id=\"end:".$counter."\" contenteditable=\"true\">".$row["end"]."</td></tr>";
		$counter = $counter + 1;
	}
} else {
	echo "No data could be retrieved.";
}
$conn->close();
?>