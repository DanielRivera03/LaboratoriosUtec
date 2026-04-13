$(document).ready(function(){
    $("#frm_reservaciones_primerafase").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let AplicacionReservaciones = $('#sltaplicacionreservacion').val(); // APLICACION A SELECCIONAR
        let CantidadUsuariosReservaciones = $('#txtcantidadusuariosreservacion').val(); // CANTIDAD DE USUARIOS
        if(AplicacionReservaciones === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe seleccionar una aplicación");
            return false;
        }
        if(CantidadUsuariosReservaciones === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe ingresar la cantidad de usuarios a asistir");
            return false;
        }
    }));
    // VALIDAR QUE AL MENOS UN DIA SEA SELECCIONADO
    const formulario = document.querySelector('form');
    const botonEnvio = document.querySelector('button[type="submit"]');

    botonEnvio.addEventListener('click', function(evento) {
        const checkboxes = document.querySelectorAll('.días');
        const seleccionado = Array.from(checkboxes).some(function(checkbox) {
            return checkbox.checked;
        });
        if (!seleccionado) {
            evento.preventDefault();
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Por favor seleccione los días que impartirá su reservación");
        }
    });
});