$(document).ready(function(){
    $("#frm_registro_nuevos_usuarios").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let NombresUsuarios = $('#txtnombres_usuarios').val(); // NOMBRES DE USUARIO
        let ApellidosUsuarios = $('#txtapellidos_usuarios').val(); // APELLIDOS DE USUARIO
        let CodigoUnicoUsuarios = $('#txtcodigo_usuarios').val(); // CODIGO UNICO DE USUARIO
        let CorreoUsuarios = $('#txtcorreo_usuarios').val(); // CORREO DE USUARIO
        let RolUsuarios = $('#sltroles_usuarios').val(); // ROL DE USUARIO
        if(NombresUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Los nombres del usuario son requeridos");
            return false;
        }
        if(ApellidosUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Los apellidos del usuario son requeridos");
            return false;
        }
        if(CodigoUnicoUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código único del usuario es requerido");
            return false;
        }
        if(CorreoUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El correo del usuario es requerido");
            return false;
        }
        if($("#txtcorreo_usuarios").val().indexOf('@', 0) == -1 || $("#txtcorreo_usuarios").val().indexOf('.', 0) == -1) {
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo inválido", "<i class='icofont icofont-ui-flash-light'></i> Por favor ingrese un correo válido");
            return false;
        }
        if(RolUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Seleccione un rol de usuario");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-nuevos-usuarios",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    NotificacionesSweetAlert("Perfecto", "Nuevo usuario dado de alta", "info");
                    Notificaciones_NotifySuccess("Perfecto", "Nuevo usuario dado de alta exitosamente.");
                    LimpiezaFormulario();
                    $('#envio-datosusuarios').prop('disabled', false);
                    $('#envio-datosusuarios').show();
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
                Notificaciones_NotifyInfoExtensible("Procesando Información", "Espera un momento...");
                $('#envio-datosusuarios').prop('disabled', true);
                $('#envio-datosusuarios').hide();
            }
        });
        }
    }));

    //-> LIMPIAR VALORES FORMULARIO
    function LimpiezaFormulario(){
         NombresUsuarios = $('#txtnombres_usuarios').val(""); // NOMBRES DE USUARIO
         ApellidosUsuarios = $('#txtapellidos_usuarios').val(""); // APELLIDOS DE USUARIO
         CodigoUnicoUsuarios = $('#txtcodigo_usuarios').val(""); // CODIGO UNICO DE USUARIO
         CorreoUsuarios = $('#txtcorreo_usuarios').val(""); // CORREO DE USUARIO
         RolUsuarios = $('#sltroles_usuarios').val(""); // ROL DE USUARIO
         // UBICACIONES DE LABORATORIO, EXTENSIONES DE USUARIOS Y LABORATORIOS ASIGNADOS
         $('#inline-1-lab').val(""); $('#inline-3-lab').val(""); $('#inline-5-lab').val(""); $('#inline-7-lab').val(""); $('#inline-9-lab').val("");
         $('#inline-2-lab').val(""); $('#inline-4-lab').val(""); $('#inline-6-lab').val(""); $('#inline-8-lab').val(""); $('#inline-10-lab').val("");
         $('#inline-11-lab').val(""); $('#inline-13-lab').val(""); $('#inline-15-lab').val("");
         $('#inline-12-lab').val(""); $('#inline-14-lab').val(""); $('#txtextensiones_usuarios').val("");
         $("#inline-1").prop("checked", false); $("#inline-2").prop("checked", false); $("#inline-3").prop("checked", false);
         $("#inline-4").prop("checked", false); $("#inline-5").prop("checked", false); $("#inline-6").prop("checked", false);
         $("#inline-7").prop("checked", false); $("#inline-8").prop("checked", false); $("#inline-9").prop("checked", false);
         $("#inline-10").prop("checked", false); $("#inline-11").prop("checked", false); $("#inline-12").prop("checked", false);
         $("#inline-13").prop("checked", false); $("#inline-14").prop("checked", false); $("#inline-15").prop("checked", false);

    }
});