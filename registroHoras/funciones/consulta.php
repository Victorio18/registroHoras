<?php
include "conecta.php";

$codigo = $_REQUEST['codigo'];

$sql = "SELECT * FROM _prestador WHERE codigo = '$codigo'";

$res = $conn->query($sql);



if($res->num_rows > 0){
  $row = $res->fetch_array();
  $nombre = $row["nombre"];
  $tiempoAcumulado = $row["tiempoAcumulado"];
  $respuesta = array('encontrado'=> true, 'nombre' => $nombre, 'tiempoAcumulado' => $tiempoAcumulado);
  echo json_encode($respuesta);
}
else{
  $respuesta = array('encontrado'=> false);
  echo json_encode($respuesta);
}
