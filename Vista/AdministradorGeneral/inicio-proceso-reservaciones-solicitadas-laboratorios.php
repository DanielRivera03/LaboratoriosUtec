<?php 
  // DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA EL SALVADOR (UTC-6)
  setlocale(LC_TIME, "spanish");
  date_default_timezone_set('America/El_Salvador');
  // OBTENER HORA LOCAL
  $hora = new DateTime("now");
  // VALIDACION DE PARAMETRO gestioneslaboratorios -> SI NO EXISTE MOSTRAR PAGINA 404 ERROR
  if (!isset($_GET['gestioneslaboratorios'])) {
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=error-404');
  }
  // NO PERMITIR INGRESO SIN INICIAR SESION
  if(!isset($_SESSION['id_usuario'])){
    header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
  }
  // NO PERMITIR VISTA SI USUARIO ES NUEVO, O BIEN EL PERIODO DE CAMBIO DE CREDENCIALES HA EXPIRADO
  if($Gestiones->getEstadoNuevoUsuario() == "si"){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-nuevos-usuarios');
  }
  // NO PERMITIR VISTA SI USUARIO NO HA COMPLETADO PERFIL DE USUARIO
  if($Gestiones->getEstadoCompletoPerfil() == "no"){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=completar-perfil-nuevos-usuarios');
  }
   // BLOQUEAR TODAS LAS FUNCIONALIDADES DEL SISTEMA SI EL USUARIO CAMBIA A ESTADO [BLOQUEADO]
   if($Gestiones->getEstadoUsuario() == "bloqueado"){
    header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=usuarios-bloqueados');
  }else{ // CASO CONTRARIO, MOSTRAR TODO
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
    <title><?php echo $TituloPrincipal; ?> Nueva Reservaci&oacute;n</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/timepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/date-picker.css">
    <style>
        #frm_reservaciones_primerafase{display: none;}
    </style>
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
    <div class="page-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <?php
        // IMPORTANDO HEADER PRINCIPAL -> MENU DE NAVEGACION SUPERIOR
        require('../Vista/Header/HeaderPrincipal.php');
      ?>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
        <?php 
            // IMPORTANDO MENU DE NAVEGACION -> VALIDO SOLO ADMINISTRADOR GENERAL
            require('../Vista/MenuNavegacion/menu_administradores.php');
          ?>
        </header>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Reservaciones</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Inicio</a></li>
                    <li class="breadcrumb-item">Reservaciones</li>
                    <li class="breadcrumb-item">Nueva Reservaci&oacute;n</li>
                  </ol>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
            <div class="col-sm-12 col-xl-12">
                  <div class="card">
                    <div class="card-header b-l-primary border-3">
                      <h5>Iniciar Nueva Reservaci&oacute;n</h5>
                    </div>
                    <div class="card-body">
                    <div class="container-fluid general-widget">
                    <div class="row">
                      <p>* Consolidado general de todos los laboratorios de inform&aacute;tica, tome en cuenta la capacidad m&aacute;xima de cada uno, adem&aacute;s del estado del 
                        mismo. <b>Laboratorios inactivos, no son ofertados para reservaciones.</b>
                      </p>
                      <?php 
                        while ($filas = mysqli_fetch_array($consulta3)){
                      ?>
                        <div class="col-sm-12 col-xl-4 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (<?php echo $filas['estadolaboratorio']; ?>)</span>
                                    <h4 class="mb-0 counter"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                    <div style="background-color: var(--bs-red);" class="alert text-white" role="alert">
                      <h4 class="alert-heading">Atenci&oacute;n</h4>
                      <p>Esta secci&oacute;n no sustituye en su totalidad la secci&oacute;n de reservaciones principal. La finalidad de este espacio es cuando existiese la posibilidad de registrar reservaciones en un laboratorio
                        que posee m&oacute;dulos, pero que los mismos no siguen un orden secuencial al momento de registrarlo de la manera tradicional. Ac&aacute; usted tendr&aacute; la posibilidad de registrar en cada uno de los m&oacute;dulos
                        sin exceder la capacidad de los mismos. S&iacute; est&aacute; de acuerdo, por favor acepte dichas condiciones en el campo abajo de este mensaje.
                      </p>
                    </div>
                    
                        <div class="mb-4">
                            <label class="form-label">¿Est&aacute; consciente de la finalidad de esta secci&oacute;n?</b> <span style="color: var(--bs-danger);">(*)</span></label>
                                <div class="input-group clockpicker">
                                    <select class="form-select digits input-air-primary form-control-lg" 
                                    id="sltacuerdo_reservacion" name="sltacuerdo_reservacion" onchange="AcuerdoTerminosReservacionEspecial()" required="">
                                        <option value="">Seleccione una opci&oacute;n...</option>
                                        <option value="si">S&iacute;, estoy consciente del mensaje citado anteriormente</option> 
                                    </select>
                                <div class="invalid-feedback">Por favor seleccione una opci&oacute;n.</div>
                            </div>
                        </div>
                    </div>   
                    <form id="frm_reservaciones_primerafase" class="form-space theme-form row needs-validation" novalidate="" 
                    autocomplete="off" action="../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-solicitadas-laboratorios-segunda-fase" method="post">
                      <!-- CONSULTA TIPO RESERVACION -->
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">¿Su reservaci&oacute;n es un <b>Curso libre, Seminario, Tour Utec, Certificaciones?</b> <span style="color: var(--bs-danger);">(*)</span></label>
                                        <div class="input-group clockpicker">
                                        <select class="form-select digits input-air-primary form-control-lg" 
                                        id="slttipoinicial_reservacion" name="slttipoinicial_reservacion" data-bs-toggle="tooltip" data-bs-placement="right" title="¿Por qu&eacute; consultamos? Cada una de las reservaciones se filtran en una compleja b&uacute;squeda para ofrecerle la mejor opci&oacute;n en base a los par&aacute;metros ingresados.
                                            Motivo por el cual necesitamos saber el n&uacute;mero de d&iacute;as que realizar&aacute; esta reservaci&oacute;n" onchange="ConsultaTipoReservacionInicial()" required="">
                                                    <option value="">Seleccione una opci&oacute;n...</option>
                                                    <option value="si">S&iacute;, mi reservaci&oacute;n cumple con al menos uno de los tipos mencionados</option>
                                                    <option value="no">No, no cumple con ninguno de los tipos mencionados</option>
                                                    
                                                </select>
                                            
                                            <div class="invalid-feedback">Por favor seleccione una opci&oacute;n.</div>
                                        </div>
                                    </div>
                                </div>   
                    
                    <!-- CONSULTA DE DIAS A RESERVAR -->
                    <div id="DiasSeleccionReservacion" class="col-sm-12 mb-4">
                    <div class="col">
                    <label class="form-label">¿Qu&eacute; d&iacute;as impartir&aacute; esta reservaci&oacute;n? <span style="color: var(--bs-blue);">(No Obligatorio)</span></label>
                    <div class="alert alert-primary outline" role="alert">
                      <p>* <b>Importante: Debe de marcar los d&iacute;as seg&uacute;n calendario a realizar su reservaci&oacute;n. No es posible procesar reservaciones sin marcar al menos un d&iacute;a.</b>
                      </b></p>
                    </div>
                                              <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-1" type="checkbox" name="lunes" class="días">
                                                    <label for="inline-1">Lunes<span class="digits"></span></label>
                                                </div>
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-2" type="checkbox" name="martes" class="días">
                                                    <label for="inline-2">Martes<span class="digits"></span></label>
                                                </div>
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-3" type="checkbox" name="miercoles" class="días">
                                                    <label for="inline-3">Mi&eacute;rcoles<span class="digits"></span></label>
                                                </div>
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-4" type="checkbox" name="jueves" class="días">
                                                    <label for="inline-4">Jueves<span class="digits"> </span></label>
                                                </div>
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-5" type="checkbox" name="viernes" class="días">
                                                    <label for="inline-5">Viernes<span class="digits"> </span></label>
                                                </div>
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-6" type="checkbox" name="sabado" class="días">
                                                    <label for="inline-6">S&aacute;bado<span class="digits"> </span></label>
                                                </div>
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-7" type="checkbox" name="domingo" class="días">
                                                    <label for="inline-7">Domingo<span class="digits"> </span></label>
                                                </div>
                                              </div>
                    </div>
                    </div>
                    <!-- APLICACION A UTILIZAR -->
                        <div class="col-sm-12">
                            <div class="mb-4">
                                <label class="form-label">¿Qu&eacute; aplicaci&oacute;n utilizar&aacute;? <span style="color: var(--bs-danger);">(*)</span></label>
                                <select class="js-example-placeholder-multiple col-sm-12 form-control input-air-primary form-control-lg" name="sltaplicacionreservacion" id="sltaplicacionreservacion" required="">
                                            <option value=""></option>
                                            <?php 
                                                // TODOS LOS USUARIOS REGISTRADOS
                                                while ($filas = mysqli_fetch_array($consulta2)){
                                                    echo '
                                                    <option value="'.$filas['idaplicacion'].'">'.$filas['nombreaplicacion'].'</option>
                                                    ';
                                                }
                                            ?>
                                        </select>
                                <div class="invalid-feedback">Por favor seleccione una aplicaci&oacute;n.</div>
                            </div>
                        </div>
                        <!-- NUMERO USUARIOS -->
                        <div class="col-sm-12">
                                    <div class="mb-4">
                                        <label class="form-label">¿Cantidad de Personas? <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input class="form-control input-air-primary form-control-lg" id="txtcantidadusuariosreservacion" name="txtcantidadusuariosreservacion" onkeypress="return (event.charCode <= 57)" type="text" placeholder="Ingrese la cantidad de personas a asistir..." aria-describedby="inputGroupPrepend" required="">
                                        <div class="invalid-feedback">Por favor ingrese la cantidad de personas a asistir.</div>
                                    </div>
                                </div>
                         <!-- FECHA INICIO -->
                         <div class="col-sm-12 col-xl-12 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Fecha Inicio <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input class="form-control input-air-primary form-control-lg digits" data-position="top left" 
                                         id="txtInicioReservacion" name="txtInicioReservacion" placeholder="Ingrese su fecha de inicio..." type="text" aria-describedby="inputGroupPrepend" readonly required="">
                                        <div class="invalid-feedback">Por favor ingrese la cantidad de personas a asistir.</div>
                                    </div>
                                </div>
                        <!-- FECHA FIN -->
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Fecha Finalizaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input class="form-control input-air-primary form-control-lg digits" data-position="top left" 
                                         id="txtFinalizacionReservacion" name="txtFinalizacionReservacion" placeholder="Ingrese su fecha de finalizaci&oacute;n..." type="text" aria-describedby="inputGroupPrepend" readonly required="">
                                        <div class="invalid-feedback">Por favor ingrese la cantidad de personas a asistir.</div>
                                    </div>
                                </div>
                        <!-- HORA INICIO -->
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Hora Inicio <span style="color: var(--bs-danger);">(*)</span></label>
                                        <div class="input-group clockpicker">
                                            <input class="form-control input-air-primary form-control-lg" type="text" id="txtHoraInicio" name="txtHoraInicio" placeholder="Ingrese su hora de inicio..." aria-describedby="inputGroupPrepend" required=""><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                            <div class="invalid-feedback">Por favor ingrese la hora de inicio.</div>
                                        </div>
                                    </div>
                                </div>
                        <!-- HORA FIN -->
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Hora Finalizaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                        <div class="input-group clockpicker">
                                            <input class="form-control input-air-primary form-control-lg" type="text" id="txtHoraFinalizacion" name="txtHoraFinalizacion" placeholder="Ingrese su hora de finalizaci&oacute;n..." aria-describedby="inputGroupPrepend" required=""><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                            <div class="invalid-feedback">Por favor ingrese la hora de finalizaci&oacute;n.</div>
                                        </div>
                                    </div>
                                </div>
                                        
                        <div class="card-footer text-end">
                            <button type="submit" id="envio-datosusuarios" class="btn btn-primary"><i class="icofont icofont-save"></i> Iniciar Proceso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright &copy; 2023 Control Laboratorios FICA.</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0">Hecho con muchas tazas de caf&eacute; <i class="fa fa-heart font-secondary"></i></p>
              </div>
            </div>
          </div>
        </footer>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/prism/prism.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/clipboard/clipboard.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/counter/counter-custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/custom-card/custom-card.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/notify/bootstrap-notify.min.js"></script>
    
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/script.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/theme-customizer/customizer.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/reloj.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorNotificacionesSweetAlert2.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/notify/notify-script.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorNotificacionesNotify.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2-custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ValidacionReservacionPrimeraFase.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/time-picker/jquery-clockpicker.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/time-picker/highlight.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorDateTimePicker.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/mask.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/MascaraDatos_Reservaciones.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/tooltip-init.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
        function AcuerdoTerminosReservacionEspecial(){
          var ValorTipoReservacion = document.getElementById("sltacuerdo_reservacion");
          var AceptaAcuerdo = document.getElementById("frm_reservaciones_primerafase");
          if (ValorTipoReservacion.value == "si") {
            AceptaAcuerdo.style.display = "block";
          } else {
            AceptaAcuerdo.style.display = "none";
          }}
          // DESHABILITAR READONLY EN CAMPOS DE INTERES
          var CantidadUsuarios = document.getElementById("txtcantidadusuariosreservacion");
          CantidadUsuarios.readOnly = false;
          var CantidadDiasConcurrencia = document.getElementById("txtcantidadias_inicialreservacion");
          CantidadDiasConcurrencia.readOnly = false;
          var HoraInicio = document.getElementById("txtHoraInicio");
          HoraInicio.readOnly = false;
          var HoraFin = document.getElementById("txtHoraFinalizacion");
          HoraFin.readOnly = false;
    </script>
    <!-- login js-->
    <!-- Plugin used-->
    <?php 
      /** -> IMPORTAR CONTROLADOR DE INACTIVIDAD SESIONES */
      require_once('../Vista/ControlSesionesInactividad/ControladorInactividadSesionesUsuarios.php');
    ?>
  </body>
</html>
<?php } ?>