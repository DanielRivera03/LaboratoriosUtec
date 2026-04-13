$(document).ready(function(){
    $("#frm_registro_detallesperfilusuarios").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let TelefonoUsuario = $('#txttelefono_usuarios').val(); // TELEFONO USUARIO
        let GeneroUsuario = $('#sltgenero_usuarios').val(); // GENERO USUARIO
        let FechaNacimientoUsuario = $('#txtfechanacimiento_usuarios').val(); // FECHA NACIMIENTO USUARIO
        let EstadoCivilUsuario = $('#sltestadocivil_usuarios').val(); // ESTADO CIVIL USUARIO
        if(TelefonoUsuario === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El número de teléfono es requerido");
            return false;
        }
        if(GeneroUsuario === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El género es requerido");
            return false;
        }
        if(FechaNacimientoUsuario === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La fecha de nacimiento es requerida");
            return false;
        }
        if(EstadoCivilUsuario === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El estado civil requerido");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-completar-perfil-nuevos-usuarios",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    LimpiezaFormulario();
                    NotificacionesSweetAlert("Perfecto", "Datos de perfil completados con exito", "info")
                    Notificaciones_NotifySuccess("Perfecto", "Datos de perfil completados con exito.");
                    setTimeout(function (){
                        location.reload();
                    }, 2500);
                }, 3500);

            },
            error: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
                    $('#envio-datosusuarios').show();
                    $('#envio-datosusuarios').prop('disabled', false);
                }, 3500);
            },
            // REALIZAR EJECUCION DURANTE LA EJECUCION DEL PROCESAMIENTO DATOS FORMULARIOS --> MOSTRAR PANTALLA DE ESPERA
            beforeSend: function () {
                Notificaciones_NotifyInfo("Procesando Información", "Espera un momento...");
                $('#envio-datosusuarios').hide();
                $('#envio-datosusuarios').prop('disabled', true);
            }
        });
        }
    }));

    //-> LIMPIAR VALORES FORMULARIO
    function LimpiezaFormulario(){
        NombreRolUsuario = $('#txtnombre_rolesusuarios').val(""); // NOMBRES ROL DE  USUARIO
        DescripcionRolUsuario = $('#txtdescripcion_rolesusuarios').val(""); // DESCRIPCION ROL DE USUARIO
    }
});