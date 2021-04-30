<?php 

// require_once 'connect.php';

$log = $_POST;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CompFix - Агрегатор отзывов</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/mn.css">
	<link rel="stylesheet" type="text/css" href="css/fr_in.css">
	<script src="qcrypt/qcrypt.js"></script>
</head>
<body>
	<noscript>JavaScript is currently disabled on your browser. Some functions on the site do not work properly. Turn on JavaScript for optimal site operation.</noscript>
	<div id="mnreg">
		<b style="font-size: 24px;">
			<!-- <img src="open-iconic/png/dashboard-4x.png">CompFix -->
			<span for="password" class="oi oi-dashboard" style="padding-right: 8px;"></span>CompFix
		</b>
		<h3 class="hal0">Sign Up</h3>
		<div id="mnfr">
			<form id="in-log">
				<div class="dv-imp-oi _usint">
					<span for="username" class="oi oi-person inr-oi"></span>
					<input type="text" class="form-control" id="username" placeholder="Login" name="name" required>
				</div>
				<div class="dv-imp-oi _psint">
					<span for="email" class="oi oi-envelope-closed inr-oi"></span>
					<input type="email" class="form-control" id="email" placeholder="Email" name="email" inputmode="email" required>
				</div>
				<div class="dv-imp-oi _psint">
					<span for="password" class="oi oi-lock-locked inr-oi"></span>
					<input type="password" class="form-control" id="password" placeholder="Password" name="pass" max="32" required>
				</div>
				<div class="dv-imp-oi _psint">
					<span for="password-conf" class="oi oi-circle-check inr-oi"></span>
					<input type="password" class="form-control" id="password-conf" placeholder="Confirm password" name="passc" max="32" required>
				</div>
				<div class="dv-wrdn" style="display: none;"></div>
				
				<button id="signup" type="button" class="btn btn-primary submitbtn rounded-pill" name="do_signup">Sign Up</button>
			</form>
		</div>
		<p class="sRty">У вас есть учетная запись? <a href="/login">Войти</a></p>
	</div>

	<!-- <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="js/fract.js"></script>
	
</body>
</html>