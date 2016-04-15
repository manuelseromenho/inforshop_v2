<?php 
	require("../ligacaoBD.php");
	
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
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
	
<?php

	$select = "SELECT * FROM assistencias";

 	if(isset($_POST['adicionar']))
	{
		$idA = mysql_insert_id();
		$descricaoA = mysqli_real_escape_string($con, $_POST["descricaoA"]); 
		$descricaoE = mysqli_real_escape_string($con, $_POST["descricaoE"]);
		$dataE = mysqli_real_escape_string($con, $_POST["dataE"]);
		$dataS = mysqli_real_escape_string($con, $_POST["dataS"]);
		$idC = mysqli_real_escape_string($con, $_POST["idC"]);
		$idF = mysqli_real_escape_string($con, $_POST["idF"]);

		$sql = "INSERT INTO assistencias VALUES ('$idA', '$descricaoA', '$descricaoE', '$dataE', '$dataS', '$idC', '$idF')";
		
		if (mysqli_multi_query($con, $sql))
		{
			//echo "<script> alert('Cliente inserido com sucesso!') ";

			$sql = "SELECT * FROM assistencias ORDER BY id_Assistencia DESC LIMIT 1";
			$result = $con->query($sql);

			if ($result->num_rows > 0) 
			{
		    	// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {
			        echo "<script> alert('ID Assistencia: ".$row["id_Assistencia"].". Descrição Assistência: " .$row["descricaoAssistencia"]. "') </script>";
			    }
			} 
		}
		else
		{
			echo "<script> alert('ERROR: ' .$sql. '<br>' . $con->error.') </script>";
		}
	}
?>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">

	<table class="procura">
	<form action="adicionarAssistencia.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar nova Assistência </h2> </td> </tr>
		 
    	<tr> <td> <p class="label"> Descrição Assistência: </p> </td> 	<td> <p> <input type="text" name="descricaoA" class="selected"> </p> </td></tr>
        <tr> <td> <p class="label"> Descrição Equipamento: </p> </td> 	<td> <p> <input type="text" name="descricaoE" class="selected"> </p> </td> </tr>
        <tr> <td> <p class="label"> Data de Entrada: </p> </td> 		<td> <p> <input type="date" name="dataE" class="selected"> </p>  </td> </tr>
        <tr> <td> <p class="label"> Data de Saída: </p> </td> 		<td> <p> <input type="date" name="dataS" class="selected"> </p>  </td> </tr>
		<tr> 
			<td> <p class="label"> ID Cliente: </p> </td> 					<!--<td> <p> <input type="text" name="idCliente" class="input"> </p>  </td> </tr>-->
			<td>
<?php
	$sql = "SELECT id_Cliente, nome FROM clientes ORDER BY id_Cliente";

	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idC, $nome);
		
		echo "<p class='label'> <select name='idC' class='selected'>";
		echo "<option value='$idC' selected> Seleccione um cliente  </option>\n";

		while ($smtp->fetch())
		{	
			echo "<option value='$idC'> $nome ($idC)  </option>\n";
		}
		echo "</select>";
	}
?>
			</td>
		</tr>
		<tr> <td> <p class="label"> ID Funcionário: </p> </td> 

			<td>
<?php
	$sql = "SELECT id_Func, nome FROM func ORDER BY id_func";

	if ($smtp = $con->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($idF, $nome);
		
		echo "<p class='label'> <select name='idF' class='selected'>";
		echo "<option value='$idF' selected> Seleccione um funcionário  </option>\n";

		while ($smtp->fetch())
		{	
			echo "<option value='$idF'> $nome ($idF)  </option>\n";
		}
		echo "</select>";
	}
?>
			</td>
		</tr>
		<tr><td colspan="2" bgcolor="#c1c1ff"> <input type="submit" name="adicionar" class="button" value="Adicionar"> </td>
	</form>
	</table>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>
</body>
</html>