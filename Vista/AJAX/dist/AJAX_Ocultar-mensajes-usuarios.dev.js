"use strict";

$(document).ready(function () {
  // #activar-usuarios IDENTIDICADOR DE ID -> ACCION A EJECUTAR
  $(document).on('click', '#ocultar-mensaje', function (e) {
    var IDMensajeria = $(this).data('id'); // ID ENVIADA POR GET DESDE EL CONTROLADOR HACIA EL MODELO

    OcultarMensaje(IDMensajeria); // ID UNICO DE USUARIOS

    e.preventDefault();
  });
});

function OcultarMensaje(IDMensajeria) {
  swal({
    title: "Ocultar Mensaje",
    text: "¿Realmente desea ocultar este mensaje?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then(function (willDelete) {
    if (willDelete) {
      $.ajax({
        url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-ocultar-mensajes-usuarios&idmensajeria=' + IDMensajeria,
        type: 'POST',
        data: 'idmensajeria=' + IDMensajeria,
        // COMPARACION PREVIA ANTES DE EJECUTAR ACCION EN SERVIDOR
        dataType: 'json'
      }).done(function (respuesta) {
        // SI MODELO EJECUTA PETICION, REALIZA PETICION
        if (respuesta == "OK") {
          AlertaUsuarioMostrar("Mensaje Oculto", "Su petición se ha realizado con éxito", "info"); // 2.5 SEGUNDOS DE RETRASO PARA MOSTRAR ALERTA Y REFRESCAR

          setTimeout(function () {
            location.reload();
          }, 2500);
        }
      }).fail(function () {
        AlertaUsuarioMostrar("Error", "Lo sentimos, en estos momentos no podemos procesar tu solicitud, por favor vuelve más tarde...", "error");
      });
    } else {
      AlertaUsuarioMostrar("Perfecto", "Su petición se ha cancelado con éxito", "info");
    }
  });
} // FUNCION PARA MOSTRAR ALERTAS A USUARIOS


function AlertaUsuarioMostrar(titulo, descripcion, icono) {
  swal(titulo, // ENCABEZADO 
  descripcion, // CUERPO
  icono // ICONO DE ALERTA
  );
}
//# sourceMappingURL=AJAX_Ocultar-mensajes-usuarios.dev.js.map
