<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<?php
require("../ligacaoBD.php");
$q = intval($_GET['idCliente']);

$sql="SELECT * FROM clientes WHERE id_Cliente = '".$q."'";

$result = mysqli_query($mysqli, $sql);

echo "<table class='table' width='auto'>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr> <td> <b>Nome Cliente:</b> </td> <td> <p class='label'> ".$row['nome']."  </p> </td>";
    echo "<td> NIF: </td> <td> <p class='label'> ".$row['nif']." </p> </td>";
    echo "<td> Morada: </td> <td> <p class='label'> ".$row['morada']." </p> </td>";
    echo "<td> Telefone: </td> <td> <p class='label'> ".$row['telefone']." </p> </td>";
    echo "<td> E-mail: </td> <td> <p class='label'> ".$row['email']." </p> </td> </tr>";
    
}
echo "</table>";
?>
</body>
</html>