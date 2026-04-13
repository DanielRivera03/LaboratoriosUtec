"use strict";

$(document).ready(function () {
  $("#frm_modificar_usuarios").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var NombresUsuarios = $('#txtnombres_usuarios').val(); // NOMBRES DE USUARIO

    var ApellidosUsuarios = $('#txtapellidos_usuarios').val(); // APELLIDOS DE USUARIO

    var CodigoUnicoUsuarios = $('#txtcodigo_usuarios').val(); // CODIGO UNICO DE USUARIO

    var CorreoUsuarios = $('#txtcorreo_usuarios').val(); // CORREO DE USUARIO

    var RolUsuarios = $('#sltroles_usuarios').val(); // ROL DE USUARIO

    var LaboratorioAsignadoUsuarios = $('#sltlaboratorio_usuarios').val(); // LABORATORIO ASIGNADO

    if (NombresUsuarios === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Los nombres del usuario son requeridos");
      return false;
    }

    if (ApellidosUsuarios === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Los apellidos del usuario son requeridos");
      return false;
    }

    if (CodigoUnicoUsuarios === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código único del usuario es requerido");
      return false;
    }

    if (CorreoUsuarios === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El correo del usuario es requerido");
      return false;
    }

    if ($("#txtcorreo_usuarios").val().indexOf('@', 0) == -1 || $("#txtcorreo_usuarios").val().indexOf('.', 0) == -1) {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo inválido", "<i class='icofont icofont-ui-flash-light'></i> Por favor ingrese un correo válido");
      return false;
    }

    if (RolUsuarios === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Seleccione un rol de usuario");
      return false;
    }

    if (LaboratorioAsignadoUsuarios === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Seleccione un laboratorio asignado");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-modificar-usuarios",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        // MODIFICAR
        success: function success(resultado) {
          setTimeout(function () {
            NotificacionesSweetAlert("Perfecto", "Registro actualizado con éxito", "info");
            Notificaciones_NotifySuccess("Perfecto", "Datos del usuario modificados con éxito.");
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
//# sourceMappingURL=AJAX_envio-datos-modificar-usuarios.dev.js.map
