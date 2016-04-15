<?php 
	session_start(); 				/* Starts the session */
	session_destroy(); 				/* Destroy started session */
	echo ("<script> alert('Terminar sessão.') </script>");
	header("location:login.php");  	/* Redirect to login page */
	exit;
?>

