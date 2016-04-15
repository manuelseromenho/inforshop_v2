<?php
require("../ligacaoBD.php");

$q_qtd = intval($_GET['qtd']);
$q_idP = intval($_GET['id_produto']);

  $sql_prod = "SELECT id_produto, quantidade
      FROM produtos
      WHERE id_produto = '$q_idP'
      ORDER BY id_produto ASC";

  if ($smtp = $mysqli->prepare($sql_prod))
  {
    $smtp->execute();           
    $smtp->bind_result($idP, $qtd);

     while ($smtp->fetch())
    {   
      if($q_qtd > $qtd)
      {
        echo "qtd inválida";
      }
      else
      {
        echo "qtd válida";
      }
    }
  }
?>
