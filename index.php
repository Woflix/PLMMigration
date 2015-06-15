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

			// Hide All Status Messages \\
			function removeAllStatus() {
				$('#loginErrorCombination').removeClass('statusErrorShow');
				$('#loginErrorCredentials').removeClass('statusErrorShow');
				$('#loginErrorSpace').removeClass('statusErrorShow');
				$('#loginGoodSuccess').removeClass('statusGoodShow');
			}

			// Show Unknown Error Message \\
			function showErrorCombination() {
				removeAllStatus();
				setTimeout (function(){
					$('#loginErrorCombination').addClass('statusErrorShow');
				}, 600);
				setTimeout (function(){
					$('#loginErrorCombination').removeClass("statusErrorShow");
				}, 2900);
			}

			// Show Unknown Error Message \\
			function showErrorCredentials() {
				removeAllStatus();
				setTimeout (function(){
					$('#loginErrorCredentials').addClass('statusErrorShow');
				}, 600);
				setTimeout (function(){
					$('#loginErrorCredentials').removeClass("statusErrorShow");
				}, 2900);
			}

			// Show Unknown Error Message \\
			function showErrorSpace() {
				removeAllStatus();
				setTimeout (function(){
					$('#loginErrorSpace').addClass('statusErrorShow');
				}, 600);
				setTimeout (function(){
					$('#loginErrorSpace').removeClass("statusErrorShow");
				}, 2900);
			}

			// Variables for Roles \\
			var admin = "Admin";
			var migration = "Migration";
			var engineer = "Engineer";

			// Show Unknown Error Message \\
			function showGoodSuccess(role) {
				removeAllStatus();
				$('#loginUserRole').append(role);
				setTimeout (function(){
					$('#loginGoodSuccess').addClass('statusGoodShow');
				}, 600);
				setTimeout (function(){
					$('#loginGoodSuccess').removeClass("statusGoodShow");
				}, 2900);
				setTimeout (function(){
					$('#loginUserRole').empty();
				}, 3400);
			}

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
			<h1>Welcome to Migration Dashboard</h1>
			
		</div>
		<!-- Login Form -->
		<form id="login">
			<!--<p class="formTitle">Username</p>
			<input type="text" name="username" id="usernameField"/>
			<p class="formTitle">Password</p>
			<input type="password" name="password" id="passwordField"/>-->
			<!-- Uncomment Below for Multiple Roles -->
			<!--<p class="formTitle roleHidden">Select Role<br/> (When authentication is finished,<br/> this menu, or some options may<br/> not show up)</p>-->
			<!--<div class="auth">
				
			</div>-->
			<!--<a href="#" id="buttonGo" onclick="auth();">Login</a>-->
			<!--<a href="migrationdash.php?user=Admin&amp;perm=Admin" id="buttonGo">Login</a>-->
			<a href="migrationdash.php?user=Admin&amp;perm=Admin" id="buttonGo">Go to Migration Dashboard</a>
		</form>
		<!-- Status Messages -->
		<div class="footer loginFooter">
			<div class="statusError" id="loginErrorCombination">
				<h4>Error: You have entered an invalid username and password combination.</h4>
			</div>
			<div class="statusError" id="loginErrorCredentials">
				<h4>Error: You have entered an invalid username or password.</h4>
			</div>
			<div class="statusError" id="loginErrorSpace">
				<h4>Error: You have entered a space in either the username or password field.</h4>
			</div>
			<div class="statusGood" id="loginGoodSuccess">
				<h4>You have successfully logged in with <span id="loginUserRole"></span> level permissions.</h4>
			</div>
		</div>
	</body>
</html>