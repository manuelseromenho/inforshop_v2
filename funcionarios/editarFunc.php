<?php 
	require("../ligacaoBD.php");
	session_start(); /* Starts the session */

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
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
	<form action="editarFunc.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <h2> Editar um Funcionário </h2> </td> </tr>
	 	
	 	<tr> <td> <p class="label"> ID Funcionário: </p> </td> 	<td> <p> <input type="text" name="id" value="<?php $id=$_GET['id']; echo $id; ?>" class="selected" maxlength="4" readonly="readonly"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Nome: </p> </td> 		<td> <p> <input type="text" name="nome" value="<?php $nome=$_GET['nome']; echo $nome; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Morada: </p> </td> 		<td> <p> <input type="text" name="morada" value="<?php $morada=$_GET['morada']; echo $morada; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Telefone: </p> </td> 	<td> <p> <input type="text" name="telefone" value="<?php $telefone=$_GET['telefone']; echo $telefone; ?>" maxlength="9" class="selected"> </p> </td> </tr>
		<tr> <td> <p class="label"> E-mail: </p> </td> 		<td> <p> <input type="text" name="email" value="<?php $email=$_GET['email']; echo $email; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> NIF: </p> </td> 		<td> <p> <input type="text" name="nif" value="<?php $nif=$_GET['nif']; echo $nif; ?>" class="selected" maxlength="9"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Data Nascimento: </p> </td> <td> <p> <input type="text" name="dataN" value="<?php $dataN=$_GET['dataN']; echo $dataN; ?>" class="selected"> </p> </td> </tr>
    	<tr> <td> <p class="label"> Data Entrada Serviço: </p> </td> <td> <p> <input type="text" name="dataE" value="<?php $dataE=$_GET['dataE']; echo $dataE; ?>" class="selected"> </p> </td> </tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="3"> <input type="submit" name="editar" class="button" value="Editar"> </td> </tr>
	</form>
	</table>

	<?php

		if(isset($_POST['editar']))
		{
			$id = $_POST['id'];
			$nome = $_POST['nome'];
			$morada = $_POST['morada'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			$nif = $_POST['nif'];
			$dataN = $_POST['dataN'];
			$dataE = $_POST['dataE'];

			$sql = "UPDATE funcionarios SET id_funcionario='$id', nome='$nome', morada='$morada', telefone='$telefone', email='$email', nif='$nif', data_nascimento='$dataN', data_entrada='$dataE' WHERE id_funcionario='$id'";

			if ($mysqli->query($sql) === TRUE) 
			{
				echo "<h2>Funcionário alterado com sucesso!</h2>";
			}
			else
			{
				//echo "ERROR: " .$sql." ".$mysqli->error;
				echo "<br><br><b>MYSQL ERROR:<b><br>";
				echo mysqli_error($mysqli);
			}
		}
		mysqli_close($mysqli);
	?>

	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>

</body>
</html>
