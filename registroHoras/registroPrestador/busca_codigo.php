<?php

include "../funciones/conecta.php";


$codigo = $_REQUEST['codigo'];

// $codigo = 219749789;

$sql =  "SELECT * from _prestador where codigo = '$codigo'";

$res = $conn->query($sql);

echo $res->num_rows > 0;

?>
