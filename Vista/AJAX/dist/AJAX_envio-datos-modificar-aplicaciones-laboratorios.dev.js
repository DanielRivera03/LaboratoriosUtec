"use strict";

$(document).ready(function () {
  $("#frm_modificar_aplicaciones").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var IdAplicacion = $('#txtidaplicaciones_laboratorio').val(); // CODIGO DE APLICACIONES

    var CodigoAplicacion = $('#txtcodigoaplicaciones_laboratorio').val(); // CODIGO DE APLICACIONES

    var NombreAplicacion = $('#txtnombreaplicaciones_laboratorio').val(); // NOMBRE DE APLICACIONES

    var IdClasificacionAplicacion = $('#slclasificacionaplicaciones_laboratorio').val(); // TIPO DE APLICACION CLASIFICACION

    if (IdAplicacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El id único de la aplicación es requerido");
      return false;
    }

    if (CodigoAplicacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la aplicación es requerido");
      return false;
    }

    if (NombreAplicacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre de la aplicación es requerido");
      return false;
    }

    if (IdClasificacionAplicacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La Clasificación de la aplicación es requerida");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-modificar-aplicaciones-laboratorio",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function success(resultado) {
          setTimeout(function () {
            Notificaciones_NotifySuccess("Perfecto", "Los datos de la aplicación han sido actualizados con éxito.");
            NotificacionesSweetAlert("Perfecto", "Registro actualizado con éxito", "info");
            $('#envio-datosusuarios').prop('disabled', false);
            $('#envio-datosusuarios').show();
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
//# sourceMappingURL=AJAX_envio-datos-modificar-aplicaciones-laboratorios.dev.js.map
