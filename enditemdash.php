<head>
	<!--  -=TEMP=-   Meta   -=TEMP=-  -->
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/EXT" href="">
	<title>Enditem Dashboard</title>

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
			enditemTable = $('#enditem').dataTable({
				"scrollY": '55%',
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
					"scrollY": '55%',
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
			}, 200);
			setTimeout (function(){
				$('.statusUpdated').removeClass("statusUpdatedShow");
			}, 1500);
		};

		// Testing \\
		function alertC(programid) {
			alert("This is a test: " + programid);
		};

		// Listen & Act on Events on Contenteditable <td>'s \\
		$(function(){
			$("td[contenteditable=true]").blur(function(){
				var field_userid = $(this).attr("id");
				var value = $(this).text();
				$.post('imports/ajaxEnditem.php', field_userid + "=" + value, function(data){
					if(data != ''){
						$('.statusPushed').addClass("statusPushedShow");
						setTimeout (function(){
							$('.statusPushed').removeClass("statusPushedShow");
						}, 1000);
						// Other stuff
					}
				});
			});
		});

		// Listener for Enter Key \\
		var fld = document.getElementsByTagName("td[contenteditable=true]");
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
				$("td[contenteditable=true]").blur();
				return false;
			}
		}
	</script>
</head>
<body>
	<!--<div>
		End/Dash
		<h2>
			Debug:
		</h2>
		<?php
		//echo "Program ID: ".$_GET["programID"];
		?>
	</div>-->
	<div class="header">
		<h4 class="loginInfo">Logged in as <span class="loginInfoInline"><?php echo $_GET["user"] ?></span> with <span class="loginInfoInline"><?php echo $_GET["perm"] ?></span> level permissions</h2>
		<a id="buttonMigration" href="migrationdash.php?user=Michael Leng&amp;perm=Admin">Migration Dashboard</a>
		<a id="buttonProgramid" href="#">Current Program ID: <?php echo "<span id=\"scrapeProgramID\">".$_GET["programID"]."</span>"; ?></a>
		<a id="buttonUpdate" onclick="update();" href="#">Update From Database</a>
	</div>
	<div class="tableWrapper">
		<table id="enditem" width="100%">
			<thead id="enditemTableHead">
				<tr>
					<th>
						Actions
					</th>
					<th>
						Original Name
					</th>
					<th>
						Renamed To
					</th>
					<th>
						Latest Rev
					</th>
					<th>
						Data Type
					</th>
					<th>
						Jobs Folder
					</th>
				</tr>
			</thead>

			<tfoot id="enditemTableFoot">
				<tr>
					<th>
						Actions
					</th>
					<th>
						Original Name
					</th>
					<th>
						Renamed To
					</th>
					<th>
						Latest Rev
					</th>
					<th>
						Data Type
					</th>
					<th>
						Jobs Folder
					</th>
				</tr>
			</tfoot>
			<tbody id="enditemTableBody">
				<?php include 'imports/dataEnditem.php' ?>
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