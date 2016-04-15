<?php 
	require("../ligacaoBD.php");
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	if(isset($_POST['editar']))
	{
		$id = $_POST['id'];
		$tipo_servico = $_POST['tipo_servico'];
		$preco = $_POST['preco'];
		$tempo_estimado = $_POST['tempo_estimado'];

		$sql = "UPDATE servicos 
		SET id_servico='$id', tipo_servico='$tipo_servico', preco='$preco', tempo_estimado='$tempo_estimado' 
		WHERE id_servico='$id'";

		//VERIFICAÇÃO DA INTRODUÇÃO DE VALORES NULOS NO FORMULARIO
		/*	if($_POST['tipo_servico'] == '') 
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
			else $preco = $_POST['preco'];*/

		if ($mysqli->query($sql) === TRUE) 
		{

			echo "<script type=\"text/javascript\"> window.location=\"sucesso.php\"; </script>";
		}
		else
		{
			echo "<script type=\"text/javascript\"> alert(\"ERROR: " .$sql. '\n' .$mysqli->error."\"); </script>";

		}
	}
	mysqli_close($mysqli);
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
	<table>
	<form action="editarServico.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar um Serviço </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Serviço: </p> </td> 		<td> <p> <input type="text" name="id" value="<?php $id=$_GET['id']; echo $id; ?>" class="selected" readonly="readonly"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Tipo Serviço: </p> </td> 	<td> <p> <input type="text" name="tipo_servico" value="<?php $tipo_servico=$_GET['tipo_servico']; echo $tipo_servico; ?>" class="selected" required> </p> </td> </tr>
       	<tr> <td> <p class="label"> Preço Serviço: (€) </p> </td>	<td> <p> <input type="text" name="preco" value="<?php $preco=$_GET['preco']; echo $preco; ?>" class="selected" required> </p> </td> </tr>
       	<tr> <td> <p class="label"> Tempo Estimado: </p> </td> 	<td> <p> <input type="text" name="tempo_estimado" value="<?php $tempo_estimado=$_GET['tempo_estimado']; echo $tempo_estimado; ?>" class="selected"> </p> </td> </tr>
		
		<tr bgcolor="#c1c1ff"> 
			<td colspan="3"> 
				<input type="submit" name="editar" class="button" value="Editar"/>
			</td>
		</tr>

	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>