$(document).ready(function(){
    $("form[id^='frm_registroseguimiento_reservaciones']").on('submit',(function(e){ // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        let IdReservacion = $(this).find('#txtIdReservacionSeguimiento').val(); // IDENTIFICADOR UNICO RESERVACION
        let IdentificadorUnicoReservacion = $('#txtCodigoIdentificadorUnicoSeguimiento').val(); // IDENTIFICADOR UNICO RESERVACION
        let IdFacultad = $('#txtIdFacultadSeguimiento').val(); // FACULTAD RESERVACION
        let IdEscuela = $('#txtIdEscuelaSeguimiento').val(); // ESCUELA RESERVACION
        let IdAplicacion = $('#txtIdAplicacionSeguimiento').val(); // APLICACION RESERVACION
        let IdLaboratorio = $('#txtIdLaboratorioSeguimiento').val(); // LABORATORIO RESERVACION
        let IdTipoReservacion = $('#txtIdTipoReservacionSeguimiento').val(); // TIPO RESERVACION
        let ComprobacionDivisionGrupos = $('#sltdivision_grupos').val(); // COMPROBACION DIVISION GRUPOS
        let CantidadUsuariosAsistencia = $('#txtcantidadusuarios_reservacion').val(); // CANTIDAD USUARIOS ASISTENCIA
        if(IdentificadorUnicoReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El identificador único es requerido");
            return false;
        }
        if(IdReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de reservación es requerido");
            return false;
        }
        if(IdFacultad === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la facultad es requerido");
            return false;
        }
        if(IdEscuela === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la escuela es requerido");
            return false;
        }
        if(IdAplicacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código de la aplicación es requerido");
            return false;
        }
        if(IdLaboratorio === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código del laboratorio requerido");
            return false;
        }
        if(IdTipoReservacion === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> El código del tipo de reservación es requerido");
            return false;
        }
        if(ComprobacionDivisionGrupos === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La comprobación de división de grupos es requerida. Seleccione una opción");
            return false;
        }
        if(CantidadUsuariosAsistencia === ""){
            Notificaciones_NotifyDanger("<i class='icofont icofont-marker-alt-3'></i> Campo incompleto", "<i class='icofont icofont-ui-flash-light'></i> La cantidad de usuarios que asistieron es requerida");
            return false;
        }
        else{
        e.preventDefault(e); // "e" IDENTIFICADOR DE ACCION PARA CAPTURAR EVENTO DE FORMULARIO
        jQuery.ajax({
            url: "../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-datos-registro-seguimiento-reservaciones-finalizadas",
            type: "POST",
            dataType: 'json',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            // REGISTRO DE NUEVOS USUARIOS
            success: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifySuccess("Perfecto", "El seguimiento fue registrado exitosamente.");
                    LimpiezaFormulario();
                }, 3500);
                location.reload();
            },
            error: function (resultado) {
                setTimeout(function (){
                    Notificaciones_NotifyDanger("Lo sentimos", "Hemos tenido problemas en procesar tu solicitud, por favor regresa más tarde. Sí el problema persiste, favor reportar el problema");
                    $('#envio-datosusuarios').prop('disabled', false);
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
        NombreRolUsuario = ComprobacionDivisionGrupos = $('#sltdivision_grupos').val(""); // COMPROBACION DIVISION GRUPOS
        DescripcionRolUsuario = $('#txtcantidadusuarios_reservacion').val(""); // CANTIDAD USUARIOS ASISTENCIA
    }
});
