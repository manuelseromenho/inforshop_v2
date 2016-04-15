<?php

	require("ligacaoBD.php");

	//echo "$servername\t$username\t$password\t$dbname";


	function SignIn($mysqli) 
	{ 
		if ($stmt = $mysqli->prepare('SELECT user, pass FROM admin;')) 
		{
			$stmt->execute();
			$stmt->bind_result($user_,$pass_);
			while ($stmt->fetch()){ }
			$stmt->close(); // close statement
		}
		else
		{
			echo mysqli_error($mysqli);
		}
		$mysqli->close(); //close connection

		if (mysqli_connect_errno()) 
		{
			printf("<br>Connect failed: %s\n", mysqli_connect_error());
			exit(); 
		} 

		session_start(); //starting the session for user profile page 

		$user_post = $_POST['user'];
		$pass_post = $_POST['pass'];

		/*verifica primeiro se existe texto na caixa "user"
		  verifica segundo se existe texto na caixa "user" e "pass"
		  verifica terceiro se a o texto da caixar "user" e "pass" são iguais aos guardados*/
		if(!empty($user_post))
		{ 
			if(!empty($user_post) AND !empty($pass_post))
			{
				if($user_post == $user_)
				{
					if($pass_post == $pass_)
					{
						$_SESSION['user'] = $user_;
						//echo "<script> alert('Sucesso ao fazer login.');window.location.href='index.php';</script>";
						echo "<script>window.location.href='index.php';</script>";	
					}
					else
					{
						echo "<script> alert('ERRO. Password ou Utilizador inválidos!') </script>";
					}

				}
				else
				{
					echo "<script> alert('ERRO. Password ou Utilizador inválidos!') </script>";
				}
				exit();
			}
			else 
			{
				echo "<script> alert('ERRO. Tente de novo.') </script>";
			} 
		}
		else 
		{
			echo "<script> alert('ERRO. Tente de novo.') </script>";
		} 

	}
?>

<html>
<head>

	<title> INFORSHOP </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" type="image/png" href="imagens/favicon.ico"/>
	<meta charset="utf-8">  

</head>

<body>

	<div class="dark-matter">
		<form action="login.php" method="POST" >

			<h1> Login </h1>
	        <p> Username: <input type="text" name="user" id="user" maxlength="10"> </p>
	        <p> Password: <input type="password" name="pass" id="pass" maxlength="10"> </p>
	        <p class="submit"> <input type="submit" name="Submit" value="Login" class="button"> </p>

	    </form>

	</div>

</body>

</html>





<?php

	if(isset($_POST['Submit']))

	{
		SignIn($mysqli);
	}

?>











