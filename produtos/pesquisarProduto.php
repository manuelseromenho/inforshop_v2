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
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8"> 
	<script>
	 	//str é o id que vem da escolha na combobox
		function deleteProd(str) {
		    if (str == "") {
		        document.getElementById("txtHint").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }

		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","eliminarProduto.php?idP="+str,true);
		        xmlhttp.send();
		    }
		}
	</script> 

 </head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Produtos </h2> </td> </tr>
		<form action="pesquisarProduto.php" method="POST">
			<tr> <td> <p class="form"> Nome do Produto: </p> </td> <td> <p> <input type="text" name="id_produto" class="selected"> </p> </td> </tr>
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
	</table>

<?php

if(isset($_POST['pesquisar']))
{
	//$idp = $_POST["id_produto"];
	
	if (array_key_exists('pesquisar', $_POST))
	{
		$idp = $_POST["id_produto"];		
	}
	else
	{
		$idp = "";			
	} 

	//Caso não seja indicado o num de produto a visualizar, lista todos os produtos
	if($idp == null)
	{
		$sql = "SELECT p.id_produto, p.nome_produto, p.num_serie, p.cod_barras, p.peso, 
				p.quantidade, p.preco_venda, s.nome_subcategoria, c.nome_categoria, m.marca,
				c.id_categoria, p.id_subcategoria, p.id_marca 
				FROM produtos as p, subcategorias as s, categorias as c, marcas as m
				WHERE p.id_subcategoria=s.id_subcategoria 
				AND s.id_categoria=c.id_categoria 
				AND p.id_marca=m.id_marca
				ORDER BY p.id_produto ASC";
	
	}
	else
	{
		$sql = "SELECT p.id_produto, p.nome_produto, p.num_serie, p.cod_barras, p.peso, 
				p.quantidade, p.preco_venda, s.nome_subcategoria, c.nome_categoria, m.marca,
				c.id_categoria,	p.id_subcategoria, p.id_marca
				FROM produtos as p, subcategorias as s, categorias as c, marcas as m 
				WHERE p.nome_produto LIKE '%$idp%'
				AND p.id_subcategoria=s.id_subcategoria 
				AND s.id_categoria=c.id_categoria 
				AND p.id_marca=m.id_marca
				ORDER BY p.id_produto ASC";


	}
 
	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		//$stmt->bind_result($idp, $nome, $num_serie, $cod_barras, $peso, $quantidade, $preco, $id_subcategoria, $id_categoria, $subcategoria, $categoria, $id_marca, $marca);
		$stmt->bind_result(
			$idP, 
			$nome, 
			$num_serie, 
			$cod_barras, 
			$peso, 
			$quantidade, 
			$preco,
			$subcategoria, 
			$categoria, 
			$marca,
			$id_cat,
			$id_sub,
			$id_marca);

		echo "<br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> 
		<td> <h2> ID Produto </h2> </td> 
		<td> <h2> Nome Produto </h2> </td> 
		<td> <h2> Número Série </h2> </td> 
		<td> <h2> Código Barras </h2> </td> 
		<td> <h2> Peso </h2> </td>
		<td> <h2> Quantidade </h2> </td> 
		<td> <h2> Preço </h2> </td> 
		<td> <h2> Subcategoria </h2> </td> 
		<td> <h2> Categoria </h2> </td> 
		<td> <h2> Marca </h2> </td>  
		<td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'> $idP </p> </td> ";
			echo "<td> <p class='label'> $nome </p> </td> ";
			echo "<td> <p class='label'> $num_serie </p> </td> ";
			echo "<td> <p class='label'> $cod_barras</p> </td> ";
			echo "<td> <p class='label'> $peso gr </p> </td> ";
			echo "<td> <p class='label'> $quantidade </p> </td>";
			echo "<td> <p class='label'> $preco €</p> </td> ";
			echo "<td> <p class='label'> $subcategoria </p> </td> ";
			echo "<td> <p class='label'> $categoria</p> </td> ";
			echo "<td> <p class='label'> $marca </p> </td> ";
			echo "<td class='img'> <a href='editarProduto.php?
			idP=$idP
			&nome=$nome
			&num_serie=$num_serie
			&codigo_barras=$cod_barras
			&peso=$peso
			&quantidade=$quantidade
			&preco=$preco
			&id_cat=$id_cat
			&id_sub=$id_sub
			&id_marca=$id_marca'> <img src='../imagens/edit.png' title='Editar Produto'> </a> </td> ";
			
			echo "<td class='img'> <a href='#up' onmouseup='deleteProd(".$idP.")'> <img src='../imagens/trash.png' title='Eliminar Produto'> </a> </td> ";
				
			//echo "<td class='img'> <a href='eliminarProduto.php?idP=".$idp."'> <img src='../imagens/trash.png' title='Eliminar Produto'> </a> </td> ";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br><br><br>";
		$stmt->close();
	}
}
$mysqli->close();
?>
		<a name="up" id='txtHint'> </a>
		</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>
