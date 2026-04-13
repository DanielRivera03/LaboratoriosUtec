"use strict";

$(document).ready(function () {
  $("form[id^='frm_cancelar_reservaciones']").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var IdReservacion = $(this).find('#txtIdReservacion').val(); // IDENTIFICADOR UNICO RESERVACION
    // PARA SELECCIONAR MULTIPLES FORM CON DISTINTOS ID

    var ComentarioCancelacion = $(this).find('textarea[name="txtcomentariocancelacion_reservacion"]').val(); // COMENTARIO CANCELACION

    if (IdReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de reservación es requerido");
      return false;
    }

    if (ComentarioCancelacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El comentario de cancelación es requerido");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-cancelar-reservaciones-individualmente",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        // REGISTRO DE NUEVOS USUARIOS
        success: function success(resultado) {
          setTimeout(function () {
            NotificacionesSweetAlert("Perfecto", "Esta reservación ha sido cancelada exitosamente", "info");
            Notificaciones_NotifySuccess("Perfecto", "Esta reservación ha sido cancelada exitosamente.");
            setTimeout(function () {
              location.reload();
            }, 2500);
          }, 3500);
        },
        error: function error(resultado) {
          setTimeout(function () {
            Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
            $('#envio-datosusuarios').prop('disabled', false);
          }, 3500);
        },
        // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
        beforeSend: function beforeSend() {
          Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
          $('#envio-datosusuarios').prop('disabled', true);
        }
      });
    }
  }); //-> LIMPIAR VALORES FORMULARIO

  function LimpiezaFormulario() {
    IdReservacion = $(this).find('#txtIdReservacionSeguimiento').val(""); // IDENTIFICADOR UNICO RESERVACION

    ComentarioCancelacion = $('#txtcomentariocancelacion_reservacion').val(""); // COMENTARIO CANCELACION
  }
});
//# sourceMappingURL=AJAX_envio-datos-cancelar-reservaciones.dev.js.map
