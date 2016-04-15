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
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<link href="../jquery/jquery-ui.css" rel="stylesheet" />
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<script src="../jquery/jquery.min.js"></script>
	<script src="../jquery/jquery-ui.js"></script>
	<meta charset='utf-8'/>  
</head>
<body>

<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>

<!-- ***************** BODY *****************-->
	<div class="container">



			<table class="procura">
				<form action="adicionarFunc.php" method="POST">
					<tr bgcolor="#c1c1ff"> 
						<td colspan="2"> 
							<h2> Adicionar Novo Funcionário </h2> 
						</td>
					</tr>
					 


					<tr> <td> <p class="label"> Nome: </p> </td> 					<td> <p> <input type="text" name="nome" class="selected"> </p> </td> </tr>
			        <tr> <td> <p class="label"> Morada: </p> </td> 					<td> <p> <input type="text" name="morada" class="selected"> </p> </td> </tr>
			        <tr> <td> <p class="label"> Telefone: </p> </td> 				<td> <p> <input type="text" name="telefone" class="selected" maxlength="9"> </p> </td> </tr>
			    	<tr> <td> <p class="label"> NIF: </p> </td>						<td> <p> <input type="text" name="nif" class="selected" maxlength="9"> </p> </td> </tr>
			    	<tr> <td> <p class="label"> E-mail: </p> </td> 					<td> <p> <input type="text" name="email" class="selected"> </p> </td> </tr>
			    	<tr> <td> <p class="label"> Data Nascimento: </p> </td>			<td> <p> <input type="date" name="dataN" id="dataN" class="date" class="selected"> </p> </td> </tr>
			    	<tr> <td> <p class="label"> Data Entrada ao Serviço: </p> </td>	<td> <p> <input type="date" name="dataE" id="dataE" class="date" class="selected"> </p> </td> </tr>
				

					<tr bgcolor="#c1c1ff"> 
						<td colspan="2">
							<input type="submit" name="adicionar" class="button" value="adicionar"/>
						</td>
					</tr>
				</form>
			</table>


			<!--Script para o Datepicker no Firefox, caso não seja nativo-->
			<script>
			      var elem = document.createElement('input');
			      elem.setAttribute('type', 'date');
			 
			      if ( elem.type === 'text' ) 
			      {
			      	$('#dataN').datepicker({changeMonth: true, changeYear: true});
			      	$( "#dataN" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

			      	$('#dataE').datepicker({changeMonth: true, changeYear: true});
			      	$( "#dataE" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

			      }

			</script>
			<!-- ###################################################### -->

	

<!-- ****************** FOOTER *************** -->

	
		<?php

			//mysqli_set_charset($mysqli, "utf8"); 
				
			//var_dump($_POST);
				
			if(isset($_POST['adicionar']))
			{
				if (array_key_exists('adicionar',$_POST))
				{
					$sql="INSERT INTO funcionarios 
						SET nome = ?, 
						morada = ?, 
						telefone = ?,
						nif = ?, 
						email = ?, 
						data_nascimento = ?, 
						data_entrada = ?";

					
					
					//VERIFICAÇÃO DA INTRODUÇÃO DE VALORES NULOS NO FORMULARIO (a nivel da base de dados)
					if($_POST['nome'] == '') 
					{
						$nome = null;
						echo "Nome não pode estar vazio";
					}
					else $nome = $_POST['nome'];

					if($_POST['morada'] == '') 
					{
						$morada = null;
						echo "<br>Morada não pode estar vazio";

					}
					else $morada = $_POST['morada'];

					if($_POST['telefone'] == '')
					{
						$telefone = null;
						echo "<br>Telefone não pode estar vazio";
					}
					else $telefone = $_POST['telefone'];

					if($_POST['nif'] == '')
					{
						$nif = null;
						echo "<br>NIF não pode estar vazio";
					}
					else $nif = $_POST['nif'];

					//Verifica se já existe um funcionário com o mesmo NIF
					$checkn = "SELECT nif FROM funcionarios WHERE nif='$nif'";
					$result = mysqli_query($mysqli, $checkn);
					if(mysqli_num_rows($result)>0)
					{	echo "<br>Já existe este NIF";	}
					

					if ($stmt = $mysqli->prepare($sql))
					{
						$stmt->bind_param('sssssss'
						, $nome
						, $morada
						, $telefone
						, $nif
						, $_POST['email']
						, $_POST['dataN']
						, $_POST['dataE']
						);

						if($stmt->execute())
						{
							/*echo "<script type=\"text/javascript\"> 
						       					window.location=\"sucesso.php\";
						       		 </script>";*/
						    echo ("<h2> Funcionário Adicionado com sucesso! </h2>");
						}
						else
						{
							echo "<br><br><b>MYSQL ERROR:<b><br>";
							echo mysqli_error($mysqli);

						}
					}
					else
					{
						//echo mysqli_error($mysqli);			
					}					
										}
				else
				{
					mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
				}
				
			}
			else 
				{
						//echo mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
						//echo "<script> alert('$mysqli->error') </script>";
					    //echo "<script> alert('Impossivel inserir este registo. TENTE DE NOVO.'); </script>";
				}

			//$stmt->close(); //não deixa a página ser construida até ao fim
		 	$mysqli->close();
		?>

	</div>


	<?php include("footer.php"); ?>
</body>
</html>
