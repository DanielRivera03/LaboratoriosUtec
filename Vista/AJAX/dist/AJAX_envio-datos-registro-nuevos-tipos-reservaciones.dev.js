"use strict";

$(document).ready(function () {
  $("#frm_registro_nuevos_tipos_reservaciones").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var NombreTipoReservacion = $('#txtnombre_tiporeservacion').val(); // NOMBRES ROL DE  USUARIO

    var DescripcionTipoReservacion = $('#txtdescripcion_tiporeservacion').val(); // DESCRIPCION ROL DE USUARIO

    if (NombreTipoReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre del tipo de reservación es requerido");
      return false;
    }

    if (DescripcionTipoReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La descripción del tipo de reservación es requerido");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-tipos-reservaciones",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function success(resultado) {
          setTimeout(function () {
            NotificacionesSweetAlert("Perfecto", "Nuevo tipo de reservación dado de alta", "info");
            Notificaciones_NotifySuccess("Perfecto", "Nuevo tipo de reservación dado de alta exitosamente.");
            LimpiezaFormulario();
            $('#envio-datosusuarios').prop('disabled', false);
            $('#envio-datosusuarios').show();
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
    NombreTipoReservacion = $('#txtnombre_tiporeservacion').val(""); // NOMBRES ROL DE  USUARIO

    DescripcionTipoReservacion = $('#txtdescripcion_tiporeservacion').val(""); // DESCRIPCION ROL DE USUARIO
  }
});
//# sourceMappingURL=AJAX_envio-datos-registro-nuevos-tipos-reservaciones.dev.js.map
