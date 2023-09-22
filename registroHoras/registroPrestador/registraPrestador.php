<?php
include "../funciones/conecta.php";

$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$carrera = $_REQUEST['carrera'];

$carreraTexto = ($carrera == 1) ? "INNI" : "INCO";

$sql = "INSERT INTO _prestador (nombre, codigo, carrera) VALUES ('$nombre', '$codigo', '$carreraTexto')";

$res = $conn->query($sql);

header("Location: prestador.html");



?>
