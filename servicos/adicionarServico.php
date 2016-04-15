<?php 
	require("../ligacaoBD.php");
	
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:/login.php");
		exit;
	}

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

		<table class="procura">
			<form action="adicionarServico.php" method="POST">
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar novo Serviço </h2> </td> </tr>
				 
		    	<tr> <td> <p class="label"> Tipo Serviço: </p> </td> 	<td> <p> <input type="text" name="tipo_servico" class="selected"> </p> </td></tr>
		        <tr> <td> <p class="label"> Preço: (€) </p> </td> 			<td> <p> <input type="text" name="preco" class="selected"> </p> </td> </tr>
		        <tr> <td> <p class="label"> Tempo Estimado: (min) </p> </td> 	<td> <p> <input type="text" name="tempo_estimado" class="selected"> </p>  </td> </tr>
				
				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="adicionar" class="button" value="adicionar"> </td>
			</form>
		</table>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>

<?php

	if(isset($_POST['adicionar']))
	{
		if (array_key_exists('adicionar',$_POST))
		{
			$sql="INSERT INTO servicos SET 			
						tipo_servico = ?, 
						preco = ?,
						tempo_estimado = ?";

			
			
			//VERIFICAÇÃO DA INTRODUÇÃO DE VALORES NULOS NO FORMULARIO
			if($_POST['tipo_servico'] == '') 
			{
				$tipo_servico = null;
				echo "<br>Tipo de Serviço não pode estar vazio";
			}
			else $tipo_servico = $_POST['tipo_servico'];

			if($_POST['preco'] == '') 
			{
				$preco = null;
				echo "<br>Preço não pode estar vazio";

			}
			else $preco = $_POST['preco'];

			if ($stmt = $mysqli->prepare($sql))
			{
				$stmt->bind_param('sss'
				, $tipo_servico
				, $preco
				, $_POST['tempo_estimado']
				);

				if($stmt->execute())
				{
					echo "<script type=\"text/javascript\"> 
				       					window.location=\"sucesso.php\";
				       		 </script>";
				}
				else
				{
					echo "<br>".mysqli_error($mysqli);
				}
			}
			else
			{
				//echo mysqli_error($mysqli);			
			}					

		}
		else
		{
			mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
		}
		
	}
	else 
		{
				//echo mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
				//echo "<script> alert('$mysqli->error') </script>";
			    //echo "<script> alert('Impossivel inserir este registo. TENTE DE NOVO.'); </script>";
		}

	$stmt->close();
 	$mysqli->close();
?>