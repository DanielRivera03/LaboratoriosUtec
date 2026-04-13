"use strict";

$(document).ready(function () {
  $("form[id^='frm_registroseguimiento_reservaciones']").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var IdReservacion = $(this).find('#txtIdReservacionSeguimiento').val(); // IDENTIFICADOR UNICO RESERVACION

    var IdentificadorUnicoReservacion = $('#txtCodigoIdentificadorUnicoSeguimiento').val(); // IDENTIFICADOR UNICO RESERVACION

    var IdFacultad = $('#txtIdFacultadSeguimiento').val(); // FACULTAD RESERVACION

    var IdEscuela = $('#txtIdEscuelaSeguimiento').val(); // ESCUELA RESERVACION

    var IdAplicacion = $('#txtIdAplicacionSeguimiento').val(); // APLICACION RESERVACION

    var IdLaboratorio = $('#txtIdLaboratorioSeguimiento').val(); // LABORATORIO RESERVACION

    var IdTipoReservacion = $('#txtIdTipoReservacionSeguimiento').val(); // TIPO RESERVACION

    var ComprobacionDivisionGrupos = $('#sltdivision_grupos').val(); // COMPROBACION DIVISION GRUPOS

    var CantidadUsuariosAsistencia = $('#txtcantidadusuarios_reservacion').val(); // CANTIDAD USUARIOS ASISTENCIA

    if (IdentificadorUnicoReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El identificador único es requerido");
      return false;
    }

    if (IdReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de reservación es requerido");
      return false;
    }

    if (IdFacultad === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la facultad es requerido");
      return false;
    }

    if (IdEscuela === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la escuela es requerido");
      return false;
    }

    if (IdAplicacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la aplicación es requerido");
      return false;
    }

    if (IdLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código del laboratorio requerido");
      return false;
    }

    if (IdTipoReservacion === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código del tipo de reservación es requerido");
      return false;
    }

    if (ComprobacionDivisionGrupos === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La comprobación de división de grupos es requerida. Seleccione una opción");
      return false;
    }

    if (CantidadUsuariosAsistencia === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La cantidad de usuarios que asistieron es requerida");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-seguimiento-reservaciones-finalizadas",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        // REGISTRO DE NUEVOS USUARIOS
        success: function success(resultado) {
          setTimeout(function () {
            Notificaciones_NotifySuccess("Perfecto", "El seguimiento fue registrado exitosamente.");
            LimpiezaFormulario();
          }, 3500);
          location.reload();
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
    NombreRolUsuario = ComprobacionDivisionGrupos = $('#sltdivision_grupos').val(""); // COMPROBACION DIVISION GRUPOS

    DescripcionRolUsuario = $('#txtcantidadusuarios_reservacion').val(""); // CANTIDAD USUARIOS ASISTENCIA
  }
});
//# sourceMappingURL=AJAX_envio-datos-registro-seguimiento-reservaciones-finalizadas.dev.js.map
