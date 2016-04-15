<?php 
	session_start(); //Starts the session

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");
?>

<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta charset='utf-8'>  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include('header.php'); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
		<p>----- TABELA COMPRAS -----</p>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include('footer.php'); ?>
</body>
</html>