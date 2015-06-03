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

		body {
			text-align: center;
		}

		#buttonGo {
			display: block;
			padding: 10px 10px 10px 10px;
			border: solid #666666 1px;
			border-radius: 15px;
			text-decoration: none;
			font-size: 16px;
			color: #666666;
			width: 280px;
			margin: 30px auto 0px auto;
			transition: color 0.3s, background 0.3s;
			-moz-transition: color 0.3s, background 0.3s;
			-webkit-transition: color 0.3s, background 0.3s;
			-o-transition: color 0.3s, background 0.3s;
		}

		#buttonGo:hover {
			background: #666666;
			color: #FFFFFF;
		}

		#login {
			text-align: center;
		}

		#usernameField {
			display: block;
			margin: 20px 0px 20px 0px;
			width: 300px;
			height: 40px;
			border-radius: 15px;
			margin: 0 auto;
		}

		#passwordField {
			display: block;
			margin: 20px 0px 20px 0px;
			width: 300px;
			height: 40px;
			border-radius: 15px;
			margin: 0 auto;
		}

		.statusError {
			width: 70%;
			margin: 0 auto;
		}

		.loginFooter {
			margin-top: 80px;
		}

		select.roleHidden {
			background: transparent;
			padding-left: 12px;
			font-size: 16px;
			width: 300px;
			height: 40px;
			text-align: center;
			border: solid #666666 1px;
			border-radius: 15px;
			-webkit-appearance: none;
		}
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
		function auth(){
			var field_user = $('#usernameField').attr("id");
			var value = $('#usernameField').val();
			alert(value);
			$.post('imports/authMain.php', "username=" + value, function(data){
				if(data != ''){
					$('.statusWorking').addClass("statusWorkingShow");
					setTimeout (function(){
						$('.statusWorking').removeClass("statusWorkingShow");
					}, 1000);
					$('.debug').load('imports/authMain.php');
				}
			});
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
		<p class="formTitle roleHidden">Select Role<br/> (When authentication is finished,<br/> this menu, or some options may<br/> not show up)</p>
		<select class="roleHidden">
			<option id="optionEngineer">
				Engineer
			</option>
			<option id="optionMigration">
				Migration
			</option>
			<option id="optionAdmin">
				Admin
			</option>
		</select>
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
			<div class="debug">
			</div>
		</div>
	</div>
</body>