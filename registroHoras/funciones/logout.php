<?php
include "conecta.php";
$codigo = $_REQUEST['codigo'];
$hora_salida = $_REQUEST['hora_salida'];

$sql = "SELECT * FROM _prestador WHERE codigo = '$codigo'";

$res = $conn->query($sql);


if($res->num_rows > 0){
  $row = $res->fetch_array();
  $tiempoAcumulado = $row["tiempoAcumulado"];
  $hora_entrada = $row["horaEntrada"];


  $segundos_transcurridos = strtotime($hora_salida) - strtotime($hora_entrada);



  if($segundos_transcurridos >= 28800 ){
    $segundos_transcurridos = 0;
  }

  $tiempoAcumulado  = $tiempoAcumulado + $segundos_transcurridos;



  $sql1 = "UPDATE _prestador SET horaEntrada = NULL , tiempoAcumulado = '$tiempoAcumulado' WHERE codigo = '$codigo'";

  $res1 = $conn->query($sql1);

}
