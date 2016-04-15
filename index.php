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

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="shortcut icon" type="image/png" href="imagens/favicon.ico"/>

	<meta charset='utf-8'>  

</head>

<body>

	<!-- ************ HEADER ************** -->

	<?php include('header.php') ?>

	<!-- ***************** BODY *****************-->

	<div class="container">

		<table class="table">

			<tr> <td> <h2> Unidade Curricular: </h2> </td> <td> <p class="label"> Base de Dados </p> </td> </tr>



			<tr> <td> <h2> Docente: </h2> </td> <td> <p class="label"> Pedro Cardoso </p> </td> </tr>

		</table>

	</div>

	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php"); ?>

</body>

</html>