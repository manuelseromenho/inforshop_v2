
<?php 
	require("../ligacaoBD.php");
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	$id_cat_=$_GET['id_cat'];
	$id_sub=$_GET['id_sub'];
	$id_marca=$_GET['id_marca'];

?>

<html>
<head>
	<title> INFORSHOP </title>
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
<body >
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
	<form action="editarProduto.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar um Produto </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Produto: </p> </td> 	<td> <p> <input type="text" name="idP" value="<?php $idP=$_GET['idP']; echo $idP; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Nome: </p> </td> 		<td> <p> <input type="text" name="nome" value="<?php $nome=$_GET['nome']; echo $nome; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Número Série: </p> </td> <td> <p> <input type="text" name="numSerie" value="<?php $numSerie=$_GET['num_serie']; echo $numSerie; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Código Barras: </p> </td> <td> <p> <input type="text" name="cod" value="<?php $cod=$_GET['codigo_barras']; echo $cod; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Peso: </p> </td> <td> <p> <input type="text" name="peso" value="<?php $peso=$_GET['peso']; echo $peso; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Stock: </p> </td> 		<td> <p> <input type="text" name="stock" value="<?php $stock=$_GET['quantidade']; echo $stock; ?>" class="selected"> </p> </td> </tr>
		<tr> <td> <p class="label"> Preço: </p> </td> 		<td> <p> <input type="text" name="preco" value="<?php $preco=$_GET['preco']; echo $preco; ?>" class="selected"> </p> </td> </tr>
    	
    	<tr> 
    		<td> <p class="label"> Categoria:</p> </td> 
    		<td>
				<?php
					echo "<p class='label'> 
						<select name='id_cat' class='selected' onchange='showCat(this.value)' required>";
					
					$sql = "SELECT id_categoria, nome_categoria 
							FROM categorias
							ORDER BY id_categoria ASC";

					if ($stmt = $mysqli->prepare($sql))
					{
						$stmt->execute();						
						$stmt->bind_result($id_cat, $cat);

						
						while ($stmt->fetch())
						{	
							if($id_cat_ == $id_cat)
							{
								echo "<option value='$id_cat_' selected='selected'>$cat</option>";
								$id_cat = $id_cat_;
							}
							else
							{
								echo "<option value='$id_cat' > $cat </option>";
							}
							
						}
					}

					echo "</select></p>";
				?>
			</td>
		</tr>
    	
    	<tr> 
    		<td> <p class="label"> Subcategoria</p> </td> 
    		<td>
    			<p class='label'>
    				<select name='id_sub' class='selected' id="txtHint" required>
	    				<?php

	    					$sql_subcategorias= "SELECT s.id_subcategoria, s.nome_subcategoria 
	    					FROM subcategorias as s, categorias as c 
							WHERE s.id_categoria = c.id_categoria AND s.id_categoria = '$id_cat_'";
	
							if ($stmt2 = $mysqli->prepare($sql_subcategorias))
							{
								$stmt2->execute();						
								$stmt2->bind_result($idS, $sub);

								while ($stmt2->fetch())
								{	
									if($id_sub == $idS)
									{
										echo "<option value='$id_sub' selected>  $sub</option>";
										$idS = $id_sub;
									}
									else
									{
										echo "<option value='$idS'>  $sub </option>";
									}									
								}
							}	
						?>
    				</select>


    			</p>
			</td>
		</tr>
    	
    	<tr> 
    		<td> <p class="label"> ID Marca: </p> </td>
    		<td>
	    		<?php
					$sql = "SELECT id_Marca, marca 
							FROM marcas";
					
					echo "<p class='label'> <select name='id_marca' class='selected' required>";
					if ($stmt3 = $mysqli->prepare($sql))
					{
						$stmt3->execute();						
						$stmt3->bind_result($idM, $marca);

						
						while ($stmt3->fetch())
						{	
							if($idM == $id_marca)
							{
								echo "<option value='$id_marca' selected> $marca </option>";
								$idM = $id_marca;
							}
							else
							{
								echo "<option value='$idM'>  $marca </option>";
							}
						}
						echo "</select></p>";
					}
				?>
			</td>
    	</tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>

	<?php
		if(isset($_POST['editar']))
		{

			$idP = $_POST['idP'];
			$nome = $_POST['nome'];
			$numSerie = $_POST['numSerie'];
			$cod = $_POST['cod'];
			$peso = $_POST['peso'];
			$stock = $_POST['stock'];
			$preco = $_POST['preco'];
			$id_sub = $_POST['id_sub'];
			$id_marca = $_POST['id_marca'];

			//echo $idp." ".$nome." ".$numSerie." ".$cod." ".$peso." ".$stock." ".$preco." ".$id_sub." ".$id_marca;

			
			$sql = "UPDATE produtos 
			SET nome_produto='$nome', 
			num_serie='$numSerie', 
			cod_barras='$cod',
			peso='$peso',
			quantidade='$stock', 
			preco_venda='$preco', 
			id_subcategoria='$id_sub', 
			id_marca='$id_marca' 
			WHERE id_produto='$idP'";

			//echo $sql;

			if ($mysqli->query($sql) === TRUE) 
			{
				echo "<h2>O produto foi alterado com sucesso!</h2>";
			}
			else
			{
				//echo "ERROR: " .$sql." ".$mysqli->error;
				echo "<br><br><b>MYSQL ERROR:<b><br>";
				echo mysqli_error($mysqli);
			}

			mysqli_close($mysqli);
		}

	?>

	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>

</body>
</html>


