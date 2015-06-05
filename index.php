<!DOCTYPE html>
<html>
	<head>
		<!--  -=TEMP=-   Meta   -=TEMP=-  -->
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/EXT" href="">
		<title>Dashboard Login</title>

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

			// Called on Login Button Press \\
			function auth(){
				var details = $('#usernameField').val()+":"+$('#passwordField').val();
				$('.auth').load('imports/authIntermediary.php?details='+details);
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
				<h3>Logging In</h3>
				<p>To log in, just enter your username and password. Remember that your username cannot include any spaces.</p>
				<h3>Password</h3>
				<p>Due to the fact this web application will be used internally, your password WILL NOT be sent over the network encrypted. As such, you should choose a password that is not identical to any other passwords you use.</h3>
				<h3>Other</h3>
				<p>Since only authentication has been added to this page, upon logging in, you will not in fact be redirected to the dashboard with your relavent permissions. Please use the 'Go to Migration Dashboard (DEBUG)' button to go directly to the migration dashboard with Admin level permissions.</h3>
				<h4 id="buttonHelpClose">Click anywhere to close.</h4>
			</div>
		</div>
		<!-- Login Title -->
		<div class="loginHeader">
			<h1>Migration Dashboard User Login</h1>
			<h2>Please enter your credentials below</h2>
		</div>
		<!-- Login Form -->
		<form id="login">
			<p class="formTitle">Username</p>
			<input type="text" name="username" id="usernameField"/>
			<p class="formTitle">Password</p>
			<input type="password" name="password" id="passwordField"/>
			<!-- Uncomment Below for Multiple Roles -->
			<!--<p class="formTitle roleHidden">Select Role<br/> (When authentication is finished,<br/> this menu, or some options may<br/> not show up)</p>-->
			<div class="auth">
				
			</div>
			<a href="#" id="buttonGo" onclick="auth();">Login</a>
			<a href="migrationdash.php?user=Michael Leng&amp;perm=Admin" id="buttonGo">Go to Migration Dashboard (DEBUG)</a>
		</form>
		<!-- Status Messages -->
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
</html>