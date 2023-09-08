<?php
include "conecta.php";

$codigo = $_REQUEST['codigo'];

$sql = "SELECT * FROM _prestador WHERE codigo = '$codigo'";

$res = $conn->query($sql);

$row = $res->fetch_array();
$nombre = $row["nombre"];
$tiempoAcumulado = $row["tiempoAcumulado"];

echo $nombre;
