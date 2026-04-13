$(document).ready(function(){
    $("#frm_registro_nuevos_roles_usuarios").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let NombreReporte = $('#txtnombre_reporteplataforma').val(); // NOMBRES DE REPORTES
        let DescripcionReporte = $('#txtdescripcion_reporteplataforma').val(); // DESCRIPCION DE REPORTES
        let FotoReporte = $('#input-file-max-fs').val(); // FOTOS DE REPORTES
        if(NombreReporte === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre del reporte es requerido");
            return false;
        }
        if(DescripcionReporte === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La descripción del reporte es requerida");
            return false;
        }
        if(FotoReporte === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La captura o foto del reporte es requerida");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-problemas-plataforma",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    NotificacionesSweetAlert("Perfecto", "Nuevo reporte registrado exitosamente", "info");
                    Notificaciones_NotifySuccess("Perfecto", "Nuevo reporte registrado exitosamente.");
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
        NombreReporte = $('#txtnombre_reporteplataforma').val(""); // NOMBRES DE REPORTES
        DescripcionReporte = $('#txtdescripcion_reporteplataforma').val(""); // DESCRIPCION DE REPORTES
        FotoReporte = $('#input-file-max-fs').val(""); // FOTOS DE REPORTES
    }
});