<?php 
	session_start(); //Starts the session
	if(!isset($_SESSION['user'])) {
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	if(isset($_POST['editar'])) {
		$id_marca = $_POST['id_marca'];
		$marca = $_POST['marca'];

		$update = mysqli_query($mysqli, "UPDATE marcas SET id_marca='$id_marca', marca='$marca' WHERE id_marca='$id_marca'");

		if ($stmt = $mysqli->prepare($update)) {
			$stmt->execute();
			$stmt->bind_result($id_marca, $marca);			
			$stmt->close();
			echo "<h2> Marca alterada com sucesso! </script>";	
		}
	}	
	mysqli_close($mysqli);

?>

<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8">  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
	<form action="editarMarca.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Marca </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Marca: </p> </td> 	<td> <p> <input type="text" name="id_marca" value="<?php $id_marca=$_GET['id_marca']; echo $id_marca; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Marca: </p> </td> 		<td> <p> <input type="text" name="marca" value="<?php $marca=$_GET['marca']; echo $marca; ?>" class="selected"> </p> </td> </tr>
       	
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
