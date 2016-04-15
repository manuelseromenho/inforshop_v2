<?php 
	session_start(); /* Starts the session */
	if(!isset($_SESSION['user']))
	{
		header("location:../login.php");
		exit;
	}
	require("../ligacaoBD.php");
?>

<html>
<head>

	<script>

		var status = 0;

		function delCli(str) //str é o id que vem da escolha na combobox
		{
		    if (str == "") 
		    {
		        document.getElementById("txtHint").innerHTML = "";
		        return;
		    } 
		    else 
		    { 
		        if (window.XMLHttpRequest) 
		        {
		            // code for IE7+, Firefox, Chrome, Opera, Safari
		            xmlhttp = new XMLHttpRequest();
		        } 
		        else 
		        {
		            // code for IE6, IE5
		            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        xmlhttp.onreadystatechange = function() 
		        {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		            {
		                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
		            }
		        };
		        xmlhttp.open("GET","delCli.php?idC="+str,true);
		        xmlhttp.send();
		    }
		}

		function tableToXml() {
            var xml = '<?xml version="1.0" encoding="UTF-8"?>\n<Root>\n\t<Classes>';

            var tritem = document.getElementById("result").getElementsByTagName("tr");

            for (i = 1; i < tritem.length; i++) {
                var celldata = tritem[i];
                if (celldata.cells.length > 0) {
                    xml += "\n<" + celldata.cells[0].textContent + ">\n";
                    for (var m = 1; m < celldata.cells.length; ++m) 
                    {
                        xml += "\t<data>" + celldata.cells[m].textContent + "</data>\n";
                    }
                    xml += "</"+celldata.cells[0].textContent+" >\n";
                }
            }
            xml += '\t</Classes>\n</Root>';
            window.alert(xml);
        }

        function loadXMLDoc(filename)
        {
        if (window.ActiveXObject)
          {
          xhttp = new ActiveXObject("Msxml2.XMLHTTP");
          }
        else 
          {
          xhttp = new XMLHttpRequest();
          }
        xhttp.open("GET", filename, false);
        try {xhttp.responseType = "msxml-document"} catch(err) {} // Helping IE11
        xhttp.send("");
        return xhttp.responseXML;
        }

        function displayResult()
        {
        xml = loadXMLDoc("myfile.xml");
        xsl = loadXMLDoc("myfile.xsl");
        clientes = document.getElementById("xml_clientes");
        //clientes.removeChild(clientes.firstChild);
        // code for IE
        if (window.ActiveXObject || xhttp.responseType == "msxml-document")
          {
          ex = xml.transformNode(xsl);
          document.getElementById("xml_clientes").innerHTML = ex;
          }
        // code for Chrome, Firefox, Opera, etc.
        else if (document.implementation && document.implementation.createDocument)
          {
	          xsltProcessor = new XSLTProcessor();
	          xsltProcessor.importStylesheet(xsl);
	          resultDocument = xsltProcessor.transformToFragment(xml, document);
	          
	          if(status == 0)
	          {
	          	status = 1;
	          	clientes.appendChild(resultDocument);

	          }
	          else
	          {
	          	clientes.removeChild(clientes.firstChild);
	          	clientes.appendChild(resultDocument);
	          	
	          }

          }
          
        }

	</script>





	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">

		<form action="pesquisarCliente.php" method="POST">
			<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Clientes </h2> </td> </tr>
			<tr> <td> <p class="form"> ID ou Nome do Cliente: </p> </td> <td> <p> <input type="text" name="idCliente" class="selected"> </p> </td> </tr>
			<tr bgcolor="#c1c1ff">  <td colspan="2"> <input type="submit" value="Pesquisar" name="pesquisar" class="button"> </td> </tr>
		</form>
	</table>



	<?php


	if(isset($_POST['pesquisar']))
	{
		$id = $_POST["idCliente"];
		if (array_key_exists('pesquisar', $_POST))
		{
			$id = $_POST["idCliente"];		
		}
		else
		{
			$id = "";			
		} 


		if($id == null)
		{
			$sql = "SELECT id_Cliente, nome, morada, telefone, email, nif 
					FROM clientes ORDER BY id_Cliente";
		}
		else
		{
			$sql = "SELECT id_Cliente, nome, morada, telefone, email, nif
					FROM clientes 
					WHERE id_Cliente = '$id'
					OR nome LIKE '%$id%'";
		}
	}	
		

		if ($stmt = $mysqli->prepare($sql)) 
		{

			$stmt->execute();
			$stmt->bind_result($id, $nome, $morada, $telefone, $email, $nif);

			echo "<br>";
			echo "<table class='table' id='result'>";
			echo "<tr bgcolor='#c1c1ff' text-align='center'> <td> <h2> ID Cliente </h2> </td> <td> <h2> Nome Cliente </h2> </td> <td> <h2> Morada </h2> </td> <td> <h2> Telefone </h2> </td> <td> <h2> E-mail </h2> </td> <td> <h2> NIF </h2> </td> <td colspan='2'> </td> </tr>";
			echo "<tr>";


			while ($stmt->fetch()) 
			{
				$offset_count = $offset_count + 1;
				echo "<tr>";
				echo "<td> <p class='label'> $id </p> </td> ";
				echo "<td> <p class='label'> $nome </p> </td> ";
				echo "<td> <p class='label'> $morada </p> </td> ";
				echo "<td> <p class='label'> $telefone </p> </td>";
				echo "<td> <p class='label'> $email </p> </td> ";
				echo "<td> <p class='label'> $nif </p> </td> ";
				echo "<td class='img'> <a href='editarCliente.php?id=$id&nome=$nome&morada=$morada&telefone=$telefone&email=$email&nif=$nif'> <img src='../imagens/edit.png' title='Editar Cliente'> </a> </td> ";
				//echo "<td class='img'> <a href='eliminarCliente.php?id=$id'> <img src='../imagens/trash.png' title='Eliminar Cliente'> </a> </td> ";
				echo "<td class='img'> <a HREF='#up' onmouseup='delCli(".$id.")'> <img src='../imagens/trash.png' title='Eliminar Cliente'> </a> </td> ";
				echo "</tr>";

			}

			echo "</table>";
			echo "<br>";

					    
			$stmt->close();

		}

		/*************************************************/
		/* criação ficheiro xml com o resultado da query */
		/*************************************************/
			$result = mysqli_query($mysqli, $sql);
			$myfile = "myfile.xml";
			//$myfile = realpath($myfile);

			if(mysqli_num_rows($result)) 
			{
			    $doc = new DOMDocument("1.0", "UTF-8");
			    //$doc->preserveWhiteSPace = false;
			    $doc->xmlStandalone = false;
			    $doc->formatOutput = true;

			    	//no principal
			    	$r = $doc->createElement( "Clientes" );
			    	$doc->appendChild($r);

			        while($row = mysqli_fetch_assoc($result)) 
			        {
			        	//1 nó "Cliente" por cada cliente
			            $r2 = $doc->createElement("Cliente");
			            foreach($row as $field=>$value) {
			                
			                $tChild = $doc->createElement( $field );
			                $tChild->appendChild( $doc->createTextNode($value) );
			                $r2->appendChild( $tChild );     
			            }
			            //nó "Cliente" dentro do nó principal "Clientes"
			            $r->appendChild($r2);
			        }
			        //fecha nó principal "Clientes"
			        $doc->appendChild($r);





			       	//echo $doc->saveXML();

  					//header("Content-type: application/octet-stream");
  					header("Content-type:  text/xml");
  					header("Content-disposition: attachment;filename=$myfile");
			        $doc->save($myfile);
			        echo("<div align='center'>
			        		<a href=".$myfile." download>
			        			<img src='../imagens/xml_icon.jpg' width='50px' />
			        		</a>
			        		<a onmouseup='displayResult()'><img src='../imagens/xml_upload.png' width='50px' /></a>

			        	</div>");
			}

		/*************************************************/

	

	$mysqli->close();

	?>

	

		


			<a name="up" id='txtHint'></a>

			<div id="xml_clientes"></div>
		</div>


	<!-- ****************** FOOTER *************** -->

	<?php include("footer.php");	?>

	

</body>

</html>