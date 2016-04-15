<?php 

	session_start(); /* Starts the session */
	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	include_once("../ligacaoBD.php");
?>

<html>
<head>

	<title> INFORSHOP </title>
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8">  
	<script>
	 	//str é o id que vem da escolha na combobox
		//function deleteAssistencia(id, qtd, id_produto) {
		function deleteAssistencia(str) 
		{
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
		        xmlhttp.open("GET","eliminarAssistencia.php?id="+str+"",true);
		        xmlhttp.send();
		    }
		}

		function pesqAssist()
		{
				var id_cliente=document.getElementById("id_cliente").value;

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
		        xmlhttp.open("POST","pesqAssist.php",true);
		        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("id_cliente=" + id_cliente);
				document.getElementById("txtHint").innerHTML = "LoAdInG...";
		}

	</script> 
</head>

<body>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
		<form action="pesquisarAssistencia.php" method="POST">
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Assistências </h2> </td> </tr>
			<!--<tr> <td> <p class="form"> Nome do Cliente: </p> </td> <td> <p class="label"> <input type="text" name="cliente" class="selected"> </p> </td> </tr>-->
			<!--################# CLIENTES ##############-->
			<tr> 
	    		<td> <p class="label"> Nome Cliente: </p> </td> 
	    		<td>
					<?php
						echo "<p class='label'> <select id='id_cliente' name='id_cliente' class='selected'>";						
						$selectC = "SELECT id_cliente, nome FROM clientes ORDER BY id_cliente ASC";

						if ($stmt = $mysqli->prepare($selectC)) {
							$stmt->execute();						
							$stmt->bind_result($id_cliente, $nomeC);
							echo "<option value='$id_cliente' selected='selected'> Selecione um cliente </option>";
							while ($stmt->fetch()) {	
								echo "<option value='$id_cliente'> $nomeC ($id_cliente) </option>";							
							}
						}
						echo "</select> </p>";
					?>
				</td>
			</tr>
			<tr bgcolor="#c1c1ff"> 
				<td colspan="2"> 
					<!--<input type="submit" value="Pesquisar" name="pesquisar" class="button">-->
					<a onmouseup="pesqAssist()" class="button">Pesquisar</a>
				</td>
			</tr>
		</form>
		</table>


		<a name="up" id="txtHint"> </a>
		<a id="pages"></a>

		

	</div>
	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php");	?>

	

</body>

</html>

