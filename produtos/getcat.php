<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script>
		/*function passar(str) {
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
	        xmlhttp.open("GET","adicionarProduto_ajax.php?idS="+str,true);
	        xmlhttp.send();
	    }
	}*/
	</script>
</head>
<body>

<?php
	require("../ligacaoBD.php");

	$q = intval($_GET['idC']);

	$sql_subcategorias= "SELECT s.id_subcategoria, s.nome_subcategoria FROM subcategorias as s, categorias as c 
	WHERE s.id_categoria = c.id_categoria AND s.id_categoria = \"".$q."\"";
	
	//echo "<table class='table' width='auto'>";
	//echo "<tr> <td> <p class='label'> Subcategoria: </p> </td> ";
	if ($smtp = $mysqli->prepare($sql_subcategorias))
	{
		$smtp->execute();						
		$smtp->bind_result($idS, $sub);

		//echo "<td> <p class='label'> <select name='idS' class='selected'>";


		//echo "<option value=".$_POST['$idS']." selected> Seleccione uma subcategoria </option>\n";
		//echo "<option value=".$idS." selected> Seleccione uma subcategoria </option>\n";
		while ($smtp->fetch())
		{	
			//echo "<option value=".$_POST['$idS'].">  $sub ($idS) </option>\n";
			echo "<option value=".$idS.">  $sub  </option>\n";
			
			//print_r($_POST);
		}

		
	}	

	//echo "<td> <a href='adicionarProduto_ajax.php?id=$idS'> <img src='../imagens/load.png' > </a></td></tr>";

?>
</body>
</html>