"use strict";

jQuery.ajax({
  url: '../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=conteo-inicial-coordinador-laboratorios',
  type: "POST",
  dataType: "json",
  contentType: "application/json; charset=utf-8",
  success: function success(data) {
    $("#totaladminlaboratorios").html(data.resultado[0].CantidadAdministradoresLaboratorios);
    $("#totaldocentes").text(data.resultado[0].CantidadDocentes);
    $("#totalaplicaciones").text(data.resultado[0].CantidadAplicaciones);
    $("#totallabsinactivos").text(data.resultado[0].CantidadLaboratoriosInactivos);
  }
});
//# sourceMappingURL=ConteoInicialInicioCoordinadoresLaboratorios.dev.js.map
