<?php
include "funciones/consulta.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <h1>BIENVENIDO AL SISTEMA DE REGISTRO DE HORAS</h1>
        <div class="form">
            <input type="number" id="codigo" name="codigo" placeholder="CODIGO" />
            <input type="submit" id="submit" value="Entrar" onclick="recibe(); return false;" disabled>
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
                        <p><?php echo $nombre; ?></p>
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


<script>
    const input = document.getElementById("codigo")
    const boton = document.getElementById("submit")

    function disableButton() {
        if (input.value.length == 9) {
            boton.removeAttribute("disabled")
        } else {
            boton.setAttribute("disabled", "true")
        }
    }

    input.addEventListener("input", disableButton)

    function recibe() {
        var codigo = $('#codigo').val();

        $.ajax({
            url: 'funciones/consulta.php',
            type: 'POST',
            dataType: 'text',
            data: 'codigo=' + codigo,
            success: function(res) {
                if (res == 0) {
                    console.log("No encontrado")
                } else {
                    console.log("Encontrado")
                }
            },
            error: function() {
                console.log("Error ");
            }

        });
    }
</script>