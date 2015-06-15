<?php
// Get SQL Server Data \\
include 'configData.php';

// Create New Connection \\
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Get URL Variable \\
//$programID = $_GET["programID"];

// SQL Query \\
//select rename_to, size from enditem where size in ( select size from enditem group by size having count(*) > 1 )
//$sql = "SELECT status, origfilename, rename_to, epic_pn, latest_rev, propname, description, catia_rel, cad_env, part_type, lastmdate, jobfolder, enditemfn, id FROM enditem WHERE programid=$programID";
$sql = " SELECT programid, origfilename, rename_to, origsize, renamedsize, propname, description, catia_rel, jobfolder, id FROM enditem WHERE origfilename in ( SELECT origfilename FROM enditem GROUP BY origfilename HAVING COUNT(*) > 1 ) ";

$result = $conn->query($sql);

// Setup Tabindex Counter \\
$counter = 2;

// Check if SQL Query Returned Rows \\
if ($result->num_rows > 0) {
	// While Rows \\
	while($row = $result->fetch_assoc()) {
		// Put Data in Table \\
		echo "<tr>";
		echo "<td id=\"programid:".$row["id"]."\" tabindex=".$counter.">".$row["programid"]."</td>";
		echo "<td id=\"origfilename:".$row["id"]."\" tabindex=".($counter+1).">".$row["origfilename"]."</td>";
		echo "<td id=\"rename_to:".$row["id"]."\" tabindex=".($counter+2).">".$row["rename_to"]."</td>";
		echo "<td id=\"origsize:".$row["id"]."\" tabindex=".($counter+3).">".$row["origsize"]."</td>";
		echo "<td id=\"renamedsize:".$row["id"]."\" tabindex=".($counter+4).">".$row["renamedsize"]."</td>";
		echo "<td id=\"propname:".$row["id"]."\" tabindex=".($counter+5).">".$row["propname"]."</td>";
		echo "<td id=\"description:".$row["id"]."\" tabindex=".($counter+6).">".$row["description"]."</td>";
		echo "<td id=\"catia_rel:".$row["id"]."\" tabindex=".($counter+7).">".$row["catia_rel"]."</td>";
		echo "<td id=\"jobfolder:".$row["id"]."\" tabindex=".($counter+8).">".$row["jobfolder"]."</td>";
		echo "</tr>";
		// Add to Tabindex Counter \\
		$counter = $counter + 9;
	}
} else {
	echo "<h2 id=\"sqlError\">Error: No data could be retrieved.</h2>";
}
// Close Connection \\
$conn->close();
?>
