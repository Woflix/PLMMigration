<?php
include 'configData.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}/* else {
	echo "Connected.";
}*/

$programID = $_GET["programID"];

$sql = "SELECT originalname, renamedto, latestrev, datatype, jobsfolder, ID FROM enditems WHERE programid=$programID";
$result = $conn->query($sql);

$counter = 2;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr><td id=\"actions:".$row["ID"]."\" tabindex=0><a href=\"#\" onclick=\"alert('ACTION A:\\n\\nSome Data: || ".$row["originalname"]." || ".$row["renamedto"]." || ".$row["latestrev"]." || ".$row["datatype"]." || ".$row["jobsfolder"]." ||\\n\\nNOTE: This is just an example of how you can pass the SQL data to a javascript action on the button press. Change the action/function in imports/dataEnditem.php.');\">A</a><a href=\"#\" onclick=\"alert('ACTION B:\\n\\nSome Data: || ".$row["originalname"]." || ".$row["renamedto"]." || ".$row["latestrev"]." || ".$row["datatype"]." || ".$row["jobsfolder"]." ||\\n\\nNOTE: This is just an example of how you can pass the SQL data to a javascript action on the button press. Change the action/function in imports/dataEnditem.php.');\">B</a><a href=\"#\" onclick=\"alert('ACTION C:\\n\\nSome Data: || ".$row["originalname"]." || ".$row["renamedto"]." || ".$row["latestrev"]." || ".$row["datatype"]." || ".$row["jobsfolder"]." ||\\n\\nNOTE: This is just an example of how you can pass the SQL data to a javascript action on the button press. Change the action/function in imports/dataEnditem.php.');\">C</a></td><td id=\"originalname:".$row["ID"]."\" contenteditable=\"true\" tabindex=".$counter.">".$row["originalname"]."</td><td id=\"renamedto:".$row["ID"]."\" contenteditable=\"true\" tabindex=".($counter+1).">".$row["renamedto"]."</td><td id=\"latestrev:".$row["ID"]."\" contenteditable=\"true\" tabindex=".($counter+2).">".$row["latestrev"]."</td><td id=\"datatype:".$row["ID"]."\" contenteditable=\"true\" tabindex=".($counter+3).">".$row["datatype"]."</td><td id=\"jobsfolder:".$row["ID"]."\" tabindex=0><a href=\"".$row["jobsfolder"]."\" title=\"Download from: ".$row["jobsfolder"]."\" target=\"_blank\">Download</a></td></tr>";
		$counter = $counter + 4;
	}
} else {
	echo "<h2 id=\"sqlError\">Error: No data could be retrieved.</h2>";
}
$conn->close();
?>
<script type="text/javascript">
	$(function(){
			$('td[contenteditable=true]').blur(function(){
				var field_userid = $(this).attr("id");
				var value = $(this).text();
				$.post('imports/ajaxEnditem.php', field_userid + "=" + value, function(data){
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