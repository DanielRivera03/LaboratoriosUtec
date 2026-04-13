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
    <title><?php echo $TituloPrincipal; ?> Reporte Reservaciones Por Estado y Laboratorios</title>
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
      #DiasRepeticionReservacion{
        display: none;
      }
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
                  <h3>Reporter&iacute;a</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Inicio</a></li>
                    <li class="breadcrumb-item">Reporter&iacute;a</li>
                    <li class="breadcrumb-item">Reporte Reservaciones Por Estado y Laboratorios</li>
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
                      <h5>Reporte Reservaciones Por Estado y Laboratorios</h5>
                    </div>
                    <div class="card-body">
                    <div class="container-fluid general-widget">
                    <div class="row">
                      <p>* Estimado(a) <?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2); print_r($PrimerNombre[0]); ?>. En este apartado usted podr&aacute; generar un reporte completo de todas las reservaciones procesadas en base al 
                      estado de reservaci&oacute;n. <strong>Tome en consideraci&oacute;n que ac&aacute; se filtrar&aacute;n todos los datos por el laboratorios de inform&aacute;tica que usted seleccione</strong>
                      </strong>
                        </b>
                      </p>
                        
                    <form id="frm_reportepracticas_rangofechas" class="form-space theme-form row needs-validation" novalidate="" 
                    autocomplete="off" action="../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=comprobante-reservaciones-procesadas-por-estado-y-laboratorios" method="post">
                          <!-- CICLO -->
                        <div class="col-sm-6 mb-4">
                            <div class="mb-0">
                                <label class="form-label">Seleccione un ciclo <span style="color: var(--bs-danger);">(*)</span></label>
                                    <select class="form-select digits input-air-primary form-control-lg" id="sltcicloseleccion" name="sltcicloseleccion" required="">
                                        <option value="">Seleccione una opci&oacute;n...</option>
                                        <option value="02-2023">Ciclo 02-2023</option>
                                        
                                        </select>
                                    <div class="invalid-feedback">Por favor seleccione un ciclo.</div>
                                </div>
                            </div> 
                            <!-- ESTADO -->
                        <div class="col-sm-6 mb-4">
                            <div class="mb-0">
                                <label class="form-label">Seleccione un estado <span style="color: var(--bs-danger);">(*)</span></label>
                                    <select class="form-select digits input-air-primary form-control-lg" id="sltestadoseleccion" name="sltestadoseleccion" required="">
                                        <option value="">Seleccione una opci&oacute;n...</option>
                                        <option value="1">Todos</option>
                                        <option value="2">Aprobados</option>
                                        <option value="3">Cancelados</option>
                                        <option value="4">Denegados</option>
                                        </select>
                                    <div class="invalid-feedback">Por favor seleccione un estado.</div>
                                </div>
                            </div> 
                            <!-- LABORATORIOS -->
                        <div class="col-sm-12 mb-4">
                            <div class="mb-0">
                                <label class="form-label">Seleccione un laboratorio <span style="color: var(--bs-danger);">(*)</span></label>
                                    <select class="form-select digits input-air-primary form-control-lg" id="sltlaboratorioseleccion" name="sltlaboratorioseleccion" required="">
                                        <option value="">Seleccione una opci&oacute;n...</option>
                                        <option value="1">Laboratorio 1 Inform&aacute;tica</option>
                                        <option value="2">Laboratorio 2 Inform&aacute;tica</option>
                                        <option value="3">Laboratorio 3 Inform&aacute;tica</option>
                                        <option value="4">Laboratorio 4 Inform&aacute;tica</option>
                                        <option value="5">Laboratorio 5 Inform&aacute;tica</option>
                                        <option value="6">Laboratorio 6 Inform&aacute;tica</option>
                                        <option value="7">Laboratorio 7 Inform&aacute;tica</option>
                                        <option value="8">Laboratorio 8 Inform&aacute;tica</option>
                                        <option value="9">Laboratorio 9 Inform&aacute;tica</option>
                                        <option value="10">Laboratorio 10 Inform&aacute;tica</option>
                                        <option value="11">Laboratorio 11 Inform&aacute;tica</option>
                                        <option value="12">Laboratorio 12 Inform&aacute;tica</option>
                                        <option value="13">Laboratorio 13 Inform&aacute;tica</option>
                                        <option value="14">Laboratorio 14 Inform&aacute;tica</option>
                                        <option value="15">Laboratorio 15 Inform&aacute;tica</option>
                                        </select>
                                    <div class="invalid-feedback">Por favor seleccione un laboratorio.</div>
                                </div>
                            </div> 
                        
                                        
                        <div class="card-footer text-end">
                            <button type="submit" id="envio-datosusuarios" class="btn btn-primary"><i class="icofont icofont-save"></i> Generar Reporte</button>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ValidacionReporteRangoFechasPracticasLibres.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/time-picker/jquery-clockpicker.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/time-picker/highlight.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorDateTimePickerReporteReservacionesPorCodigoRangoFechas.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/mask.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/MascaraDatos_ReservacionesPracticasLibres.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/tooltip-init.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
          // DESHABILITAR READONLY EN CAMPOS DE INTERES
          var HoraInicio = document.getElementById("txtHoraInicioPL");
          HoraInicio.readOnly = false;
          var CantidadUsuarios = document.getElementById("txtcantidadusuariosreservacionPL");
          CantidadUsuarios.readOnly = false;
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