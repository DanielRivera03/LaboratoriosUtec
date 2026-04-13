"use strict";

$(document).ready(function () {
  $("#frm_reservaciones_segundafase").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var AplicacionReservacion = $('#txtAplicacionReservacion').val(); // APLICACION SELECCIONADA

    var FechaInicioReservacion = $('#txtFechaInicioReservacion').val(); // FECHA INICIO 

    var FechaFinReservacion = $('#txtFechaFinReservacion').val(); // FECHA FINALIZACION

    var HoraInicioReservacion = $('#txtHoraInicioReservacion').val(); // HORA INICIO

    var HoraFinReservacion = $('#txtHoraFinReservacion').val(); // HORA FINALIZACION

    var CantidadPersonasReservacion = $('#txtNumeroUsuariosReservacion').val(); // CANTIDAD PERSONAS ASISTIR

    var VerificarTipoReservacionInicial = $('#txtVerificacionTipoReservacionInicial').val(); // VERIFICAR TIPO DE RESERVACION INICIAL

    var SeleccionLaboratorioReservacion = $('#sltlaboratorio_reservacion').val(); // SELECCIONAR LABORATORIO OFERTA SUGERIDA

    var SeleccionTipoReservacion = $('#slttipo_reservacion').val(); // SELECCIONAR TIPO DE RESERVACION

    var SeleccionFacultadReservacion = $('#sltfacultad_reservacion').val(); // SELECCIONAR FACULTAD

    var SeleccionEscuelaReservacion = $('#sltescuela_reservacion').val(); // SELECCIONAR ESCUELA

    var CodigoReservacion = $('#txtCodigoReservacion').val(); // CODIGO RESERVACION

    var NombreReservacion = $('#txtNombreReservacion').val(); // NOMBRE RESERVACION

    var SeccionReservacion = $('#txtSeccionReservacion').val(); // SECCION RESERVACION

    var TitularReservacion = $('#slttitular_reservacion').val(); // VERIFICAR SI ES TITULAR DE RESERVACION

    if (AplicacionReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La aplicación es requerida");
      return false;
    }

    if (FechaInicioReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La fecha de inicio es requerida");
      return false;
    }

    if (FechaFinReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La fecha de finalización es requerida");
      return false;
    }

    if (HoraInicioReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La hora de inicio es requerida");
      return false;
    }

    if (HoraFinReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La hora de finalización es requerida");
      return false;
    }

    if (CantidadPersonasReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La cantidad de personas a asistir es requerida");
      return false;
    }

    if (VerificarTipoReservacionInicial === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La verificación inicial del tipo de reservación es requerida");
      return false;
    }

    if (SeleccionLaboratorioReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> De la oferta sugerida, seleccione un laboratorio");
      return false;
    }

    if (SeleccionTipoReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar un tipo de reservación");
      return false;
    }

    if (SeleccionFacultadReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar una facultad a la que pertenece");
      return false;
    }

    if (SeleccionEscuelaReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar una escuela a la que pertenece");
      return false;
    }

    if (CodigoReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar el código de su reservación (asignatura, seminario, etc)");
      return false;
    }

    if (NombreReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar el nombre de su reservación (asignatura, seminario, etc)");
      return false;
    }

    if (SeccionReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la sección de su reservación (asignatura, seminario, etc)");
      return false;
    }

    if (TitularReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar si usted es títular de la reservación o no");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-nuevas-reservaciones-laboratorios",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function success(resultado) {
          if (resultado === "OK") {
            setTimeout(function () {
              NotificacionesSweetAlert("Perfecto", "Nueva reservación dada de alta", "info");
              Notificaciones_NotifySuccess("Perfecto", "Su reservación se ha registrado exitosamente. Por favor mantenerse pendiente de los medios de comunicación correspondientes");
              setTimeout(function () {
                location.href = "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-nuevas-reservaciones";
              }, 2500);
            }, 3500);
          } else {
            Notificaciones_NotifyDanger("Lo Sentimos", resultado);
          }
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
          NotificacionesSweetAlert("Espere", "Procesando Información...", "info");
          $('#envio-datosusuarios').prop('disabled', true);
          $('#envio-datosusuarios').hide();
        }
      });
    }
  });
});
//# sourceMappingURL=AJAX_envio-datos-registro-nuevas-reservaciones-laboratorios.dev.js.map
