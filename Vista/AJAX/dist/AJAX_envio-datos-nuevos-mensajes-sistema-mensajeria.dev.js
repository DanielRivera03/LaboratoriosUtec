"use strict";

$(document).ready(function () {
  $("#frm_envio_nuevos_mensajes").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var IdUsuarioDestinatario = $('#sltidusuariodestinatario').val(); // ID USUARIO DESTINATARIO

    var NombreMensaje = $('#txtnombremensaje').val(); // NOMBRE MENSAJE

    var AsuntoMensaje = $('#txtasuntomensaje').val(); // ASUNTO MENSAJE

    var DetalleMensaje = $('#text-box').val(); // DETALLE MENSAJE

    if (IdUsuarioDestinatario === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Por favor seleccione un destinatario");
      return false;
    }

    if (NombreMensaje === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre del mensaje es requerido");
      return false;
    }

    if (AsuntoMensaje === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El asunto del mensaje es requerido");
      return false;
    }

    if (DetalleMensaje.trim() === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El detalle del mensaje es requerido");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-nuevo-mensaje-sistema-mensajeria",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        // REGISTRO DE NUEVOS USUARIOS
        success: function success(resultado) {
          setTimeout(function () {
            NotificacionesSweetAlert("Perfecto", "Nuevo mensaje enviado con éxito", "info");
            Notificaciones_NotifySuccess("Perfecto", "El mensaje ha sido enviado exitosamente al destinatario final.");
            $('#envio-datosusuarios').prop('disabled', false);
            $('#envio-datosusuarios').show();
            LimpiezaFormulario();
          }, 3500);
        },
        error: function error(resultado) {
          setTimeout(function () {
            Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
            $('#envio-datosusuarios').prop('disabled', false);
            $('#envio-datosusuarios').show();
          }, 3500);
        },
        // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
        beforeSend: function beforeSend() {
          Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
          $('#envio-datosusuarios').prop('disabled', true);
          $('#envio-datosusuarios').hide();
        }
      });
    }
  }); //-> LIMPIAR VALORES FORMULARIO

  function LimpiezaFormulario() {
    IdUsuarioDestinatario = $('#sltidusuariodestinatario').val(""); // ID USUARIO DESTINATARIO

    NombreMensaje = $('#txtnombremensaje').val(""); // NOMBRE MENSAJE

    AsuntoMensaje = $('#txtasuntomensaje').val(""); // ASUNTO MENSAJE

    DetalleMensaje = $('#text-box').val(""); // DETALLE MENSAJE
  }
});
//# sourceMappingURL=AJAX_envio-datos-nuevos-mensajes-sistema-mensajeria.dev.js.map
