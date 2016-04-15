<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	if(isset($_POST['editar']))
	{
		$idSub = $_POST['idSubcategoria'];
		$sub = $_POST['subcategoria'];
		$idC = $_POST['idCategoria'];


		$sql = mysqli_query($mysqli, "UPDATE subcategorias SET id_Subcategoria='$idSub', subcategoria='$sub', id_Categoria='$idC' WHERE id_Subcategoria='$idSub'");

		if ($stmt = $mysqli->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idSub, $sub, $idC);

			while ($stmt->fetch()) 
			{
				//echo "<script> alert('Produto alterado com sucesso!\n'); </script>";
			}
			echo "<h2>Subcategoria alterada com sucesso!</h2>";
			$stmt->close();
		}
	}
	
	mysqli_close($mysqli);

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
	<form action="editarSubcategoria.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Subcategoria </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Subcategoria: </p> </td> <td> <p> <input type="text" name="idSub" value="<?php $idSub=$_GET['idSub']; echo $idSub; ?>" class="input"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Subcategoria: </p> </td> 	<td> <p> <input type="text" name="subcategoria" value="<?php $sub=$_GET['sub']; echo $sub; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> ID Categoria: </p> </td> 	<td> <p> <input type="text" name="idCat" value="<?php $idCat=$_GET['idCat']; echo $idCat; ?>" class="input"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Categoria: </p> </td> 		<td> <p> <input type="text" name="categoria" value="<?php $cat=$_GET['cat']; echo $cat; ?>" class="input"> </p> </td> </tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
