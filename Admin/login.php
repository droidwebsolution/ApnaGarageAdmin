<!doctype html>
<?php 
	session_start();
	include("addons/logic.php");
	echo login();
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title> Apna Garage | Login</title>
		<link href="css/style.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" ></script>
		<script>
			$(document).on("contextmenu",function(){
				return false;
			});
			$(document).keydown(function (event) {
				if (event.keyCode == 123) {
					return false;
				} else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {      
					return false;
				} else if (event.ctrlKey && (event.keyCode === 67 || event.keyCode === 86 || event.keyCode === 85 || event.keyCode === 117)){
					return false;		   
				}
			});
		</script>
	</head>
	<body oncontextmenu='return false'>
		<div class="bodypart" style='height:100vh; background:#0e101c'>
			<div class='login'>
				<form method="post" autocomplete="off">
					<img src='images/profile.png' />
					<div class='input'>
						<i class="far fa-user"></i>
						<input type='text' name='user_email' title='Enter Email Here' required placeholder='Enter Email Here' />
					</div>
					<div class='input'>
						<i class="fas fa-lock"></i>
						<input type='password' name='user_password' title='Enter Password Here' required placeholder='Enter Password Here' />
					</div>
					<center>
						<button class="login_btn" name='user_login'>Login</button>
						<button class="login_btn" type='reset'>Reset</button>
					</center>
					<p>Forgot Password?</p>
				</form>
			</div>
		</div>
	</body>
</html>
<?php
	$pass='123ghjgflkhj9';
	$pass_enc=encrypt_decrypt('encrypt', $pass);
?>