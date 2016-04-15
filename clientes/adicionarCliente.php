<html>

<head>

	<title> INFORSHOP </title>
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>  

</head>

<body>
	<!-- ************ HEADER ************** -->

	<?php include("header.php"); ?>

	<!-- ***************** BODY *****************-->

	<div class="container">



		<table class="procura">

			<form action="adicionarCliente.php" method="POST">

				<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar novo Cliente </h2> </td> </tr>
		    	<tr> <td> <p class="label"> Nome: </p> </td> 		<td> <p> <input type="text" name="nome" class="selected" required> </p> </td> </tr>
		        <tr> <td> <p class="label"> Morada: </p> </td> 		<td> <p> <input type="text" name="morada" class="selected" required> </p> </td> </tr>
		        <tr> <td> <p class="label"> Telefone: </p> </td> 	<td> <p> <input type="text" name="telefone" class="selected" maxlength="9" required> </p> </td> </tr>
				<tr> <td> <p class="label"> E-mail: </p> </td> 		<td> <p> <input type="text" name="email" class="selected"> </p> </td> </tr>
		    	<tr> <td> <p class="label"> NIF: </p> </td>			<td> <p> <input type="text" name="nif" class="selected" maxlength="9" required> </p> </td> </tr>

				<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="adicionar" class="button" value="adicionar"> </td>
			</form>

		</table>

	<?php 

		require("../ligacaoBD.php");
		session_start(); /* Starts the session */

		if(!isset($_SESSION['user']))
		{
			header("location:../login.php");
			exit;
		}


		if(isset($_POST['adicionar']))
		{
		
			$id = mysqli_insert_id();
			$nif = mysqli_real_escape_string($mysqli, $_POST["nif"]);
			$nome = mysqli_real_escape_string($mysqli, $_POST["nome"]); 
			$morada = mysqli_real_escape_string($mysqli, $_POST["morada"]);
			$telefone = mysqli_real_escape_string($mysqli, $_POST["telefone"]);
			$email = mysqli_real_escape_string($mysqli, $_POST["email"]);


			//Verifica se já existe um funcionário com o mesmo NIF
			$checkn = "SELECT nif FROM clientes WHERE nif='$nif'";
			$result = mysqli_query($mysqli, $checkn);
			if(mysqli_num_rows($result)>0)
			{	
				echo "<h2> Já existe este NIF! <h2>";
			}
			else
			{	
				$sql = "INSERT INTO clientes VALUES ('','$nif','$nome', '$morada', '$telefone', '$email')";

				if (mysqli_multi_query($mysqli, $sql))
				{
					//echo "<script> alert('Cliente inserido com sucesso!') </script>";

					$sql_novo_cliente = "SELECT * FROM clientes ORDER BY id_cliente DESC LIMIT 1";
					$result = $mysqli->query($sql_novo_cliente);

					if ($result->num_rows > 0) 
					{
				    	// output data of each row
					    while($row = $result->fetch_assoc()) 
					    {
					      	
					        //echo "<script> alert(\"ID Cliente: ".$row['id_Cliente'].'.\t Nome Cliente: ' .$row['nomeCliente']. "\") </script>";
					       	/*echo "<script type=\"text/javascript\"> 
					       					window.location=\"sucesso.php\";
					       		 </script>";*/
					       	echo ("<h2> Cliente Adicionado com sucesso! </h2>");

					    }
					} 
					else 
					{
					    //echo "<script> alert('Impossivel inserir este registo. TENTE DE NOVO.'); </script>";
					    //echo mysqli_error($mysqli);
					    echo "...";
					}
				}
				else
				{
					echo "<script> alert('ERROR: ' .$sql. '<br>' . $mysqli->error.') </script>";

				}
			}
		}

		$mysqli->close();


	?>

	</div>



	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php"); ?>



</body>

</html>
