<?php 
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	$id_marca = $_GET["id_marca"];
	
	$sql = "DELETE FROM marcas WHERE id_Marca='$id_marca'";
	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->close(); // close statement
		echo "<h2> Marca eliminada com sucesso! </h2>";
	}
	else
	{ 
		echo mysqli_error ($mysqli);
	}

	$mysqli->close(); //close connection
?>