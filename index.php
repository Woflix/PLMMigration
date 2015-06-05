<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/EXT" href="">
	<title>Dashboard Login</title>

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

		// Authentication Function \\
		function authed(){
			var details = $('#usernameField').val()+":"+$('#passwordField').val();
			/*$.post('imports/authMain.php', "username=" + value, function(data){
				if(data != ''){
					$('.statusWorking').addClass("statusWorkingShow");
					setTimeout (function(){
						$('.statusWorking').removeClass("statusWorkingShow");
					}, 1000);
					$('.debug').load('imports/authMain.php');
				}
			});*/
			window.location.replace('imports/authIntermediary.php?details='+details)
		}

		function auth(){
			var details = $('#usernameField').val()+":"+$('#passwordField').val();
			$('.auth').load('imports/authIntermediary.php?details='+details);
		}
	</script>
	<?php include 'imports/head.php'; ?>
</head>
<body>
	<div class="header">
		<h1>Dash/Log</h1>
		<h2>Login and authentication is not yet implemented.</h2>
	</div>
	<form id="login">
		<p class="formTitle">Username</p>
		<input type="text" name="username" id="usernameField"/>
		<p class="formTitle">Password</p>
		<input type="password" name="password" id="passwordField"/>
		<!-- Uncomment below for multiple roles -->
		<!--<p class="formTitle roleHidden">Select Role<br/> (When authentication is finished,<br/> this menu, or some options may<br/> not show up)</p>-->
		<div class="auth">
			
		</div>
		<a href="#" id="buttonGo" onclick="auth();">Login</a>
		<a href="migrationdash.php?user=Michael Leng&amp;perm=Admin" id="buttonGo">Go to Migration Dashboard (DEBUG)</a>
	</form>
	<div class="footer loginFooter">
		<div class="statusWrapper">
			<div class="statusWorking">
				<h4>Authenticating</h4>
			</div>
			<div class="statusError">
				<h4>Unable to log in. Please ensure your username and password are correct.</h4>
			</div>
		</div>
	</div>
</body>