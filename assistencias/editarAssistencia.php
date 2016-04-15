<?php 
	session_start(); /* Starts the session */
	if(!isset($_SESSION['user']))
	{
		header("location:login.php");
		exit;
	}

	require("../ligacaoBD.php");

	$id_cliente_ = $_GET['id_cliente'];
	$id_func_ = $_GET['id_func'];

	$id_ue_=$_GET['id_ue'];
	$id_estado_=$_GET['id_estado'];
	$id_servico_=$_GET['id_servico'];

	$id_i_=$_GET['id_i'];
	$id_produto_=$_GET['id_produto'];



?>
<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>  
</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
	<form action="editarAssistencia.php" method="POST">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Editar uma Assistência </h2> </td> </tr>
		<tr> <td> <p class="label"> ID Assistência: </p> </td> 	<td> <p> <input type="text" name="id" value="<?php $id=$_GET['id']; echo $id; ?>" class="selected" readonly> </p> </td></tr>
		<tr> <td> <p class="label"> ID Usados_Efetuados: </p> </td> 	<td> <p> <input type="text" name="id_ue" value="<?php $id_ue=$_GET['id_ue']; echo $id_ue; ?>" class="selected" readonly> </p> </td></tr>
		<tr> <td> <p class="label"> ID Instalacao: </p> </td> 			<td> <p> <input type="text" name="id_i" value="<?php $id_i=$_GET['id_i']; echo $id_i; ?>" class="selected" readonly> </p> </td></tr>
    	<tr> <td> <p class="label"> Descrição Assistência: </p> </td> 	<td> <p> <input type="text" name="descricao_a" value="<?php $descricao_a=$_GET['descricao_a']; echo $descricao_a; ?>" class="selected"> </p> </td></tr>
	    <tr> <td> <p class="label"> Descrição Equipamento: </p> </td> 	<td> <p> <input type="text" name="descricao_e" value="<?php $descricao_e=$_GET['descricao_e']; echo $descricao_e; ?>" class="selected"> </p> </td> </tr>
       	<tr> <td> <p class="label"> Data de Entrada: </p> </td> 		<td> <p> <input type="text" name="data_e" value="<?php $data_e=$_GET['data_e']; echo $data_e; ?>" class="selected"> </p>  </td> </tr>
		<tr> <td> <p class="label"> Data de Saída: </p> </td> 			<td> <p> <input type="text" name="data_s" value="<?php $data_s=$_GET['data_s']; echo $data_s; ?>" class="selected"> </p>  </td> </tr>
		

		<!--################# CLIENTES ##############-->
		<tr> 
    		<td> <p class="label"> Nome Cliente:</p> </td> 
    		<td>
				<?php
					echo "<p class='label'> <select name='id_cliente' class='selected' required>";
					
					$selectC = "SELECT id_cliente, nome FROM clientes ORDER BY id_cliente ASC";

					if ($stmt = $mysqli->prepare($selectC)) {
						$stmt->execute();						
						$stmt->bind_result($id_cliente, $nome_c);

						while ($stmt->fetch()) {	
							if($id_cliente_ == $id_cliente) {
								echo "<option value='$id_cliente' selected='selected'> $nome_c ($id_cliente) </option>";
								$id_cliente = $id_cliente_;
							} else {
								echo "<option value='$id_cliente'> $nome_c ($id_cliente) </option>";
							}							
						}
					}
					echo "</select> </p>";
				?>
			</td>
		</tr>

		<!--################# FUNCIONARIOS ##############-->
		<tr> 
    		<td> <p class="label"> Nome Funcionário:</p> </td> 
    		<td>
				<?php
					echo "<p class='label'> <select name='id_func' class='selected' required>";
					
					$selectF = "SELECT id_funcionario, nome FROM funcionarios ORDER BY id_funcionario ASC";

					if ($stmt = $mysqli->prepare($selectF)) {
						$stmt->execute();						
						$stmt->bind_result($id_func, $nome_f);

						while ($stmt->fetch()) {	
							if($id_func_ == $id_func) {
								echo "<option value='$id_func_' selected='selected'> $nome_f ($id_func) </option>";
								$id_func = $id_func_;
							} else {
								echo "<option value='$id_func'> $nome_f ($id_func) </option>";
							}							
						}
					}
					echo "</select> </p>";
				?>
			</td>
		</tr>
		<!--################# ESTADOS ##############-->
		<tr> 
    		<td> <p class="label"> Estado:</p> </td> 
    		<td>
				<?php
					echo "<p class='label'> <select name='id_estado' class='selected' required>";
					
					$selectC = "SELECT id_estado, estado FROM estados ORDER BY id_estado ASC";

					if ($stmt = $mysqli->prepare($selectC)) {
						$stmt->execute();						
						$stmt->bind_result($id_estado, $estado);

						while ($stmt->fetch()) {	
							if($id_estado_ == $id_estado) {
								echo "<option value='$id_estado' selected='selected'> $estado ($id_estado) </option>";
								$id_estado = $id_estado_;
							} else {
								echo "<option value='$id_estado'> $estado ($id_estado) </option>";
							}							
						}
					}
					echo "</select> </p>";
				?>
			</td>
		</tr>
		<!--################# SERVICOS ##############-->
		<tr> 
    		<td> <p class="label"> Tipo Serviço:</p> </td> 
    		<td>
				<?php
					echo "<p class='label'> <select name='id_servico' class='selected' required>";
					
					$selectC = "SELECT id_servico, tipo_servico, preco FROM servicos ORDER BY id_servico ASC";

					if ($stmt = $mysqli->prepare($selectC)) {
						$stmt->execute();						
						$stmt->bind_result($id_servico, $servico, $preco_servico);

						while ($stmt->fetch()) {	
							if($id_servico_ == $id_servico) {
								echo "<option value='$id_servico' selected='selected'> $servico ($preco_servico) </option>";
								$id_servico = $id_servico_;
							} else {
								echo "<option value='$id_servico'> $servico ($preco_servico) </option>";
							}							
						}
					}
					echo "</select> </p>";
				?>
			</td>
		</tr>
		<!--################# PRODUTOS ##############-->
		<tr> 
    		<td> <p class="label"> Nome Produto:</p> </td> 
    		<td>
				<?php
					echo "<p class='label'> <select name='id_produto' class='selected' required>";
					
					$select_p = "SELECT id_produto, nome_produto, preco_venda FROM produtos ORDER BY id_produto ASC";

					if ($stmt = $mysqli->prepare($select_p)) {
						$stmt->execute();						
						$stmt->bind_result($id_produto, $nome_p, $preco_venda);

						echo "<option value='$id_produto' selected='selected'> seleccione </option>";
						while ($stmt->fetch()) {	

								if($id_produto_ == $id_produto) {
								echo "<option value='$id_produto' selected='selected'> $nome_p ($preco_venda) </option>";
								//$id_produto = $id_produto_;
								} else {
									echo "<option value='$id_produto'> $nome_p ($preco_venda) </option>";
								}

														
						}
					}
					echo "</select> </p>";
				?>
			</td>
		</tr>
		<tr> <td> <p class="label"> Quantidade produto:</p> </td> <td> <p> <input type="text" name="qtd" value="<?php $qtd=$_GET['qtd']; echo $qtd; ?>" class="selected"> </p> </td> </tr>
		<tr> <td> <p class="label"> Preço Total: </p> </td> 		<td> <p> <input type="text" name="preco_total" value="<?php $preco_total=$_GET['preco_total']; echo $preco_total; ?>" class="selected"> </p>  </td> </tr>
		
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <input type="submit" name="editar" class="button" value="Editar"> </td>
	</form>
	</table>

