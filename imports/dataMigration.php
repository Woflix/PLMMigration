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

$sql = "SELECT programid, programname, assignedto, start, end, ID FROM programs";
$result = $conn->query($sql);

$counter = 2;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr><td id=\"programid:".$row["ID"]."\" tabindex=0><a href=\"enditemdash.php?programID=".$row["programid"]."\" target=\"_blank\">".$row["programid"]."</a></td><td id=\"programname:".$row["ID"]."\" contenteditable=\"true\" tabindex=".$counter.">".$row["programname"]."</td><td id=\"assignedto:".$row["ID"]."\" contenteditable=\"true\" tabindex=".($counter+1).">".$row["assignedto"]."</td><td id=\"start:".$row["ID"]."\" contenteditable=\"true\" tabindex=".($counter+2).">".$row["start"]."</td><td id=\"end:".$row["ID"]."\" contenteditable=\"true\" tabindex=".($counter+3).">".$row["end"]."</td></tr>";
		$counter = $counter + 4;
	}
} else {
	echo "No data could be retrieved.";
}
$conn->close();
?>
<script type="text/javascript">
	$(function(){
		$('td[contenteditable=true]').blur(function(){
			var field_userid = $(this).attr("id");
			var value = $(this).text();
			$.post('imports/ajaxMigration.php', field_userid + "=" + value, function(data){
				if(data != ''){
					$('.statusPushed').addClass("statusPushedShow");
					setTimeout (function(){
						$('.statusPushed').removeClass("statusPushedShow");
					}, 1000);
				}
			});
		});
	});
</script>