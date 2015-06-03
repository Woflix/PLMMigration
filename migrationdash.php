<head>
	<!--  -=TEMP=-   Meta   -=TEMP=-  -->
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/EXT" href="">
	<title>Migration Dashboard</title>

	<!--  -=TEMP=-   Styles   -=TEMP=-  -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<style type="text/css">
		/*

			This is temporary // For ease of editing

		*/
	</style>

	<!--  -=TEMP=-   JS   -=TEMP=-  -->
	<script type="text/javascript" language="javascript" src="js/main.js"></script>
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
				"scrollY": '55%',
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
					"scrollY": '55%',
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
			}, 1800);
		};

		// Listen & Act on Events on Contenteditable <td>'s \\
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

		function openHelpOverlay(){
			$('.helpOverlay').addClass('helpOverlayShowDisplay');
			setTimeout (function(){
				$('.helpOverlay').addClass('helpOverlayShow');
			}, 100);	
		}

		function closeHelpOverlay(){
			$('.helpOverlay').removeClass('helpOverlayShow');
			setTimeout (function(){
				$('.helpOverlay').removeClass('helpOverlayShowDisplay');
			}, 400);
		}
	</script>
	<?php include 'imports/head.php'; ?>
</head>
<body>
	<div class="help">
		<h4 class="helpButton" onclick="openHelpOverlay();">Help</h4>
	</div>
	<div class="helpOverlay" onclick="closeHelpOverlay();">
		<div class="helpContent">
			<h2>Help</h2>
			<h3>Searching Tables</h3>
			<p>To search a table, just type your search query into the search bar above the table. You may type search terms for multiple columns in the search bar simultaneously, and it will search all columns for matching data. For example, you can type in "John Smith 1234567" to the search bar, and rows that contain either John Smith and/or 1234567 will be filtered out. You can also click the column headers to sort data by either ascending or descending order.</p>
			<h3>Editing Tables</h3>
			<p>To edit tables, just click the specific cell that you would like to update. You will enter editing mode and will be able to type freely into the cell. Click outside the cell, into a different cell, press "Tab", or press "Enter" to finish editing that cell and push the updates to the MySQL database.</p>
			<h4 id="buttonHelpClose">Click anywhere to close.</h4>
		</div>
	</div>
	<div class="header">
		<h4 class="loginInfo">Logged in as <span class="loginInfoInline"><?php echo $_GET["user"] ?></span> with <span class="loginInfoInline"><?php echo $_GET["perm"] ?></span> level permissions</h2>
		<a id="buttonUpdate" onclick="update();" href="#">Update From Database</a>
		<a id="buttonUpdate" href="newprogramdash.php">Add Item</a>
	</div>
	<div class="tableWrapper">
		<table id="migration" width="100%">
			<thead id="migrationTableHead">
				<tr>
					<th>
						Program ID
					</th>
					<th>
						Program Name
					</th>
					<th>
						Assigned To
					</th>
					<th>
						Start Date
					</th>
					<th>
						End Date
					</th>
				</tr>
			</thead>

			<tfoot id="migrationTableFoot">
				<tr>
					<th>
						Program ID
					</th>
					<th>
						Program Name
					</th>
					<th>
						Assigned To
					</th>
					<th>
						Start Date
					</th>
					<th>
						End Date
					</th>
				</tr>
			</tfoot>
			<tbody id="migrationTableBody">
				<?php include 'imports/dataMigration.php' ?>
			</tbody>
		</table>
	</div>
	<div class="footer">
		<div class="statusWrapper">
			<div class="statusUpdated">
				Updated From Database.
			</div>
			<div class="statusWorking">
				Working...
			</div>
			<div class="statusPushed">
				Pushed To Database.
			</div>
		</div>
	</div>
</body>