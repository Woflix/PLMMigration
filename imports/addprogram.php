<?php
// Get URL Variable \\
$data = $_GET["info"];

// Get SQL Server Data \\
include 'configData.php';

// Create New Connection Called $conn1 \\
$conn1 = new mysqli($servername, $username, $password, $dbname);
if ($conn1->connect_error) {
	die("Connection failed: " . $conn1->connect_error);
}

// SQL Queries \\
$sqlProgram = "SELECT programid FROM program WHERE programid = '$data'";
$result = $conn1->query($sqlProgram);


// Check if SQL Query Returned Rows \\
if (! $result->num_rows > 0) {
	//"INSERT program SET programid = '$data'";
	$sqlProgram = "INSERT INTO program (programid , status ) VAlUE ('$data', 'Submitting') ";
	$result = $conn1->query($sqlProgram);
}

$conn1->close();
?>
<script type="text/javascript">showGoodSuccess();</script>