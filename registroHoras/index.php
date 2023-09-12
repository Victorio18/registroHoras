<?php include "./funciones/conecta.php";

$sql = "SELECT * FROM _prestador WHERE horaEntrada IS NOT NULL";
$res = $conn->query($sql);


echo "<script>";
while ($row = $res->fetch_array()) {
    $nombre = $row["nombre"];
    $codigo = $row["codigo"];
    $horaEntrada = $row["horaEntrada"];

    echo "$(".col.name").append("<p class="+'$codigo'+">"+'$nombre'+"</p>")";
    //echo "$(".col.code").append("<p class="+$codigo+">"+$codigo+"</p>");";
    //echo "$(".col.hour").append("<p class="+$codigo+" id="+$codigo+">"+$horaEntrada+"</p>");";
}

echo "</script>";
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

            <input type="number" id="consulta" name="consulta" placeholder="CODIGO" />
            <input type="submit" id="submit" value="Consultar" onclick="return false;" disabled>
        </div>

        <div class="info">
            <div>
                <p class="list_title">PUNTOS A TOMAR EN CUENTA</p>

                <ul class="list">
                    <li>Sesiones con mas de 8 horas de duración no serán registradas por el sistema.</li>
                    <li>Todos los registros son para uso exclusivo de esta dependencia. </li>
                    <li>Las horas extra no se deben registrar por medio de este sitio.</li>
                </ul>
            </div>

            <div class="table_container">
                <div class="table">


                    <div class="col name">
                        <h2 class="table_title first">Prestadores en tiempo</h2>

                    </div>

                    <div class="col code">
                        <h2 class="table_title second">Codigo</h2>

                    </div>
                    <div class="col hour">
                        <h2 class="table_title third">Hora entrada</h2>



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
    const connected = []


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
            dataType: 'json',
            data: 'codigo=' + codigo,
            success: function(res) {
                if (res.encontrado) {

                    if(connected.includes(codigo)){
                      var dt = new Date();
                      var timeExit = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                      $("."+codigo).remove();
                      input.value = "";
                      let index = connected.indexOf(codigo);
                      connected.splice(index, 1);
                      console.log(timeExit);


                      var datos = {
                          codigo: codigo,
                          hora_salida: timeExit
                      };

                      $.ajax({
                        type: 'POST',
                        url: 'funciones/logout.php',
                        data: datos ,
                        success: function(response) {
                          console.log("salio");
                        }
                      })


                    }else{
                      var dt2 = new Date();
                      var timeEntry = dt2.getHours() + ":" + dt2.getMinutes() + ":" + dt2.getSeconds();

                      $(".col.name").append("<p class="+codigo+">"+res.nombre+"</p>");
                      $(".col.code").append("<p class="+codigo+">"+codigo+"</p>");
                      $(".col.hour").append("<p class="+codigo+" id="+codigo+">"+timeEntry+"</p>");

                      input.value = "";

                      var datos = {
                          codigo: codigo,
                          hora_entrada: timeEntry
                      };

                      $.ajax({
                        type: 'POST',
                        url: 'funciones/login.php',
                        data: datos ,
                        success: function(response) {
                          console.log("entro");
                        }
                      })

                      connected.push(codigo);
                    }




                } else {
                    alert("No encontrado");
                    input.value = "";
                }
            },
            error: function() {
                console.log("Error ");
            }

        });
    }
</script>
