<?php
include 'configData.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}/* else {
	echo "Connected.";
}*/

$programID = $_GET["programID"];

$sql = "SELECT status, origfilename, rename_to, epic_pn, latest_rev, propname, description, catia_rel, cad_env, part_type, lastmdate, jobfolder, id FROM enditem WHERE programid=$programID";
$result = $conn->query($sql);

$counter = 2;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr><td id=\"actions:".$row["id"]."\" tabindex=".$counter."><a href=\"#\" onclick=\"alert('ACTION A:\\n\\nSome Data: || ".$row["status"]." || ".$row["origfilename"]." || ".$row["rename_to"]." || ".$row["epic_pn"]." || ".$row["latest_rev"]." || ".$row["propname"]." || ".$row["description"]." || ".$row["catia_rel"]." || ".$row["cad_env"]." || ".$row["part_type"]." || ".$row["lastmdate"]." || ".$row["jobfolder"]." ||\\n\\nNOTE: This is just an example of how you can pass the SQL data to a javascript action on the button press. Change the action/function in imports/dataEnditem.php.');\">A</a><a href=\"#\" onclick=\"alert('ACTION B:\\n\\nSome Data: || ".$row["status"]." || ".$row["origfilename"]." || ".$row["rename_to"]." || ".$row["epic_pn"]." || ".$row["latest_rev"]." || ".$row["propname"]." || ".$row["description"]." || ".$row["catia_rel"]." || ".$row["cad_env"]." || ".$row["part_type"]." || ".$row["lastmdate"]." || ".$row["jobfolder"]." ||\\n\\nNOTE: This is just an example of how you can pass the SQL data to a javascript action on the button press. Change the action/function in imports/dataEnditem.php.');\">B</a><a href=\"#\" onclick=\"alert('ACTION C:\\n\\nSome Data: || ".$row["status"]." || ".$row["origfilename"]." || ".$row["rename_to"]." || ".$row["epic_pn"]." || ".$row["latest_rev"]." || ".$row["propname"]." || ".$row["description"]." || ".$row["catia_rel"]." || ".$row["cad_env"]." || ".$row["part_type"]." || ".$row["lastmdate"]." || ".$row["jobfolder"]." ||\\n\\nNOTE: This is just an example of how you can pass the SQL data to a javascript action on the button press. Change the action/function in imports/dataEnditem.php.');\">C</a></td><td id=\"status:".$row["id"]."\" tabindex=".($counter+1).">".$row["status"]."</td><td id=\"origfilename:".$row["id"]."\" tabindex=".($counter+2).">".$row["origfilename"]."</td><td id=\"rename_to:".$row["id"]."\" tabindex=".($counter+3).">".$row["rename_to"]."</td><td id=\"epic_pn:".$row["id"]."\" tabindex=".($counter+4).">".$row["epic_pn"]."</td><td id=\"latest_rev:".$row["id"]."\" tabindex=".($counter+5).">".$row["latest_rev"]."</td><td id=\"propname:".$row["id"]."\" tabindex=".($counter+6).">".$row["propname"]."</td><td id=\"description:".$row["id"]."\" tabindex=".($counter+7).">".$row["description"]."</td><td id=\"catia_rel:".$row["id"]."\" tabindex=".($counter+8).">".$row["catia_rel"]."</td><td id=\"cad_env:".$row["id"]."\" tabindex=".($counter+9).">".$row["cad_env"]."</td><td id=\"part_type:".$row["id"]."\" tabindex=".($counter+10).">".$row["part_type"]."</td><td id=\"lastmdate:".$row["id"]."\" tabindex=".($counter+11).">".$row["lastmdate"]."</td><td id=\"jobfolder:".$row["id"]."\" tabindex=".($counter+12)."><a href=\"".$row["jobfolder"]."\" title=\"Download from: ".$row["jobfolder"]."\" target=\"_blank\">Download</a></td></tr>";
		$counter = $counter + 13;
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