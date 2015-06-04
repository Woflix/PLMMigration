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

$sqlProgram = "SELECT program.programid, program.name, program.assignedto, program.actual_start_date, program.actual_complete_date, program.status, program.notes, program.id, enditem.statuscl FROM program LEFT JOIN enditem ON program.programID=enditem.programID";
$sqlEnditem = "SELECT status, programid, id FROM enditem";
$result = $conn1->query($sqlProgram);
$resultEnditem = $conn2->query($sqlEnditem);

$counter = 2;
$itemCounter = 0;
$localProgramidPrevious = 0000000000;

function checkCount($currentProgramid) {
	if ($resultEnditem->num_rows > 0) {
		while ($rowEnditem = $resultEnditem->fetch_assoc()) {
			if ($currentProgramid == $rowEnditem["programid"]) {
				$itemCounter = $itemCounter + 1;
			}
		}
		echo $itemCounter;
	}
}

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$localProgramidCurrent = $row["programid"];
		if ($localProgramidCurrent == $localProgramidPrevious) {
		} else {
			echo "<tr><td id=\"programid:".$row["id"]."\" tabindex=".$counter."><a href=\"enditemdash.php?programID=".$row["programid"]."&user=Michael Leng&perm=Admin\" target=\"_blank\">".$row["programid"]."</a></td><td id=\"name:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+1).">".$row["name"]."</td><td id=\"assignedto:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+2).">".$row["assignedto"]."</td><td id=\"actual_start_date:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+3).">".$row["actual_start_date"]."</td><td id=\"actual_complete_date:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+4).">".$row["actual_complete_date"]."</td><td id=\"status:".$row["id"]."\" tabindex=".($counter+5).">".$row["status"]."</td><td id=\"itemqty:".$row["id"]."\" tabindex=".($counter+6).">"."ITEMQTY"."</td><td id=\"percentcleaned:".$row["id"]."\" tabindex=".($counter+7).">";
			checkCount($row["programid"]);/*$row["statuscl"]*/
			echo "</td><td id=\"notes:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+8).">".$row["notes"]."</td></tr>";
			$counter = $counter + 9;
		}
		$localProgramidPrevious = $row["programid"];
	}
} else {
	echo "<h2 id=\"sqlError\">Error: No data could be retrieved.</h2>";
}
$conn1->close();
$conn2->close();
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