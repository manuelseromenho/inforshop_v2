<?php 
	session_start(); //Starts the session
	if(!isset($_SESSION['user'])) {
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	$id_cat_ = $_GET['id_cat'];


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
	<form action="editar_subcategoria.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar uma Subcategoria </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Subcategoria: </p> </td> <td> <p> <input type="text" name="id_sub" value="<?php $id_sub=$_GET['id_sub']; echo $id_sub; ?>" class="selected" readonly> </p> </td> </tr>
    	<tr>
       		<td> <p class="label"> Categoria: </p> </td> 	
			<td> 
				<?php
					$select = "SELECT id_categoria, nome_categoria FROM categorias ORDER BY id_categoria ASC";
					
					if ($smtp = $mysqli->prepare($select))	{
						$smtp->execute();						
						$smtp->bind_result($id_cat, $cat);

						echo "<p class='label'> <select name='id_cat' class='selected'>";
						while ($smtp->fetch()) {	
							if($id_cat_ == $id_cat){
								echo "<option value='$id_cat_' selected> $cat ($id_cat) </option>\n";
								$id_cat = $id_cat_;
							} else {
								echo "<option value='$id_cat'> $cat ($id_cat) </option>\n";						
							}
						}
						echo "</select>";
					}
				?>
			</td>
		</tr>
		<tr> <td> <p class="label"> Subcategoria: </p> </td> <td> <input type="text" name="sub" value="<?php $sub=$_GET['sub']; echo $sub; ?>" class="selected"> </td>
		</tr>
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>

<?php
		if(isset($_POST['editar'])) 
		{
			$id_sub = $_POST['id_sub'];
			$sub = $_POST['sub'];
			$id_cat = $_POST['id_cat'];

			$update =  "UPDATE subcategorias 
						SET id_subcategoria='$id_sub', nome_subcategoria='$sub', id_categoria='$id_cat' 
						WHERE id_subcategoria='$id_sub';";

			if ($stmt = $mysqli->prepare($update)) 
			//if($mysqli->query($update) === TRUE)
			{
				$stmt->execute();
				$stmt->bind_result($id_sub, $sub, $id_cat);			
				$stmt->close();
				echo "<h2> Subcategoria alterada com sucesso! </h2>";
			}
			else
			{ 
				//echo "<br><br><b>MYSQL ERROR:<b><br>";
				echo mysqli_error($mysqli);
			}

			$mysqli->close();
		}
	?>
	


	</div>


	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>
