<?php 
	require("../ligacaoBD.php");
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	$id_produto = $_GET["idP"];
	
	$sql = "DELETE FROM produtos WHERE id_produto='$id_produto'";
	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		echo "<h2> Produto eliminado com sucesso! </h2>";
		
		$stmt->close(); // close statement
	}
	else
	{ 
		echo mysqli_error ($mysqli);
	}

	$mysqli->close(); //close connection
?>