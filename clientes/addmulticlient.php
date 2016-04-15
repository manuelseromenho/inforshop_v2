<?php 

	require("../ligacaoBD.php");
	session_start(); /* Starts the session */

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

?>

<html>
<head>

	<title> INFORSHOP </title>
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>
	<script>
		function addRow(tableID) 
		{
		        var table = document.getElementById(tableID);
		        var rowCount = table.rows.length;
		        var row = table.insertRow(rowCount);
		        var colCount = table.rows[1].cells.length;
		        for(var i=0; i<colCount; i++) {
		            var newcell = row.insertCell(i);
		            newcell.innerHTML = table.rows[1].cells[i].innerHTML;
		            //alert(newcell.childNodes);
		            switch(newcell.childNodes[0].type) 
		            {
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		                case "text":
		                    newcell.childNodes[0].value = "";
		                    break;
		            }
		        }
		    }
		    function deleteRow(tableID) {
		        try {
		        var table = document.getElementById(tableID);
		        var rowCount = table.rows.length;
		        for(var i=0; i<rowCount; i++) {
		            var row = table.rows[i];
		            var chkbox = row.cells[0].childNodes[0];
		            if(null != chkbox && true == chkbox.checked) {
		                if(rowCount <= 2) {
		                    alert("Cant delete all rows");
		                    break;
		                }
		                table.deleteRow(i);
		                rowCount--;
		                i--;
		            }
		        }
		        }catch(e) {
		            alert(e);
		        }
		    }


	</script>  

</head>

<body>
	<!-- ************ HEADER ************** -->

	<?php include("header.php"); ?>

	<!-- ***************** BODY *****************-->

	<div class="container">

	<br/><br/><br/>
	<form action="addmulticlient.php" method="POST">

		<table class="procura" id="dataTable">
			<tr>
				<th></th>
				<th>Nome</th>
				<th>Morada</th>
				<th>Telefone</th>
				<th>Email</th>
				<th>Nif</th>
			</tr>
			<tr>
				<td style="width:20px;"><input type="checkbox" name="chk" /></td>
				<td style="width:80px;"><input type="text" name="nome[]" required/></td>
				<td style="width:80px;"><input type="text" name="morada[]" required/></td>
				<td style="width:80px;"><input type="text" name="telefone[]" required/></td>
				<td style="width:80px;"><input type="text" name="email[]"/></td>
				<td style="width:80px;"><input type="text" name="nif[]" maxlength="9" required/></td>
			</tr>
		</table>

			<INPUT type="button" value="Add row" onclick="addRow('dataTable')" />
 			<INPUT type="button" value="Delete row" onclick="deleteRow('dataTable')" />
    		<INPUT type="submit" name="send" value="send"/>

	</form>

		

		<?php

			if(isset($_POST['send'])) 
			{
			
				$count = 0;
				//contagem de linhas na tabela detalhes
				$count = count($_POST['nome']) - 1;
				$sql="";
				for($i = 0; $i <= $count; $i++)
				{
					// Utilização de um array de inputs com o mesmo nome, por exemplo "nome[]"
					$nome = mysqli_real_escape_string($mysqli, $_POST['nome'][$i]); 
					$morada = mysqli_real_escape_string($mysqli, $_POST['morada'][$i]);
					$telefone = mysqli_real_escape_string($mysqli, $_POST['telefone'][$i]);
					$email = mysqli_real_escape_string($mysqli, $_POST['email'][$i]);
					$nif = mysqli_real_escape_string($mysqli, $_POST['nif'][$i]);
		  

		  			$sql.="INSERT INTO clientes
		   				VALUES ('','$nif','$nome','$morada','$telefone','$email');";
				
				}

				if ($mysqli->multi_query($sql) === TRUE) 
					{
						echo "<h2>Cliente(s) adicionado(s) com sucesso!</h2>";
					}
					else
					{
						//echo "ERROR: " .$sql." ".$mysqli->error;
						echo "<br><br><b>MYSQL ERROR:<b><br>";
						echo mysqli_error($mysqli);
					}

				mysqli_close($mysqli);
			}
		
		?>

	</div>



	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php"); ?>



</body>

</html>
