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
	<form action="editarMarca.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Marca </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Marca: </p> </td> 	<td> <p> <input type="text" name="idMarca" value="<?php $idM=$_GET['idM']; echo $idM; ?>" class="input"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Marca: </p> </td> 		<td> <p> <input type="text" name="marca" value="<?php $marca=$_GET['marca']; echo $marca; ?>" class="input"> </p> </td> </tr>
       	
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>

<?php 
if(isset($_POST['editar']))
	{
		$idM = $_POST['idMarca'];
		$marca = $_POST['marca'];

		$sql = mysqli_query($mysqli, "UPDATE marcas SET marca='$marca' WHERE id_Marca='$idM'");

		echo "<h2>Marca alterada com sucesso!</h2>";	
		
		/*if ($stmt = $mysqli->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idM, $marca);

			while ($stmt->fetch()) 
			{
				//echo "<script> alert('Produto alterado com sucesso!\n'); </script>";
			}
			echo "<h2>Marca alterada com sucesso!\n'); </script>";		
			$stmt->close();
		}*/
	}
	
	mysqli_close($mysqli);
?>



	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
