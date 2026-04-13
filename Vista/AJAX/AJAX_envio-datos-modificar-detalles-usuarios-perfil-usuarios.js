$(document).ready(function(){
    $("#frm_modificar_detallesusuarios_perfilusuarios").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let TelefonoPrincipal = $('#txttelefonoprincipal_usuarios').val(); // TELEFONO PRINCIPAL
        let TelefonoTrabajo = $('#txttelefonotrabajo_usuarios').val(); // TELEFONO TRABAJO
        let GeneroUsuarios = $('#sltgenero_usuarios').val(); // GENERO USUARIOS
        let FechaNacimiento = $('#txtfechanacimiento_usuarios').val(); // FECHA DE NACIMIENTO
        let EstadoCivil = $('#sltestadocivil_usuarios').val(); // ESTADO CIVIL
        if(TelefonoPrincipal === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El teléfono principal es requerido");
            return false;
        }
        if(TelefonoTrabajo === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El teléfono de trabajo es requerido");
            return false;
        }
        if(GeneroUsuarios === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El género del usuario es requerido");
            return false;
        }
        if(FechaNacimiento === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La fecha de nacimiento del usuario es requerido");
            return false;
        }
        if(EstadoCivil === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El estado civil del usuario es requerido");
            return false;
        }       
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-actualizacion-detalles-usuarios-perfil-usuarios",
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