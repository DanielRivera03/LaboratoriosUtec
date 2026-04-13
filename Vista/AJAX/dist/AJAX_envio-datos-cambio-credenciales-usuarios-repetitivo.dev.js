"use strict";

$(document).ready(function () {
  $("#frm_cambiocredenciales_repetitivo").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var NuevaCredencial = $('#txtnuevaclaveusuarios').val(); // NUEVA CREDENCIAL

    if (NuevaCredencial === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Por favor ingrese su nueva credencial de acceso");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-cambio-credenciales-repetitivo",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function success(resultado) {
          setTimeout(function () {
            NotificacionesSweetAlert("Perfecto", "Nueva credencial de acceso cambiada exitosamente", "info");
            Notificaciones_NotifySuccess("Nueva Credencial Exitosa", "Espere un momento...");
            LimpiezaFormulario();
            $('#procesar_recuperaciones').prop('disabled', false);
            $('#procesar_recuperaciones').show();
            setTimeout(function () {
              location.href = "../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=cerrarsesion";
            }, 3000);
          }, 3500);
        },
        error: function error(resultado) {
          setTimeout(function () {
            Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
            $('#procesar_recuperaciones').prop('disabled', false);
            $('#procesar_recuperaciones').show();
          }, 3500);
        },
        // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
        beforeSend: function beforeSend() {
          Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
          $('#procesar_recuperaciones').prop('disabled', true);
          $('#procesar_recuperaciones').hide();
        }
      });
    }
  }); //-> LIMPIAR VALORES FORMULARIO

  function LimpiezaFormulario() {
    NuevaCredencial = $('#txtnuevaclaveusuarios').val(""); // NUEVA CREDENCIAL DE ACCESO
  }
});
//# sourceMappingURL=AJAX_envio-datos-cambio-credenciales-usuarios-repetitivo.dev.js.map
