function recibe(){
    let nombre = $('#nombre').val();
    let codigo = $('#codigo').val();
    let carrera = $('#carrera').val();


    if(codigo.length == 9 && nombre.length > 0 && carrera != 0){
      carrera == 1 ? carrera = "INNI" : carrera = "INCO";
      $.ajax({
          url: 'busca_codigo.php',
          type: 'post',
          dataType: 'text',
          data: 'codigo=' + codigo,
          success: function(res) {
              if (res) {
                  console.log("Codigo ya existe");
                  alert('Este código ya existe');
              } else {
                 document.forma01.method = 'post';
                 document.forma01.action = 'registraPrestador.php';
                 document.forma01.submit();

                 console.log("salvado");
                 // console.log(res)
              }
          },
          error: function() {
              alert('Error archivo no encontrado');
          }
      });
    }else {
      alert("Ingrese todos los datos");
    }



}
