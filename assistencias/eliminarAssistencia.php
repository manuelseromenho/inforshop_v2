<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	$id = $_GET["id"];
	$qtd = $_GET['qtd'];
	$id_produto = $_GET['id_produto'];
	
	$sql = "DELETE FROM assistencias WHERE id_assistencia='$id'";
	//if ($stmt = $mysqli->prepare($sql)) 
	if (mysqli_multi_query($mysqli, $sql))
	{
		//$stmt->execute();
		//$stmt->close(); // close statement
		//$sql2 = "UPDATE produtos SET quantidade=quantidade+$qtd WHERE id_produto='$id_produto'";
		//if (mysqli_multi_query($mysqli, $sql2))
		//{
			echo "<h2> Assistência eliminada com sucesso! </h2>";
		//}
	}
	else
	{ 
		echo mysqli_error($mysqli);
	}

	$mysqli->close(); //close connection
?>