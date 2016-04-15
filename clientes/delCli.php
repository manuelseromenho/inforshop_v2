<?php
	require("../ligacaoBD.php");

	$q = intval($_GET['idC']);

	$sql = "DELETE FROM clientes WHERE id_cliente='$q'";
	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->close(); // fecha o statement
		echo ("<h2>Cliente eliminado com sucesso!</h2>");
	}
	else
	{ 
		echo mysqli_error ($mysqli);
	}

	$mysqli->close(); //fecha a ligação
?>
