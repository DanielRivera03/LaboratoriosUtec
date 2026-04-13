<!-- 
   /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/
-->
<?php
// NO PERMITIR LA ESTANCIA EN ESTA PAGINA POR MAS DE 360 SEGUNDOS
if (isset($_SESSION['tiempo_sesion'])) {
    $Inactividad = 300; // 5 MINUTOS
    $TiempoVida = time() - $_SESSION['tiempo_sesion'];
    if ($TiempoVida > $Inactividad) {
        // RETIRAR Y DESTRUIR LA SESION
        session_unset();
        session_destroy();
        // REDIRIGIR AL FORMULARIO DE INICIO DE SESION      
        header("location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=expiracion-cambio-contrasenia");
        exit(); // SALIR DE TODA EJECUCION
    }
}
$_SESSION['tiempo_sesion'] = time(); // CONTADOR DE TIEMPO
// NO PERMITIR INGRESO SIN SESION DE TOKEN INICIALIZADA
if (!isset($_SESSION['TokenUsuarios'])) {
    header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
}
if ($_GET['token'] != $_SESSION['TokenUsuarios']) {
    $urltoken = $_GET['token'];
    $URL = "../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=token-invalido&token=$urltoken";
    header("location: $URL");
}
?>
<!DOCTYPE html>
<html lang="ES-SV">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal administrativo FICA UTEC - Control de Laboratorios de Inform&aacute;tica">
    <meta name="keywords" content="laboratorios utec, gesti&oacute;n laboratorios inform&aacute;tica">
    <meta name="author" content="FICA UTEC">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title><?php echo $TituloPrincipal; ?> Ingreso C&oacute;digo Seguridad</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/sweetalert2.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?php echo $UrlGlobal; ?>Vista/assets/css/color-7.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/responsive.css">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>  
    <div class="alert alert-danger dark mb-0" role="alert">
        <p><strong><i class="icofont icofont-user-search"></i> Estimado(a) Usuario:</strong> Su token de recuperaci&oacute;n es: <strong><?php echo $_SESSION['TokenUsuarios']; ?></strong>. Solamente cuenta con una oportunidad para reestablecer su contrase&ntilde;a. Si usted cierra el navegador, o simplemente pierde el acceso a est&aacute; p&aacute;gina. <strong>Deber&aacute; iniciar nuevamente el proceso de reestablecimiento de su contrase&ntilde;a.</strong> Lo anterior, por la seguridad de sus datos en nuestro sistema. Dispone de 5 minutos para verificar su c&oacute;digo, de lo contrario su token de acceso vencer&aacute;.</p>
    </div>       
      <div class="container-fluid p-0"> 
        <div class="row m-0">
          <div class="col-12 p-0">    
            <div class="login-card">
              <div class="login-main"> 
                <form id="cambioestadotoken" data-id="<?php echo $_SESSION['TokenUsuarios']; ?>" class="theme-form login-form" method="post" autocomplete="off">
                  <h4 style="text-align: center;">C&oacute;digo de Seguridad</h4>
                  <p style="text-align: justify;" class="mt-2">Por favor ingrese el c&oacute;digo de seguridad mostrado en el correo recibido. </p>
                  <img class="img-fluid" src="<?php echo $UrlGlobal; ?>Vista/assets/images/secure-data.svg">
                  <div class="form-group">
                    <label class="col-form-label">Ingrese su c&oacute;digo:</label>
                    <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                      <input style="letter-spacing: 1.1rem;" class="form-control" type="text" name="txtcodigoseguridad" id="txtcodigoseguridad" maxlength="5" required="" placeholder="44394" onBlur="comprobarCodigoSeguridad()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                    </div>
                    <div id="validacion_boton"></div>
                    <div class="col-md-12 mt-3">
				        <span id="estadousuario"></span>
					</div>
					<p><img style="width: 25px; margin: 1rem 0 0 0; display:none;" src="../Vista/assets/images/ajax-loader.gif" id="loaderIcon" /></p>
                    </div>
                  </div>                  
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/sidebar-menu.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/sweet-alert/sweetalert.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/script.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ComprobacionCodigosSeguridad.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/CambioEstadoToken_RecuperacionesCuentas.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>