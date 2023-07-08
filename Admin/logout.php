<?php
	session_start();
	$_SESSION=array();
	if(isset($_COOKIE["email"])){
		setcookie("email", '', strtotime( '-5 days' ), '/');	
	}
	header("Location:index.php");
	die();
	
	session_destroy();
?>