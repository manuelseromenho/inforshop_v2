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
	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" type="image/png" href="../imagens/favicon.ico"/>
	<meta charset="utf-8"/>  
	<script>
		function delFunc(str) //str é o id que vem da escolha na combobox
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
		        xmlhttp.open("GET","delFunc.php?idF="+str,true);
		        xmlhttp.send();
		    }
		}

		function pesqFunc()
		{
				var idFunc=document.getElementById("idFunc").value;

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
		        xmlhttp.open("GET","pesqFunc.php?idFunc="+idFunc,true);
		        xmlhttp.send();
		}


	</script>

</head>
<body>
	<!-- ************ HEADER ************** -->
	<?php include("header.php"); ?>
	<!-- ***************** BODY *****************-->
	<div class="container">
	<table class="procura">
		<tr bgcolor="#c1c1ff"> <td colspan="2"> <h2> Pesquisa de Funcionários </h2> </td> </tr>
		<!--<form action="pesquisarFunc.php" method="POST">-->
		
			<tr> 
				<td> <p class="form"> ID ou Nome do Funcionário: </p> </td> 
				<td> <p> <input type="text" id="idFunc" name="idFunc" class="selected" onkeyup="pesqFunc()"> </p> </td> 
			</tr>
			<tr bgcolor="#c1c1ff">
				<td colspan="2"> 
					<!--<input type="submit" value="pesquisar" name="pesquisar" class="button">-->
					<a onmouseup="pesqFunc()" class="button">Pesquisar</a>
				</td> 
			</tr>
		
	</table>

		<a name="up" id='txtHint'></a>
	</div>

	<!-- ****************** FOOTER *************** -->
	<?php include("footer.php");	?>
	
</body>
</html>