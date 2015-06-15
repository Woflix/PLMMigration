<?php
// Get SQL Server Data \\
include 'configData.php';

// Create New Connection \\
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Get URL Variable \\
$programID = $_GET["programID"];

// SQL Query \\
$sql = "SELECT status, origfilename, rename_to, epic_pn, latest_rev, propname, description, catia_rel, cad_env, part_type, lastmdate, jobfolder, enditemfn, id FROM enditem WHERE programid=$programID";
$result = $conn->query($sql);

// Setup Tabindex Counter \\
$counter = 2;

// Check if SQL Query Returned Rows \\
if ($result->num_rows > 0) {
	// While Rows \\
	while($row = $result->fetch_assoc()) {
		// Put Data in Table \\

		echo "<tr><td id=\"actions:".$row["id"]."\" tabindex=".$counter.">";
		
		// Add Load button if it is the enditem \\
		$enditemid=str_replace(".","_",$row["enditemfn"]);
		$orignameid=str_replace(".","_",$row["origfilename"]);
		$jobfolderid=explode('/', $row["jobfolder"]);
		$jobfolderid=end($jobfolderid);
		
		if ($enditemid != $orignameid ) {
			// Do not add load \\
			// Status field not editable \\
			echo "<td id=\"status:".$row["id"]."\"  tabindex=".($counter+1).">".$row["status"]."</td>";
		} else {
			// Add Load\\
			echo "<a href=\"#\" id=\"status:".$row["enditemfn"].":".$row["jobfolder"]."\" onclick='location.href =\"http://plmtrcsc5:9322/job/job2review/getplminfo_".$enditemid."~".$jobfolderid.".xlsx\" '>Load</a><a href=\"#\" id=\"status:".$row["enditemfn"].":".$row["jobfolder"]."\"  >Close</a><td id=\"dummystatus:".$row["id"]."\" contenteditable=\"true\" tabindex=".($counter+1).">".$row["status"]."</td>";
		}
		
		echo "<td id=\"origfilename:".$row["id"]."\" tabindex=".($counter+2).">".$row["origfilename"]."</td><td id=\"rename_to:".$row["id"]."\" tabindex=".($counter+3).">".$row["rename_to"]."</td><td id=\"epic_pn:".$row["id"]."\" tabindex=".($counter+4).">".$row["epic_pn"]."</td><td id=\"latest_rev:".$row["id"]."\" tabindex=".($counter+5).">".$row["latest_rev"]."</td><td id=\"propname:".$row["id"]."\" tabindex=".($counter+6).">".$row["propname"]."</td><td id=\"description:".$row["id"]."\" tabindex=".($counter+7).">".$row["description"]."</td><td id=\"catia_rel:".$row["id"]."\" tabindex=".($counter+8).">".$row["catia_rel"]."</td><td id=\"cad_env:".$row["id"]."\" tabindex=".($counter+9).">".$row["cad_env"]."</td><td id=\"part_type:".$row["id"]."\" tabindex=".($counter+10).">".$row["part_type"]."</td><td id=\"lastmdate:".$row["id"]."\" tabindex=".($counter+11).">".$row["lastmdate"]."</td><td id=\"jobfolder:".$row["id"]."\" tabindex=".($counter+12)."><a href=\"file:" .$row["jobfolder"]."\" title=\"Download from: ".$row["jobfolder"]."\" target=\"_blank\">".$jobfolderid."</a></td></tr>";
		// Add to Tabindex Counter \\
		$counter = $counter + 13;
	}
} else {
	echo "<h2 id=\"sqlError\">Error: No data could be retrieved.</h2>";
}
// Close Connection \\
$conn->close();
?>
<script type="text/javascript">
	// Reinitialize onBlur Listener \\
	$(function(){
			//$('td[contenteditable=true]').dblclick(function(){
			$("[id^=status]").click (function () {
				var field_userid = $(this).attr("id");
				var value = $(this).text();
				//var value = "Completed";
				//alert (field_userid);
				$.post('imports/ajaxEnditem.php', field_userid + "=" + value, function(data){
					//alert (data);
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
				location.reload();
			});
			
		});
	// Reinitialize onBlur Listener \\
	$(function(){
			$('td[contenteditable=true]').blur(function(){
			//$("[id^=status]").click (function () {
				var field_userid = $(this).attr("id");
				var value = $(this).text();
				//var value = "Completed";
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