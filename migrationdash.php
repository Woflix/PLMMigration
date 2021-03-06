<!DOCTYPE html>
<html>
	<head>
		<!--  -=TEMP=-   Meta   -=TEMP=-  -->
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/EXT" href="">
		<title>Migration Dashboard</title>

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
				migrationTable = $('#migration').dataTable({
					"paging": false,
					"scrollX": true,
					"scrollCollapse": true,
					"paging": false,
					"info": false,
					"dom": '<"#migrationTableTop"f><"#migrationTableBottom"t>'
				});
				// Update in 20 Seconds \\
				/*var updater = setTimeout (function(){
					$('table#migration').load('imports/dataMigration.php', 'update=true');
					setTimeout (function(){
						$('#migration').dataTable({
							"destroy": true,
							"scrollY": '55%',
							"scrollCollapse": true,
							"paging": false,
							"info": false,
							"dom": '<"#migrationTableTop"f><"#migrationTableBottom"t>'
						});
						// Show Message \\
						$('.statusUpdated').addClass("statusUpdatedShow");
					}, 200);
					setTimeout (function(){
						$('.statusUpdated').removeClass("statusUpdatedShow");
					}, 1200);
				}, 20000);*/
			});

			// Update Database on update() Call \\
			function update() {
				$('table#migration').load('imports/dataMigration.php', 'update=true');
				setTimeout (function(){
					$('#migration').dataTable({
						"destroy": true,
						"paging": false,
						"scrollX": true,
						"scrollCollapse": true,
						"paging": false,
						"info": false,
						"dom": '<"#migrationTableTop"f><"#migrationTableBottom"t>'
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
			};
		</script>
		<!-- For Permissions -->
		<?php include 'imports/intermediaryBlurListener.php' ?>
		<script type="text/javascript">
			// Listener for Enter Key \\
			var fld = document.getElementsByTagName('td[contenteditable=true]');
			if (fld.addEventListener){
				fld.addEventListener("keydown", keydown, false);
			} else if (fld.attatchEvent) {
				document.attachEvent("onkeydown", keydown);
			} else {
				document.onkeydown = keydown;
			}

			// Check if Key is Enter \\
			function keydown(e){
				if (e.keyCode == 13) {
					$('td[contenteditable=true]').blur();
					return false;
				}
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
				<h3>Editing Tables</h3>
				<p>To edit tables, just click the specific cell that you would like to update. You will enter editing mode and will be able to type freely into the cell. Click outside the cell, into a different cell, hit "Tab", or hit "Enter" to finish editing that cell and push the updates to the MySQL database. Note that some cells cannot be edited.</p>
				<h3>Enditem Dashboard</h3>
				<p>To navigate to the enditem dashboard, just click any of the Program ID's in the Program ID column. This will open the enditem dashboard in a new tab and filter the enditems by the Program ID you clicked.</p>
				<h3>Other Information</h3>
				<p>If you would like to update the table with data from the MySQL database, just click the "Update from Database" button. If you would like to add a new item, click the 'Add Item' button. You will be redirected to add item dashboard.</p>
				<h4 id="buttonHelpClose">Click anywhere to close.</h4>
			</div>
		</div>
		<!-- Header Information -->
		<div class="header">
			<h4 class="loginInfo">Logged in as <span class="loginInfoInline"><?php echo $_GET["user"] ?></span> with <span class="loginInfoInline"><?php echo $_GET["perm"] ?></span> level permissions</h2>
			<a id="buttonUpdate" onclick="update();" href="#">Update From Database</a>
			<a id="buttonUpdate" href="newitemdash.php">Add Item</a>
			<a id="buttonUpdate" href="report.php">View Report</a>
		</div>
		<!-- Migration Dashboard Table -->
		<div class="tableWrapper">
			<table id="migration" width="100%">
				<thead id="migrationTableHead">
					<tr>
						<th>
							Program ID
						</th>
						<th>
							Name
						</th>
						<th>
							Assigned To
						</th>
						<th>
							 Actual Start Date
						</th>
						<th>
							Actual End Date
						</th>
						<th>
							Status
						</th>
						<th>
							Item Qty
						</th>
						<th>
							% Cleaned
						</th>
						<th>
							Notes
						</th>
					</tr>
				</thead>
				<tbody id="migrationTableBody">
					<?php include 'imports/dataMigration.php' ?>
				</tbody>
			</table>
		</div>
		<!-- Status Messages -->
		<div class="footer">
			<div class="statusUpdated">
				<h4>Updated From Database.</h4>
			</div>
			<div class="statusPushed">
				<h4>Pushed To Database.</h4>
			</div>
		</div>
	</body>
</html>