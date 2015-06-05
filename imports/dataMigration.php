<?php
// Get SQL Server Data \\
include 'configData.php';

// Create New Connection Called $conn1 \\
$conn1 = new mysqli($servername, $username, $password, $dbname);
if ($conn1->connect_error) {
	die("Connection failed: " . $conn1->connect_error);
}

// Create New Connection Called $conn2 \\
$conn2 = new mysqli($servername, $username, $password, $dbname);
if ($conn2->connect_error) {
	die("Connection failed: " . $conn2->connect_error);
}

// Create New Connection Called $conn3 \\
$conn3 = new mysqli($servername, $username, $password, $dbname);
if ($conn3->connect_error) {
	die("Connection failed: " . $conn3->connect_error);
}

// SQL Queries \\
$sqlProgram = "SELECT programid, name, assignedto, actual_start_date, actual_complete_date, status, notes, id FROM program";
$sqlEnditem1 = "SELECT count(jobfolder), programid FROM `enditem` WHERE status = 'Completed' GROUP by programid;";
$sqlEnditem2 = "SELECT count(jobfolder), programid FROM `enditem` WHERE status = '' GROUP by programid;";
$result = $conn1->query($sqlProgram);
$resultEnditem1 = $conn2->query($sqlEnditem1);
$resultEnditem2 = $conn3->query($sqlEnditem2);

// Setup Tabindex Counter \\
$counter = 2;
$localProgramidPrevious = 0000000000;

// Setup Arrays for itenQty and percentageCleaned \\
$cleanCompleted = array();
$cleanPercentage = array();
$cleanTotal = array();

// Check if SQL Query Returned Rows \\
if ($resultEnditem1->num_rows > 0) {
	// While Rows \\
	while ($rowEnditem1 = $resultEnditem1->fetch_assoc()) {
		// Push SQL count(jobfolder) Data into Array \\
		$cleanCompleted[$rowEnditem1["programid"]] = $rowEnditem1["count(jobfolder)"];
	}
}

// DEBUG -> print_r($cleanCompleted);

// Check if SQL Query Returned Rows \\
if ($resultEnditem2->num_rows > 0) {
	while ($rowEnditem2 = $resultEnditem2->fetch_assoc()) {
		// Push $cleanCompleted[] + SQL count(jobfolder) Data into Array \\
		$cleanTotal[$rowEnditem2["programid"]] = $cleanCompleted[$rowEnditem2["programid"]]+$rowEnditem2["count(jobfolder)"];
		// Calculate and Push Percentage Cleaned \\
		$cleanPercentage[$rowEnditem2["programid"]] = ($cleanCompleted[$rowEnditem2["programid"]]/($rowEnditem2["count(jobfolder)"]+$cleanCompleted[$rowEnditem2["programid"]]))*100;
	}
}

// DEBUG -> print_r($cleanPercentage);

// Check if SQL Query Returned Rows \\
if ($result->num_rows > 0) {
	// While Rows \\
	while($row = $result->fetch_assoc()) {
		// Set Current Program Variable to Current Program ID \\
		$localProgramidCurrent = $row["programid"];
		// Check if Program is Same \\
		if ($localProgramidCurrent == $localProgramidPrevious) {
		} else {
			// Push Program ID from SQL into $programidCurrent \\
			$programidCurrent = $row["programid"];
			// Put Data in Table \\
			echo "<tr><td id=\"programid:".$row["id"]."\" tabindex=".$counter."><a href=\"enditemdash.php?programID=".$row["programid"]."&user=Michael Leng&perm=Admin\" target=\"_blank\">".$row["programid"]."</a></td><td id=\"name:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+1).">".$row["name"]."</td><td id=\"assignedto:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+2).">".$row["assignedto"]."</td><td id=\"actual_start_date:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+3).">".$row["actual_start_date"]."</td><td id=\"actual_complete_date:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+4).">".$row["actual_complete_date"]."</td><td id=\"status:".$row["id"]."\" tabindex=".($counter+5).">".$row["status"]."</td><td id=\"itemqty:".$row["id"]."\" tabindex=".($counter+6).">";

			// Check if Array $cleanTotal for Key $programidCurrent is Empty \\
			if (!empty($cleanTotal[$programidCurrent])) {
				// Put Data in Table \\
				echo $cleanTotal[$programidCurrent];
			} else {
				// Put Data as 0 in Table \\
				echo 0;
			}

			// Put Data in Table \\
			echo "</td><td id=\"percentcleaned:".$row["id"]."\" tabindex=".($counter+7).">";

			// Check if Array $cleanPercentage for Key $programidCurrent is Empty \\
			if (!empty($cleanPercentage[$programidCurrent])) {
				// Put Data in Table \\
				echo round($cleanPercentage[$programidCurrent], 2, PHP_ROUND_HALF_UP);
			} else {
				// Put Data as 0 in Table \\
				echo 0;
			}

			// Put Data in Table \\
			echo "%</td><td id=\"notes:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+8).">".$row["notes"]."</td></tr>";
			// Add to Tabindex Counter \\
			$counter = $counter + 9;
		}
		// Set Previous Program Variable to Previous Program ID \\
		$localProgramidPrevious = $row["programid"];
	}
} else {
	echo "<h2 id=\"sqlError\">Error: No data could be retrieved.</h2>";
}
// Close Connections \\
$conn1->close();
$conn2->close();
$conn3->close();
?>
<script type="text/javascript">
	// Reinitialize onBlur Listener \\
	$(function(){
			$('td[contenteditable=true]').blur(function(){
				var field_userid = $(this).attr("id");
				var value = $(this).text();
				$.post('imports/ajaxMigration.php', field_userid + "=" + value, function(data){
					if(data != ''){
						$('.statusUpdated').removeClass("statusUpdatedShow");
						setTimeout (function(){
							$('.statusPushed').addClass("statusPushedShow");
						}, 300);
						setTimeout (function(){
							$('.statusPushed').removeClass("statusPushedShow");
						}, 1300);
					}
				});
			});
		});
</script>