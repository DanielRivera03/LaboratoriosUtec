<?php 

     /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/

    // py0DXg430


    class GestionesLaboratorios{
        // VARIABLES GLOBALES DE CLASE -> TODAS LAS GESTIONES DEL SISTEMA
        //-> USUARIOS Y ROLES DE USUARIOS
        private $IdUsuarios;
        private $IdRolUsuarios;
        private $NombreRolUsuarios;
        private $NombresUsuarios;
        private $ApellidosUsuarios;
        private $CodigoUnicoUsuarios;
        private $CorreoUsuarios;
        private $FotoPerfilUsuarios;
        private $EstadoNuevoUsuario;
        private $EstadoCompletoPerfil;
        private $LaboratorioAsignadoLab1;
        private $LaboratorioAsignadoLab2;
        private $LaboratorioAsignadoLab3;
        private $LaboratorioAsignadoLab4;
        private $LaboratorioAsignadoLab5;
        private $LaboratorioAsignadoLab6;
        private $LaboratorioAsignadoLab7;
        private $LaboratorioAsignadoLab8;
        private $LaboratorioAsignadoLab9;
        private $LaboratorioAsignadoLab10;
        private $LaboratorioAsignadoLab11;
        private $LaboratorioAsignadoLab12;
        private $LaboratorioAsignadoLab13;
        private $LaboratorioAsignadoLab14;
        private $LaboratorioAsignadoLab15;
        private $FechaRegistro;
        private $EstadoUsuario;
        private $UbicacionLaboratorio1;
        private $UbicacionLaboratorio2;
        private $UbicacionLaboratorio3;
        private $UbicacionLaboratorio4;
        private $UbicacionLaboratorio5;
        private $UbicacionLaboratorio6;
        private $UbicacionLaboratorio7;
        private $UbicacionLaboratorio8;
        private $UbicacionLaboratorio9;
        private $UbicacionLaboratorio10;
        private $UbicacionLaboratorio11;
        private $UbicacionLaboratorio12;
        private $UbicacionLaboratorio13;
        private $UbicacionLaboratorio14;
        private $UbicacionLaboratorio15;
        private $ExtensionesUsuarios;
        //-> DETALLES DE USUARIOS
        private $UltimoCambio_Contrasenia;
        private $TelefonoPrincipal;
        private $GeneroUsuarios;
        private $FechaNacimiento;
        private $EstadoCivil;
        //-> ROLES DE USUARIOS
        private $IdRolUsuario;
        private $NombreRolUsuario;
        private $DescripcionRolUsuario;
        //-> CLASIFICACIONES NOTIFICACIONES
        private $IdClasificacionNotificaciones;
        private $CodigoClasificacionNotificaciones;
        private $DescripcionClasificacionNotificaciones;
        //-> MENSAJERIA
        private $IdMensajeria;
        private $IdUsuarioDestinatario;
        private $NombreMensaje;
        private $AsuntoMensaje;
        private $DetalleMensaje;
        private $FechaMensaje;
        private $EstadoMensajeLeido;
        private $ArchivoAdjunto;
        private $EstadoOcultarMensaje;
        //-> MANIFIESTOS PLATAFORMA [REPORTE PROBLEMAS]
        private $IdManifiesto;
        private $NombreManifiesto;
        private $DescripcionManifiesto;
        private $FotoManifiesto;
        private $FechaRegistroManifiesto;
        private $FechaActualizacionManifiesto;
        private $EstadoManifiesto;
        private $ComentarioActualizacionManifiesto;
        //-> LABORATORIOS DE INFORMATICA
        private $IdLaboratorio;
        private $CodigoLaboratorio;
        private $NombreLaboratorio;
        private $CapacidadMaximaLaboratorio;
        private $EquiposFueraUsoLaboratorio;
        private $CapacidadRealLaboratorio;
        private $EstadoLaboratorio;
        private $CodigoColorLaboratorio;
        //-> APLICACIONES LABORATORIOS DE INFORMATICA
        private $IdAplicacion;
        private $CodigoAplicacion;
        private $NombreAplicacion;
        private $IdClasificacionAplicacion;
        private $CodigoClasificacionAplicacion;
        private $FechaRegistroAplicacion;
        /****************************************************************************************************************
         * -> $LABORATORIO?? -> VALIDO PARA GESTION DE APLICACIONES DE LABORATORIOS Y USUARIOS, YA QUE ESTAS VARIABLES
         * TOMAN EL CONTROL A QUE LABORATORIOS SE ENCUENTRAN ASIGNADOS LOS ADMINISTRADORES DE LABORATORIOS
         ****************************************************************************************************************/
        private $Laboratorio1;
        private $Laboratorio2;
        private $Laboratorio3;
        private $Laboratorio4;
        private $Laboratorio5;
        private $Laboratorio6;
        private $Laboratorio7;
        private $Laboratorio8;
        private $Laboratorio9;
        private $Laboratorio10;
        private $Laboratorio11;
        private $Laboratorio12;
        private $Laboratorio13;
        private $Laboratorio14;
        private $Laboratorio15;
        //-> TIPOS DE RESERVACIONES
        private $IdTipoReservacion;
        private $NombreTipoReservacion;
        private $DescripcionTipoReservacion;
        //-> RESERVACIONES
        private $IdReservacion;
        private $CodigoUnicoIdentificadorReservacion;
        private $CodigoReservacion;
        private $CicloReservacion;
        private $NombreReservacion;
        private $SeccionReservacion;
        private $FechaInicioReservacion;
        private $FechaFinReservacion;
        private $HoraInicioReservacion;
        private $HoraFinReservacion;
        private $CantidadUsuariosReservacion;
        private $OtroTipoReservacion;
        private $ComentarioAdministradorLaboratorioReservacion;
        private $ComentarioCoordinadorLaboratorioReservacion;
        private $EstadoReservacion;
        private $EstadoFinalizadoReservacion;
        private $UsuarioGestionReservacion;
        private $FechaRegistroReservacion;
        private $CompletoSeguimientoReservacion;
        private $CantidadModulo1;
        private $CantidadModulo2;
        private $CantidadModulo3;
        private $CantidadModulo4;
        private $EstadoTitularReservacion;
        private $NombreOtroTitularReservacion;
        private $AulaProcedenciaReservacion;
        //-> PARTE DE RESERVACIONES, DETALLES DE FACULTAD Y ESCUELA
        private $IdFacultadReservacion;
        private $NombreFacultadReservacion;
        private $IdEscuelaReservacion;
        private $NombreEscuelaReservacion;
        //*****************************************/
        // FUNCIONES PARA OBTENER DATOS DE GESTIONES
        /***********************
         * -> USUARIOS
         **********************/
        // ID DE USUARIOS
        public function setIdUsuarios($valor_retorno)
        {
            $this->IdUsuarios = $valor_retorno;
        }
        public function getIdUsuarios()
        {
            return $this->IdUsuarios;
        }
        // ID ROL DE USUARIOS
        public function setIdRolUsuarios($valor_retorno)
        {
            $this->IdRolUsuarios = $valor_retorno;
        }
        public function getIdRolUsuarios()
        {
            return $this->IdRolUsuarios;
        }
        // NOMBRE ROL DE USUARIOS
        public function setNombreRolUsuarios($valor_retorno)
        {
            $this->NombreRolUsuarios = $valor_retorno;
        }
        public function getNombreRolUsuarios()
        {
            return $this->NombreRolUsuarios;
        }
        // NOMBRES DE USUARIOS
        public function setNombresUsuarios($valor_retorno)
        {
            $this->NombresUsuarios = $valor_retorno;
        }
        public function getNombresUsuarios()
        {
            return $this->NombresUsuarios;
        }
        // APELLIDOS DE USUARIOS
        public function setApellidosUsuarios($valor_retorno)
        {
            $this->ApellidosUsuarios = $valor_retorno;
        }
        public function getApellidosUsuarios()
        {
            return $this->ApellidosUsuarios;
        }
        // CODIGO UNICO DE USUARIOS
        public function setCodigoUnicoUsuarios($valor_retorno)
        {
            $this->CodigoUnicoUsuarios = $valor_retorno;
        }
        public function getCodigoUnicoUsuarios()
        {
            return $this->CodigoUnicoUsuarios;
        }
        // CORREO DE USUARIOS
        public function setCorreoUsuarios($valor_retorno)
        {
            $this->CorreoUsuarios = $valor_retorno;
        }
        public function getCorreoUsuarios()
        {
            return $this->CorreoUsuarios;
        }
        // FOTO PERFIL DE USUARIOS
        public function setFotoPerfilUsuarios($valor_retorno)
        {
            $this->FotoPerfilUsuarios = $valor_retorno;
        }
        public function getFotoPerfilUsuarios()
        {
            return $this->FotoPerfilUsuarios;
        }
        // COMPROBACION ESTADO NUEVO DE USUARIOS
        public function setEstadoNuevoUsuario($valor_retorno)
        {
            $this->EstadoNuevoUsuario = $valor_retorno;
        }
        public function getEstadoNuevoUsuario()
        {
            return $this->EstadoNuevoUsuario;
        }
        // COMPROBACION ESTADO NUEVO DE USUARIOS [COMPLETO PERFIL]
        public function setEstadoCompletoPerfil($valor_retorno)
        {
            $this->EstadoCompletoPerfil = $valor_retorno;
        }
        public function getEstadoCompletoPerfil()
        {
            return $this->EstadoCompletoPerfil;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB1
        public function setLaboratorioAsignadoLab1($valor_retorno)
        {
            $this->LaboratorioAsignadoLab1 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab1()
        {
            return $this->LaboratorioAsignadoLab1;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB2
        public function setLaboratorioAsignadoLab2($valor_retorno)
        {
            $this->LaboratorioAsignadoLab2 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab2()
        {
            return $this->LaboratorioAsignadoLab2;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB3
        public function setLaboratorioAsignadoLab3($valor_retorno)
        {
            $this->LaboratorioAsignadoLab3 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab3()
        {
            return $this->LaboratorioAsignadoLab3;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB4
        public function setLaboratorioAsignadoLab4($valor_retorno)
        {
            $this->LaboratorioAsignadoLab4 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab4()
        {
            return $this->LaboratorioAsignadoLab4;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB5
        public function setLaboratorioAsignadoLab5($valor_retorno)
        {
            $this->LaboratorioAsignadoLab5 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab5()
        {
            return $this->LaboratorioAsignadoLab5;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB6
        public function setLaboratorioAsignadoLab6($valor_retorno)
        {
            $this->LaboratorioAsignadoLab6 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab6()
        {
            return $this->LaboratorioAsignadoLab6;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB7
        public function setLaboratorioAsignadoLab7($valor_retorno)
        {
            $this->LaboratorioAsignadoLab7 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab7()
        {
            return $this->LaboratorioAsignadoLab7;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB8
        public function setLaboratorioAsignadoLab8($valor_retorno)
        {
            $this->LaboratorioAsignadoLab8 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab8()
        {
            return $this->LaboratorioAsignadoLab8;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB9
        public function setLaboratorioAsignadoLab9($valor_retorno)
        {
            $this->LaboratorioAsignadoLab9 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab9()
        {
            return $this->LaboratorioAsignadoLab9;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB10
        public function setLaboratorioAsignadoLab10($valor_retorno)
        {
            $this->LaboratorioAsignadoLab10 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab10()
        {
            return $this->LaboratorioAsignadoLab10;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB11
        public function setLaboratorioAsignadoLab11($valor_retorno)
        {
            $this->LaboratorioAsignadoLab11 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab11()
        {
            return $this->LaboratorioAsignadoLab11;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB12
        public function setLaboratorioAsignadoLab12($valor_retorno)
        {
            $this->LaboratorioAsignadoLab12 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab12()
        {
            return $this->LaboratorioAsignadoLab12;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB13
        public function setLaboratorioAsignadoLab13($valor_retorno)
        {
            $this->LaboratorioAsignadoLab13 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab13()
        {
            return $this->LaboratorioAsignadoLab13;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB14
        public function setLaboratorioAsignadoLab14($valor_retorno)
        {
            $this->LaboratorioAsignadoLab14 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab14()
        {
            return $this->LaboratorioAsignadoLab14;
        }
        // COMPROBACION LABORATORIO ASIGNADO LAB15
        public function setLaboratorioAsignadoLab15($valor_retorno)
        {
            $this->LaboratorioAsignadoLab15 = $valor_retorno;
        }
        public function getLaboratorioAsignadoLab15()
        {
            return $this->LaboratorioAsignadoLab15;
        }
        // FECHA REGISTRO DE USUARIOS
        public function setFechaRegistro($valor_retorno)
        {
            $this->FechaRegistro = $valor_retorno;
        }
        public function getFechaRegistro()
        {
            return $this->FechaRegistro;
        }
        // ESTADO DE USUARIOS [ACTIVO, INACTIVO Y BLOQUEADO]
        public function setEstadoUsuario($valor_retorno)
        {
            $this->EstadoUsuario = $valor_retorno;
        }
        public function getEstadoUsuario()
        {
            return $this->EstadoUsuario;
        }
        // UBICACION LABORATORIO NUMERO 1
        public function setUbicacionLaboratorio1($valor_retorno)
        {
            $this->UbicacionLaboratorio1 = $valor_retorno;
        }
        public function getUbicacionLaboratorio1()
        {
            return $this->UbicacionLaboratorio1;
        }
        // UBICACION LABORATORIO NUMERO 2
        public function setUbicacionLaboratorio2($valor_retorno)
        {
            $this->UbicacionLaboratorio2 = $valor_retorno;
        }
        public function getUbicacionLaboratorio2()
        {
            return $this->UbicacionLaboratorio2;
        }
        // UBICACION LABORATORIO NUMERO 3
        public function setUbicacionLaboratorio3($valor_retorno)
        {
            $this->UbicacionLaboratorio3 = $valor_retorno;
        }
        public function getUbicacionLaboratorio3()
        {
            return $this->UbicacionLaboratorio3;
        }
        // UBICACION LABORATORIO NUMERO 4
        public function setUbicacionLaboratorio4($valor_retorno)
        {
            $this->UbicacionLaboratorio4 = $valor_retorno;
        }
        public function getUbicacionLaboratorio4()
        {
            return $this->UbicacionLaboratorio4;
        }
        // UBICACION LABORATORIO NUMERO 5
        public function setUbicacionLaboratorio5($valor_retorno)
        {
            $this->UbicacionLaboratorio5 = $valor_retorno;
        }
        public function getUbicacionLaboratorio5()
        {
            return $this->UbicacionLaboratorio5;
        }
        // UBICACION LABORATORIO NUMERO 6
        public function setUbicacionLaboratorio6($valor_retorno)
        {
            $this->UbicacionLaboratorio6 = $valor_retorno;
        }
        public function getUbicacionLaboratorio6()
        {
            return $this->UbicacionLaboratorio6;
        }
        // UBICACION LABORATORIO NUMERO 7
        public function setUbicacionLaboratorio7($valor_retorno)
        {
            $this->UbicacionLaboratorio7 = $valor_retorno;
        }
        public function getUbicacionLaboratorio7()
        {
            return $this->UbicacionLaboratorio7;
        }
        // UBICACION LABORATORIO NUMERO 8
        public function setUbicacionLaboratorio8($valor_retorno)
        {
            $this->UbicacionLaboratorio8 = $valor_retorno;
        }
        public function getUbicacionLaboratorio8()
        {
            return $this->UbicacionLaboratorio8;
        }
        // UBICACION LABORATORIO NUMERO 9
        public function setUbicacionLaboratorio9($valor_retorno)
        {
            $this->UbicacionLaboratorio9 = $valor_retorno;
        }
        public function getUbicacionLaboratorio9()
        {
            return $this->UbicacionLaboratorio9;
        }
        // UBICACION LABORATORIO NUMERO 10
        public function setUbicacionLaboratorio10($valor_retorno)
        {
            $this->UbicacionLaboratorio10 = $valor_retorno;
        }
        public function getUbicacionLaboratorio10()
        {
            return $this->UbicacionLaboratorio10;
        }
        // UBICACION LABORATORIO NUMERO 11
        public function setUbicacionLaboratorio11($valor_retorno)
        {
            $this->UbicacionLaboratorio11 = $valor_retorno;
        }
        public function getUbicacionLaboratorio11()
        {
            return $this->UbicacionLaboratorio11;
        }
        // UBICACION LABORATORIO NUMERO 12
        public function setUbicacionLaboratorio12($valor_retorno)
        {
            $this->UbicacionLaboratorio12 = $valor_retorno;
        }
        public function getUbicacionLaboratorio12()
        {
            return $this->UbicacionLaboratorio12;
        }
        // UBICACION LABORATORIO NUMERO 13
        public function setUbicacionLaboratorio13($valor_retorno)
        {
            $this->UbicacionLaboratorio13 = $valor_retorno;
        }
        public function getUbicacionLaboratorio13()
        {
            return $this->UbicacionLaboratorio13;
        }
        // UBICACION LABORATORIO NUMERO 14
        public function setUbicacionLaboratorio14($valor_retorno)
        {
            $this->UbicacionLaboratorio14 = $valor_retorno;
        }
        public function getUbicacionLaboratorio14()
        {
            return $this->UbicacionLaboratorio14;
        }
        // UBICACION LABORATORIO NUMERO 15
        public function setUbicacionLaboratorio15($valor_retorno)
        {
            $this->UbicacionLaboratorio15 = $valor_retorno;
        }
        public function getUbicacionLaboratorio15()
        {
            return $this->UbicacionLaboratorio15;
        }
        // EXTENSIONES USUARIOS
        public function setExtensionesUsuarios($valor_retorno)
        {
            $this->ExtensionesUsuarios = $valor_retorno;
        }
        public function getExtensionesUsuarios()
        {
            return $this->ExtensionesUsuarios;
        }
         /***************************
         * -> DETALLES DE USUARIOS
         ***************************/
        // FECHA ULTIMO CAMBIO DE CREDENCIAL DE ACCESO SISTEMA
        public function setUltimoCambio_Contrasenia($valor_retorno)
        {
            $this->UltimoCambio_Contrasenia = $valor_retorno;
        }
        public function getUltimoCambio_Contrasenia()
        {
            return $this->UltimoCambio_Contrasenia;
        }
        // TELEFONO PRINCIPAL USUARIOS
        public function setTelefonoPrincipal($valor_retorno)
        {
            $this->TelefonoPrincipal = $valor_retorno;
        }
        public function getTelefonoPrincipal()
        {
            return $this->TelefonoPrincipal;
        }
        // GENERO USUARIOS
        public function setGeneroUsuarios($valor_retorno)
        {
            $this->GeneroUsuarios = $valor_retorno;
        }
        public function getGeneroUsuarios()
        {
            return $this->GeneroUsuarios;
        }
        // FECHA DE NACIMIENTO USUARIOS
        public function setFechaNacimiento($valor_retorno)
        {
            $this->FechaNacimiento = $valor_retorno;
        }
        public function getFechaNacimiento()
        {
            return $this->FechaNacimiento;
        }
        // ESTADO CIVIL DE USUARIOS
        public function setEstadoCivil($valor_retorno)
        {
            $this->EstadoCivil = $valor_retorno;
        }
        public function getEstadoCivil()
        {
            return $this->EstadoCivil;
        }
         /***************************
         * -> ROLES DE USUARIOS
         ***************************/
        // ID ROL DE USUARIO
        public function setIdRolUsuario($valor_retorno)
        {
            $this->IdRolUsuario = $valor_retorno;
        }
        public function getIdRolUsuario()
        {
            return $this->IdRolUsuario;
        }
        // NOMBRE ROL DE USUARIO
        public function setNombreRolUsuario($valor_retorno)
        {
            $this->NombreRolUsuario = $valor_retorno;
        }
        public function getNombreRolUsuario()
        {
            return $this->NombreRolUsuario;
        }
        // DESCRIPCION ROL DE USUARIO
        public function setDescripcionRolUsuario($valor_retorno)
        {
            $this->DescripcionRolUsuario = $valor_retorno;
        }
        public function getDescripcionRolUsuario()
        {
            return $this->DescripcionRolUsuario;
        }
        /***********************************
         * -> CLASIFICACION NOTIFICACIONES
         ***********************************/
        // ID CLASIFICACION NOTIFICACIONES
        public function setIdClasificacionNotificaciones($valor_retorno)
        {
            $this->IdClasificacionNotificaciones = $valor_retorno;
        }
        public function getIdClasificacionNotificaciones()
        {
            return $this->IdClasificacionNotificaciones;
        }
        // CODIGO CLASIFICACION NOTIFICACIONES
        public function setCodigoClasificacionNotificaciones($valor_retorno)
        {
            $this->CodigoClasificacionNotificaciones = $valor_retorno;
        }
        public function getCodigoClasificacionNotificaciones()
        {
            return $this->CodigoClasificacionNotificaciones;
        }
        // DESCRIPCION CLASIFICACION NOTIFICACIONES
        public function setDescripcionClasificacionNotificaciones($valor_retorno)
        {
            $this->DescripcionClasificacionNotificaciones = $valor_retorno;
        }
        public function getDescripcionClasificacionNotificaciones()
        {
            return $this->DescripcionClasificacionNotificaciones;
        }
        /***********************************
         * -> MENSAJERIA USUARIOS
         ***********************************/
        // ID MENSAJERIA
        public function setIdMensajeria($valor_retorno)
        {
            $this->IdMensajeria = $valor_retorno;
        }
        public function getIdMensajeria()
        {
            return $this->IdMensajeria;
        }
        // ID USUARIO DESTINATARIO
        public function setIdUsuarioDestinatario($valor_retorno)
        {
            $this->IdUsuarioDestinatario = $valor_retorno;
        }
        public function getIdUsuarioDestinatario()
        {
            return $this->IdUsuarioDestinatario;
        }
        // NOMBRE MENSAJE
        public function setNombreMensaje($valor_retorno)
        {
            $this->NombreMensaje = $valor_retorno;
        }
        public function getNombreMensaje()
        {
            return $this->NombreMensaje;
        }
        // ASUNTO MENSAJE
        public function setAsuntoMensaje($valor_retorno)
        {
            $this->AsuntoMensaje = $valor_retorno;
        }
        public function getAsuntoMensaje()
        {
            return $this->AsuntoMensaje;
        }
        // DETALLE MENSAJE
        public function setDetalleMensaje($valor_retorno)
        {
            $this->DetalleMensaje = $valor_retorno;
        }
        public function getDetalleMensaje()
        {
            return $this->DetalleMensaje;
        }
        // FECHA MENSAJE
        public function setFechaMensaje($valor_retorno)
        {
            $this->FechaMensaje = $valor_retorno;
        }
        public function getFechaMensaje()
        {
            return $this->FechaMensaje;
        }
        // ESTADO MENSAJE LEIDO
        public function setEstadoMensajeLeido($valor_retorno)
        {
            $this->EstadoMensajeLeido = $valor_retorno;
        }
        public function getEstadoMensajeLeido()
        {
            return $this->EstadoMensajeLeido;
        }
        // ARCHIVO ADJUNTO MENSAJE
        public function setArchivoAdjunto($valor_retorno)
        {
            $this->ArchivoAdjunto = $valor_retorno;
        }
        public function getArchivoAdjunto()
        {
            return $this->ArchivoAdjunto;
        }
        // ESTADO MENSAJE OCULTO
        public function setEstadoOcultarMensaje($valor_retorno)
        {
            $this->EstadoOcultarMensaje = $valor_retorno;
        }
        public function getEstadoOcultarMensaje()
        {
            return $this->EstadoOcultarMensaje;
        }
        /***********************************
         * -> MANIFIESTOS PLATAFORMA
         ***********************************/
        // ID MANIFIESTO
        public function setIdManifiesto($valor_retorno)
        {
            $this->IdManifiesto = $valor_retorno;
        }
        public function getIdManifiesto()
        {
            return $this->IdManifiesto;
        }
        // NOMBRE MANIFIESTO
        public function setNombreManifiesto($valor_retorno)
        {
            $this->NombreManifiesto = $valor_retorno;
        }
        public function getNombreManifiesto()
        {
            return $this->NombreManifiesto;
        }
        // DESCRIPCION MANIFIESTO
        public function setDescripcionManifiesto($valor_retorno)
        {
            $this->DescripcionManifiesto = $valor_retorno;
        }
        public function getDescripcionManifiesto()
        {
            return $this->DescripcionManifiesto;
        }
        // FOTO [CAPTURA] MANIFIESTO
        public function setFotoManifiesto($valor_retorno)
        {
            $this->FotoManifiesto = $valor_retorno;
        }
        public function getFotoManifiesto()
        {
            return $this->FotoManifiesto;
        }
        // FECHA [REGISTRO] MANIFIESTO
        public function setFechaRegistroManifiesto($valor_retorno)
        {
            $this->FechaRegistroManifiesto = $valor_retorno;
        }
        public function getFechaRegistroManifiesto()
        {
            return $this->FechaRegistroManifiesto;
        }
        // FECHA [ACTUALIZACION] MANIFIESTO
        public function setFechaActualizacionManifiesto($valor_retorno)
        {
            $this->FechaActualizacionManifiesto = $valor_retorno;
        }
        public function getFechaActualizacionManifiesto()
        {
            return $this->FechaActualizacionManifiesto;
        }
        // ESTADO MANIFIESTO
        public function setEstadoManifiesto($valor_retorno)
        {
            $this->EstadoManifiesto = $valor_retorno;
        }
        public function getEstadoManifiesto()
        {
            return $this->EstadoManifiesto;
        }
        // COMENTARIO ACTUALIZACION MANIFIESTO
        public function setComentarioActualizacionManifiesto($valor_retorno)
        {
            $this->ComentarioActualizacionManifiesto = $valor_retorno;
        }
        public function getComentarioActualizacionManifiesto()
        {
            return $this->ComentarioActualizacionManifiesto;
        }
        /***********************************
         * -> LABORATORIOS INFORMATICA
         ***********************************/
        // ID LABORATORIO
        public function setIdLaboratorio($valor_retorno)
        {
            $this->IdLaboratorio = $valor_retorno;
        }
        public function getIdLaboratorio()
        {
            return $this->IdLaboratorio;
        }
        // CODIGO LABORATORIO
        public function setCodigoLaboratorio($valor_retorno)
        {
            $this->CodigoLaboratorio = $valor_retorno;
        }
        public function getCodigoLaboratorio()
        {
            return $this->CodigoLaboratorio;
        }
        // NOMBRE LABORATORIO
        public function setNombreLaboratorio($valor_retorno)
        {
            $this->NombreLaboratorio = $valor_retorno;
        }
        public function getNombreLaboratorio()
        {
            return $this->NombreLaboratorio;
        }
        // CAPACIDAD MAXIMA LABORATORIO
        public function setCapacidadMaximaLaboratorio($valor_retorno)
        {
            $this->CapacidadMaximaLaboratorio = $valor_retorno;
        }
        public function getCapacidadMaximaLaboratorio()
        {
            return $this->CapacidadMaximaLaboratorio;
        }
        // CAPACIDAD REAL [CON EQUIPOS FUERA DE USO] LABORATORIO
        public function setCapacidadRealLaboratorio($valor_retorno)
        {
            $this->CapacidadRealLaboratorio = $valor_retorno;
        }
        public function getCapacidadRealLaboratorio()
        {
            return $this->CapacidadRealLaboratorio;
        }
        // EQUIPOS FUERA DE USO LABORATORIO
        public function setEquiposFueraUsoLaboratorio($valor_retorno)
        {
            $this->EquiposFueraUsoLaboratorio = $valor_retorno;
        }
        public function getEquiposFueraUsoLaboratorio()
        {
            return $this->EquiposFueraUsoLaboratorio;
        }
        // ESTADO LABORATORIO
        public function setEstadoLaboratorio($valor_retorno)
        {
            $this->EstadoLaboratorio = $valor_retorno;
        }
        public function getEstadoLaboratorio()
        {
            return $this->EstadoLaboratorio;
        }
        // CODIGO COLOR LABORATORIO
        public function setCodigoColorLaboratorio($valor_retorno)
        {
            $this->CodigoColorLaboratorio = $valor_retorno;
        }
        public function getCodigoColorLaboratorio()
        {
            return $this->CodigoColorLaboratorio;
        }
        /***********************************
         * -> APLICACIONES LABORATORIOS
         ***********************************/
        // ID APLICACION
        public function setIdAplicacion($valor_retorno)
        {
            $this->IdAplicacion = $valor_retorno;
        }
        public function getIdAplicacion()
        {
            return $this->IdAplicacion;
        }
        // CODIGO APLICACION
        public function setCodigoAplicacion($valor_retorno)
        {
            $this->CodigoAplicacion = $valor_retorno;
        }
        public function getCodigoAplicacion()
        {
            return $this->CodigoAplicacion;
        }
        // NOMBRE APLICACION
        public function setNombreAplicacion($valor_retorno)
        {
            $this->NombreAplicacion = $valor_retorno;
        }
        public function getNombreAplicacion()
        {
            return $this->NombreAplicacion;
        }
        // ID CLASIFICACION APLICACION
        public function setIdClasificacionAplicacion($valor_retorno)
        {
            $this->IdClasificacionAplicacion = $valor_retorno;
        }
        public function getIdClasificacionAplicacion()
        {
            return $this->IdClasificacionAplicacion;
        }
        // CODIGO CLASIFICACION APLICACION
        public function setCodigoClasificacionAplicacion($valor_retorno)
        {
            $this->CodigoClasificacionAplicacion = $valor_retorno;
        }
        public function getCodigoClasificacionAplicacion()
        {
            return $this->CodigoClasificacionAplicacion;
        }
        // FECHA REGISTRO APLICACION
        public function setFechaRegistroAplicacion($valor_retorno)
        {
            $this->FechaRegistroAplicacion = $valor_retorno;
        }
        public function getFechaRegistroAplicacion()
        {
            return $this->FechaRegistroAplicacion;
        }
        /**************************************************
         * -> CONTROL LABORATORIOS DISPONIBLES 
         *    [VALIDO PARA APLICACIONES Y USUARIOS]
         **************************************************/
        // LABORATORIO 1
        public function setLaboratorio1($valor_retorno)
        {
            $this->Laboratorio1 = $valor_retorno;
        }
        public function getLaboratorio1()
        {
            return $this->Laboratorio1;
        }
        // LABORATORIO 2
        public function setLaboratorio2($valor_retorno)
        {
            $this->Laboratorio2 = $valor_retorno;
        }
        public function getLaboratorio2()
        {
            return $this->Laboratorio2;
        }
        // LABORATORIO 3
        public function setLaboratorio3($valor_retorno)
        {
            $this->Laboratorio3 = $valor_retorno;
        }
        public function getLaboratorio3()
        {
            return $this->Laboratorio3;
        }
        // LABORATORIO 4
        public function setLaboratorio4($valor_retorno)
        {
            $this->Laboratorio4 = $valor_retorno;
        }
        public function getLaboratorio4()
        {
            return $this->Laboratorio4;
        }
        // LABORATORIO 5
        public function setLaboratorio5($valor_retorno)
        {
            $this->Laboratorio5 = $valor_retorno;
        }
        public function getLaboratorio5()
        {
            return $this->Laboratorio5;
        }
        // LABORATORIO 6
        public function setLaboratorio6($valor_retorno)
        {
            $this->Laboratorio6 = $valor_retorno;
        }
        public function getLaboratorio6()
        {
            return $this->Laboratorio6;
        }
        // LABORATORIO 7
        public function setLaboratorio7($valor_retorno)
        {
            $this->Laboratorio7 = $valor_retorno;
        }
        public function getLaboratorio7()
        {
            return $this->Laboratorio7;
        }
        // LABORATORIO 8
        public function setLaboratorio8($valor_retorno)
        {
            $this->Laboratorio8 = $valor_retorno;
        }
        public function getLaboratorio8()
        {
            return $this->Laboratorio8;
        }
        // LABORATORIO 9
        public function setLaboratorio9($valor_retorno)
        {
            $this->Laboratorio9 = $valor_retorno;
        }
        public function getLaboratorio9()
        {
            return $this->Laboratorio9;
        }
        // LABORATORIO 10
        public function setLaboratorio10($valor_retorno)
        {
            $this->Laboratorio10 = $valor_retorno;
        }
        public function getLaboratorio10()
        {
            return $this->Laboratorio10;
        }
        // LABORATORIO 11
        public function setLaboratorio11($valor_retorno)
        {
            $this->Laboratorio11 = $valor_retorno;
        }
        public function getLaboratorio11()
        {
            return $this->Laboratorio11;
        }
        // LABORATORIO 12
        public function setLaboratorio12($valor_retorno)
        {
            $this->Laboratorio12 = $valor_retorno;
        }
        public function getLaboratorio12()
        {
            return $this->Laboratorio12;
        }
        // LABORATORIO 13
        public function setLaboratorio13($valor_retorno)
        {
            $this->Laboratorio13 = $valor_retorno;
        }
        public function getLaboratorio13()
        {
            return $this->Laboratorio13;
        }
        // LABORATORIO 14
        public function setLaboratorio14($valor_retorno)
        {
            $this->Laboratorio14 = $valor_retorno;
        }
        public function getLaboratorio14()
        {
            return $this->Laboratorio14;
        }
        // LABORATORIO 15
        public function setLaboratorio15($valor_retorno)
        {
            $this->Laboratorio15 = $valor_retorno;
        }
        public function getLaboratorio15()
        {
            return $this->Laboratorio15;
        }
        /***********************************
         * -> TIPOS RESERVACIONES
         ***********************************/
        // ID TIPO RESERVACION
        public function setIdTipoReservacion($valor_retorno)
        {
            $this->IdTipoReservacion = $valor_retorno;
        }
        public function getIdTipoReservacion()
        {
            return $this->IdTipoReservacion;
        }
        // NOMBRE TIPO RESERVACION
        public function setNombreTipoReservacion($valor_retorno)
        {
            $this->NombreTipoReservacion = $valor_retorno;
        }
        public function getNombreTipoReservacion()
        {
            return $this->NombreTipoReservacion;
        }
        // DESCRIPCION TIPO RESERVACION
        public function setDescripcionTipoReservacion($valor_retorno)
        {
            $this->DescripcionTipoReservacion = $valor_retorno;
        }
        public function getDescripcionTipoReservacion()
        {
            return $this->DescripcionTipoReservacion;
        }
        /***********************************
         * -> RESERVACIONES
         ***********************************/
        // ID RESERVACION
        public function setIdReservacion($valor_retorno)
        {
            $this->IdReservacion = $valor_retorno;
        }
        public function getIdReservacion()
        {
            return $this->IdReservacion;
        }
        // IDENTIFICADOR UNICO RESERVACION
        public function setCodigoUnicoIdentificadorReservacion($valor_retorno)
        {
            $this->CodigoUnicoIdentificadorReservacion = $valor_retorno;
        }
        public function getCodigoUnicoIdentificadorReservacion()
        {
            return $this->CodigoUnicoIdentificadorReservacion;
        }
        // CODIGO RESERVACION
        public function setCodigoReservacion($valor_retorno)
        {
            $this->CodigoReservacion = $valor_retorno;
        }
        public function getCodigoReservacion()
        {
            return $this->CodigoReservacion;
        }
        // CICLO RESERVACION
        public function setCicloReservacion($valor_retorno)
        {
            $this->CicloReservacion = $valor_retorno;
        }
        public function getCicloReservacion()
        {
            return $this->CicloReservacion;
        }
        // NOMBRE RESERVACION
        public function setNombreReservacion($valor_retorno)
        {
            $this->NombreReservacion = $valor_retorno;
        }
        public function getNombreReservacion()
        {
            return $this->NombreReservacion;
        }
        // SECCION RESERVACION
        public function setSeccionReservacion($valor_retorno)
        {
            $this->SeccionReservacion = $valor_retorno;
        }
        public function getSeccionReservacion()
        {
            return $this->SeccionReservacion;
        }
        // FECHA INICIO RESERVACION
        public function setFechaInicioReservacion($valor_retorno)
        {
            $this->FechaInicioReservacion = $valor_retorno;
        }
        public function getFechaInicioReservacion()
        {
            return $this->FechaInicioReservacion;
        }
        // FECHA FIN RESERVACION
        public function setFechaFinReservacion($valor_retorno)
        {
            $this->FechaFinReservacion = $valor_retorno;
        }
        public function getFechaFinReservacion()
        {
            return $this->FechaFinReservacion;
        }
        // HORA INICIO RESERVACION
        public function setHoraInicioReservacion($valor_retorno)
        {
            $this->HoraInicioReservacion = $valor_retorno;
        }
        public function getHoraInicioReservacion()
        {
            return $this->HoraInicioReservacion;
        }
        // HORA FIN RESERVACION
        public function setHoraFinReservacion($valor_retorno)
        {
            $this->HoraFinReservacion = $valor_retorno;
        }
        public function getHoraFinReservacion()
        {
            return $this->HoraFinReservacion;
        }
        // NUMERO USUARIOS RESERVACION
        public function setCantidadUsuariosReservacion($valor_retorno)
        {
            $this->CantidadUsuariosReservacion = $valor_retorno;
        }
        public function getCantidadUsuariosReservacion()
        {
            return $this->CantidadUsuariosReservacion;
        }
         // COMENTARIO OTRO TIPO RESERVACION [SI APLICA]
         public function setOtroTipoReservacion($valor_retorno)
         {
             $this->OtroTipoReservacion = $valor_retorno;
         }
         public function getOtroTipoReservacion()
         {
             return $this->OtroTipoReservacion;
         }
        // COMENTARIO RETROALIMENTACION ADMINISTRADORES DE LABORATORIOS RESERVACION
        public function setComentarioAdministradorLaboratorioReservacion($valor_retorno)
        {
            $this->ComentarioAdministradorLaboratorioReservacion = $valor_retorno;
        }
        public function getComentarioAdministradorLaboratorioReservacion()
        {
            return $this->ComentarioAdministradorLaboratorioReservacion;
        }
        // COMENTARIO RETROALIMENTACION COORDINADOR DE LABORATORIOS RESERVACION
        public function setComentarioCoordinadorLaboratorioReservacion($valor_retorno)
        {
            $this->ComentarioCoordinadorLaboratorioReservacion = $valor_retorno;
        }
        public function getComentarioCoordinadorLaboratorioReservacion()
        {
            return $this->ComentarioCoordinadorLaboratorioReservacion;
        }
        // ESTADO RESERVACION
        public function setEstadoReservacion($valor_retorno)
        {
            $this->EstadoReservacion = $valor_retorno;
        }
        public function getEstadoReservacion()
        {
            return $this->EstadoReservacion;
        }
        // ESTADO RESERVACION
        public function setEstadoFinalizadoReservacion($valor_retorno)
        {
            $this->EstadoFinalizadoReservacion = $valor_retorno;
        }
        public function getEstadoFinalizadoReservacion()
        {
            return $this->EstadoFinalizadoReservacion;
        }
        // USUARIO GESTION RESERVACION [QUIEN ACTUALIZA LA SOLICITUD DE RESERVACION -> ADMINISTRADORES DE LABORATORIOS]
        public function setUsuarioGestionReservacion($valor_retorno)
        {
            $this->UsuarioGestionReservacion = $valor_retorno;
        }
        public function getUsuarioGestionReservacion()
        {
            return $this->UsuarioGestionReservacion;
        }
        // FECHA REGISTRO RESERVACION
        public function setFechaRegistroReservacion($valor_retorno)
        {
            $this->FechaRegistroReservacion = $valor_retorno;
        }
        public function getFechaRegistroReservacion()
        {
            return $this->FechaRegistroReservacion;
        }
        // ESTADO CONTROL COMPLETO -> REGISTRO SEGUIMIENTO RESERVACION
        public function setCompletoSeguimientoReservacion($valor_retorno)
        {
            $this->CompletoSeguimientoReservacion = $valor_retorno;
        }
        public function getCompletoSeguimientoReservacion()
        {
            return $this->CompletoSeguimientoReservacion;
        }
        // CANTIDAD USUARIOS ASIGNADOS MODULO 1
        public function setCantidadModulo1($valor_retorno)
        {
            $this->CantidadModulo1 = $valor_retorno;
        }
        public function getCantidadModulo1()
        {
            return $this->CantidadModulo1;
        }
        // CANTIDAD USUARIOS ASIGNADOS MODULO 2
        public function setCantidadModulo2($valor_retorno)
        {
            $this->CantidadModulo2 = $valor_retorno;
        }
        public function getCantidadModulo2()
        {
            return $this->CantidadModulo2;
        }
        // CANTIDAD USUARIOS ASIGNADOS MODULO 3
        public function setCantidadModulo3($valor_retorno)
        {
            $this->CantidadModulo3 = $valor_retorno;
        }
        public function getCantidadModulo3()
        {
            return $this->CantidadModulo3;
        }
        // CANTIDAD USUARIOS ASIGNADOS MODULO 4
        public function setCantidadModulo4($valor_retorno)
        {
            $this->CantidadModulo4 = $valor_retorno;
        }
        public function getCantidadModulo4()
        {
            return $this->CantidadModulo4;
        }
        // ESTADO TITULAR RESERVACION
        public function setEstadoTitularReservacion($valor_retorno)
        {
            $this->EstadoTitularReservacion = $valor_retorno;
        }
        public function getEstadoTitularReservacion()
        {
            return $this->EstadoTitularReservacion;
        }
        // NOMBRE OTRO TITULAR RESERVACION
        public function setNombreOtroTitularReservacion($valor_retorno)
        {
            $this->NombreOtroTitularReservacion = $valor_retorno;
        }
        public function getNombreOtroTitularReservacion()
        {
            return $this->NombreOtroTitularReservacion;
        }
        // AULA PROCEDENCIA RESERVACION
        public function setAulaProcedenciaReservacion($valor_retorno)
        {
            $this->AulaProcedenciaReservacion = $valor_retorno;
        }
        public function getAulaProcedenciaReservacion()
        {
            return $this->AulaProcedenciaReservacion;
        }
        // ID FACULTAD RESERVACION
        public function setIdFacultadReservacion($valor_retorno)
        {
            $this->IdFacultadReservacion = $valor_retorno;
        }
        public function getIdFacultadReservacion()
        {
            return $this->IdFacultadReservacion;
        }
        // NOMBRE FACULTAD RESERVACION
        public function setNombreFacultadReservacion($valor_retorno)
        {
            $this->NombreFacultadReservacion = $valor_retorno;
        }
        public function getNombreFacultadReservacion()
        {
            return $this->NombreFacultadReservacion;
        }
        // ID ESCUELA RESERVACION
        public function setIdEscuelaReservacion($valor_retorno)
        {
            $this->IdEscuelaReservacion = $valor_retorno;
        }
        public function getIdEscuelaReservacion()
        {
            return $this->IdEscuelaReservacion;
        }
        // NOMBRE ESCUELA RESERVACION
        public function setNombreEscuelaReservacion($valor_retorno)
        {
            $this->NombreEscuelaReservacion = $valor_retorno;
        }
        public function getNombreEscuelaReservacion()
        {
            return $this->NombreEscuelaReservacion;
        }
        /*************************
         * -> GESTIONES SISTEMA
         *************************/
        // CONSULTA COMPLETA ROLES DE USUARIO REGISTRADOS
        public function ConsultarRolesUsuariosRegistrados($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarRolesUsuariosRegistrados()");
            return $resultado;
        }
        // REGISTRO DE NUEVOS USUARIOS
        public function RegistroNuevosUsuarios($conectarsistema, $IdRolUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CodigoUnicoUsuarios, $CorreoUsuarios, 
        $ContraseniaUsuarios, $Laboratorio1, $Laboratorio2, $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, $Laboratorio7, $Laboratorio8, 
        $Laboratorio9, $Laboratorio10, $Laboratorio11, $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15, $UbicacionLaboratorio1, $UbicacionLaboratorio2,
        $UbicacionLaboratorio3, $UbicacionLaboratorio4, $UbicacionLaboratorio5, $UbicacionLaboratorio6, $UbicacionLaboratorio7, $UbicacionLaboratorio8, $UbicacionLaboratorio9,
        $UbicacionLaboratorio10, $UbicacionLaboratorio11, $UbicacionLaboratorio12, $UbicacionLaboratorio13, $UbicacionLaboratorio14, $UbicacionLaboratorio15, $ExtensionesUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevosUsuarios('" . $IdRolUsuarios . "','" . $NombresUsuarios . "',
            '" . $ApellidosUsuarios . "','" . $CodigoUnicoUsuarios . "','" . $CorreoUsuarios . "','" . $ContraseniaUsuarios . "'
            ,'" . $Laboratorio1 . "','" . $Laboratorio2 . "','" . $Laboratorio3 . "','" . $Laboratorio4 . "','" . $Laboratorio5 . "'
            ,'" . $Laboratorio6 . "','" . $Laboratorio7 . "','" . $Laboratorio8 . "','" . $Laboratorio9 . "','" . $Laboratorio10 . "'
            ,'" . $Laboratorio11 . "','" . $Laboratorio12 . "','" . $Laboratorio13 . "','" . $Laboratorio14 . "','" . $Laboratorio15 . "','" . $UbicacionLaboratorio1 . "'
            ,'" . $UbicacionLaboratorio2 . "','" . $UbicacionLaboratorio3 . "','" . $UbicacionLaboratorio4 . "','" . $UbicacionLaboratorio5 . "','" . $UbicacionLaboratorio6 . "'
            ,'" . $UbicacionLaboratorio7 . "','" . $UbicacionLaboratorio8 . "','" . $UbicacionLaboratorio9 . "','" . $UbicacionLaboratorio10 . "','" . $UbicacionLaboratorio11 . "'
            ,'" . $UbicacionLaboratorio12 . "','" . $UbicacionLaboratorio13 . "','" . $UbicacionLaboratorio14 . "','" . $UbicacionLaboratorio15 . "','" . $ExtensionesUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // MODIFICAR USUARIOS
        public function ModificarUsuarios($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, 
        $CodigoUnicoUsuarios, $CorreoUsuarios, $IdRolUsuarios, $EstadoUsuario, $Laboratorio1, $Laboratorio2, 
        $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, $Laboratorio7, $Laboratorio8, $Laboratorio9, $Laboratorio10, $Laboratorio11, 
        $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15, $UbicacionLaboratorio1, $UbicacionLaboratorio2,
        $UbicacionLaboratorio3, $UbicacionLaboratorio4, $UbicacionLaboratorio5, $UbicacionLaboratorio6, $UbicacionLaboratorio7, $UbicacionLaboratorio8, $UbicacionLaboratorio9,
        $UbicacionLaboratorio10, $UbicacionLaboratorio11, $UbicacionLaboratorio12, $UbicacionLaboratorio13, $UbicacionLaboratorio14, $UbicacionLaboratorio15, $ExtensionesUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ModificarDatosUsuarios('" . $IdUsuarios . "','" . $NombresUsuarios . "','" 
            . $ApellidosUsuarios . "','" . $CodigoUnicoUsuarios . "','" . $CorreoUsuarios . "','" . $IdRolUsuarios . "','" . $EstadoUsuario . "'
            ,'" . $Laboratorio1 . "','" . $Laboratorio2 . "','" . $Laboratorio3 . "','" . $Laboratorio4 . "','" . $Laboratorio5 . "'
            ,'" . $Laboratorio6 . "','" . $Laboratorio7 . "','" . $Laboratorio8 . "','" . $Laboratorio9 . "','" . $Laboratorio10 . "'
            ,'" . $Laboratorio11 . "','" . $Laboratorio12 . "','" . $Laboratorio13 . "','" . $Laboratorio14 . "','" . $Laboratorio15 . "','" . $UbicacionLaboratorio1 . "'
            ,'" . $UbicacionLaboratorio2 . "','" . $UbicacionLaboratorio3 . "','" . $UbicacionLaboratorio4 . "','" . $UbicacionLaboratorio5 . "','" . $UbicacionLaboratorio6 . "'
            ,'" . $UbicacionLaboratorio7 . "','" . $UbicacionLaboratorio8 . "','" . $UbicacionLaboratorio9 . "','" . $UbicacionLaboratorio10 . "','" . $UbicacionLaboratorio11 . "'
            ,'" . $UbicacionLaboratorio12 . "','" . $UbicacionLaboratorio13 . "','" . $UbicacionLaboratorio14 . "','" . $UbicacionLaboratorio15 . "','" . $ExtensionesUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // DESACTIVAR USUARIOS
        public function DesactivarUsuarios($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_DesactivarUsuarios('" . $IdUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // BLOQUEAR USUARIOS
        public function BloquearUsuarios($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_BloquearUsuarios('" . $IdUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // ACTIVAR USUARIOS
        public function ActivarUsuarios($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActivarUsuarios('" . $IdUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA COMPLETA DE USUARIOS REGISTRADOS [ SIN FILTROS ]
        public function ConsultaGeneralUsuariosRegistrados($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarUsuariosRegistrados_General()");
            return $resultado;
        }
        // CONSULTA ESPECIFICA CONTROLADOR ESTADO DE USUARIOS
        /***************************************************************************************************************************
         * -> ESTA CONSULTA VERIFICA EL ESTADO ACTUAL DE LOS USUARIOS. EN EL CASO CONCRETO AL MOMENTO DE BLOQUEAR A UN USUARIO,
         *  ESTE VEA EL CAMBIO AUTOMATICAMENTE Y BLOQUEAR TODAS LAS FUNCIONALIDADES DEL PORTAL
         ***************************************************************************************************************************/
        public function ConsultaEspecificaControladorEstadoUsuarios($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ControladorEstadoUsuariosPortal('" . $IdUsuarios . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setCodigoUnicoUsuarios($Gestiones['codigousuario']);
                $this->setEstadoUsuario($Gestiones['estado_usuario']);
                $this->setLaboratorioAsignadoLab1($Gestiones['lab1']);
                $this->setLaboratorioAsignadoLab2($Gestiones['lab2']);
                $this->setLaboratorioAsignadoLab3($Gestiones['lab3']);
                $this->setLaboratorioAsignadoLab4($Gestiones['lab4']);
                $this->setLaboratorioAsignadoLab5($Gestiones['lab5']);
                $this->setLaboratorioAsignadoLab6($Gestiones['lab6']);
                $this->setLaboratorioAsignadoLab7($Gestiones['lab7']);
                $this->setLaboratorioAsignadoLab8($Gestiones['lab8']);
                $this->setLaboratorioAsignadoLab9($Gestiones['lab9']);
                $this->setLaboratorioAsignadoLab10($Gestiones['lab10']);
                $this->setLaboratorioAsignadoLab11($Gestiones['lab11']);
                $this->setLaboratorioAsignadoLab12($Gestiones['lab12']);
                $this->setLaboratorioAsignadoLab13($Gestiones['lab13']);
                $this->setLaboratorioAsignadoLab14($Gestiones['lab14']);
                $this->setLaboratorioAsignadoLab15($Gestiones['lab15']);
                $this->setEstadoNuevoUsuario($Gestiones['nuevousuario']);
                $this->setEstadoCompletoPerfil($Gestiones['completarperfil']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // CONSULTA ESPECIFICA USUARIOS REGISTRADOS [ACCION MODIFICAR DATOS]
        public function ConsultaEspecificaUsuariosRegistrados_ModificarDatos($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaUsuariosRegistrados('" . $IdUsuarios . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setIdRolUsuarios($Gestiones['idrolusuario']);
                $this->setNombresUsuarios($Gestiones['nombres']);
                $this->setApellidosUsuarios($Gestiones['apellidos']);
                $this->setCodigoUnicoUsuarios($Gestiones['codigousuario']);
                $this->setCorreoUsuarios($Gestiones['correo']);
                $this->setNombreRolUsuarios($Gestiones['nombrerolusuario']);
                $this->setEstadoNuevoUsuario($Gestiones['nuevousuario']);
                $this->setEstadoUsuario($Gestiones['estado_usuario']);
                $this->setLaboratorio1($Gestiones['lab1']);
                $this->setLaboratorio2($Gestiones['lab2']);
                $this->setLaboratorio3($Gestiones['lab3']);
                $this->setLaboratorio4($Gestiones['lab4']);
                $this->setLaboratorio5($Gestiones['lab5']);
                $this->setLaboratorio6($Gestiones['lab6']);
                $this->setLaboratorio7($Gestiones['lab7']);
                $this->setLaboratorio8($Gestiones['lab8']);
                $this->setLaboratorio9($Gestiones['lab9']);
                $this->setLaboratorio10($Gestiones['lab10']);
                $this->setLaboratorio11($Gestiones['lab11']);
                $this->setLaboratorio12($Gestiones['lab12']);
                $this->setLaboratorio13($Gestiones['lab13']);
                $this->setLaboratorio14($Gestiones['lab14']);
                $this->setLaboratorio15($Gestiones['lab15']); 
                $this->setUbicacionLaboratorio1($Gestiones['ubic_lab1']);   
                $this->setUbicacionLaboratorio2($Gestiones['ubic_lab2']);   
                $this->setUbicacionLaboratorio3($Gestiones['ubic_lab3']);   
                $this->setUbicacionLaboratorio4($Gestiones['ubic_lab4']);   
                $this->setUbicacionLaboratorio5($Gestiones['ubic_lab5']);   
                $this->setUbicacionLaboratorio6($Gestiones['ubic_lab6']);   
                $this->setUbicacionLaboratorio7($Gestiones['ubic_lab7']);   
                $this->setUbicacionLaboratorio8($Gestiones['ubic_lab8']);   
                $this->setUbicacionLaboratorio9($Gestiones['ubic_lab9']);   
                $this->setUbicacionLaboratorio10($Gestiones['ubic_lab10']);   
                $this->setUbicacionLaboratorio11($Gestiones['ubic_lab11']);   
                $this->setUbicacionLaboratorio12($Gestiones['ubic_lab12']);   
                $this->setUbicacionLaboratorio13($Gestiones['ubic_lab13']);   
                $this->setUbicacionLaboratorio14($Gestiones['ubic_lab14']);   
                $this->setUbicacionLaboratorio15($Gestiones['ubic_lab15']);  
                $this->setExtensionesUsuarios($Gestiones['extensiones']);    
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // CONSULTA ESPECIFICA DETALLES DE USUARIOS REGISTRADOS [ACCION MODIFICAR PERFIL DE USUARIOS, CONSULTA DE PERFIL DE USUARIOS]
        public function ConsultaEspecificaPerfilUsuarios($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDetallesPerfilUsuarios('" . $IdUsuarios . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setIdRolUsuarios($Gestiones['idrolusuario']);
                $this->setNombresUsuarios($Gestiones['nombres']);
                $this->setApellidosUsuarios($Gestiones['apellidos']);
                $this->setCodigoUnicoUsuarios($Gestiones['codigousuario']);
                $this->setCorreoUsuarios($Gestiones['correo']);
                $this->setFotoPerfilUsuarios($Gestiones['fotoperfil']);
                $this->setUltimoCambio_Contrasenia($Gestiones['ultimo_cambio_contrasenia']);
                $this->setEstadoUsuario($Gestiones['estado_usuario']);
                $this->setFechaRegistro($Gestiones['fecha_registro']);
                $this->setTelefonoPrincipal($Gestiones['telefonoprincipal']);
                $this->setGeneroUsuarios($Gestiones['genero']);
                $this->setFechaNacimiento($Gestiones['fechanacimiento']);
                $this->setEstadoCivil($Gestiones['estadocivil']);
                $this->setLaboratorioAsignadoLab1($Gestiones['lab1']);
                $this->setLaboratorioAsignadoLab2($Gestiones['lab2']);
                $this->setLaboratorioAsignadoLab3($Gestiones['lab3']);
                $this->setLaboratorioAsignadoLab4($Gestiones['lab4']);
                $this->setLaboratorioAsignadoLab5($Gestiones['lab5']);
                $this->setLaboratorioAsignadoLab6($Gestiones['lab6']);
                $this->setLaboratorioAsignadoLab7($Gestiones['lab7']);
                $this->setLaboratorioAsignadoLab8($Gestiones['lab8']);
                $this->setLaboratorioAsignadoLab9($Gestiones['lab9']);
                $this->setLaboratorioAsignadoLab10($Gestiones['lab10']);
                $this->setLaboratorioAsignadoLab11($Gestiones['lab11']);
                $this->setLaboratorioAsignadoLab12($Gestiones['lab12']);
                $this->setLaboratorioAsignadoLab13($Gestiones['lab13']);
                $this->setLaboratorioAsignadoLab14($Gestiones['lab14']);
                $this->setLaboratorioAsignadoLab15($Gestiones['lab15']);
                $this->setUbicacionLaboratorio1($Gestiones['ubic_lab1']);   
                $this->setUbicacionLaboratorio2($Gestiones['ubic_lab2']);   
                $this->setUbicacionLaboratorio3($Gestiones['ubic_lab3']);   
                $this->setUbicacionLaboratorio4($Gestiones['ubic_lab4']);   
                $this->setUbicacionLaboratorio5($Gestiones['ubic_lab5']);   
                $this->setUbicacionLaboratorio6($Gestiones['ubic_lab6']);   
                $this->setUbicacionLaboratorio7($Gestiones['ubic_lab7']);   
                $this->setUbicacionLaboratorio8($Gestiones['ubic_lab8']);   
                $this->setUbicacionLaboratorio9($Gestiones['ubic_lab9']);   
                $this->setUbicacionLaboratorio10($Gestiones['ubic_lab10']);   
                $this->setUbicacionLaboratorio11($Gestiones['ubic_lab11']);   
                $this->setUbicacionLaboratorio12($Gestiones['ubic_lab12']);   
                $this->setUbicacionLaboratorio13($Gestiones['ubic_lab13']);   
                $this->setUbicacionLaboratorio14($Gestiones['ubic_lab14']);   
                $this->setUbicacionLaboratorio15($Gestiones['ubic_lab15']);  
                $this->setExtensionesUsuarios($Gestiones['extensiones']);  
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // MODIFICAR CONFIGURACION CUENTAS USUARIOS -> SIN FOTO DE PERFIL
        public function ModificarPerfilUsuarios_SinFotoPerfil($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CorreoUsuarios, 
        $ContraseniaUsuarios, $UltimoCambio_Contrasenia)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionConfiguracionCuentaUsuarios_SinFotoPerfil('" . $IdUsuarios . "','" . $NombresUsuarios . "','" 
            . $ApellidosUsuarios . "','" . $CorreoUsuarios . "','" . $ContraseniaUsuarios . "','" . $UltimoCambio_Contrasenia . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // MODIFICAR CONFIGURACION CUENTAS USUARIOS -> CON FOTO DE PERFIL
        public function ModificarPerfilUsuarios_ConFotoPerfil($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CorreoUsuarios, $FotoPerfilUsuarios, 
        $ContraseniaUsuarios, $UltimoCambio_Contrasenia)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionConfiguracionCuentaUsuarios_ConFotoPerfil('" . $IdUsuarios . "','" . $NombresUsuarios . "','" 
            . $ApellidosUsuarios . "','" . $CorreoUsuarios . "','" . $FotoPerfilUsuarios . "','" . $ContraseniaUsuarios . "','" . $UltimoCambio_Contrasenia . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // MODIFICAR DETALLES USUARIOS -> PERFIL USUARIOS
        public function ModificarDetallesUsuarios_PerfilUsuarios($conectarsistema, $IdUsuarios, $TelefonoPrincipal, $GeneroUsuarios, $FechaNacimiento, 
        $EstadoCivil)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionDetallesUsuariosMiPerfil('" . $IdUsuarios . "','" . $TelefonoPrincipal . "'
            ,'" . $GeneroUsuarios . "','" . $FechaNacimiento . "','" . $EstadoCivil . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTAR ACCESOS -> PERFIL DE USUARIOS
        public function ConsultarAccesos_PerfilUsuarios($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAccesosUsuarios_PerfilUsuarios('" . $IdUsuarios . "');");
            return $resultado;
        }
        // REGISTRO NUEVOS ROLES DE USUARIO
        public function RegistroNuevosRolesUsuarios($conectarsistema, $NombreRolUsuario, $DescripcionRolUsuario)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevosRolesUsuarios('" . $NombreRolUsuario . "','" . $DescripcionRolUsuario . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // MODIFICAR ROLES DE USUARIO
        public function ModificarRolesUsuarios($conectarsistema, $IdRolUsuario, $NombreRolUsuario, $DescripcionRolUsuario)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ModificarRolesUsuarios('" . $IdRolUsuario . "','" . $NombreRolUsuario . "','" . $DescripcionRolUsuario . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA ESPECIFICA ROLES DE USUARIOS REGISTRADOS [ACCION MODIFICAR DATOS]
        public function ConsultaEspecificaRolesUsuariosRegistrados_ModificarDatos($conectarsistema, $IdRolUsuario)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaRolesUsuariosRegistrados('" . $IdRolUsuario . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdRolUsuario($Gestiones['idrolusuario']);
                $this->setNombreRolUsuario($Gestiones['nombrerolusuario']);
                $this->setDescripcionRolUsuario($Gestiones['descripcionrolusuario']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // REGISTRO NUEVAS CLASIFICACIONES NOTIFICACIONES
        public function RegistroNuevasClasificacionesNotificaciones($conectarsistema, $CodigoClasificacionNotificaciones, $DescripcionClasificacionNotificaciones)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevasClasificacionesNotificaciones('" . $CodigoClasificacionNotificaciones . "','" . $DescripcionClasificacionNotificaciones . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA COMPLETA CLASIFICACIONES DE NOTIFICACIONES
        public function ConsultarClasificacionesNotificaciones($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaClasificacionesNotificaciones()");
            return $resultado;
        }
        // CONSULTA ESPECIFICA CLASIFICACIONES DE NOTIFICACIONES [ACCION MODIFICAR DATOS]
        public function ConsultaEspecificaClasificacionesNotificaciones_ModificarDatos($conectarsistema, $IdClasificacionNotificaciones)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaClasificacionNotificaciones('" . $IdClasificacionNotificaciones . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdClasificacionNotificaciones($Gestiones['idclasificacion']);
                $this->setCodigoClasificacionNotificaciones($Gestiones['codigoclasificacion']);
                $this->setDescripcionClasificacionNotificaciones($Gestiones['descripcionclasificacion']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // MODIFICAR CLASIFICACIONES NOTIFICACIONES
        public function ModificarClasificacionesNotificaciones($conectarsistema, $IdClasificacionNotificaciones, $CodigoClasificacionNotificaciones, $DescripcionClasificacionNotificaciones)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ModificarDatosClasificacionesNotificaciones('" . $IdClasificacionNotificaciones . "','" . $CodigoClasificacionNotificaciones . "','" . $DescripcionClasificacionNotificaciones . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // REGISTRO / ENVIO NUEVOS MENSAJES -> MENSAJERIA INTERNA SISTEMA [SIN ARCHIVO ADJUNTO]
        public function EnvioNuevosMensajes_SistemaMensajeria($conectarsistema, $IdUsuarios, $NombreMensaje, $AsuntoMensaje, $DetalleMensaje, $IdUsuarioDestinatario)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevosMensajesSinArchivoAdjunto('" . $IdUsuarios . "','" . $NombreMensaje . "','" . $AsuntoMensaje . "','" . $DetalleMensaje . "','" . $IdUsuarioDestinatario . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // REGISTRO / ENVIO NUEVOS MENSAJES -> MENSAJERIA INTERNA SISTEMA [CON ARCHIVO ADJUNTO]
        public function EnvioNuevosMensajesArchivoAdjunto_SistemaMensajeria($conectarsistema, $IdUsuarios, $NombreMensaje, $AsuntoMensaje, $DetalleMensaje, $IdUsuarioDestinatario, $ArchivoAdjunto)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevosMensajesConArchivoAdjunto('" . $IdUsuarios . "','" . $NombreMensaje . "','" . $AsuntoMensaje . "','" . $DetalleMensaje . "','" . $IdUsuarioDestinatario . "','" . $ArchivoAdjunto . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA BANDEJA DE ENTRADA -> SISTEMA MENSAJERIA [GENERAL]
        public function ConsultarMensajesBandejaEntradaUsuarios($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaBandejaEntrada_MensajeriaUsuarios('" . $IdUsuarios . "');");
            return $resultado;
        }
        // CONSULTA BANDEJA DE ENTRADA -> SISTEMA MENSAJERIA [MENSAJES OCULTOS]
        public function ConsultarMensajesBandejaEntradaUsuarios_MensajesOcultos($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaBandejaEntrada_MensajesOcultos('" . $IdUsuarios . "');");
            return $resultado;
        }
        // CONSULTA ESPECIFICA DETALLES MENSAJES RECIBIDOS [ACCION LECTURA MENSAJERIA]
        public function ConsultaEspecificaDetallesMensajesRecibidos($conectarsistema, $IdUsuarios, $IdMensajeria)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDetallesMensajesRecibidos('" . $IdUsuarios . "','" . $IdMensajeria . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdMensajeria($Gestiones['idmensajeria']);
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setIdUsuarioDestinatario($Gestiones['idusuarios_destinatario']);
                $this->setNombresUsuarios($Gestiones['nombres']);
                $this->setApellidosUsuarios($Gestiones['apellidos']);
                $this->setFotoPerfilUsuarios($Gestiones['fotoperfil']);
                $this->setNombreMensaje($Gestiones['nombremensaje']);
                $this->setAsuntoMensaje($Gestiones['asuntomensaje']);
                $this->setDetalleMensaje($Gestiones['detallemensaje']);
                $this->setFechaMensaje($Gestiones['fechamensaje']);
                $this->setEstadoMensajeLeido($Gestiones['mensajeleido']);
                $this->setArchivoAdjunto($Gestiones['archivo_adjunto']);
                $this->setEstadoOcultarMensaje($Gestiones['ocultarmensaje']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // OCULTAR MENSAJES -> SISTEMA MENSAJERIA USUARIOS
        public function OcultarMensajesRecibidos($conectarsistema, $IdMensajeria)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_OcultarMensajesUsuarios('" . $IdMensajeria . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // MARCAR COMO LEIDO MENSAJES -> SISTEMA MENSAJERIA USUARIOS
        public function MarcarComoLeidoMensajesRecibidos($conectarsistema, $IdMensajeria)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_MarcarComoLeidoMensajeria('" . $IdMensajeria . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // LISTADO DE TODAS LAS NOTIFICACIONES RECIBIDAS, ORDENADAS SEGUN FECHA DE REGISTRO DE MANERA DESCENDENTE Y LIMITADO A 100 REGISTROS
        public function ListadoNotificacionesRecibidas_Completo($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ListadoMisNotificacionesRecibidas('" . $IdUsuarios . "');");
            return $resultado;
        }
        // LISTADO DE TODAS LAS NOTIFICACIONES RECIBIDAS, ORDENADAS SEGUN FECHA DE REGISTRO DE MANERA DESCENDENTE Y LIMITADO A 6 REGISTROS
        public function ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ListadoMisNotificacionesRecibidasRecortado('" . $IdUsuarios . "');");
            return $resultado;
        }
        // LISTADO DE TODOS LOS MENSAJES RECIBIDOS, ORDENADAS SEGUN FECHA DE REGISTRO DE MANERA DESCENDENTE Y LIMITADO A 6 REGISTROS
        public function ListadoMensajesRecibidos_Recortado($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ListadoMensajesRecibidosRecortado('" . $IdUsuarios . "');");
            return $resultado;
        }
        // OCULTAR NOTIFICACIONES RECIBIDAS
        public function OcultarNotificacionesUsuarios($conectarsistema, $IdNotificacionUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_OcultarNotificacionesUsuarios('" . $IdNotificacionUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // REGISTRO PROBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA]
        public function RegistroProblemasPlataforma($conectarsistema, $IdUsuarios, $NombreReporte, $DescripcionReporte, $FotoReporte)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroReportesProblemasPlataforma('" . $IdUsuarios . "','" . $NombreReporte . "',
            '" . $DescripcionReporte . "','" . $FotoReporte . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // LISTADO DE TODOS LOS REPORTES PROBLEMAS PLATAFORMA REGISTRADOS [MANIFIESTOS PLATAFORMA]
        public function ConsultaProblemaPlataformasRegistrados_ConsultaGeneral($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaProblemasPlataformaRegistrados();");
            return $resultado;
        }
        // CONTEO POR ESTADO DE TODOS LOS REPORTES PROBLEMAS PLATAFORMA REGISTRADOS [MANIFIESTOS PLATAFORMA]
        public function ConteoPorEstado_ProblemasPlataforma($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConteoEstadosReportesProblemasPlataforma();");
            return $resultado;
        }
        // CONSULTA ESPECIFICA USUARIOS REGISTRADOS [ACCION MODIFICAR DATOS]
        public function ConsultaEspecificaManifiestosPlataforma_GestionarReportes($conectarsistema, $IdManifiesto)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaReporteProblemasPlataforma('" . $IdManifiesto . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdManifiesto($Gestiones['idmanifiesto']);
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setNombresUsuarios($Gestiones['nombres']);
                $this->setApellidosUsuarios($Gestiones['apellidos']);
                $this->setCodigoUnicoUsuarios($Gestiones['codigousuario']);
                $this->setNombreManifiesto($Gestiones['nombremanifiesto']);
                $this->setDescripcionManifiesto($Gestiones['descripcionmanifiesto']);
                $this->setFotoManifiesto($Gestiones['fotomanifiesto']);
                $this->setFechaRegistroManifiesto($Gestiones['fecharegistro']);
                $this->setFechaActualizacionManifiesto($Gestiones['fecha_actualizacion']);
                $this->setEstadoManifiesto($Gestiones['estado']);
                $this->setComentarioActualizacionManifiesto($Gestiones['comentario_actualizacion']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // ACTUALIZACION PROBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA]
        public function ActualizacionProblemasPlataforma($conectarsistema, $IdManifiesto, $EstadoManifiesto, $ComentarioActualizacionManifiesto)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionReportesProblemasPlataforma('" . $IdManifiesto . "','" . $EstadoManifiesto . "',
            '" . $ComentarioActualizacionManifiesto . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // REGISTRO NUEVOS LABORATORIOS INFORMATICA
        public function RegistroNuevosLaboratoriosInformatica($conectarsistema, $CodigoLaboratorio, $NombreLaboratorio, $CapacidadLaboratorio, $CodigoColorLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevosLaboratoriosInformatica('" . $CodigoLaboratorio . "','" . $NombreLaboratorio . "',
            '" . $CapacidadLaboratorio . "','" . $CodigoColorLaboratorio . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // LISTADO DE TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [SIN FILTROS]
        public function ConsultaLaboratoriosInformaticaRegistrados_ConsultaGeneral($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaGeneralLaboratoriosInformaticaRegistrados();");
            return $resultado;
        }
        // LISTADO DE TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [INACTIVOS]
        public function ConsultaLaboratoriosInformaticaRegistrados_Inactivos($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaGeneralLaboratoriosInformaticaRegistradosInactivos();");
            return $resultado;
        }
        // CONSULTA ESPECIFICA LABORATORIOS DE INFORMATICA REGISTRADOS [ACCION MODIFICAR DATOS]
        public function ConsultaEspecificaLaboratoriosInformatica($conectarsistema, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaLaboratoriosInformaticaRegistrados('" . $IdLaboratorio . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdLaboratorio($Gestiones['idlaboratorio']);
                $this->setCodigoLaboratorio($Gestiones['codigolaboratorio']);
                $this->setNombreLaboratorio($Gestiones['nombrelaboratorio']);
                $this->setCapacidadMaximaLaboratorio($Gestiones['capacidadlaboratorio']);
                $this->setEquiposFueraUsoLaboratorio($Gestiones['maquinasfuerauso']);
                $this->setEstadoLaboratorio($Gestiones['estadolaboratorio']);
                $this->setCodigoColorLaboratorio($Gestiones['codigocolor']);
                
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // ACTUALIZACION DATOS LABORATORIOS INFORMATICA
        public function ActualizacionDatosLaboratoriosInformatica($conectarsistema, $IdLaboratorio, $CodigoLaboratorio, $NombreLaboratorio, 
        $CapacidadLaboratorio, $EquiposFueraUsoLaboratorio, $EstadoLaboratorio, $CodigoColorLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionDatosGestionLaboratoriosInformatica('" . $IdLaboratorio . "','" . $CodigoLaboratorio . "','" . $NombreLaboratorio . "',
            '" . $CapacidadLaboratorio . "','" . $EquiposFueraUsoLaboratorio . "','" . $EstadoLaboratorio . "','" . $CodigoColorLaboratorio . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // ACTUALIZACION DATOS LABORATORIOS INFORMATICA
        public function ActualizacionDatosLaboratoriosInformaticaAdminLabs($conectarsistema, $IdLaboratorio, $CapacidadLaboratorio, $EquiposFueraUsoLaboratorio, $EstadoLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionDatosGestionLaboratoriosInformaticaAdminLabs('" . $IdLaboratorio . "','" . $CapacidadLaboratorio . "','" . $EquiposFueraUsoLaboratorio . "',
            '" . $EstadoLaboratorio . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA COMPLETA CLASIFICACION TIPO APLICACIONES LABORATORIOS
        public function ConsultaGeneralClasificacionAplicacionesLaboratorios($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarClasificacionesAplicacionesLaboratorio()");
            return $resultado;
        }
        // REGISTRO NUEVAS APLICACIONES LABORATORIOS INFORMATICA
        public function RegistroAplicacionesLaboratoriosInformatica($conectarsistema, $CodigoAplicaciones, $NombreAplicaciones, $Laboratorio1, $Laboratorio2, $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, 
        $Laboratorio7, $Laboratorio8, $Laboratorio9, $Laboratorio10, $Laboratorio11, $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15, $IdClasificacionAplicacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevasAplicacionesLaboratoriosInformatica('" . $CodigoAplicaciones . "','" . $NombreAplicaciones . "',
            '" . $Laboratorio1 . "','" . $Laboratorio2 . "','" . $Laboratorio3 . "','" . $Laboratorio4 . "','" . $Laboratorio5 . "','" . $Laboratorio6 . "','" . $Laboratorio7 . "',
            '" . $Laboratorio8 . "','" . $Laboratorio9 . "','" . $Laboratorio10 . "','" . $Laboratorio11 . "','" . $Laboratorio12 . "','" . $Laboratorio13 . "','" . $Laboratorio14 . "',
            '" . $Laboratorio15 . "','" . $IdClasificacionAplicacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [TODOS LOS LABORATORIOS]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorios($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaGeneralAplicacionesLaboratorios()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 1]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio1()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 2]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio2($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio2()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 3]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio3($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio3()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 4]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio4($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio4()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 5]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio5($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio5()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 6]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio6($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio6()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 7]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio7($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio7()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 8]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio8($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio8()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 9]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio9($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio9()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 10]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio10($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio10()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 11]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio11($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio11()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 12]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio12($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio12()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 13]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio13($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio13()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 14]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio14($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio14()");
            return $resultado;
        }
        // CONSULTA COMPLETA TODAS LAS APLICACIONES INSTALADAS [LABORATORIO 15]
        public function ConsultaGeneralAplicacionesInstaladasLaboratorio15($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaAplicacionesInstaladasLaboratorio15()");
            return $resultado;
        }
        // CONSULTA ESPECIFICA TODAS LAS APLICACIONES INSTALADAS [TODOS LOS LABORATORIOS] [ACCION MODIFICAR DATOS]
        public function ConsultaEspecificaAplicacionesLaboratoriosInformatica($conectarsistema, $IdAplicacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaGestionAplicacionesLaboratorios('" . $IdAplicacion . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdAplicacion($Gestiones['idaplicacion']);
                $this->setCodigoAplicacion($Gestiones['codigoaplicacion']);
                $this->setNombreAplicacion($Gestiones['nombreaplicacion']);
                $this->setLaboratorio1($Gestiones['lab1']);
                $this->setLaboratorio2($Gestiones['lab2']);
                $this->setLaboratorio3($Gestiones['lab3']);
                $this->setLaboratorio4($Gestiones['lab4']);
                $this->setLaboratorio5($Gestiones['lab5']);
                $this->setLaboratorio6($Gestiones['lab6']);
                $this->setLaboratorio7($Gestiones['lab7']);
                $this->setLaboratorio8($Gestiones['lab8']);
                $this->setLaboratorio9($Gestiones['lab9']);
                $this->setLaboratorio10($Gestiones['lab10']);
                $this->setLaboratorio11($Gestiones['lab11']);
                $this->setLaboratorio12($Gestiones['lab12']);
                $this->setLaboratorio13($Gestiones['lab13']);
                $this->setLaboratorio14($Gestiones['lab14']);
                $this->setLaboratorio15($Gestiones['lab15']);
                $this->setIdClasificacionAplicacion($Gestiones['idclasificacionlaboratorio']);
                $this->setCodigoClasificacionAplicacion($Gestiones['codigoclasificacionlaboratorio']);
                $this->setFechaRegistroAplicacion($Gestiones['fecharegistro']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // MODIFICAR APLICACIONES LABORATORIOS INFORMATICA
        public function ModificarAplicacionesLaboratoriosInformatica($conectarsistema, $IdAplicacion, $CodigoAplicaciones, $NombreAplicaciones, $Laboratorio1, $Laboratorio2, $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, 
        $Laboratorio7, $Laboratorio8, $Laboratorio9, $Laboratorio10, $Laboratorio11, $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15, $IdClasificacionAplicacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ModificarAplicacionesRegistradasLaboratorios('" . $IdAplicacion . "','" . $CodigoAplicaciones . "','" . $NombreAplicaciones . "',
            '" . $Laboratorio1 . "','" . $Laboratorio2 . "','" . $Laboratorio3 . "','" . $Laboratorio4 . "','" . $Laboratorio5 . "','" . $Laboratorio6 . "','" . $Laboratorio7 . "',
            '" . $Laboratorio8 . "','" . $Laboratorio9 . "','" . $Laboratorio10 . "','" . $Laboratorio11 . "','" . $Laboratorio12 . "','" . $Laboratorio13 . "','" . $Laboratorio14 . "',
            '" . $Laboratorio15 . "','" . $IdClasificacionAplicacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // LISTADO DE TODOS LOS LABORATORIOS DE INFORMATICA ASIGNADOS A USUARIOS [ADMINISTRADORES DE LABORATORIOS]
        public function ConsultarLaboratoriosAsignadosUsuarios($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaLaboratoriosAsignadosUsuarios();");
            return $resultado;
        }
        // REGISTRO NUEVOS TIPOS DE RESERVACIONES
        public function RegistroNuevosTiposReservaciones($conectarsistema, $NombreTipoReservacion, $DescripcionTipoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevosTiposReservaciones('" . $NombreTipoReservacion . "','" . $DescripcionTipoReservacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA COMPLETA LISTADO TIPOS DE RESERVACIONES
        public function ConsultaGeneralTiposReservaciones($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaListadoTiposRerservaciones()");
            return $resultado;
        }
        // CONSULTA ESPECIFICA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS [ACCION MODIFICAR DATOS]
        public function ConsultaEspecificaTiposReservaciones($conectarsistema, $IdTipoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaTiposReservaciones('" . $IdTipoReservacion . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdTipoReservacion($Gestiones['idtiporeservacion']);
                $this->setNombreTipoReservacion($Gestiones['tiporeservacion']);
                $this->setDescripcionTipoReservacion($Gestiones['descripciontiporeservacion']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // REGISTRO NUEVOS TIPOS DE RESERVACIONES
        public function ModificarTiposReservaciones($conectarsistema, $IdTipoReservacion, $NombreTipoReservacion, $DescripcionTipoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ModificarTiposReservaciones('" . $IdTipoReservacion . "','" . $NombreTipoReservacion . "','" . $DescripcionTipoReservacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }     
        // LISTADO TODAS LAS APLICACIONES REGISTRADAS [LABORATORIOS INFORMATICA -> INICIO PROCESO RESERVACIONES]
        public function ListadoAplicacionesReservaciones($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ListadoAplicacionesReservaciones()");
            return $resultado;
        }
        // LISTADO TODOS LOS LABORATORIOS DISPONIBLES [RESERVACIONES]
        public function ListadoInformacionLaboratoriosReservaciones($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaInformacionLaboratoriosReservaciones()");
            return $resultado;
        } 
        /******************************
         * -> SIN MODULOS
         *****************************/
        // GESTIONAR OFERTAS A OFRECER, SEGUN PARAMETROS INGRESADOS POR USUARIOS [RESERVACIONES] -> TODOS LOS LABORATORIOS SIN INCLUIR MODULOS
        public function OfertaDisponibleReservacionesLaboratorios($conectarsistema, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
        $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDisponibilidadReservaciones('" . $AplicacionReservacion . "','" . $NumeroUsuariosReservacion . "'
            ,'" . $FechaInicioReservacion . "','" . $FechaFinReservacion . "','" . $HoraInicioReservacion . "','" . $HoraFinReservacion . "');");
            return $resultado;
        }
        /*************************************************************************************************************************
         * -> CON MODULOS, ACA SOLO SE MUESTRAN LOS LABORATORIOS QUE POSEEN MODULOS, E IMPRIME SI ESE MODULO TIENE DISPONIBILIDAD
         *************************************************************************************************************************/
        // GESTIONAR OFERTAS A OFRECER, SEGUN PARAMETROS INGRESADOS POR USUARIOS [RESERVACIONES] -> TODOS LOS LABORATORIOS SIN INCLUIR MODULOS
        public function OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion,
        $AplicacionReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDisponibilidadModulosLaboratorios('" . $FechaInicioReservacion . "','" . $FechaFinReservacion . "'
            ,'" . $HoraInicioReservacion . "','" . $HoraFinReservacion . "','" . $AplicacionReservacion . "');");
            return $resultado;
        }
        // GESTIONAR OFERTAS A OFRECER, SEGUN PARAMETROS INGRESADOS POR USUARIOS [RESERVACIONES PRACTICAS LIBRES]
        public function OfertaDisponibleReservacionesLaboratoriosPracticasLibres($conectarsistema, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
        $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDisponibilidadReservacionesPracticasLibres('" . $AplicacionReservacion . "','" . $NumeroUsuariosReservacion . "'
            ,'" . $FechaInicioReservacion . "','" . $FechaFinReservacion . "','" . $HoraInicioReservacion . "','" . $HoraFinReservacion . "');");
            return $resultado;
        }
        // LISTADO DE TODAS LAS FACULTADES REGISTRADAS [RESERVACIONES]
        public function ConsultarFacultadesRegistradas($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaListadoFacultades();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS [RESERVACIONES]
        public function ConsultarEscuelasFacultadesRegistradas($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaListadoEscuelas();");
            return $resultado;
        }
        // REGISTRAR NUEVAS RESERVACIONES DE LABORATORIOS DE INFORMATICA [TODOS]
        public function RegistroNuevasReservacionesLaboratorios($conectarsistema, $IdUsuarios, $IdFacultad, $IdEscuela, $IdLaboratorio, $IdAplicacion, $IdTipoReservacion,$IdentificadorUnicoReservacion,
        $CodigoReservacion, $CicloActual, $NombreReservacion, $SeccionReservacion, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion, 
        $NumeroUsuariosReservacion, $OtroTipoReservacion, $Modulo1, $Modulo2, $Modulo3, $Modulo4, $TitularReservacion, $AulaProcedenciaReservacion)
        {
            // REGISTRO DE RESERVACIONES CONTINUAS HASTA LLENAR ESPACIO DE LABORATORIOS QUE POSEEN MODULOS
            if($IdLaboratorio == 3 || $IdLaboratorio == 8 || $IdLaboratorio == 14){ 
                $HorarioExiste = mysqli_query($conectarsistema, "CALL sp_ConsultaValidacionDuplicadosNuevasReservaciones('" . $IdLaboratorio . "','" . $FechaInicioReservacion . "'
                ,'" . $FechaFinReservacion . "','" . $HoraInicioReservacion . "','" . $HoraFinReservacion . "');");
                // RECUPERAR DATOS DE PRIMERA CONSULTA, Y PASAR A EJECUTAR SEGUNDA CONSULTA
                while (mysqli_more_results($conectarsistema) && mysqli_next_result($conectarsistema)) {
                    mysqli_store_result($conectarsistema);
                }
                if (mysqli_num_rows($HorarioExiste) > 0) {
                    $filas = mysqli_fetch_assoc($HorarioExiste);
                    /* -> EFECTOS DE DEPURACION <-
                    echo "Modulo 1: ".$filas['mod1_cero']."<br>";
                    echo "Modulo 2: ".$filas['mod2_cero']."<br>";
                    echo "Modulo 3: ".$filas['mod3_cero']."<br>";
                    echo "Modulo 4: ".$filas['mod4_cero']."<br>";*/
                    if ($filas["mod1_cero"] == 0 || $filas["mod2_cero"] == 0 || $filas["mod3_cero"] == 0 || $filas["mod4_cero"] == 0) {
                        $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevasReservacionesLaborarorios('" . $IdUsuarios . "','" . $IdFacultad . "'
                        ,'" . $IdEscuela . "','" . $IdLaboratorio . "','" . $IdAplicacion . "','" . $IdTipoReservacion . "','" . $IdentificadorUnicoReservacion . "','" . $CodigoReservacion . "'
                        ,'" . $CicloActual . "','" . $NombreReservacion . "','" . $SeccionReservacion . "','" . $FechaInicioReservacion . "','" . $FechaFinReservacion . "'
                        ,'" . $HoraInicioReservacion . "','" . $HoraFinReservacion . "','" . $NumeroUsuariosReservacion . "','" . $OtroTipoReservacion . "','" . $Modulo1 . "','" . $Modulo2 . "'
                        ,'" . $Modulo3 . "','" . $Modulo4 . "','" . $TitularReservacion . "','" . $AulaProcedenciaReservacion . "');");
                        if ($resultado) {
                            return "OK";
                        } else {
                            return "ERROR";
                        }
                    } else {
                        return "No se puede realizar la inserción ya que no hay módulos disponibles.";
                    }
                }
            // RESERVACIONES SIMPLES EN LABORATORIOS QUE NO POSEEN MODULOS
            }else{
                // VALIDACION SI AL MENOS UNO DE LOS REGISTROS YA EXISTEN, NO REGISTRAR EN BASE DE DATOS
                $HorarioExiste = mysqli_query($conectarsistema, "CALL sp_ConsultaValidacionDuplicadosNuevasReservacionesSinModulos('" . $IdLaboratorio . "','" . $FechaInicioReservacion . "'
                ,'" . $FechaFinReservacion . "','" . $HoraInicioReservacion . "','" . $HoraFinReservacion . "');");
                // RECUPERAR DATOS DE PRIMERA CONSULTA, Y PASAR A EJECUTAR SEGUNDA CONSULTA
                while (mysqli_more_results($conectarsistema) && mysqli_next_result($conectarsistema)) {
                    mysqli_store_result($conectarsistema);
                }
                if(mysqli_num_rows($HorarioExiste) > 0) {
                    return "Ya existe una reservación en el laboratorio ".$IdLaboratorio." en los horarios que has ingresado. Actualiza la página para nuevos resultados";
                }else{
                    $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevasReservacionesLaborarorios('" . $IdUsuarios . "','" . $IdFacultad . "'
                    ,'" . $IdEscuela . "','" . $IdLaboratorio . "','" . $IdAplicacion . "','" . $IdTipoReservacion . "','" . $IdentificadorUnicoReservacion . "','" . $CodigoReservacion . "'
                    ,'" . $CicloActual . "','" . $NombreReservacion . "','" . $SeccionReservacion . "','" . $FechaInicioReservacion . "','" . $FechaFinReservacion . "'
                    ,'" . $HoraInicioReservacion . "','" . $HoraFinReservacion . "','" . $NumeroUsuariosReservacion . "','" . $OtroTipoReservacion . "','" . $Modulo1 . "','" . $Modulo2 . "'
                    ,'" . $Modulo3 . "','" . $Modulo4 . "','" . $TitularReservacion . "','" . $AulaProcedenciaReservacion . "');");
                    if ($resultado) {
                        return "OK";
                    } else {
                        return "ERROR";
                    }
                }
            }
        }
        // REGISTRAR NUEVAS PRACTICAS LIBRES LABORATORIOS DE INFORMATICA [TODOS]
        public function RegistroNuevasPracticasLibresLaboratorios($conectarsistema, $IdAplicacion, $IdTipoReservacion, $IdLaboratorio, $IdFacultad, $IdUsuarios, 
        $NombreUsuarioReservacion, $CarneUsuarioReservacion, $FechaInicioReservacion, $HoraInicioReservacion, $CicloActual)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroNuevasPracticasLibres('" . $IdAplicacion . "','" . $IdTipoReservacion . "'
            ,'" . $IdLaboratorio . "','" . $IdFacultad . "','" . $IdUsuarios . "','" . $NombreUsuarioReservacion . "','" . $CarneUsuarioReservacion . "','" . $FechaInicioReservacion . "'
            ,'" . $HoraInicioReservacion . "','" . $CicloActual . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
                }
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO ACTIVA
        public function ListadoPracticasLibresActivas($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaGeneralPracticasLibresActivas()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [TODOS LOS LABORATORIOS]
        public function ListadoPracticasLibresFinalizadas($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaGeneralPracticasLibresFinalizadas()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 1]
        public function ListadoPracticasLibresFinalizadasLab1($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab1()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 2]
        public function ListadoPracticasLibresFinalizadasLab2($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab2()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 3]
        public function ListadoPracticasLibresFinalizadasLab3($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab3()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 4]
        public function ListadoPracticasLibresFinalizadasLab4($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab4()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 5]
        public function ListadoPracticasLibresFinalizadasLab5($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab5()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 6]
        public function ListadoPracticasLibresFinalizadasLab6($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab6()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 7]
        public function ListadoPracticasLibresFinalizadasLab7($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab7()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 8]
        public function ListadoPracticasLibresFinalizadasLab8($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab8()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 9]
        public function ListadoPracticasLibresFinalizadasLab9($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab9()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 10]
        public function ListadoPracticasLibresFinalizadasLab10($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab10()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 11]
        public function ListadoPracticasLibresFinalizadasLab11($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab11()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 12]
        public function ListadoPracticasLibresFinalizadasLab12($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab12()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 13]
        public function ListadoPracticasLibresFinalizadasLab13($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab13()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 14]
        public function ListadoPracticasLibresFinalizadasLab14($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab14()");
            return $resultado;
        }
        // LISTADO TODAS LAS PRACTICAS LIBRES PROCESADAS CON ESTADO FINALIZADAS [LABORATORIO 15]
        public function ListadoPracticasLibresFinalizadasLab15($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaPracticasLibresFinalizadasLab15()");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES GENERAL]
        public function ConsultarCalendarioActividadesGeneral($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesGeneral();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 1]
        public function ConsultarCalendarioActividadesLaboratorio1($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio1();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 2]
        public function ConsultarCalendarioActividadesLaboratorio2($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio2();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 3]
        public function ConsultarCalendarioActividadesLaboratorio3($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio3();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 4]
        public function ConsultarCalendarioActividadesLaboratorio4($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio4();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 5]
        public function ConsultarCalendarioActividadesLaboratorio5($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio5();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 6]
        public function ConsultarCalendarioActividadesLaboratorio6($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio6();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 7]
        public function ConsultarCalendarioActividadesLaboratorio7($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio7();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 8]
        public function ConsultarCalendarioActividadesLaboratorio8($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio8();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 9]
        public function ConsultarCalendarioActividadesLaboratorio9($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio9();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 10]
        public function ConsultarCalendarioActividadesLaboratorio10($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio10();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 11]
        public function ConsultarCalendarioActividadesLaboratorio11($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio11();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 12]
        public function ConsultarCalendarioActividadesLaboratorio12($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio12();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 13]
        public function ConsultarCalendarioActividadesLaboratorio13($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio13();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 14]
        public function ConsultarCalendarioActividadesLaboratorio14($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio14();");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES LABORATORIO 15]
        public function ConsultarCalendarioActividadesLaboratorio15($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesLaboratorio15();");
            return $resultado;
        }
        // CONSULTAR PROXIMAS ACTIVIDADES A REALIZARCE [TODOS LOS LABORATORIOS]
        public function ConsultarProximasActividadesLaboratorios($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaProximasActividadesLaboratorios();");
            return $resultado;
        }
        // CONSULTAR CORREO DE USUARIOS ASIGNADOS A ESE LABORATORIO ELEGIDO EN RESERVACION
        public function CosultarCorreoUsuariosReservaciones($conectarsistema, $Laboratorio1, $Laboratorio2, $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, $Laboratorio7,
        $Laboratorio8, $Laboratorio9, $Laboratorio10, $Laboratorio11, $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarCorreoContactoUsuariosReservaciones('" . $Laboratorio1 . "','" . $Laboratorio2 . "','" . $Laboratorio3 . "','" . $Laboratorio4 . "','" . $Laboratorio5 . "','" . $Laboratorio6 . "','" . $Laboratorio7 . "',
            '" . $Laboratorio8 . "','" . $Laboratorio9 . "','" . $Laboratorio10 . "','" . $Laboratorio11 . "','" . $Laboratorio12 . "','" . $Laboratorio13 . "','" . $Laboratorio14 . "',
            '" . $Laboratorio15 . "');");
            return $resultado;
        }
        // CONSULTAR DATOS DE APLICACION A UTILIZAR -> ENVIO DE CORREO AUTOMATICO NUEVAS RESERVACIONES
        // CONSULTAR PROXIMAS ACTIVIDADES A REALIZARCE [TODOS LOS LABORATORIOS]
        public function ConsultarDatosAplicaciones_NuevasReservacionesCorreo($conectarsistema, $IdAplicacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDatosAplicacionesNuevasReservaciones_CorreoAutomatico('" . $IdAplicacion . "');");
            return $resultado;
        }
        // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS [FILTRADO ESTADO PENDIENTE]
        public function ConsultarReservacionesPendientes($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesRegistradasPendientes();");
            return $resultado;
        }
        // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS [FILTRADO ESTADO APROBACION INICIAL]
        public function ConsultarReservacionesAprobacionInicial($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesRegistradasAprobacionInicial();");
            return $resultado;
        }
        // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS [FILTRADO ESTADO APROBADAS]
        public function ConsultarReservacionesAprobadas($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesRegistradasAprobadas();");
            return $resultado;
        }
        // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS [FILTRADO ESTADO APROBADAS]
        public function ConsultarReservacionesDenegadas($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesRegistradasDenegadas();");
            return $resultado;
        }
        // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS [FILTRADO ESTADO CANCELADAS]
        public function ConsultarReservacionesCanceladas($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesRegistradasCanceladas();");
            return $resultado;
        }
        // CONSULTAR DETALLE DE TODAS LAS RESERVACIONES REGISTRADAS [PRIMERA TABLA DE DETALLES DE DIAS RESERVADOS]
        public function ConsultarDetallesReservacionesPendientes($conectarsistema, $IdentificadorUnicoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDetallesReservacionesPendientes('" . $IdentificadorUnicoReservacion . "');");
            return $resultado;
        }
        // CONSULTAR DETALLE DE TODAS LAS RESERVACIONES REGISTRADAS [PRIMERA TABLA DE DETALLES DE DIAS RESERVADOS]
        public function ConsultarDetallesReservacionesAprobadasGestion($conectarsistema, $IdentificadorUnicoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDetallesReservacionesAprobadasGestion('" . $IdentificadorUnicoReservacion . "');");
            return $resultado;
        }
        // CONSULTAR DETALLE DE TODAS LAS RESERVACIONES REGISTRADAS [PRIMERA TABLA DE DETALLES DE DIAS RESERVADOS] -> MIS RESERVACIONES
        public function ConsultarDetallesMisReservacionesProcesadas($conectarsistema, $IdUsuarios, $IdentificadorUnicoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarDetallesMisReservaciones('" . $IdUsuarios . "','" . $IdentificadorUnicoReservacion . "');");
            return $resultado;
        }
        // CONSULTAR DETALLE DE TODAS LAS RESERVACIONES APROBADAS SEGUN FILTRO DE FECHA INICIO, FIN Y LABORATORIO [SEGUNDA TABLA DE DETALLES DE DIAS RESERVADOS]
        public function ConsultarDetallesReservacionesAprobadas($conectarsistema, $FechaInicioReservacion, $FechaFinReservacion, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarReservacionesAprobadas_GestionReservaciones('" . $FechaInicioReservacion . "','" . $FechaFinReservacion . "','" . $IdLaboratorio . "');");
            return $resultado;
        }
        // LISTADO DE TODAS LAS RESERVACIONES APROBADAS [CALENDARIO DE ACTIVIDADES GENERAL]
        public function ConsultarCalendarioActividadesGestionReservaciones($conectarsistema, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCalendarioActividadesGestionReservaciones('" . $IdLaboratorio . "');");
            return $resultado;
        }
        // CONSULTA ESPECIFICA TODAS LAS RESERVACIONES REGISTRADAS [TODOS LOS LABORATORIOS] [ACCION GESTIONAR RESERVACIONES]
        public function ConsultaEspecificaGestionarReservaciones($conectarsistema, $IdentificadorUnicoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaGestionarReservaciones('" . $IdentificadorUnicoReservacion . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdReservacion($Gestiones['idreservacion']);
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setIdLaboratorio($Gestiones['idlaboratorio']);
                $this->setCapacidadMaximaLaboratorio($Gestiones['capacidadlaboratorio']);
                $this->setEquiposFueraUsoLaboratorio($Gestiones['maquinasfuerauso']);
                $this->setIdTipoReservacion($Gestiones['idtiporeservacion']);
                $this->setNombresUsuarios($Gestiones['nombres']);
                $this->setApellidosUsuarios($Gestiones['apellidos']);
                $this->setCodigoUnicoUsuarios($Gestiones['codigousuario']);
                $this->setNombreTipoReservacion($Gestiones['tiporeservacion']);
                $this->setCodigoUnicoIdentificadorReservacion($Gestiones['codigounico_identificador']);
                $this->setCodigoReservacion($Gestiones['codigoreservacion']);
                $this->setCicloReservacion($Gestiones['ciclo']);
                $this->setNombreReservacion($Gestiones['nombrereservacion']);
                $this->setSeccionReservacion($Gestiones['seccionreservacion']);
                $this->setFechaInicioReservacion($Gestiones['fechainicioreservacion']);
                $this->setFechaFinReservacion($Gestiones['fechafinreservacion']);
                $this->setHoraInicioReservacion($Gestiones['horainicioreservacion']);
                $this->setHoraFinReservacion($Gestiones['horafinreservacion']);
                $this->setCantidadUsuariosReservacion($Gestiones['numerousuarios']);
                $this->setOtroTipoReservacion($Gestiones['otrotipo_reservacion']);
                $this->setComentarioAdministradorLaboratorioReservacion($Gestiones['comentario_adminlaboratorios']);
                $this->setComentarioCoordinadorLaboratorioReservacion($Gestiones['comentario_coordlaboratorio']);
                $this->setEstadoReservacion($Gestiones['estadoreservacion']);
                $this->setEstadoFinalizadoReservacion($Gestiones['finalizado']);
                $this->setFechaRegistroReservacion($Gestiones['fecharegistro']);
                $this->setNombreFacultadReservacion($Gestiones['nombrefacultad']);
                $this->setNombreEscuelaReservacion($Gestiones['nombre_escuela']);
                $this->setNombreAplicacion($Gestiones['nombreaplicacion']);
                $this->setUsuarioGestionReservacion($Gestiones['usuario_gestion']);
                $this->setCantidadModulo1($Gestiones['mod1']);
                $this->setCantidadModulo2($Gestiones['mod2']);
                $this->setCantidadModulo3($Gestiones['mod3']);
                $this->setCantidadModulo4($Gestiones['mod4']);
                $this->setEstadoTitularReservacion($Gestiones['titular_reservacion']);
                $this->setNombreOtroTitularReservacion($Gestiones['nombre_otrotitular']);
                $this->setAulaProcedenciaReservacion($Gestiones['aula_procedencia']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // CONSULTA ESPECIFICA TODAS LAS RESERVACIONES REGISTRADAS [TODOS LOS LABORATORIOS] [ACCION GESTIONAR RESERVACIONES]
        public function ConsultaEspecificaGestionarMisReservacionesProcesadas($conectarsistema, $IdUsuarios, $IdentificadorUnicoReservacion, $IdReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaEspecificaConsultarMisReservaciones('" . $IdUsuarios . "'
            ,'" . $IdentificadorUnicoReservacion . "','" . $IdReservacion . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdReservacion($Gestiones['idreservacion']);
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setIdLaboratorio($Gestiones['idlaboratorio']);
                $this->setIdTipoReservacion($Gestiones['idtiporeservacion']);
                $this->setNombresUsuarios($Gestiones['nombres']);
                $this->setApellidosUsuarios($Gestiones['apellidos']);
                $this->setCodigoUnicoUsuarios($Gestiones['codigousuario']);
                $this->setIdTipoReservacion($Gestiones['idtiporeservacion']);
                $this->setNombreTipoReservacion($Gestiones['tiporeservacion']);
                $this->setCodigoUnicoIdentificadorReservacion($Gestiones['codigounico_identificador']);
                $this->setCodigoReservacion($Gestiones['codigoreservacion']);
                $this->setCicloReservacion($Gestiones['ciclo']);
                $this->setNombreReservacion($Gestiones['nombrereservacion']);
                $this->setSeccionReservacion($Gestiones['seccionreservacion']);
                $this->setFechaInicioReservacion($Gestiones['fechainicioreservacion']);
                $this->setFechaFinReservacion($Gestiones['fechafinreservacion']);
                $this->setHoraInicioReservacion($Gestiones['horainicioreservacion']);
                $this->setHoraFinReservacion($Gestiones['horafinreservacion']);
                $this->setCantidadUsuariosReservacion($Gestiones['numerousuarios']);
                $this->setOtroTipoReservacion($Gestiones['otrotipo_reservacion']);
                $this->setComentarioAdministradorLaboratorioReservacion($Gestiones['comentario_adminlaboratorios']);
                $this->setComentarioCoordinadorLaboratorioReservacion($Gestiones['comentario_coordlaboratorio']);
                $this->setEstadoReservacion($Gestiones['estadoreservacion']);
                $this->setEstadoFinalizadoReservacion($Gestiones['finalizado']);
                $this->setFechaRegistroReservacion($Gestiones['fecharegistro']);
                $this->setIdFacultadReservacion($Gestiones['idfacultad']);
                $this->setNombreFacultadReservacion($Gestiones['nombrefacultad']);
                $this->setIdEscuelaReservacion($Gestiones['idescuela']);
                $this->setNombreEscuelaReservacion($Gestiones['nombre_escuela']);
                $this->setIdAplicacion($Gestiones['idaplicacion']);
                $this->setNombreAplicacion($Gestiones['nombreaplicacion']);
                $this->setUsuarioGestionReservacion($Gestiones['usuario_gestion']);
                $this->setCompletoSeguimientoReservacion($Gestiones['completo_seguimiento']);
                $this->setCantidadModulo1($Gestiones['mod1']);
                $this->setCantidadModulo2($Gestiones['mod2']);
                $this->setCantidadModulo3($Gestiones['mod3']);
                $this->setCantidadModulo4($Gestiones['mod4']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // CONSULTAR NUMEROS DE TELEFONOS DE USUARIOS QUE PROCESARON RESERVACIONES -> ENVIO AUTOMATICO DE SMS
        public function ConsultarTelefonoEnvioSmsAutomatico($conectarsistema, $CodigoUnicoIdentificadorReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaTelefonosEnvioSmsAutomatico('" . $CodigoUnicoIdentificadorReservacion . "');");
            return $resultado;
        }
        // CONSULTAR CORREOS DE USUARIOS QUE PROCESARON RESERVACIONES -> ENVIO AUTOMATICO DE CORREO NOTIFICACION
        public function ConsultarCorreosReservacionesEnvioCorreoAutomatico($conectarsistema, $CodigoUnicoIdentificadorReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCorreoActualizacionReservaciones('" . $CodigoUnicoIdentificadorReservacion . "');");
            return $resultado;
        }
        // CONSULTAR CORREO ELECTRONICO DE USUARIO QUE REGISTRO RESERVACION -> NOTIFICACION DE REASIGNACION DE RESERVACIONES
        public function ConsultarCorreoEnvioCorreoReasignacionReservaciones($conectarsistema, $CodigoUnicoIdentificadorReservacion, $IdReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaCorreoEnvioNotificacionReasignacionReservaciones('" . $CodigoUnicoIdentificadorReservacion . "',
            '" . $IdReservacion . "');");
            return $resultado;
        }
        // ACTUALIZACION INICIAL ESTADO RESERVACIONES LABORATORIOS
        public function ActualizacionInicialReservacionesLaboratorios($conectarsistema, $CodigoUnicoIdentificadorReservacion, $EstadoReservacion, 
        $ComentarioAdministradorLaboratorioReservacion, $UsuarioGestionReservacion, $NombreOtroTitularReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionInicialEstadoReservaciones('" . $CodigoUnicoIdentificadorReservacion . "','" . $EstadoReservacion . "'
            ,'" . $ComentarioAdministradorLaboratorioReservacion . "','" . $UsuarioGestionReservacion . "','" . $NombreOtroTitularReservacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // ACTUALIZACION FINAL ESTADO RESERVACIONES LABORATORIOS --> [PUNTO DONDE PUEDE SER PUBLICADO EN CALENDARIO DE ACTIVIDADES AUTOMATICAMENTE]
        public function ActualizacionFinalReservacionesLaboratorios($conectarsistema, $CodigoUnicoIdentificadorReservacion, $EstadoReservacion, 
        $ComentarioCoordinadorLaboratorioReservacion, $NombreOtroTitularReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ActualizacionFinalEstadoReservaciones('" . $CodigoUnicoIdentificadorReservacion . "','" . $EstadoReservacion . "'
            ,'" . $ComentarioCoordinadorLaboratorioReservacion . "','" . $NombreOtroTitularReservacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTAR TODAS MIS RESERVACIONES PROCESADAS [FILTRO SEGUN CICLO EN CURSO, ID USUARIOS]
        public function ConsultarMisReservacionesCicloActual($conectarsistema, $IdUsuarios, $CicloActual)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarMisReservacionesCicloActual('" . $IdUsuarios . "','" . $CicloActual . "');");
            return $resultado;
        }
        // INICIAR RESERVACIONES USUARIOS
        public function IniciarReservacionesProcesadas($conectarsistema, $IdUsuarios, $IdReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_IniciarReservacionesUsuarios('" . $IdUsuarios . "','" . $IdReservacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // FINALIZAR RESERVACIONES USUARIOS
        public function FinalizarReservacionesProcesadas($conectarsistema, $IdUsuarios, $IdReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_FinalizarReservacionesUsuarios('" . $IdUsuarios . "','" . $IdReservacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CANCELAR RESERVACIONES USUARIOS INDIVIDUALMENTE -> SEGUN EL ID DE RESERVACION Y NO TODO EL GRUPO DE RESERVACION PROCESADO
        public function CancelarReservacionesProcesadasIndividualmente($conectarsistema, $IdReservacion, $ComentarioCancelacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_CancelarReservacionesProcesadasIndividualmente('" . $IdReservacion . "','" . $ComentarioCancelacion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // REGISTRO SEGUIMIENTO RESERVACIONES LABORATORIOS -> RESERVACIONES FINALIZADAS
        public function RegistrarSeguimientosReservacionesLaboratorios($conectarsistema, $IdReservacion, $IdFacultad, $IdEscuela, $IdLaboratorio, $IdAplicacion, $IdTipoReservacion, $CodigoUnicoIdentificadorReservacion,
        $DivisionGrupos, $CantidadGrupos, $CantidadUsuariosAsistencia, $CicloActual, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroSeguimientoReservacionesFinalizadas('" . $IdReservacion . "','" . $IdFacultad . "','" . $IdEscuela . "','" . $IdLaboratorio . "','" . $IdAplicacion . "','" . $IdTipoReservacion . "'
            ,'" . $CodigoUnicoIdentificadorReservacion . "','" . $DivisionGrupos . "','" . $CantidadGrupos . "','" . $CantidadUsuariosAsistencia . "','" . $CicloActual . "','" . $IdUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTAR DATOS SEGUIMIENTO RESERVACIONES FINALIZADAS
        public function ConsultarSeguimientoReservacionesFinalizadas($conectarsistema, $IdentificadorUnicoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDatosSeguimientoReservacionesFinalizadas('" . $IdentificadorUnicoReservacion . "');");
            return $resultado;
        }
        // CONSULTAR CONTEO INICIAL INICIO COORDINADOR DE LABORATORIOS
        public function ConsultarConteoInicialInicioCoordinadorLaboratorios($conectarsistema)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConteoInicialInicioCoordinadoresLaboratorios();");
            return $resultado;
        }
        // CONSULTAR RESERVACIONES POR ESTADO TODO EL AÑO ACTUAL -> GRAFICO INICIO ADMINISTRADORES [COORDINADOR GENERAL]
        public function ConsultarReservacionesPorEstadoAnioActual($conectarsistema, $AnioActual)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaGraficoConteoReservacionesPorEstado('" . $AnioActual . "');");
            return $resultado;
        }
        // CONSULTAR RESERVACIONES POR FACULTADES TODO EL AÑO ACTUAL -> GRAFICO INICIO ADMINISTRADORES [COORDINADOR Y ADMINISTRADOR DE LABORATORIOS GENERAL]
        public function ConsultarReservacionesPorFacultadesAnioActual($conectarsistema, $AnioActual)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaGraficoConteoReservacionesPorFacultades('" . $AnioActual . "');");
            return $resultado;
        }
        // CONSULTA ESPECIFICA TODAS LAS RESERVACIONES REGISTRADAS [SEGUN IDENTIFICADOR UNICO E ID USUARIOS] -> COMPROBANTE MIS RESERVACIONES
        public function ConsultaEspecificaComprobanteMisReservaciones($conectarsistema, $IdentificadorUnicoReservacion, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesComprobanteMisReservaciones	('" . $IdentificadorUnicoReservacion . "','" . $IdUsuarios . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdReservacion($Gestiones['idreservacion']);
                $this->setIdUsuarios($Gestiones['idusuarios']);
                $this->setIdLaboratorio($Gestiones['idlaboratorio']);
                $this->setIdTipoReservacion($Gestiones['idtiporeservacion']);
                $this->setNombresUsuarios($Gestiones['nombres']);
                $this->setApellidosUsuarios($Gestiones['apellidos']);
                $this->setCodigoUnicoUsuarios($Gestiones['codigousuario']);
                $this->setIdTipoReservacion($Gestiones['idtiporeservacion']);
                $this->setNombreTipoReservacion($Gestiones['tiporeservacion']);
                $this->setCodigoUnicoIdentificadorReservacion($Gestiones['codigounico_identificador']);
                $this->setCodigoReservacion($Gestiones['codigoreservacion']);
                $this->setCicloReservacion($Gestiones['ciclo']);
                $this->setNombreReservacion($Gestiones['nombrereservacion']);
                $this->setSeccionReservacion($Gestiones['seccionreservacion']);
                $this->setFechaInicioReservacion($Gestiones['fechainicioreservacion']);
                $this->setFechaFinReservacion($Gestiones['fechafinreservacion']);
                $this->setHoraInicioReservacion($Gestiones['horainicioreservacion']);
                $this->setHoraFinReservacion($Gestiones['horafinreservacion']);
                $this->setCantidadUsuariosReservacion($Gestiones['numerousuarios']);
                $this->setOtroTipoReservacion($Gestiones['otrotipo_reservacion']);
                $this->setComentarioAdministradorLaboratorioReservacion($Gestiones['comentario_adminlaboratorios']);
                $this->setComentarioCoordinadorLaboratorioReservacion($Gestiones['comentario_coordlaboratorio']);
                $this->setEstadoReservacion($Gestiones['estadoreservacion']);
                $this->setEstadoFinalizadoReservacion($Gestiones['finalizado']);
                $this->setFechaRegistroReservacion($Gestiones['fecharegistro']);
                
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // CONSULTA ESPECIFICA TODAS LAS RESERVACIONES REGISTRADAS [SEGUN IDENTIFICADOR UNICO E ID USUARIOS] -> COMPROBANTE MIS RESERVACIONES [IMPRESION EN TABLA]
        public function ConsultaComprobanteMisReservaciones($conectarsistema, $IdentificadorUnicoReservacion, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesComprobanteMisReservaciones	('" . $IdentificadorUnicoReservacion . "','" . $IdUsuarios . "');");
            return $resultado;
        }
        // FINALIZAR PRACTICAS LIBRES PROCESADAS
        public function FinalizarPracticasLibresProcesadas($conectarsistema, $IdPracticaLibre)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_FinalizarPracticasLibres('" . $IdPracticaLibre . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // REPORTE PRACTICAS LIBRES POR RANGO DE FECHAS INICIO Y FIN [TODOS LOS LABORATORIOS]
        public function ReportePracticasLibresRangoFechas($conectarsistema, $FechaInicio, $FechaFin)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ReportePracticasLibresFinalizadasRangoFechas	('" . $FechaInicio . "','" . $FechaFin . "');");
            return $resultado;
        }
        // REPORTE PRACTICAS LIBRES POR RANGO DE FECHAS INICIO Y FIN [FILTRADO POR LABORATORIO]
        public function ReportePracticasLibresRangoFechasLaboratorios($conectarsistema, $FechaInicio, $FechaFin, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ReportePracticasLibresFinalizadasRangoFechasPorLaboratorios	('" . $FechaInicio . "','" . $FechaFin . "','" . $IdLaboratorio . "');");
            return $resultado;
        }
        // REPORTE PRACTICAS LIBRES POR CICLO
        public function ReportePracticasLibresPorCiclo($conectarsistema, $Ciclo)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ReportePracticasLibresFinalizadasPorCiclo('" . $Ciclo . "');");
            return $resultado;
        }
        // REPORTE PRACTICAS LIBRES POR CICLO [COORDINADOR Y ADMINISTRADOR DE LABORATORIOS]
        public function ReservacionesProcesadasHistorico($conectarsistema, $Ciclo)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesProcesadasHistorico('" . $Ciclo . "');");
            return $resultado;
        }
        // REPORTE PRACTICAS LIBRES POR CICLO [DOCENTES]
        public function ReservacionesProcesadasHistoricoDocentes($conectarsistema, $Ciclo, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaReservacionesProcesadasHistoricoDocentes('" . $Ciclo . "','" . $IdUsuarios . "');");
            return $resultado;
        }
        // CONSULTAR DETALLES REASIGNACION GRUPO COMPLETO DE RESERVACION PROCESADA
        public function ConsultaDetallesReservacion_ReasignacionGrupo($conectarsistema, $CodigoUnicoIdentificadorReservacion, $IdReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaDetallesReasignacionGrupoReservacionesProcesadas	('" . $CodigoUnicoIdentificadorReservacion . "',
            '" . $IdReservacion . "');");
            $Gestiones = mysqli_fetch_array($resultado); // RECORRIDO EN BUSCA DE REGISTRO CONSULTADO
            // EXTRAER DETALLES DE USUARIOS SOLAMENTE SI EXISTEN REGISTROS QUE SE SEAN ASOCIADOS
            // AL USUARIO QUE ESTA SIENDO CONSULTADO EN CUESTION Y NO SEA CONSULTA VACIA [NULA]
            if (mysqli_num_rows($resultado) > 0) {
                // OBTENER VALORES EXTRAIDOS EN LA CONSULTA
                $this->setIdAplicacion($Gestiones['idaplicacion']);
                $this->setIdReservacion($Gestiones['idreservacion']);
                $this->setIdLaboratorio($Gestiones['idlaboratorio']);
                $this->setCodigoUnicoIdentificadorReservacion($Gestiones['codigounico_identificador']);
                $this->setCantidadUsuariosReservacion($Gestiones['numerousuarios']);
                $this->setFechaInicioReservacion($Gestiones['fechainicioreservacion']);
                $this->setFechaFinReservacion($Gestiones['fechafinreservacion']);
                $this->setHoraInicioReservacion($Gestiones['horainicioreservacion']);
                $this->setHoraFinReservacion($Gestiones['horafinreservacion']);
                $this->setCantidadModulo1($Gestiones['mod1']);
                $this->setCantidadModulo2($Gestiones['mod2']);
                $this->setCantidadModulo3($Gestiones['mod3']);
                $this->setCantidadModulo4($Gestiones['mod4']);
            } // CIERRE if(mysqli_num_rows($resultado)>0){
        }
        // FINALIZAR PRACTICAS LIBRES PROCESADAS
        public function ActualizacionReasignacionReservacionesProcesadas($conectarsistema, $IdReservacion, $CodigoUnicoIdentificadorReservacion, $IdLaboratorio, $Modulo1, $Modulo2,
        $Modulo3, $Modulo4)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ReasignacionReservacionesProcesadas('" . $IdReservacion . "','" . $CodigoUnicoIdentificadorReservacion . "',
            '" . $IdLaboratorio . "','" . $Modulo1 . "','" . $Modulo2 . "','" . $Modulo3 . "','" . $Modulo4 . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CAMBIO DE CREDENCIALES NUEVOS USUARIOS
        public function CambioCredencialesNuevosUsuarios($conectarsistema, $IdUsuarios, $NuevaContrasenia)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_CambioCredencialesNuevosUsuarios('" . $IdUsuarios . "','" . $NuevaContrasenia . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // REGISTRO DETALLES PERFIL NUEVOS USUARIOS
        public function RegistroDetallesPerfilNuevosUsuarios($conectarsistema, $TelefonoPrincipal, $GeneroUsuarios, $FechaNacimiento, $EstadoCivil, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroDetallesPerfilUsuarios('" . $TelefonoPrincipal . "','" . $GeneroUsuarios . "'
            ,'" . $FechaNacimiento . "','" . $EstadoCivil . "','" . $IdUsuarios . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
        // CONSULTA ULTIMAS 25 RESERVACIONES APROBADAS -> INICIO PORTAL DOCENTES
        public function UltimasReservacionesAprobadasDocentesPortal($conectarsistema, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultaUltimasReservacionesDocentes('" . $IdUsuarios . "');");
            return $resultado;
        }
        // REPORTE RESERVACIONES PROCESADAS
        public function ReporteReservacionesProcesadasPorCodigo($conectarsistema, $FechaInicioReservacion, $FechaFinReservacion, $CodigoReservacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_InformeReservacionesProcesadasPorCodigo('" . $FechaInicioReservacion . "','" . $FechaFinReservacion . "',
            '" . $CodigoReservacion . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO TODOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS
        public function GenerarInformeReservaciones_EstadoTodos($conectarsistema, $Ciclo)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservaciones_EstadoTodos('" . $Ciclo . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO APROBADOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS
        public function GenerarInformeReservaciones_EstadoAprobados($conectarsistema, $Ciclo)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservaciones_EstadoAprobados('" . $Ciclo . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO CANCELADOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS
        public function GenerarInformeReservaciones_EstadoCancelados($conectarsistema, $Ciclo)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservaciones_EstadoCancelado('" . $Ciclo . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO DENEGADOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS
        public function GenerarInformeReservaciones_EstadoDenegados($conectarsistema, $Ciclo)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservaciones_EstadoDenegado('" . $Ciclo . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO TODOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS [FILTRADO POR LABORATORIO]
        public function GenerarInformeReservacionesLaboratorios_EstadoTodos($conectarsistema, $Ciclo, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservacionesLaboratorios_EstadoTodos('" . $Ciclo . "','" . $IdLaboratorio . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO APROBADOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS [FILTRADO POR LABORATORIO]
        public function GenerarInformeReservacionesLaboratorios_EstadoAprobados($conectarsistema, $Ciclo, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservacionesLaboratorios_EstadoAprobados('" . $Ciclo . "','" . $IdLaboratorio . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO CANCELADOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS [FILTRADO POR LABORATORIO]
        public function GenerarInformeReservacionesLaboratorios_EstadoCancelados($conectarsistema, $Ciclo, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservacionesLaboratorios_EstadoCancelado('" . $Ciclo . "','" . $IdLaboratorio . "');");
            return $resultado;
        }
        // CONSULTA RESERVACIONES PROCESADAS ESTADO DENEGADOS -> GENERAR INFORME DE RESERVACIONES PROCESADAS [FILTRADO POR LABORATORIO]
        public function GenerarInformeReservacionesLaboratorios_EstadoDenegados($conectarsistema, $Ciclo, $IdLaboratorio)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_GenerarInformeReservacionesLaboratorios_EstadoDenegado('" . $Ciclo . "','" . $IdLaboratorio . "');");
            return $resultado;
        }
    }// CIERRE class GestionesLaboratorios
?>