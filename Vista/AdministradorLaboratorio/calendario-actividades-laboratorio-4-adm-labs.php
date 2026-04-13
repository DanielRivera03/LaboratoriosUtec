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
  // NO PERMITIR VISTA SI LABORATORIO NO SE ENCUENTRA ASIGNADO
  if ($Gestiones->getLaboratorioAsignadoLab4()=="no"){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
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
    <title><?php echo $TituloPrincipal; ?> Calendario Actividades Laboratorio 4</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/timepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/date-picker.css">      
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/select2.css">
    <style>
      .tui-full-calendar-schedule-title, 
      .tui-full-calendar-popup-detail-date,
      .tui-full-calendar-content{
        color: #000 !important;
      }

      .tui-full-calendar-month-more-title,
      .tui-full-calendar-month-more{
        background-color: #b2bec3 !important;
      }
      #DiasRepeticionReservacion{
        display: none;
      }
      .tui-full-calendar-popup-detail-date{
        color: #000 !important;
        font-weight: bold !important;
      }

      .tui-full-calendar-dayname-date, .tui-full-calendar-dayname-name{
        color: #ee5253 !important;
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
            require('../Vista/MenuNavegacion/menu_administradoreslaboratorios.php');
          ?>
        </header>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Calendario Laboratorio 4</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Inicio</a></li>
                    <li class="breadcrumb-item">Calendario</li>
                    <li class="breadcrumb-item">Calendario Actividades Laboratorio 4</li>
                  </ol>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid calendar-basic">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div id="menu">
                          <div id="menu-navi">
                            <div class="menu-navi-left">
                              <button class="btn btn-primary move-today" type="button" data-action="move-today">Ahora</button>
                            </div>
                            <div class="render-range menu-navi-center" id="renderRange"></div>
                            <div class="menu-navi-right">
                              <button class="btn btn-primary" id="dropdownMenu-calendarType" type="button" data-bs-toggle="dropdown"><i id="calendarTypeIcon"></i><span id="calendarTypeName">Dropdown</span><i class="fa fa-angle-down"></i></button>
                              <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily"><i class="fa fa-bars"></i>Diario</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly"><i class="fa fa-th-large"></i>Semanal</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly"><i class="fa fa-th"></i>Mensual</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2"><i class="fa fa-th-large"></i>2 Semanas</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3"><i class="fa fa-th-large"></i>3 Semanas</a></li>
                                <li class="dropdown-divider" role="presentation"></li>
                                <li role="presentation"><a role="menuitem" data-action="toggle-workweek">
                                    <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-workweek" checked=""><span class="checkbox-title"></span>Mostrar Fines de Semana</a></li>
                                <li role="presentation"><a role="menuitem" data-action="toggle-start-day-1">
                                    <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-start-day-1"><span class="checkbox-title"></span>Comenzar Semana Lunes</a></li>
                                <li role="presentation"><a role="menuitem" data-action="toggle-narrow-weekend">
                                    <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-narrow-weekend"><span class="checkbox-title"></span>Fines de Semana Estrechos</a></li>
                              </ul>
                              <div class="move-btn">
                                <button class="btn btn-primary move-day" type="button" data-action="move-prev"><i class="fa fa-angle-left" data-action="move-prev"></i></button>
                                <button class="btn btn-primary move-day" type="button" data-action="move-next"><i class="fa fa-angle-right" data-action="move-next"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div id="right">
                          <div id="calendar"></div>
                          <div class="d-flex justify-content-center align-items-center">
                            <button id="close-calendar-btn" class="btn btn-primary">&times; Cerrar Modal Informaci&oacute;n Reservaci&oacute;n</button>
                          </div>
                          <div class="modal fade bd-example-modal-lg" role="dialog" id="myModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myLargeModalLabel">Nueva Reservaci&oacute;n</h4>
                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form id="frm_reservaciones_primerafase" class="form-space theme-form row needs-validation" novalidate="" 
                    autocomplete="off" action="../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-laboratorios-segunda-fase" method="post">
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
                    <label class="form-label">¿Qu&eacute; d&iacute;as impartir&aacute; esta reservaci&oacute;n? <span style="color: var(--bs-blue);">(Obligatorio)</span></label>
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
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="form-label">¿Cantidad de Personas? <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input class="form-control input-air-primary form-control-lg" id="txtcantidadusuariosreservacion" name="txtcantidadusuariosreservacion" onkeypress="return (event.charCode <= 57)" type="text" placeholder="Ingrese la cantidad de personas a asistir..." aria-describedby="inputGroupPrepend" required="">
                                        <div class="invalid-feedback">Por favor ingrese la cantidad de personas a asistir.</div>
                                    </div>
                                </div>
                         <!-- FECHA INICIO -->
                         <div class="col-sm-12 col-xl-3 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Fecha Inicio <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input class="form-control input-air-primary form-control-lg digits" data-position="top left" 
                                         id="txtInicioReservacion" name="txtInicioReservacion" placeholder="Ingrese su fecha de inicio..." type="text" aria-describedby="inputGroupPrepend" readonly required="">
                                        <div class="invalid-feedback">Por favor ingrese la cantidad de personas a asistir.</div>
                                    </div>
                                </div>
                        <!-- FECHA FIN -->
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Fecha Finalizaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input class="form-control input-air-primary form-control-lg digits" data-position="top left" 
                                         id="txtFinalizacionReservacion" name="txtFinalizacionReservacion" placeholder="Ingrese su fecha de finalizaci&oacute;n..." type="text" aria-describedby="inputGroupPrepend" readonly required="">
                                        <div class="invalid-feedback">Por favor ingrese la cantidad de personas a asistir.</div>
                                    </div>
                                </div>
                        <!-- HORA INICIO -->
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Hora Inicio <span style="color: var(--bs-danger);">(*)</span></label>
                                        <div class="input-group clockpicker">
                                            <input class="form-control input-air-primary form-control-lg" type="text" id="txtHoraInicio" name="txtHoraInicio" placeholder="Ingrese su hora de inicio..." aria-describedby="inputGroupPrepend" required=""><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                            <div class="invalid-feedback">Por favor ingrese la hora de inicio.</div>
                                        </div>
                                    </div>
                                </div>
                        <!-- HORA FIN -->
                        <div class="col-sm-12 col-xl-3 col-lg-12">
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
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2-custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ValidacionReservacionPrimeraFase.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
    </script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/notify/notify-script.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorNotificacionesNotify.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-registro-nuevos-tipos-reservaciones.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/tui-code-snippet.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/tui-time-picker.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/tui-date-picker.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/moment.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/chance.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/tui-calendar.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/calendars.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorReservacionesCalendarioActividades.js"></script>
    <script>
      <?php 
      $ContadorReservaciones = 1;
      //-> TODAS LAS RESERVACIONES REGISTRADAS [ASIGNACION DE VARIABLES Y DATA EN CALENDARIO]
        while ($filas = mysqli_fetch_array($consulta3)){
      ?>
      var Reservacion_<?php echo $ContadorReservaciones ?> = new ScheduleInfo();
      Reservacion_<?php echo $ContadorReservaciones ?>.id = '<?php echo $filas['idreservacion']; ?>';
      Reservacion_<?php echo $ContadorReservaciones ?>.calendarId = '<?php echo $filas['idlaboratorio']; ?>';
      Reservacion_<?php echo $ContadorReservaciones ?>.title = '<?php echo $filas['nombrereservacion']; ?>';
      Reservacion_<?php echo $ContadorReservaciones ?>.location = '<?php echo $filas['numerousuarios']; ?> Personas';
      Reservacion_<?php echo $ContadorReservaciones ?>.state = '<?php echo $filas['nombres']; ?> <?php echo $filas['apellidos']; ?> [<?php echo $filas['codigoreservacion']; ?>]';
      Reservacion_<?php echo $ContadorReservaciones ?>.body = "Tipo: <b><?php echo $filas['tiporeservacion']; ?></b>" + 
      "<br>Secci&oacute;n: <b><?php if($filas['seccionreservacion']==0){echo "Ninguna";}elseif ($filas['seccionreservacion']>=1 && $filas['seccionreservacion']<=9){echo '0'.$filas['seccionreservacion'];}else{echo $filas['seccionreservacion'];}?></b> " +
      "<br>Aplicaci&oacute;n: <b><?php echo $filas['nombreaplicacion'] ?></b>";
      Reservacion_<?php echo $ContadorReservaciones ?>.category = 'time';
      Reservacion_<?php echo $ContadorReservaciones ?>.start = new Date("<?php echo $filas['fechainicioreservacion']; ?>T<?php echo $filas['horainicioreservacion']; ?>");
      Reservacion_<?php echo $ContadorReservaciones ?>.end = new Date("<?php echo $filas['fechafinreservacion']; ?>T<?php echo $filas['horafinreservacion']; ?>");
    <?php $ContadorReservaciones++; } ?>
      function generateSchedule(viewName, renderStart, renderEnd) {
          ScheduleList = [];
          <?php 
          $ContadorReservacionesRender = 1;
          //-> TODAS LAS RESERVACIONES REGISTRADAS [IMPRESION EN CALENDARIO (RENDER)]
          while ($filas = mysqli_fetch_array($consulta4)){
          ?>
          ScheduleList.push(Reservacion_<?php echo $ContadorReservacionesRender; ?>);
          <?php $ContadorReservacionesRender++; } ?>
      }
    </script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/app.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/mask.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/MascaraDatos_Reservaciones.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/time-picker/jquery-clockpicker.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/time-picker/highlight.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorDateTimePicker.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorNotificacionesSweetAlert2.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <?php 
      /** -> IMPORTAR CONTROLADOR DE INACTIVIDAD SESIONES */
      require_once('../Vista/ControlSesionesInactividad/ControladorInactividadSesionesUsuarios.php');
    ?>
  </body>
</html>
<?php } ?>