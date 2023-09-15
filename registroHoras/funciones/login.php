<?php
include "conecta.php";

$codigo = $_REQUEST['codigo'];
$hora_entrada = $_REQUEST['hora_entrada'];

$sql = "UPDATE _prestador SET horaEntrada = '$hora_entrada' WHERE codigo = '$codigo'";

$res = $conn->query($sql);
