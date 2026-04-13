"use strict";

$(document).ready(function () {
  $("#frm_gestionar_datos_laboratorios_informatica").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var IdLaboratorio = $('#txtid_laboratorio').val(); // ID DE LABORATORIO

    var CodigoLaboratorio = $('#txtcodigo_laboratorio').val(); // CODIGO DE LABORATORIO

    var NombreLaboratorio = $('#txtnombre_laboratorio').val(); // NOMBRE DE LABORATORIO

    var CapacidadMaximaLaboratorio = $('#txtcapacidad_laboratorio').val(); // CAPACIDAD MAXIMA DE LABORATORIO

    var EquiposFueraUsoLaboratorio = $('#txtequiposfuerauso_laboratorio').val(); // EQUIPOS FUERA DE USO DE LABORATORIO

    var EstadoLaboratorio = $('#sltestado_laboratorio').val(); // ESTADO DE LABORATORIO

    var CodigoColorLaboratorio = $('#txtcodigocolor_laboratorio').val(); // CAPACIDAD LABORATORIO

    if (IdLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El id del laboratorio es requerido");
      return false;
    }

    if (CodigoLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código del laboratorio es requerido");
      return false;
    }

    if (NombreLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre del laboratorio es requerido");
      return false;
    }

    if (CapacidadMaximaLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La capacidad máxima del laboratorio es requerida");
      return false;
    }

    if (EquiposFueraUsoLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Los equipos fuera de uso del laboratorio es requerido");
      return false;
    }

    if (EstadoLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El estado del laboratorio es requerido");
      return false;
    }

    if (CodigoColorLaboratorio === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de color del laboratorio es requerido");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-gestionar-laboratorios-informatica",
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
            NotificacionesSweetAlert("Perfecto", "Registro actualizado con éxito", "info");
            Notificaciones_NotifySuccess("Perfecto", "Datos del laboratorio actualizados con éxito.");
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
//# sourceMappingURL=AJAX_envio-datos-gestionar-laboratorios-informatica.dev.js.map
