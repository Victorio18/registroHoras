
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos/estilos.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
    <script src="jquery/jquery-3.7.1.min.js"></script>

</head>


<body>
  <div class="header-container">
      <div class="containerH">
          <div>
              <img src="./images/logo-udg-cucei.png" alt="logoCucei">
          </div>
          <div >
              <img src="./images/cuceimobilelogo.png" alt="logoCuceiMobile">
          </div>
      </div>
    </div>

    <div class="container">
        <h1>BIENVENIDO AL SISTEMA DE REGISTRO DE HORAS</h1>
        <div class="form">
            <input type="number" id="codigo" name="codigo" placeholder="CODIGO" />
            <input type="submit" id="submit" value="Entrar" onclick="recibe(); return false;" disabled>
            <input type="submit" id="search" value="Consultar" onclick="consulta(); return false;" >

            <!-- <input type="number" id="consulta" name="consulta" placeholder="CODIGO" />
            <input type="submit" id="submit" value="Consultar" onclick="return false;" disabled> -->
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
                        <h2 class="table_title second">Código</h2>

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
    const connected = [];



    function disableButton() {
      if (input.value.length == 9) {
          boton.removeAttribute("disabled")


      } else {
          boton.setAttribute("disabled", "true")
      }

      if(connected.includes(input.value)){
        boton.style.backgroundColor = "red";
        boton.value = "Salir";

      }else{
        boton.style.backgroundColor = "green";
        boton.value = "Entrar";
      }


    }

    input.addEventListener("input", disableButton);

    function recibe() {
        var codigo = $('#codigo').val();
        if(boton.value === "Salir"){
          boton.value = "Entrar";
          boton.style.backgroundColor = "green";
          boton.setAttribute("disabled", "true")
        }
        $.ajax({
            url: 'funciones/consulta.php',
            type: 'POST',
            dataType: 'json',
            data: 'codigo=' + codigo,
            success: function(res) {
                if (res.encontrado) {
                    if(connected.includes(codigo)){
                      // disableButton(res.horaEntrada);
                      var dt = new Date();
                      var timeExit = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                      $("."+codigo).remove();
                      input.value = "";
                      let index = connected.indexOf(codigo);
                      connected.splice(index, 1);

                      // connected = connected.filter(prestador => prestador.codigo !== codigo;
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

                      let segundos = parseInt(res.tiempoAcumulado);
                      alert(segundosHoras(segundos));

                      location.reload();


                    }else{
                      let dt2 = new Date();
                      var timeEntry = dt2.getHours() + ":" + dt2.getMinutes() + ":" + dt2.getSeconds();

                      cronometro(codigo, 0);

                      $(".col.name").append("<p class="+codigo+">"+res.nombre+"</p>");
                      $(".col.code").append("<p class="+codigo+">"+codigo+"</p>");
                      $(".col.hour").append("<p class="+codigo+" id="+codigo+"></p>");

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
    <?php
    include "./funciones/conecta.php";

    $sql = "SELECT * FROM _prestador WHERE horaEntrada IS NOT NULL";
    $res = $conn->query($sql);



    while ($row = $res->fetch_array()) {
        $nombre = $row["nombre"];
        $codigo = $row["codigo"];
        $horaEntrada = $row["horaEntrada"];

        // $horaActual = time();
?>
        var actualDate = new Date();
        var horaActual = actualDate.getHours() + ":" + actualDate.getMinutes() + ":" + actualDate.getSeconds();
        //
        <?php echo "var horaEntrada = '$horaEntrada'";  ?>
        //
        // console.log(horaActual);


         var tiempo1 = horaEntrada.split(':').map(Number);
         var tiempo2 = horaActual.split(':').map(Number);

         var segundos1 = tiempo1[0] * 3600 + tiempo1[1] * 60 + tiempo1[2];
         var segundos2 = tiempo2[0] * 3600 + tiempo2[1] * 60 + tiempo2[2];
         //
         var segundosTranscurridos = Math.abs(segundos1 - segundos2);

         <?php echo "var codigoConectados = '$codigo'";  ?>

         // console.log(codigoConectados);
         connected.push(codigoConectados);

         // console.log(connected);

        // $horaEn = strtotime($horaEntrada);

        // echo "var segundosTranscurridos = Math.floor(dt2.getTime()/1000) - $horaEn";

        // $segundos_transcurridos = strtotime($horaActual) - strtotime($horaEntrada);
        //
        // $segundosT = (int)$segundos_transcurridos;

<?php



        // echo "console.log($segundosT);";
        // echo "console.log(\"$horaActual\");";
        // echo "console.log($horaEntrada);";
        // echo "var datos = {
        //     codigo: $codigo,
        //     hora_entrada: $horaEntrada
        // };"



        // echo "console.log('$horaActual');";

        echo "$('.col.name').append('<p class=\"$codigo\">$nombre</p>');";
        echo "$('.col.code').append('<p class=\"$codigo\">$codigo</p>');";
        echo "$('.col.hour').append('<p class=\"$codigo\" id=\"$codigo\" ></p>');";

        echo "if(connected.includes('$codigo')){";
        echo "cronometro($codigo, segundosTranscurridos);";
        echo "}";
        // echo "cronometro($codigo, timeEntry);";

        // echo "connected.push('$codigo');";

        echo "console.log(connected);";


        // echo "console.log(\"connedasd\");";
        //echo "$(".col.code").append("<p class="+$codigo+">"+$codigo+"</p>");";
        //echo "$(".col.hour").append("<p class="+$codigo+" id="+$codigo+">"+$horaEntrada+"</p>");";
        }


      ?>

      function consulta(){
        var codigo = $('#codigo').val();
        $.ajax({
            url: 'funciones/consulta.php',
            type: 'POST',
            dataType: 'json',
            data: 'codigo=' + codigo,
            success: function(res) {
                if (res.encontrado) {
                  let segundos = parseInt(res.tiempoAcumulado);
                  alert(segundosHoras(segundos));
                  // segundosHoras(segundos);
                  // console.log(typeof segundos);
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

            function segundosHoras(segundos){
              var horas = Math.floor(segundos/3600).toString().padStart(2,"0");
              var minutos = Math.floor((segundos % 3600) / 60).toString().padStart(2,"0");
              var segundosRestantes = segundos % 60;
              segundosRestantes = segundosRestantes.toString().padStart(2,"0");

               var horasFinales = horas + ": " + minutos +": "+ segundosRestantes;
               console.log(typeof horas);
               console.log(typeof minutos);
               console.log(typeof segundosRestantes);
               // console.log(typeof horasFinales);
              return horasFinales;
            }

            function cronometro(codigo, segundosTranscurridos){
              var contador = segundosTranscurridos;


                setInterval(function(){
                  contador++;
                  // console.log(contador);
                  var horas = Math.floor(contador/3600).toString().padStart(2,"0");
                  var minutos = Math.floor((contador % 3600) / 60).toString().padStart(2,"0");
                  var segundosRestantes = contador % 60;
                  segundosRestantes = segundosRestantes.toString().padStart(2,"0");

                  // if(!connected.includes(codigo)){
                    var tiempoFormateado = horas + ": " + minutos +": "+ segundosRestantes;
                    document.getElementById(codigo).textContent = tiempoFormateado;
                  // }


                   // console.log(tiempoFormateado);
                }, 1000);


            }


</script>
