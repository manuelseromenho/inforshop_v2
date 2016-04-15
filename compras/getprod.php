<?php
require("../ligacaoBD.php");

$q_idP = intval($_GET['idP']);

  $sql_prod = "SELECT id_produto, preco_venda
      FROM produtos
      WHERE id_produto = '$q_idP'
      ORDER BY id_produto ASC";

  if ($smtp = $mysqli->prepare($sql_prod))
  {
    $smtp->execute();           
    $smtp->bind_result($idP, $preco);

     while ($smtp->fetch())
    {   
      echo "<input type='text' name='preco[]' value='$preco"."€"."' /> ";
    }
  }
?>
