<?php 
	require("../ligacaoBD.php");
	
	session_start(); //Starts the session

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

?>
<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>  
	<script>
		function showCat(str) //str é o id que vem da escolha na combobox
		{
		   // alert(str);

		    if (str == "") 
		    {
		        document.getElementById("txtHint").innerHTML = "";
		        return;
		    } 
		    else 
		    { 
		        if (window.XMLHttpRequest) 
		        {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } 
		        else 
		        {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() 
		        {
		        	
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		            {
		                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","getcat.php?idC="+str,true);
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
	<table class="procura" id="add_prod_table" name="add_prod_table">
	<form action="adicionarProduto.php" method="POST">
		<tr bgcolor="#c1c1ff"> 
			<td colspan="2"> 
				<h2> Adicionar novo Produto </h2> 
			</td> 
		</tr>
	 	<tr> <td> <p class="label"> Descrição Produto: </p> </td> 	<td> <p> <input type="text" name="nome" class="selected" required> </p> </td></tr>
        <tr> <td> <p class="label"> Número de Série: </p> </td> 	<td> <p> <input type="text" name="numSerie" class="selected" required> </p> </td> </tr>
        <tr> <td> <p class="label"> Código Barras: </p> </td> 		<td> <p> <input type="text" name="cod" class="selected" required> </p> </td> </tr>
        <tr> <td> <p class="label"> Peso: (gr) </p> </td> 		<td> <p> <input type="text" name="peso" class="selected"> </p> </td> </tr>
        <tr> <td> <p class="label"> Quantidade: </p> </td> 				<td> <p> <input type="text" name="quantidade" class="selected"> </p>  </td> </tr>
		<tr> <td> <p class="label"> Preço: (€) </p> </td> 				<td> <p> <input type="text" name="preco" class="selected"> </p>  </td> </tr>
	


		<tr> 
    		<td> <p class="label"> Categoria:</p> </td> 
    		<td>
				<?php
					//$sql = "SELECT id_Subcategoria, subcategoria, id_Categoria FROM subcategorias";
					$sql = "SELECT id_categoria, nome_categoria 
							FROM categorias 
							ORDER BY id_categoria ASC";
					
					if ($smtp = $mysqli->prepare($sql))
					{
						$smtp->execute();						
						$smtp->bind_result($idCat, $cat);

						echo "<p class='label'> <select name='idCat' class='selected' onchange='showCat(this.value)' required>";
						echo "<option value='$idCat' selected> Seleccione uma categoria </option>\n";
						while ($smtp->fetch())
						{	
							echo "<option value='$idCat' > $cat </option>\n";
						}
						echo "</select></p>";
					}
				?>
			</td>
		</tr>
		<!-- ##############Construção da Subcategoria #############-->
		<tr> 
    		<td> <p class="label"> Subcategoria</p> </td> 
    		<td>
    			<p class='label'>
    				<select name='idSub' class='selected' id="txtHint" required>
    					<option value="" selected> Seleccione uma subcategoria </option>
    				</select>
    			</p>
			</td>
		</tr>

		<tr> 
    		<td> <p class="label"> Marca: </p> </td>
    		<td>
	<?php

		$sql = "SELECT id_Marca, marca 
				FROM marcas";
		
		if ($smtp = $mysqli->prepare($sql))
		{
			$smtp->execute();						
			$smtp->bind_result($idM, $marca);

			echo "<p class='label'> <select name='idM' class='selected' required>";
			echo "<option value='$idM' selected> Seleccione uma marca </option>\n";
			while ($smtp->fetch())
			{	
				echo "<option value='$idM'>  $marca ($idM) </option>\n";
				
			}
			echo "</select></p>";
		}
	?>
			</td>
		</tr>
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="adicionar" class="button" value="adicionar"> </td>
	</form>
	</table>
<?php
	$select = "SELECT * FROM produtos";

 	if(isset($_POST['adicionar']))
	{
		//var_dump($_POST);
		$idP = mysqli_insert_id();
		$nome = mysqli_real_escape_string($mysqli, $_POST["nome"]); 
		$numSerie = mysqli_real_escape_string($mysqli, $_POST["numSerie"]);
		$cod = mysqli_real_escape_string($mysqli, $_POST["cod"]);
		$peso = mysqli_real_escape_string($mysqli, $_POST["peso"]);
		$quantidade = mysqli_real_escape_string($mysqli, $_POST["quantidade"]);
		$preco = mysqli_real_escape_string($mysqli, $_POST["preco"]);
		//$idCat = mysqli_real_escape_string($mysqli, $_POST["idCat"]);
		$idSub = mysqli_real_escape_string($mysqli, $_POST["idSub"]);
		$idM = mysqli_real_escape_string($mysqli, $_POST["idM"]);
		
		$sql = "INSERT INTO produtos 
		VALUES (
			'$idP',
			'$nome', 
			'$numSerie', 
			'$cod',
			'$peso', 
			'$quantidade', 
			'$preco',
			'$idSub', 
			'$idM')";
				
		if (mysqli_multi_query($mysqli, $sql))
		{
			//echo "<script> alert('Cliente inserido com sucesso!') ";

			$sql = "SELECT * 
			FROM produtos 
			ORDER BY id_produto 
			DESC LIMIT 1";
			//$result = $mysqli->query($sql);

			//if ($result->num_rows > 0) 
			if($result = $mysqli->query($sql))
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			      	//echo "<script> alert(\"ID Produto: ".$row["id_produto"].". Descrição Produto: " .$row["nome_produto"]. "\");</script>";
			      	//echo "<script type=\"text/javascript\"> 
				       					//window.location=\"sucesso.php\";
				       		// </script>";

				   
			    }
			    		echo ("<h2> Produto Adicionado com sucesso! </h2>");
			    		echo ("<script>document.getElementById('add_prod_table').style.visibility='false'</script>");
			    $result->close();
			} 
			else 
			{
			    echo "<script> alert('0 results') </script>";
			}
		}
		else
		{
			echo "ERROR: " .$sql. "<br>" . $mysqli->error;
		}
		
	}
?>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>
