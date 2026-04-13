"use strict";

$(document).ready(function () {
  $("#frm_reservacionespracticaslibres_primerafase").on('submit', function (e) {
    // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
    var AplicacionReservacionesPL = $('#sltaplicacionreservacionPL').val(); // APLICACION A SELECCIONAR
    //let CantidadUsuariosReservacionesPL = $('#txtcantidadusuariosreservacionPL').val(); // CANTIDAD DE USUARIOS

    var FechaInicioReservacionesPL = $('#txtInicioReservacionPL').val(); // FECHA INICIO

    var HoraInicioReservacionesPL = $('#txtHoraInicioPL').val(); // HORA INICIO

    if (AplicacionReservacionesPL === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar una aplicación");
      return false;
    }
    /*if(CantidadUsuariosReservacionesPL === ""){
        Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la cantidad de usuarios a asistir");
        return false;
    }*/


    if (FechaInicioReservacionesPL === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la fecha de inicio");
      return false;
    }

    if (HoraInicioReservacionesPL === "") {
      Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar hora de inicio");
      return false;
    }
  });
});
//# sourceMappingURL=ValidacionReservacionPracticasLibres.dev.js.map
