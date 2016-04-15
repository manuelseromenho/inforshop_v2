<?php 
	require("../ligacaoBD.php");
	
	session_start(); //Starts the session

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

?>
<html>
<head>
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>  
	<script>
		function calculo()
		{
			//passando os valores do campo do form para as variaveis
			valor1 = parseInt(document.assistencias.servico.value); 
			valor2 = parseInt(document.assistencias.produto.value);
			valor3 = parseInt(document.assistencias.quantidade.value);

			soma = eval(valor1 + (valor2 * valor3)); //fazendo a soma

			//no evento do onblur para que nao apareça 'undefined'
			//eu faço a seguinte condição
			//se a soma for diferente de undefined ele mostra no valor total
			if(soma != undefined) {
				document.assistencias.preco.value = soma;
			}
		}
	</script>
</head>
<body>
	
<?php

?>

	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
	<form action="adicionarAssistencia.php" method="POST" name="assistencias">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Adicionar nova Assistência </h2> </td> </tr>
		 
    	<tr> <td> <p class="label"> Descrição Assistência: </p> </td> 	<td> <p> <input type="text" name="descricao_a" class="selected"> </p> </td></tr>
        <tr> <td> <p class="label"> Descrição Equipamento: </p> </td> 	<td> <p> <input type="text" name="descricao_e" class="selected"> </p> </td> </tr>
        <tr> <td> <p class="label"> Data de Entrada: </p> </td> 		<td> <p> <input type="date" name="data_e" class="selected"> </p>  </td> </tr>
        <tr> <td> <p class="label"> Data de Saída: </p> </td> 			<td> <p> <input type="date" name="data_s" class="selected"> </p>  </td> </tr>
       
		<!--######################   Combo BOX CLIENTES  ###########################-->
	 	<tr> 
			<td> <p class="label"> ID Cliente: </p> </td> 					<!--<td> <p> <input type="text" name="idCliente" class="input"> </p>  </td> </tr>-->
			<td>
<?php
	$sql = "SELECT id_cliente, nome FROM clientes ORDER BY id_cliente";

	if ($smtp = $mysqli->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($id_cliente, $nome);
		
		echo "<p class='label'> <select name='id_cliente' class='selected'>";
		echo "<option value='$id_cliente' selected> Seleccione um cliente  </option>\n";
		
		while ($smtp->fetch())
		{	
			echo "<option value='$id_cliente'> $nome ($id_cliente)  </option>\n";
		}
		echo "</select>";
	}
?>
			</td>
		</tr>
		<!--################## FUNCIONARIO ########################-->
		<tr> 
			<td> <p class="label"> ID Funcionário: </p> </td> 
			<td>

<?php
	$sql = "SELECT id_funcionario, nome FROM funcionarios ORDER BY id_funcionario";

	if ($smtp = $mysqli->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($id_func, $nome);
		
		echo "<p class='label'> <select name='id_func' class='selected'>";
		echo "<option value='$id_func' selected> Seleccione um funcionário  </option>\n";

		while ($smtp->fetch())
		{	
			echo "<option value='$id_func'> $nome ($id_func)  </option>\n";
		}
		echo "</select>";
	}
?>
			</td>
		</tr>
		<!--################## ESTADO ########################-->
		<tr> 
			<td> <p class="label"> Estado: </p> </td> 
			<td>

<?php
	$sql = "SELECT id_estado, estado FROM estados ORDER BY id_estado ASC";

	if ($smtp = $mysqli->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($id_estado, $estado);
		
		echo "<p class='label'> <select name='id_estado' class='selected'>";
		echo "<option value='$id_estado' selected> Seleccione um estado  </option>\n";

		while ($smtp->fetch())
		{	
			echo "<option value='$id_estado'> $estado ($id_estado)  </option>\n";
		}
		echo "</select>";
	}
?>
			</td>
		</tr>

		<!--################## SERVICO ########################-->
		<tr> 
			<td> <p class="label"> Tipo de serviço: </p> </td> 
			<td>

