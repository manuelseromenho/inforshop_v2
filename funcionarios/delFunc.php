<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<?php
	require("../ligacaoBD.php");

	$q = intval($_GET['idF']);

	$sql = "DELETE FROM funcionarios WHERE id_funcionario='$q'";
	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->close(); // fecha o statement
		echo ("<h2>Funcionário eliminado com sucesso!</h2>");
	}
	else
	{ 
		echo mysqli_error ($mysqli);
	}

	$mysqli->close(); //fecha a ligação
?>
</body>
</html>