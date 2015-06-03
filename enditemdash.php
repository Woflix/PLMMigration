<head>
	<!--  -=TEMP=-   Meta   -=TEMP=-  -->
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/EXT" href="">
	<title>Enditem Dashboard</title>

	<!--  -=TEMP=-   Styles   -=TEMP=-  -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<style type="text/css">
		/*

			This is temporary // For ease of editing

		*/

		body {
			text-align: center;
			margin-top: 60px;
		}

		h2.programidTitle {
			margin-top: 30px;
			margin-bottom: 50px;
			color: #666666;
		}

		[id*="actions:"] {
			text-align: center;
		}

		[id*="actions:"] a {
			margin: 0px 2px 0px 2px;
		}
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
			var updater = setTimeout (function(){
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
			}, 20000);
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
				$('.statusUpdated').addClass("statusUpdatedShow");
			}, 200);
			setTimeout (function(){
				$('.statusUpdated').removeClass("statusUpdatedShow");
			}, 2500);
		};

		function alertC(programid) {
			alert("This is a test: " + programid);
		};

		// Listen & Act on Events on Contenteditable <td>'s \\
		$(function(){
			$("td[contenteditable=true]").blur(function(){
				var field_userid = $(this).text();
				$.post('imports/ajax.php', field_userid + "=" + value, function(data){
					if(data != ''){
						$('.statusWorking').addClass("statusWorkingShow");
						setTimeout (function(){
							$('.statusWorking').removeClass("statusWorkingShow");
						}, 1000);
						// Other stuff
					}
				});
			});
		});
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
		<?php
		echo "<h2 class=\"programidTitle\">Program ID: <span id=\"scrapeProgramID\">".$_GET["programID"]."</span></h2>";
		?>
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