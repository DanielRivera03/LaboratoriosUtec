$(document).ready(function(){  
    // #desactivar-usuarios IDENTIDICADOR DE ID -> ACCION A EJECUTAR
    $(document).on('click', '#finalizar-practica-libre', function(e){
     var IDPracticaLibre = $(this).data('id'); // ID ENVIADA POR GET DESDE EL CONTROLADOR HACIA EL MODELO
     FinalizarPracticaLibre(IDPracticaLibre); // ID UNICO DE USUARIOS
     e.preventDefault();
    });
   });
   function FinalizarPracticaLibre(IDPracticaLibre){ 
    swal({
        title: "Finalizar",
        text: "¿Realmente desea finalizar esta práctica libre?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-finalizar-practicas-libres&idpracticalibre='+IDPracticaLibre,
                type: 'POST',
                   data: 'idpracticalibre='+IDPracticaLibre, // COMPARACION PREVIA ANTES DE EJECUTAR ACCION EN SERVIDOR
                   dataType: 'json'
                })
                .done(function(respuesta){ // SI MODELO EJECUTA PETICION, REALIZA PETICION
                  if(respuesta=="OK"){
                      AlertaUsuarioMostrar("Práctica Finalizada","Su petición se ha realizado con éxito","success");
                       // 2.5 SEGUNDOS DE RETRASO PARA MOSTRAR ALERTA Y REFRESCAR
                       setTimeout(function(){
                          location.reload();
                      }, 2500);
                  }
                })
                .fail(function(){
                  AlertaUsuarioMostrar("Error","Lo sentimos, en estos momentos no podemos procesar tu solicitud, por favor vuelve más tarde...","error");
                });
        } else {
            AlertaUsuarioMostrar("Perfecto","Su petición se ha realizado con éxito","info");
        }
    })
   }

// FUNCION PARA MOSTRAR ALERTAS A USUARIOS
function AlertaUsuarioMostrar(titulo, descripcion, icono) {
    swal(
        titulo, // ENCABEZADO 
        descripcion, // CUERPO
        icono // ICONO DE ALERTA
    );
}