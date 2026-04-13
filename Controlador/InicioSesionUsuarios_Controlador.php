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
    // IMPORTANDO MODELO RECUPERACION DE CUENTAS USUARIOS
    require('../Modelo/RecuperacionCuentas_Modelo.php');
    // TIEMPO POR DEFECTO -> UTC - 6 EL SALVADOR [CONSULTAR DOCUMENTACION OFICIAL]
    date_default_timezone_set('America/El_Salvador');

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
    // CIFRADO DE CLAVES -> ARGON2
    require_once "../vendor/paragonie/sodium_compat/autoload.php";

    /***************************************************************/

    // INICIALIZANDO VARIABLE GLOBAL DE CLASE
    $Usuarios = new RecuperacionCuentas();
    // URL GLOBAL DE PROYECTO -> PARA ACCEDER A TODOS LOS ARCHIVOS NECESARIOS 
    /** [ENTORNO LOCAL] */
    $UrlGlobal = "http://" . $_SERVER['SERVER_NAME'] . ":90" . "/ControlLaboratorios" . '/';
    /** [ENTORNO PRODUCCION] */
    //$UrlGlobal = "https://" . $_SERVER['SERVER_NAME'] .'/';
    // ASIGNANDO PARAMETRO DE URL -> METODO GET (laboratorios --> por defecto [parametro de gestiones])
    if (isset($_GET['laboratorios'])) {
        $peticion_url = $_GET['laboratorios'];  // ENVIO GET DE VALOR ACCION {URL}
    }
    // ASIGNA VALOR POR DEFECTO...
    else {
        $peticion_url = "iniciarsesion";  // CASO CONTRARIO, VALOR POR DEFECTO
    }
    // CABECERA DE TITULOS - ETIQUETA <TITLE></TITLE>
    $TituloPrincipal = "Control de Laboratorios | ";
    // TODAS LAS GESTIONES RELACIONADAS - AUTENTICACION DE USUARIOS, RECUPERACIONES DE CUENTAS USUARIOS Y CIERRE DE SESIONES DE USUARIOS
    switch ($peticion_url){
        // INICIAR SESION [INDEX PRINCIPAL DE TODO EL SISTEMA]
        case "iniciarsesion":
            // CAMBIAR A "no" SI NO EXISTE PLAN DE MANTENIMIENTO PROGRAMADO
            $MantenimientoProgramado = "no";
            require("../Vista/iniciarsesion.php");
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        // AUTENTICACION DE SESIONES E INICIO DE SESIONES DE USUARIOS
        /**
         * -> REDIRECCION SEGUN ROLES DE USUARIOS, LOS CUALES SON:
         * 1. ADMINISTRADOR GENERAL
         * 2. ADMINISTRADOR DE LABORATORIOS
         * 3. DOCENTES
         **/        
        case "autenticacion-usuarios":
            $Contrasenia = ($conectarsistema->real_escape_string($_POST['txtcontrasenia'])); // COMPARAR CLAVE INGRESADA
            if (empty($Contrasenia)) {
                // NO PROCESAR ACCION VACIA -> SOLAMENTE CON DATOS INGRESADOS
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            }else{
                // VALIDACION DE INICIO DE SESION SOLICITADO
                $ConsultarCredencialesUsuarios = $conectando->CosultarCredencialEncriptada($conectarsistema, $conectarsistema->real_escape_string($_POST['txtusuario']));
                // RECORRIDO EN BUSCA DE COINCIDENCIAS EN BASE A LA PETICION SOLICITADA
                $CredencialEncriptadaUsuarios = mysqli_fetch_array($ConsultarCredencialesUsuarios);
                if($CredencialEncriptadaUsuarios){// SI ENCUENTRA RESULTADOS, ENTONCES...
                    $ClaveEncriptada = $CredencialEncriptadaUsuarios[3]; // CREDENCIAL DE ACCESO
                    $EstadoUsuarios = $CredencialEncriptadaUsuarios[4]; // ESTADO DE USUARIO
                    $CodigoUnicoUsuarios = $CredencialEncriptadaUsuarios[1]; // CODIGO UNICO DE USUARIOS
                    //-> GUARDAR CODIGO UNICO EN UNA VARIABLE DE SESION
                    $_SESSION['usuario_unico'] = $CodigoUnicoUsuarios;
                    // VALIDACION DE INICIO DE SESION SOLICITADO
                    $usuario = $conectando->IniciarSesionUsuarios($conectarsistema1, $conectarsistema1->real_escape_string($_POST['txtusuario']), $ClaveEncriptada);
                    // RECORRIDO EN BUSCA DE COINCIDENCIAS EN BASE A LA PETICION SOLICITADA
                    $IniciarSesionUsuarios = mysqli_fetch_array($usuario);
                    // SI EXISTEN REGISTROS, ENTONCES CLASIFICA SEGUN ROL ASIGNADO
                    if ($IniciarSesionUsuarios){
                        $hash = $IniciarSesionUsuarios[7]; // OBTENER CLAVE ENCRIPTADA EN CONSULTA SP
                        // VERIFICAR QUE HASH Y CLAVE INGRESADA SEAN COINCIDENTES
                        if (password_verify($Contrasenia, $hash)){
                            /**********************************************
                            * -> VALIDACION DE ESTADO DE USUARIOS
                            ***********************************************/
                            if($EstadoUsuarios == "bloqueado"){
                                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=usuarios-bloqueados');
                            // USUARIOS INACTIVOS
                            }else if($EstadoUsuarios == "inactivo"){
                                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=usuarios-inactivos');
                            // USUARIOS ACTIVOS
                            }else if($EstadoUsuarios == "activo"){
                                // VALIDACION -> RECORDAR MI USUARIO
                                if (isset($_POST['chk_recordarusuario'])) {
                                    // SI CHECKBOX SE MANTIENE EN ESTADO 1 "UNO", ENTONCES GUARDA COOKIE POR 30 DIAS
                                    // time()+60*60*24*30 -> ES EQUIVALENTE A 30 DIAS
                                    // " / " -> EXPLICITAMENTE NUESTRA COOKIE ESTARA DISPONIBLE EN TODO EL SISTEMA
                                    setcookie("txtusuario", $_POST['txtusuario'], time() + 60 * 60 * 24 * 30, "/");
                                }
                                // GUARDADO DE DATOS DE USUARIOS -> SESIONES 
                                $_SESSION['id_usuario'] = $IniciarSesionUsuarios['idusuarios']; // ID UNICO DE USUARIO
                                $_SESSION['id_rolusuario'] = $IniciarSesionUsuarios['idrolusuario']; // ID UNICO DE USUARIO
                                $_SESSION['nombres_usuario'] = $IniciarSesionUsuarios['nombres']; // NOMBRES DE USUARIO
                                $_SESSION['apellidos_usuario'] = $IniciarSesionUsuarios['apellidos']; // APELLIDOS DE USUARIO
                                $_SESSION['correo_usuario'] = $IniciarSesionUsuarios['correo']; // CORREO DE USUARIO
                                $_SESSION['foto_usuario'] = $IniciarSesionUsuarios['fotoperfil']; // FOTO PERFIL DE USUARIO
                                $_SESSION['comprobacion_nuevousuario'] = $IniciarSesionUsuarios['nuevousuario']; // COMPROBACION NUEVO USUARIO
                                $_SESSION['comprobacion_completarperfil'] = $IniciarSesionUsuarios['completarperfil']; // COMPROBACION COMPLETAR PERFIL
                                //-> CONTROL DE LABORATORIOS ASIGNADOS
                                $_SESSION['laboratorio1'] = $IniciarSesionUsuarios['lab1']; // LABORATORIO 1
                                $_SESSION['laboratorio2'] = $IniciarSesionUsuarios['lab2']; // LABORATORIO 2
                                $_SESSION['laboratorio3'] = $IniciarSesionUsuarios['lab3']; // LABORATORIO 3
                                $_SESSION['laboratorio4'] = $IniciarSesionUsuarios['lab4']; // LABORATORIO 4
                                $_SESSION['laboratorio5'] = $IniciarSesionUsuarios['lab5']; // LABORATORIO 5
                                $_SESSION['laboratorio6'] = $IniciarSesionUsuarios['lab6']; // LABORATORIO 6
                                $_SESSION['laboratorio7'] = $IniciarSesionUsuarios['lab7']; // LABORATORIO 7
                                $_SESSION['laboratorio8'] = $IniciarSesionUsuarios['lab8']; // LABORATORIO 8
                                $_SESSION['laboratorio9'] = $IniciarSesionUsuarios['lab9']; // LABORATORIO 9
                                $_SESSION['laboratorio10'] = $IniciarSesionUsuarios['lab10']; // LABORATORIO 10
                                $_SESSION['laboratorio11'] = $IniciarSesionUsuarios['lab11']; // LABORATORIO 11
                                $_SESSION['laboratorio12'] = $IniciarSesionUsuarios['lab12']; // LABORATORIO 12
                                $_SESSION['laboratorio13'] = $IniciarSesionUsuarios['lab13']; // LABORATORIO 13
                                $_SESSION['laboratorio14'] = $IniciarSesionUsuarios['lab14']; // LABORATORIO 14
                                $_SESSION['laboratorio15'] = $IniciarSesionUsuarios['lab15']; // LABORATORIO 15
                                 //-> VARIABLES DE INGRESO DE SESIONES - TODOS LOS ACCESSOS
                                $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIOS
                                $FechaIngreso = date("Y-m-d H:i:s"); // FECHA Y HORA COMPLETA
                                // REGISTRO DE TODOS LOS ACCESOS DE USUARIOS -> DATOS DE INICIO DE SESIONES
                                $consulta = $Usuarios->RegistrarAccesosUsuarios($conectarsistema2, $FechaIngreso, $IdUsuarios);
                                //-> COMPROBAR SI ES UN NUEVO USUARIO
                                if($_SESSION['comprobacion_nuevousuario'] == "si"){
                                    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-nuevos-usuarios');
                                }else{
                                    /*********************************************************************************************
                                        -> ROLES DE USUARIOS VALIDADOS -> ID -> VALOR ENTERO REFERENCIA A TABLA ROLES
                                    -- SE PUEDEN INCLUIR MAS ROLES DE USUARIOS SEGUN NECESIDADES SIN NINGUN INCONVENIENTE --
                                    **********************************************************************************************/
                                    /*******************************************
                                     * -> USUARIOS ADMINISTRADORES [GENERAL]
                                     *******************************************/
                                    if ($IniciarSesionUsuarios['idrolusuario'] == 1) {
                                        header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=inicioadministradores');
                                    /*********************************************
                                     * -> USUARIOS ADMINISTRADORES DE LABORATORIO
                                     ********************************************/
                                    } else if ($IniciarSesionUsuarios['idrolusuario'] == 2) {
                                        header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=inicioadministradorlaboratorios');
                                    /************************************************
                                     * -> USUARIOS DOCENTES
                                     ***********************************************/
                                    } else if ($IniciarSesionUsuarios['idrolusuario'] == 3) {
                                        header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=iniciodocentes');
                                    }
                                }// CIERRE if($_SESSION['comprobacion_nuevousuario'] == "si")
                            }
                        // SI COMPROBACION DE USUARIO / CONTRASEÑA NO EXISTE, ENTONCES REDIRIGE A PAGINA DE ERROR
                        }else{
                            header('location:InicioSesionUsuarios_Controlador.php?laboratorios=credenciales-incorrectas');
                        }
                    // SI NO ENCUENTRA RESULTADOS DE CREDENCIALES DE USUARIOS, REDIRIGIR A INICIO DE SESION
                    }else{
                        header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
                    }
                // SI CONSULTA DE COMPROBACION INICIAL DE CREDENCIALES DE USUARIOS FALLA, REDIRIGIR A INICIO DE SESION
                }else{
                    header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
                }          
            }// CIERRE if (empty($Contrasenia))
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION
            //-> CIERRE DE CONEXIONES AUXILIARES
            $conectarsistema1->close(); //-> CERRANDO CONEXION AUXILIAR 1
            $conectarsistema2->close(); //-> CERRANDO CONEXION AUXILIAR 2
            break;
        // RECUPERAR CONTRASEÑA -> SECCION ¿OLVIDE MI CONTRASEÑA? [INICIO DE SESION]
        case "olvide-contrasenia-recuperacion":
            require('../Vista/ingreso-correo-recuperacion-cuentas-usuarios.php');
            //-> CIERRE DE CONEXIONES
            $conectarsistema->close(); // CERRANDO CONEXION PRINCIPAL
            break;
        // RECUPERACION DE CUENTAS DE USUARIOS QUE SOLICITAN DICHA PETICION
        case "recuperar-cuentas":
            $Destinatario = $_POST['txtcorreoconsulta_recuperaciones']; // CORREO ELECTRONICO REGISTRADO DE USUARIOS
            // EVITAR ACCION NULA O VACIA
            if(empty($Destinatario)){
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            }else{
                $CodigoRecuperacion = rand(10000, 99999); // CODIGO AUTOMATICO DE RECUPERACION [5 DIGITOS]
                $Nombre = "FICA - Recuperación Cuentas Usuarios"; // NOMBRE POR DEFECTO EMPRESA
                $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                $Asunto = "Reestablecer contraseña - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                $Bytes = random_bytes(5); // GENERAR CODIGO DE 5 DIGITOS - LETRAS
                $Token = bin2hex($Bytes); // ENVIAR TOKEN A INSERCCION
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
                                        <img style="width: 200px; margin: 0 auto; display: block;" src="https://cashmanha.helioho.st/repair-tools.gif">
                                        <p>El proceso inicial de recuperaci&oacute;n de su cuenta se ha completado con &eacute;xito. Antes de continuar con el proceso, usted debe conocer algunas
                                        condiciones que usted debe seguir a cabalidad para concluir exitosamente todo el proceso.
                                        </p>
                                        <p>
                                        <ul>
                                            <li>
                                            <p>Este proceso debe ser finalizado en el mismo dispositivo en el cu&aacute;l usted v&aacute;lido la existencia de su usuario. 
                                                <strong>Caso contrario, por seguridad no podr&aacute; continuar y deber&aacute; iniciarlo nuevamente.</strong></p>
                                            </li>
                                            <li>
                                            <p>El c&oacute;digo mostrado en este correo, solamente cuenta con una vigencia de 15 minutos para poder ser validado en nuestro sistema.</p>
                                            </li>
                                            <li>
                                            <p>Si usted intenta acceder desde otro dispositivo diferente al que usted inicialmente solicito el proceso. Su token de acceso vencer&aacute; e igualmente
                                                tendr&aacute; que solicitar nuevamente el proceso.
                                            </p>
                                            </li>
                                        </ul>
                                        </p>
                                        <p><strong>Por favor, ingrese el siguiente c&oacute;digo mostrado en pantalla y luego haga clic en el bot&oacute;n mostrado abajo para continuar con el  proceso de cambio de contrase&ntilde;a</strong></p>
                                        <span style="width: 35%; border-radius: 4px; margin: 0 auto; margin-bottom: 1rem; padding: 1rem; font-size: 18px; color: #fff; background-color: #2d3436; line-height: 180%; border: 5px dashed #fdcb6e; letter-spacing: 1rem; display: block; text-align: center;">'.$CodigoRecuperacion.'</span>
                                        <p style="text-align: center"><a href="http://localhost:90/ControlLaboratorios/Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=ingreso-codigo-seguridad-recuperacion-cuentas&token='.$Token.'"style="padding: 10px; background-color: #e84393; color: #fff; display: inline-block; border-radius: 4px;font-weight:600;">CAMBIAR CONTRASE&Ntilde;A</a></p>
                                        <p></p>
                                        <p style="margin-top: 1rem;"><strong>AVISO DE CONFIDENCIALIDAD:</strong> Este mensaje así como todo el contenido que incluye este correo, es propiedad exclusivamente del destinatario final. Por lo cual queda terminantemente prohibido la reproducción total y parcial de el contenido de este correo. De igual manera por favor evite compartir este correo con otros usuarios. Si usted no ha solicitado reestablecer su contraseña por favor haga caso omiso de este correo. Le garantizamos que sus datos están debidamente resguardados mientras usted no incumpla con lo anterior. Dudas, Problemas Por favor comuníquese a: <a href="mailto:soportefica@utec.edu.sv">soportefica@utec.edu.sv</a></p>
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
                    //$mail->send();
                    // VALIDACION DE ENVIO CORREOS
                    if(!$mail->send()) {
                        // CORREO NO ENVIADO
                        header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=error-correo-recuperacion-cuentas');
                    } else {
                        // CORREO ENVIADO
                        header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=confirmacion-correo-recuperacion-cuentas');
                    }
                    // EVITAR INSERCCION DE DATOS VACIOS
                    if (empty($Destinatario)) {
                        header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
                    } else {
                        // VARIABLES GENERALES DE SESION -> GUARDADO DE DATOS CONFIDENCIALES DE CUENTA A RECUPERAR
                        $_SESSION['TokenUsuarios'] = $Token; // TOKEN DE ACCESO PARA CAMBIAR CONTRASEÑA
                        $_SESSION['CorreoUsuarios'] = $Destinatario; // CORREO REGISTRADO CUENTA A RECUPERAR
                        $_SESSION['CodigoUsuarios'] = $CodigoRecuperacion; // CODIGO DE RECUPERACION AUTOMATICO
                        /*  COMPROBACION SI EL CODIGO DE SEGURIDAD ENVIADO AL CORREO HA SIDO INGRESADO,
                            SI EL USUARIO INTENTA DIGITAR LA URL CON SU TOKEN DE ACCESO VALIDO, SU ACCESO
                            SERA DENEGADO HASTA QUE CUMPLA CON EL REQUISITO DE COMPROBAR SU CODIGO
                        */
                        $_SESSION['EstadoCodigos'] = "BloquearCodigoAcceso";
                        // INSERCCION DATOS TABLA RECUPERACION
                        $consulta = $Usuarios->RecuperarCuentasUsuarios($conectarsistema, $Destinatario, $Token, $CodigoRecuperacion);
                    }
                } catch (Exception $e){
                    //-> EFECTOS DE DEPURACION ERRORES
                    //echo 'Ha ocurrido un error al enviar el correo electrónico: ' . $mail->ErrorInfo;
                    header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=error-correo-recuperacion-cuentas');
                }
            }
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // PAGINA CONFIRMACION CORREO ENVIADO EXITOSAMENTE -> RECUPERACION CUENTAS
        case "confirmacion-correo-recuperacion-cuentas":
            require('../Vista/confirmacion-envio-correo-recuperacion-cuentas.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // PAGINA ERROR CORREO NO ENVIADO -> RECUPERACION CUENTAS
        case "error-correo-recuperacion-cuentas":
            require('../Vista/error-envio-correo-recuperacion-cuentas.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // INGRESO DE CODIGO DE SEGURIDAD -> VALIDACION DE CODIGOS (RECUPERACION CUENTAS)
        case "ingreso-codigo-seguridad-recuperacion-cuentas":
            require('../Vista/ingreso-codigos-seguridad-recuperacion-cuentas.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // CAMBIO DE TOKEN DE ACCESO AUTOMATICAMENTE -> POSTERIOR COMPROBACION CODIGO DE SEGURIDAD
        case "cambio-estado-token":
            /*
                HABILITANDO ACCESO A PAGINA DE CAMBIO DE CONTRASEÑA NUEVA, USUARIO HA COMPROBADO
                EXITOSAMENTE QUE SU CODIGO ES VALIDO PARA PROCEDER A SU PETICION
            */
            $_SESSION['EstadoCodigos'] = "ValidarCodigoAcceso";
            $Correo = $_SESSION['CorreoUsuarios'];
            $TokenSeguridad = $_SESSION['TokenUsuarios'];
            $CodigoSeguridad = $_SESSION['CodigoUsuarios'];
            $Estado = "Usado";
            // EVITAR ACCION NULA O VACIA
            if (empty($Correo)) {
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            } else {
                $consulta = $Usuarios->CambioEstadoCodigoSeguridad($conectarsistema, $Correo, $TokenSeguridad, $CodigoSeguridad, $Estado);
            }
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // PAGINA CAMBIO DE CONTRASEÑA USUARIOS -> POSTERIOR ENVIO DE CORREO DE NOTIFICACION
        case "cambio-contrasenia-usuarios":
            require('../Vista/recuperar-cuentas-usuarios-cambio-credenciales.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // CAMBIO DE NUEVA CONTRASEÑA -> USUARIOS QUE ACCEDEN DESDE SU CORREO DE CONFIRMACION DE USUARIO
        case "cambiar-contrasenia-recuperacion":
            $cifrado = (empty($_POST['txtnuevaclaveusuarios'])) ? NULL : $_POST['txtnuevaclaveusuarios']; // ENCRIPTAR CONTRASEÑA INGRESADA
                $options = [
                    'cost' => 12,
                    'time_cost' => 4,
                    'threads' => 1
                ];
            $Contrasenia = password_hash($cifrado, PASSWORD_ARGON2I, $options);
            $Correo = $_SESSION['CorreoUsuarios'];
            // EVITAR ACCION NULA O VACIA
            if (empty($_POST['txtnuevaclaveusuarios'])) {
                header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            } else {
                $Destinatario = $_SESSION['CorreoUsuarios']; // CORREO ELECTRONICO REGISTRADO DE USUARIOS
                $CodigoRecuperacion = rand(10000, 99999); // CODIGO AUTOMATICO DE RECUPERACION [5 DIGITOS]
                $Nombre = "FICA - Recuperación Cuentas Usuarios"; // NOMBRE POR DEFECTO EMPRESA
                $Remitente = "proyectosedmr@gmail.com"; // CORREO DE RECUPERACION DE CUENTAS -> EMPRESA
                $Asunto = "Confirmación Cambio Contraseña - Control Laboratorios FICA"; // ASUNTO POR DEFECTO DE CORREO
                $Bytes = random_bytes(5); // GENERAR CODIGO DE 5 DIGITOS - LETRAS
                $Token = bin2hex($Bytes); // ENVIAR TOKEN A INSERCCION
                $consulta = $Usuarios->CambioContraseniaRecuperacion($conectarsistema, $Correo, $Contrasenia);
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
                                        <p>Su cuenta ha sido recuperada con &eacute;xito, ahora puede ingresar con la nueva credencial de acceso que usted ha estipulado en el proceso
                                        de recuperaci&oacute;n de cuentas. <strong>Si tiene problemas para ingresar, comun&iacute;quese con nuestro administrador de laboratorios, o 
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
                    // VALIDACION DE ENVIO CORREOS
                    if(!$mail->send()) {
                        // CORREO NO ENVIADO
                        header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=error-envio-correo-cambio-credenciales-recuperacion');
                    } else {
                        // CORREO ENVIADO
                        header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=confirmacion-cambio-credenciales-recuperacion');
                    }
                }
                catch (Exception $e){
                    //-> EFECTOS DE DEPURACION ERRORES
                    //echo 'Ha ocurrido un error al enviar el correo electrónico: ' . $mail->ErrorInfo;
                    header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=error-correo-recuperacion-cuentas');
                }
            }// CIERRE if(empty($_POST['txtnuevaclaveusuarios']))
            // RETIRAR TODAS LAS SESIONES AL MOMENTO DE PROCESAR INFORMACION
            session_unset();
            session_destroy();
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // ACTUALIZACION ESTADO TOKEN ->  VALIDO A VENCIDO POR CUMPLIMIENTO DE TIEMPO LIMITE
        case "expiracion-cambio-contrasenia":
            // RETIRAR SESIONES CREADAS PARA MANEJO DE TIEMPO
            unset($_SESSION["expirar_sesion"]);
            unset($_SESSION["tiempo_sesion"]);
            // RETIRAR TODAS LAS SESIONES
            session_unset();
            session_destroy();
            header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // TOKEN DE RECUPERACIONES CUENTAS USUARIOS INVALIDO
        case "token-invalido":
            require('../Vista/token-invalido.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // CONFIRMACION DE CAMBIO DE CREDENCIALES -> RECUPERACION DE CUENTAS USUARIOS
        case "confirmacion-cambio-credenciales-recuperacion":
            require('../Vista/confirmacion-cambio-credenciales-recuperacion-cuentas.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // ERROR ENVIO CORREO - PERO SI EJECUTA TAREA DE CONFIRMACION DE CAMBIO DE CREDENCIALES -> RECUPERACION DE CUENTAS USUARIOS
        case "error-envio-correo-cambio-credenciales-recuperacion":
            require('../Vista/error-envio-correo-cambio-credenciales-usuarios-recuperaciones.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // ERROR ENVIO CORREO - PERO SI EJECUTA TAREA DE CONFIRMACION DE CAMBIO DE CREDENCIALES -> RECUPERACION DE CUENTAS USUARIOS
        case "credenciales-incorrectas":
            require('../Vista/credenciales-incorrectas-usuarios.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // ADVERTENCIA USUARIOS INACTIVOS
        case "usuarios-inactivos":
            require('../Vista/advertencia-usuarios-inactivos.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // ADVERTENCIA USUARIOS BLOQUEADOS
        case "usuarios-bloqueados":
            require('../Vista/advertencia-usuarios-bloqueados.php');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // CERRAR SESION SISTEMA [TODOS LOS USUARIOS]
        case "cerrarsesion":
            $IdUsuarios = $_SESSION['id_usuario']; // ID UNICO DE USUARIO REGISTRADO
            $FechaCierreSesion = date("Y-m-d H:i:s"); // OBTENER FECHA Y HORA EXACTA DE CIERRE DE SESION
            //-> ENVIO A BASE DE DATOS REGISTRO DE ACCION CIERRE DE SESION USUARIOS
            $consulta = $Usuarios->RegistroCierreSesionUsuarios($conectarsistema, $IdUsuarios, $FechaCierreSesion);
            // RETIRAR TODAS LAS SESIONES
            session_unset();
            session_destroy();
            header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        case "mantenimiento-programado":
            // CAMBIAR A "no" CUANDO NO EXISTA MANTENIMIENTO PROGRAMADO
            $MantenimientoProgramado = "no";
            require("../Vista/mantenimiento-programado.php");
            $conectarsistema->close(); // CERRANDO CONEXION
            break;
        // NO PERMITIR INGRESO DE PARAMETROS DISTINTOS A LOS YA ESTIPULADOS EN EL SISTEMA
        default:
            header('location:InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
            break;
    }
?>