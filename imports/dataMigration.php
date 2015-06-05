<?php
include 'configData.php';

$conn1 = new mysqli($servername, $username, $password, $dbname);
if ($conn1->connect_error) {
	die("Connection failed: " . $conn1->connect_error);
}

$conn2 = new mysqli($servername, $username, $password, $dbname);
if ($conn2->connect_error) {
	die("Connection failed: " . $conn2->connect_error);
}

$conn3 = new mysqli($servername, $username, $password, $dbname);
if ($conn3->connect_error) {
	die("Connection failed: " . $conn3->connect_error);
}

$sqlProgram = "SELECT programid, name, assignedto, actual_start_date, actual_complete_date, status, notes, id FROM program";
$sqlEnditem1 = "SELECT count(jobfolder), programid FROM `enditem` WHERE status = 'Completed' GROUP by programid;";
$sqlEnditem2 = "SELECT count(jobfolder), programid FROM `enditem` WHERE status = '' GROUP by programid;";
$result = $conn1->query($sqlProgram);
$resultEnditem1 = $conn2->query($sqlEnditem1);
$resultEnditem2 = $conn3->query($sqlEnditem2);

$counter = 2;
$localProgramidPrevious = 0000000000;
$cleanCompleted = array();
$cleanPercentage = array();
$cleanTotal = array();

if ($resultEnditem1->num_rows > 0) {
	while ($rowEnditem1 = $resultEnditem1->fetch_assoc()) {
		$cleanCompleted[$rowEnditem1["programid"]] = $rowEnditem1["count(jobfolder)"];
	}
}

// DEBUG -> print_r($cleanCompleted);

if ($resultEnditem2->num_rows > 0) {
	while ($rowEnditem2 = $resultEnditem2->fetch_assoc()) {
		$cleanTotal[$rowEnditem2["programid"]] = $cleanCompleted[$rowEnditem2["programid"]]+$rowEnditem2["count(jobfolder)"];
		$cleanPercentage[$rowEnditem2["programid"]] = $cleanCompleted[$rowEnditem2["programid"]]/($rowEnditem2["count(jobfolder)"]+$cleanCompleted[$rowEnditem2["programid"]]);
	}
}

// DEBUG -> print_r($cleanPercentage);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$localProgramidCurrent = $row["programid"];
		if ($localProgramidCurrent == $localProgramidPrevious) {
		} else {
			$programidCurrent = $row["programid"];
			echo "<tr><td id=\"programid:".$row["id"]."\" tabindex=".$counter."><a href=\"enditemdash.php?programID=".$row["programid"]."&user=Michael Leng&perm=Admin\" target=\"_blank\">".$row["programid"]."</a></td><td id=\"name:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+1).">".$row["name"]."</td><td id=\"assignedto:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+2).">".$row["assignedto"]."</td><td id=\"actual_start_date:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+3).">".$row["actual_start_date"]."</td><td id=\"actual_complete_date:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+4).">".$row["actual_complete_date"]."</td><td id=\"status:".$row["id"]."\" tabindex=".($counter+5).">".$row["status"]."</td><td id=\"itemqty:".$row["id"]."\" tabindex=".($counter+6).">";

			if (!empty($cleanTotal[$programidCurrent])) {
				echo $cleanTotal[$programidCurrent];
			} else {
				echo 0;
			}

			echo "</td><td id=\"percentcleaned:".$row["id"]."\" tabindex=".($counter+7).">";

			if (!empty($cleanPercentage[$programidCurrent])) {
				echo round($cleanPercentage[$programidCurrent], 3, PHP_ROUND_HALF_UP);
			} else {
				echo 0;
			}

			echo "%</td><td id=\"notes:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+8).">".$row["notes"]."</td></tr>";
			$counter = $counter + 9;
		}
		$localProgramidPrevious = $row["programid"];
	}
} else {
	echo "<h2 id=\"sqlError\">Error: No data could be retrieved.</h2>";
}
$conn1->close();
$conn2->close();
$conn3->close();
?>
<script type="text/javascript">
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