<?php
	$sql = "SELECT id_servico, tipo_servico, preco FROM servicos ORDER BY id_servico ASC";

	if ($smtp = $mysqli->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($id_servico, $tipo, $preco);
		
		echo "<p class='label'> <select name='id_servico' class='selected' id='servico'>";
		echo "<option value='$id_servico' selected> Seleccione um serviço  </option>\n";

		while ($smtp->fetch())
		{	
			echo "<option value='$id_servico'> $tipo ($preco €)  </option>\n";

			
		}
		echo "</select>";

	}

?>
			</td>
		</tr>
		<!--################## PRODUTOS ########################-->
		<tr> 
			<td> <p class="label"> Nome Produto: </p> </td> 
			<td>

<?php
	$sql = "SELECT id_produto, nome_produto, preco_venda FROM produtos ORDER BY id_produto ASC";

	if ($smtp = $mysqli->prepare($sql))
	{
		$smtp->execute();						
		$smtp->bind_result($id_produto, $nome, $preco_venda);
		
		echo "<p class='label'> <select name='id_produto' id='produto' class='selected' >";
		echo "<option value='$id_produto' selected> Seleccione um produto </option>\n";

		while ($smtp->fetch())
		{	
			echo "<option value='$id_produto'> $nome ($preco_venda €) </option>\n";
		}
		echo "</select>";
	}
?>
			</td>
		</tr>
		<!--<tr> <td> <p class="label"> Quantidade Produtos: </p> </td> <td> <p> <input type="text" name="quantidade" id="quantidade" class="selected" type="text" onBlur='calculo();'> </p>  </td> </tr>-->
		<!--<tr> <td> <p class="label"> Preço Total: (€) </p> </td> <td> <p> <input type="text" name="preco" id="preco" class="selected" onFocus="this.blur()"> </p>  </td> </tr>-->
		<tr> <td> <p class="label"> Quantidade Produtos: </p> </td> <td> <p> <input type="text" name="quantidade" id="quantidade" class="selected" type="text"> </p>  </td> </tr> 		
		<tr> <td> <p class="label"> Preço Total: (€) </p> </td> <td> <p> <input type="text" name="preco" id="preco" class="selected"> </p>  </td> </tr>
		<tr><td colspan="2" bgcolor="#c1c1ff"> <input type="submit" name="adicionar" class="button" value="Adicionar"> </td>
	</form>
	</table>
<?php

	

 	if(isset($_POST['adicionar']))
	{
		$descricao_a = $_POST["descricao_a"]; 
		$descricao_e = $_POST["descricao_e"];
		$data_e = $_POST["data_e"];
		$data_s = $_POST["data_s"];
		$preco = $_POST["preco"];
		$id_cliente = $_POST["id_cliente"];
		$id_func = $_POST["id_func"];

		$id_e = $_POST['id_estado'];
		$id_s = $_POST['id_servico'];

		$id_produto = $_POST['id_produto'];
		$quantidade = $_POST['quantidade'];

		$sql = "INSERT INTO assistencias (descricao_assistencia, descricao_equipamento, data_entrada, data_saida, valor_total, id_cliente, id_funcionario)
				VALUES ('$descricao_a', '$descricao_e', '$data_e', '$data_s', '$preco', '$id_cliente', '$id_func')";
		
		if (mysqli_multi_query($mysqli, $sql))
		{
			$id_a = $mysqli->insert_id;
			//echo "A".$id_a;
			$sql2 = "INSERT INTO usados_efetuados (id_assistencia, id_estado, id_servico)
					 VALUES ('$id_a', '$id_e', '$id_s')";

			if (mysqli_multi_query($mysqli, $sql2))
			{
				$id_ue = $mysqli->insert_id;

				$sql3 = "INSERT INTO instalacao (quantidade, id_assistencia, id_produto) VALUES ('$quantidade', '$id_a' , '$id_produto')";

				
				if (mysqli_multi_query($mysqli, $sql3))
				{
					$id_instala = $mysqli->insert_id;
					$sql4 = "UPDATE produtos SET quantidade=quantidade-$quantidade WHERE id_produto='$id_produto'";

					if (mysqli_multi_query($mysqli, $sql4))
					{
						//echo "Instalacao: ".$id_instala;
						echo "<h2> Assistência adicionada com sucesso! </h2>";
					}
				}
			}
		}
		else
		{
			echo "<h2> ERROR: ".$sql. $mysqli->error." </h2>";
		}
	}
	?>
	</div>
	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php"); ?>
</body>
</html>