<?php
	if(isset($_POST['editar']))
	{
		//var_dump($_POST);
		$id = $_POST['id'];
		$descricao_a = $_POST['descricao_a'];
		$descricao_e = $_POST['descricao_e'];
		$data_e = $_POST['data_e'];
		$data_s = $_POST['data_s'];
		$preco_total = $_POST['preco_total'];
		$id_cliente = $_POST['id_cliente'];
		$id_func = $_POST['id_func'];

		$id_ue=$_POST['id_ue'];
		$id_estado=$_POST['id_estado'];
		$id_servico=$_POST['id_servico'];

		$id_i=$_POST['id_i'];
		$id_produto=$_POST['id_produto'];
		$qtd=$_POST['qtd'];


		$sql = mysqli_query($mysqli, "UPDATE assistencias 
									SET descricao_assistencia='$descricao_a', descricao_equipamento='$descricao_e', data_entrada='$data_e', data_saida='$data_s', valor_total='$preco_total', id_cliente='$id_cliente', id_funcionario='$id_func' 
									WHERE id_assistencia = '$id'");

		if ($stmt = $mysqli->prepare($sql)) 
		{
			$stmt->execute();
			$stmt->bind_result($id, $descricao_a, $descricao_e, $data_e, $data_s, $preco_total, $id_cliente, $id_func);

			echo $id;
			while ($stmt->fetch()) {
				
			}
			//while ($stmt->fetch()) {
				//echo "<h2> Assistência alterada com sucesso! </h2>";
			//}
			$stmt->close();
		}

		$sql2 = mysqli_query($mysqli, "UPDATE usados_efetuados 
										SET id_estado='$id_estado', id_servico='$id_servico' 
										WHERE id_ue = '$id_ue' AND id_assistencia='$id'");
		
		if ($stmt2 = $mysqli->prepare($sql2)) 
		{
			$stmt2->execute();
			$stmt2->bind_result($id_estado, $id_servico);
			$stmt2->close();
			echo "<h2> Assistência alterada com sucesso! </h2>";
		}

		$sql3 = mysqli_query($mysqli, "UPDATE instalacao 
										SET id_produto='$id_produto', quantidade='$qtd' 
										WHERE id_ue='$id_ue' AND id_instal='$id_i'");
		
		if ($stmt3 = $mysqli->prepare($sql3)) 
		{
			$stmt3->execute();
			$stmt3->bind_result($id_produto, $quantidade);
			$stmt3->close();
			
		}
		echo "<h2> Assistência alterada com sucesso! </h2>";
		
	}
?>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
</body>
</html>

