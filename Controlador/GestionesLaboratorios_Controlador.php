<?php 

    /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/

    
    /***************************************************************/
    // INICIALIZANDO SESION
    session_start();
    // IMPORTANDO ARCHIVO DE CONEXION
    require('../Modelo/conexion.php');
    // TIEMPO POR DEFECTO -> UTC - 6 EL SALVADOR [CONSULTAR DOCUMENTACION OFICIAL]
    date_default_timezone_set('America/El_Salvador');
    // IMPORTANDO MODELO DE GESTIONES LABORATORIOS -> [LOGICA DE NEGOCIO]
    require('../Modelo/GestionesLaboratorios_Modelo.php');
    // IMPORTANDO MODELO DE API CLIMATICA -> OPENWEATHERMAP
    require('../Modelo/APIClimatica_OpenWeather_Modelo.php');

    /******************************************************************
     * -> INICIALIZACION DEPENDENCIAS COMPOSER
     *****************************************************************/

    /***************************************************************/
    // CLASES Y ARCHIVOS NECESARIOS PARA EJECUCION DE SMTP PHPMAILER
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    // CLASE PARA CONTROLAR EXCEPCIONES Y ERRORES
    require '../vendor/phpmailer/phpmailer/src/Exception.php';
    // CLASE PRINCIPAL DE PHPMAILER
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    // CLASE DE CONECTIVIDA SMTP PHPMAILER
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';
    // INSTANCIA DE CLASE PHPMAILER ACTIVA
    $mail = new PHPMailer(true);


    /***************************************************************/
    // CLASES Y ARCHIVOS NECESARIOS PARA EJECUCION DE ARGON2
    // CIFRADO DE CLAVES -> ARGON2
    require_once "../vendor/paragonie/sodium_compat/autoload.php";


    /***************************************************************/
    // CLASES Y ARCHIVOS NECESARIOS PARA EJECUCION DE RAMSEY UUID
    use Ramsey\Uuid\Uuid;
    require_once "../vendor/autoload.php";

    /***************************************************************/

    /***************************************************************/
    // INICIALIZACION CONTROL ENVIO SMS AUTOMATICO
    //-> REEMPLAZAR SEGUN DATOS DE LA CUENTA
    $accountSid = ''; 
    $authToken = '';
    $fromNumber = '';
    // URL de la API de Twilio
    $url = '' . $accountSid . '';

     /***************************************************************/

    // INICIALIZANDO VARIABLE GLOBAL DE CLASE
    $Gestiones = new GestionesLaboratorios();
    // URL GLOBAL DE PROYECTO -> PARA ACCEDER A TODOS LOS ARCHIVOS NECESARIOS
    /** [ENTORNO LOCAL] */
    $UrlGlobal = "http://" . $_SERVER['SERVER_NAME'] . ":90" . "/ControlLaboratorios" . '/';
    /** [ENTORNO PRODUCCION] */
    //$UrlGlobal = "https://" . $_SERVER['SERVER_NAME'] .'/';
    // ASIGNANDO PARAMETRO DE URL -> METODO GET (gestioneslaboratorios --> por defecto [parametro de gestiones])
    if (isset($_GET['gestioneslaboratorios'])) {
        $peticion_url = $_GET['gestioneslaboratorios'];  // ENVIO GET DE VALOR ACCION {URL}
    }
    // ASIGNA VALOR POR DEFECTO...
    else {
        $peticion_url = "inicioadministradores";  // CASO CONTRARIO, VALOR POR DEFECTO
    }
    // CABECERA DE TITULOS - ETIQUETA <TITLE></TITLE>
    $TituloPrincipal = "Control de Laboratorios | ";
    /*****************************************************************************************************************/
    // TODAS LAS GESTIONES INTERNAS DE LABORATORIOS -> PROCESOS DE RUTINA, TRANSACCIONALES Y DE LOGICA DEL NEGOCIO
    switch ($peticion_url){
        // PAGINA PRINCIPAL -> PANEL DE ADMINISTRACION ROL COORDINADOR DE LABORATORIOS
        case "inicioadministradores":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR PROXIMAS ACTIVIDADES A REALIZAR EN TODOS LOS LABORATORIOS
                $consulta2 = $Gestiones->ConsultarProximasActividadesLaboratorios($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/inicioadministradorgeneral.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CIERRE CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            } else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // PAGINA PRINCIPAL -> PANEL DE ADMINISTRACION ROL ADMINISTRADOR DE LABORATORIO
        case "inicioadministradorlaboratorios":
            // VISTA VALIDA SOLO PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR PROXIMAS ACTIVIDADES A REALIZAR EN TODOS LOS LABORATORIOS
                $consulta2 = $Gestiones->ConsultarProximasActividadesLaboratorios($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/inicioadministradorlaboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CIERRE CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            } else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // PAGINA PRINCIPAL -> PANEL DE ADMINISTRACION ROL DOCENTES
        case "iniciodocentes":
            // VISTA VALIDA SOLO PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR PROXIMAS ACTIVIDADES A REALIZAR EN TODOS LOS LABORATORIOS
                $consulta2 = $Gestiones->ConsultarProximasActividadesLaboratorios($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                // CONSULTA ULTIMAS 25 RESERVACIONES APROBADAS
                $consulta4 = $Gestiones->UltimasReservacionesAprobadasDocentesPortal($conectarsistema4, $IdUsuarios);
                require('../Vista/Docentes/iniciodocentes.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CIERRE CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            } else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // CONTEO INICIAL INICIO COORDINADOR DE LABORATORIOS
        case "conteo-inicial-coordinador-laboratorios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $consulta = $Gestiones->ConsultarConteoInicialInicioCoordinadorLaboratorios($conectarsistema);
                // INICIALIZACION DATOS JSON TIPO ARRAY
                $DatosConsulta = array();
                // RECORRIDO DE TODA LA CONSULTA ESTABLECIDA EN LA RESPECTIVA VISTA
                while ($filas = mysqli_fetch_assoc($consulta)) {
                    $DatosConsulta[] = array( 
                        "CantidadAdministradoresLaboratorios"=>$filas['CantidadAdministradoresLaboratorios'],
                        "CantidadDocentes"=>$filas['CantidadDocentes'],
                        "CantidadAplicaciones"=>$filas['CantidadAplicaciones'],
                        "CantidadLaboratoriosInactivos"=>$filas['CantidadLaboratoriosInactivos']
                    );
                }
                // OBTENER DATOS FINALES JSON EN FORMATO ARRAY
                $ResultadoJSON = array(
                "resultado" => $DatosConsulta //-> "resultado" -> VARIABLE DECLARADA EN EL MODELO $resultado
                );
                // -> EXTRAER CONSULTA PARA POSTERIOR TRATAMIENTO JS - AJAX
                echo json_encode($ResultadoJSON,JSON_UNESCAPED_UNICODE);
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONTEO POR ESTADO REPORTES PLOBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA]
        case "conteo-por-estados-reservaciones-anio-actual":
             // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $AnioActual = 2023; // CAMBIAR POR AÑO EN CURSO
                $consulta = $Gestiones->ConsultarReservacionesPorEstadoAnioActual($conectarsistema, $AnioActual);
                // INICIALIZACION DATOS JSON TIPO ARRAY
                $DatosConsulta = array();
                // RECORRIDO DE TODA LA CONSULTA ESTABLECIDA EN LA RESPECTIVA VISTA
                while ($filas = mysqli_fetch_assoc($consulta)) {
                    $DatosConsulta[] = array( 
                        "MesActual"=>$filas['Mes'],
                        "ReservacionesAprobadas"=>$filas['Aprobado'],
                        "ReservacionesCanceladas"=>$filas['Cancelado'],
                        "ReservacionesDenegadas"=>$filas['Denegado']
                    );
                }
                // OBTENER DATOS FINALES JSON EN FORMATO ARRAY
                $ResultadoJSON = array(
                "resultado" => $DatosConsulta //-> "resultado" -> VARIABLE DECLARADA EN EL MODELO $resultado
                );
                // -> EXTRAER CONSULTA PARA POSTERIOR TRATAMIENTO JS - AJAX
                echo json_encode($ResultadoJSON,JSON_UNESCAPED_UNICODE);
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONTEO POR ESTADO REPORTES PLOBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA]
        case "conteo-por-facultades-reservaciones-anio-actual":
            // VISTA VALIDA SOLO PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
               $AnioActual = 2023; // CAMBIAR POR AÑO EN CURSO
               $consulta = $Gestiones->ConsultarReservacionesPorFacultadesAnioActual($conectarsistema, $AnioActual);
               // INICIALIZACION DATOS JSON TIPO ARRAY
               $DatosConsulta = array();
               // RECORRIDO DE TODA LA CONSULTA ESTABLECIDA EN LA RESPECTIVA VISTA
               while ($filas = mysqli_fetch_assoc($consulta)) {
                   $DatosConsulta[] = array( 
                       "NombreFacultad"=>$filas['nombrefacultad'],
                       "Mes"=>$filas['mes'],
                       "Cantidad"=>$filas['cantidad']
                   );
               }
               // OBTENER DATOS FINALES JSON EN FORMATO ARRAY
               $ResultadoJSON = array(
               "resultado" => $DatosConsulta //-> "resultado" -> VARIABLE DECLARADA EN EL MODELO $resultado
               );
               // -> EXTRAER CONSULTA PARA POSTERIOR TRATAMIENTO JS - AJAX
               echo json_encode($ResultadoJSON,JSON_UNESCAPED_UNICODE);
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
           break;
        // REGISTRO DE NUEVOS USUARIOS
        case "registro-nuevos-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/registro-nuevos-usuarios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CIERRE CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRO DE NUEVOS USUARIOS
        case "envio-datos-registro-nuevos-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdRolUsuarios = (empty($_POST['sltroles_usuarios'])) ? NULL : $_POST['sltroles_usuarios']; // ID ROL DE USUARIOS
                $NombresUsuarios = (empty($_POST['txtnombres_usuarios'])) ? NULL : $_POST['txtnombres_usuarios']; // NOMBRES DE USUARIOS
                $ApellidosUsuarios = (empty($_POST['txtapellidos_usuarios'])) ? NULL : $_POST['txtapellidos_usuarios']; // APELLIDOS DE USUARIOS
                $CodigoUnicoUsuarios = (empty($_POST['txtcodigo_usuarios'])) ? NULL : $_POST['txtcodigo_usuarios']; // USUARIO UNICO [CODIGO UNICO DE USUARIOS]
                $CorreoUsuarios = (empty($_POST['txtcorreo_usuarios'])) ? NULL : $_POST['txtcorreo_usuarios']; // CORREO DE USUARIOS
                $Bytes = random_bytes(5); // GENERAR CREDENCIAL DE ACCESO 10 DIGITOS - LETRAS
                $ContraseniaUsuariosGenerada = bin2hex($Bytes); // ENVIAR CREDENCIAL DE ACCESO A INSERCCION
                $cifrado = $ContraseniaUsuariosGenerada; // ENCRIPTAR CONTRASEÑA INGRESADA
                    $options = [
                        'cost' => 12,
                        'time_cost' => 4,
                        'threads' => 1
                    ];
                $ContraseniaUsuarios = password_hash($cifrado, PASSWORD_ARGON2I, $options);
                //-> INGRESO DE UBICACION DE CADA LABORATORIO ASIGNADO
                $UbicacionLaboratorio1 = (empty($_POST['chklab1-lab'])) ? "n/d" : $_POST['chklab1-lab']; // UBICACION DE LABORATORIO 1
                $UbicacionLaboratorio2 = (empty($_POST['chklab2-lab'])) ? "n/d" : $_POST['chklab2-lab']; // UBICACION DE LABORATORIO 2
                $UbicacionLaboratorio3 = (empty($_POST['chklab3-lab'])) ? "n/d" : $_POST['chklab3-lab']; // UBICACION DE LABORATORIO 3
                $UbicacionLaboratorio4 = (empty($_POST['chklab4-lab'])) ? "n/d" : $_POST['chklab4-lab']; // UBICACION DE LABORATORIO 4
                $UbicacionLaboratorio5 = (empty($_POST['chklab5-lab'])) ? "n/d" : $_POST['chklab5-lab']; // UBICACION DE LABORATORIO 5
                $UbicacionLaboratorio6 = (empty($_POST['chklab6-lab'])) ? "n/d" : $_POST['chklab6-lab']; // UBICACION DE LABORATORIO 6
                $UbicacionLaboratorio7 = (empty($_POST['chklab7-lab'])) ? "n/d" : $_POST['chklab7-lab']; // UBICACION DE LABORATORIO 7
                $UbicacionLaboratorio8 = (empty($_POST['chklab8-lab'])) ? "n/d" : $_POST['chklab8-lab']; // UBICACION DE LABORATORIO 8
                $UbicacionLaboratorio9 = (empty($_POST['chklab9-lab'])) ? "n/d" : $_POST['chklab9-lab']; // UBICACION DE LABORATORIO 9
                $UbicacionLaboratorio10 = (empty($_POST['chklab10-lab'])) ? "n/d" : $_POST['chklab10-lab']; // UBICACION DE LABORATORIO 10
                $UbicacionLaboratorio11 = (empty($_POST['chklab11-lab'])) ? "n/d" : $_POST['chklab11-lab']; // UBICACION DE LABORATORIO 11
                $UbicacionLaboratorio12 = (empty($_POST['chklab12-lab'])) ? "n/d" : $_POST['chklab12-lab']; // UBICACION DE LABORATORIO 12
                $UbicacionLaboratorio13 = (empty($_POST['chklab13-lab'])) ? "n/d" : $_POST['chklab13-lab']; // UBICACION DE LABORATORIO 13
                $UbicacionLaboratorio14 = (empty($_POST['chklab14-lab'])) ? "n/d" : $_POST['chklab14-lab']; // UBICACION DE LABORATORIO 14
                $UbicacionLaboratorio15 = (empty($_POST['chklab15-lab'])) ? "n/d" : $_POST['chklab15-lab']; // UBICACION DE LABORATORIO 15
                $ExtensionesUsuarios = (empty($_POST['txtextensiones_usuarios'])) ? "n/d" : $_POST['txtextensiones_usuarios']; // EXTENSIONES ASIGNADAS USUARIOS
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdRolUsuarios)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // -> VALIDACION SEGUN ROL DE USUARIO
                    if($IdRolUsuarios == 1){
                        //-> SI ROL DE USUARIO ES UNO [1], ES UN COORDINADOR DE LABORATORIOS, POR LO TANTO ESTE ROL DE USUARIO YA POSEE TODOS LOS LABORATORIOS
                        //   DE INFORMATICA ASIGNADOS POR DEFECTO
                        $Laboratorio1 = "si"; $Laboratorio4 = "si"; $Laboratorio7 = "si"; $Laboratorio10 = "si"; $Laboratorio12 = "si"; $Laboratorio14 = "si";
                        $Laboratorio2 = "si"; $Laboratorio5 = "si"; $Laboratorio8 = "si"; $Laboratorio11 = "si"; $Laboratorio13 = "si"; $Laboratorio15 = "si";
                        $Laboratorio3 = "si"; $Laboratorio6 = "si"; $Laboratorio9 = "si";
                    }else if($IdRolUsuarios == 2){
                        //-> SI ROL DE USUARIO ES DOS [2], ES UN ADMINISTRADOR DE LABORATORIOS, POR LO TANTO ESTE ROL DE USUARIO DEBEN SELECCIONAR LOS LABORATORIOS
                        //   DE INFORMATICA, QUE A ESE USUARIO EN CUESTION TIENE ASIGNADOS
                        $Laboratorio1 = isset($_POST['chklab1']) && $_POST['chklab1'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 1
                        $Laboratorio2 = isset($_POST['chklab2']) && $_POST['chklab2'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 2
                        $Laboratorio3 = isset($_POST['chklab3']) && $_POST['chklab3'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 3
                        $Laboratorio4 = isset($_POST['chklab4']) && $_POST['chklab4'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 4
                        $Laboratorio5 = isset($_POST['chklab5']) && $_POST['chklab5'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 5
                        $Laboratorio6 = isset($_POST['chklab6']) && $_POST['chklab6'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 6
                        $Laboratorio7 = isset($_POST['chklab7']) && $_POST['chklab7'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 7
                        $Laboratorio8 = isset($_POST['chklab8']) && $_POST['chklab8'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 8
                        $Laboratorio9 = isset($_POST['chklab9']) && $_POST['chklab9'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 9
                        $Laboratorio10 = isset($_POST['chklab10']) && $_POST['chklab10'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 10
                        $Laboratorio11 = isset($_POST['chklab11']) && $_POST['chklab11'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 11
                        $Laboratorio12 = isset($_POST['chklab12']) && $_POST['chklab12'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 12
                        $Laboratorio13 = isset($_POST['chklab13']) && $_POST['chklab13'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 13
                        $Laboratorio14 = isset($_POST['chklab14']) && $_POST['chklab14'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 14
                        $Laboratorio15 = isset($_POST['chklab15']) && $_POST['chklab15'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 15
                    }else if($IdRolUsuarios == 3){
                        //-> SI ROL DE USUARIO ES TRES [3], ES UN DOCENTE, POR LO TANTO ESTE ROL DE USUARIO NO POSEE NINGUN LABORATORIO DE INFORMATICA ASIGNADO
                        $Laboratorio1 = "no"; $Laboratorio4 = "no"; $Laboratorio7 = "no"; $Laboratorio10 = "no"; $Laboratorio12 = "no"; $Laboratorio14 = "no";
                        $Laboratorio2 = "no"; $Laboratorio5 = "no"; $Laboratorio8 = "no"; $Laboratorio11 = "no"; $Laboratorio13 = "no"; $Laboratorio15 = "no";
                        $Laboratorio3 = "no"; $Laboratorio6 = "no"; $Laboratorio9 = "no";
                    }// CIERRE if($IdRolUsuario ?? elseif ?? elseif ??)
                    $consulta = $Gestiones->RegistroNuevosUsuarios($conectarsistema, $IdRolUsuarios, $NombresUsuarios, $ApellidosUsuarios, $CodigoUnicoUsuarios, $CorreoUsuarios, 
                    $ContraseniaUsuarios, $Laboratorio1, $Laboratorio2, $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, $Laboratorio7, $Laboratorio8, 
                    $Laboratorio9, $Laboratorio10, $Laboratorio11, $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15, $UbicacionLaboratorio1, $UbicacionLaboratorio2,
                    $UbicacionLaboratorio3, $UbicacionLaboratorio4, $UbicacionLaboratorio5, $UbicacionLaboratorio6, $UbicacionLaboratorio7, $UbicacionLaboratorio8, $UbicacionLaboratorio9,
                    $UbicacionLaboratorio10, $UbicacionLaboratorio11, $UbicacionLaboratorio12, $UbicacionLaboratorio13, $UbicacionLaboratorio14, $UbicacionLaboratorio15, $ExtensionesUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                    /*********************** -- ENVIO CORREO AUTOMATICO  --*************************************/
                    // -> ENVIAR CORREO CON NUEVA CREDENCIAL DE ACCESO A USUARIOS DADOS DE ALTA
                    $Destinatario = $CorreoUsuarios; // CORREO ELECTRONICO REGISTRADO DE USUARIOS
                    $Nombre = "FICA - Nuevos Usuarios"; // NOMBRE POR DEFECTO EMPRESA
                    $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                    $Asunto = "Alta Nuevo Usuario - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                    /** CORREO DE CONFIRMACION CAMBIO EXITOSO DE CONTRASEÑA **/
                    $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                    // Crear una instancia y pasar true para permitir las excepciones
                    $mail = new PHPMailer(true);
                    try{
                        $mail->isSMTP();
                        $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port       = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth   = true;
                        $mail->Username = 'proyectosedmr@gmail.com';
                        $mail->Password = 'nodhtetwzespsuwy';
                        //$mail->SetFrom('proyectosedmr@gmail.com', $Nombre);
                        // DESTINATARIOS Y REMITENTES
                        $mail->setFrom($Remitente, $Nombre);
                        $mail->addAddress($Destinatario);
                        /**
                         * -> DEPURACION 
                         *      -> COMPROBACION DE ERRORES
                         *  */
                        //$mail->SMTPDebug  = 3;
                        //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
                        $mail->IsHTML(true);
                        $mail->Subject = $Asunto;
                        $mail->Body    = '<!DOCTYPE html>
                                <html>
                                <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
                                    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                    <style>
                                    body{
                                    width: 650px;
                                    font-family: work-Sans, sans-serif;
                                    background-color: #f6f7fb;
                                    display: block;
                                    }
                                    a{
                                    text-decoration: none;
                                    }
                                    span {
                                    font-size: 14px;
                                    }
                                    p {
                                        font-size: 13px;
                                        line-height: 1.7;
                                        letter-spacing: 0.7px;
                                        margin-top: 0;
                                    }
                                    .text-center{
                                    text-align: center
                                    }
                                    h6 {
                                    font-size: 16px;
                                    margin: 0 0 18px 0;
                                    }
                                    </style>
                                </head>
                                <body style="margin: 30px auto;">
                                    <table style="width: 100%">
                                    <tbody>
                                        <tr>
                                        <td>
                                            <table style="background-color: #f6f7fb; width: 100%">
                                            <tbody>
                                                <tr>
                                                <td>
                                                    <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                                    <tbody>
                                                        <tr>
                                                        <td><a href="#"><img class="img-fluid" width="350" src="https://cashmanha.helioho.st/utec_logo.jpg" alt=""></a></td>
                                                        <td style="text-align: right; color:#999"><span>Dpto Recuperaci&oacute;n Cuentas - Control Laboratorios FICA</span></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                            <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                            <tbody>
                                                <tr>
                                                <td style="padding: 30px"> 
                                                    <h6 style="font-weight: 600">Estimado(a) Usuario:</h6>
                                                    <img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/icons8-notification-480.png">
                                                    <p>Reciba una cordial bienvenida de parte de la facultad de inform&aacute;tica y ciencias aplicadas. Su usuario ha sido dado de alta
                                                    exitosamente y ahora puede ingresar a nuestro portal, esperamos cumplir con todas sus espectativas, y que sus labores diarias
                                                    sean de mucho provecho y exitos. <strong>Si tiene problemas para ingresar, comun&iacute;quese con nuestro administrador de laboratorios, o 
                                                        puede escribirnos a <a href="mailto:soportelabfica@utec.edu.sv">soportelabfica@utec.edu.sv</a>
                                                    </strong>
                                                    </p>
                                                    <p>A continuaci&oacute;n, le compartimos su credencial de acceso, su usuario es <strong>'.$CodigoUnicoUsuarios.'</strong> y su correo registrado es <strong>'.$CorreoUsuarios.'</strong>. Usted puede ingresar con su usuario &uacute;nico,  
                                                    o correo. Al ser primera vez que inicia sesi&oacute;n, se le solicitar&aacute;
                                                    que realice el cambio con una nueva credencial, adem&aacute;s de completar su perfil de usuario.

                                                    <span style="width: 55%; border-radius: 4px; margin: 2rem auto; margin-bottom: 1rem; padding: 1rem; font-size: 18px; color: #fff; background-color: #2d3436; 
                                                    line-height: 180%; border: 5px dashed #fdcb6e; letter-spacing: 1rem; display: block; text-align: center;">'.$ContraseniaUsuariosGenerada.'</span>
                                                    </p>
                                                    
                                                    
                                                    <p style="margin-bottom: 0">
                                                    Atte:,<br>Dpto Recuperaci&oacute;n Cuentas - Control Laboratorios FICA</p>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                            <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                            <tbody>       
                                                <tr style="text-align: center">
                                                <td> 
                                                    <p style="color: #ff7675; margin-bottom: 0">ESTE CORREO HA SIDO GENERADO AUTOMATICAMENTE, AGRADECEMOS NO RESPONDER AL MISMO</p>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </body>
                                </html>
                        ';
                        $mail->send(); // SI PETICION ES EXITOSA, ENVIA CORREO A SU DESTINATARIO FINAL
                    }
                    catch (Exception $e){
                        //-> EFECTOS DE DEPURACION ERRORES
                        //echo 'Ha ocurrido un error al enviar el correo electrónico: ' . $mail->ErrorInfo;
                        header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-nuevos-usuarios');
                    }
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA TODOS LOS USUARIOS REGISTRADOS
        case "consulta-general-usuarios":
             // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultaGeneralUsuariosRegistrados($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require("../Vista/AdministradorGeneral/consulta-general-usuarios-registrados.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // MODIFICAR DATOS DE USUARIOS
        case "modificar-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = (empty($_GET['idusuario'])) ? NULL : $_GET['idusuario']; // ID UNICO DE USUARIOS
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE USUARIOS A MODIFICAR
                $consulta3 = $Gestiones->ConsultaEspecificaUsuariosRegistrados_ModificarDatos($conectarsistema3, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require("../Vista/AdministradorGeneral/modificar-datos-usuarios.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> MODIFICAR USUARIOS
        case "envio-datos-modificar-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = (empty($_POST['txtidusuarios'])) ? NULL : $_POST['txtidusuarios']; // ID DE USUARIOS
                $IdRolUsuarios = (empty($_POST['sltroles_usuarios'])) ? NULL : $_POST['sltroles_usuarios']; // ID ROL DE USUARIOS
                $NombresUsuarios = (empty($_POST['txtnombres_usuarios'])) ? NULL : $_POST['txtnombres_usuarios']; // NOMBRES DE USUARIOS
                $ApellidosUsuarios = (empty($_POST['txtapellidos_usuarios'])) ? NULL : $_POST['txtapellidos_usuarios']; // APELLIDOS DE USUARIOS
                $CodigoUnicoUsuarios = (empty($_POST['txtcodigo_usuarios'])) ? NULL : $_POST['txtcodigo_usuarios']; // USUARIO UNICO [CODIGO UNICO DE USUARIOS]
                $CorreoUsuarios = (empty($_POST['txtcorreo_usuarios'])) ? NULL : $_POST['txtcorreo_usuarios']; // CORREO DE USUARIOS
                $EstadoUsuario = (empty($_POST['sltestado_usuarios'])) ? NULL : $_POST['sltestado_usuarios']; // ESTADO DE USUARIOS
                //-> INGRESO DE UBICACION DE CADA LABORATORIO ASIGNADO
                $UbicacionLaboratorio1 = (empty($_POST['chklab1-lab'])) ? "n/d" : $_POST['chklab1-lab']; // UBICACION DE LABORATORIO 1
                $UbicacionLaboratorio2 = (empty($_POST['chklab2-lab'])) ? "n/d" : $_POST['chklab2-lab']; // UBICACION DE LABORATORIO 2
                $UbicacionLaboratorio3 = (empty($_POST['chklab3-lab'])) ? "n/d" : $_POST['chklab3-lab']; // UBICACION DE LABORATORIO 3
                $UbicacionLaboratorio4 = (empty($_POST['chklab4-lab'])) ? "n/d" : $_POST['chklab4-lab']; // UBICACION DE LABORATORIO 4
                $UbicacionLaboratorio5 = (empty($_POST['chklab5-lab'])) ? "n/d" : $_POST['chklab5-lab']; // UBICACION DE LABORATORIO 5
                $UbicacionLaboratorio6 = (empty($_POST['chklab6-lab'])) ? "n/d" : $_POST['chklab6-lab']; // UBICACION DE LABORATORIO 6
                $UbicacionLaboratorio7 = (empty($_POST['chklab7-lab'])) ? "n/d" : $_POST['chklab7-lab']; // UBICACION DE LABORATORIO 7
                $UbicacionLaboratorio8 = (empty($_POST['chklab8-lab'])) ? "n/d" : $_POST['chklab8-lab']; // UBICACION DE LABORATORIO 8
                $UbicacionLaboratorio9 = (empty($_POST['chklab9-lab'])) ? "n/d" : $_POST['chklab9-lab']; // UBICACION DE LABORATORIO 9
                $UbicacionLaboratorio10 = (empty($_POST['chklab10-lab'])) ? "n/d" : $_POST['chklab10-lab']; // UBICACION DE LABORATORIO 10
                $UbicacionLaboratorio11 = (empty($_POST['chklab11-lab'])) ? "n/d" : $_POST['chklab11-lab']; // UBICACION DE LABORATORIO 11
                $UbicacionLaboratorio12 = (empty($_POST['chklab12-lab'])) ? "n/d" : $_POST['chklab12-lab']; // UBICACION DE LABORATORIO 12
                $UbicacionLaboratorio13 = (empty($_POST['chklab13-lab'])) ? "n/d" : $_POST['chklab13-lab']; // UBICACION DE LABORATORIO 13
                $UbicacionLaboratorio14 = (empty($_POST['chklab14-lab'])) ? "n/d" : $_POST['chklab14-lab']; // UBICACION DE LABORATORIO 14
                $UbicacionLaboratorio15 = (empty($_POST['chklab15-lab'])) ? "n/d" : $_POST['chklab15-lab']; // UBICACION DE LABORATORIO 15
                $ExtensionesUsuarios = (empty($_POST['txtextensiones_usuarios'])) ? "n/d" : $_POST['txtextensiones_usuarios']; // EXTENSIONES ASIGNADAS USUARIOS
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdUsuarios)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // -> VALIDACION SEGUN ROL DE USUARIO
                    if($IdRolUsuarios == 1){
                        //-> SI ROL DE USUARIO ES UNO [1], ES UN COORDINADOR DE LABORATORIOS, POR LO TANTO ESTE ROL DE USUARIO YA POSEE TODOS LOS LABORATORIOS
                        //   DE INFORMATICA ASIGNADOS POR DEFECTO
                        $Laboratorio1 = "si"; $Laboratorio4 = "si"; $Laboratorio7 = "si"; $Laboratorio10 = "si"; $Laboratorio12 = "si"; $Laboratorio14 = "si";
                        $Laboratorio2 = "si"; $Laboratorio5 = "si"; $Laboratorio8 = "si"; $Laboratorio11 = "si"; $Laboratorio13 = "si"; $Laboratorio15 = "si";
                        $Laboratorio3 = "si"; $Laboratorio6 = "si"; $Laboratorio9 = "si";
                    }else if($IdRolUsuarios == 2){
                        //-> SI ROL DE USUARIO ES DOS [2], ES UN ADMINISTRADOR DE LABORATORIOS, POR LO TANTO ESTE ROL DE USUARIO DEBEN SELECCIONAR LOS LABORATORIOS
                        //   DE INFORMATICA, QUE A ESE USUARIO EN CUESTION TIENE ASIGNADOS
                        $Laboratorio1 = isset($_POST['chklab1']) && $_POST['chklab1'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 1
                        $Laboratorio2 = isset($_POST['chklab2']) && $_POST['chklab2'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 2
                        $Laboratorio3 = isset($_POST['chklab3']) && $_POST['chklab3'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 3
                        $Laboratorio4 = isset($_POST['chklab4']) && $_POST['chklab4'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 4
                        $Laboratorio5 = isset($_POST['chklab5']) && $_POST['chklab5'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 5
                        $Laboratorio6 = isset($_POST['chklab6']) && $_POST['chklab6'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 6
                        $Laboratorio7 = isset($_POST['chklab7']) && $_POST['chklab7'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 7
                        $Laboratorio8 = isset($_POST['chklab8']) && $_POST['chklab8'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 8
                        $Laboratorio9 = isset($_POST['chklab9']) && $_POST['chklab9'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 9
                        $Laboratorio10 = isset($_POST['chklab10']) && $_POST['chklab10'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 10
                        $Laboratorio11 = isset($_POST['chklab11']) && $_POST['chklab11'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 11
                        $Laboratorio12 = isset($_POST['chklab12']) && $_POST['chklab12'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 12
                        $Laboratorio13 = isset($_POST['chklab13']) && $_POST['chklab13'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 13
                        $Laboratorio14 = isset($_POST['chklab14']) && $_POST['chklab14'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 14
                        $Laboratorio15 = isset($_POST['chklab15']) && $_POST['chklab15'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD DE LABORATORIO 15
                    }else if($IdRolUsuarios == 3){
                        //-> SI ROL DE USUARIO ES TRES [3], ES UN DOCENTE, POR LO TANTO ESTE ROL DE USUARIO NO POSEE NINGUN LABORATORIO DE INFORMATICA ASIGNADO
                        $Laboratorio1 = "no"; $Laboratorio4 = "no"; $Laboratorio7 = "no"; $Laboratorio10 = "no"; $Laboratorio12 = "no"; $Laboratorio14 = "no";
                        $Laboratorio2 = "no"; $Laboratorio5 = "no"; $Laboratorio8 = "no"; $Laboratorio11 = "no"; $Laboratorio13 = "no"; $Laboratorio15 = "no";
                        $Laboratorio3 = "no"; $Laboratorio6 = "no"; $Laboratorio9 = "no";
                    }// CIERRE if($IdRolUsuario ?? elseif ?? elseif ??)
                    //- EJECUTAR CONSULTA
                    $consulta = $Gestiones->ModificarUsuarios($conectarsistema, $IdUsuarios, $NombresUsuarios, $ApellidosUsuarios, 
                    $CodigoUnicoUsuarios, $CorreoUsuarios, $IdRolUsuarios, $EstadoUsuario, $Laboratorio1, $Laboratorio2, 
                    $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, $Laboratorio7, $Laboratorio8, $Laboratorio9, $Laboratorio10, $Laboratorio11, 
                    $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15, $UbicacionLaboratorio1, $UbicacionLaboratorio2,
                    $UbicacionLaboratorio3, $UbicacionLaboratorio4, $UbicacionLaboratorio5, $UbicacionLaboratorio6, $UbicacionLaboratorio7, $UbicacionLaboratorio8, $UbicacionLaboratorio9,
                    $UbicacionLaboratorio10, $UbicacionLaboratorio11, $UbicacionLaboratorio12, $UbicacionLaboratorio13, $UbicacionLaboratorio14, $UbicacionLaboratorio15, $ExtensionesUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> DESACTIVAR USUARIOS 
        case "envio-datos-desactivar-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = (empty($_GET['idusuario'])) ? NULL : $_GET['idusuario']; // ID DE USUARIOS
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdUsuarios)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->DesactivarUsuarios($conectarsistema, $IdUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> BLOQUEAR USUARIOS 
        case "envio-datos-bloquear-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = (empty($_GET['idusuario'])) ? NULL : $_GET['idusuario']; // ID DE USUARIOS
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdUsuarios)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->BloquearUsuarios($conectarsistema, $IdUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> ACTIVAR USUARIOS 
        case "envio-datos-activar-usuarios":
             // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = (empty($_GET['idusuario'])) ? NULL : $_GET['idusuario']; // ID DE USUARIOS
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdUsuarios)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ActivarUsuarios($conectarsistema, $IdUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // MODIFICAR DATOS DE USUARIOS
        case "visualizar-perfil-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = (empty($_GET['idusuario'])) ? NULL : $_GET['idusuario']; // ID UNICO DE USUARIOS
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultaEspecificaPerfilUsuarios($conectarsistema2, $IdUsuarios);
                // CONSULTA GENERAL DE ACCESOS REGISTRADOS
                $consulta3 = $Gestiones->ConsultarAccesos_PerfilUsuarios($conectarsistema3, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require("../Vista/AdministradorGeneral/visualizar-perfil-usuarios-registrados.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
         // CONSULTA GENERAL LABORATORIOS ASIGNADOS USUARIOS
         case "consulta-laboratorios-asignados-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODOS LOS USUARIOS ASIGNADOS A UN LABORATORIO [ESTRICTAMENTE ADMINISTRADORES DE LABORATORIOS]
                $consulta2 = $Gestiones->ConsultarLaboratoriosAsignadosUsuarios($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-usuarios-asignados-laboratorios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA MI PERFIL PERSONAL -> COORDINADOR DE LABORATORIOS
        case "perfil-administrador-general":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultaEspecificaPerfilUsuarios($conectarsistema2, $IdUsuarios);
                // CONSULTA GENERAL DE ACCESOS REGISTRADOS
                $consulta3 = $Gestiones->ConsultarAccesos_PerfilUsuarios($conectarsistema3, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require("../Vista/AdministradorGeneral/perfil-administradorgeneral.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA MI PERFIL PERSONAL -> ADMINISTRADOR LABORATORIOS
        case "perfil-administrador-laboratorios":
            // VISTA VALIDA SOLO PARA ADMINISTRADOR LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultaEspecificaPerfilUsuarios($conectarsistema2, $IdUsuarios);
                // CONSULTA GENERAL DE ACCESOS REGISTRADOS
                $consulta3 = $Gestiones->ConsultarAccesos_PerfilUsuarios($conectarsistema3, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require("../Vista/AdministradorLaboratorio/perfil-administrador-laboratorios.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA MI PERFIL PERSONAL -> DOCENTES
        case "perfil-docente":
            // VISTA VALIDA SOLO PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultaEspecificaPerfilUsuarios($conectarsistema2, $IdUsuarios);
                // CONSULTA GENERAL DE ACCESOS REGISTRADOS
                $consulta3 = $Gestiones->ConsultarAccesos_PerfilUsuarios($conectarsistema3, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require("../Vista/Docentes/perfil-docentes.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // ENVIO A BASE DE DATOS -> ACTUALIZACION CONFIGURACION CUENTAS PERFIL DE USUARIOS
        case "envio-datos-actualizacion-datos-configuracion-perfil-usuarios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $NombresUsuarios = (empty($_POST['txtnombres_usuarios'])) ? NULL : $_POST['txtnombres_usuarios']; // NOMBRES DE USUARIOS
                $ApellidosUsuarios = (empty($_POST['txtapellidos_usuarios'])) ? NULL : $_POST['txtapellidos_usuarios']; // APELLIDOS DE USUARIOS
                $CorreoUsuarios = (empty($_POST['txtcorreo_usuarios'])) ? NULL : $_POST['txtcorreo_usuarios']; // CORREO DE USUARIOS
                $cifrado = (empty($_POST['txtcontrasenia_usuarios'])) ? NULL : $_POST['txtcontrasenia_usuarios']; // ENCRIPTAR CONTRASEÑA INGRESADA
                $options = [
                    'cost' => 12,
                    'time_cost' => 4,
                    'threads' => 1
                ];
                $ContraseniaUsuarios = password_hash($cifrado, PASSWORD_ARGON2I, $options);
                /*
                --------------------------------------------------------------------------------------------
                    IMPORTANTE: EL FORMATO DE CAMBIO DE NOMBRE DE LAS FOTOGRAFIAS SUBIDAS POR
                    LOS USUARIOS ES EL SIGUIENTE: 

                                <<<<   FechaActual_IdUnico_NombreArchivo.Extension >>>>

                    EL NOMBRE DEL ARCHIVO SE MANTIENE, UNICAMENTE CON LOS AGREGADOS ANTES
                    MENCIONADOS.
                --------------------------------------------------------------------------------------------    
                */
                $FotoPerfilUsuarios = $_FILES['flfotoperfilusuarios']['name']; // FOTO DE PERFIL DE USUARIO
                $FechaActual  = date("dHi"); // OBTIENE FECHA ACTUAL RECORTADA
                $IdUnicoFotos  = uniqid(); // GENERA ID UNICO ALEATORIO AUTOMATICAMENTE
                // RUTA DONDE SERA GUARDADA LA NUEVA FOTOGRAFIA CON NOMBRE CAMBIADO
                $Directorio = "../Vista/assets/images/FotoPerfil/" . $FechaActual . "_" . $IdUnicoFotos . "_" . $_FILES['flfotoperfilusuarios']['name'];
                // SOLO OBTENER NOMBRE DE ARCHIVO -> ENVIO A BASE DE DATOS
                $NombreNuevo = $FechaActual . "_" . $IdUnicoFotos . "_" . $_FILES['flfotoperfilusuarios']['name'];
                $UltimoCambio_Contrasenia = date("Y-m-d h:i:s"); // FECHA Y HORA ULTIMA ACTUALIZACION CONTRASEÑA
                // EVITAR INSERCION NULA O VACIA
                if(empty($NombresUsuarios)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // SI USUARIO NO CAMBIA FOTO DE PERFIL, LLAMA PROCEDIMIENTO SIN CAMBIO A FOTO DE PERFIL
                    if(empty($FotoPerfilUsuarios)){
                        $consulta = $Gestiones->ModificarPerfilUsuarios_SinFotoPerfil($conectarsistema, $IdUsuarios, $NombresUsuarios, 
                        $ApellidosUsuarios, $CorreoUsuarios, $ContraseniaUsuarios, $UltimoCambio_Contrasenia);
                        // ENVIANDO RESPUESTA DE ACCION A MODELO
                        echo json_encode($consulta);
                    // SI USUARIO CAMBIA FOTO DE PERFIL, LLAMA PROCEDIMIENTO CON CAMBIO A FOTO DE PERFIL
                    }else{
                        $consulta = $Gestiones->ModificarPerfilUsuarios_ConFotoPerfil($conectarsistema, $IdUsuarios, $NombresUsuarios, 
                        $ApellidosUsuarios, $CorreoUsuarios, $NombreNuevo, $ContraseniaUsuarios, $UltimoCambio_Contrasenia);
                        // COPIA ARCHIVO SUBIDO CON NOMBRE FINAL A LA RUTA ESTABLECIDA
                        copy($_FILES['flfotoperfilusuarios']['tmp_name'], $Directorio);
                        // ACTUALIZANDO VARIABLE DE SESION LUEGO DE PETICION DE EDICION
                        $_SESSION['foto_usuario'] = $NombreNuevo;
                        // ENVIANDO RESPUESTA DE ACCION A MODELO
                        echo json_encode($consulta);
                    }
                    //-> CIERRE DE CONEXIONES
                    $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                }
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3)
            break;
        // ENVIO A BASE DE DATOS -> ACTUALIZACION DETALLES USUARIOS -> PERFIL DE USUARIOS
        case "envio-datos-actualizacion-detalles-usuarios-perfil-usuarios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $TelefonoPrincipal = (empty($_POST['txttelefonoprincipal_usuarios'])) ? NULL : $_POST['txttelefonoprincipal_usuarios']; // TELEFONO PRINCIPAL USUARIOS
                $GeneroUsuarios = (empty($_POST['sltgenero_usuarios'])) ? NULL : $_POST['sltgenero_usuarios']; // GENERO USUARIOS
                $FechaNacimiento = (empty($_POST['txtfechanacimiento_usuarios'])) ? NULL : $_POST['txtfechanacimiento_usuarios']; // FECHA NACIMIENTO USUARIOS
                $EstadoCivil = (empty($_POST['sltestadocivil_usuarios'])) ? NULL : $_POST['sltestadocivil_usuarios']; // ESTADO CIVIC USUARIOS
                /*
                    -> VALIDACION SEGUN GENERO INGRESADO
                        SI ES FEMENINO, ENTONCES HACE EL CAMBIO CORRESPONDIENTE -->  (a)
                        SI ES MASCULINO, ENTONCES HACE EL CAMBIO CORRESPONDIENTE -->  (o)
                */
                if ($GeneroUsuarios == "f") { // -> FEMENINO
                    if ($EstadoCivil == "soltero") {
                        $EstadoCivil = "soltera";
                    } else if ($EstadoCivil == "casado") {
                        $EstadoCivil = "casada";
                    } else if ($EstadoCivil == "divorciado") {
                        $EstadoCivil = "divorciada";
                    } else if ($EstadoCivil == "comprometido") {
                        $EstadoCivil = "comprometida";
                    } else if ($EstadoCivil == "viudo") {
                        $EstadoCivil = "viuda";
                    }
                }else if ($GeneroUsuarios == "m") { // -> MASCULINO
                    if ($EstadoCivil == "soltera") {
                        $EstadoCivil = "soltero";
                    } else if ($EstadoCivil == "casada") {
                        $EstadoCivil = "casado";
                    } else if ($EstadoCivil == "divorciada") {
                        $EstadoCivil = "divorciado";
                    } else if ($EstadoCivil == "comprometida") {
                        $EstadoCivil = "comprometido";
                    } else if ($EstadoCivil == "viuda") {
                        $EstadoCivil = "viudo";
                    }
                }// CIERRE if($GeneroUsuarios == "f")
                // EVITAR INSERCION NULA O VACIA
                if(empty($TelefonoPrincipal)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ModificarDetallesUsuarios_PerfilUsuarios($conectarsistema, $IdUsuarios, $TelefonoPrincipal, 
                    $GeneroUsuarios, $FechaNacimiento, $EstadoCivil);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3)
            break;
        // REGISTRO NUEVOS ROLES DE USUARIOS
        case "registro-nuevos-roles-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/registro-nuevos-roles-usuarios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRO NUEVOS ROLES DE USUARIOS
        case "envio-datos-registro-nuevos-roles-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $NombreRolUsuario = (empty($_POST['txtnombre_rolesusuarios'])) ? NULL : $_POST['txtnombre_rolesusuarios']; // NOMBRE ROL DE USUARIO
                $DescripcionRolUsuario = (empty($_POST['txtdescripcion_rolesusuarios'])) ? NULL : $_POST['txtdescripcion_rolesusuarios']; // DESCRIPCION ROL DE USUARIO
                // EVITAR INSERCION NULA O VACIA
                if(empty($NombreRolUsuario)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistroNuevosRolesUsuarios($conectarsistema, $NombreRolUsuario, $DescripcionRolUsuario);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL ROLES DE USUARIOS REGISTRADOS
        case "consulta-roles-usuarios-registrados":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-roles-usuarios-registrados.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // MODIFICAR DATOS ROLES DE USUARIOS
        case "modificar-roles-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdRolUsuario = (empty($_GET['idrolusuario'])) ? NULL : $_GET['idrolusuario']; // ID UNICO DE ROLES DE USUARIOS
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA -> DATOS ESPECIFICOS DE ROLES DE USUARIOS A MODIFICAR
                $consulta2 = $Gestiones->ConsultaEspecificaRolesUsuariosRegistrados_ModificarDatos($conectarsistema2, $IdRolUsuario);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require("../Vista/AdministradorGeneral/modificar-datos-roles-usuarios.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> MODIFICAR ROLES DE USUARIOS
        case "envio-datos-modificar-roles-usuarios":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdRolUsuario = (empty($_POST['txtidrolusuario'])) ? NULL : $_POST['txtidrolusuario']; // ID UNICO ROL DE USUARIOS
                $NombreRolUsuario = (empty($_POST['txtnombre_rolesusuarios'])) ? NULL : $_POST['txtnombre_rolesusuarios']; // NOMBRE ROL DE USUARIOS
                $DescripcionRolUsuario = (empty($_POST['txtdescripcion_rolesusuarios'])) ? NULL : $_POST['txtdescripcion_rolesusuarios']; // DESCRIPCION ROL DE USUARIOS
                // EVITAR INSERCION NULA O VACIA 
                if(empty($IdRolUsuario)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ModificarRolesUsuarios($conectarsistema, $IdRolUsuario, $NombreRolUsuario, $DescripcionRolUsuario);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // REGISTRO NUEVAS CLASIFICACIONES NOTIFICACIONES
        case "registro-clasificaciones-notificaciones":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/registro-clasificaciones-notificaciones.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> NUEVAS CLASIFICACIONES NOTIFICACIONES
        case "envio-datos-nuevas-clasificaciones-notificaciones":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $CodigoClasificacionNotificaciones = (empty($_POST['txtcodigo_clasificacion_notificaciones'])) ? NULL : $_POST['txtcodigo_clasificacion_notificaciones']; // CODIGO UNICO CLASIFICACION NOTIFICACIONES
                $DescripcionClasificacionNotificaciones = (empty($_POST['txtdescripcion_clasificacion_notificaciones'])) ? NULL : $_POST['txtdescripcion_clasificacion_notificaciones']; // DESCRIPCION CLASIFICACION NOTIFICACIONES
                // EVITAR INSERCION NULA O VACIA 
                if(empty($CodigoClasificacionNotificaciones)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistroNuevasClasificacionesNotificaciones($conectarsistema, 
                    $CodigoClasificacionNotificaciones, $DescripcionClasificacionNotificaciones);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL CLASIFICACIONES DE NOTIFICACIONES REGISTRADAS
        case "consulta-clasificaciones-notificaciones":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS CLASIFICACIONES DE NOTIFICACIONES REGISTRADAS
                $consulta2 = $Gestiones->ConsultarClasificacionesNotificaciones($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-clasificacion-notificaciones.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // MODIFICAR CLASIFICACIONES NOTIFICACIONES
        case "modificar-clasificaciones-notificaciones":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdClasificacionNotificaciones = (empty($_GET['idclasificacion'])) ? NULL : $_GET['idclasificacion']; // ID UNICO CLASIFICACION NOTIFICACIONES
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA -> DATOS ESPECIFICOS DE ROLES DE USUARIOS A MODIFICAR
                $consulta2 = $Gestiones->ConsultaEspecificaClasificacionesNotificaciones_ModificarDatos($conectarsistema2, $IdClasificacionNotificaciones);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require("../Vista/AdministradorGeneral/modificar-datos-clasificaciones-notificaciones.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> MODIFICAR CLASIFICACIONES NOTIFICACIONES
        case "envio-datos-modificar-clasificaciones-notificaciones":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdClasificacionNotificaciones = (empty($_POST['txtid_clasificacion_notificaciones'])) ? NULL : $_POST['txtid_clasificacion_notificaciones']; // ID UNICO CLASIFICACION NOTIFICACIONES
                $CodigoClasificacionNotificaciones = (empty($_POST['txtcodigo_clasificacion_notificaciones'])) ? NULL : $_POST['txtcodigo_clasificacion_notificaciones']; // CODIGO CLASIFICACION NOTIFICACIONES 
                $DescripcionClasificacionNotificaciones = (empty($_POST['txtdescripcion_clasificacion_notificaciones'])) ? NULL : $_POST['txtdescripcion_clasificacion_notificaciones']; // DESCRIPCION CLASIFICACION NOTIFICACIONES
                // EVITAR INSERCION NULA O VACIA 
                if(empty($IdClasificacionNotificaciones)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ModificarClasificacionesNotificaciones($conectarsistema, $IdClasificacionNotificaciones, 
                    $CodigoClasificacionNotificaciones, $DescripcionClasificacionNotificaciones);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO MENSAJERIA A OTROS USUARIOS -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "envio-nuevo-mensaje-usuarios":
             // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultaGeneralUsuariosRegistrados($conectarsistema2);
                require('../Vista/AdministradorGeneral/registro-nuevos-mensajes-usuarios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO MENSAJERIA A OTROS USUARIOS -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "envio-nuevo-mensaje-usuarios-administrador-laboratorios":
            // VISTA VALIDA SOLO PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONSULTA GENERAL DE USUARIOS REGISTRADOS
               $consulta2 = $Gestiones->ConsultaGeneralUsuariosRegistrados($conectarsistema2);
               require('../Vista/AdministradorLaboratorio/registro-nuevos-mensajes-usuarios-administrador-laboratorio.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
           break;
        // ENVIO MENSAJERIA A OTROS USUARIOS -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "envio-nuevo-mensaje-usuarios-docentes":
            // VISTA VALIDA SOLO PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONSULTA GENERAL DE USUARIOS REGISTRADOS
               $consulta2 = $Gestiones->ConsultaGeneralUsuariosRegistrados($conectarsistema2);
               require('../Vista/Docentes/registro-nuevos-mensajes-usuarios-docente.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
           break;
        // BANDEJA DE ENTRADA [SISTEMA MENSAJERIA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "bandeja-entrada-mensajeria":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL TODOS LOS MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA
                $consulta2 = $Gestiones->ConsultarMensajesBandejaEntradaUsuarios($conectarsistema2, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/bandeja-entrada-mensajeria.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // BANDEJA DE ENTRADA [SISTEMA MENSAJERIA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "bandeja-entrada-mensajeria-administrador-laboratorios":
            // VISTA VALIDA SOLO PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL TODOS LOS MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA
                $consulta2 = $Gestiones->ConsultarMensajesBandejaEntradaUsuarios($conectarsistema2, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/bandeja-entrada-mensajeria-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // BANDEJA DE ENTRADA [SISTEMA MENSAJERIA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "bandeja-entrada-mensajeria-docentes":
            // VISTA VALIDA SOLO PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL TODOS LOS MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA
                $consulta2 = $Gestiones->ConsultarMensajesBandejaEntradaUsuarios($conectarsistema2, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/Docentes/bandeja-entrada-mensajeria-docente.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // BANDEJA DE ENTRADA [SISTEMA MENSAJERIA -> MENSAJERIA MARCADA COMO OCULTA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "bandeja-entrada-mensajeria-oculta":
             // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL TODOS LOS MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA [MENSAJERIA OCULTA]
                $consulta2 = $Gestiones->ConsultarMensajesBandejaEntradaUsuarios_MensajesOcultos($conectarsistema2, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/bandeja-entrada-mensajeria-oculta.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // BANDEJA DE ENTRADA [SISTEMA MENSAJERIA -> MENSAJERIA MARCADA COMO OCULTA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "bandeja-entrada-mensajeria-oculta-administrador-laboratorios":
            // VISTA VALIDA SOLO PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONSULTA GENERAL TODOS LOS MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA [MENSAJERIA OCULTA]
               $consulta2 = $Gestiones->ConsultarMensajesBandejaEntradaUsuarios_MensajesOcultos($conectarsistema2, $IdUsuarios);
               // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
               $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
               require('../Vista/AdministradorLaboratorio/bandeja-entrada-mensajeria-oculta-administrador-laboratorio.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
               $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
           break;
        // BANDEJA DE ENTRADA [SISTEMA MENSAJERIA -> MENSAJERIA MARCADA COMO OCULTA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "bandeja-entrada-mensajeria-oculta-docentes":
            // VISTA VALIDA SOLO PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONSULTA GENERAL TODOS LOS MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA [MENSAJERIA OCULTA]
               $consulta2 = $Gestiones->ConsultarMensajesBandejaEntradaUsuarios_MensajesOcultos($conectarsistema2, $IdUsuarios);
               // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
               $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
               require('../Vista/Docentes/bandeja-entrada-mensajeria-oculta-docente.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
               $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
           break;
        // DETALLE MENSAJE RECIBIDO [SISTEMA MENSAJERIA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "detalle-mensaje-recibido":
            // VISTA VALIDA SOLO PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdMensajeria = (empty($_GET['idmensajeria'])) ? NULL : $_GET['idmensajeria']; // ID DE MENSAJE RECIBIDO
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA ESPECIFICA DETALLE MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA
                $consulta2 = $Gestiones->ConsultaEspecificaDetallesMensajesRecibidos($conectarsistema2, $IdUsuarios, $IdMensajeria);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/detalle-mensajes-recibidos-mensajeria.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // DETALLE MENSAJE RECIBIDO [SISTEMA MENSAJERIA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "detalle-mensaje-recibido-administrador-laboratorios":
            // VISTA VALIDA SOLO PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdMensajeria = (empty($_GET['idmensajeria'])) ? NULL : $_GET['idmensajeria']; // ID DE MENSAJE RECIBIDO
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA ESPECIFICA DETALLE MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA
                $consulta2 = $Gestiones->ConsultaEspecificaDetallesMensajesRecibidos($conectarsistema2, $IdUsuarios, $IdMensajeria);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/detalle-mensajes-recibidos-mensajeria-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // DETALLE MENSAJE RECIBIDO [SISTEMA MENSAJERIA] -> VALIDO PARA TODOS LOS ROLES DE USUARIO
        case "detalle-mensaje-recibido-docentes":
            // VISTA VALIDA SOLO PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdMensajeria = (empty($_GET['idmensajeria'])) ? NULL : $_GET['idmensajeria']; // ID DE MENSAJE RECIBIDO
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA ESPECIFICA DETALLE MENSAJES RECIBIDOS -> BANDEJA DE ENTRADA
                $consulta2 = $Gestiones->ConsultaEspecificaDetallesMensajesRecibidos($conectarsistema2, $IdUsuarios, $IdMensajeria);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/Docentes/detalle-mensajes-recibidos-mensajeria-docente.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> MODIFICAR CLASIFICACIONES NOTIFICACIONES [TODOS LOS ROLES DE USUARIO]
        case "envio-datos-nuevo-mensaje-sistema-mensajeria":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $NombreMensaje = (empty($_POST['txtnombremensaje'])) ? NULL : $_POST['txtnombremensaje']; // NOMBRE DE MENSAJE
                $AsuntoMensaje = (empty($_POST['txtasuntomensaje'])) ? NULL : $_POST['txtasuntomensaje']; // ASUNTO DE MENSAJE
                $DetalleMensaje = (empty($_POST['text-box'])) ? NULL : $_POST['text-box']; // DETALLE DE MENSAJE
                $IdUsuarioDestinatario = (empty($_POST['sltidusuariodestinatario'])) ? NULL : $_POST['sltidusuariodestinatario']; // ID DE USUARIO A QUIEN SE ENVIA MENSAJE [DESTINATARIO]
                $ArchivoAdjunto = $_FILES['flarchivomensaje']['name']; // ARCHIVO ADJUNTO MENSAJES
                $FechaActual  = date("dHi"); // OBTIENE FECHA ACTUAL RECORTADA
                $IdUnicoArchivos  = uniqid(); // GENERA ID UNICO ALEATORIO AUTOMATICAMENTE
                // RUTA DONDE SERA GUARDADO EL ARCHIVO CON NOMBRE CAMBIADO
                $Directorio = "../Vista/ArchivosAdjuntosMensajeria/" . $FechaActual . "_" . $IdUnicoArchivos . "_" . $_FILES['flarchivomensaje']['name'];
                // SOLO OBTENER NOMBRE DE ARCHIVO -> ENVIO A BASE DE DATOS
                $NombreNuevo = $FechaActual . "_" . $IdUnicoArchivos . "_" . $_FILES['flarchivomensaje']['name'];
                // EVITAR INSERCION NULA O VACIA 
                if(empty($NombreMensaje)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // SI USUARIOS NO ADJUNTAN NINGUN ARCHIVO, LLAMA PROCEDIMIENTO SIN ARCHIVOS
                    if(empty($ArchivoAdjunto)){
                        $consulta = $Gestiones->EnvioNuevosMensajes_SistemaMensajeria($conectarsistema, $IdUsuarios, $NombreMensaje, $AsuntoMensaje, $DetalleMensaje, $IdUsuarioDestinatario);
                        // ENVIANDO RESPUESTA DE ACCION A MODELO
                        echo json_encode($consulta);
                    // SI USUARIOS ADJUNTA ARCHIVO, LLAMA PROCEDIMIENTO CON ARCHIVOS
                    }else{
                        $consulta = $Gestiones->EnvioNuevosMensajesArchivoAdjunto_SistemaMensajeria($conectarsistema, $IdUsuarios, $NombreMensaje, $AsuntoMensaje, $DetalleMensaje, $IdUsuarioDestinatario, $NombreNuevo);
                        // COPIA ARCHIVO SUBIDO CON NOMBRE FINAL A LA RUTA ESTABLECIDA
                        copy($_FILES['flarchivomensaje']['tmp_name'], $Directorio);
                        // ENVIANDO RESPUESTA DE ACCION A MODELO
                        echo json_encode($consulta);
                    }
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3)
            break;
        // ENVIO A BASE DE DATOS -> OCULTAR MENSAJES USUARIOS [TODOS LOS ROLES DE USUARIO]
        case "envio-datos-ocultar-mensajes-usuarios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3) {
                $IdMensajeria = (empty($_GET['idmensajeria'])) ? NULL : $_GET['idmensajeria']; // ID DE MENSAJE RECIBIDO
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdMensajeria)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->OcultarMensajesRecibidos($conectarsistema, $IdMensajeria);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3)
            break;
        // ENVIO A BASE DE DATOS -> MARCAR COMO LEIDO MENSAJES USUARIOS
        case "envio-datos-marcar-leido-mensajes-usuarios":
             // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
             if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3) {
                $IdMensajeria = (empty($_GET['idmensajeria'])) ? NULL : $_GET['idmensajeria']; // ID DE MENSAJE RECIBIDO
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdMensajeria)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->MarcarComoLeidoMensajesRecibidos($conectarsistema, $IdMensajeria);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3)
            break;
        // LISTADO DE TODAS LAS NOTIFICACIONES RECIBIDAS
        case "listado-mis-notificaciones":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL TODAS LAS NOTIFICACIONES RECIBIDAS
                $consulta2 = $Gestiones->ListadoNotificacionesRecibidas_Completo($conectarsistema2, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/listado-notificaciones-recibidas.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // LISTADO DE TODAS LAS NOTIFICACIONES RECIBIDAS
        case "listado-mis-notificaciones-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL TODAS LAS NOTIFICACIONES RECIBIDAS
                $consulta2 = $Gestiones->ListadoNotificacionesRecibidas_Completo($conectarsistema2, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/listado-notificaciones-recibidas-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // LISTADO DE TODAS LAS NOTIFICACIONES RECIBIDAS
        case "listado-mis-notificaciones-docentes":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL TODAS LAS NOTIFICACIONES RECIBIDAS
                $consulta2 = $Gestiones->ListadoNotificacionesRecibidas_Completo($conectarsistema2, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/Docentes/listado-notificaciones-recibidas-docente.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // ENVIO A BASE DE DATOS -> OCULTAR NOTIFICACIONES RECIBIDAS USUARIOS [TODOS LOS ROLES DE USUARIO]
        case "envio-datos-ocultar-notificaciones-usuarios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3) {
                $IdNotificacionUsuarios = (empty($_GET['idnotificacion'])) ? NULL : $_GET['idnotificacion']; // ID DE NOTIFICACION RECIBIDA
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdNotificacionUsuarios)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->OcultarNotificacionesUsuarios($conectarsistema, $IdNotificacionUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=3)
            break;
        // REPORTE PROBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA] [TODOS LOS ROLES DE USUARIO]
        case "soporte-tecnico-reporte-problemas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/registro-reportes-problemas-plataforma.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // REPORTE PROBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA] [TODOS LOS ROLES DE USUARIO]
        case "soporte-tecnico-reporte-problemas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/registro-reportes-problemas-plataforma-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // REPORTE PROBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA] [TODOS LOS ROLES DE USUARIO]
        case "soporte-tecnico-reporte-problemas-docentes":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/Docentes/registro-reportes-problemas-plataforma-docente.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRO PROBLEMAS PLATAFORMA [MANIFIESTO PLATAFORMA] [TODOS LOS ROLES DE USUARIO]
        case "envio-datos-registro-problemas-plataforma":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $NombreReporte = (empty($_POST['txtnombre_reporteplataforma'])) ? NULL : $_POST['txtnombre_reporteplataforma']; // NOMBRE DE REPORTE
                $DescripcionReporte = (empty($_POST['txtdescripcion_reporteplataforma'])) ? NULL : $_POST['txtdescripcion_reporteplataforma']; // DESCRIPCION DE REPORTE
                $FotoReporte = $_FILES['flfotoreporteplataforma']['name']; // ARCHIVO ADJUNTO REPORTES PLATAFORMA
                $FechaActual  = date("dHi"); // OBTIENE FECHA ACTUAL RECORTADA
                $IdUnicoArchivos  = uniqid(); // GENERA ID UNICO ALEATORIO AUTOMATICAMENTE
                // RUTA DONDE SERA GUARDADO EL ARCHIVO CON NOMBRE CAMBIADO
                $Directorio = "../Vista/FotosReportesPlataforma/" . $FechaActual . "_" . $IdUnicoArchivos . "_" . $_FILES['flfotoreporteplataforma']['name'];
                // SOLO OBTENER NOMBRE DE ARCHIVO -> ENVIO A BASE DE DATOS
                $NombreNuevo = $FechaActual . "_" . $IdUnicoArchivos . "_" . $_FILES['flfotoreporteplataforma']['name'];
                // EVITAR INSERCION NULA O VACIA
                if(empty($NombreReporte)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistroProblemasPlataforma($conectarsistema, $IdUsuarios, $NombreReporte, $DescripcionReporte, $NombreNuevo);
                    // COPIA ARCHIVO SUBIDO CON NOMBRE FINAL A LA RUTA ESTABLECIDA
                    copy($_FILES['flfotoreporteplataforma']['tmp_name'], $Directorio);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3)
            break;
        // CONSULTA GENERAL REPORTES PROBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA]
        case "consulta-soporte-tecnico-reporte-problemas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODOS LOS PROBLEMAS PLATAFORMA REGISTRADOS
                $consulta2 = $Gestiones->ConsultaProblemaPlataformasRegistrados_ConsultaGeneral($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-problemas-plataforma-registrados.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONTEO POR ESTADO REPORTES PLOBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA]
        case "conteo-por-estados-reportes-plataforma":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $consulta = $Gestiones->ConteoPorEstado_ProblemasPlataforma($conectarsistema);
                // INICIALIZACION DATOS JSON TIPO ARRAY
                $DatosConsulta = array();
                // RECORRIDO DE TODA LA CONSULTA ESTABLECIDA EN LA RESPECTIVA VISTA
                while ($filas = mysqli_fetch_assoc($consulta)) {
                    $DatosConsulta[] = array( 
                        "ReportesPendientes"=>$filas['ReportesPendientes'],
                        "ReportesEnProceso"=>$filas['ReportesEnProceso'],
                        "ReportesResueltos"=>$filas['ReportesResueltos'],
                        "ReportesCerrados"=>$filas['ReportesCerrados']
                    );
                }
                // OBTENER DATOS FINALES JSON EN FORMATO ARRAY
                $ResultadoJSON = array(
                "resultado" => $DatosConsulta //-> "resultado" -> VARIABLE DECLARADA EN EL MODELO $resultado
                );
                // -> EXTRAER CONSULTA PARA POSTERIOR TRATAMIENTO JS - AJAX
                echo json_encode($ResultadoJSON,JSON_UNESCAPED_UNICODE);
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // GESTIONAR TODOS LOS REPORTES PROBLEMAS PLATAFORMA [MANIFIESTOS PLATAFORMA]
        case "gestionar-soporte-tecnico-reporte-problemas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdManifiesto = (empty($_GET['idmanifiesto'])) ? NULL : $_GET['idmanifiesto']; // ID DE MANIFIESTO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODOS LOS PROBLEMAS PLATAFORMA REGISTRADOS
                $consulta2 = $Gestiones->ConsultaEspecificaManifiestosPlataforma_GestionarReportes($conectarsistema2, $IdManifiesto);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/gestionar-reportes-problemas-plataforma.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRO PROBLEMAS PLATAFORMA [MANIFIESTO PLATAFORMA]
        case "envio-datos-gestionar-problemas-plataforma":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdManifiesto = (empty($_POST['txtid_reporteplataforma'])) ? NULL : $_POST['txtid_reporteplataforma']; // ID UNICO DE REPORTE
                $EstadoManifiesto = (empty($_POST['sltestado_reporteplataforma'])) ? NULL : $_POST['sltestado_reporteplataforma']; // ESTADO DE REPORTE
                $ComentarioActualizacionManifiesto = (empty($_POST['txtdescripcionactualizacion_reporteplataforma'])) ? NULL : $_POST['txtdescripcionactualizacion_reporteplataforma']; // DESCRIPCION ACTUALIZACION DE REPORTE
                // EVITAR INSERCION NULA O VACIA
                if(empty($ComentarioActualizacionManifiesto)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ActualizacionProblemasPlataforma($conectarsistema, $IdManifiesto, $EstadoManifiesto, $ComentarioActualizacionManifiesto);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // REGISTRO NUEVOS LABORATORIOS DE INFORMATICA
        case "registro-nuevos-laboratorios-informatica":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/registro-nuevos-laboratorios-informatica.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRO NUEVOS LABORATORIOS INFORMATICA
        case "envio-datos-registro-nuevos-laboratorios-informatica":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $CodigoLaboratorio = (empty($_POST['txtcodigo_laboratorio'])) ? NULL : $_POST['txtcodigo_laboratorio']; // CODIGO UNICO DE LABORATORIO
                $NombreLaboratorio = (empty($_POST['txtnombre_laboratorio'])) ? NULL : $_POST['txtnombre_laboratorio']; // NOMBRE DE LABORATORIO
                $CapacidadLaboratorio = (empty($_POST['txtcapacidad_laboratorio'])) ? NULL : $_POST['txtcapacidad_laboratorio']; // CAPACIDAD DE LABORATORIO
                $CodigoColorLaboratorio = (empty($_POST['txtcodigocolor_laboratorio'])) ? NULL : $_POST['txtcodigocolor_laboratorio']; // CODIGO COLOR DE LABORATORIO
                // EVITAR INSERCION NULA O VACIA
                if(empty($CodigoLaboratorio)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistroNuevosLaboratoriosInformatica($conectarsistema, $CodigoLaboratorio, $NombreLaboratorio, 
                    $CapacidadLaboratorio, $CodigoColorLaboratorio);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL LABORATORIOS INFORMATICA [SIN FILTROS] [COORDINADORES Y ADMINISTRADORES DE LABORATORIO]
        case "consulta-laboratorios-informatica":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [SIN FILTROS]
                $consulta2 = $Gestiones->ConsultaLaboratoriosInformaticaRegistrados_ConsultaGeneral($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-laboratorios-informatica.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL LABORATORIOS INFORMATICA [SIN FILTROS] [COORDINADORES Y ADMINISTRADORES DE LABORATORIO]
        case "consulta-laboratorios-informatica-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONSULTAR TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [SIN FILTROS]
               $consulta2 = $Gestiones->ConsultaLaboratoriosInformaticaRegistrados_ConsultaGeneral($conectarsistema2);
               // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
               $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
               require('../Vista/AdministradorLaboratorio/consulta-general-laboratorios-informatica-administrador-laboratorio.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
               $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
           break;
        // CONSULTA GENERAL LABORATORIOS INFORMATICA [INACTIVOS]
        case "consulta-laboratorios-informatica-inactivos":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [SIN FILTROS]
                $consulta2 = $Gestiones->ConsultaLaboratoriosInformaticaRegistrados_Inactivos($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-laboratorios-informatica-inactivos.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL LABORATORIOS INFORMATICA [INACTIVOS]
        case "consulta-laboratorios-informatica-inactivos-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [SIN FILTROS]
                $consulta2 = $Gestiones->ConsultaLaboratoriosInformaticaRegistrados_Inactivos($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-laboratorios-informatica-inactivos-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL LABORATORIOS INFORMATICA [SIN FILTROS] [GESTIONAR LABORATORIOS DE INFORMATICA] [COORDINADORES Y ADMINISTRADORES DE LABORATORIOS]
        case "gestionar-laboratorios-informatica":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdLaboratorio = (empty($_GET['idlaboratorio'])) ? NULL : $_GET['idlaboratorio']; // ID DE LABORATORIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [SEGUN ID DE LABORATORIO SELECCIONADO]
                $consulta2 = $Gestiones->ConsultaEspecificaLaboratoriosInformatica($conectarsistema2, $IdLaboratorio);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/modificar-laboratorios-informatica.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL LABORATORIOS INFORMATICA [SIN FILTROS] [GESTIONAR LABORATORIOS DE INFORMATICA] [COORDINADORES Y ADMINISTRADORES DE LABORATORIOS]
        case "gestionar-laboratorios-informatica-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdLaboratorio = (empty($_GET['idlaboratorio'])) ? NULL : $_GET['idlaboratorio']; // ID DE LABORATORIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODOS LOS LABORATORIOS DE INFORMATICA REGISTRADOS [SEGUN ID DE LABORATORIO SELECCIONADO]
                $consulta2 = $Gestiones->ConsultaEspecificaLaboratoriosInformatica($conectarsistema2, $IdLaboratorio);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/modificar-laboratorios-informatica-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // ENVIO A BASE DE DATOS -> MODIFICAR DATOS DE LABORATORIOS [EXCLUSIVO COORDINADOR DE LABORATORIOS]
        case "envio-datos-gestionar-laboratorios-informatica":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdLaboratorio = (empty($_POST['txtid_laboratorio'])) ? NULL : $_POST['txtid_laboratorio']; // ID DE LABORATORIO
                $CodigoLaboratorio = (empty($_POST['txtcodigo_laboratorio'])) ? NULL : $_POST['txtcodigo_laboratorio']; // CODIGO DE LABORATORIO
                $NombreLaboratorio = (empty($_POST['txtnombre_laboratorio'])) ? NULL : $_POST['txtnombre_laboratorio']; // NOMBRE DE LABORATORIO
                $CapacidadLaboratorio = (empty($_POST['txtcapacidad_laboratorio'])) ? NULL : $_POST['txtcapacidad_laboratorio']; // CAPACIDAD DE LABORATORIO
                $EquiposFueraUsoLaboratorio = (empty($_POST['txtequiposfuerauso_laboratorio'])) ? NULL : $_POST['txtequiposfuerauso_laboratorio']; // EQUIPOS FUERA DE USO LABORATORIO
                $EstadoLaboratorio = (empty($_POST['sltestado_laboratorio'])) ? NULL : $_POST['sltestado_laboratorio']; // ESTADO DE LABORATORIO
                $CodigoColorLaboratorio = (empty($_POST['txtcodigocolor_laboratorio'])) ? NULL : $_POST['txtcodigocolor_laboratorio']; // CODIGO COLOR DE LABORATORIO
                // EVITAR INSERCION NULA O VACIA
                if(empty($CodigoLaboratorio)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ActualizacionDatosLaboratoriosInformatica($conectarsistema, $IdLaboratorio, $CodigoLaboratorio, $NombreLaboratorio, 
                    $CapacidadLaboratorio, $EquiposFueraUsoLaboratorio, $EstadoLaboratorio, $CodigoColorLaboratorio);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> MODIFICAR DATOS DE LABORATORIOS [EXCLUSIVO ADMINISTRADOR DE LABORATORIOS]
        case "envio-datos-gestionar-laboratorios-informatica-admlabs":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdLaboratorio = (empty($_POST['txtid_laboratorio'])) ? NULL : $_POST['txtid_laboratorio']; // ID DE LABORATORIO
                $CapacidadLaboratorio = (empty($_POST['txtcapacidad_laboratorio'])) ? NULL : $_POST['txtcapacidad_laboratorio']; // CAPACIDAD DE LABORATORIO
                $EquiposFueraUsoLaboratorio = (empty($_POST['txtequiposfuerauso_laboratorio'])) ? NULL : $_POST['txtequiposfuerauso_laboratorio']; // EQUIPOS FUERA DE USO LABORATORIO
                $EstadoLaboratorio = (empty($_POST['sltestado_laboratorio'])) ? NULL : $_POST['sltestado_laboratorio']; // ESTADO DE LABORATORIO
                // EVITAR INSERCION NULA O VACIA
                if(empty($CapacidadLaboratorio)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ActualizacionDatosLaboratoriosInformaticaAdminLabs($conectarsistema, $IdLaboratorio, $CapacidadLaboratorio, 
                    $EquiposFueraUsoLaboratorio, $EstadoLaboratorio);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // REGISTRO APLICACIONES [PROGRAMAS DE COMPUTADORAS] ASIGNADOS A CADA LABORATORIO INFORMATICO
        case "registro-aplicaciones-laboratorios-informatica":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS CLASIFICACIONES APLICACIONES DE LABORATORIOS
                $consulta2 = $Gestiones->ConsultaGeneralClasificacionAplicacionesLaboratorios($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/registro-aplicaciones-laboratorios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // REGISTRO APLICACIONES [PROGRAMAS DE COMPUTADORAS] ASIGNADOS A CADA LABORATORIO INFORMATICO
        case "registro-aplicaciones-laboratorios-informatica-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS CLASIFICACIONES APLICACIONES DE LABORATORIOS
                $consulta2 = $Gestiones->ConsultaGeneralClasificacionAplicacionesLaboratorios($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/registro-aplicaciones-laboratorios-administrador-laboratorios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRO NUEVAS APLICACIONES LABORATORIOS DE INFORMATICA
        case "envio-datos-registro-aplicaciones-laboratorio":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $CodigoAplicaciones = (empty($_POST['txtcodigoaplicaciones_laboratorio'])) ? NULL : $_POST['txtcodigoaplicaciones_laboratorio']; // CODIGO APLICACION DE LABORATORIO
                $NombreAplicaciones = (empty($_POST['txtnombreaplicaciones_laboratorio'])) ? NULL : $_POST['txtnombreaplicaciones_laboratorio']; // NOMBRE APLICACION DE LABORATORIO
                $Laboratorio1 = isset($_POST['chklab1']) && $_POST['chklab1'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 1
                $Laboratorio2 = isset($_POST['chklab2']) && $_POST['chklab2'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 2
                $Laboratorio3 = isset($_POST['chklab3']) && $_POST['chklab3'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 3
                $Laboratorio4 = isset($_POST['chklab4']) && $_POST['chklab4'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 4
                $Laboratorio5 = isset($_POST['chklab5']) && $_POST['chklab5'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 5
                $Laboratorio6 = isset($_POST['chklab6']) && $_POST['chklab6'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 6
                $Laboratorio7 = isset($_POST['chklab7']) && $_POST['chklab7'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 7
                $Laboratorio8 = isset($_POST['chklab8']) && $_POST['chklab8'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 8
                $Laboratorio9 = isset($_POST['chklab9']) && $_POST['chklab9'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 9
                $Laboratorio10 = isset($_POST['chklab10']) && $_POST['chklab10'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 10
                $Laboratorio11 = isset($_POST['chklab11']) && $_POST['chklab11'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 11
                $Laboratorio12 = isset($_POST['chklab12']) && $_POST['chklab12'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 12
                $Laboratorio13 = isset($_POST['chklab13']) && $_POST['chklab13'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 13
                $Laboratorio14 = isset($_POST['chklab14']) && $_POST['chklab14'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 14
                $Laboratorio15 = isset($_POST['chklab15']) && $_POST['chklab15'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 15
                $IdClasificacionAplicacion = (empty($_POST['slclasificacionaplicaciones_laboratorio'])) ? NULL : $_POST['slclasificacionaplicaciones_laboratorio']; // CLASIFICACION TIPO APLICACION LABORATORIOS
                // EVITAR INSERCION NULA O VACIA
                if(empty($CodigoAplicaciones)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistroAplicacionesLaboratoriosInformatica($conectarsistema, $CodigoAplicaciones, $NombreAplicaciones, $Laboratorio1, $Laboratorio2, $Laboratorio3, 
                    $Laboratorio4, $Laboratorio5, $Laboratorio6, $Laboratorio7, $Laboratorio8, $Laboratorio9, $Laboratorio10, $Laboratorio11, $Laboratorio12, $Laboratorio13, $Laboratorio14, 
                    $Laboratorio15, $IdClasificacionAplicacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [TODOS SIN EXCEPCION]
        case "consulta-aplicaciones-laboratorio-informatica-general":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [TODOS LOS LABORATORIOS]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorios($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorios-informatica.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [TODOS SIN EXCEPCION]
        case "consulta-aplicaciones-laboratorio-informatica-general-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [TODOS LOS LABORATORIOS]
               $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorios($conectarsistema2);
               // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
               $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
               require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorios-administrador-laboratorios.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
               $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
           break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 1]
        case "consulta-aplicaciones-laboratorio-informatica-uno":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio1.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 1]
        case "consulta-aplicaciones-laboratorio-informatica-uno-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio1-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 2]
        case "consulta-aplicaciones-laboratorio-informatica-dos":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB2]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio2($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio2.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 2]
        case "consulta-aplicaciones-laboratorio-informatica-dos-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio2-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 3]
        case "consulta-aplicaciones-laboratorio-informatica-tres":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB3]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio3($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio3.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 3]
        case "consulta-aplicaciones-laboratorio-informatica-tres-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio3-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 4]
        case "consulta-aplicaciones-laboratorio-informatica-cuatro":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB4]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio4($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio4.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 4]
        case "consulta-aplicaciones-laboratorio-informatica-cuatro-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio4-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 5]
        case "consulta-aplicaciones-laboratorio-informatica-cinco":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB5]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio5($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio5.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 5]
        case "consulta-aplicaciones-laboratorio-informatica-cinco-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio5-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 6]
        case "consulta-aplicaciones-laboratorio-informatica-seis":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB6]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio6($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio6.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 6]
        case "consulta-aplicaciones-laboratorio-informatica-seis-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio6-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 7]
        case "consulta-aplicaciones-laboratorio-informatica-siete":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB7]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio7($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio7.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 7]
        case "consulta-aplicaciones-laboratorio-informatica-siete-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio7-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 8]
        case "consulta-aplicaciones-laboratorio-informatica-ocho":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB8]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio8($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio8.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 8]
        case "consulta-aplicaciones-laboratorio-informatica-ocho-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio8-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 9]
        case "consulta-aplicaciones-laboratorio-informatica-nueve":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB9]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio9($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio9.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 9]
        case "consulta-aplicaciones-laboratorio-informatica-nueve-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio9-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 10]
        case "consulta-aplicaciones-laboratorio-informatica-diez":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB10]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio10($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio10.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 10]
        case "consulta-aplicaciones-laboratorio-informatica-diez-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio10-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 11]
        case "consulta-aplicaciones-laboratorio-informatica-once":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB11]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio11($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio11.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 11]
        case "consulta-aplicaciones-laboratorio-informatica-once-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio11-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
         // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 12]
         case "consulta-aplicaciones-laboratorio-informatica-doce":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB12]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio12($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio12.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 12]
        case "consulta-aplicaciones-laboratorio-informatica-doce-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio12-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 13]
        case "consulta-aplicaciones-laboratorio-informatica-trece":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB13]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio13($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio13.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 13]
        case "consulta-aplicaciones-laboratorio-informatica-trece-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio13-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 14]
        case "consulta-aplicaciones-laboratorio-informatica-catorce":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB14]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio14($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio14.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 14]
        case "consulta-aplicaciones-laboratorio-informatica-catorce-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio14-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 15]
        case "consulta-aplicaciones-laboratorio-informatica-quince":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB15]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio15($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-aplicaciones-instaladas-laboratorio15.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [LABORATORIO 15]
        case "consulta-aplicaciones-laboratorio-informatica-quince-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS APLICACIONES INSTALADAS [LAB1]
                $consulta2 = $Gestiones->ConsultaGeneralAplicacionesInstaladasLaboratorio1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-aplicaciones-instaladas-laboratorio15-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // GESTIONAR APLICACIONES REGISTRADAS -> LABORATORIOS INFORMATICA [TODOS SEGUN ID DE APLICACION A GESTIONAR]
        case "gestionar-aplicaciones-laboratorios-informatica":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdAplicacion = (empty($_GET['idaplicacion'])) ? NULL : $_GET['idaplicacion']; // ID DE APLICACION DE LABORATORIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS CLASIFICACIONES APLICACIONES DE LABORATORIOS
                $consulta2 = $Gestiones->ConsultaGeneralClasificacionAplicacionesLaboratorios($conectarsistema2);
                // CONSULTAR TODOS LOS DETALLES DE APLICACION REGISTRADA
                $consulta3 = $Gestiones->ConsultaEspecificaAplicacionesLaboratoriosInformatica($conectarsistema3, $IdAplicacion);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/AdministradorGeneral/modificar-datos-aplicaciones-laboratorios-informatica.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // GESTIONAR APLICACIONES REGISTRADAS -> LABORATORIOS INFORMATICA [TODOS SEGUN ID DE APLICACION A GESTIONAR]
        case "gestionar-aplicaciones-laboratorios-informatica-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               $IdAplicacion = (empty($_GET['idaplicacion'])) ? NULL : $_GET['idaplicacion']; // ID DE APLICACION DE LABORATORIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONSULTA TODAS LAS CLASIFICACIONES APLICACIONES DE LABORATORIOS
               $consulta2 = $Gestiones->ConsultaGeneralClasificacionAplicacionesLaboratorios($conectarsistema2);
               // CONSULTAR TODOS LOS DETALLES DE APLICACION REGISTRADA
               $consulta3 = $Gestiones->ConsultaEspecificaAplicacionesLaboratoriosInformatica($conectarsistema3, $IdAplicacion);
               // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
               $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
               require('../Vista/AdministradorLaboratorio/modificar-datos-aplicaciones-laboratorios-informatica-administrador-laboratorio.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
               $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
               $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
           break;
        // ENVIO A BASE DE DATOS -> REGISTRO NUEVAS APLICACIONES LABORATORIOS DE INFORMATICA
        case "envio-datos-modificar-aplicaciones-laboratorio":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $IdAplicacion = (empty($_POST['txtidaplicaciones_laboratorio'])) ? NULL : $_POST['txtidaplicaciones_laboratorio']; // ID UNICO APLICACION DE LABORATORIO
                $CodigoAplicaciones = (empty($_POST['txtcodigoaplicaciones_laboratorio'])) ? NULL : $_POST['txtcodigoaplicaciones_laboratorio']; // CODIGO APLICACION DE LABORATORIO
                $NombreAplicaciones = (empty($_POST['txtnombreaplicaciones_laboratorio'])) ? NULL : $_POST['txtnombreaplicaciones_laboratorio']; // NOMBRE APLICACION DE LABORATORIO
                $Laboratorio1 = isset($_POST['chklab1']) && $_POST['chklab1'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 1
                $Laboratorio2 = isset($_POST['chklab2']) && $_POST['chklab2'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 2
                $Laboratorio3 = isset($_POST['chklab3']) && $_POST['chklab3'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 3
                $Laboratorio4 = isset($_POST['chklab4']) && $_POST['chklab4'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 4
                $Laboratorio5 = isset($_POST['chklab5']) && $_POST['chklab5'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 5
                $Laboratorio6 = isset($_POST['chklab6']) && $_POST['chklab6'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 6
                $Laboratorio7 = isset($_POST['chklab7']) && $_POST['chklab7'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 7
                $Laboratorio8 = isset($_POST['chklab8']) && $_POST['chklab8'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 8
                $Laboratorio9 = isset($_POST['chklab9']) && $_POST['chklab9'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 9
                $Laboratorio10 = isset($_POST['chklab10']) && $_POST['chklab10'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 10
                $Laboratorio11 = isset($_POST['chklab11']) && $_POST['chklab11'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 11
                $Laboratorio12 = isset($_POST['chklab12']) && $_POST['chklab12'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 12
                $Laboratorio13 = isset($_POST['chklab13']) && $_POST['chklab13'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 13
                $Laboratorio14 = isset($_POST['chklab14']) && $_POST['chklab14'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 14
                $Laboratorio15 = isset($_POST['chklab15']) && $_POST['chklab15'] === 'on' ? 'si' : 'no'; // DISPONIBILIDAD APLICACION DE LABORATORIO 15
                $IdClasificacionAplicacion = (empty($_POST['slclasificacionaplicaciones_laboratorio'])) ? NULL : $_POST['slclasificacionaplicaciones_laboratorio']; // CLASIFICACION TIPO APLICACION LABORATORIOS
                // EVITAR INSERCION NULA O VACIA
                if(empty($CodigoAplicaciones)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ModificarAplicacionesLaboratoriosInformatica($conectarsistema, $IdAplicacion, $CodigoAplicaciones, $NombreAplicaciones, $Laboratorio1, $Laboratorio2, $Laboratorio3, $Laboratorio4, $Laboratorio5, $Laboratorio6, 
                    $Laboratorio7, $Laboratorio8, $Laboratorio9, $Laboratorio10, $Laboratorio11, $Laboratorio12, $Laboratorio13, $Laboratorio14, $Laboratorio15, $IdClasificacionAplicacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
         // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [TODOS SIN EXCEPCION]
         case "registro-nuevos-tipos-reservaciones":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/registro-tipos-reservaciones.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRO NUEVOS TIPOS RESERVACIONES
        case "envio-datos-registro-tipos-reservaciones":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $NombreTipoReservacion = (empty($_POST['txtnombre_tiporeservacion'])) ? NULL : $_POST['txtnombre_tiporeservacion']; // NOMBRE TIPO RESERVACION
                $DescripcionTipoReservacion = (empty($_POST['txtdescripcion_tiporeservacion'])) ? NULL : $_POST['txtdescripcion_tiporeservacion']; // DESCRIPCION TIPO RESERVACION
                // EVITAR INSERCION NULA O VACIA
                if(empty($NombreTipoReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistroNuevosTiposReservaciones($conectarsistema, $NombreTipoReservacion, $DescripcionTipoReservacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL TIPOS DE RESERVACIONES [TODOS]
        case "consulta-tipos-reservaciones-general":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta2 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-genera-tipos-reservaciones.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL APLICACIONES INSTALADAS LABORATORIOS INFORMATICA [TODOS SIN EXCEPCION]
        case "modificar-tipos-reservaciones":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdTipoReservacion = (empty($_GET['idtiporeservacion'])) ? NULL : $_GET['idtiporeservacion']; // ID UNICO TIPO RESERVACION
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA ESPECIFICA TIPO DE RESERVACIONES
                $consulta2 = $Gestiones->ConsultaEspecificaTiposReservaciones($conectarsistema2, $IdTipoReservacion);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/modificar-datos-tipos-reservaciones.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> MODIFICAR TIPOS DE RESERVACIONES
        case "envio-datos-modificar-tipos-reservaciones":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdTipoReservacion = (empty($_POST['txtid_tipos_reservaciones'])) ? NULL : $_POST['txtid_tipos_reservaciones']; // ID TIPO RESERVACION
                $NombreTipoReservacion = (empty($_POST['txtnombre_tiporeservacion'])) ? NULL : $_POST['txtnombre_tiporeservacion']; // NOMBRE TIPO RESERVACION
                $DescripcionTipoReservacion = (empty($_POST['txtdescripcion_tiporeservacion'])) ? NULL : $_POST['txtdescripcion_tiporeservacion']; // DESCRIPCION TIPO RESERVACION
                // EVITAR INSERCION NULA O VACIA
                if(empty($NombreTipoReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ModificarTiposReservaciones($conectarsistema, $IdTipoReservacion, $NombreTipoReservacion, $DescripcionTipoReservacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO]
        case "gestion-reservaciones-laboratorios-primera-fase":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/AdministradorGeneral/inicio-proceso-reservaciones-laboratorios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO ADMINISTRADOR DE LABORATORIO]
        case "gestion-reservaciones-laboratorios-primera-fase-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/inicio-proceso-reservaciones-laboratorios-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO DOCENTES]
        case "gestion-reservaciones-laboratorios-primera-fase-docentes":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/Docentes/inicio-proceso-reservaciones-laboratorios-docentes.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO]
        // RESERVACIONES SOLICITADAS POR DOCENTES, POR MODULOS IMPARES U OTROS MOTIVOS
        case "gestion-reservaciones-solicitadas-laboratorios-primera-fase":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/AdministradorGeneral/inicio-proceso-reservaciones-solicitadas-laboratorios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO ADMINISTRADOR DE LABORATORIO]
        // RESERVACIONES SOLICITADAS POR DOCENTES, POR MODULOS IMPARES U OTROS MOTIVOS
        case "gestion-reservaciones-solicitadas-laboratorios-primera-fase-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/inicio-proceso-reservaciones-solicitadas-laboratorios-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO]
        case "gestion-reservaciones-laboratorios-segunda-fase":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $AplicacionReservacion = (empty($_POST['sltaplicacionreservacion'])) ? NULL : $_POST['sltaplicacionreservacion']; // APLICACION A UTILIZAR
                $NumeroUsuariosReservacion = (empty($_POST['txtcantidadusuariosreservacion'])) ? NULL : $_POST['txtcantidadusuariosreservacion']; // NUMERO DE USUARIOS A ASISTIR
                $FechaFinReservacion = (empty($_POST['txtFinalizacionReservacion'])) ? NULL : $_POST['txtFinalizacionReservacion']; // FECHA FINALIZACION RESERVACION
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacion'])) ? NULL : $_POST['txtInicioReservacion']; // FECHA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraFinalizacion'])) ? NULL : $_POST['txtHoraFinalizacion']; // HORA FINALIZACION RESERVACION
                // RESTAR UN MINUTO PARA EFECTOS DE CONSULTA LABORATORIOS CON MODULOS INCLUIDOS
                $HoraFinReservacionLabsModulos = date('H:i:s', strtotime($HoraFinReservacion . ' -1 minute'));
                $HoraInicioReservacion = (empty($_POST['txtHoraInicio'])) ? NULL : $_POST['txtHoraInicio']; // HORA INICIO RESERVACION
                $ExtensionCicloCompleto = (empty($_POST['sltextensionfechas_reservacion'])) ? NULL : $_POST['sltextensionfechas_reservacion']; // EXTENSION CICLO COMPLETO
                /****************************************************************************************************************
                 * -> CONTROL DE DIAS SELECCIONADOS SI LA RESERVACION SE REPETIRA MAS DE DOS DIAS [TODO EL CICLO INCLUSIVE]
                 ***************************************************************************************************************/
                $DiaLunes = isset($_POST['lunes']) && $_POST['lunes'] === 'on' ? 'si' : 'no'; // DIA LUNES SELECCIONADO
                $DiaMartes = isset($_POST['martes']) && $_POST['martes'] === 'on' ? 'si' : 'no'; // DIA MARTES SELECCIONADO
                $DiaMiercoles = isset($_POST['miercoles']) && $_POST['miercoles'] === 'on' ? 'si' : 'no'; // DIA MIERCOLES SELECCIONADO
                $DiaJueves = isset($_POST['jueves']) && $_POST['jueves'] === 'on' ? 'si' : 'no'; // DIA JUEVES SELECCIONADO
                $DiaViernes = isset($_POST['viernes']) && $_POST['viernes'] === 'on' ? 'si' : 'no'; // DIA VIERNES SELECCIONADO
                $DiaSabado = isset($_POST['sabado']) && $_POST['sabado'] === 'on' ? 'si' : 'no'; // DIA SABADO SELECCIONADO
                $DiaDomingo = isset($_POST['domingo']) && $_POST['domingo'] === 'on' ? 'si' : 'no'; // DIA DOMINGO SELECCIONADO
                /**************************************************************************************************************************************************************
                 * -> IMPORTANTE: PARA UNA MEJOR GESTION DE LAS RESERVACIONES EN EL CALENDARIO DE ACTIVIDADES, TODOS LOS TIPOS DE RESERVACIONES SE REGISTRARAN EN REGISTROS
                 * SEPARADOS HASTA CUMPLIR CON EL FIN DE LA FECHA ESPECIFICADA. TODAS LAS RESERVACIONES ESTARAN LIGADOS A UN IDENTIFICADOR UNICO PARA GESTIONAR LAS MISMAS
                 * EN OTRA SECCION DE ESTE SISTEMA
                 **************************************************************************************************************************************************************/
                $VerificarTipoReservacionInicial = (empty($_POST['slttipoinicial_reservacion'])) ? NULL : $_POST['slttipoinicial_reservacion']; // TIPO DE RESERVACION INICIAL
                $CantidadDiasTipoReservacionInicial = (empty($_POST['txtcantidadias_inicialreservacion'])) ? NULL : $_POST['txtcantidadias_inicialreservacion']; // CANTIDAD DIAS TIPO DE RESERVACION INICIAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS
                $consulta3 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema3, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta4 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema4);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta5 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema5, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta6 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema6);
                // CONSULTA TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS
                $consulta7 = $Gestiones->ConsultarEscuelasFacultadesRegistradas($conectarsistema7);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta8 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema8, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> MOSTRAR ESAS OPCIONES EN EL MISMO <SELECT></SELECT>
                $consulta9 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema9, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> VALIDACION DE MODULOS OCUPADOS POR LABORATORIO
                $consulta10 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema10, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta10 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema10);
                */
                require('../Vista/AdministradorGeneral/oferta-ofrecida-reservaciones-usuarios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta10); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA10
                mysqli_free_result($consulta9); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA9
                mysqli_free_result($consulta7); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA7
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                $conectarsistema8->close(); // CERRANDO CONEXION AUXILIAR 8
                $conectarsistema9->close(); // CERRANDO CONEXION AUXILIAR 9
                $conectarsistema10->close(); // CERRANDO CONEXION AUXILIAR 10
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO ADMINISTRADOR DE LABORATORIO]
        case "gestion-reservaciones-laboratorios-segunda-fase-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $AplicacionReservacion = (empty($_POST['sltaplicacionreservacion'])) ? NULL : $_POST['sltaplicacionreservacion']; // APLICACION A UTILIZAR
                $NumeroUsuariosReservacion = (empty($_POST['txtcantidadusuariosreservacion'])) ? NULL : $_POST['txtcantidadusuariosreservacion']; // NUMERO DE USUARIOS A ASISTIR
                $FechaFinReservacion = (empty($_POST['txtFinalizacionReservacion'])) ? NULL : $_POST['txtFinalizacionReservacion']; // FECHA FINALIZACION RESERVACION
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacion'])) ? NULL : $_POST['txtInicioReservacion']; // FECHA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraFinalizacion'])) ? NULL : $_POST['txtHoraFinalizacion']; // HORA FINALIZACION RESERVACION
                // RESTAR UN MINUTO PARA EFECTOS DE CONSULTA LABORATORIOS CON MODULOS INCLUIDOS
                $HoraFinReservacionLabsModulos = date('H:i:s', strtotime($HoraFinReservacion . ' -1 minute'));
                $HoraInicioReservacion = (empty($_POST['txtHoraInicio'])) ? NULL : $_POST['txtHoraInicio']; // HORA INICIO RESERVACION
                $ExtensionCicloCompleto = (empty($_POST['sltextensionfechas_reservacion'])) ? NULL : $_POST['sltextensionfechas_reservacion']; // EXTENSION CICLO COMPLETO
                /****************************************************************************************************************
                 * -> CONTROL DE DIAS SELECCIONADOS SI LA RESERVACION SE REPETIRA MAS DE DOS DIAS [TODO EL CICLO INCLUSIVE]
                 ***************************************************************************************************************/
                $DiaLunes = isset($_POST['lunes']) && $_POST['lunes'] === 'on' ? 'si' : 'no'; // DIA LUNES SELECCIONADO
                $DiaMartes = isset($_POST['martes']) && $_POST['martes'] === 'on' ? 'si' : 'no'; // DIA MARTES SELECCIONADO
                $DiaMiercoles = isset($_POST['miercoles']) && $_POST['miercoles'] === 'on' ? 'si' : 'no'; // DIA MIERCOLES SELECCIONADO
                $DiaJueves = isset($_POST['jueves']) && $_POST['jueves'] === 'on' ? 'si' : 'no'; // DIA JUEVES SELECCIONADO
                $DiaViernes = isset($_POST['viernes']) && $_POST['viernes'] === 'on' ? 'si' : 'no'; // DIA VIERNES SELECCIONADO
                $DiaSabado = isset($_POST['sabado']) && $_POST['sabado'] === 'on' ? 'si' : 'no'; // DIA SABADO SELECCIONADO
                $DiaDomingo = isset($_POST['domingo']) && $_POST['domingo'] === 'on' ? 'si' : 'no'; // DIA DOMINGO SELECCIONADO
                /**************************************************************************************************************************************************************
                 * -> IMPORTANTE: PARA UNA MEJOR GESTION DE LAS RESERVACIONES EN EL CALENDARIO DE ACTIVIDADES, TODOS LOS TIPOS DE RESERVACIONES SE REGISTRARAN EN REGISTROS
                 * SEPARADOS HASTA CUMPLIR CON EL FIN DE LA FECHA ESPECIFICADA. TODAS LAS RESERVACIONES ESTARAN LIGADOS A UN IDENTIFICADOR UNICO PARA GESTIONAR LAS MISMAS
                 * EN OTRA SECCION DE ESTE SISTEMA
                 **************************************************************************************************************************************************************/
                $VerificarTipoReservacionInicial = (empty($_POST['slttipoinicial_reservacion'])) ? NULL : $_POST['slttipoinicial_reservacion']; // TIPO DE RESERVACION INICIAL
                $CantidadDiasTipoReservacionInicial = (empty($_POST['txtcantidadias_inicialreservacion'])) ? NULL : $_POST['txtcantidadias_inicialreservacion']; // CANTIDAD DIAS TIPO DE RESERVACION INICIAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS
                $consulta3 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema3, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta4 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema4);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta5 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema5, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta6 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema6);
                // CONSULTA TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS
                $consulta7 = $Gestiones->ConsultarEscuelasFacultadesRegistradas($conectarsistema7);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta8 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema8, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> MOSTRAR ESAS OPCIONES EN EL MISMO <SELECT></SELECT>
                $consulta9 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema9, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> VALIDACION DE MODULOS OCUPADOS POR LABORATORIO
                $consulta10 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema10, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta10 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema10);
                */
                require('../Vista/AdministradorLaboratorio/oferta-ofrecida-reservaciones-usuarios-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta10); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA10
                mysqli_free_result($consulta9); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA9
                mysqli_free_result($consulta7); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA7
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                $conectarsistema8->close(); // CERRANDO CONEXION AUXILIAR 8
                $conectarsistema9->close(); // CERRANDO CONEXION AUXILIAR 9
                $conectarsistema10->close(); // CERRANDO CONEXION AUXILIAR 10
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO DOCENTES]
        case "gestion-reservaciones-laboratorios-segunda-fase-docentes":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $AplicacionReservacion = (empty($_POST['sltaplicacionreservacion'])) ? NULL : $_POST['sltaplicacionreservacion']; // APLICACION A UTILIZAR
                $NumeroUsuariosReservacion = (empty($_POST['txtcantidadusuariosreservacion'])) ? NULL : $_POST['txtcantidadusuariosreservacion']; // NUMERO DE USUARIOS A ASISTIR
                $FechaFinReservacion = (empty($_POST['txtFinalizacionReservacion'])) ? NULL : $_POST['txtFinalizacionReservacion']; // FECHA FINALIZACION RESERVACION
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacion'])) ? NULL : $_POST['txtInicioReservacion']; // FECHA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraFinalizacion'])) ? NULL : $_POST['txtHoraFinalizacion']; // HORA FINALIZACION RESERVACION
                // RESTAR UN MINUTO PARA EFECTOS DE CONSULTA LABORATORIOS CON MODULOS INCLUIDOS
                $HoraFinReservacionLabsModulos = date('H:i:s', strtotime($HoraFinReservacion . ' -1 minute'));
                $HoraInicioReservacion = (empty($_POST['txtHoraInicio'])) ? NULL : $_POST['txtHoraInicio']; // HORA INICIO RESERVACION
                $ExtensionCicloCompleto = (empty($_POST['sltextensionfechas_reservacion'])) ? NULL : $_POST['sltextensionfechas_reservacion']; // EXTENSION CICLO COMPLETO
                /****************************************************************************************************************
                 * -> CONTROL DE DIAS SELECCIONADOS SI LA RESERVACION SE REPETIRA MAS DE DOS DIAS [TODO EL CICLO INCLUSIVE]
                 ***************************************************************************************************************/
                $DiaLunes = isset($_POST['lunes']) && $_POST['lunes'] === 'on' ? 'si' : 'no'; // DIA LUNES SELECCIONADO
                $DiaMartes = isset($_POST['martes']) && $_POST['martes'] === 'on' ? 'si' : 'no'; // DIA MARTES SELECCIONADO
                $DiaMiercoles = isset($_POST['miercoles']) && $_POST['miercoles'] === 'on' ? 'si' : 'no'; // DIA MIERCOLES SELECCIONADO
                $DiaJueves = isset($_POST['jueves']) && $_POST['jueves'] === 'on' ? 'si' : 'no'; // DIA JUEVES SELECCIONADO
                $DiaViernes = isset($_POST['viernes']) && $_POST['viernes'] === 'on' ? 'si' : 'no'; // DIA VIERNES SELECCIONADO
                $DiaSabado = isset($_POST['sabado']) && $_POST['sabado'] === 'on' ? 'si' : 'no'; // DIA SABADO SELECCIONADO
                $DiaDomingo = isset($_POST['domingo']) && $_POST['domingo'] === 'on' ? 'si' : 'no'; // DIA DOMINGO SELECCIONADO
                /**************************************************************************************************************************************************************
                 * -> IMPORTANTE: PARA UNA MEJOR GESTION DE LAS RESERVACIONES EN EL CALENDARIO DE ACTIVIDADES, TODOS LOS TIPOS DE RESERVACIONES SE REGISTRARAN EN REGISTROS
                 * SEPARADOS HASTA CUMPLIR CON EL FIN DE LA FECHA ESPECIFICADA. TODAS LAS RESERVACIONES ESTARAN LIGADOS A UN IDENTIFICADOR UNICO PARA GESTIONAR LAS MISMAS
                 * EN OTRA SECCION DE ESTE SISTEMA
                 **************************************************************************************************************************************************************/
                $VerificarTipoReservacionInicial = (empty($_POST['slttipoinicial_reservacion'])) ? NULL : $_POST['slttipoinicial_reservacion']; // TIPO DE RESERVACION INICIAL
                $CantidadDiasTipoReservacionInicial = (empty($_POST['txtcantidadias_inicialreservacion'])) ? NULL : $_POST['txtcantidadias_inicialreservacion']; // CANTIDAD DIAS TIPO DE RESERVACION INICIAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS
                $consulta3 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema3, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta4 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema4);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta5 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema5, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta6 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema6);
                // CONSULTA TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS
                $consulta7 = $Gestiones->ConsultarEscuelasFacultadesRegistradas($conectarsistema7);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta8 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema8, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> MOSTRAR ESAS OPCIONES EN EL MISMO <SELECT></SELECT>
                $consulta9 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema9, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> VALIDACION DE MODULOS OCUPADOS POR LABORATORIO
                $consulta10 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema10, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta10 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema10);
                */
                require('../Vista/Docentes/oferta-ofrecida-reservaciones-usuarios-docentes.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta10); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA10
                mysqli_free_result($consulta9); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA9
                mysqli_free_result($consulta7); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA7
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                $conectarsistema8->close(); // CERRANDO CONEXION AUXILIAR 8
                $conectarsistema9->close(); // CERRANDO CONEXION AUXILIAR 9
                $conectarsistema10->close(); // CERRANDO CONEXION AUXILIAR 10
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO]
        // RESERVACIONES SOLICITADAS POR MODULOS IMPARES U OTROS MOTIVOS
        case "gestion-reservaciones-solicitadas-laboratorios-segunda-fase":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $AplicacionReservacion = (empty($_POST['sltaplicacionreservacion'])) ? NULL : $_POST['sltaplicacionreservacion']; // APLICACION A UTILIZAR
                $NumeroUsuariosReservacion = (empty($_POST['txtcantidadusuariosreservacion'])) ? NULL : $_POST['txtcantidadusuariosreservacion']; // NUMERO DE USUARIOS A ASISTIR
                $FechaFinReservacion = (empty($_POST['txtFinalizacionReservacion'])) ? NULL : $_POST['txtFinalizacionReservacion']; // FECHA FINALIZACION RESERVACION
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacion'])) ? NULL : $_POST['txtInicioReservacion']; // FECHA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraFinalizacion'])) ? NULL : $_POST['txtHoraFinalizacion']; // HORA FINALIZACION RESERVACION
                // RESTAR UN MINUTO PARA EFECTOS DE CONSULTA LABORATORIOS CON MODULOS INCLUIDOS
                $HoraFinReservacionLabsModulos = date('H:i:s', strtotime($HoraFinReservacion . ' -1 minute'));
                $HoraInicioReservacion = (empty($_POST['txtHoraInicio'])) ? NULL : $_POST['txtHoraInicio']; // HORA INICIO RESERVACION
                $ExtensionCicloCompleto = (empty($_POST['sltextensionfechas_reservacion'])) ? NULL : $_POST['sltextensionfechas_reservacion']; // EXTENSION CICLO COMPLETO
                /****************************************************************************************************************
                 * -> CONTROL DE DIAS SELECCIONADOS SI LA RESERVACION SE REPETIRA MAS DE DOS DIAS [TODO EL CICLO INCLUSIVE]
                 ***************************************************************************************************************/
                $DiaLunes = isset($_POST['lunes']) && $_POST['lunes'] === 'on' ? 'si' : 'no'; // DIA LUNES SELECCIONADO
                $DiaMartes = isset($_POST['martes']) && $_POST['martes'] === 'on' ? 'si' : 'no'; // DIA MARTES SELECCIONADO
                $DiaMiercoles = isset($_POST['miercoles']) && $_POST['miercoles'] === 'on' ? 'si' : 'no'; // DIA MIERCOLES SELECCIONADO
                $DiaJueves = isset($_POST['jueves']) && $_POST['jueves'] === 'on' ? 'si' : 'no'; // DIA JUEVES SELECCIONADO
                $DiaViernes = isset($_POST['viernes']) && $_POST['viernes'] === 'on' ? 'si' : 'no'; // DIA VIERNES SELECCIONADO
                $DiaSabado = isset($_POST['sabado']) && $_POST['sabado'] === 'on' ? 'si' : 'no'; // DIA SABADO SELECCIONADO
                $DiaDomingo = isset($_POST['domingo']) && $_POST['domingo'] === 'on' ? 'si' : 'no'; // DIA DOMINGO SELECCIONADO
                /**************************************************************************************************************************************************************
                 * -> IMPORTANTE: PARA UNA MEJOR GESTION DE LAS RESERVACIONES EN EL CALENDARIO DE ACTIVIDADES, TODOS LOS TIPOS DE RESERVACIONES SE REGISTRARAN EN REGISTROS
                 * SEPARADOS HASTA CUMPLIR CON EL FIN DE LA FECHA ESPECIFICADA. TODAS LAS RESERVACIONES ESTARAN LIGADOS A UN IDENTIFICADOR UNICO PARA GESTIONAR LAS MISMAS
                 * EN OTRA SECCION DE ESTE SISTEMA
                 **************************************************************************************************************************************************************/
                $VerificarTipoReservacionInicial = (empty($_POST['slttipoinicial_reservacion'])) ? NULL : $_POST['slttipoinicial_reservacion']; // TIPO DE RESERVACION INICIAL
                $CantidadDiasTipoReservacionInicial = (empty($_POST['txtcantidadias_inicialreservacion'])) ? NULL : $_POST['txtcantidadias_inicialreservacion']; // CANTIDAD DIAS TIPO DE RESERVACION INICIAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS
                $consulta3 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema3, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta4 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema4);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta5 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema5, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta6 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema6);
                // CONSULTA TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS
                $consulta7 = $Gestiones->ConsultarEscuelasFacultadesRegistradas($conectarsistema7);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta8 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema8, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> MOSTRAR ESAS OPCIONES EN EL MISMO <SELECT></SELECT>
                $consulta9 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema9, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> VALIDACION DE MODULOS OCUPADOS POR LABORATORIO
                $consulta10 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema10, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta10 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema10);
                */
                require('../Vista/AdministradorGeneral/oferta-ofrecida-reservaciones-solicitadas-usuarios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta10); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA10
                mysqli_free_result($consulta9); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA9
                mysqli_free_result($consulta7); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA7
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                $conectarsistema8->close(); // CERRANDO CONEXION AUXILIAR 8
                $conectarsistema9->close(); // CERRANDO CONEXION AUXILIAR 9
                $conectarsistema10->close(); // CERRANDO CONEXION AUXILIAR 10
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO ADMINISTRADOR DE LABORATORIO]
        // RESERVACIONES SOLICITADAS POR MODULOS IMPARES U OTROS MOTIVOS
        case "gestion-reservaciones-solicitadas-laboratorios-segunda-fase-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $AplicacionReservacion = (empty($_POST['sltaplicacionreservacion'])) ? NULL : $_POST['sltaplicacionreservacion']; // APLICACION A UTILIZAR
                $NumeroUsuariosReservacion = (empty($_POST['txtcantidadusuariosreservacion'])) ? NULL : $_POST['txtcantidadusuariosreservacion']; // NUMERO DE USUARIOS A ASISTIR
                $FechaFinReservacion = (empty($_POST['txtFinalizacionReservacion'])) ? NULL : $_POST['txtFinalizacionReservacion']; // FECHA FINALIZACION RESERVACION
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacion'])) ? NULL : $_POST['txtInicioReservacion']; // FECHA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraFinalizacion'])) ? NULL : $_POST['txtHoraFinalizacion']; // HORA FINALIZACION RESERVACION
                // RESTAR UN MINUTO PARA EFECTOS DE CONSULTA LABORATORIOS CON MODULOS INCLUIDOS
                $HoraFinReservacionLabsModulos = date('H:i:s', strtotime($HoraFinReservacion . ' -1 minute'));
                $HoraInicioReservacion = (empty($_POST['txtHoraInicio'])) ? NULL : $_POST['txtHoraInicio']; // HORA INICIO RESERVACION
                $ExtensionCicloCompleto = (empty($_POST['sltextensionfechas_reservacion'])) ? NULL : $_POST['sltextensionfechas_reservacion']; // EXTENSION CICLO COMPLETO
                /****************************************************************************************************************
                 * -> CONTROL DE DIAS SELECCIONADOS SI LA RESERVACION SE REPETIRA MAS DE DOS DIAS [TODO EL CICLO INCLUSIVE]
                 ***************************************************************************************************************/
                $DiaLunes = isset($_POST['lunes']) && $_POST['lunes'] === 'on' ? 'si' : 'no'; // DIA LUNES SELECCIONADO
                $DiaMartes = isset($_POST['martes']) && $_POST['martes'] === 'on' ? 'si' : 'no'; // DIA MARTES SELECCIONADO
                $DiaMiercoles = isset($_POST['miercoles']) && $_POST['miercoles'] === 'on' ? 'si' : 'no'; // DIA MIERCOLES SELECCIONADO
                $DiaJueves = isset($_POST['jueves']) && $_POST['jueves'] === 'on' ? 'si' : 'no'; // DIA JUEVES SELECCIONADO
                $DiaViernes = isset($_POST['viernes']) && $_POST['viernes'] === 'on' ? 'si' : 'no'; // DIA VIERNES SELECCIONADO
                $DiaSabado = isset($_POST['sabado']) && $_POST['sabado'] === 'on' ? 'si' : 'no'; // DIA SABADO SELECCIONADO
                $DiaDomingo = isset($_POST['domingo']) && $_POST['domingo'] === 'on' ? 'si' : 'no'; // DIA DOMINGO SELECCIONADO
                /**************************************************************************************************************************************************************
                 * -> IMPORTANTE: PARA UNA MEJOR GESTION DE LAS RESERVACIONES EN EL CALENDARIO DE ACTIVIDADES, TODOS LOS TIPOS DE RESERVACIONES SE REGISTRARAN EN REGISTROS
                 * SEPARADOS HASTA CUMPLIR CON EL FIN DE LA FECHA ESPECIFICADA. TODAS LAS RESERVACIONES ESTARAN LIGADOS A UN IDENTIFICADOR UNICO PARA GESTIONAR LAS MISMAS
                 * EN OTRA SECCION DE ESTE SISTEMA
                 **************************************************************************************************************************************************************/
                $VerificarTipoReservacionInicial = (empty($_POST['slttipoinicial_reservacion'])) ? NULL : $_POST['slttipoinicial_reservacion']; // TIPO DE RESERVACION INICIAL
                $CantidadDiasTipoReservacionInicial = (empty($_POST['txtcantidadias_inicialreservacion'])) ? NULL : $_POST['txtcantidadias_inicialreservacion']; // CANTIDAD DIAS TIPO DE RESERVACION INICIAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS
                $consulta3 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema3, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta4 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema4);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta5 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema5, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta6 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema6);
                // CONSULTA TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS
                $consulta7 = $Gestiones->ConsultarEscuelasFacultadesRegistradas($conectarsistema7);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta8 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema8, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> MOSTRAR ESAS OPCIONES EN EL MISMO <SELECT></SELECT>
                $consulta9 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema9, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> VALIDACION DE MODULOS OCUPADOS POR LABORATORIO
                $consulta10 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema10, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacionLabsModulos,
                $AplicacionReservacion);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta10 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema10);
                */
                require('../Vista/AdministradorLaboratorio/oferta-ofrecida-reservaciones-solicitadas-usuarios-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta10); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA10
                mysqli_free_result($consulta9); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA9
                mysqli_free_result($consulta7); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA7
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                $conectarsistema8->close(); // CERRANDO CONEXION AUXILIAR 8
                $conectarsistema9->close(); // CERRANDO CONEXION AUXILIAR 9
                $conectarsistema10->close(); // CERRANDO CONEXION AUXILIAR 10
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRAR NUEVAS RESERVACIONES [TODOS LOS ROLES DE USUARIO]
        case "envio-datos-registro-nuevas-reservaciones-laboratorios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdFacultad = (empty($_POST['sltfacultad_reservacion'])) ? NULL : $_POST['sltfacultad_reservacion']; // FACULTAD RESERVACION
                $IdEscuela = (empty($_POST['sltescuela_reservacion'])) ? NULL : $_POST['sltescuela_reservacion']; // ESCUELA RESERVACION
                $IdLaboratorio = (empty($_POST['sltlaboratorio_reservacion'])) ? NULL : $_POST['sltlaboratorio_reservacion']; // LABORATORIO RESERVACION
                $IdAplicacion = (empty($_POST['txtAplicacionReservacion'])) ? NULL : $_POST['txtAplicacionReservacion']; // APLICACION RESERVACION
                $IdTipoReservacion = (empty($_POST['slttipo_reservacion'])) ? NULL : $_POST['slttipo_reservacion']; // TIPO RESERVACION
                $CodigoReservacion = (empty($_POST['txtCodigoReservacion'])) ? NULL : $_POST['txtCodigoReservacion']; // CODIGO RESERVACION
                $NombreReservacion = (empty($_POST['txtNombreReservacion'])) ? NULL : $_POST['txtNombreReservacion']; // NOMBRE RESERVACION
                $SeccionReservacion = (empty($_POST['txtSeccionReservacion'])) ? NULL : $_POST['txtSeccionReservacion']; // SECCION RESERVACION
                $FechaInicioReservacion = (empty($_POST['txtFechaInicioReservacion'])) ? NULL : $_POST['txtFechaInicioReservacion']; // FECHA INICIO RESERVACION
                $FechaFinReservacion = (empty($_POST['txtFechaFinReservacion'])) ? NULL : $_POST['txtFechaFinReservacion']; // FECHA FIN RESERVACION
                $HoraInicioReservacion = (empty($_POST['txtHoraInicioReservacion'])) ? NULL : $_POST['txtHoraInicioReservacion']; // HORA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraFinReservacion'])) ? NULL : $_POST['txtHoraFinReservacion']; // HORA FIN RESERVACION
                // -> RESTAR UN MINUTO A LA HORA FINAL, YA QUE CONSULTA INICIA CON HORA EXACTA POR CADA RESERVACION
                $ModificarHora = DateTime::createFromFormat('H:i', $HoraFinReservacion); // CREAR UN ONJETO CON LA HORA INGRESADA
                /** -> SOLAMENTE HACER MODIFICACION SI VARIABlE NO ESTA VACIA **/
                if($ModificarHora){
                    $ModificarHora->modify('-1 minute'); // RESTAR UN MINUTO A LA HORA INGRESADA
                    $NuevaHoraFinal = $ModificarHora->format('H:i'); // NUEVA HORA MODIFICADA, LISTA PARA INSERCION
                }
                $NumeroUsuariosReservacion = (empty($_POST['txtNumeroUsuariosReservacion'])) ? NULL : $_POST['txtNumeroUsuariosReservacion']; // NUMERO USUARIOS ASISTIR RESERVACION
                //-> VALIDO EXCLUSIVAMENTE CUANDO LA OPCION SELECCIONADA SEA [OTRAS]
                $OtroTipoReservacion = (empty($_POST['txtTipoOtroReservacion'])) ? NULL : $_POST['txtTipoOtroReservacion']; // DETALLE OTRO TIPO RESERVACION
                $IdUnicoAleatorioCompleto  = Uuid::uuid4(); // GENERA ID UNICO ALEATORIO AUTOMATICAMENTE FORMATO COMPLETO
                $IdUnicoAleatorioRecortado = substr($IdUnicoAleatorioCompleto->toString(), 0, 8); // MODIFICAR ID UNICO ALEATORIO A SOLAMENTE 8 CARACTERES
                /*******************************************************
                 * * -> MODIFICAR SEGUN CICLO EN CURSO
                 *******************************************************/
                $CicloActual = "02-2023"; // CICLO ACTUAL
                /****************************************************************************************************************************************************************
                 * -> GENERAR UN IDENTIFICADOR UNICO PARA CADA REGISTRO INGRESADO A BASE DE DATOS, POR LA MODALIDAD DE REGISTROS, EL PK NO ES FUNCIONAL PARA LAS GESTIONES
                 * ESPECIFICAS DE UN GRUPO O VARIOS GRUPOS DE RESERVACIONES ASIGNADOS A UN USUARIO X. MOTIVO POR EL CUAL SE HA MANEJADO ESTA DINAMICA PARA FUTURAS GESTIONES
                 * DE RESERVACIONES DENTRO DE ESTE SISTEMA.
                 * -------------------------------------------------------------------------
                 * - COMO ESTA ESTRUCTURADO ESE ID UNICO:
                 * x[ID UNICO USUARIO]-xx-xxxx_[CICLO ACTUAL]xxxx[AÑO]-xxxxx[ID ALEATORIO]
                 ****************************************************************************************************************************************************************/
                $IdentificadorUnicoReservacion = $IdUsuarios."-".$CicloActual."_".date("y-").$IdUnicoAleatorioRecortado;
                $ContadorDias = 0; // CONTADOR DE N DIAS
                $ExtensionCicloCompleto = (empty($_POST['txtExtensionCicloEntero'])) ? NULL : $_POST['txtExtensionCicloEntero']; // EXTENSION CICLO COMPLETO
                //--** VALIDACION DE ESPACIOS OCUPADOS POR MODULOS Y LABORATORIOS **--//
                //-> LABORATORIO 3
                $EspacioModulo1Lab3 = (empty($_POST['txtEspacioMod1Lab3'])) ? "-1" : $_POST['txtEspacioMod1Lab3'];
                $EspacioModulo2Lab3 = (empty($_POST['txtEspacioMod2Lab3'])) ? "-1" : $_POST['txtEspacioMod2Lab3'];
                $EspacioModulo3Lab3 = (empty($_POST['txtEspacioMod3Lab3'])) ? "-1" : $_POST['txtEspacioMod3Lab3'];
                $EspacioModulo4Lab3 = (empty($_POST['txtEspacioMod4Lab3'])) ? "-1" : $_POST['txtEspacioMod4Lab3'];
                //-> LABORATORIO 8
                $EspacioModulo1Lab8 = (empty($_POST['txtEspacioMod1Lab8'])) ? "-1" : $_POST['txtEspacioMod1Lab8'];
                $EspacioModulo2Lab8 = (empty($_POST['txtEspacioMod2Lab8'])) ? "-1" : $_POST['txtEspacioMod2Lab8'];
                $EspacioModulo3Lab8 = (empty($_POST['txtEspacioMod3Lab8'])) ? "-1" : $_POST['txtEspacioMod3Lab8'];
                $EspacioModulo4Lab8 = -1; // NO POSEE MODULO 4
                //-> LABORATORIO 14
                $EspacioModulo1Lab14 = (empty($_POST['txtEspacioMod1Lab14'])) ? "-1" : $_POST['txtEspacioMod1Lab14'];
                $EspacioModulo2Lab14 = (empty($_POST['txtEspacioMod2Lab14'])) ? "-1" : $_POST['txtEspacioMod2Lab14'];
                $EspacioModulo3Lab14 = -1; // NO POSEE MODULO 3
                $EspacioModulo4Lab14 = -1; // NO POSEE MODULO 4
                $TitularReservacion = (empty($_POST['slttitular_reservacion'])) ? "Desconocido" : $_POST['slttitular_reservacion'];
                // VALIDAR SI EL USUARIO QUE REGISTRA, NO ES TITULAR
                if($TitularReservacion == "no"){
                    $AulaProcedenciaReservacion = "Desconocido";
                }else{
                    $AulaProcedenciaReservacion = (empty($_POST['txtAulaProcedenciaReservacion'])) ? "Desconocido" : $_POST['txtAulaProcedenciaReservacion'];
                }
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdFacultad)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    //-> SI LA OPCION DE OTRO TIPO DE RESERVACION SE ENCUENTA NULA, SIMPLEMENTE MANDAR A BASES DE DATOS UN NO DETERMINADO
                    if(empty($OtroTipoReservacion))
                        $OtroTipoReservacion = "N/D";
                    //-> SI LA RESERVACION NO TIENE ASIGNADA NINGUNA SECCION, USUARIOS DEBEN INGRESAR CERO [0], Y SE ASIGNA ESE VALOR PARA INGRESO A BASE DE DATOS
                    if(empty($SeccionReservacion))
                        $SeccionReservacion = 0;
                    /**********************************************************************
                     * -> VERIFICAR LABORATORIOS QUE POSEEN MODULOS
                     * LLENADO AUTOMATICO DE ESPACIOS SEGUN CANTIDAD DE USUARIOS A PROCESAR
                    ***********************************************************************/
                    // LABORATORIO 3
                    if($IdLaboratorio == 3){
                        // CANTIDAD DE USUARIOS MAXIMO POR MODULO
                        $CantidadModulo1 = 27;
                        $CantidadModulo2 = 36;
                        $CantidadModulo3 = 36;
                        $CantidadModulo4 = 26;
                        // MODIFICAR SI LABORATORIO 3 TIENE MAQUINAS FUERA DE USO
                        $MaquinasFueraUsoLab3 = 0;
                        // LIMITE DE LABORATORIO 1
                        $LimiteLab3 = 125-$MaquinasFueraUsoLab3;
                        $TotalUsuariosReservados = $NumeroUsuariosReservacion;
                        // ASIGNAR USUARIOS A MODULO 1
                        if ($EspacioModulo1Lab3 > 0) {
                            $Modulo1 = min($TotalUsuariosReservados, $CantidadModulo1, $EspacioModulo1Lab3);
                            $TotalUsuariosReservados -= $Modulo1;
                            $EspacioModulo1Lab3 -= $Modulo1;
                            //echo "Modulo1: ".$Modulo1."<br>";
                        } else {
                            $Modulo1 = 0;
                        }

                        // ASIGNAR USUARIOS A MODULO 2
                        if ($EspacioModulo2Lab3 > 0) {
                            $Modulo2 = min($TotalUsuariosReservados, $CantidadModulo2, $EspacioModulo2Lab3);
                            $TotalUsuariosReservados -= $Modulo2;
                            $EspacioModulo2Lab3 -= $Modulo2;
                            //echo "Modulo2: ".$Modulo2."<br>";
                        } else {
                            $Modulo2 = 0;
                        }

                        // ASIGNAR USUARIOS A MODULO 3
                        if ($EspacioModulo3Lab3 > 0) {
                            $Modulo3 = min($TotalUsuariosReservados, $CantidadModulo3, $EspacioModulo3Lab3);
                            $TotalUsuariosReservados -= $Modulo3;
                            $EspacioModulo3Lab3 -= $Modulo3;
                            //echo "Modulo3: ".$Modulo3."<br>";
                        } else {
                            $Modulo3 = 0;
                        }

                        // ASIGNAR USUARIOS A MODULO 4
                        if ($EspacioModulo4Lab3 > 0) {
                            $Modulo4 = min($TotalUsuariosReservados, $CantidadModulo4, $EspacioModulo4Lab3);
                            $TotalUsuariosReservados -= $Modulo4;
                            $EspacioModulo4Lab3 -= $Modulo4;
                            //echo "Modulo4: ".$Modulo4."<br>";
                        } else {
                            $Modulo4 = 0;
                        }
                        // DISTRIBUIR USUARIOS A OTROS MÓDULOS
                        if ($TotalUsuariosReservados > 0) {
                            // Distribuir usuarios al modulo 1 si está disponible
                            if ($EspacioModulo1Lab3 > 0) {
                                $Modulo1 += min($TotalUsuariosReservados, $CantidadModulo1 - $Modulo1, $EspacioModulo1Lab3);
                                $TotalUsuariosReservados -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                                $EspacioModulo1Lab3 -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                            }
                            // Distribuir usuarios al modulo 2 si está disponible
                            if ($TotalUsuariosReservados > 0 && $EspacioModulo2Lab3 > 0) {
                                $Modulo2 += min($TotalUsuariosReservados, $CantidadModulo2 - $Modulo2, $EspacioModulo2Lab3);
                                $TotalUsuariosReservados -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                                $EspacioModulo2Lab3 -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                            }
                            // Distribuir usuarios al modulo 3 si está disponible
                            if ($TotalUsuariosReservados > 0 && $EspacioModulo3Lab3 > 0) {
                                $Modulo3 += min($TotalUsuariosReservados, $CantidadModulo3 - $Modulo3, $EspacioModulo3Lab3);
                                $TotalUsuariosReservados -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                                $EspacioModulo3Lab3 -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                            }
                            // Distribuir usuarios al modulo 4 si está disponible
                            if ($TotalUsuariosReservados > 0 && $EspacioModulo4Lab3 > 0) {
                                $Modulo4 += min($TotalUsuariosReservados, $CantidadModulo4 - $Modulo4, $EspacioModulo4Lab3);
                                $TotalUsuariosReservados -= ($Modulo4 - min($Modulo4, $CantidadModulo4));
                                $EspacioModulo4Lab3 -= ($Modulo4 - min($Modulo4, $CantidadModulo4));
                            }
                        }
                    // LABORATORIO 8
                    }else if($IdLaboratorio == 8){
                        // CANTIDAD DE USUARIOS MAXIMO POR MODULO
                        $CantidadModulo1 = 23;
                        $CantidadModulo2 = 30;
                        $CantidadModulo3 = 31;
                        $CantidadModulo4 = -1; // YA QUE NO POSEE MODULO 4
                        // MODIFICAR SI LABORATORIO 8 TIENE MAQUINAS FUERA DE USO
                        $MaquinasFueraUsoLab8 = 0;
                        // LIMITE DE LABORATORIO 8
                        $LimiteLab8 = 88-$MaquinasFueraUsoLab8;
                        $TotalUsuariosReservados = $NumeroUsuariosReservacion;
                        // ASIGNAR USUARIOS A MODULO 1
                        if ($EspacioModulo1Lab8 > 0) {
                            $Modulo1 = min($TotalUsuariosReservados, $CantidadModulo1, $EspacioModulo1Lab8);
                            $TotalUsuariosReservados -= $Modulo1;
                            $EspacioModulo1Lab8 -= $Modulo1;
                            //echo "Modulo1: ".$Modulo1."<br>";
                        } else {
                            $Modulo1 = 0;
                        }

                        // ASIGNAR USUARIOS A MODULO 2
                        if ($EspacioModulo2Lab8 > 0) {
                            $Modulo2 = min($TotalUsuariosReservados, $CantidadModulo2, $EspacioModulo2Lab8);
                            $TotalUsuariosReservados -= $Modulo2;
                            $EspacioModulo2Lab8 -= $Modulo2;
                            //echo "Modulo2: ".$Modulo2."<br>";
                        } else {
                            $Modulo2 = 0;
                        }

                        // ASIGNAR USUARIOS A MODULO 3
                        if ($EspacioModulo3Lab8 > 0) {
                            $Modulo3 = min($TotalUsuariosReservados, $CantidadModulo3, $EspacioModulo3Lab8);
                            $TotalUsuariosReservados -= $Modulo3;
                            $EspacioModulo3Lab8 -= $Modulo3;
                            //echo "Modulo3: ".$Modulo3."<br>";
                        } else {
                            $Modulo3 = 0;
                        }
                        $Modulo4 = -1; // NO POSEE MODULO 4
                        // DISTRIBUIR USUARIOS A OTROS MÓDULOS
                        if ($TotalUsuariosReservados > 0) {
                            // Distribuir usuarios al modulo 1 si está disponible
                            if ($EspacioModulo1Lab8 > 0) {
                                $Modulo1 += min($TotalUsuariosReservados, $CantidadModulo1 - $Modulo1, $EspacioModulo1Lab8);
                                $TotalUsuariosReservados -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                                $EspacioModulo1Lab8 -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                            }
                            // Distribuir usuarios al modulo 2 si está disponible
                            if ($TotalUsuariosReservados > 0 && $EspacioModulo2Lab8 > 0) {
                                $Modulo2 += min($TotalUsuariosReservados, $CantidadModulo2 - $Modulo2, $EspacioModulo2Lab8);
                                $TotalUsuariosReservados -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                                $EspacioModulo2Lab8 -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                            }
                            // Distribuir usuarios al modulo 3 si está disponible
                            if ($TotalUsuariosReservados > 0 && $EspacioModulo3Lab8 > 0) {
                                $Modulo3 += min($TotalUsuariosReservados, $CantidadModulo3 - $Modulo3, $EspacioModulo3Lab8);
                                $TotalUsuariosReservados -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                                $EspacioModulo3Lab8 -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                            }
                        }
                    // LABORATORIO 14
                    }else if($IdLaboratorio == 14){
                        // CANTIDAD DE USUARIOS MAXIMO POR MODULO
                        $CantidadModulo1 = 32;
                        $CantidadModulo2 = 32;
                        $CantidadModulo3 = -1; // YA QUE NO POSEE MODULO 3
                        $CantidadModulo4 = -1; // YA QUE NO POSEE MODULO 4
                        // MODIFICAR SI LABORATORIO 3 TIENE MAQUINAS FUERA DE USO
                        $MaquinasFueraUsoLab14 = 0;
                        // LIMITE DE LABORATORIO 14
                        $LimiteLab14 = 65-$MaquinasFueraUsoLab14;
                        $TotalUsuariosReservados = $NumeroUsuariosReservacion;
                        // ASIGNAR USUARIOS A MODULO 1
                        if ($EspacioModulo1Lab14 > 0) {
                            $Modulo1 = min($TotalUsuariosReservados, $CantidadModulo1, $EspacioModulo1Lab14);
                            $TotalUsuariosReservados -= $Modulo1;
                            $EspacioModulo1Lab14 -= $Modulo1;
                            //echo "Modulo1: ".$Modulo1."<br>";
                        } else {
                            $Modulo1 = 0;
                        }

                        // ASIGNAR USUARIOS A MODULO 2
                        if ($EspacioModulo2Lab14 > 0) {
                            $Modulo2 = min($TotalUsuariosReservados, $CantidadModulo2, $EspacioModulo2Lab14);
                            $TotalUsuariosReservados -= $Modulo2;
                            $EspacioModulo2Lab14 -= $Modulo2;
                            //echo "Modulo2: ".$Modulo2."<br>";
                        } else {
                            $Modulo2 = 0;
                        }
                        // NO POSEEN ESOS MODULOS
                        $Modulo3 = -1; $Modulo4 = -1;
                        // DISTRIBUIR USUARIOS A OTROS MÓDULOS
                        if ($TotalUsuariosReservados > 0) {
                            // Distribuir usuarios al modulo 1 si está disponible
                            if ($EspacioModulo1Lab14 > 0) {
                                $Modulo1 += min($TotalUsuariosReservados, $CantidadModulo1 - $Modulo1, $EspacioModulo1Lab14);
                                $TotalUsuariosReservados -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                                $EspacioModulo1Lab14 -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                            }
                            // Distribuir usuarios al modulo 2 si está disponible
                            if ($TotalUsuariosReservados > 0 && $EspacioModulo2Lab14 > 0) {
                                $Modulo2 += min($TotalUsuariosReservados, $CantidadModulo2 - $Modulo2, $EspacioModulo2Lab14);
                                $TotalUsuariosReservados -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                                $EspacioModulo2Lab14 -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                            }
                        }   
                    }
                    else{
                        // LABORATORIOS QUE NO POSEEN MODULOS, SE LES ASIGNA -1 A CADA ESPACIO DE RESERVACION
                        $Modulo1 = -1; $Modulo2 = -1; $Modulo3 = -1; $Modulo4 = -1;
                    }
                    // OBTENER LOS DIAS SELECCIONADOS
                    $diasSeleccionados = array();
                    if (isset($_POST['txtDiaLunes']) && $_POST['txtDiaLunes'] === "si") {
                        $diasSeleccionados[] = 1; // LUNES
                    }
                    if (isset($_POST['txtDiaMartes']) && $_POST['txtDiaMartes'] === "si") {
                        $diasSeleccionados[] = 2; // MARTES
                    }
                    if (isset($_POST['txtDiaMiercoles']) && $_POST['txtDiaMiercoles'] === "si") {
                        $diasSeleccionados[] = 3; // MIERCOLES
                    }
                    if (isset($_POST['txtDiaJueves']) && $_POST['txtDiaJueves'] === "si") {
                        $diasSeleccionados[] = 4; // JUEVES
                    }
                    if (isset($_POST['txtDiaViernes']) && $_POST['txtDiaViernes'] === "si") {
                        $diasSeleccionados[] = 5; // VIERNES
                    }
                    if (isset($_POST['txtDiaSabado']) && $_POST['txtDiaSabado'] === "si") {
                        $diasSeleccionados[] = 6; // SABADO
                    }
                    if (isset($_POST['txtDiaDomingo']) && $_POST['txtDiaDomingo'] === "si") {
                        $diasSeleccionados[] = 7; // DOMINGO
                    }
                    // OBTENER FECHA INICIAL Y FECHA FINAL
                    $FechaInicialRango = new DateTime($FechaInicioReservacion);
                    $FechaFinalRango = new DateTime($FechaFinReservacion);
                    /*************************************************
                     * -> RANGO DE FECHAS FESTIVAS (ASUETO) 2023
                     * MODIFICAR SEGUN AÑO EN CURSO
                     * RESPETAR FORMATO DD-MM
                     ************************************************/
                    $fechas_asueto = [
                        '01-01', // AÑO NUEVO
                        '01-04', // VACACIONES SEMANA SANTA
                        '02-04', // VACACIONES SEMANA SANTA
                        '03-04', // VACACIONES SEMANA SANTA
                        '04-04', // VACACIONES SEMANA SANTA
                        '05-04', // VACACIONES SEMANA SANTA
                        '06-04', // VACACIONES SEMANA SANTA
                        '07-04', // VACACIONES SEMANA SANTA
                        '08-04', // VACACIONES SEMANA SANTA
                        '09-04', // VACACIONES SEMANA SANTA
                        '01-05', // DIA DEL TRABAJO
                        '10-05', // DIA DE LA MADRE
                        '17-06', // DIA DEL PADRE
                        '01-08', // VACACIONES AGOSTINAS
                        '02-08', // VACACIONES AGOSTINAS
                        '03-08', // VACACIONES AGOSTINAS
                        '04-08', // VACACIONES AGOSTINAS
                        '05-08', // VACACIONES AGOSTINAS 
                        '06-08', // VACACIONES AGOSTINAS
                        '15-09', // DIA DE LA INDEPENDENCIA
                        '02-11'  // DIA DE LOS FIELES DIFUNTOS
                    ];
                    // INTERVALO DE FECHAS
                    $Intervalo = new DateInterval('P1D');
                    // ITERAR Y CREAR UN OBJETO CON EL RANGO SOLICITADO
                    /** SE AGREGA UN DIA PARA QUE TOME LA FECHA FINAL SELECCIONADA **/
                    $PeriodoReservacion = new DatePeriod($FechaInicialRango, $Intervalo, $FechaFinalRango->modify('+1 day'));
                    // MOSTRAR TODAS LAS FECHAS EN ESE RANGO QUE EL USUARIO HA SELECCIONADO
                    foreach ($PeriodoReservacion as $Fechas){
                        // SI LA FECHA COINCIDE CON ALGUNA DE LAS ASIGNADAS EN EL ARREGLO DE ASUETOS, SIMPLEMENTE OBVIAR Y CONTINUAR ASIGNACION DE FECHAS
                        if (in_array($Fechas->format('d-m'), $fechas_asueto)) {
                            continue;
                        }
                        // X FECHAS EN X DIAS SELECCIONADOS
                        if (in_array($Fechas->format('N'), $diasSeleccionados)) {
                            //echo $Fechas->format('Y-m-d') . "\n";
                            $consulta = $Gestiones->RegistroNuevasReservacionesLaboratorios($conectarsistema, $IdUsuarios, $IdFacultad, $IdEscuela, $IdLaboratorio, $IdAplicacion, $IdTipoReservacion,$IdentificadorUnicoReservacion,
                            $CodigoReservacion, $CicloActual, $NombreReservacion, $SeccionReservacion, $Fechas->format('Y-m-d'), $Fechas->format('Y-m-d'), $HoraInicioReservacion, $NuevaHoraFinal, 
                            $NumeroUsuariosReservacion, $OtroTipoReservacion, $Modulo1, $Modulo2, $Modulo3, $Modulo4, $TitularReservacion, $AulaProcedenciaReservacion);
                        }
                    }
                    //-> OBTENER EL ID DEL LABORATORIO SELECCIONADO
                    switch($IdLaboratorio){
                        case 1:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "si", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 2:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "si", "", "", "", "", "", "", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 3:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "si", "", "", "", "", "", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 4:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "si", "", "", "", "", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 5:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "si", "", "", "", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 6:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "si", "", "", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 7:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "si", "", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 8:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "si", "", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 9:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "", "si", "", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 10:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "", "", "si", "", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 11:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "", "", "", "si", "", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 12:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "", "", "", "", "si", "", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 13:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "", "", "", "", "", "si", "", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 14:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "", "", "", "", "", "", "si", "");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                        case 15:
                            $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema1, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "si");
                            $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                            while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                            }
                            break;
                    }
                    // OBTENER EL TIPO DE RESERVACION
                    switch($IdTipoReservacion){
                        case 1:
                            $TipoReservacionCorreo = "Pr&aacute;ticas Programadas (Clases)";
                            break;
                        case 2:
                            $TipoReservacionCorreo = "Curso Libre";
                            break;
                        case 3:
                            $TipoReservacionCorreo = "Seminario";
                            break;
                        case 4:
                            $TipoReservacionCorreo = "Tour Utec";
                            break;
                        case 5:
                            $TipoReservacionCorreo = "Certificaciones";
                            break;
                        case 6:
                            $TipoReservacionCorreo = "Otras";
                            break;
                    }
                    // OBTENER DATOS DE APLICACION A UTILIZAR
                    $ConsultaDatoAplicacion = $Gestiones->ConsultarDatosAplicaciones_NuevasReservacionesCorreo($conectarsistema2, $IdAplicacion);
                    // RECORRIDO EN BUSCA DE COINCIDENCIAS EN BASE A LA PETICION SOLICITADA
                    $AplicacionUtilizarEnvioCorreo = mysqli_fetch_array($ConsultaDatoAplicacion);
                    $NombreAplicacionCorreo = $AplicacionUtilizarEnvioCorreo[1]; // NOMBRE DE APLICACION A UTILIZAR
                    /*************************************************************************************************
                     * -> ENVIO DE CORREOS A USUARIOS QUE POSEEN EL LABORATORIO ASIGNADO - AVISO NUEVA RESERVACION
                     *************************************************************************************************/
                    foreach ($correosUsuarios as $Destinatario) {
                        $mail->addAddress($Destinatario);
                        $Nombre = "FICA - Nueva Reservación"; // NOMBRE POR DEFECTO EMPRESA
                        $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                        $Asunto = "Aviso Nueva Reservación - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                        // INICIALIZANDO CLASE DE ENVIO DE CORRREOS -> USUARIOS QUE RECUPERAN SU CUENTA
                        $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                        // Crear una instancia y pasar true para permitir las excepciones
                        $mail = new PHPMailer(true);
                        try{
                            $mail->isSMTP();
                            $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port       = 587;
                            $mail->SMTPSecure = 'tls';
                            $mail->SMTPAuth   = true;
                            $mail->Username = 'proyectosedmr@gmail.com';
                            $mail->Password = 'nodhtetwzespsuwy';
                            //$mail->SetFrom('proyectosedmr@gmail.com', $Nombre);
                            // DESTINATARIOS Y REMITENTES
                            $mail->setFrom($Remitente, $Nombre);
                            $mail->addAddress($Destinatario);
                            /**
                             * -> DEPURACION 
                             *      -> COMPROBACION DE ERRORES
                             *  */
                            //$mail->SMTPDebug  = 3;
                            //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
                            $mail->IsHTML(true);
                            $mail->Subject = $Asunto;
                            $mail->Body    = '<!DOCTYPE html>
                            <html lang="es">
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
                                <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                <style>
                                body{
                                width: 650px;
                                font-family: work-Sans, sans-serif;
                                background-color: #f6f7fb;
                                display: block;
                                }
                                a{
                                text-decoration: none;
                                }
                                span {
                                font-size: 14px;
                                }
                                p {
                                    font-size: 13px;
                                    line-height: 1.7;
                                    letter-spacing: 0.7px;
                                    margin-top: 0;
                                }
                                .text-center{
                                text-align: center
                                }
                                h6 {
                                font-size: 16px;
                                margin: 0 0 18px 0;
                                }
                                </style>
                            </head>
                            <body style="margin: 30px auto;">
                                <table style="width: 100%">
                                <tbody>
                                    <tr>
                                    <td>
                                        <table style="background-color: #f6f7fb; width: 100%">
                                        <tbody>
                                            <tr>
                                            <td>
                                                <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                                <tbody>
                                                    <tr>
                                                    <td><a href="#"><img class="img-fluid" width="350" src="https://cashmanha.helioho.st/utec_logo.jpg" alt=""></a></td>
                                                    <td style="text-align: right; color:#999"><span>Control Laboratorios FICA</span></td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                        <tbody>
                                            <tr>
                                            <td style="padding: 30px"> 
                                                <h6 style="font-weight: 600">Estimado(a) Usuario:</h6>
                                                <!--img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/repair-tools.gif"-->
                                                <p> Se ha registrado una nueva reservaci&oacute;n en el laboratorio '.$IdLaboratorio.' que requiere de su atenci&oacute;n. A continuaci&oacute;n le presentamos
                                                un resumen de lo descrito:
                                                </p>
                                                <p>
                                                <ul>
                                                <li>
                                                    <p><strong>Tipo Reservaci&oacute;n: </strong>'.$TipoReservacionCorreo.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>Cantidad Personas: </strong>'.$NumeroUsuariosReservacion.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>Aplicaci&oacute;n a utilizar: </strong>'.$NombreAplicacionCorreo.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>Nombre Reservaci&oacute;n: </strong>'.$NombreReservacion.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>C&oacute;digo Asignatura: </strong>'.$CodigoReservacion.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>Fecha Inicio: </strong>'.$FechaInicioReservacion.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>Fecha Finalizaci&oacute;n: </strong>'.$FechaFinReservacion.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>Hora Inicio: </strong>'.$HoraInicioReservacion.'</p>
                                                </li>
                                                <li>
                                                    <p><strong>Hora Finalizaci&oacute;n: </strong>'.$HoraFinReservacion.'</p>
                                                </li>
                                                    
                                                </ul>
                                                </p>
                                                <p>Esta reservaci&oacute;n se ha registrado bajo el identificador &uacute;nico <strong>'.$IdentificadorUnicoReservacion.'</strong>. Por favor, para m&aacute;s detalles
                                                revise el apartado de gesti&oacute;n de reservaciones, ya que ac&aacute; solamente se muestra un resumen del nuevo registro procesado.</p>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                        <tbody>       
                                            <tr style="text-align: center">
                                            <td> 
                                                <p style="color: #ff7675; margin-bottom: 0">ESTE CORREO HA SIDO GENERADO AUTOMATICAMENTE, AGRADECEMOS NO RESPONDER AL MISMO</p>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                            </body>
                            </html>            
                            
                            ';
                            // SOLO ENVIAR CORREO SI LA INSERCION SE REALIZA EXITOSAMENTE
                        if($consulta=="OK"){
                                $mail->send();
                        }
                        }catch (Exception $e){/*NO HACER NADA SI FALLA*/}
                    }
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }// CIERRE if(empty($IdFacultad))
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO]
        case "modificar-grupo-completo-reservacion-procesada":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $CodigoUnicoIdentificadorReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion'];
                $AplicacionReservacion = (empty($_GET['app'])) ? NULL : $_GET['app'];
                $FechaInicioReservacion = (empty($_GET['fi'])) ? NULL : $_GET['fi'];
                $FechaFinReservacion = (empty($_GET['ff'])) ? NULL : $_GET['ff'];
                $HoraInicioReservacion = (empty($_GET['hi'])) ? NULL : $_GET['hi'];
                $HoraFinReservacion = (empty($_GET['hf'])) ? NULL : $_GET['hf'];
                $NumeroUsuariosReservacion = (empty($_GET['nu'])) ? NULL : $_GET['nu'];
                $IdReservacion = (empty($_GET['idreservacion'])) ? NULL : $_GET['idreservacion'];
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS
                $consulta3 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema3, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion,
                $AplicacionReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta4 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema4);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta5 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema5, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                $consulta6 = $Gestiones->ConsultaDetallesReservacion_ReasignacionGrupo($conectarsistema6, $CodigoUnicoIdentificadorReservacion, $IdReservacion);
                
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta8 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema8, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> MOSTRAR ESAS OPCIONES EN EL MISMO <SELECT></SELECT>
                $consulta9 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema9, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion,
                $AplicacionReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> VALIDACION DE MODULOS OCUPADOS POR LABORATORIO
                $consulta10 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema10, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion,
                $AplicacionReservacion);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta10 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema10);
                */
                require('../Vista/AdministradorGeneral/oferta-reasignacion-grupo-completo-reservaciones.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta10); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA10
                mysqli_free_result($consulta9); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA9
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                $conectarsistema8->close(); // CERRANDO CONEXION AUXILIAR 8
                $conectarsistema9->close(); // CERRANDO CONEXION AUXILIAR 9
                $conectarsistema10->close(); // CERRANDO CONEXION AUXILIAR 10
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
         // INICIO PROCESAMIENTO RESERVACIONES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO]
         case "modificar-grupo-completo-reservacion-procesada-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $CodigoUnicoIdentificadorReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion'];
                $AplicacionReservacion = (empty($_GET['app'])) ? NULL : $_GET['app'];
                $FechaInicioReservacion = (empty($_GET['fi'])) ? NULL : $_GET['fi'];
                $FechaFinReservacion = (empty($_GET['ff'])) ? NULL : $_GET['ff'];
                $HoraInicioReservacion = (empty($_GET['hi'])) ? NULL : $_GET['hi'];
                $HoraFinReservacion = (empty($_GET['hf'])) ? NULL : $_GET['hf'];
                $NumeroUsuariosReservacion = (empty($_GET['nu'])) ? NULL : $_GET['nu'];
                $IdReservacion = (empty($_GET['idreservacion'])) ? NULL : $_GET['idreservacion'];
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS
                $consulta3 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema3, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion,
                $AplicacionReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta4 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema4);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta5 = $Gestiones->OfertaDisponibleReservacionesLaboratorios($conectarsistema5, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                $consulta6 = $Gestiones->ConsultaDetallesReservacion_ReasignacionGrupo($conectarsistema6, $CodigoUnicoIdentificadorReservacion, $IdReservacion);
                
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta8 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema8, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> MOSTRAR ESAS OPCIONES EN EL MISMO <SELECT></SELECT>
                $consulta9 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema9, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion,
                $AplicacionReservacion);
                // OPCIONES OFRECIDAS A USUARIOS, LABORATORIOS CON MODULOS -> VALIDACION DE MODULOS OCUPADOS POR LABORATORIO
                $consulta10 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosConModulos($conectarsistema10, $FechaInicioReservacion, $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion,
                $AplicacionReservacion);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta10 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema10);
                */
                require('../Vista/AdministradorLaboratorio/oferta-reasignacion-grupo-completo-reservaciones-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta10); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA10
                mysqli_free_result($consulta9); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA9
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                $conectarsistema8->close(); // CERRANDO CONEXION AUXILIAR 8
                $conectarsistema9->close(); // CERRANDO CONEXION AUXILIAR 9
                $conectarsistema10->close(); // CERRANDO CONEXION AUXILIAR 10
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        case "envio-datos-reasignacion-reservaciones-laboratorios":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=2) {
                $IdLaboratorio = (empty($_POST['sltlaboratorio_reservacion'])) ? NULL : $_POST['sltlaboratorio_reservacion']; // ID RESERVACION
                $IdReservacion = (empty($_POST['txtIdReservacion'])) ? NULL : $_POST['txtIdReservacion']; // ID RESERVACION
                $CodigoUnicoIdentificadorReservacion = (empty($_POST['txtCodigoUnicoReservacion'])) ? NULL : $_POST['txtCodigoUnicoReservacion']; // CODIGO UNICO IDENTIFICADOR
                //-> CONSULTAR CORREO DE USUARIO QUIEN REGISTRO RESERVACION
                $CorreoTitularReservaciones = $Gestiones->ConsultarCorreoEnvioCorreoReasignacionReservaciones($conectarsistema1, $CodigoUnicoIdentificadorReservacion, $IdReservacion);
                $CorreoTitularReservaciones = mysqli_fetch_array($CorreoTitularReservaciones);
                $ObtenerCorreo = $CorreoTitularReservaciones[4];
                // PASO A VARIABLE DESTINATARIO PARA ENVIO DE CORREO ELECTRONICO
                $Destinatario = $ObtenerCorreo;
                //--** VALIDACION DE ESPACIOS OCUPADOS POR MODULOS Y LABORATORIOS **--//
                //-> LABORATORIO 3
                $EspacioModulo1Lab3 = (empty($_POST['txtEspacioMod1Lab3'])) ? "-1" : $_POST['txtEspacioMod1Lab3'];
                $EspacioModulo2Lab3 = (empty($_POST['txtEspacioMod2Lab3'])) ? "-1" : $_POST['txtEspacioMod2Lab3'];
                $EspacioModulo3Lab3 = (empty($_POST['txtEspacioMod3Lab3'])) ? "-1" : $_POST['txtEspacioMod3Lab3'];
                $EspacioModulo4Lab3 = (empty($_POST['txtEspacioMod4Lab3'])) ? "-1" : $_POST['txtEspacioMod4Lab3'];
                //-> LABORATORIO 8
                $EspacioModulo1Lab8 = (empty($_POST['txtEspacioMod1Lab8'])) ? "-1" : $_POST['txtEspacioMod1Lab8'];
                $EspacioModulo2Lab8 = (empty($_POST['txtEspacioMod2Lab8'])) ? "-1" : $_POST['txtEspacioMod2Lab8'];
                $EspacioModulo3Lab8 = (empty($_POST['txtEspacioMod3Lab8'])) ? "-1" : $_POST['txtEspacioMod3Lab8'];
                $EspacioModulo4Lab8 = -1; // NO POSEE MODULO 4
                //-> LABORATORIO 14
                $EspacioModulo1Lab14 = (empty($_POST['txtEspacioMod1Lab14'])) ? "-1" : $_POST['txtEspacioMod1Lab14'];
                $EspacioModulo2Lab14 = (empty($_POST['txtEspacioMod2Lab14'])) ? "-1" : $_POST['txtEspacioMod2Lab14'];
                $EspacioModulo3Lab14 = -1; // NO POSEE MODULO 3
                $EspacioModulo4Lab14 = -1; // NO POSEE MODULO 4
                $NumeroUsuariosReservacion = (empty($_POST['txtNumeroUsuariosReservacion'])) ? NULL : $_POST['txtNumeroUsuariosReservacion']; // NUMERO USUARIOS ASISTIR RESERVACION
                /**********************************************************************
                * -> VERIFICAR LABORATORIOS QUE POSEEN MODULOS
                * LLENADO AUTOMATICO DE ESPACIOS SEGUN CANTIDAD DE USUARIOS A PROCESAR
                ***********************************************************************/
                // LABORATORIO 3
                if($IdLaboratorio == 3){
                    // CANTIDAD DE USUARIOS MAXIMO POR MODULO
                    $CantidadModulo1 = 27;
                    $CantidadModulo2 = 36;
                    $CantidadModulo3 = 36;
                    $CantidadModulo4 = 26;
                    // MODIFICAR SI LABORATORIO 3 TIENE MAQUINAS FUERA DE USO
                    $MaquinasFueraUsoLab3 = 0;
                    // LIMITE DE LABORATORIO 1
                    $LimiteLab3 = 125-$MaquinasFueraUsoLab3;
                    $TotalUsuariosReservados = $NumeroUsuariosReservacion;
                    // ASIGNAR USUARIOS A MODULO 1
                    if ($EspacioModulo1Lab3 > 0) {
                        $Modulo1 = min($TotalUsuariosReservados, $CantidadModulo1, $EspacioModulo1Lab3);
                        $TotalUsuariosReservados -= $Modulo1;
                        $EspacioModulo1Lab3 -= $Modulo1;
                        //echo "Modulo1: ".$Modulo1."<br>";
                    } else {
                        $Modulo1 = 0;
                    }
                    // ASIGNAR USUARIOS A MODULO 2
                    if ($EspacioModulo2Lab3 > 0) {
                        $Modulo2 = min($TotalUsuariosReservados, $CantidadModulo2, $EspacioModulo2Lab3);
                        $TotalUsuariosReservados -= $Modulo2;
                        $EspacioModulo2Lab3 -= $Modulo2;
                        //echo "Modulo2: ".$Modulo2."<br>";
                    } else {
                        $Modulo2 = 0;
                    }
                    // ASIGNAR USUARIOS A MODULO 3
                    if ($EspacioModulo3Lab3 > 0) {
                        $Modulo3 = min($TotalUsuariosReservados, $CantidadModulo3, $EspacioModulo3Lab3);
                        $TotalUsuariosReservados -= $Modulo3;
                        $EspacioModulo3Lab3 -= $Modulo3;
                        //echo "Modulo3: ".$Modulo3."<br>";
                    } else {
                        $Modulo3 = 0;
                    }
                    // ASIGNAR USUARIOS A MODULO 4
                    if ($EspacioModulo4Lab3 > 0) {
                        $Modulo4 = min($TotalUsuariosReservados, $CantidadModulo4, $EspacioModulo4Lab3);
                        $TotalUsuariosReservados -= $Modulo4;
                        $EspacioModulo4Lab3 -= $Modulo4;
                        //echo "Modulo4: ".$Modulo4."<br>";
                    } else {
                        $Modulo4 = 0;
                    }
                    // DISTRIBUIR USUARIOS A OTROS MÓDULOS
                    if ($TotalUsuariosReservados > 0) {
                        // Distribuir usuarios al modulo 1 si está disponible
                        if ($EspacioModulo1Lab3 > 0) {
                            $Modulo1 += min($TotalUsuariosReservados, $CantidadModulo1 - $Modulo1, $EspacioModulo1Lab3);
                            $TotalUsuariosReservados -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                            $EspacioModulo1Lab3 -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                        }
                        // Distribuir usuarios al modulo 2 si está disponible
                        if ($TotalUsuariosReservados > 0 && $EspacioModulo2Lab3 > 0) {
                        $Modulo2 += min($TotalUsuariosReservados, $CantidadModulo2 - $Modulo2, $EspacioModulo2Lab3);
                        $TotalUsuariosReservados -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                        $EspacioModulo2Lab3 -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                        }
                        // Distribuir usuarios al modulo 3 si está disponible
                        if ($TotalUsuariosReservados > 0 && $EspacioModulo3Lab3 > 0) {
                            $Modulo3 += min($TotalUsuariosReservados, $CantidadModulo3 - $Modulo3, $EspacioModulo3Lab3);
                            $TotalUsuariosReservados -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                            $EspacioModulo3Lab3 -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                        }
                        // Distribuir usuarios al modulo 4 si está disponible
                        if ($TotalUsuariosReservados > 0 && $EspacioModulo4Lab3 > 0) {
                            $Modulo4 += min($TotalUsuariosReservados, $CantidadModulo4 - $Modulo4, $EspacioModulo4Lab3);
                            $TotalUsuariosReservados -= ($Modulo4 - min($Modulo4, $CantidadModulo4));
                            $EspacioModulo4Lab3 -= ($Modulo4 - min($Modulo4, $CantidadModulo4));
                        }
                    }
                // LABORATORIO 8
                }else if($IdLaboratorio == 8){
                    // CANTIDAD DE USUARIOS MAXIMO POR MODULO
                    $CantidadModulo1 = 23;
                    $CantidadModulo2 = 30;
                    $CantidadModulo3 = 31;
                    $CantidadModulo4 = -1; // YA QUE NO POSEE MODULO 4
                    // MODIFICAR SI LABORATORIO 8 TIENE MAQUINAS FUERA DE USO
                    $MaquinasFueraUsoLab8 = 0;
                    // LIMITE DE LABORATORIO 8
                    $LimiteLab8 = 88-$MaquinasFueraUsoLab8;
                    $TotalUsuariosReservados = $NumeroUsuariosReservacion;
                    // ASIGNAR USUARIOS A MODULO 1
                    if ($EspacioModulo1Lab8 > 0) {
                        $Modulo1 = min($TotalUsuariosReservados, $CantidadModulo1, $EspacioModulo1Lab8);
                        $TotalUsuariosReservados -= $Modulo1;
                        $EspacioModulo1Lab8 -= $Modulo1;
                        //echo "Modulo1: ".$Modulo1."<br>";
                    } else {
                        $Modulo1 = 0;
                    }
                    // ASIGNAR USUARIOS A MODULO 2
                    if ($EspacioModulo2Lab8 > 0) {
                        $Modulo2 = min($TotalUsuariosReservados, $CantidadModulo2, $EspacioModulo2Lab8);
                        $TotalUsuariosReservados -= $Modulo2;
                        $EspacioModulo2Lab8 -= $Modulo2;
                        //echo "Modulo2: ".$Modulo2."<br>";
                    } else {
                        $Modulo2 = 0;
                    }
                    // ASIGNAR USUARIOS A MODULO 3
                    if ($EspacioModulo3Lab8 > 0) {
                        $Modulo3 = min($TotalUsuariosReservados, $CantidadModulo3, $EspacioModulo3Lab8);
                        $TotalUsuariosReservados -= $Modulo3;
                        $EspacioModulo3Lab8 -= $Modulo3;
                        //echo "Modulo3: ".$Modulo3."<br>";
                    } else {
                        $Modulo3 = 0;
                    }
                    $Modulo4 = -1; // NO POSEE MODULO 4
                    // DISTRIBUIR USUARIOS A OTROS MÓDULOS
                    if ($TotalUsuariosReservados > 0) {
                        // Distribuir usuarios al modulo 1 si está disponible
                        if ($EspacioModulo1Lab8 > 0) {
                            $Modulo1 += min($TotalUsuariosReservados, $CantidadModulo1 - $Modulo1, $EspacioModulo1Lab8);
                            $TotalUsuariosReservados -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                            $EspacioModulo1Lab8 -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                        }
                        // Distribuir usuarios al modulo 2 si está disponible
                        if ($TotalUsuariosReservados > 0 && $EspacioModulo2Lab8 > 0) {
                            $Modulo2 += min($TotalUsuariosReservados, $CantidadModulo2 - $Modulo2, $EspacioModulo2Lab8);
                            $TotalUsuariosReservados -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                            $EspacioModulo2Lab8 -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                        }
                        // Distribuir usuarios al modulo 3 si está disponible
                        if ($TotalUsuariosReservados > 0 && $EspacioModulo3Lab8 > 0) {
                            $Modulo3 += min($TotalUsuariosReservados, $CantidadModulo3 - $Modulo3, $EspacioModulo3Lab8);
                            $TotalUsuariosReservados -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                            $EspacioModulo3Lab8 -= ($Modulo3 - min($Modulo3, $CantidadModulo3));
                        }
                    }
                    // LABORATORIO 14
                    }else if($IdLaboratorio == 14){
                        // CANTIDAD DE USUARIOS MAXIMO POR MODULO
                        $CantidadModulo1 = 32;
                        $CantidadModulo2 = 32;
                        $CantidadModulo3 = -1; // YA QUE NO POSEE MODULO 3
                        $CantidadModulo4 = -1; // YA QUE NO POSEE MODULO 4
                        // MODIFICAR SI LABORATORIO 3 TIENE MAQUINAS FUERA DE USO
                        $MaquinasFueraUsoLab14 = 0;
                        // LIMITE DE LABORATORIO 14
                        $LimiteLab14 = 65-$MaquinasFueraUsoLab14;
                        $TotalUsuariosReservados = $NumeroUsuariosReservacion;
                        // ASIGNAR USUARIOS A MODULO 1
                        if ($EspacioModulo1Lab14 > 0) {
                            $Modulo1 = min($TotalUsuariosReservados, $CantidadModulo1, $EspacioModulo1Lab14);
                            $TotalUsuariosReservados -= $Modulo1;
                            $EspacioModulo1Lab14 -= $Modulo1;
                            //echo "Modulo1: ".$Modulo1."<br>";
                        } else {
                            $Modulo1 = 0;
                        }

                        // ASIGNAR USUARIOS A MODULO 2
                        if ($EspacioModulo2Lab14 > 0) {
                            $Modulo2 = min($TotalUsuariosReservados, $CantidadModulo2, $EspacioModulo2Lab14);
                            $TotalUsuariosReservados -= $Modulo2;
                            $EspacioModulo2Lab14 -= $Modulo2;
                            //echo "Modulo2: ".$Modulo2."<br>";
                        } else {
                            $Modulo2 = 0;
                        }
                        // NO POSEEN ESOS MODULOS
                        $Modulo3 = -1; $Modulo4 = -1;
                        // DISTRIBUIR USUARIOS A OTROS MÓDULOS
                        if ($TotalUsuariosReservados > 0) {
                            // Distribuir usuarios al modulo 1 si está disponible
                            if ($EspacioModulo1Lab14 > 0) {
                                $Modulo1 += min($TotalUsuariosReservados, $CantidadModulo1 - $Modulo1, $EspacioModulo1Lab14);
                                $TotalUsuariosReservados -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                                $EspacioModulo1Lab14 -= ($Modulo1 - min($Modulo1, $CantidadModulo1));
                            }
                            // Distribuir usuarios al modulo 2 si está disponible
                            if ($TotalUsuariosReservados > 0 && $EspacioModulo2Lab14 > 0) {
                                $Modulo2 += min($TotalUsuariosReservados, $CantidadModulo2 - $Modulo2, $EspacioModulo2Lab14);
                                $TotalUsuariosReservados -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                                $EspacioModulo2Lab14 -= ($Modulo2 - min($Modulo2, $CantidadModulo2));
                            }
                        }   
                    }
                    else{
                        // LABORATORIOS QUE NO POSEEN MODULOS, SE LES ASIGNA -1 A CADA ESPACIO DE RESERVACION
                        $Modulo1 = -1; $Modulo2 = -1; $Modulo3 = -1; $Modulo4 = -1;
                    }
                    // EVITAR ACCION NULA O VACIA
                    if(empty($CodigoUnicoIdentificadorReservacion)){
                        // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                        header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                    }else{
                        // ENVIO A BASE DE DATOS
                        $consulta = $Gestiones->ActualizacionReasignacionReservacionesProcesadas($conectarsistema, $IdReservacion, $CodigoUnicoIdentificadorReservacion, $IdLaboratorio, $Modulo1, $Modulo2,
                        $Modulo3, $Modulo4);
                        /*******************************************************************************
                         * ENVIO DE CORREO AUTOMATICO NOTIFICACION A USUARIO QUE REALIZO RESERVACION
                         *******************************************************************************/
                        $mail->addAddress($Destinatario);
                        $Nombre = "FICA - Reasignación Reservación"; // NOMBRE POR DEFECTO EMPRESA
                        $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                        $Asunto = "Aviso Modificación Reservación - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                        // INICIALIZANDO CLASE DE ENVIO DE CORRREOS -> USUARIOS QUE RECUPERAN SU CUENTA
                        $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                        // Crear una instancia y pasar true para permitir las excepciones
                        $mail = new PHPMailer(true);
                        try{
                            $mail->isSMTP();
                            $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port       = 587;
                            $mail->SMTPSecure = 'tls';
                            $mail->SMTPAuth   = true;
                            $mail->Username = 'proyectosedmr@gmail.com';
                            $mail->Password = 'nodhtetwzespsuwy';
                            //$mail->SetFrom('proyectosedmr@gmail.com', $Nombre);
                            // DESTINATARIOS Y REMITENTES
                            $mail->setFrom($Remitente, $Nombre);
                            $mail->addAddress($Destinatario);
                            /**
                             * -> DEPURACION 
                             *      -> COMPROBACION DE ERRORES
                             *  */
                            //$mail->SMTPDebug  = 3;
                            //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
                            $mail->IsHTML(true);
                            $mail->Subject = $Asunto;
                            $mail->Body    = '<!DOCTYPE html>
                            <html lang="es">
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
                                <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                <style>
                                body{
                                width: 650px;
                                font-family: work-Sans, sans-serif;
                                background-color: #f6f7fb;
                                display: block;
                                }
                                a{
                                text-decoration: none;
                                }
                                span {
                                font-size: 14px;
                                }
                                p {
                                    font-size: 13px;
                                    line-height: 1.7;
                                    letter-spacing: 0.7px;
                                    margin-top: 0;
                                }
                                .text-center{
                                text-align: center
                                }
                                h6 {
                                font-size: 16px;
                                margin: 0 0 18px 0;
                                }
                                </style>
                            </head>
                            <body style="margin: 30px auto;">
                                <table style="width: 100%">
                                <tbody>
                                    <tr>
                                    <td>
                                        <table style="background-color: #f6f7fb; width: 100%">
                                        <tbody>
                                            <tr>
                                            <td>
                                                <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                                <tbody>
                                                    <tr>
                                                    <td><a href="#"><img class="img-fluid" width="350" src="https://cashmanha.helioho.st/utec_logo.jpg" alt=""></a></td>
                                                    <td style="text-align: right; color:#999"><span>Control Laboratorios FICA</span></td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                        <tbody>
                                            <tr>
                                            <td style="padding: 30px"> 
                                                <h6 style="font-weight: 600">Estimado(a) Usuario:</h6>
                                                <img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/repair-tools.gif">
                                                <p> Su reservaci&oacute;n procesada, bajo el identificador &uacute;nico '.$CodigoUnicoIdentificadorReservacion.' se ha reasignado al laboratorio '.$IdLaboratorio.' de inform&aacute;tica. Por favor consulte mis reservaciones
                                                    para m&aacute;s detalles. <strong>Recuerde que estas reasignaciones no afectan al todo el grupo de reservaciones si usted proceso
                                                    m&aacute;s de una.
                                                    </strong>
                                                </p>
                                                <p>
                                                
                                                </p>
                                                
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                        <tbody>       
                                            <tr style="text-align: center">
                                            <td> 
                                                <p style="color: #ff7675; margin-bottom: 0">ESTE CORREO HA SIDO GENERADO AUTOMATICAMENTE, AGRADECEMOS NO RESPONDER AL MISMO</p>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                    </tr>
                                </tbody>
                                </table>
                            </body>
                            </html>  
                            
                            ';
                        // SOLO ENVIAR CORREO SI LA INSERCION SE REALIZA EXITOSAMENTE
                        if($consulta=="OK"){
                            $mail->send();
                        }   
                        /*******************************************************************************
                         * ENVIO DE CORREO AUTOMATICO NOTIFICACION A TODOS LOS USUARIOS ASIGNADOS A X
                         * LABORATORIO DONDE SE REALIZO LA REASIGNACION DE LA RESERVACION
                         *******************************************************************************/
                        //-> OBTENER EL ID DEL LABORATORIO SELECCIONADO
                        switch($IdLaboratorio){
                            case 1:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "si", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 2:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "si", "", "", "", "", "", "", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 3:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "si", "", "", "", "", "", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 4:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "si", "", "", "", "", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 5:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "si", "", "", "", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 6:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "si", "", "", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 7:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "si", "", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 8:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "si", "", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 9:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "", "si", "", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 10:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "", "", "si", "", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 11:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "", "", "", "si", "", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 12:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "", "", "", "", "si", "", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 13:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "", "", "", "", "", "si", "", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 14:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "", "", "", "", "", "", "si", "");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                            case 15:
                                $ConsultarCorreoUsuariosAsignadosLaboratorios = $Gestiones->CosultarCorreoUsuariosReservaciones($conectarsistema2, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "si");
                                $correosUsuarios = array(); // GUARDAR RESULTADOS COINCIDENTES EN UN ARRAY
                                while($ObtenerCorreosUsuarios = mysqli_fetch_array($ConsultarCorreoUsuariosAsignadosLaboratorios)) {
                                    $correosUsuarios[] = $ObtenerCorreosUsuarios[4]; // OBTENER DATOS COINCIDENTES
                                }
                                break;
                        }
                        foreach ($correosUsuarios as $Destinatarios) {
                            $mail->addAddress($Destinatarios);
                            $Nombre = "FICA - Nueva Reservación"; // NOMBRE POR DEFECTO EMPRESA
                            $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                            $Asunto = "Aviso Reasignación Reservación - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                            // INICIALIZANDO CLASE DE ENVIO DE CORRREOS -> USUARIOS QUE RECUPERAN SU CUENTA
                            $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                            // Crear una instancia y pasar true para permitir las excepciones
                            $mail = new PHPMailer(true);
                            try{
                                $mail->isSMTP();
                                $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                                $mail->Host = 'smtp.gmail.com';
                                $mail->Port       = 587;
                                $mail->SMTPSecure = 'tls';
                                $mail->SMTPAuth   = true;
                                $mail->Username = 'proyectosedmr@gmail.com';
                                $mail->Password = 'nodhtetwzespsuwy';
                                //$mail->SetFrom('proyectosedmr@gmail.com', $Nombre);
                                // DESTINATARIOS Y REMITENTES
                                $mail->setFrom($Remitente, $Nombre);
                                $mail->addAddress($Destinatarios);
                                /**
                                 * -> DEPURACION 
                                 *      -> COMPROBACION DE ERRORES
                                 *  */
                                //$mail->SMTPDebug  = 3;
                                //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
                                $mail->IsHTML(true);
                                $mail->Subject = $Asunto;
                                $mail->Body    = '<!DOCTYPE html>
                                <html lang="es">
                                <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
                                    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                    <style>
                                    body{
                                    width: 650px;
                                    font-family: work-Sans, sans-serif;
                                    background-color: #f6f7fb;
                                    display: block;
                                    }
                                    a{
                                    text-decoration: none;
                                    }
                                    span {
                                    font-size: 14px;
                                    }
                                    p {
                                        font-size: 13px;
                                        line-height: 1.7;
                                        letter-spacing: 0.7px;
                                        margin-top: 0;
                                    }
                                    .text-center{
                                    text-align: center
                                    }
                                    h6 {
                                    font-size: 16px;
                                    margin: 0 0 18px 0;
                                    }
                                    </style>
                                </head>
                                <body style="margin: 30px auto;">
                                    <table style="width: 100%">
                                    <tbody>
                                        <tr>
                                        <td>
                                            <table style="background-color: #f6f7fb; width: 100%">
                                            <tbody>
                                                <tr>
                                                <td>
                                                    <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                                    <tbody>
                                                        <tr>
                                                        <td><a href="#"><img class="img-fluid" width="350" src="https://cashmanha.helioho.st/utec_logo.jpg" alt=""></a></td>
                                                        <td style="text-align: right; color:#999"><span>Control Laboratorios FICA</span></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                            <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                            <tbody>
                                                <tr>
                                                <td style="padding: 30px"> 
                                                    <h6 style="font-weight: 600">Estimado(a) Usuario:</h6>
                                                    <!--img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/repair-tools.gif"-->
                                                    <p> Estimado(a) usuario, se ha reasignado una reservaci&oacute;n a su laboratorio n&uacute;mero '.$IdLaboratorio.' de inform&aacute;tica. Por favor
                                                        revise el portal para mayores detalles.
                                                    </p>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                            <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                            <tbody>       
                                                <tr style="text-align: center">
                                                <td> 
                                                    <p style="color: #ff7675; margin-bottom: 0">ESTE CORREO HA SIDO GENERADO AUTOMATICAMENTE, AGRADECEMOS NO RESPONDER AL MISMO</p>
                                                </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </body>
                                </html>            
                                
                                ';
                                // SOLO ENVIAR CORREO SI LA INSERCION SE REALIZA EXITOSAMENTE
                            if($consulta=="OK"){
                                    $mail->send();
                            }
                            }catch (Exception $e){/*NO HACER NADA SI FALLA*/}
                        }
                        
                        }catch (Exception $e){/*NO HACER NADA SI FALLA*/}
                        // ENVIANDO RESPUESTA DE ACCION A MODELO
                        echo json_encode($consulta);
                    }
                    //-> CIERRE DE CONEXIONES
                    $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL  
                    // -> CIERRE DE CONEXIONES AUXILIARES
                    $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1  
                    $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2 
                }else {
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <=2)
                break;
        // INICIO PROCESAMIENTO RESERVACIONES PRACTICAS LIBRES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO]
        case "gestion-reservaciones-laboratorios-practicas-libres":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/nueva-reservacion-practica-libre.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INICIO PROCESAMIENTO RESERVACIONES PRACTICAS LIBRES LABORATORIOS INFORMATICA [EXCLUSIVO ADMINISTRADOR DE LABORATORIO]
        case "gestion-reservaciones-laboratorios-practicas-libres-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/nueva-reservacion-practica-libre-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // PROCESAMIENTO RESERVACIONES PRACTICAS LIBRES LABORATORIOS INFORMATICA [EXCLUSIVO COORDINADOR DE LABORATORIO] -> SEGUNDA FASE
        case "gestion-reservaciones-laboratorios-practicas-libres-segunda-fase":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                //$NumeroUsuariosReservacion = (empty($_POST['txtcantidadusuariosreservacionPL'])) ? NULL : $_POST['txtcantidadusuariosreservacionPL']; // NUMERO DE USUARIOS A ASISTIR
                $NumeroUsuariosReservacion = 1; // PARA MANTENER EL ORDEN, CADA SOLICITUD SE PROCESARA INDIVIDUALMENTE
                $AplicacionReservacion = (empty($_POST['sltaplicacionreservacionPL'])) ? NULL : $_POST['sltaplicacionreservacionPL']; // APLICACION A UTILIZAR
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacionPL'])) ? NULL : $_POST['txtInicioReservacionPL']; // FECHA INICIO RESERVACION
                $FechaFinReservacion = (empty($_POST['txtInicioReservacionPL'])) ? NULL : $_POST['txtInicioReservacionPL']; // FECHA INICIO RESERVACION
                $HoraInicioReservacion = (empty($_POST['txtHoraInicioPL'])) ? NULL : $_POST['txtHoraInicioPL']; // HORA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraInicioPL'])) ? NULL : $_POST['txtHoraInicioPL']; // HORA INICIO RESERVACION
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosPracticasLibres($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema3);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta4 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosPracticasLibres($conectarsistema4, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta5 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema5);
                // CONSULTA TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS
                $consulta6 = $Gestiones->ConsultarEscuelasFacultadesRegistradas($conectarsistema6);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta7 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema7, $IdUsuarios);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta8 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema8);
                */
                require('../Vista/AdministradorGeneral/oferta-ofrecida-reservaciones-usuarios-practicas-libres.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // PROCESAMIENTO RESERVACIONES PRACTICAS LIBRES LABORATORIOS INFORMATICA [EXCLUSIVO ADMINISTRADOR DE LABORATORIO] -> SEGUNDA FASE
        case "gestion-reservaciones-laboratorios-practicas-libres-segunda-fase-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                //$NumeroUsuariosReservacion = (empty($_POST['txtcantidadusuariosreservacionPL'])) ? NULL : $_POST['txtcantidadusuariosreservacionPL']; // NUMERO DE USUARIOS A ASISTIR
                $NumeroUsuariosReservacion = 1; // PARA MANTENER EL ORDEN, CADA SOLICITUD SE PROCESARA INDIVIDUALMENTE
                $AplicacionReservacion = (empty($_POST['sltaplicacionreservacionPL'])) ? NULL : $_POST['sltaplicacionreservacionPL']; // APLICACION A UTILIZAR
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacionPL'])) ? NULL : $_POST['txtInicioReservacionPL']; // FECHA INICIO RESERVACION
                $FechaFinReservacion = (empty($_POST['txtInicioReservacionPL'])) ? NULL : $_POST['txtInicioReservacionPL']; // FECHA INICIO RESERVACION
                $HoraInicioReservacion = (empty($_POST['txtHoraInicioPL'])) ? NULL : $_POST['txtHoraInicioPL']; // HORA INICIO RESERVACION
                $HoraFinReservacion = (empty($_POST['txtHoraInicioPL'])) ? NULL : $_POST['txtHoraInicioPL']; // HORA INICIO RESERVACION
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // OPCIONES OFRECIDAS A USUARIOS, SEGUN PARAMETROS INGRESADOS
                $consulta2 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosPracticasLibres($conectarsistema2, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema3);
                // SELECCIONAR LABORATORIOS OFRECIDOS, SEGUN PARAMETROS INGRESADOS POR USUARIOS
                $consulta4 = $Gestiones->OfertaDisponibleReservacionesLaboratoriosPracticasLibres($conectarsistema4, $AplicacionReservacion, $NumeroUsuariosReservacion, $FechaInicioReservacion, 
                $FechaFinReservacion, $HoraInicioReservacion, $HoraFinReservacion);
                // CONSULTA TODOS LOS TIPOS DE RESERVACIONES REGISTRADOS
                $consulta5 = $Gestiones->ConsultaGeneralTiposReservaciones($conectarsistema5);
                // CONSULTA TODAS LAS ESCUELAS DE FACULTADES REGISTRADAS
                $consulta6 = $Gestiones->ConsultarEscuelasFacultadesRegistradas($conectarsistema6);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta7 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema7, $IdUsuarios);
                /* -> EN CASO DE SER NECESARIO = QUITAR COMENTARIOS EN EL ARCHIVO CONEXION, CON REFERENCIA A ESTA CONEXION
                // CONSULTA TODAS LAS FACULTADES REGISTRADAS
                $consulta8 = $Gestiones->ConsultarFacultadesRegistradas($conectarsistema8);
                */
                require('../Vista/AdministradorLaboratorio/oferta-ofrecida-reservaciones-usuarios-practicas-libres-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // ENVIO A BASE DE DATOS -> REGISTRAR NUEVAS RESERVACIONES [EXCLUSIVO COORDINADORES Y ADMINISTRADORES DE LABORATORIOS]
        case "envio-datos-registro-nuevas-practicas-libres":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdAplicacion = (empty($_POST['txtAplicacionReservacionPL'])) ? NULL : $_POST['txtAplicacionReservacionPL']; // ID APLICACION
                $IdTipoReservacion = 6; // ID TIPO RESERVACION
                $IdLaboratorio = (empty($_POST['sltlaboratorio_reservacionPL'])) ? NULL : $_POST['sltlaboratorio_reservacionPL']; // ID LABORATORIO
                $IdFacultad = (empty($_POST['sltfacultad_reservacionPL'])) ? NULL : $_POST['sltfacultad_reservacionPL']; // ID FACULTAD
                $NombreUsuarioReservacion = (empty($_POST['txtNombreUsuarioReservacionPL'])) ? NULL : $_POST['txtNombreUsuarioReservacionPL']; // NOMBRE USUARIO RESERVACION
                $CarneUsuarioReservacion = (empty($_POST['txtCarneUsuarioReservacionPL'])) ? NULL : $_POST['txtCarneUsuarioReservacionPL']; // CARNE USUARIO RESERVACION
                $FechaInicioReservacion = (empty($_POST['txtFechaInicioReservacionPL'])) ? NULL : $_POST['txtFechaInicioReservacionPL']; // FECHA INICIO RESERVACION
                $HoraInicioReservacion = (empty($_POST['txtHoraInicioReservacionPL'])) ? NULL : $_POST['txtHoraInicioReservacionPL']; // HORA INICIO RESERVACION
                $CicloActual = "02-2023"; // CICLO ACTUAL
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdLaboratorio)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistroNuevasPracticasLibresLaboratorios($conectarsistema, $IdAplicacion, $IdTipoReservacion, $IdLaboratorio, $IdFacultad, $IdUsuarios, 
                    $NombreUsuarioReservacion, $CarneUsuarioReservacion, $FechaInicioReservacion, $HoraInicioReservacion, $CicloActual);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS ACTIVAS
        case "consulta-practicas-libres-activas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES ACTIVAS
                $consulta2 = $Gestiones->ListadoPracticasLibresActivas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-activas.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS ACTIVAS
        case "consulta-practicas-libres-activas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES ACTIVAS
                $consulta2 = $Gestiones->ListadoPracticasLibresActivas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-activas-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS
        case "consulta-practicas-libres-finalizadas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS -> TODOS LOS LABORATORIOS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS
        case "consulta-practicas-libres-finalizadas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS -> TODOS LOS LABORATORIOS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB1]
        case "consulta-practicas-libres-finalizada-laboratorio-uno":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio1.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB1]
        case "consulta-practicas-libres-finalizada-laboratorio-uno-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab1($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio1-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB2]
        case "consulta-practicas-libres-finalizada-laboratorio-dos":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab2($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio2.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB2]
        case "consulta-practicas-libres-finalizada-laboratorio-dos-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab2($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio2-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB3]
        case "consulta-practicas-libres-finalizada-laboratorio-tres":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab3($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio3.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB3]
        case "consulta-practicas-libres-finalizada-laboratorio-tres-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab3($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio3-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB4]
        case "consulta-practicas-libres-finalizada-laboratorio-cuatro":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab4($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio4.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB4]
        case "consulta-practicas-libres-finalizada-laboratorio-cuatro-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab4($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio4-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB5]
        case "consulta-practicas-libres-finalizada-laboratorio-cinco":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab5($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio5.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB5]
        case "consulta-practicas-libres-finalizada-laboratorio-cinco-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab5($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio5-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB6]
        case "consulta-practicas-libres-finalizada-laboratorio-seis":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab6($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio6.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB6]
        case "consulta-practicas-libres-finalizada-laboratorio-seis-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab6($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio6-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB7]
        case "consulta-practicas-libres-finalizada-laboratorio-siete":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab7($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio7.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB7]
        case "consulta-practicas-libres-finalizada-laboratorio-siete-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab7($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio7-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB8]
        case "consulta-practicas-libres-finalizada-laboratorio-ocho":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab8($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio8.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB8]
        case "consulta-practicas-libres-finalizada-laboratorio-ocho-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab8($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio8-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB9]
        case "consulta-practicas-libres-finalizada-laboratorio-nueve":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab9($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio9.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB9]
        case "consulta-practicas-libres-finalizada-laboratorio-nueve-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab9($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio9-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB10]
        case "consulta-practicas-libres-finalizada-laboratorio-diez":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab10($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio10.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB10]
        case "consulta-practicas-libres-finalizada-laboratorio-diez-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab10($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio10-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB11]
        case "consulta-practicas-libres-finalizada-laboratorio-once":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab11($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio11.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB11]
        case "consulta-practicas-libres-finalizada-laboratorio-once-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab11($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio11-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB12]
        case "consulta-practicas-libres-finalizada-laboratorio-doce":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab12($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio12.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB12]
        case "consulta-practicas-libres-finalizada-laboratorio-doce-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab12($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio12-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB13]
        case "consulta-practicas-libres-finalizada-laboratorio-trece":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab13($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio13.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB13]
        case "consulta-practicas-libres-finalizada-laboratorio-trece-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab13($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio13-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB14]
        case "consulta-practicas-libres-finalizada-laboratorio-catorce":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab14($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio14.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB14]
        case "consulta-practicas-libres-finalizada-laboratorio-catorce-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab14($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio14-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB15]
        case "consulta-practicas-libres-finalizada-laboratorio-quince":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab15($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-practicas-libres-finalizadas-laboratorio15.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL PRACTICAS LIBRES PROCESADAS FINALIZADAS [LAB15]
        case "consulta-practicas-libres-finalizada-laboratorio-quince-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA GENERAL DE PRACTICAS LIBRES FINALIZADAS
                $consulta2 = $Gestiones->ListadoPracticasLibresFinalizadasLab15($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-practicas-libres-finalizadas-laboratorio15-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // INSTRUCCIONES DE USO -> RESERVACIONES LABORATORIOS PRIMERA FASE [TODOS LOS ROLES DE USUARIO]
        case "instrucciones-reservaciones-laboratorios-primera-fase":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/AdministradorGeneral/instrucciones-proceso-reservaciones-laborarotios-primera-fase.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // INSTRUCCIONES DE USO -> RESERVACIONES LABORATORIOS PRIMERA FASE [TODOS LOS ROLES DE USUARIO]
        case "instrucciones-reservaciones-laboratorios-primera-fase-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/instrucciones-proceso-reservaciones-laborarotios-primera-fase-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // INSTRUCCIONES DE USO -> RESERVACIONES LABORATORIOS PRIMERA FASE [TODOS LOS ROLES DE USUARIO]
        case "instrucciones-reservaciones-laboratorios-primera-fase-docente":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // LISTADO INFORMACION GENERAL TODOS LOS LABORATORIOS DE INFORMATICA [RESERVACIONES]
                $consulta3 = $Gestiones->ListadoInformacionLaboratoriosReservaciones($conectarsistema3);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta4 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema4, $IdUsuarios);
                require('../Vista/Docentes/instrucciones-proceso-reservaciones-laboratorios-primera-fase-docentes.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES GENERAL [TODOS LOS EVENTOS DE TODOS LOS LABORATORIOS]
        case "consulta-calendario-actividades-general":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [TODOS LOS LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesGeneral($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [TODOS LOS LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesGeneral($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-general.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 1 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-uno":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 1]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio1($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 1]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio1($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-1.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 1 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-uno-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 1]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio1($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 1]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio1($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-1-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 2 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-dos":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 2]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio2($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 2]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio2($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-2.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 2 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-dos-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 2]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio2($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 2]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio2($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-2-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 3 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-tres":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 3]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio3($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 3]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio3($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-3.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 3 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-tres-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 3]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio3($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 3]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio3($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-3-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 4 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-cuatro":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 4]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio4($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 4]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio4($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-4.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 4 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-cuatro-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 4]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio4($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 4]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio4($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-4-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 5 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-cinco":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 5]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio5($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 5]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio5($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-5.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 5 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-cinco-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 5]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio5($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 5]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio5($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-5-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 6 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-seis":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 6]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio6($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 6]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio6($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-6.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 6 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-seis-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 6]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio6($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 6]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio6($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-6-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 7 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-siete":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 7]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio7($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 7]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio7($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-7.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 7 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-siete-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 7]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio7($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 7]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio7($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-7-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 8 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-ocho":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 8]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio8($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 8]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio8($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-8.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 8 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-ocho-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 8]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio8($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 8]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio8($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-8-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
         // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 9 [TODOS LOS EVENTOS APROBADOS]
         case "consulta-calendario-actividades-laboratorio-nueve":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 9]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio9($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 9]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio9($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-9.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 9 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-nueve-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 9]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio9($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 9]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio9($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-9-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 10 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-diez":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 10]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio10($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 10]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio10($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-10.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 10 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-diez-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 10]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio10($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 10]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio10($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-10-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 11 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-once":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {  
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 11]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio11($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 11]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio11($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-11.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 11 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-once-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 11]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio11($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 11]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio11($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-11-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 12 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-doce":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 12]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio12($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 12]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio12($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-12.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 12 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-doce-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 12]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio12($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 12]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio12($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-12-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 13 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-trece":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 13]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio13($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 13]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio13($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-13.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 13 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-trece-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 13]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio13($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 13]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio13($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-13-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 14 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-catorce":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 14]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio14($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 14]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio14($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-14.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 14 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-catorce-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 14]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio14($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 14]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio14($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-14-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 15 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-quince":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 15]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio15($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 15]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio15($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorGeneral/calendario-actividades-laboratorio-15.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA CALENDARIO DE ACTIVIDADES LABORATORIO 15 [TODOS LOS EVENTOS APROBADOS]
        case "consulta-calendario-actividades-laboratorio-quince-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTA TODAS LAS APLICACIONES REGISTRADAS [RESERVACIONES]
                $consulta2 = $Gestiones->ListadoAplicacionesReservaciones($conectarsistema2);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 15]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta3 = $Gestiones->ConsultarCalendarioActividadesLaboratorio15($conectarsistema3);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [LABORATORIO 15]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta4 = $Gestiones->ConsultarCalendarioActividadesLaboratorio15($conectarsistema4);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta5 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema5, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/calendario-actividades-laboratorio-15-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [PENDIENTE]
        case "consulta-reservaciones-pendientes":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO PENDIENTE
                $consulta2 = $Gestiones->ConsultarReservacionesPendientes($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-gestion-reservaciones-pendientes.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [PENDIENTE]
        case "consulta-reservaciones-pendientes-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO PENDIENTE
                $consulta2 = $Gestiones->ConsultarReservacionesPendientes($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-gestion-reservaciones-pendientes-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [PENDIENTE]
        case "consulta-reservaciones-aprobacion-inicial":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO APROBACION INICIAL
                $consulta2 = $Gestiones->ConsultarReservacionesAprobacionInicial($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-gestion-reservaciones-aprobacioninicial.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [APROBADAS]
        case "consulta-reservaciones-aprobadas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO APROBADAS
                $consulta2 = $Gestiones->ConsultarReservacionesAprobadas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-gestion-reservaciones-aprobadas.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [APROBADAS]
        case "consulta-reservaciones-aprobadas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO APROBADAS
                $consulta2 = $Gestiones->ConsultarReservacionesAprobadas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-gestion-reservaciones-aprobadas-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [DENEGADAS]
        case "consulta-reservaciones-denegadas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO DENEGADAS
                $consulta2 = $Gestiones->ConsultarReservacionesDenegadas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-gestion-reservaciones-denegadas.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [DENEGADAS]
        case "consulta-reservaciones-denegadas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO DENEGADAS
                $consulta2 = $Gestiones->ConsultarReservacionesDenegadas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-gestion-reservaciones-denegadas-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
          // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [CANCELADAS]
          case "consulta-reservaciones-canceladas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO APROBADAS
                $consulta2 = $Gestiones->ConsultarReservacionesCanceladas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-general-gestion-reservaciones-canceladas.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL RESERVACIONES PROCESADAS EN ESTADO [CANCELADAS]
        case "consulta-reservaciones-canceladas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS BAJO EL ESTADO APROBADAS
                $consulta2 = $Gestiones->ConsultarReservacionesCanceladas($conectarsistema2);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-general-gestion-reservaciones-canceladas-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL TODAS MIS RESERVACIONES PROCESADAS [SEGUN ID UNICO DE USUARIOS Y CICLO ACTUAL]
        case "consulta-mis-reservaciones-procesadas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $CicloActual = "02-2023"; // CICLO ACTUAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS SEGUN ID DE USUARIOS Y CICLO ACTUAL
                $consulta2 = $Gestiones->ConsultarMisReservacionesCicloActual($conectarsistema2, $IdUsuarios, $CicloActual);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorGeneral/consulta-mis-reservaciones-cicloactual.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA GENERAL TODAS MIS RESERVACIONES PROCESADAS [SEGUN ID UNICO DE USUARIOS Y CICLO ACTUAL]
        case "consulta-mis-reservaciones-procesadas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $CicloActual = "02-2023"; // CICLO ACTUAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS SEGUN ID DE USUARIOS Y CICLO ACTUAL
                $consulta2 = $Gestiones->ConsultarMisReservacionesCicloActual($conectarsistema2, $IdUsuarios, $CicloActual);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/consulta-mis-reservaciones-cicloactual-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA GENERAL TODAS MIS RESERVACIONES PROCESADAS [SEGUN ID UNICO DE USUARIOS Y CICLO ACTUAL]
        case "consulta-mis-reservaciones-procesadas-docentes":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $CicloActual = "02-2023"; // CICLO ACTUAL
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONSULTAR TODAS LAS RESERVACIONES REGISTRADAS SEGUN ID DE USUARIOS Y CICLO ACTUAL
                $consulta2 = $Gestiones->ConsultarMisReservacionesCicloActual($conectarsistema2, $IdUsuarios, $CicloActual);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta3 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema3, $IdUsuarios);
                require('../Vista/Docentes/consulta-mis-reservaciones-cicloactual-docentes.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA3
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION EN ESTADO PENDIENTE
        case "gestionar-reservaciones-pendientes":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION A GESTIONAR
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarReservaciones($conectarsistema3, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesReservacionesPendientes($conectarsistema4, $IdentificadorUnicoReservacion);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [SEGUN ID DE LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta5 = $Gestiones->ConsultarCalendarioActividadesGestionReservaciones($conectarsistema5, $IdLaboratorio);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [SEGUN ID DE LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta6 = $Gestiones->ConsultarCalendarioActividadesGestionReservaciones($conectarsistema6, $IdLaboratorio);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta7 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema7, $IdUsuarios);
                require("../Vista/AdministradorGeneral/gestionar-reservaciones-procesadas-pendientes.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION EN ESTADO PENDIENTE
        case "gestionar-reservaciones-pendientes-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) { 
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION A GESTIONAR
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarReservaciones($conectarsistema3, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesReservacionesPendientes($conectarsistema4, $IdentificadorUnicoReservacion);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [SEGUN ID DE LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta5 = $Gestiones->ConsultarCalendarioActividadesGestionReservaciones($conectarsistema5, $IdLaboratorio);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [SEGUN ID DE LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta6 = $Gestiones->ConsultarCalendarioActividadesGestionReservaciones($conectarsistema6, $IdLaboratorio);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta7 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema7, $IdUsuarios);
                require("../Vista/AdministradorLaboratorio/gestionar-reservaciones-procesadas-pendientes-administrador-laboratorio.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION EN ESTADO APROBACION INICIAL
        case "gestionar-reservaciones-aprobacion-inicial":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION A GESTIONAR
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarReservaciones($conectarsistema3, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesReservacionesPendientes($conectarsistema4, $IdentificadorUnicoReservacion);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [SEGUN ID DE LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA TODO EL LISTADO DE RESERVACIONES, LA ASIGNACION DE TODAS LAS VARIABLES EN EL CALENDARIO DE ACTIVIDADES
                $consulta5 = $Gestiones->ConsultarCalendarioActividadesGestionReservaciones($conectarsistema5, $IdLaboratorio);
                // CONSULTAR TODAS LAS RESERVACIONES APROBADAS EN CALENDARIO DE ACTIVIDADES [SEGUN ID DE LABORATORIOS]
                //-> ESTA CONSULTA CONTROLA LA IMPRESION DE TODAS LAS RESERVACIONES APROBADAS REGISTRADAS [RENDER]
                $consulta6 = $Gestiones->ConsultarCalendarioActividadesGestionReservaciones($conectarsistema6, $IdLaboratorio);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta7 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema7, $IdUsuarios);
                require("../Vista/AdministradorGeneral/gestionar-reservaciones-procesadas-aprobacion-inicial.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta6); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA6
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
                }else {
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION EN ESTADO APROBADAS
        case "gestionar-reservaciones-aprobadas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION A GESTIONAR
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarReservaciones($conectarsistema3, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesReservacionesAprobadasGestion($conectarsistema4, $IdentificadorUnicoReservacion);
                // CONSULTAR SEGUIMIENTO CONTROL DE RESERVACIONES FINALIZADAS
                $consulta5 = $Gestiones->ConsultarSeguimientoReservacionesFinalizadas($conectarsistema5, $IdentificadorUnicoReservacion);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta7 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema7, $IdUsuarios);
                require("../Vista/AdministradorGeneral/gestionar-reservaciones-procesadas-aprobadas.php");
                //-> LIBERAR MEMORIA
                
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION EN ESTADO APROBADAS
        case "gestionar-reservaciones-aprobadas-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION A GESTIONAR
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarReservaciones($conectarsistema3, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesReservacionesAprobadasGestion($conectarsistema4, $IdentificadorUnicoReservacion);
                // CONSULTAR SEGUIMIENTO CONTROL DE RESERVACIONES FINALIZADAS
                $consulta5 = $Gestiones->ConsultarSeguimientoReservacionesFinalizadas($conectarsistema5, $IdentificadorUnicoReservacion);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta7 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema7, $IdUsuarios);
                require("../Vista/AdministradorLaboratorio/gestionar-reservaciones-procesadas-aprobadas-administrador-laboratorio.php");
                //-> LIBERAR MEMORIA
                
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
                $conectarsistema7->close(); // CERRANDO CONEXION AUXILIAR 7
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION PROCESADAS [MIS RESERVACIONES]
        case "gestionar-mis-reservaciones":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdReservacion = (empty($_GET['idreservacion'])) ? NULL : $_GET['idreservacion']; // ID RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION PROCESADA
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarMisReservacionesProcesadas($conectarsistema3, $IdUsuarios, $IdentificadorUnicoReservacion, $IdReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesMisReservacionesProcesadas($conectarsistema4, $IdUsuarios, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [SEGUNDA TABLA DE DETALLES] -> GESTION DE INICIO / FINALIZAR SOLICITUD EN PROGRESO
                $consulta5 = $Gestiones->ConsultarDetallesMisReservacionesProcesadas($conectarsistema5, $IdUsuarios, $IdentificadorUnicoReservacion);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta6 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema6, $IdUsuarios);
                require("../Vista/AdministradorGeneral/gestionar-consulta-mis-reservaciones-procesadas.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION PROCESADAS [MIS RESERVACIONES]
        case "gestionar-mis-reservaciones-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdReservacion = (empty($_GET['idreservacion'])) ? NULL : $_GET['idreservacion']; // ID RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION PROCESADA
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarMisReservacionesProcesadas($conectarsistema3, $IdUsuarios, $IdentificadorUnicoReservacion, $IdReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesMisReservacionesProcesadas($conectarsistema4, $IdUsuarios, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [SEGUNDA TABLA DE DETALLES] -> GESTION DE INICIO / FINALIZAR SOLICITUD EN PROGRESO
                $consulta5 = $Gestiones->ConsultarDetallesMisReservacionesProcesadas($conectarsistema5, $IdUsuarios, $IdentificadorUnicoReservacion);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta6 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema6, $IdUsuarios);
                require("../Vista/AdministradorLaboratorio/gestionar-consulta-mis-reservaciones-procesadas-administrador-laboratorio.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // CONSULTA SOLICITUDES DE RESERVACION PROCESADAS [MIS RESERVACIONES]
        case "gestionar-mis-reservaciones-docentes":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                $IdReservacion = (empty($_GET['idreservacion'])) ? NULL : $_GET['idreservacion']; // ID RESERVACION
                $IdLaboratorio = (empty($_GET['laboratorio'])) ? NULL : $_GET['laboratorio']; // LABORATORIO ASIGNADO RESERVACION
                $IdUsuariosConsulta = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuariosConsulta);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuariosConsulta);
                // CONSULTA -> LISTADO DE TODOS LOS ROLES DE USUARIOS REGISTRADOS
                $consulta2 = $Gestiones->ConsultarRolesUsuariosRegistrados($conectarsistema2);
                // CONSULTA -> DATOS ESPECIFICOS DE RESERVACION PROCESADA
                $consulta3 = $Gestiones->ConsultaEspecificaGestionarMisReservacionesProcesadas($conectarsistema3, $IdUsuarios, $IdentificadorUnicoReservacion, $IdReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [PRIMERA TABLA DE DETALLES]
                $consulta4 = $Gestiones->ConsultarDetallesMisReservacionesProcesadas($conectarsistema4, $IdUsuarios, $IdentificadorUnicoReservacion);
                // CONSULTA -> DETALLE COMPLETO DE DIAS RESERVADOS [SEGUNDA TABLA DE DETALLES] -> GESTION DE INICIO / FINALIZAR SOLICITUD EN PROGRESO
                $consulta5 = $Gestiones->ConsultarDetallesMisReservacionesProcesadas($conectarsistema5, $IdUsuarios, $IdentificadorUnicoReservacion);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta6 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema6, $IdUsuarios);
                require("../Vista/Docentes/gestionar-consulta-mis-reservaciones-procesadas-docentes.php");
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta5); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA5
                mysqli_free_result($consulta4); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA4
                mysqli_free_result($consulta2); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA2
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
                $conectarsistema4->close(); // CERRANDO CONEXION AUXILIAR 4
                $conectarsistema5->close(); // CERRANDO CONEXION AUXILIAR 5
                $conectarsistema6->close(); // CERRANDO CONEXION AUXILIAR 6
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // MOSTRAR COMPROBANTE DE RESERVACION [MIS RESERVACIONES] [TODOS LOS ROLES DE USUARIO]
        case "comprobante-mis-reservaciones-aprobadas":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                // DETALLE COMPLETO DE RESERVACION PROCESADA [COMPROBANTE MIS RESERVACIONES]
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdentificadorUnicoReservacion = (empty($_GET['identificador_reservacion'])) ? NULL : $_GET['identificador_reservacion']; // ID UNICO DE RESERVACION
                // OBTENER DETALLE COMPLETO DE RESERVACION [IMPRESION EN TABLA]
                $consulta = $Gestiones->ConsultaComprobanteMisReservaciones($conectarsistema, $IdentificadorUnicoReservacion, $IdUsuarios);
                // OBTENER DETALLE COMPLETO ESPECIFICO DE RESERVACION [IMPRESION DE DETALLES PUNTUALES EN DOCUMENTO]
                $consulta1 = $Gestiones->ConsultaEspecificaComprobanteMisReservaciones($conectarsistema1, $IdentificadorUnicoReservacion, $IdUsuarios);
                require("../Vista/informe-reservaciones-aprobadas.php");
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3)
            break;
        /***************************************************
         * -> FUERA DE USO, PUEDE SER OCUPADO EN UN FUTURO
        ***************************************************/
        // ENVIO A BASE DE DATOS -> INICIAR RESERVACIONES PROCESADAS 
        case "envio-datos-iniciar-reservaciones":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdReservacion = (empty($_GET['idreservacion'])) ? NULL : $_GET['idreservacion']; // ID DE RESERVACION
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->IniciarReservacionesProcesadas($conectarsistema, $IdUsuarios, $IdReservacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        /***************************************************
         * -> FUERA DE USO, PUEDE SER OCUPADO EN UN FUTURO
        ***************************************************/
        // ENVIO A BASE DE DATOS -> FINALIZAR RESERVACIONES PROCESADAS 
        case "envio-datos-finalizar-reservaciones":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdReservacion = (empty($_GET['idreservacion'])) ? NULL : $_GET['idreservacion']; // ID DE RESERVACION
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->FinalizarReservacionesProcesadas($conectarsistema, $IdUsuarios, $IdReservacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> CANCELAR RESERVACIONES PROCESADAS 
        case "envio-datos-cancelar-reservaciones-individualmente":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $IdReservacion = (empty($_POST['txtIdReservacion'])) ? NULL : $_POST['txtIdReservacion']; // ID DE RESERVACION
                $ComentarioCancelacion = (empty($_POST['txtcomentariocancelacion_reservacion'])) ? NULL : $_POST['txtcomentariocancelacion_reservacion']; // COMENTARIO CANCELACION
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->CancelarReservacionesProcesadasIndividualmente($conectarsistema, $IdReservacion, $ComentarioCancelacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
        // ENVIO A BASE DE DATOS -> FREGISTRO DE SEGUIMIENTOS RESERVACIONES FINALIZADAS
        case "envio-datos-registro-seguimiento-reservaciones-finalizadas":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $IdReservacion = (empty($_POST['txtIdReservacionSeguimiento'])) ? NULL : $_POST['txtIdReservacionSeguimiento']; // ID RESERVACION
                $IdFacultad = (empty($_POST['txtIdFacultadSeguimiento'])) ? NULL : $_POST['txtIdFacultadSeguimiento']; // ID FACULTAD
                $IdEscuela = (empty($_POST['txtIdEscuelaSeguimiento'])) ? NULL : $_POST['txtIdEscuelaSeguimiento']; // ID ESCUELA
                $IdLaboratorio = (empty($_POST['txtIdLaboratorioSeguimiento'])) ? NULL : $_POST['txtIdLaboratorioSeguimiento']; // ID LABORATORIO
                $IdAplicacion = (empty($_POST['txtIdAplicacionSeguimiento'])) ? NULL : $_POST['txtIdAplicacionSeguimiento']; // ID APLICACION
                $IdTipoReservacion = (empty($_POST['txtIdTipoReservacionSeguimiento'])) ? NULL : $_POST['txtIdTipoReservacionSeguimiento']; // ID TIPO RESERVACION
                $CodigoUnicoIdentificadorReservacion = (empty($_POST['txtCodigoIdentificadorUnicoSeguimiento'])) ? NULL : $_POST['txtCodigoIdentificadorUnicoSeguimiento']; // IDENTIFICADOR UNICO RESERVACION
                $DivisionGrupos = (empty($_POST['sltdivision_grupos'])) ? "no" : $_POST['sltdivision_grupos']; // COMPROBACION DIVISION DE GRUPOS
                $CantidadGrupos = (empty($_POST['txtcantidadgrupos_reservacion'])) ? 0 : $_POST['txtcantidadgrupos_reservacion']; // CANTIDAD DIVISION DE GRUPOS
                $CantidadUsuariosAsistencia = (empty($_POST['txtcantidadusuarios_reservacion'])) ? NULL : $_POST['txtcantidadusuarios_reservacion']; // CANTIDAD USUARIOS ASISTENCIA
                $CicloActual = "02-2023"; // CICLO ACTUAL
                // EVITAR INSERCION NULA O VACIA
                if(empty($DivisionGrupos)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->RegistrarSeguimientosReservacionesLaboratorios($conectarsistema, $IdReservacion, $IdFacultad, $IdEscuela, $IdLaboratorio, $IdAplicacion, $IdTipoReservacion, $CodigoUnicoIdentificadorReservacion,
                    $DivisionGrupos, $CantidadGrupos, $CantidadUsuariosAsistencia, $CicloActual, $IdUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3)
            break;
        /**********************************************************
         * -> PRIMERA FASE: ADMINISTRADORES DE LABORATORIOS
         * -> SEGUNDA FASE: COORDINADOR DE LABORATORIOS
         **********************************************************/
        // ENVIO A BASE DE DATOS -> ACTUALIZACION INICIAL ESTADOS RESERVACIONES PROCESADAS [PRIMERA FASE]
        case "envio-datos-actualizacion-inicial-reservaciones-laboratorios":
             // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $CodigoUnicoIdentificadorReservacion = (empty($_POST['txtCodigoIdentificadorUnico'])) ? NULL : $_POST['txtCodigoIdentificadorUnico']; // CODIGO UNICO GRUPOS X DE RESERVACIONES
                $EstadoReservacion = (empty($_POST['sltestadoinicial_reservaciones'])) ? NULL : $_POST['sltestadoinicial_reservaciones']; // ESTADO INICIAL RESERVACION
                $ComentarioAdministradorLaboratorioReservacion = (empty($_POST['txtcomentarioinicial_reservaciones'])) ? NULL : $_POST['txtcomentarioinicial_reservaciones']; // COMENTARIO RETROALIMANTACION INICIAL RESERVACION
                $UsuarioGestionReservacion = $_SESSION["usuario_unico"]; // CODIGO UNICO DE USUARIO REGISTRADO
                $NombreOtroTitularReservacion = (empty($_POST['txtnombreotrotitular_reservaciones'])) ? NULL : $_POST['txtnombreotrotitular_reservaciones']; // NOMBRE OTRO TITULAR
                // OBTENER ESTADO DE ACTUALIZACION
                $EstadoActualizacion = $EstadoReservacion;
                if($EstadoActualizacion == "aprobacioninicial"){
                    $EstadoActualizacion = "APROBACION INICIAL";
                }else if($EstadoActualizacion == "denegada"){
                    $EstadoActualizacion = "DENEGADA";
                }if($EstadoActualizacion == "cancelado"){
                    $EstadoActualizacion = "CANCELADA";
                }
                /********************************************
                 * -> ENVIO DE SMS AUTOMATICO
                *********************************************/
                /*$NumeroTelefonoUsuariosReservaciones = $Gestiones->ConsultarTelefonoEnvioSmsAutomatico($conectarsistema1, $CodigoUnicoIdentificadorReservacion);
                $NumeroTelefonoUsuariosReservaciones = mysqli_fetch_array($NumeroTelefonoUsuariosReservaciones);
                $ObtenerNumeroTelefono = $NumeroTelefonoUsuariosReservaciones[2];
                // Número de destino y mensaje
                $toNumber = '+503'.$ObtenerNumeroTelefono; // NUMERO DE USUARIO DESTINO
                $message = '¡Hola! En base a tu reservación con código único '.$CodigoUnicoIdentificadorReservacion.' se ha actualizado, el estado actual de su 
                solicitud es : '.$EstadoActualizacion.' - Control Laboratorios FICA';
                // Parámetros para enviar el SMS
                $data = array(
                    'To' => $toNumber,
                    'From' => $fromNumber,
                    'Body' => $message
                );
                // Codificar los datos en formato URL
                $postFields = http_build_query($data);
                // Inicializar la solicitud HTTP
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                curl_setopt($ch, CURLOPT_USERPWD, $accountSid . ':' . $authToken);
                // Realizar la solicitud HTTP
                $response = curl_exec($ch);
                // Verificar la respuesta
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                /*if ($httpCode === 201) {
                    echo 'SMS enviado correctamente.';
                } else {
                    echo 'Hubo un error al enviar el SMS. Código HTTP: ' . $httpCode;
                }*/
                // Cerrar la solicitud HTTP
                //curl_close($ch);
                // EVITAR INSERCION NULA O VACIA
                if(empty($EstadoReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ActualizacionInicialReservacionesLaboratorios($conectarsistema, $CodigoUnicoIdentificadorReservacion, $EstadoReservacion, 
                    $ComentarioAdministradorLaboratorioReservacion, $UsuarioGestionReservacion, $NombreOtroTitularReservacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                    /***********************************/
                    // ENVIO DE CORREO NOTIFICACION
                    /***********************************/
                    $CorreoUsuariosReservaciones = $Gestiones->ConsultarCorreosReservacionesEnvioCorreoAutomatico($conectarsistema1, $CodigoUnicoIdentificadorReservacion);
                    $CorreoUsuariosReservaciones = mysqli_fetch_array($CorreoUsuariosReservaciones);
                    $ObtenerCorreo = $CorreoUsuariosReservaciones[4];
                    $Destinatario = $ObtenerCorreo; // CORREO ELECTRONICO REGISTRADO DE USUARIOS
                    $Nombre = "FICA - Notificación Reservaciones"; // NOMBRE POR DEFECTO EMPRESA
                    $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                    $Asunto = "Actualización Solicitud Reservación ".$CodigoUnicoIdentificadorReservacion." - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                    /** CORREO DE CONFIRMACION CAMBIO EXITOSO DE CONTRASEÑA **/
                    $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                    // Crear una instancia y pasar true para permitir las excepciones
                    $mail = new PHPMailer(true);
                    try{
                        $mail->isSMTP();
                        $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port       = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth   = true;
                        $mail->Username = 'proyectosedmr@gmail.com';
                        $mail->Password = 'nodhtetwzespsuwy';
                        //$mail->SetFrom('proyectosedmr@gmail.com', $Nombre);
                        // DESTINATARIOS Y REMITENTES
                        $mail->setFrom($Remitente, $Nombre);
                        $mail->addAddress($Destinatario);
                        /**
                         * -> DEPURACION 
                         *      -> COMPROBACION DE ERRORES
                         *  */
                        //$mail->SMTPDebug  = 3;
                        //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
                        $mail->IsHTML(true);
                        $mail->Subject = $Asunto;
                        $mail->Body    = '<!DOCTYPE html>
                        <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                            <style>
                            body{
                            width: 650px;
                            font-family: work-Sans, sans-serif;
                            background-color: #f6f7fb;
                            display: block;
                            }
                            a{
                            text-decoration: none;
                            }
                            span {
                            font-size: 14px;
                            }
                            p {
                                font-size: 13px;
                                line-height: 1.7;
                                letter-spacing: 0.7px;
                                margin-top: 0;
                            }
                            .text-center{
                            text-align: center
                            }
                            h6 {
                            font-size: 16px;
                            margin: 0 0 18px 0;
                            }
                            </style>
                        </head>
                        <body style="margin: 30px auto;">
                            <table style="width: 100%">
                            <tbody>
                                <tr>
                                <td>
                                    <table style="background-color: #f6f7fb; width: 100%">
                                    <tbody>
                                        <tr>
                                        <td>
                                            <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                            <tbody>
                                                <tr>
                                                <td><a href="#"><img class="img-fluid" width="350" src="https://cashmanha.helioho.st/utec_logo.jpg" alt=""></a></td>
                                                <td style="text-align: right; color:#999"><span>Dpto Recuperaci&oacute;n Cuentas - Control Laboratorios FICA</span></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                    <tbody>
                                        <tr>
                                        <td style="padding: 30px"> 
                                            <h6 style="font-weight: 600">Estimado(a) Usuario:</h6>
                                            <img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/booking.png"><br>
                                            <p>Estimado(a) usuario, la solicitud de su reservaci&oacute;n con c&oacute;digo &uacute;nico identificador
                                            <strong>'.$CodigoUnicoIdentificadorReservacion.'</strong> ha sido revisada por el administrador de laboratorios asignado
                                            en el cu&aacute;l usted registro su solicitud. El estado marcado es: <strong>'.$EstadoActualizacion.'</strong>
                                            Para mayor informaci&oacute;n, por favor revise su portal.
                                            </p>
                                            <p style="margin-bottom: 0">
                                            Atte:,<br>Control Laboratorios FICA</p>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                    <tbody>       
                                        <tr style="text-align: center">
                                        <td> 
                                            <p style="color: #ff7675; margin-bottom: 0">ESTE CORREO HA SIDO GENERADO AUTOMATICAMENTE, AGRADECEMOS NO RESPONDER AL MISMO</p>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </body>
                        </html>
                        ';
                        // SOLO ENVIAR CORREO SI LA INSERCION SE REALIZA EXITOSAMENTE
                        if($consulta=="OK"){
                            $mail->send();
                        }
                    }catch (Exception $e){/*NO HACER NADA SI FALLA*/}
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
        // ENVIO A BASE DE DATOS -> ACTUALIZACION FINAL ESTADOS RESERVACIONES PROCESADAS [SEGUNDA FASE]
        case "envio-datos-actualizacion-final-reservaciones-laboratorios":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $CodigoUnicoIdentificadorReservacion = (empty($_POST['txtCodigoIdentificadorUnico'])) ? NULL : $_POST['txtCodigoIdentificadorUnico']; // CODIGO UNICO GRUPOS X DE RESERVACIONES
                $EstadoReservacion = (empty($_POST['sltestadofinal_reservaciones'])) ? NULL : $_POST['sltestadofinal_reservaciones']; // ESTADO INICIAL RESERVACION
                $ComentarioCoordinadorLaboratorioReservacion = (empty($_POST['txtcomentariofinal_reservaciones'])) ? NULL : $_POST['txtcomentariofinal_reservaciones']; // COMENTARIO RETROALIMANTACION FINAL RESERVACION
                $NombreOtroTitularReservacion = (empty($_POST['txtnombreotrotitular_reservaciones'])) ? NULL : $_POST['txtnombreotrotitular_reservaciones']; // NOMBRE OTRO TITULAR
                // OBTENER ESTADO DE ACTUALIZACION
                $EstadoActualizacion = $EstadoReservacion;
                if($EstadoActualizacion == "aprobado"){
                    $EstadoActualizacion = "APROBADO";
                }else if($EstadoActualizacion == "denegada"){
                    $EstadoActualizacion = "DENEGADA";
                }if($EstadoActualizacion == "cancelado"){
                    $EstadoActualizacion = "CANCELADA";
                }
                // EVITAR INSERCION NULA O VACIA
                if(empty($EstadoReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->ActualizacionFinalReservacionesLaboratorios($conectarsistema, $CodigoUnicoIdentificadorReservacion, $EstadoReservacion, 
                    $ComentarioCoordinadorLaboratorioReservacion, $NombreOtroTitularReservacion);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                    /***********************************/
                    // ENVIO DE CORREO NOTIFICACION
                    /***********************************/
                    $CorreoUsuariosReservaciones = $Gestiones->ConsultarCorreosReservacionesEnvioCorreoAutomatico($conectarsistema1, $CodigoUnicoIdentificadorReservacion);
                    $CorreoUsuariosReservaciones = mysqli_fetch_array($CorreoUsuariosReservaciones);
                    $ObtenerCorreo = $CorreoUsuariosReservaciones[4];
                    $Destinatario = $ObtenerCorreo; // CORREO ELECTRONICO REGISTRADO DE USUARIOS
                    $Nombre = "FICA - Notificación Reservaciones"; // NOMBRE POR DEFECTO EMPRESA
                    $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                    $Asunto = "Actualización Solicitud Reservación ".$CodigoUnicoIdentificadorReservacion." - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                    /** CORREO DE CONFIRMACION CAMBIO EXITOSO DE CONTRASEÑA **/
                    $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                    // Crear una instancia y pasar true para permitir las excepciones
                    $mail = new PHPMailer(true);
                    try{
                        $mail->isSMTP();
                        $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port       = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth   = true;
                        $mail->Username = 'proyectosedmr@gmail.com';
                        $mail->Password = 'nodhtetwzespsuwy';
                        //$mail->SetFrom('proyectosedmr@gmail.com', $Nombre);
                        // DESTINATARIOS Y REMITENTES
                        $mail->setFrom($Remitente, $Nombre);
                        $mail->addAddress($Destinatario);
                        /**
                         * -> DEPURACION 
                         *      -> COMPROBACION DE ERRORES
                         *  */
                        //$mail->SMTPDebug  = 3;
                        //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
                        $mail->IsHTML(true);
                        $mail->Subject = $Asunto;
                        $mail->Body    = '<!DOCTYPE html>
                        <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                            <style>
                            body{
                            width: 650px;
                            font-family: work-Sans, sans-serif;
                            background-color: #f6f7fb;
                            display: block;
                            }
                            a{
                            text-decoration: none;
                            }
                            span {
                            font-size: 14px;
                            }
                            p {
                                font-size: 13px;
                                line-height: 1.7;
                                letter-spacing: 0.7px;
                                margin-top: 0;
                            }
                            .text-center{
                            text-align: center
                            }
                            h6 {
                            font-size: 16px;
                            margin: 0 0 18px 0;
                            }
                            </style>
                        </head>
                        <body style="margin: 30px auto;">
                            <table style="width: 100%">
                            <tbody>
                                <tr>
                                <td>
                                    <table style="background-color: #f6f7fb; width: 100%">
                                    <tbody>
                                        <tr>
                                        <td>
                                            <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                            <tbody>
                                                <tr>
                                                <td><a href="#"><img class="img-fluid" width="350" src="https://cashmanha.helioho.st/utec_logo.jpg" alt=""></a></td>
                                                <td style="text-align: right; color:#999"><span>Dpto Recuperaci&oacute;n Cuentas - Control Laboratorios FICA</span></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                    <tbody>
                                        <tr>
                                        <td style="padding: 30px"> 
                                            <h6 style="font-weight: 600">Estimado(a) Usuario:</h6>
                                            <img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/booking.png"><br>
                                            <p>Estimado(a) usuario, la solicitud de su reservaci&oacute;n con c&oacute;digo &uacute;nico identificador
                                            <strong>'.$CodigoUnicoIdentificadorReservacion.'</strong> ha sido revisada por el coordinador de laboratorios. 
                                            El estado final marcado es: <strong>'.$EstadoActualizacion.'</strong>
                                            Para mayor informaci&oacute;n, por favor revise su portal.
                                            </p>
                                            <p style="margin-bottom: 0">
                                            Atte:,<br>Control Laboratorios FICA</p>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                    <tbody>       
                                        <tr style="text-align: center">
                                        <td> 
                                            <p style="color: #ff7675; margin-bottom: 0">ESTE CORREO HA SIDO GENERADO AUTOMATICAMENTE, AGRADECEMOS NO RESPONDER AL MISMO</p>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </body>
                        </html>
                        ';
                        // SOLO ENVIAR CORREO SI LA INSERCION SE REALIZA EXITOSAMENTE
                        if($consulta=="OK"){
                            $mail->send();
                        }
                    }catch (Exception $e){/*NO HACER NADA SI FALLA*/}
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1 )
            break;
        // ENVIO A BASE DE DATOS -> FINALIZAR PRACTICAS LIBRES PROCESADAS 
        case "envio-datos-finalizar-practicas-libres":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $IdPracticaLibre = (empty($_GET['idpracticalibre'])) ? NULL : $_GET['idpracticalibre']; // ID DE PRACTICA LIBRE
                // EVITAR INSERCION NULA O VACIA
                if(empty($IdPracticaLibre)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    $consulta = $Gestiones->FinalizarPracticasLibresProcesadas($conectarsistema, $IdPracticaLibre);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
        // GENERAR REPORTE DE PRACTICAS LIBRES TODOS LOS LABORATORIOS
        case "generar-reporte-practicas-libres-rango-fechas":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/generar-reporte-practicas-libres-rango-fechas.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // GENERAR REPORTE DE RESERVACIONES PROCESADAS POR CODIGO DE RESERVACION
        case "generar-reporte-reservaciones-por-codigo":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/generar-reporte-reservaciones-por-codigo.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // GENERAR REPORTE DE RESERVACIONES PROCESADAS POR ESTADO DE RESERVACION
        case "generar-reporte-reservaciones-por-estado":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/generar-reporte-reservaciones-por-estado.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // GENERAR REPORTE DE RESERVACIONES PROCESADAS POR ESTADO Y LABORATORIOS DE RESERVACION
        case "reporte-reservaciones-por-estados-laboratorios":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/generar-reporte-reservaciones-por-estado-y-laboratorios.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // GENERAR REPORTE DE RESERVACIONES PROCESADAS POR ESTADO Y LABORATORIOS DE RESERVACION
        case "reporte-reservaciones-por-estados-laboratorios-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/generar-reporte-reservaciones-por-estado-y-laboratorios-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // GENERAR REPORTE DE PRACTICAS LIBRES FILTRADO POR LABORATORIO
        case "reporte-practicas-libres-rango-fechas-laboratorios":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/generar-reporte-practicas-libres-rango-fechas-por-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // GENERAR REPORTE DE PRACTICAS LIBRES FILTRADO POR LABORATORIO
        case "reporte-practicas-libres-rango-fechas-laboratorios-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorLaboratorio/generar-reporte-practicas-libres-rango-fechas-por-laboratorio-adm-labs.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // GENERAR REPORTE DE PRACTICAS LIBRES FILTRADO POR CICLOS
        case "reportes-practicas-libres-rango-ciclos":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/generar-reporte-practicas-libres-por-ciclo.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // MOSTRAR COMPROBANTE DE PRACTICAS LIBRES [RANGO DE FECHAS TODOS LOS LABORATORIOS]
        case "comprobante-practicas-libres-rango-fechas":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $FechaInicio = (empty($_POST['txtInicioReservacionPL'])) ? NULL : $_POST['txtInicioReservacionPL']; // FECHA INICIO
                $FechaFin = (empty($_POST['txtFinReservacionPL'])) ? NULL : $_POST['txtFinReservacionPL']; // FECHA INICIO
                // EVITAR INSERCION NULA O VACIA
                if(empty($FechaInicio)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // OBTENER DETALLE COMPLETO DE RESERVACION [IMPRESION EN TABLA]
                    $consulta = $Gestiones->ReportePracticasLibresRangoFechas($conectarsistema, $FechaInicio, $FechaFin);
                }
                require("../Vista/informe-practicas-libres-rango-fechas.php");
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
         // MOSTRAR COMPROBANTE DE PRACTICAS LIBRES [RANGO DE FECHAS LABORATORIO SELECCIONADO]
        case "comprobante-practicas-libres-rango-fechas-laboratorios":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $FechaInicio = (empty($_POST['txtInicioReservacionPL'])) ? NULL : $_POST['txtInicioReservacionPL']; // FECHA INICIO
                $FechaFin = (empty($_POST['txtFinReservacionPL'])) ? NULL : $_POST['txtFinReservacionPL']; // FECHA INICIO
                $IdLaboratorio = (empty($_POST['sltidlaboratorio'])) ? NULL : $_POST['sltidlaboratorio']; // ID LABORATORIO
                // EVITAR INSERCION NULA O VACIA
                if(empty($FechaInicio)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // OBTENER DETALLE COMPLETO DE RESERVACION [IMPRESION EN TABLA]
                    $consulta = $Gestiones->ReportePracticasLibresRangoFechasLaboratorios($conectarsistema, $FechaInicio, $FechaFin, $IdLaboratorio);
                }
                require("../Vista/informe-practicas-libres-rango-fechas-por-laboratorio.php");
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
         // MOSTRAR COMPROBANTE DE PRACTICAS LIBRES [RANGO POR CICLO CULMINADO]
         case "comprobante-practicas-libres-rango-ciclo-lectivo":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2) {
                $Ciclo = (empty($_POST['sltcicloseleccion'])) ? NULL : $_POST['sltcicloseleccion']; // CICLO SELECCIONADO
                // EVITAR INSERCION NULA O VACIA
                if(empty($Ciclo)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // OBTENER DETALLE COMPLETO DE RESERVACION [IMPRESION EN TABLA]
                    $consulta = $Gestiones->ReportePracticasLibresPorCiclo($conectarsistema, $Ciclo);
                }
                require("../Vista/informe-practicas-libres-rango-fechas-por-ciclo.php");
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 2)
            break;
        // MOSTRAR COMPROBANTE DE RESERVACIONES [RANGO DE FECHAS TODOS LOS LABORATORIOS POR CODIGO]
        case "comprobante-reservaciones-procesadas-por-codigo":
            // VISTA VALIDA PARA COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $FechaInicioReservacion = (empty($_POST['txtInicioReservacion'])) ? NULL : $_POST['txtInicioReservacion']; // FECHA INICIO
                $FechaFinReservacion = (empty($_POST['txtFinReservacion'])) ? NULL : $_POST['txtFinReservacion']; // FECHA FIN
                $CodigoReservacion = (empty($_POST['txtCodigoReservacion'])) ? NULL : $_POST['txtCodigoReservacion']; // CODIGO
                // EVITAR INSERCION NULA O VACIA
                if(empty($FechaInicioReservacion)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // OBTENER DETALLE COMPLETO DE RESERVACION [IMPRESION EN TABLA]
                    $consulta = $Gestiones->ReporteReservacionesProcesadasPorCodigo($conectarsistema, $FechaInicioReservacion, $FechaFinReservacion, $CodigoReservacion);
                }
                require("../Vista/informe-reservaciones-procesadas-por-codigo.php");
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // MOSTRAR COMPROBANTE DE RESERVACIONES [RANGO DE FECHAS TODOS LOS LABORATORIOS POR CODIGO]
        case "comprobante-reservaciones-procesadas-por-estado":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $Ciclo = (empty($_POST['sltcicloseleccion'])) ? NULL : $_POST['sltcicloseleccion']; // CICLO
                $Estado = (empty($_POST['sltestadoseleccion'])) ? NULL : $_POST['sltestadoseleccion']; // ESTADO
                // EVITAR INSERCION NULA O VACIA
                if(empty($Ciclo)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // VERIFICAR EL TIPO DE ESTADO SELECCIONADO
                    if($Estado == 1){
                        // TODOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservaciones_EstadoTodos($conectarsistema, $Ciclo);
                    }else if($Estado == 2){
                        // APROBADOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservaciones_EstadoAprobados($conectarsistema, $Ciclo);
                    }else if($Estado == 3){
                        // CANCELADOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservaciones_EstadoCancelados($conectarsistema, $Ciclo);
                    }else if($Estado == 4){
                        // DENEGADOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservaciones_EstadoDenegados($conectarsistema, $Ciclo);
                    }
                }
                require("../Vista/informe-reservaciones-procesadas-por-estado.php");
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // MOSTRAR COMPROBANTE DE RESERVACIONES [RANGO POR CICLO FILTRADO POR LABORATORIOS]
        case "comprobante-reservaciones-procesadas-por-estado-y-laboratorios":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $Ciclo = (empty($_POST['sltcicloseleccion'])) ? NULL : $_POST['sltcicloseleccion']; // CICLO
                $Estado = (empty($_POST['sltestadoseleccion'])) ? NULL : $_POST['sltestadoseleccion']; // ESTADO
                $IdLaboratorio = (empty($_POST['sltlaboratorioseleccion'])) ? NULL : $_POST['sltlaboratorioseleccion']; // LABORATORIO
                // EVITAR INSERCION NULA O VACIA
                if(empty($Ciclo)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // VERIFICAR EL TIPO DE ESTADO SELECCIONADO
                    if($Estado == 1){
                        // TODOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservacionesLaboratorios_EstadoTodos($conectarsistema, $Ciclo, $IdLaboratorio);
                    }else if($Estado == 2){
                        // APROBADOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservacionesLaboratorios_EstadoAprobados($conectarsistema, $Ciclo, $IdLaboratorio);
                    }else if($Estado == 3){
                        // CANCELADOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservacionesLaboratorios_EstadoCancelados($conectarsistema, $Ciclo, $IdLaboratorio);
                    }else if($Estado == 4){
                        // DENEGADOS --> OBTENER DETALLE COMPLETO DE RESERVACIONES [IMPRESION EN TABLA]
                        $consulta = $Gestiones->GenerarInformeReservacionesLaboratorios_EstadoDenegados($conectarsistema, $Ciclo, $IdLaboratorio);
                    }
                }
                require("../Vista/informe-reservaciones-procesadas-por-estado-y-laboratorios.php");
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // HISTORICO POR CICLO DE RESERVACIONES PROCESADAS [PAGINA DE SELECCION]
        case "historico-reservaciones-procesadas":
             // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
             if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                require('../Vista/AdministradorGeneral/historico-reservaciones-procesadas-seleccion-oferta.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // HISTORICO POR CICLO DE RESERVACIONES PROCESADAS [PAGINA DE SELECCION]
        case "historico-reservaciones-procesadas-administrador-laboratorio":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
               $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
               require('../Vista/AdministradorLaboratorio/historico-reservaciones-procesadas-seleccion-oferta-administrador-laboratorio.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
           break;
        // HISTORICO POR CICLO DE RESERVACIONES PROCESADAS [PAGINA DE SELECCION]
        case "historico-reservaciones-procesadas-docentes":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
               $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
               // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
               $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
               // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
               $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
               // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
               $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
               require('../Vista/Docentes/historico-reservaciones-procesadas-seleccion-oferta-docente.php');
               //-> LIBERAR MEMORIA
               mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
               mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
               //-> CIERRE DE CONEXIONES
               $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
               $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
               $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
            }else {
               // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
               header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
           } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
           break;
         // HISTORICO POR CICLO DE RESERVACIONES PROCESADAS [PAGINA DE RESULTADOS]
         case "historico-reservaciones-procesadas-resultados":
            // VISTA VALIDA PARA COORDINADORES DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 1) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $Ciclo = (empty($_POST['sltcicloseleccion'])) ? NULL : $_POST['sltcicloseleccion']; // CICLO SELECCIONADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                // RESULTADOS DE HISTORICOS - RESERVACIONES PROCESADAS
                $consulta3 = $Gestiones->ReservacionesProcesadasHistorico($conectarsistema3, $Ciclo);
                require('../Vista/AdministradorGeneral/consulta-reservaciones-procesadas-historico.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // HISTORICO POR CICLO DE RESERVACIONES PROCESADAS [PAGINA DE RESULTADOS]
        case "historico-reservaciones-procesadas-resultados-administrador-laboratorios":
            // VISTA VALIDA PARA ADMINISTRADOR DE LABORATORIOS
            if ($_SESSION['id_rolusuario'] == 2) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $Ciclo = (empty($_POST['sltcicloseleccion'])) ? NULL : $_POST['sltcicloseleccion']; // CICLO SELECCIONADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                // RESULTADOS DE HISTORICOS - RESERVACIONES PROCESADAS
                $consulta3 = $Gestiones->ReservacionesProcesadasHistorico($conectarsistema3, $Ciclo);
                require('../Vista/AdministradorLaboratorio/consulta-reservaciones-procesadas-historico-administrador-laboratorio.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 2)
            break;
        // HISTORICO POR CICLO DE RESERVACIONES PROCESADAS [PAGINA DE RESULTADOS]
        case "historico-reservaciones-procesadas-resultados-docentes":
            // VISTA VALIDA PARA DOCENTES
            if ($_SESSION['id_rolusuario'] == 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $Ciclo = (empty($_POST['sltcicloseleccion'])) ? NULL : $_POST['sltcicloseleccion']; // CICLO SELECCIONADO
                // CONSULTA TODAS LAS NOTIFICACIONES RECIBIDAS [HEADER SISTEMA -> CONSULTA RECORTADA]
                $consulta = $Gestiones->ListadoNotificacionesRecibidas_Recortado($conectarsistema, $IdUsuarios);
                // CONSULTA TODOS LOS MENSAJES RECIBIDOS [HEADER SISTEMA -> CONSULTA RECORTATA]
                $consulta1 = $Gestiones->ListadoMensajesRecibidos_Recortado($conectarsistema1, $IdUsuarios);
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta2 = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema2, $IdUsuarios);
                // RESULTADOS DE HISTORICOS - RESERVACIONES PROCESADAS
                $consulta3 = $Gestiones->ReservacionesProcesadasHistoricoDocentes($conectarsistema3, $Ciclo, $IdUsuarios);
                require('../Vista/Docentes/consulta-reservaciones-procesadas-historico-docente.php');
                //-> LIBERAR MEMORIA
                mysqli_free_result($consulta3); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta1); // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA1
                mysqli_free_result($consulta);  // LIBERAR MEMORIA CONJUNTO DATOS CONSULTA PRINCIPAL
                //-> CIERRE DE CONEXIONES
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
                $conectarsistema1->close(); // CERRANDO CONEXION AUXILIAR 1
                $conectarsistema2->close(); // CERRANDO CONEXION AUXILIAR 2
                $conectarsistema3->close(); // CERRANDO CONEXION AUXILIAR 3
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 3)
            break;
        // PAGINA ERROR 404 -> CONTENIDO NO ENCONTRADO
        case "error-404":
            require('../Vista/error404.php');
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        // PAGINA ERROR 403 -> ACCESO PROHIBIDO
        case "error-403":
            require('../Vista/error403.php');
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        /*************************************************************
         * GESTION DE NUEVOS USUARIOS DADOS DE ALTA EN LA PLATAFORMA    
        **************************************************************/
        case "gestion-nuevos-usuarios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema, $IdUsuarios);
                require('../Vista/gestion-nuevos-usuarios.php');
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        case "envio-datos-cambio-credenciales-repetitivo":
             // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
             if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                $cifrado = (empty($_POST['txtnuevaclaveusuarios'])) ? NULL : $_POST['txtnuevaclaveusuarios']; // ENCRIPTAR CONTRASEÑA INGRESADA
                $options = [
                    'cost' => 12,
                    'time_cost' => 4,
                    'threads' => 1
                ];
                $Contrasenia = password_hash($cifrado, PASSWORD_ARGON2I, $options);
                $Correo = $_SESSION['correo_usuario'];
                // EVITAR ACCION NULA O VACIA
                if (empty($cifrado)) {
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                } else {
                    $Destinatario = $Correo; // CORREO ELECTRONICO REGISTRADO DE USUARIOS
                    $Nombre = "FICA - Recuperación Cuentas Usuarios"; // NOMBRE POR DEFECTO EMPRESA
                    $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                    $Asunto = "Confirmación Cambio Contraseña - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                    $consulta = $Gestiones->CambioCredencialesNuevosUsuarios($conectarsistema, $IdUsuarios, $Contrasenia);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                    /** CORREO DE CONFIRMACION CAMBIO EXITOSO DE CONTRASEÑA **/
                    $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                    // Crear una instancia y pasar true para permitir las excepciones
                    $mail = new PHPMailer(true);
                    try{
                        $mail->isSMTP();
                        $mail->CharSet = 'UTF-8'; // CODIFICACION DE CONTENIDO
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port       = 587;
                        $mail->SMTPSecure = 'tls';
                        $mail->SMTPAuth   = true;
                        $mail->Username = 'proyectosedmr@gmail.com';
                        $mail->Password = 'nodhtetwzespsuwy';
                        //$mail->SetFrom('proyectosedmr@gmail.com', $Nombre);
                        // DESTINATARIOS Y REMITENTES
                        $mail->setFrom($Remitente, $Nombre);
                        $mail->addAddress($Destinatario);
                        /**
                         * -> DEPURACION 
                         *      -> COMPROBACION DE ERRORES
                         *  */
                        //$mail->SMTPDebug  = 3;
                        //$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
                        $mail->IsHTML(true);
                        $mail->Subject = $Asunto;
                        $mail->Body    = '<!DOCTYPE html>
                        <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                            <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                            <style>
                            body{
                            width: 650px;
                            font-family: work-Sans, sans-serif;
                            background-color: #f6f7fb;
                            display: block;
                            }
                            a{
                            text-decoration: none;
                            }
                            span {
                            font-size: 14px;
                            }
                            p {
                                font-size: 13px;
                                line-height: 1.7;
                                letter-spacing: 0.7px;
                                margin-top: 0;
                            }
                            .text-center{
                            text-align: center
                            }
                            h6 {
                            font-size: 16px;
                            margin: 0 0 18px 0;
                            }
                            </style>
                        </head>
                        <body style="margin: 30px auto;">
                            <table style="width: 100%">
                            <tbody>
                                <tr>
                                <td>
                                    <table style="background-color: #f6f7fb; width: 100%">
                                    <tbody>
                                        <tr>
                                        <td>
                                            <table style="width: 650px; margin: 0 auto; margin-bottom: 30px">
                                            <tbody>
                                                <tr>
                                                <td><a href="#"><img class="img-fluid" width="350" src="https://cashmanha.helioho.st/utec_logo.jpg" alt=""></a></td>
                                                <td style="text-align: right; color:#999"><span>Dpto Recuperaci&oacute;n Cuentas - Control Laboratorios FICA</span></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                                    <tbody>
                                        <tr>
                                        <td style="padding: 30px"> 
                                            <h6 style="font-weight: 600">Estimado(a) Usuario:</h6>
                                            <img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/iconpasscarton.png">
                                            <p>Enhorabuena, su contrase&ntilde;a ha sido cambiada exitosamente. <strong>Este procedimiento tendr&aacute; que hacerlo nuevamente
                                            dentro de 30 d&iacute;as a partir de la &uacute;ltima actualizaci&oacute;n de su contrase&ntilde;a.</strong>
                                            <strong>Si tiene problemas para ingresar, comun&iacute;quese con nuestro administrador de laboratorios, o 
                                            puede escribirnos a <a href="mailto:soportelabfica@utec.edu.sv">soportelabfica@utec.edu.sv</a>
                                            </strong>
                                            </p>
                                            <p style="margin-bottom: 0">
                                            Atte:,<br>Dpto Recuperaci&oacute;n Cuentas - Control Laboratorios FICA</p>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table style="width: 650px; margin: 0 auto; margin-top: 30px">
                                    <tbody>       
                                        <tr style="text-align: center">
                                        <td> 
                                            <p style="color: #ff7675; margin-bottom: 0">ESTE CORREO HA SIDO GENERADO AUTOMATICAMENTE, AGRADECEMOS NO RESPONDER AL MISMO</p>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </body>
                        </html>
                        ';
                        // SOLO ENVIAR CORREO SI LA INSERCION SE REALIZA EXITOSAMENTE
                        if($consulta=="OK"){
                            $mail->send();
                        }
                    }catch (Exception $e){/*NO HACER NADA SI FALLA*/}
                }// CIERRE if(empty($_POST['txtnuevaclaveusuarios']))
                // RETIRAR TODAS LAS SESIONES AL MOMENTO DE PROCESAR INFORMACION
                session_unset();
                session_destroy();
                $conectarsistema->close(); // CERRANDO CONEXION
             }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // COMPLETAR PERFIL DE USUARIOS [EXCLUSIVAMENTE NUEVOS USUARIOS]
        case "completar-perfil-nuevos-usuarios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                $consulta = $Gestiones->ConsultaEspecificaControladorEstadoUsuarios($conectarsistema, $IdUsuarios);
                require('../Vista/completar-perfil-nuevos-usuarios.php');
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // ENVIO A BASE DE DATOS -> COMPLETAR PERFIL DE USUARIOS [EXCLUSIVAMENTE NUEVOS USUARIOS]
        case "envio-datos-completar-perfil-nuevos-usuarios":
            // VISTA VALIDA PARA TODOS LOS ROLES DE USUARIO
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                $TelefonoPrincipal = (empty($_POST['txttelefono_usuarios'])) ? NULL : $_POST['txttelefono_usuarios']; // TELEFONO PRINCIPAL USUARIOS
                $GeneroUsuarios = (empty($_POST['sltgenero_usuarios'])) ? NULL : $_POST['sltgenero_usuarios']; // GENERO USUARIOS
                $FechaNacimiento = (empty($_POST['txtfechanacimiento_usuarios'])) ? NULL : $_POST['txtfechanacimiento_usuarios']; // FECHA NACIMIENTO USUARIOS
                $FechaNacimiento = (empty($_POST['txtfechanacimiento_usuarios'])) ? NULL : $_POST['txtfechanacimiento_usuarios']; // FECHA NACIMIENTO USUARIOS
                $EstadoCivil = (empty($_POST['sltestadocivil_usuarios'])) ? NULL : $_POST['sltestadocivil_usuarios']; // ESTADO CIVIC USUARIOS
                /*
                    -> VALIDACION SEGUN GENERO INGRESADO
                        SI ES FEMENINO, ENTONCES HACE EL CAMBIO CORRESPONDIENTE -->  (a)
                        SI ES MASCULINO, ENTONCES HACE EL CAMBIO CORRESPONDIENTE -->  (o)
                */
                if ($GeneroUsuarios == "f") { // -> FEMENINO
                    if ($EstadoCivil == "soltero") {
                        $EstadoCivil = "soltera";
                    } else if ($EstadoCivil == "casado") {
                        $EstadoCivil = "casada";
                    } else if ($EstadoCivil == "divorciado") {
                        $EstadoCivil = "divorciada";
                    } else if ($EstadoCivil == "comprometido") {
                        $EstadoCivil = "comprometida";
                    } else if ($EstadoCivil == "viudo") {
                        $EstadoCivil = "viuda";
                    }
                }else if ($GeneroUsuarios == "m") { // -> MASCULINO
                    if ($EstadoCivil == "soltera") {
                        $EstadoCivil = "soltero";
                    } else if ($EstadoCivil == "casada") {
                        $EstadoCivil = "casado";
                    } else if ($EstadoCivil == "divorciada") {
                        $EstadoCivil = "divorciado";
                    } else if ($EstadoCivil == "comprometida") {
                        $EstadoCivil = "comprometido";
                    } else if ($EstadoCivil == "viuda") {
                        $EstadoCivil = "viudo";
                    }
                }// CIERRE if($GeneroUsuarios == "f")
                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
                // EVITAR ACCION NULA O VACIA
                if(empty($TelefonoPrincipal)){
                    // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                    header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
                }else{
                    // CONTROLADOR DE ESTADO ACTUAL DE USUARIOS
                    $consulta = $Gestiones->RegistroDetallesPerfilNuevosUsuarios($conectarsistema, $TelefonoPrincipal, $GeneroUsuarios, 
                    $FechaNacimiento, $EstadoCivil, $IdUsuarios);
                    // ENVIANDO RESPUESTA DE ACCION A MODELO
                    echo json_encode($consulta);
                }
                $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            }else {
                // SI EL USUARIO SE ENCUENTRA LOGUEADO, REDIRECCIONA A PAGINA PRINCIPAL DE PORTAL SEGUN SU ROL DE USUARIO ASIGNADO
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
            } // CIERRE if ($_SESSION['id_rolusuario'] == 1)
            break;
        // REDIRECCIONES PREDETERMINADAS -> REASIGNACION DE RESERVACIONES
        case "redirecciones-reasignacion-reservaciones":
            //-> USUARIOS ADMINISTRADOR GENERAL [COORDINADOR DE LABORATORIOS]
            if($_SESSION['id_rolusuario'] == 1){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-aprobadas');
            //-> USUARIOS ADMINISTRADORES DE LABORATORIOS
            }else if($_SESSION['id_rolusuario'] == 2){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-aprobadas-administrador-laboratorios');
            //-> SI NO EXISTE SESION ACTIVA, REDIRIGIR A INICIO DE SESION
            }else{
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            }
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        // REDIRECCIONES PREDETERMINADAS -> NUEVAS RESERVACIONES
        case "redirecciones-nuevas-reservaciones":
            //-> USUARIOS ADMINISTRADOR GENERAL [COORDINADOR DE LABORATORIOS]
            if($_SESSION['id_rolusuario'] == 1){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-mis-reservaciones-procesadas');
            //-> USUARIOS ADMINISTRADORES DE LABORATORIOS
            }else if($_SESSION['id_rolusuario'] == 2){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-mis-reservaciones-procesadas-administrador-laboratorios');
            //-> USUARIOS DOCENTES
            }else if($_SESSION['id_rolusuario'] == 3){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-mis-reservaciones-procesadas-docentes');
            //-> SI NO EXISTE SESION ACTIVA, REDIRIGIR A INICIO DE SESION
            }else{
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            }
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        // REDIRECCIONES PREDETERMINADAS -> ACTUALIZACION INICIAL RESERVACIONES PENDIENTES
        case "redirecciones-reservaciones-actualizacion-inicial":
            //-> USUARIOS ADMINISTRADOR GENERAL [COORDINADOR DE LABORATORIOS]
            if($_SESSION['id_rolusuario'] == 1){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-pendientes');
            //-> USUARIOS ADMINISTRADORES DE LABORATORIOS
            }else if($_SESSION['id_rolusuario'] == 2){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-pendientes-administrador-laboratorios');
            }else{
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            }
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        // REDIRECCIONES PREDETERMINADAS -> ACCIONES NULAS O SEGUN ROL DE USUARIO
        case "redirecciones-sistema-predeterminadas":
            //-> USUARIOS ADMINISTRADOR GENERAL [COORDINADOR DE LABORATORIOS]
            if($_SESSION['id_rolusuario'] == 1){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=inicioadministradores');
            //-> USUARIOS ADMINISTRADORES DE LABORATORIOS
            }else if($_SESSION['id_rolusuario'] == 2){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=inicioadministradorlaboratorios');
            //-> USUARIOS DOCENTES
            }else if($_SESSION['id_rolusuario'] == 3){
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=iniciodocentes');
            //-> SI NO EXISTE SESION ACTIVA, REDIRIGIR A INICIO DE SESION
            }else{
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            }
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        // CONTENIDO NO EXISTENTE, LANZAR ERROR 404
        default:
            // MOSTRAR PAGINA DE ERROR 404 [ ELEMENTO NO EXISTENTE EN PLATAFORMA ]
            if ($_SESSION['id_rolusuario'] >= 1 && $_SESSION['id_rolusuario'] <= 3) {
                header('location:GestionesLaboratorios_Controlador.php?gestioneslaboratorios=error-404');
                // REDIRECCIONAR INICIO PORTAL PRESIDENCIA [USUARIOS LOGUEADOS]
            } else {
                // SI LOS USUARIOS NO ESTAN LOGUEADOS, E INGRESAN PARAMETROS NO [O BIEN] EXISTENTES EN EL SISTEMA, SIMPLEMENTE REDIRIGIR A FORMULARIO DE INICIO DE SESION
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            } // CIERRE if ($_SESSION['id_rol'] >= 1 && $_SESSION['id_rol'] <= 3)
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
    }// CIERRE switch ($peticion_url)
?>