<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<?php
	require("../ligacaoBD.php");

	$idFunc = $_GET['idFunc'];

	if($idFunc == null)
	{
		$sql = "SELECT id_funcionario, nome, morada, telefone, nif, email, data_nascimento, data_entrada 
		FROM funcionarios 
		ORDER BY id_funcionario ASC";
	}
	else
	{
		$sql = "SELECT id_funcionario, nome, morada, telefone, nif, email, data_nascimento, data_entrada 
		FROM funcionarios 
		WHERE id_funcionario = '$idFunc'
		OR  nome LIKE '%$idFunc%'
		ORDER BY id_funcionario ASC";
	}


	if ($stmt = $mysqli->prepare($sql)) 
	{
		$stmt->execute();
		$stmt->bind_result($id, $nome, $morada, $telefone, $nif, $email, $dataN, $dataE);

		echo "<br>";

		echo "<table class='table'>";
		echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID </h2> </td> <td> <h2> Nome Funcionário </h2> </td> <td> <h2> Morada </h2> </td> <td> <h2> Telefone </h2> </td> <td> <h2> NIF </h2> </td> <td> <h2> E-MAIL </h2> </td> <td> <h2> Data Nascimento </h2> </td> <td> <h2> Data Entrada Serviço </h2> </td> <td colspan='2'> </td> </tr>";
		echo "<tr>";

		while ($stmt->fetch()) 
		{
			echo "<tr>";
			echo "<td> <p class='label'> $id </p> </td> ";
			echo "<td> <p class='label'> $nome </p> </td> ";
			echo "<td> <p class='label'> $morada </p> </td> ";
			echo "<td> <p class='label'> $telefone </p> </td>";
			echo "<td> <p class='label'> $nif </p> </td> ";
			echo "<td> <p class='label'> $email </p> </td> ";
			echo "<td> <p class='label'> $dataN </p> </td> ";
			echo "<td> <p class='label'> $dataE </p> </td> ";
			echo "<td class='img'> <a href='editarFunc.php?id=$id&nome=$nome&morada=$morada&telefone=$telefone&email=$email&nif=$nif&dataN=$dataN&dataE=$dataE'> <img src='../imagens/edit.png' title='Editar Funcionário'> </a> </td> ";
			echo "<td class='img'> <a HREF='#up' onmouseup='delFunc(".$id.")'> <img src='../imagens/trash.png' title='Eliminar Funcionário'> </a> </td> ";
			/*echo "<td class='img'> 
						<form onsubmit='delFunc(".$id.")'>
							<input type='submit'  style='background:url(../imagens/trash.png) no-repeat;' />
						</form>
				</td>";*/
			

			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";
		//$stmt->close();
		$mysqli->close();
	}

?>


</body>
</html>