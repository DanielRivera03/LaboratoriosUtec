$(document).ready(function(){
    $("#frm_modificar_configuracion_perfilusuarios").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let NombresUsuarios = $('#txtnombres_usuarios').val(); // NOMBRES DE USUARIO
        let ApellidosUsuarios = $('#txtapellidos_usuarios').val(); // APELLIDOS DE USUARIO
        let CodigoUnicoUsuarios = $('#txtcodigo_usuarios').val(); // CODIGO UNICO DE USUARIO
        let CorreoUsuarios = $('#txtcorreo_usuarios').val(); // CORREO DE USUARIO
        let ContraseniaUsuarios = $('#txtcontrasenia_usuarios').val(); // CONTRASENIA DE USUARIO 
        let ValidarContraseniaUsuarios = $('#txtrepetircontrasenia_usuarios').val(); // VERIFICAR CONTRASENIA
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
        if(ContraseniaUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Ingrese su nueva contraseña");
            return false;
        }
        if(ValidarContraseniaUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> Debe repetir su nueva contraseña");
            return false;
        }
        if(ValidarContraseniaUsuarios != ContraseniaUsuarios){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo inválido", "<i class='icofont icofont-ui-flash-light'></i> Las contraseñas ingresadas no coinciden");
            return false;
        }       
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-actualizacion-datos-configuracion-perfil-usuarios",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifySuccess("Perfecto", "Los datos se han actualizado con éxito.");
                    setTimeout(function (){
                        location.reload();
                    }, 2500);
                }, 3500);

            },
            error: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
                }, 3500);
            },
            // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
            beforeSend: function () {
                Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
            }
        });
        }
    }));
});