"use strict";

$(document).ready(function () {
  $("#frm_reservacionespracticaslibres_segundafase").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var AplicacionReservacion = $('#txtAplicacionReservacionPL').val(); // APLICACION SELECCIONADA

    var FechaInicioReservacion = $('#txtFechaInicioReservacionPL').val(); // FECHA INICIO 

    var HoraInicioReservacion = $('#txtHoraInicioReservacionPL').val(); // HORA INICIO

    var SeleccionLaboratorioReservacion = $('#sltlaboratorio_reservacionPL').val(); // SELECCIONAR LABORATORIO OFERTA SUGERIDA

    var SeleccionFacultadReservacion = $('#sltfacultad_reservacionPL').val(); // SELECCIONAR FACULTAD

    var NombreUsuario = $('#txtNombreUsuarioReservacionPL').val(); // NOMBRE USUARIO

    var CarneUsuario = $('#txtCarneUsuarioReservacionPL').val(); // CARNE USUARIO

    if (AplicacionReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La aplicación es requerida");
      return false;
    }

    if (FechaInicioReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La fecha de inicio es requerida");
      return false;
    }

    if (HoraInicioReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La hora de inicio es requerida");
      return false;
    }

    if (SeleccionLaboratorioReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> De la oferta sugerida, seleccione un laboratorio");
      return false;
    }

    if (SeleccionFacultadReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar una facultad a la que pertenece");
      return false;
    }

    if (NombreUsuario === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar el nombre completo del usuario");
      return false;
    }

    if (CarneUsuario === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar el carné del usuario");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-nuevas-practicas-libres",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function success(resultado) {
          setTimeout(function () {
            $('#envio-datosusuarios').prop('disabled', false);
            $('#envio-datosusuarios').show();
            NotificacionesSweetAlert("Perfecto", "Nueva práctica libre dada de alta", "info");
            Notificaciones_NotifySuccess("Perfecto", "Su práctica libre se ha registrado exitosamente");
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
//# sourceMappingURL=AJAX_envio-datos-nuevas-practicas-libres-laboratorios.dev.js.map
