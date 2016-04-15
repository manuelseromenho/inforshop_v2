<?php 

	session_start(); /* Starts the session */
	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}
	
	/*
	$test = "contador";
	if (!isset($_COOKIE[$test]))
	{
    	$_COOKIE[$test] = 0;
	}
	$_COOKIE[$test] = 1 + (int) max(0, $_COOKIE[$test]);
	$result = setcookie($test, $_COOKIE[$test]);
	if (!$result) {
	    throw new RuntimeException("Failed to set cookie \"$test\"");
	}
	
	//setcookie("test", 0, time()+3600, "/");*/
	

	include_once("../ligacaoBD.php");
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<?php

	$id_cliente = $_POST["id_cliente"];

/* Verificar numero de linhas */
	/* set autocommit to off */
			$mysqli->autocommit(FALSE);

			$sql_rows="SELECT a.id_Assistencia, a.descricao_assistencia, a.descricao_equipamento, 
							a.data_entrada, a.data_saida, ue.id_ue, ue.id_estado, e.estado, ue.id_servico, 
							s.tipo_servico, i.id_instal, i.id_produto, p.nome_produto, i.quantidade, 
							a.valor_total, a.id_cliente, c.nome as nome_cli, a.id_funcionario, f.nome as nome_func
					FROM assistencias as a 
					INNER JOIN usados_efetuados ue on a.id_assistencia = ue.id_assistencia
					LEFT JOIN instalacao i on i.id_assistencia = a.id_assistencia
					INNER JOIN servicos s on s.id_servico = ue.id_servico
					LEFT JOIN produtos p on p.id_produto = i.id_produto
					INNER JOIN estados e on e.id_estado = ue.id_estado
					INNER JOIN clientes c on a.id_cliente = c.id_cliente 
					INNER JOIN funcionarios f on a.id_funcionario = f.id_funcionario";


			/*$sql_rows = "SELECT a.id_Assistencia, a.descricao_assistencia, a.descricao_equipamento, 
							a.data_entrada, a.data_saida, ue.id_ue, ue.id_estado, e.estado, ue.id_servico, 
							s.tipo_servico, i.id_instal, i.id_produto, p.nome_produto, i.quantidade, 
							a.valor_total, a.id_cliente, c.nome as nome_cli, a.id_funcionario, f.nome as nome_func
						FROM assistencias as a, clientes as c, funcionarios as f, usados_efetuados as ue, servicos as s, 
						estados as e, instalacao as i, produtos as p
						WHERE a.id_cliente=c.id_cliente
						AND a.id_funcionario=f.id_funcionario";*/


							
							/*limit 10 offset 10*N;";*/

				if($id_cliente != 0)
				{
					$sql_rows .= " WHERE c.id_cliente = $id_cliente";
				}

				/*$sql_rows .= " AND ue.id_estado=e.id_estado
							AND ue.id_servico=s.id_servico
							AND ue.id_assistencia=a.id_assistencia
							AND i.id_assistencia=a.id_assistencia
							AND i.id_produto=p.id_produto
							ORDER BY a.id_assistencia ASC";*/
				$sql_rows .=" ORDER BY a.id_assistencia ASC";


			/* Insert some values */
			$mysqli->query("DROP VIEW IF EXISTS assist_cli;");
			$mysqli->query("CREATE VIEW assist_cli AS ($sql_rows);");

			/* commit transaction */
			$mysqli->commit();

	


	if ($stmt_rows= $mysqli->prepare($sql_rows)) 
	{
		$stmt_rows->execute();
		$stmt_rows->store_result();
		$numlinhas= $stmt_rows->num_rows;
		$numpag= round($numlinhas/2);
		$stmt_rows->close();
	}

