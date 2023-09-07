<?php
include "funciones/conecta.php";

$sql = "SELECT * FROM _prestador WHERE codigo = 214578161";

$res = $conn->query($sql);

$row = $res->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilos.css">
</head>

<body>
    <div class="container">
        <h1>BIENVENIDO AL SISTEMA DE REGISTRO DE HORAS</h1>
        <div class="form">
            <input type=" text" placeholder="CODIGO" />
            <input type="submit" value="Entrar">
        </div>

        <div class="info">
            <div>
                <p class="list_title">PUNTOS A TOMAR EN CUENTA</p>

                <ul class="list">
                    <li>Sesiones con mas de 8 horas de duración no serán registradas por el sistema.</li>
                    <li>Todos los registros son para uso exclusivo de esta dependencia.</li>
                    <li>Las horas extra no se deben registrar por medio de este sitio.</li>
                </ul>
            </div>

            <div class="table_container">
                <div class="table">
                    <div class="col">
                        <h2 class="table_title first">Prestadores en tiempo</h2>
                        <p>Victor Manuel Robles Lopez</p>
                    </div>
                    <div class="col">
                        <h2 class="table_title second">Tiempo</h2>
                        <p>2:00:00</p>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <?php
    //echo $nombre = $row["nombre"];
    ?>

</body>

</html>