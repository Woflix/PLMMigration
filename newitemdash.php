<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/EXT" href="">
	<title>Add New Program</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<style type="text/css">
		/*

			This is temporary // For ease of editing

		*/


	</style>

	<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		/* 

			This is temporary // For ease of editing

		*/



		/*

			This is permanent // For page load speed

		*/

		// Update .txt File \\
		function updateTxt(){
			var cadfilepathData = $('#cadfilepathField').val();
			var programidData = $('#programidField').val();
			var catiaData = $('#catiaField').val();
			var testInfo = "Nothing.";
			if (cadfilepathData !== '' && programidData !== '' && catiaData !== '') {
				if (cadfilepathData.substring(0, 18) == "\\\\a-cgqsu04\\design") {
					if (/\D/.test(programidData) == true) {
						$('.auth').append('<h2 id="sqlError">Error: You may only enter numbers into the Program ID field.</h2>');
						setTimeout (function(){
							$('.auth').empty();
						}, 2500);
					} else if (/\D/.test(programidData) == false) {	
	    				testInfo = cadfilepathData+":"+programidData+":"+catiaData;
	    				$('.auth').load('imports/updateTxt.php?info='+testInfo);
	    				setTimeout (function(){
							$('.auth').empty();
						}, 2500);
					} else {
						$('.auth').append('<h2 id="sqlError">Error: Unknown error.</h2>');
						setTimeout (function(){
							$('.auth').empty();
						}, 2500);
					}
				} else {
					$('.auth').append('<h2 id="sqlError">Error: The CAD file address must start with \'\\\\a-cgqsu04\\design\'.</h2>');
					setTimeout (function(){
						$('.auth').empty();
					}, 2500);
				}
			} else {
				$('.auth').append('<h2 id="sqlError">Error: You must provide valid values for all fields.</h2>');
				setTimeout (function(){
					$('.auth').empty();
				}, 2500);
			};
		}
	</script>
	<?php include 'imports/head.php'; ?>
</head>
<body>
	<h1>Dash/New</h1>
	<h2>Adding a new item has not yet been implemented.</h2>
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
	</form>
</body>