/* SQL consoante lista geral ou cliente especifico */
	$sql_rows = "SELECT * FROM assist_cli;";



		if ($stmt = $mysqli->prepare($sql_rows)) 
		{
			$stmt->execute();
			$stmt->bind_result($id, $descricao_a, $descricao_e, $data_e, $data_s, $id_ue, $id_estado, $estado, $id_servico, $servico, $id_i, $id_produto, $produto, $qtd, $preco_total, $id_cliente, $nome_c, $id_func, $nome_f);
			$stmt->store_result();



			 
			echo "Numero de linhas: ".$numlinhas;
			echo "<br/>";
			echo "Numero de paginas: ".$numpag;
			echo "<br/>";
			//$_COOKIE["test"] = 2+ $_COOKIE["test"]; 
			//echo "Numero de Test: ".$_COOKIE[$test];


			echo "<br><br><br>";
			echo "<table class='table'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Assistências </h2> </td> <td> <h2> Descrição Assistência </h2> </td> <td> <h2> Descrição Equipamento </h2> </td> <td> <h2> Data de Entrada </h2> </td> <td> <h2> Data de Saída </h2> </td> <td> <h2> Estado </h2> </td> <td> <h2> Serviço </h2> </td> <td> <h2> Produto (Qtd) </h2> </td> <td> <h2> Preço Total </h2> </td> <td> <h2> Nome Cliente </h2> </td> <td> <h2> Nome Funcionário </h2> </td> <td colspan='3'> </td> </tr>";
			echo "<tr>";

			while ($stmt->fetch()) 
			{
				echo "<tr>";
				echo "<td> <p class='label'> $id </p> </td> ";
				echo "<td> <p class='label'> $descricao_a </p> </td> ";
				echo "<td> <p class='label'> $descricao_e </p> </td> ";
				echo "<td> <p class='label'> $data_e </p> </td>";
				echo "<td> <p class='label'> $data_s </p> </td> ";
				echo "<td> <p class='label'> $estado </p> </td> ";
				echo "<td> <p class='label'> $servico </p> </td> ";
				echo "<td> <p class='label'> $produto ($qtd) </p> </td> ";
				echo "<td> <p class='label'> $preco_total </p> </td> ";
				echo "<td> <p class='label'> $nome_c </p> </td> ";
				echo "<td> <p class='label'> $nome_f </p> </td> ";
				echo "<td class='img'> <a href='editarAssistencia.php?
										id=$id
										&descricao_a=$descricao_a
										&descricao_e=$descricao_e
										&data_e=$data_e
										&data_s=$data_s
										&id_cliente=$id_cliente
										&id_func=$id_func
										&id_ue=$id_ue
										&id_i=$id_i
										&id_estado=$id_estado
										&id_servico=$id_servico
										&id_produto=$id_produto
										&qtd=$qtd
										&preco_total=$preco_total'> <img src='../imagens/edit.png' title='Editar Assistência'> </a> </td> ";
				//echo "<td class='img'> <a href='#up' onmouseup='deleteAssistencia(".$id.",".$qtd.",".$id_produto.")'> <img src='../imagens/trash.png' title='Eliminar Assistência'> </a> </td> ";
				echo "<td class='img'> 
						<a href='#up' onmouseup='deleteAssistencia(".$id.")'> 
							<img src='../imagens/trash.png' title='Eliminar Assistência'>
						</a>
					</td> ";

				echo "<td class='img'> 
						<a href='detalhesAssistencia.php?
							id=$id
							&descricao_a=$descricao_a
							&descricao_e=$descricao_e
							&data_e=$data_e
							&data_s=$data_s
							&estado=$estado
							&servico=$servico
							&produto=$produto
							&preco_total=$preco_total
							&cliente=$nome_c
							&funcionario=$nome_f'> 

						<img src='../imagens/search.png' title='Detalhes Assistência'> 
						</a>
					</td> ";	
				//echo "<td class='img'> <a href='#up' onmouseup='delete(".$id.")'> <img src='../imagens/trash.png' title='Eliminar Assistência'> </a> </td> ";
				echo "</tr>";
			} 

			echo "</table>";
			echo "<br><br><br>";
			
		}
		else
		{
			//echo "ERROR: " .$sql." ".$mysqli->error;
			echo "<br><br><b>MYSQL ERROR:<b><br>";
			echo mysqli_error($mysqli);
		}
		//$stmt->close();
		//$mysqli->close();



?>


</body>
</html>