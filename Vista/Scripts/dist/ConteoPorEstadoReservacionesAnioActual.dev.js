"use strict";

jQuery.ajax({
  url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=conteo-por-estados-reportes-plataforma',
  type: "GET",
  dataType: "json",
  contentType: "application/json; charset=utf-8",
  success: function success(data) {
    $("#pendientes").html(data.resultado[0].ReportesPendientes);
    $("#enproceso").text(data.resultado[0].ReportesEnProceso);
    $("#resueltos").text(data.resultado[0].ReportesResueltos);
    $("#cerrados").text(data.resultado[0].ReportesCerrados);
  }
});
//# sourceMappingURL=ConteoPorEstadoReservacionesAnioActual.dev.js.map
