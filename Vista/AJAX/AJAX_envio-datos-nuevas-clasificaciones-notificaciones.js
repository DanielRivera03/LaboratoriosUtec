$(document).ready(function(){
    $("#frm_registro_clasificaciones_notificaciones").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let CodigoClasificacionNotificacion = $('#txtcodigo_clasificacion_notificaciones').val(); // CODIGO CLASIFICACION NOTIFICACION
        let DescripcionClasificacionNotificacion = $('#txtdescripcion_clasificacion_notificaciones').val(); // DESCRIPCION CLASIFICACION NOTIFICACION
        if(CodigoClasificacionNotificacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código único es requerido");
            return false;
        }
        if(DescripcionClasificacionNotificacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La descripción es requerida");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-nuevas-clasificaciones-notificaciones",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    NotificacionesSweetAlert("Perfecto", "Nueva clasificación dada de alta", "info");
                    Notificaciones_NotifySuccess("Perfecto", "Nueva clasificación registrada con éxito.");
                    $('#envio-datosusuarios').prop('disabled', false);
                    $('#envio-datosusuarios').show();
                    LimpiezaFormulario();
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

    //-> LIMPIAR VALORES FORMULARIO
    function LimpiezaFormulario(){
        CodigoClasificacionNotificacion = $('#txtcodigo_clasificacion_notificaciones').val([]); // CODIGO CLASIFICACION NOTIFICACION
        DescripcionClasificacionNotificacion = $('#txtdescripcion_clasificacion_notificaciones').val([]); // DESCRIPCION CLASIFICACION NOTIFICACION
    }
});