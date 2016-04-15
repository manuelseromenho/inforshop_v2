<?php 

	session_start(); /* Starts the session */
	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	include_once("../ligacaoBD.php");
?>

<html>
<head>

	<title> INFORSHOP </title>
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8">  
	<script>
	 	//str é o id que vem da escolha na combobox
		//function deleteAssistencia(id, qtd, id_produto) {
		function deleteAssistencia(str) 
		{
		    if (str == "") {
		        document.getElementById("txtHint").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }

		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","eliminarAssistencia.php?id="+str+"",true);
		        xmlhttp.send();
		    }
		}
	</script> 
</head>

<body>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
		<form action="pesquisarAssistencia.php" method="POST">
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Assistências </h2> </td> </tr>
			<!--<tr> <td> <p class="form"> Nome do Cliente: </p> </td> <td> <p class="label"> <input type="text" name="cliente" class="selected"> </p> </td> </tr>-->
			<!--################# CLIENTES ##############-->
			<tr> 
	    		<td> <p class="label"> Nome Cliente: </p> </td> 
	    		<td>
					<?php
						echo "<p class='label'> <select name='id_cliente' class='selected'>";						
						$selectC = "SELECT id_cliente, nome FROM clientes ORDER BY id_cliente ASC";

						if ($stmt = $mysqli->prepare($selectC)) {
							$stmt->execute();						
							$stmt->bind_result($id_cliente, $nomeC);
							echo "<option value='$id_cliente' selected='selected'> Selecione um cliente </option>";
							while ($stmt->fetch()) {	
								echo "<option value='$id_cliente'> $nomeC ($id_cliente) </option>";							
							}
						}
						echo "</select> </p>";
					?>
				</td>
			</tr>
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
		</table>

		<?php
			if(isset($_POST['pesquisar'])) 
			{
				/*Aparentemente não é necessario esta condição*/			
				/*if (array_key_exists('pesquisar', $_POST))
				{
					$id_cliente = $_POST["id_cliente"];		
				} 
				else 
				{
					$id_cliente = ' ';			
				}*/

				$id_cliente = $_POST["id_cliente"];



				if($id_cliente == 0)
				{
					$sql = "SELECT a.id_Assistencia, a.descricao_assistencia, a.descricao_equipamento, a.data_entrada, a.data_saida, ue.id_ue, ue.id_estado, e.estado, ue.id_servico, s.tipo_servico, i.id_instal, i.id_produto, p.nome_produto, i.quantidade, a.valor_total, a.id_cliente, c.nome, a.id_funcionario, f.nome
							FROM assistencias as a, clientes as c, funcionarios as f, usados_efetuados as ue, servicos as s, estados as e, instalacao as i, produtos as p
							WHERE a.id_cliente=c.id_cliente
							AND a.id_funcionario=f.id_funcionario 
							AND ue.id_estado=e.id_estado
							AND ue.id_servico=s.id_servico
							AND ue.id_assistencia=a.id_assistencia
							AND ue.id_ue=i.id_ue
							AND i.id_produto=p.id_produto
							ORDER BY a.id_assistencia ASC";
							
							/*limit 10 offset 10*N;";*/


				}
				else
				{
					$sql = "SELECT a.id_Assistencia, a.descricao_assistencia, a.descricao_equipamento, a.data_entrada, a.data_saida, ue.id_ue, ue.id_estado, e.estado, ue.id_servico, s.tipo_servico, i.id_instal, i.id_produto, p.nome_produto, i.quantidade, a.valor_total, a.id_cliente, c.nome, a.id_funcionario, f.nome
							FROM assistencias as a, clientes as c, funcionarios as f, usados_efetuados as ue, servicos as s, estados as e, instalacao as i, produtos as p
							WHERE a.id_cliente=c.id_cliente 
							AND a.id_funcionario=f.id_funcionario 
							AND c.id_cliente = $id_cliente
							AND ue.id_estado=e.id_estado
							AND ue.id_servico=s.id_servico
							AND ue.id_assistencia=a.id_assistencia
							AND ue.id_ue=i.id_ue
							AND i.id_produto=p.id_produto
							ORDER BY a.id_assistencia ASC";
				}

					



				if ($stmt = $mysqli->prepare($sql)) 
				{
					$stmt->execute();
					$stmt->bind_result($id, $descricao_a, $descricao_e, $data_e, $data_s, $id_ue, $id_estado, $estado, $id_servico, $servico, $id_i, $id_produto, $produto, $qtd, $preco_total, $id_cliente, $nome_c, $id_func, $nome_f);
					$stmt->store_result();

					$numlinhas= $stmt->num_rows;
					echo "Numero de linhas: ".$numlinhas;

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
					$stmt->close();
				}
			}

		$mysqli->close();


		?>
		<a name="up" id='txtHint'> </a>

		

	</div>
	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php");	?>

	

</body>

</html>

