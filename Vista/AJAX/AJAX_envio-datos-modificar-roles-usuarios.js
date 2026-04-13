$(document).ready(function(){
    $("#frm_registro_modificar_roles_usuarios").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let IdRolUsuario = $('#txtidrolusuario').val(); // ID ROL DE USUARIO
        let NombreRolUsuario = $('#txtnombre_rolesusuarios').val(); // NOMBRES ROL DE  USUARIO
        let DescripcionRolUsuario = $('#txtdescripcion_rolesusuarios').val(); // DESCRIPCION ROL DE USUARIO
        if(IdRolUsuario === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El id del rol de usuario es requerido");
            return false;
        }
        if(NombreRolUsuario === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El nombre del rol de usuario es requerido");
            return false;
        }
        if(DescripcionRolUsuario === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La descripción del rol de usuario es requerida");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-modificar-roles-usuarios",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    NotificacionesSweetAlert("Perfecto", "Registro actualizado con éxito", "info");
                    Notificaciones_NotifySuccess("Perfecto", "Datos del rol modificado con éxito.");
                    $('#envio-datosusuarios').show();
                    $('#envio-datosusuarios').prop('disabled', false);
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