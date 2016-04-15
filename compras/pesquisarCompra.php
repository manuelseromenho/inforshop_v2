<?php 
	session_start(); //Starts the session 

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
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8">  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	



	<div class="container">
	<table class="procura">
	<form action="pesquisarCompra.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa das Compras </h2> </td> </tr>
		<tr> 
			<td> <p class="label"> Pesquisa de compras por nome ou ID de cliente: </p> </td>
			<td> <p> <input type="text" name="cliente" class="selected"> </p> </td>
		</tr>
		<tr bgcolor="#c1c1ff">
			<td colspan="2">
				<input type="submit" value="Pesquisar" name="pesquisarC" class="button">
			</td> 
		</tr>
	</form>
	</table>

	<?php

	if(isset($_POST['pesquisarC']))
	{
		
		if (array_key_exists('pesquisar', $_POST))
		{
			$cliente= $_POST["cliente"];		
		}
		else
		{
			$cliente= " ";			
		}

		$cliente= $_POST["cliente"];


		/* set autocommit to off */
			$mysqli->autocommit(FALSE);

			/* Insert some values */
			$mysqli->query("DROP VIEW IF EXISTS comp_por_cli;");
			$mysqli->query("CREATE VIEW comp_por_cli AS
					(SELECT DISTINCT c.id_compra, cli.id_cliente, cli.nome, c.data_compra,c.preco_total
					FROM compra as c, clientes as cli
					WHERE c.id_cliente = cli.id_cliente);");

			/* commit transaction */
			$mysqli->commit();

		if($cliente == null )
		{
			$sql = "SELECT id_compra, nome, data_compra, preco_total
					FROM comp_por_cli
					ORDER BY id_compra ASC;";
		}
		else
		{
			$sql = "SELECT id_compra, nome, data_compra, preco_total
					FROM comp_por_cli 
					WHERE id_cliente = '$cliente'
					OR nome LIKE '%$cliente%'
					ORDER BY id_compra ASC;";
		}

		
		if ($stmt = $mysqli->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($idCompra, $nome, $data, $preco_total);


			echo "<br>";

			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> 
					<td> <h2> ID Compra </h2> </td> </td> 
					<td> <h2> Nome Cliente </h2> </td> 
					<td> <h2> Data Compra </h2> </td> 
					<td> <h2> Preço Total </h2> </td> 
					<td colspan='2'> </td> 
				</tr>";


			while ($stmt->fetch()) 
			{
				echo "<tr>";

				echo "<td> <p class='label'>";
				printf ("%s", $idCompra);
				echo "</p> </td> ";
				echo "<td> <p class='label'> $nome </p> </td> ";
				echo "<td> <p class='label'> $data </p> </td>";
				echo "<td> <p class='label'> $preco_total € </p> </td> ";
				//echo "<td class='img'> <a href='editarCompra.php?idCompra=$idCompra&idP=$idP&descricao=$descricao&idCliente=$idCliente&nome=$nome&data=$data&quantidade=$quantidade&preco=$preco'> <img src='../imagens/edit.png' title='Editar Compra'> </a> </td> ";
				echo "<td class='img'> 
						<a href='eliminarCompra.php?idCompra=$idCompra'> 
						<img src='../imagens/trash.png' title='Eliminar Compra'> 
						</a>
					</td> ";
				echo "<td class='img'> 
						<a href='detalhesCompra.php?idCompra=$idCompra'> 
						<img src='../imagens/search.png' title='Detalhes Compra'> 
						</a>
					</td> ";

				echo "</tr>";
			}
			echo "</table>";
			echo "<br>";
			$stmt->close();
		}
		else
		{
			//echo "ERROR: " .$sql." ".$mysqli->error;
			echo "<br><br><b>MYSQL ERROR:<b><br>";
			echo mysqli_error($mysqli);
		}
	}
	$mysqli->close();
?>


	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>

