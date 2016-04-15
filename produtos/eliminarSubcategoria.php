<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	require("../ligacaoBD.php");

	$id_sub = $_GET["id_sub"];
	
	$sql = "DELETE FROM subcategorias WHERE id_subcategoria='$id_sub'";
	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->close(); // close statement
		echo "<h2> Subcategoria eliminada com sucesso! </h2>";
	}
	else
	{ 
		echo mysqli_error ($mysqli);
	}

	$mysqli->close(); //close connection
?>