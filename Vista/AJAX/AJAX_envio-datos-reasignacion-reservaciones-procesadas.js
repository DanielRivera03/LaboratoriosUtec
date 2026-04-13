$(document).ready(function(){
    $("#frm_reservaciones_reasignacion").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let LaboratorioSeleccion = $('#sltlaboratorio_reservacion').val(); // SECCION RESERVACION
        let IdReservacion = $('#txtIdReservacion').val(); // ID RESERVACION
        let CodigoUnicoReservacion = $('#txtCodigoUnicoReservacion').val(); // CODIGO UNICO RESERVACION
        if(IdReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El id de la reservación es requerido");
            return false;
        }
        if(CodigoUnicoReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código único de la reservación es requerido");
            return false;
        }
        if(LaboratorioSeleccion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Por favor seleccione un laboratorio");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-reasignacion-reservaciones-laboratorios",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function (resultado) {
                if(resultado === "OK"){
                    setTimeout(function (){
                        Notificaciones_NotifySuccess("Perfecto", "Esta reservación ha sido reasignada exitosamente");
                        NotificacionesSweetAlert("Perfecto", "Reservación reasignada exitosamente", "info");
                        $('#envio-datosusuarios').prop('disabled', false);
                        $('#envio-datosusuarios').show();
                        setTimeout(function (){
                            location.href = "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-reasignacion-reservaciones";
                        }, 2500);
                    }, 3500);
                }else{
                    Notificaciones_NotifyDanger("Lo Sentimos", resultado);
                }
            },
            error: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
                    $$('#envio-datosusuarios').prop('disabled', false);
                    $('#envio-datosusuarios').show();
                }, 3500);
            },
            // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
            beforeSend: function () {
                Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
                NotificacionesSweetAlert("Espere", "Procesando Información...", "info");
                $('#envio-datosusuarios').prop('disabled', true);
                $('#envio-datosusuarios').hide();
            }
        });
        }
    }));
});