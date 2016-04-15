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
	<meta charset="utf-8">  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Serviços </h2> </td> </tr>
		<form action="pesquisarServico.php" method="POST">
			<tr>
				<td> <p class="form"> ID ou Tipo do Serviço: </p> </td> 
				<td> <p> <input type="text" name="id_servico" class="selected">	</p> </td> 
			</tr>
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
	</table>

<?php


if(isset($_POST['pesquisar']))
{
	//$id = $_POST["id"];
	
	if (array_key_exists('pesquisar', $_POST))
	{
		$id = $_POST["id_servico"];		
	}
	else
	{
		$id = "";			
	} 


	if($id == null)
	{
		$sql = "SELECT id_servico, tipo_servico, preco, tempo_estimado 
		FROM servicos
		ORDER BY id_servico";
	}
	else
	{
		$sql = "SELECT id_servico, tipo_servico, preco, tempo_estimado 
		FROM servicos
		WHERE id_servico = '$id'
		OR tipo_servico LIKE '%$id%'";
	}

	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($id, $tipo_servico, $preco, $tempo_estimado);

		echo "<br><br><br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Serviço </h2> </td> <td> <h2> Tipo de Serviço </h2> </td> <td> <h2> Preço Serviço </h2> </td> <td> <h2> Tempo Estimado </h2> </td> <td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'> $id </p> </td> ";
			echo "<td> <p class='label'> $tipo_servico </p> </td> ";
			echo "<td> <p class='label'> $preco € </p> </td> ";
			echo "<td> <p class='label'> $tempo_estimado min </p> </td>";
			echo "<td class='img'> <a href='editarServico.php?id=$id&tipo_servico=$tipo_servico&preco=$preco&tempo_estimado=$tempo_estimado'> <img src='../imagens/edit.png' title='Editar Serviço'> </a> </td> ";
			echo "<td class='img'> <a href='eliminarServico.php?id=$id'> <img src='../imagens/trash.png' title='Eliminar Serviço'> </a> </td> ";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br><br><br>";
		$stmt->close();
	}
}
$mysqli->close();
?>

	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>