$(document).ready(function(){
    $("#frm_registro_nuevas_aplicaciones").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let CodigoAplicacion = $('#txtcodigoaplicaciones_laboratorio').val(); // CODIGO DE APLICACIONES
        let NombreAplicacion = $('#txtnombreaplicaciones_laboratorio').val(); // NOMBRE DE APLICACIONES
        let IdClasificacionAplicacion = $('#slclasificacionaplicaciones_laboratorio').val(); // TIPO DE APLICACION CLASIFICACION
        if(CodigoAplicacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la aplicación es requerido");
            return false;
        }
        if(NombreAplicacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre de la aplicación es requerido");
            return false;
        }
        if(IdClasificacionAplicacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La Clasificación de la aplicación es requerida");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-aplicaciones-laboratorio",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifySuccess("Perfecto", "Nueva aplicación dada de alta exitosamente.");
                    $('#envio-datosusuarios').prop('disabled', false);
                }, 3500);
                LimpiezaFormulario();

            },
            error: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
                }, 3500);
            },
            // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
            beforeSend: function () {
                Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
                $('#envio-datosusuarios').prop('disabled', true);
            }
        });
        }
    }));

    //-> LIMPIAR VALORES FORMULARIO
    function LimpiezaFormulario(){
        CodigoAplicacion = $('#txtcodigoaplicaciones_laboratorio').val(""); // CODIGO DE APLICACIONES
        NombreAplicacion = $('#txtnombreaplicaciones_laboratorio').val(""); // NOMBRE DE APLICACIONES
        IdClasificacionAplicacion = $('#slclasificacionaplicaciones_laboratorio').val(""); // TIPO DE APLICACION CLASIFICACION
        //-> CHECKBOX LABORATORIOS
        $('#inline-1').prop('checked', false);
        $('#inline-2').prop('checked', false);
        $('#inline-3').prop('checked', false);
        $('#inline-4').prop('checked', false);
        $('#inline-5').prop('checked', false);
        $('#inline-6').prop('checked', false);
        $('#inline-7').prop('checked', false);
        $('#inline-8').prop('checked', false);
        $('#inline-9').prop('checked', false);
        $('#inline-10').prop('checked', false);
        $('#inline-11').prop('checked', false);
        $('#inline-12').prop('checked', false);
        $('#inline-13').prop('checked', false);
        $('#inline-14').prop('checked', false);
        $('#inline-15').prop('checked', false);
    }
});