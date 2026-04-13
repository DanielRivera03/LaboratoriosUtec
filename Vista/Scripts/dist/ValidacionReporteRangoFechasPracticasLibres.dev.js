"use strict";

$(document).ready(function () {
  $("#frm_reportepracticas_rangofechas").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var FechaInicioReservacionesPL = $('#txtInicioReservacionPL').val(); // FECHA INICIO

    var FechaFinReservacionesPL = $('#txtFinReservacionPL').val(); // HORA INICIO

    if (FechaInicioReservacionesPL === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la fecha de inicio");
      return false;
    }

    if (FechaFinReservacionesPL === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la fecha de fin");
      return false;
    }
  });
});
//# sourceMappingURL=ValidacionReporteRangoFechasPracticasLibres.dev.js.map
