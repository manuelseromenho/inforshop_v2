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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
<?php
	$idCompra = $_GET["idCompra"];
	
	$sql = "SELECT p.nome_produto, p.preco_venda, d.quantidade, d.desconto, p.preco_venda 
			FROM detalhes_compra as d, compra as c, produtos as p
			WHERE p.id_produto = d.id_produto
			AND d.id_compra=c.id_compra
			AND d.id_compra='$idCompra';";

	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($nome, $preco, $quantidade, $desconto, $preco);

		$preco_linha = 0;

		echo "<br>";

			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> 
					<td> <h2> Produto </h2> </td>
					<td> <h2> Preço </h2> </td>
					<td> <h2> Quantidade </h2> </td> 
					<td> <h2> Desconto </h2> </td> 
					<td> <h2> Preço </h2> </td> 
				</tr>";


			while ($stmt->fetch()) 
			{
				echo "<tr>";

				echo "<td> <p class='label'> $nome </p> </td> ";
				echo "<td> <p class='label'> $preco € </p> </td>";
				echo "<td> <p class='label'> $quantidade </p> </td>";
				echo "<td> <p class='label'> $desconto % </p> </td> ";
				$preco_linha = ($preco-$preco*($desconto/100))*$quantidade;
				echo "<td> <p class='label'> $preco_linha € </p> </td> ";
				$preco_total = $preco_total + $preco_linha;
				echo "</tr>";

			}
			echo "<tr><td><p class='label'>TOTAL:</p></td>
					<td><p class='label'>$preco_total €</p></td></tr>";
			echo "</table>";
			echo "<br>";
			$stmt->close();
	}
	else
	{ 
		echo mysqli_error ($mysqli);
	}

	$mysqli->close(); //close connection
?>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>
</body>
</html>