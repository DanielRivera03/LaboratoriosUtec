"use strict";

$(document).ready(function () {
  $("#frm_modificar_clasificaciones_notificaciones").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var IdClasificacionNotificacion = $('#txtidrolusuario').val(); // ID CLASIFICACION NOTIFICACION

    var CodigoClasificacionNotificacion = $('#txtcodigo_clasificacion_notificaciones').val(); // CODIGO CLASIFICACION NOTIFICACION

    var DescripcionClasificacionNotificacion = $('#txtdescripcion_clasificacion_notificaciones').val(); // DESCRIPCION CLASIFICACION NOTIFICACION

    if (IdClasificacionNotificacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El id único es requerido");
      return false;
    }

    if (CodigoClasificacionNotificacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código único es requerido");
      return false;
    }

    if (DescripcionClasificacionNotificacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La descripción es requerida");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-modificar-clasificaciones-notificaciones",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        // REGISTRO DE NUEVOS USUARIOS
        success: function success(resultado) {
          setTimeout(function () {
            NotificacionesSweetAlert("Perfecto", "Registro actualizado con éxito", "info");
            $('#envio-datosusuarios').prop('disabled', false);
            $('#envio-datosusuarios').show();
            Notificaciones_NotifySuccess("Perfecto", "Clasificación de notificación modificada con éxito.");
            setTimeout(function () {
              location.reload();
            }, 2500);
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
  });
});
//# sourceMappingURL=AJAX_envio-datos-modificar-clasificaciones-notificaciones.dev.js.map
