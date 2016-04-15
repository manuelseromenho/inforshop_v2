<html> 
<head> 
	<title> Teste </title> 
</head>
<body>
	<?php
		$mysqli = new mysqli("inforshop.freeddns.org", "inforshopuser", "123BangBang+", "inforshop");
		mysqli_set_charset($mysqli, "utf8");

		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit(); }

		if ($stmt = $mysqli->prepare('SELECT * FROM Clientes ORDER BY Nome LIMIT 5;')) {
			$stmt->execute();

			/* liga as variaveis ao comando preparado */
			$stmt->bind_result($nome);

			while ($stmt->fetch()){   //'busca' os valores
				printf("%s", $nome);
			}
			$stmt->close(); // close statement
		}
		$mysqli->close(); //close connection
	?>
</body>
</html>
