<?php 
  // SI USUARIO NO TIENE SESION ACTIVA, MOSTRAR INICIO DE SESION
  if(empty($_SESSION['id_usuario'])){
    // SI EXISTE PLAN DE MANTENIMIENTO, MOSTRAR PAGINA DE MANTENIMIENTO
    if($MantenimientoProgramado == "si"){
      header("location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=mantenimiento-programado");
    }
?>
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
    <title><?php echo $TituloPrincipal;?> Iniciar Sesi&oacute;n</title>
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6"><img class="bg-img-cover bg-center" src="<?php echo $UrlGlobal; ?>Vista/assets/images/bg-iniciosesion.jpeg" alt="looginpage"></div>
        <div class="col-xl-6 p-0">
          <div class="login-card">
            <form style="border: 3px solid #6F1E51; border-radius: 3%" class="theme-form login-form needs-validation" novalidate="" method="post" action="../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=autenticacion-usuarios">
              <h4><i class="icofont icofont-id-card"></i> Iniciar Sesi&oacute;n</h4>
              <h6>Bienvenido(a). Ingrese sus credenciales de acceso</h6>
              <div class="form-group">
                <label>Usuario</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-user"></i></span>
                  <input class="form-control" type="text" name="txtusuario" required="" placeholder="Usuario y/o Correo" value="<?php if (!empty($_COOKIE['txtusuario'])) {echo $_COOKIE['txtusuario'];} ?>">
                  <div class="invalid-tooltip">Por favor ingrese su correo y/o usuario.</div>
                </div>
              </div>
              <div class="form-group">
                <label>Contrase&ntilde;a</label>
                <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                  <input class="form-control" type="password" name="txtcontrasenia" id="txtcontrasenia" required="" placeholder="*********">
                  <div class="invalid-tooltip">Por favor ingrese su contrase&ntilde;a.</div>
                  <button class="background-password btn btn-primary" style="height: auto;" id="show_password" class="input-group-text" type="button" onclick="mostrarPassword_InicioSesion()"> <span style="font-size: 1rem;" class="fa fa-eye-slash show-password"></span> </button>
                </div>
              </div>
              <div class="form-group">
              <div class="checkbox checkbox-primary">
              <?php if (empty($_COOKIE['txtusuario'])) {
              // MOSTRAR UNICAMENTE SI COOKIE NO HA SIDO GUARDADA ?>
                
                  <input id="checkbox-primary-1" type="checkbox" name="chk_recordarusuario">
                  <label for="checkbox-primary-1">Recordar Usuario</label>
                <?php } ?>
                </div>
                <a style="cursor: help;" class="link" href="<?php echo $UrlGlobal; ?>Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=olvide-contrasenia-recuperacion">¿Olvide mi contrase&ntilde;a?</a>
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
              </div>
              <div class="login-social-title">                
                <h5>&copy; Control Laboratorios FICA 2023</h5>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      (function() {
      'use strict';
      window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      }
      form.classList.add('was-validated');
      }, false);
      });
      }, false);
      })();
    </script>
    <script>
      window.onload = function(){
        // Eliminar el valor guardado en local storage
        localStorage.removeItem("remainingTime");
      }
    </script>
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
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/script.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/MostrarContrasenias.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>
<?php 
  }else{
    // CASO CONTRARIO, ENVIAR A INICIO DE PORTAL SEGUN ROL DE USUARIOS
    header("location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas");
  }
?>