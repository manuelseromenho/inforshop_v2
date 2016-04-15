<?php 
	session_start(); // Starts the session 

	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}

	require("../ligacaoBD.php");
	
?>
<html>
<head>
	<title> INFORSHOP </title>
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset='utf-8'>

	<!--jquery utilizado para datepicker--> 
	<link href="../jquery/jquery-ui.css" rel="stylesheet" />
	<script src="../jquery/jquery.min.js"></script>
	<script src="../jquery/jquery-ui.js"></script>
	<script>



		function addRow(tableID) 
		{
		        var table = document.getElementById(tableID);
		        var rowCount = table.rows.length;
		        var row = table.insertRow(rowCount);
		        kl = table.rows.length;
		        var colCount = table.rows[1].cells.length;
		        //kc = colCount;

		        for(var i=0; i<colCount; i++) 
		        {
		            var newcell = row.insertCell(i);
		            newcell.innerHTML = table.rows[1].cells[i].innerHTML;
		            //alert(newcell.childNodes);
		            switch(newcell.childNodes[0].type) 
		            {
		                case "select":
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
	                    alert("Tem que existir pelo menos uma linha!");
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



		function showUser(str) 
		{
		    if (str == "") {
		        document.getElementById("txtHint").innerHTML = "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","getuser.php?idCliente="+str,true);
		        xmlhttp.send();
		    }
		}

		function showProd(str) 
		{
		    //var _elements = document.getElementsByName('txtHint1');
		   	var kl = document.getElementById("dataTable").rows.length - 1;
		   	//alert(kl);
		    if (str == "") {
		        document.getElementById("dataTable").rows[kl].cells[3].innerHTML= "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) 
		        {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		            {
		            	document.getElementById("dataTable").rows[kl].cells[3].innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","getprod.php?idP="+str,true);
		        xmlhttp.send();
		    }
		}

		function verifyQtd(qtd)
		{
		   	var tbl= document.getElementById('dataTable');
		   	var kl = tbl.rows.length - 1;

		    if (qtd == "") {
		        document.getElementById('dataTable').rows[kl].cells[5].innerHTML= "";
		        return;
		    } else { 
		        if (window.XMLHttpRequest) 
		        {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		           	var prod = tbl.rows[kl].cells[1].firstChild[tbl.rows[kl].cells[1].firstChild.selectedIndex].value;
		           	//alert (prod);
		        } else {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() 
		        {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		            {
		            	
		            	document.getElementById('dataTable').rows[kl].cells[5].innerHTML = xmlhttp.responseText;
		            	

		            }
		        };
		        xmlhttp.open("GET","verifyQtd.php?id_produto="+prod+"&qtd="+qtd,true);
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

	
	<form action="adicionarCompra.php" method="POST" onkeydown="return !(event.keyCode==13)">
		<table class="procura">
			<tr bgcolor="#c1c1ff"> 
				<td colspan="2"> <h2> Fazer uma nova compra </h2></td>
			</tr>
			<tr> 
				<td> <p class="label"> Nome do Cliente: </p> </td> 
				<td>
					<?php
						$sql = "SELECT id_Cliente, nome
								FROM clientes
								ORDER BY id_Cliente ASC";

						if ($smtp = $mysqli->prepare($sql))
						{
							$smtp->execute();						
							$smtp->bind_result($idCliente, $nomeC);
							
							echo "<p class='label'> <select name='idCliente' class='selected' onchange='showUser(this.value)'>";
							echo "<option value='$idCliente' selected> Seleccione um cliente </option>";
							while ($smtp->fetch())
							{	
								echo "<option value='$idCliente'> $nomeC ($idCliente) </option>";						
							}
							echo "</select></td>";

						}
					?>
			</tr>
					
			<tr> <td> <p class="label"> Data da Compra: </p> </td> 	<td> <p> <input type="date" name="data" id="data" class="selected" required> </p>  </td> </tr>
		</table>

		<!--Script para o Datepicker no Firefox, caso não seja nativo-->
			<script>
			      var elem = document.createElement('input');
			      elem.setAttribute('type', 'date');
			 
			      if ( elem.type === 'text' ) 
			      {
			      	$('#data').datepicker({changeMonth: true, changeYear: true});
			      	$( "#data" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			      }

			</script>
		<!-- ###################################################### -->

		<div id="txtHint"> </div>


		<table class="procura" id="dataTable">
			<tr>
				<th></th>
				<th>Produto</th>
				<th>Qtd</th>
				<th>Preço (€)</th>
				<th>Desconto (%)</th>
			</tr>
			<tr>
				<td style="width:20px;"><input type="checkbox" name="chk" /></td>
				
						<?php
							$sql_prod = "SELECT id_produto, nome_produto, quantidade
									FROM produtos
									ORDER BY id_produto ASC";

							if ($smtp = $mysqli->prepare($sql_prod))
							{
								$smtp->execute();						
								$smtp->bind_result($idP, $descricao, $qtd);

								//para o firstChild funcionar, o html não pode ter espaços e paragrafos 
								echo "<td style='width:80px';><select name='produto[]' onchange='showProd(this.value)'><option value='$idP' selected> Seleccione um produto </option>";
								while ($smtp->fetch())
								{		
									echo "<option value='$idP'> $descricao -> QTD($qtd)</option>";
								}
								echo "</select></td>";
							}

						?>

	
				<td style="width:80px;"><input type="text" name="qtd[]" onchange="verifyQtd(this.value)" required/></td>
				<td style="width:80px;" >
					<div name="txtHint1"></div>
				</td>
				<td style="width:80px;"><input type="text" name="desconto[]"/></td>
				<td> <div name="chkQtd"></div></td>
			</tr>
		</table>

			<INPUT type="button" value="Nova Linha" onclick="addRow('dataTable')" />
 			<INPUT type="button" value="Apagar Linha" onclick="deleteRow('dataTable')" />
    		<INPUT type="submit" name="send" value="Submeter"/>

	</form>

	<?php
		
		if(isset($_POST['send'])) 
		{
		
			$cliente = mysqli_real_escape_string($mysqli, $_POST['idCliente']);
			$data_compra = mysqli_real_escape_string($mysqli, $_POST['data']);
			$sql_update = "";

			//bloqueia a tabela compra, escreve a inserção do registo da compra, abre de novo
			$sql = "LOCK TABLES `compra` WRITE;
							/*!40000 ALTER TABLE `compra` DISABLE KEYS */;

							INSERT INTO compra
							VALUES ('', '$data_compra', '$cliente', '');

							/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
							UNLOCK TABLES;

							SELECT last_insert_id() into @lastid;
							";
			
			$count = 0;
			//contagem de linhas na tabela detalhes, o uso do "preco" poderia ser substituido por "qtd", "desconto"
			$count = count($_POST['preco']) - 1;


			$preco_total = 0;
			for($i = 0; $i <= $count; $i++)
			{
				// Utilização de um array de inputs com o mesmo nome, por exemplo "qtd[]"
				
				$produto = mysqli_real_escape_string($mysqli, $_POST['produto'][$i]);
				$qtd = mysqli_real_escape_string($mysqli, $_POST['qtd'][$i]);
				$preco = mysqli_real_escape_string($mysqli, $_POST['preco'][$i]);
				$desconto = mysqli_real_escape_string($mysqli, $_POST['desconto'][$i]);
	  
				//id_detalhe, id_compra(lastid), id_produto, quantidade, desconto
	  			$sql.="INSERT into detalhes_compra 
	  					VALUES ('',@lastid, '$produto', '$qtd','$desconto');";

	  			//UPDATE ao Stock
	  			$sql.="UPDATE produtos
	  					SET quantidade = quantidade - '$qtd'
	  					WHERE id_produto = '$produto';";

	  			//calculo do preço total de cada compra
	  			$preco_total = $preco_total + ($preco - ($preco*($desconto/100))) * $qtd;

	  		}
			
	  		$sql.="UNLOCK TABLES;";

	  		//inserção do preço total de cada compra
	  		$sql.="UPDATE compra 
	  				SET preco_total = '$preco_total'
	  				WHERE id_compra = @lastid;
	  				";

			if($mysqli->multi_query($sql) === TRUE)
			{
				echo "<h2>Compra(s) adicionada(s) com sucesso!</h2>";
				echo "Preço Total: ".$preco_total." €";
				echo $compra;
			}
			else
			{
				echo "<br><br><b>MYSQL ERROR:<b><br>";
				echo mysqli_error($mysqli);
			}
			mysqli_close($mysqli);


		}


	//var_dump ($sql);
	?>


	</div>
	
	<!-- ****************** FOOTER *************** -->
	<?php 
		include("footer.php"); 
		mysqli_close($mysqli);
	?>

</body>
</html>
