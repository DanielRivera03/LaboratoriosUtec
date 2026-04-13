$(document).ready(function(){
    $("#frm_reportepracticas_rangofechas").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let FechaInicioReservacionesPL = $('#txtInicioReservacionPL').val(); // FECHA INICIO
        let FechaFinReservacionesPL = $('#txtFinReservacionPL').val(); // HORA INICIO
        let IdLaboratorio = $('#sltidlaboratorio').val(); // ID LABORATORIO
        if(FechaInicioReservacionesPL === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la fecha de inicio");
            return false;
        }
        if(FechaFinReservacionesPL === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la fecha de fin");
            return false;
        }
        if(IdLaboratorio === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar un laboratorio");
            return false;
        }
    }));
});