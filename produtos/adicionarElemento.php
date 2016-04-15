<?php 
	require("../ligacaoBD.php");

	session_start(); //Starts the session 
	if(!isset($_SESSION['user'])) {
		header("location:login.php");
		exit;
	}		
?>
<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8">  
	<script>
	 	//str é o id que vem da escolha na combobox
		function deleteMarca(str) {
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
		        xmlhttp.open("GET","eliminarMarca.php?id_marca="+str,true);
		        xmlhttp.send();
		    }
		}

		//str é o id que vem da escolha na combobox
		function deleteCat(str) {
		    if (str == "") {
		        document.getElementById("txtHint2").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }

		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","eliminarCategoria.php?id_cat="+str,true);
		        xmlhttp.send();
		    }
		}

		//str é o id que vem da escolha na combobox
		function deleteSub(str) {
		    if (str == "") {
		        document.getElementById("txtHint3").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }

		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("txtHint3").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","eliminarSubcategoria.php?id_sub="+str,true);
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
	<form action="adicionarElemento.php" method="POST">
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar uma Marca </h2> </td> </tr>
		<tr> <td> <p class="label"> Marca </p> </td> 	<td> <input type="text" name="marca" class="selected"> </td> </tr>
		<tr bgcolor="#c1c1ff"> 
			<td> <input type="submit" name="adicionar_marca" class="button" value="Adicionar Marca"> </td>
			<td> <input type="submit" name="procurar_marca" class="button" value="Procurar Marca"> </td>
		</tr>
	</table>

<?php
	if(isset($_POST["adicionar_marca"])){
		$id_marca = mysql_insert_id();
		$marca = $_POST["marca"]; 
		
		$checkn = "SELECT * FROM marcas WHERE marca='$marca'";
		$sqlcheckn = mysql_query($checkn);

		if($sqlcheckn == 0)	{
			$insert = "INSERT INTO marcas VALUES ('$id_marca', '$marca')";
			
			if (mysqli_multi_query($mysqli, $insert))	{
				$select = "SELECT * FROM marcas ORDER BY id_marca DESC LIMIT 1";
				$result = $mysqli->query($select);

				if ($result->num_rows > 0) 	{
			    	// output data of each row
				    while($row = $result->fetch_assoc())  {
				        echo "<h2> Marca adicionada com sucesso! </h2>";
				    }
				}
			}
		}
	}

	if(isset($_POST["procurar_marca"])){
		$marca = $_POST["marca"];

		if (array_key_exists('pesquisar', $_POST)){
			$s = $_POST["marca"];		
		} else {
			$s = "";			
		} 

		$select = "SELECT id_marca, marca FROM marcas WHERE marca LIKE '%$marca%' ORDER BY id_marca ASC";

		if ($stmt = $mysqli->prepare($select)) {
			$stmt->execute();
			$stmt->bind_result($id_marca, $marca);

			echo "<br><br>";
			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Marca </h2> </td> <td> <h2> Marcas </h2> </td> <td colspan='2'> </td> </tr>";
			while ($stmt->fetch()) {
				echo "<tr>";
				echo "<td> <p class='label'> $id_marca </p> </td>";
				echo "<td> <p class='label'> $marca </p> </td>";
				echo "<td class='img'> <a href='editarMarca.php?id_marca=$id_marca&marca=$marca'> <img src='../imagens/edit.png' title='Editar Marca'> </a> </td> ";
				echo "<td class='img'> <a href='#up' onmouseup='deleteMarca(".$id_marca.")'> <img src='../imagens/trash.png' title='Eliminar Marca'> </a> </td> ";
				echo "</tr>";
			}
			echo "</table>";
			$stmt->close();
		}
	}
?>
	<a name="up" id='txtHint'> </a>

	<br><br><br>
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar uma Categoria </h2> </td> </tr>
		<tr> <td> <p class="label"> Categoria </p> </td> 	<td> <input type="text" name="cat" class="selected"> </td> </tr>
		<tr bgcolor="#c1c1ff"> 
			<td> <input type="submit" name="adicionar_cat" class="button" value="Adicionar Categoria"> </td> 
			<td> <input type="submit" name="procurar_cat" class="button" value="Procurar Categoria"> </td>
		</tr>
	</table>
<?php
	if(isset($_POST["adicionar_cat"])){
		$id_cat = mysql_insert_id();
		$cat = $_POST["cat"]; 
		
		$checkn = "SELECT * FROM categorias WHERE nome_categoria='$cat'";
		$sqlcheckn = mysql_query($checkn);

		if($sqlcheckn == 0)	{
			$insert = "INSERT INTO categorias VALUES ('$id_cat', '$cat')";
			
			if (mysqli_multi_query($mysqli, $insert))	{
				$select = "SELECT * FROM categorias ORDER BY id_categoria DESC LIMIT 1";
				$result = $mysqli->query($select);

				if ($result->num_rows > 0) {
			    	// output data of each row
				    while($row = $result->fetch_assoc())  {
				        echo "<h2> Categoria adicionada com sucesso! </h2>";
				    }
				} 
			}
		}
	}

	if(isset($_POST["procurar_cat"])) {
		$cat = $_POST["cat"];

		if (array_key_exists('pesquisar', $_POST))	{
			$s = $_POST["cat"];		
		}	else	{
			$s = "";			
		} 

		$select = "SELECT id_categoria, nome_categoria FROM categorias WHERE nome_categoria LIKE '%$cat%' ORDER BY id_categoria";
	 
		if ($stmt = $mysqli->prepare($select)) {
			$stmt->execute();
			$stmt->bind_result($id_cat, $cat);

			echo "<br><br>";
			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Categoria </h2> </td> <td> <h2> Categoria </h2> </td> <td colspan='2'> </td> </tr>";
			echo "<tr>";
			while ($stmt->fetch()) {
				echo "<tr>";
				echo "<td> <p class='label'> $id_cat </p> </td>";
				echo "<td> <p class='label'> $cat </p> </td>";
				echo "<td class='img'> <a href='editarCategoria.php?id_cat=$id_cat&cat=$cat'> <img src='../imagens/edit.png' title='Editar Categoria'> </a> </td> ";
				echo "<td class='img'> <a href='#up' onmouseup='deleteCat(".$id_cat.")'> <img src='../imagens/trash.png' title='Eliminar Categoria'> </a> </td> ";
				echo "</tr>";
			}
			echo "</table>";
			$stmt->close();
		}
	}
?>
	<a name="up" id='txtHint2'> </a>

	<br><br><br>
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar uma Subcategoria </h2> </td> </tr>
		<tr> <td> <p class="label"> Subcategoria </p> </td> <td> <input type="text" name="sub" class="selected"></tr>
		<tr>
			<td> <p class="label"> Categoria </p> </td>
			<td> 
<?php
	$select = "SELECT id_categoria, nome_categoria FROM categorias ORDER BY id_categoria ASC";
	
	if ($smtp = $mysqli->prepare($select))	{
		$smtp->execute();						
		$smtp->bind_result($id_cat, $cat);

		echo "<p class='label'> <select name='id_cat' class='selected'>";
		echo "<option value='$id_cat' selected> Selecione uma categoria </option>\n";
		while ($smtp->fetch()) {	
			echo "<option value='$id_cat' > $cat ($id_cat) </option>\n";						
		}
		echo "</select>";
	}
?>
			</td>
		</tr>
		<tr bgcolor="#c1c1ff"> 
			<td> <input type="submit" name="adicionar_sub" class="button" value="Adicionar Subcategoria"> </td> 
			<td> <input type="submit" name="procurar_sub" class="button" value="Procurar Subcategoria"> </td>
		</tr>
	</table>

<?php
	if(isset($_POST["adicionar_sub"])){	
		$id_sub = mysql_insert_id();
		$sub = $_POST["sub"]; 
		$id_cat = $_POST["id_cat"];
		
		$insert = "INSERT INTO subcategorias VALUES ('$id_sub', '$sub', '$id_cat')";
		
		if (mysqli_multi_query($mysqli, $insert)){
			$select = "SELECT * FROM subcategorias ORDER BY id_subcategoria DESC LIMIT 1";
			$result = $mysqli->query($select);

			if ($result->num_rows > 0){
		    	// output data of each row
			    while($row = $result->fetch_assoc()){
			        echo "<h2> Subcategoria adicionada com sucesso! </h2>";
			    }
			} 
		}	
	}

	if(isset($_POST["procurar_sub"])) {
		$sub = $_POST["sub"];
		$cat = $_POST["id_cat"]; 

		if (array_key_exists('procurar_sub', $_POST)) {
			$s = $_POST["sub"];		
			$ss = $_POST["cat"];
		}else {
			$s = "";			
			$ss = "";
		}

		$select2 = "SELECT s.id_subcategoria, s.nome_subcategoria, s.id_categoria, c.nome_categoria 
					FROM subcategorias as s, categorias as c 
					WHERE s.id_subcategoria LIKE '%$sub%'
					AND s.id_categoria LIKE '%$cat%'
					AND s.id_categoria=c.id_categoria
					ORDER BY s.id_categoria ASC";
	 
		if ($stmt = $mysqli->prepare($select2)) {
			$stmt->execute();
			$stmt->bind_result($id_sub, $sub, $id_cat, $cat);

			echo "<br><br>";
			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Subcategoria </h2> </td> <td> <h2> Subcategoria </h2> </td> <td> <h2> Categoria </h2> </td> <td colspan='2'> </td> </tr>";
			echo "<tr>";
			while ($stmt->fetch()) {
				echo "<tr>";
				echo "<td> <p class='label'> $id_sub </p> </td>";
				echo "<td> <p class='label'> $sub </p> </td>";
				echo "<td> <p class='label'> $cat </p> </td>";
				echo "<td class='img'> <a href='editar_subcategoria.php?id_sub=$id_sub&sub=$sub&id_cat=$id_cat&cat=$cat'> <img src='../imagens/edit.png' title='Editar Subcategoria'> </a> </td> ";
				echo "<td class='img'> <a href='#up' onmouseup='deleteSub(".$id_sub.")'> <img src='../imagens/trash.png' title='Eliminar Subcategoria'> </a> </td> ";
				echo "</tr>";
			}
			echo "</table>";
			$stmt->close();
		}
	}
?>
	<a name="up" id='txtHint3'> </a>

	</form>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); $mysqli->close(); ?>

</body>
</html>
