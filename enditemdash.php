<!DOCTYPE html>
<html>
	<head>
		<!--  -=TEMP=-   Meta   -=TEMP=-  -->
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/EXT" href="">
		<title>Enditem Dashboard</title>

		<!--  -=TEMP=-   CSS   -=TEMP=-  -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
		<style type="text/css">
			/*

				This is temporary // For ease of editing

			*/

			
		</style>

		<!--  -=TEMP=-   JS   -=TEMP=-  -->
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			/* 

				This is temporary // For ease of editing

			*/



			/*

				This is permanent // For page load speed

			*/

			// On Document Ready \\
			$(document).ready(function(){
				// Initializing DataTables \\
				enditemTable = $('#enditem').dataTable({
					"paging": false,
					"scrollX": true,
					"scrollCollapse": true,
					"paging": false,
					"info": false,
					"dom": '<"#enditemTableTop"f><"#enditemTableBottom"t>'
				});
				// Update in 20 Seconds \\
				/*var updater = setTimeout (function(){
					var scrapeFrom = document.getElementById("scrapeProgramID");
	    			var scrapeData = scrapeFrom.textContent;
					$('table#enditem').load('imports/dataEnditem.php?programID=' + scrapeData);
					setTimeout (function(){
						$('#enditem').dataTable({
							"destroy": true,
							"scrollY": '55%',
							"scrollCollapse": true,
							"paging": false,
							"info": false,
							"dom": '<"#enditemTableTop"f><"#enditemTableBottom"t>'
						});
						// Show Message \\
						$('.statusUpdated').addClass("statusUpdatedShow");
					}, 200);
					setTimeout (function(){
						$('.statusUpdated').removeClass("statusUpdatedShow");
					}, 2500);
				}, 20000);*/
			});

			// Update Database on update() Call \\
			function update() {
				var scrapeFrom = document.getElementById("scrapeProgramID");
	    		var scrapeData = scrapeFrom.textContent;
				$('table#enditem').load('imports/dataEnditem.php?programID=' + scrapeData);
				setTimeout (function(){
					$('#enditem').dataTable({
						"destroy": true,
						"paging": false,
						"scrollX": true,
						"scrollCollapse": true,
						"paging": false,
						"info": false,
						"dom": '<"#enditemTableTop"f><"#enditemTableBottom"t>'
					});
					// Show Message \\
					$('.statusPushed').removeClass("statusPushedShow");
					setTimeout (function(){
						$('.statusUpdated').addClass("statusUpdatedShow");
					}, 300);
				}, 500);
				setTimeout (function(){
					$('.statusUpdated').removeClass("statusUpdatedShow");
				}, 2000);
			}
		</script>
		<?php include 'imports/head.php'; ?>
	</head>
	<body>
		<!-- Help Modal -->
		<div class="help">
			<h4 class="helpButton" onclick="openHelpOverlay();">Help</h4>
		</div>
		<div class="helpOverlay" onclick="closeHelpOverlay();">
			<div class="helpContent">
				<h2>Help</h2>
				<h3>Searching Tables</h3>
				<p>To search a table, just type your search query into the search bar above the table. You may type search terms for multiple columns in the search bar simultaneously, and it will search all columns for matching data. For example, you can type in "John Smith 1234567" to the search bar, and rows that contain either John Smith and/or 1234567 will be filtered out. You can also click the column headers to sort data by either ascending or descending order.</p>
				<h3>Using the Action Buttons</h3>
				<p>Each action button under the 'Actions' column will perform a different action. Action 'A' will load and rename the getplminfo.xlsx file. Action 'B' will set the status of all items of the current job folder to 'Complete' The 'Open' button will open the job folder.</p>
				<h3>Other Information</h3>
				<p>If you would like to update the table with data from the MySQL database, just click the 'Update from Database' button. The current Program ID that is being used to filter the enditems is shown at the top of the page. You may also click the 'Migration Dashboard' button to return to the migration dashboard.</p>
				<h4 id="buttonHelpClose">Click anywhere to close.</h4>
			</div>
		</div>
		<!-- Header Information -->
		<div class="header">
			<h4 class="loginInfo">Logged in as <span class="loginInfoInline"><?php echo $_GET["user"] ?></span> with <span class="loginInfoInline"><?php echo $_GET["perm"] ?></span> level permissions</h2>
			<a id="buttonMigration" href="migrationdash.php?user=Michael Leng&amp;perm=Admin">Migration Dashboard</a>
			<a id="buttonProgramid" href="#">Current Program ID: <?php echo "<span id=\"scrapeProgramID\">".$_GET["programID"]."</span>"; ?></a>
			<a id="buttonUpdate" onclick="update();" href="#">Update From Database</a>
		</div>
		<!-- Enditem Dashboard Table -->
		<div class="tableWrapper">
			<table id="enditem" width="100%">
				<thead id="enditemTableHead">
					<tr>
						<th>
							Actions
						</th>
						<th>
							Status
						</th>
						<th>
							Original Name
						</th>
						<th>
							Renamed To
						</th>
						<th>
							Epic PN
						</th>
						<th>
							Latest Rev
						</th>
						<th>
							Prop Name
						</th>
						<th>
							Description
						</th>
						<th>
							Catia Rel
						</th>
						<th>
							CAD Env
						</th>
						<th>
							Part Type
						</th>
						<th>
							Last Modified Date
						</th>
						<th>
							Job Folder
						</th>
					</tr>
				</thead>
				<tbody id="enditemTableBody">
					<?php include 'imports/dataEnditem.php' ?>
				</tbody>
			</table>
		</div>
		<!-- Status Messages -->
		<div class="footer">
			<div class="statusUpdated">
				<h4>Updated From Database.</h4>
			</div>
		</div>
	</body>
</html>