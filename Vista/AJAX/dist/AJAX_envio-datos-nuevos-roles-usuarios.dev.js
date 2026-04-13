"use strict";

$(document).ready(function () {
  $("#frm_registro_nuevos_roles_usuarios").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var NombreRolUsuario = $('#txtnombre_rolesusuarios').val(); // NOMBRES ROL DE  USUARIO

    var DescripcionRolUsuario = $('#txtdescripcion_rolesusuarios').val(); // DESCRIPCION ROL DE USUARIO

    if (NombreRolUsuario === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre del rol de usuario es requerido");
      return false;
    }

    if (DescripcionRolUsuario === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La descripción del rol de usuario es requerida");
      return false;
    } else {
      e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO

      jQuery.ajax({
        url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-nuevos-roles-usuarios",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        // REGISTRO DE NUEVOS USUARIOS
        success: function success(resultado) {
          setTimeout(function () {
            LimpiezaFormulario();
            NotificacionesSweetAlert("Perfecto", "Nuevo rol de usuario dado de alta", "info");
            Notificaciones_NotifySuccess("Perfecto", "Nuevo rol de usuario dado de alta exitosamente.");
            $('#envio-datosusuarios').show();
            $('#envio-datosusuarios').prop('disabled', false);
          }, 3500);
        },
        error: function error(resultado) {
          setTimeout(function () {
            Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
            $('#envio-datosusuarios').show();
            $('#envio-datosusuarios').prop('disabled', false);
          }, 3500);
        },
        // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
        beforeSend: function beforeSend() {
          Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
          $('#envio-datosusuarios').hide();
          $('#envio-datosusuarios').prop('disabled', true);
        }
      });
    }
  }); //-> LIMPIAR VALORES FORMULARIO

  function LimpiezaFormulario() {
    NombreRolUsuario = $('#txtnombre_rolesusuarios').val(""); // NOMBRES ROL DE  USUARIO

    DescripcionRolUsuario = $('#txtdescripcion_rolesusuarios').val(""); // DESCRIPCION ROL DE USUARIO
  }
});
//# sourceMappingURL=AJAX_envio-datos-nuevos-roles-usuarios.dev.js.map
