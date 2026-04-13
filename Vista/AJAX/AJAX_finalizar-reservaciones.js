$(document).ready(function(){  
    // #iniciar-reservacion IDENTIDICADOR DE ID -> ACCION A EJECUTAR
    $(document).on('click', '#finalizar-reservacion', function(e){
     var IDReservacion = $(this).data('id'); // ID ENVIADA POR GET DESDE EL CONTROLADOR HACIA EL MODELO
     FinalizarReservacion(IDReservacion); // ID UNICO DE RESERVACION
     e.preventDefault();
    });
   });
   function FinalizarReservacion(IDReservacion){ 
    swal({
        title: "Finalizar Reservación",
        text: "¿Realmente desea finalizar esta reservación?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-finalizar-reservaciones&idreservacion='+IDReservacion,
                type: 'POST',
                   data: 'idreservacion='+IDReservacion, // COMPARACION PREVIA ANTES DE EJECUTAR ACCION EN SERVIDOR
                   dataType: 'json'
                })
                .done(function(respuesta){ // SI MODELO EJECUTA PETICION, REALIZA PETICION
                  if(respuesta=="OK"){
                      AlertaUsuarioMostrar("Reservación Finalizada","Su petición se ha realizado con éxito","success");
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
            AlertaUsuarioMostrar("Perfecto","Su petición se ha cancelado con éxito","info");
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