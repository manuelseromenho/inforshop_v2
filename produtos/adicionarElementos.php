<?php 
	require("../ligacaoBD.php");
	
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
	<meta charset='utf-8'>  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">

		<table class="procura">
			<tr> <td colspan="2"> <h2> Adicionar uma Marca </h2> </td> </tr>
			<tr> <td> <p class="label"> Marca </p> </td> <td> <input type="text" name="idSub" class="input"> </td> </tr>
			<tr> 
				<td> <input type="submit" name="adicionarM" class="button" value="Adicionar Marca"> </td>
				<td> <input type="submit" name="procurarM" class="button" value="Procurar Marca"> </td>
			</tr>
		</table>

		<br><br><br>
		<table class="procura">
			<tr> <td colspan="2"> <h2> Adicionar uma Categoria </h2> </td> </tr>
			<tr> <td> <p class="label"> Categoria </p> </td> <td> <input type="text" name="idSub" class="input"> </td> </tr>
			<tr> 
				<td> <input type="submit" name="adicionarC" class="button" value="Adicionar Categoria"> </td> 
				<td> <input type="submit" name="procurarC" class="button" value="Procurar Categoria"> </td>
			</tr>
		</table>

		<br><br><br>
		<table class="procura">
			<tr> <td colspan="2"> <h2> Adicionar uma Subcategoria </h2> </td> </tr>
			<tr> <td> <p class="label"> Subcategoria </p> </td> <td> <input type="text" name="subcategoria" class="input"</tr>
			<tr>
				<td> <p class="label"> Categoria </p> </td>
				<td> 
<?php
	//$sql = "SELECT id_Subcategoria, subcategoria, id_Categoria FROM subcategorias";
	$sql = "SELECT id_Categoria, categoria FROM categorias";
	
	if ($smtp = $mysqli->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idC, $categoria);

		echo "<p class='label'> <select name='categorias'>";
		while ($smtp->fetch())
		{	
			if($idS != null)
			{
				echo "<option value='$idC' selected> $categoria ($idC) </option>\n";
			}
			else
			{
				echo "<option value='$idC' > $categoria ($idC) </option>\n";				
			}
		}
		echo "</select>";
	}
?>
		</td>
		</tr>
		<tr> 
				<td> <input type="submit" name="adicionarS" class="button" value="Adicionar Subcategoria"> </td> 
				<td> <input type="submit" name="procurarS" class="button" value="Procurar Subcategoria"> </td>
			</tr>
		</table>

	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>
