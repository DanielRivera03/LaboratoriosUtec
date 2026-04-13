$(document).ready(function(){  
    // #activar-usuarios IDENTIDICADOR DE ID -> ACCION A EJECUTAR
    $(document).on('click', '#ocultar-notificacion', function(e){
     var IDNotificaciones = $(this).data('id'); // ID ENVIADA POR GET DESDE EL CONTROLADOR HACIA EL MODELO
     OcultarNotificaciones(IDNotificaciones); // ID UNICO DE USUARIOS
     e.preventDefault();
    });
   });
   function OcultarNotificaciones(IDNotificaciones){ 
    swal({
        title: "Ocultar Notificación",
        text: "¿Realmente desea ocultar esta notificación?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-ocultar-notificaciones-usuarios&idnotificacion='+IDNotificaciones,
                type: 'POST',
                   data: 'idnotificacion='+IDNotificaciones, // COMPARACION PREVIA ANTES DE EJECUTAR ACCION EN SERVIDOR
                   dataType: 'json'
                })
                .done(function(respuesta){ // SI MODELO EJECUTA PETICION, REALIZA PETICION
                  if(respuesta=="OK"){
                      AlertaUsuarioMostrar("Notificación Oculta","Su petición se ha realizado con éxito","info");
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