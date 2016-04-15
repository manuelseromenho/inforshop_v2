<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	require("../ligacaoBD.php");
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
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="table">
	<form action="editarCategoria.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Categoria </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Categoria: </p> </td> 	<td> <p> <input type="text" name="idCategoria" value="<?php $idC=$_GET['idC']; echo $idC; ?>" class="input" readonly="readonly"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Tipo Categoria: </p> </td> 		<td> <p> <input type="text" name="categoria" value="<?php $cat=$_GET['cat']; echo $cat; ?>" class="input"> </p> </td> </tr>
      
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>

	<?php
	if(isset($_POST['editar']))
	{
		$idC = $_POST['idCategoria'];
		$cat = $_POST['categoria'];

		$sql = mysqli_query($mysqli, "UPDATE categorias SET nome_categoria='$cat' WHERE id_categoria='$idC'");
		echo "<h2>Categoria alterada com sucesso!</h2>";

	}
	
	mysqli_close($mysqli);
	?>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
