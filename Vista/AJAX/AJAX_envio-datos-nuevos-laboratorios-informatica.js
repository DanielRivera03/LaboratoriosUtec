$(document).ready(function(){
    $("#frm_registro_nuevos_laboratorios_informatica").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let CodigoLaboratorio = $('#txtcodigo_laboratorio').val(); // CODIGO LABORATORIO
        let NombreLaboratorio = $('#txtnombre_laboratorio').val(); // NOMBRE LABORATORIO
        let CapacidadLaboratorio = $('#txtcapacidad_laboratorio').val(); // CAPACIDAD LABORATORIO
        let CodigoColorLaboratorio = $('#txtcodigocolor_laboratorio').val(); // CAPACIDAD LABORATORIO
        if(CodigoLaboratorio === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código único del laboratorio es requerido");
            return false;
        }
        if(NombreLaboratorio === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre del laboratorio es requerido");
            return false;
        }
        if(CapacidadLaboratorio === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La capacidad máxima del laboratorio es requerido");
            return false;
        }
        if(CodigoColorLaboratorio === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de color del laboratorio es requerido");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-nuevos-laboratorios-informatica",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    NotificacionesSweetAlert("Perfecto", "Nuevo laboratorio dado de alta", "info");
                    $('#envio-datosusuarios').prop('disabled', false);
                    $('#envio-datosusuarios').show();
                    Notificaciones_NotifySuccess("Perfecto", "Nuevo laboratorio de informática dado de alta exitosamente.");
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
        CodigoLaboratorio = $('#txtcodigo_laboratorio').val(""); // CODIGO LABORATORIO
        NombreLaboratorio = $('#txtnombre_laboratorio').val(""); // NOMBRE LABORATORIO
        CapacidadLaboratorio = $('#txtcapacidad_laboratorio').val(""); // CAPACIDAD LABORATORIO
    }
});