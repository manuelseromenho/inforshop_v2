<?php 
	session_start(); //Starts the session
	if(!isset($_SESSION['user'])) {
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	if(isset($_POST['editar'])) {
		$id_cat = $_POST['id_cat'];
		$cat = $_POST['cat'];

		$update = mysqli_query($mysqli, "UPDATE categorias SET id_categoria='$id_cat', nome_categoria='$cat' WHERE id_categoria='$id_cat'");

		if ($stmt = $mysqli->prepare($update)) {
			$stmt->execute();
			$stmt->bind_result($id_cat, $cat);
			echo "<h2> Categoria alterada com sucesso! </h2>";			
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
	<meta charset="utf-8">  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
	<form action="editarCategoria.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Categoria </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Categoria: </p> </td> 	<td> <p> <input type="text" name="id_cat" value="<?php $id_cat=$_GET['id_cat']; echo $id_cat; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Tipo Categoria: </p> </td> 	<td> <p> <input type="text" name="cat" value="<?php $cat=$_GET['cat']; echo $cat; ?>" class="selected"> </p> </td> </tr>
      
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
