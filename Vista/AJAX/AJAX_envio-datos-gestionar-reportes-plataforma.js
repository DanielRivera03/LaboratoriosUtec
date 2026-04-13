$(document).ready(function(){
    $("#frm_gestionar_reportes_plataforma").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let IdReporte = $('#txtid_reporteplataforma').val(); // ID REPORTE
        let EstadoReporte = $('#txtnombre_rolesusuarios').val(); // ESTADO REPORTE
        let ComentarioActualizacionReporte = $('#txtdescripcionactualizacion_reporteplataforma').val(); // DESCRIPCION ACTUALIZACION REPORTE
        if(IdReporte === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El id del reporte es requerido");
            return false;
        }
        if(EstadoReporte === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El estado del reporte es requerido");
            return false;
        }
        if(ComentarioActualizacionReporte === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El comentario de actualización es requerido");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-gestionar-problemas-plataforma",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function (resultado) {
                setTimeout(function (){
                    NotificacionesSweetAlert("Perfecto", "Registro actualizado con éxito", "info");
                    Notificaciones_NotifySuccess("Perfecto", "Este reporte se ha actualizado con éxito.");
                    setTimeout(function (){
                        location.reload();
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