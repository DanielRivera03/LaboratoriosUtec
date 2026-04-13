$(document).ready(function(){
    $("#frm_actualizacioninicial_reservaciones").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let CodigoUnicoReservacion = $('#txtCodigoIdentificadorUnico').val(); // CODIGO UNICO RESERVACIONES
        let EstadoReservacion = $('#sltestadoinicial_reservaciones').val(); // ESTADO DE RESERVACIONES
        let ComentarioInicialReservacion = $('#txtcomentarioinicial_reservaciones').val(); // COMENTARIO INICIAL RETROALIMENTACION RESERVACIONES
        if(CodigoUnicoReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código único de reservación es requerido");
            return false;
        }
        if(EstadoReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Por favor seleccione un estado de reservación, es requerido");
            return false;
        }
        if(ComentarioInicialReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El comentario de retroalimentación inicial es requerido");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-actualizacion-inicial-reservaciones-laboratorios",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    NotificacionesSweetAlert("Perfecto", "La solicitud ha sido procesada con éxito", "info");
                    Notificaciones_NotifySuccess("Perfecto", "La solicitud ha sido procesada con éxito.");
                    setTimeout(function (){
                        location.href = "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-reservaciones-actualizacion-inicial";
                    }, 2500);
                }, 3500);

            },
            error: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
                    $('#envio-datosusuarios').prop('disabled', false);
                    $('#envio-datosusuarios').show();
                }, 3500);
            },
            // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
            beforeSend: function () {
                Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
                $('#envio-datosusuarios').prop('disabled', true);
                $('#envio-datosusuarios').hide();
            }
        });
        }
    }));
});