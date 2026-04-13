"use strict";

$(document).ready(function () {
  $("#frm_reservaciones_primerafase").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var AplicacionReservaciones = $('#sltaplicacionreservacion').val(); // APLICACION A SELECCIONAR

    var CantidadUsuariosReservaciones = $('#txtcantidadusuariosreservacion').val(); // CANTIDAD DE USUARIOS

    if (AplicacionReservaciones === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar una aplicación");
      return false;
    }

    if (CantidadUsuariosReservaciones === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la cantidad de usuarios a asistir");
      return false;
    }
  });
});
//# sourceMappingURL=ValidacionReservacionPrimeraFase.dev.js.map
