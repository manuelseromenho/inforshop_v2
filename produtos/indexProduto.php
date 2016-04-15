<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}
?>

<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php
		include("header.php");
	?>
	<!-- ***************** BODY *****************-->
	<div class="container">
		<p>OLA MUNDO!!!! TABELA PRODUTOS </p>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php
		include("footer.php");
	?>
</body>
</html>