<!DOCTYPE html>
<html>
	<head>
		<!--  -=TEMP=-   Meta   -=TEMP=-  -->
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/EXT" href="">
		<title>Add New Program</title>

		<!--  -=TEMP=-   CSS   -=TEMP=-  -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/normalize.css">
		<style type="text/css">
			/*

				This is temporary // For ease of editing

			*/


		</style>

		<!--  -=TEMP=-   JS   -=TEMP=-  -->
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
			/* 

				This is temporary // For ease of editing

			*/



			/*

				This is permanent // For page load speed

			*/

			// Hide All Status Messages \\
			function removeAllStatus() {
				$('#newItemErrorUnknown').removeClass('statusErrorShow');
				$('#newItemErrorNumbers').removeClass('statusErrorShow');
				$('#newItemErrorAddress').removeClass('statusErrorShow');
				$('#newItemErrorValues').removeClass('statusErrorShow');
				$('#newItemGoodSuccess').removeClass('statusGoodShow');
			}

			/*var statusMessages = ["errorUnkown", "errorNumbers", "errorAddress", "errorValues", "goodSuccess"];

			for (var i = 0; i < statusMessages.length; i++) {
				window["show"+statusMessages[i]] = function() {
					removeAllStatus();
					setTimeout (function(){
						$("newItem"+statusMessages[i]).addClass('statusErrorShow');
						console.log("newItem"+statusMessages[i]);
					}, 600);
					setTimeout (function(){
						$("newItem"+statusMessages[i]).removeClass('statusErrorShow');
					}, 2900);
				}
			};*/

			// Show Unknown Error Message \\
			function showErrorUnknown() {
				removeAllStatus();
				setTimeout (function(){
					$('#newItemErrorUnknown').addClass('statusErrorShow');
				}, 600);
				setTimeout (function(){
					$('#newItemErrorUnknown').removeClass("statusErrorShow");
				}, 2900);
			}

			// Show Numbers Error Message \\
			function showErrorNumbers() {
				removeAllStatus();
				setTimeout (function(){
					$('#newItemErrorNumbers').addClass('statusErrorShow');
				}, 600);
				setTimeout (function(){
					$('#newItemErrorNumbers').removeClass("statusErrorShow");
				}, 2900);
			}

			// Show Address Error Message \\
			function showErrorAddress() {
				removeAllStatus();
				setTimeout (function(){
					$('#newItemErrorAddress').addClass('statusErrorShow');
				}, 600);
				setTimeout (function(){
					$('#newItemErrorAddress').removeClass("statusErrorShow");
				}, 2900);
			}

			// Show Values Error Message \\
			function showErrorValues() {
				removeAllStatus();
				setTimeout (function(){
					$('#newItemErrorValues').addClass('statusErrorShow');
				}, 600);
				setTimeout (function(){
					$('#newItemErrorValues').removeClass("statusErrorShow");
				}, 2900);
			}

			// Show Success Message \\
			function showGoodSuccess() {
				removeAllStatus();
				setTimeout (function(){
					$('#newItemGoodSuccess').addClass('statusGoodShow');
				}, 600);
				setTimeout (function(){
					$('#newItemGoodSuccess').removeClass("statusGoodShow");
				}, 2900);
			}

			// Update .txt File \\
			function updateTxt(){
				var cadfilepathData = $('#cadfilepathField').val();
				var programidData = $('#programidField').val();
				var catiaData = $('#catiaField').val();
				var testInfo = "Nothing.";
				if (cadfilepathData !== '' && programidData !== '' && catiaData !== '') {
					if (cadfilepathData.substring(0, 18) == "\\\\a-cgqsu04\\design") {
						if (/\D/.test(programidData) == true) {
							showErrorNumbers();
						} else if (/\D/.test(programidData) == false) {
							testInfo = cadfilepathData+"~"+programidData+"~"+catiaData;
							$('.auth').load('imports/updateTxt.php?info='+testInfo);
						} else {
							showErrorUnknown();
						}
					} else {
						showErrorAddress();
					}
				} else {
					showErrorValues();
				};
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
				<h3>Creating a New Item</h3>
				<p>To create a new item, you must enter the full address of the CAD file (which must start with '\\a-cgqsu04\design'), the Program ID (which must only contain numbers), and select the Catia Release. If you enter data into the CAD file address field that does not start with '\\a-cgqsu04\design', the data will not be submitted. If you enter data into the Program ID field that contains a letter or symbol, the data will also not be submitted.</p>
				<h3>Other</h3>
				<p>Click the 'Return to Migration Dashboard' button to return to the migration dashboard.</p>
				<h4 id="buttonHelpClose">Click anywhere to close.</h4>
			</div>
		</div>
		<!-- Add New Item Title -->
		<div class="itemDashHeader">
			<h1>Add a New Item</h1>
			<h2>Please fill out the information below</h2>
		</div>
		<!-- Add New Item Form -->
		<form id="login">
			<p class="formTitle">Full CAD File Address</p>
			<input type="text" name="cadfilepath" id="cadfilepathField"/>
			<p class="formTitle">Program ID</p>
			<input type="text" name="programid" id="programidField"/>
			<p class="formTitle">Catia Release</p>
			<select id="catiaField">
				<option>
					R18
				</option>
				<option>
					R22
				</option>
				<option>
					R24
				</option>
			</select>
			<div class="auth">
				
			</div>
			<a href="#" id="buttonGo" onclick="updateTxt();">Submit</a>
			<a href="migrationdash.php?user=Michael Leng&amp;perm=Admin" id="buttonGo">Return to Migration Dashboard</a>
		</form>
		<div class="footer">
			<div class="statusError" id="newItemErrorUnknown">
				<h4>Error: Unknown error.</h4>
			</div>
			<div class="statusError" id="newItemErrorNumbers">
				<h4>Error: You may only enter numbers into the Program ID field.</h4>
			</div>
			<div class="statusError" id="newItemErrorAddress">
				<h4>Error: The CAD file address must start with '\\a-cgqsu04\design'.</h4>
			</div>
			<div class="statusError" id="newItemErrorValues">
				<h4>Error: You must provide valid values for all fields.</h4>
			</div>
			<div class="statusGood" id="newItemGoodSuccess">
				<h4>Successfully updated joblist.txt</h4>
			</div>
		</div>
	</body>
</html>