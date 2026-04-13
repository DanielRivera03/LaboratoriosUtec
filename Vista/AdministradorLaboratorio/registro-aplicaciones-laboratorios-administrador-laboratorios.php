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
    <title><?php echo $TituloPrincipal; ?> Registrar Aplicaciones Laboratorios</title>
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
                  <h3>Aplicaciones Laboratorios</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Inicio</a></li>
                    <li class="breadcrumb-item">Aplicaciones</li>
                    <li class="breadcrumb-item">Registrar Aplicaciones</li>
                  </ol>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <!-- ALERTA INICIAL -->
                        <div class="col-sm-14 col-md-12 col-lg-12">
                        <div class="setting-list">
                        <ul class="list-unstyled setting-option">
                          <li>
                            <div class="setting-primary"><i class="icon-settings"></i></div>
                          </li>
                          <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                          <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                          <li><i class="icofont icofont-error close-card font-primary"></i></li>
                        </ul>
                      </div>
                      <div class="ribbon-wrapper card">
                        <div class="card-body">
                        <div class="default-according style-1" id="accordionoc">
                      
                      <div class="card">
                        <div class="card-header bg-primary">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#collapseicon1" aria-expanded="false"><i class="icofont icofont-support"></i> Por favor, antes de continuar</button>
                          </h5>
                        </div>
                        <div class="collapse" id="collapseicon1" aria-labelledby="headingeight" data-bs-parent="#accordionoc">
                          <div class="card-body"><span><i class="icofont icofont-info-square"></i> Estimado(a). <?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2); print_r($PrimerNombre[0]); ?> por favor tome nota que solamente 
                        puede registrar aplicaciones en los laboratorios que usted ha sido asignado.</span></div>
                        </div>
                      </div>
                        </div>

                            <div class="ribbon ribbon-clip ribbon-primary"><i class="icofont icofont-flash-drive"></i> Aplicaciones Laboratorios</div>
                                <div class="card-body">
                                    <form id="frm_registro_nuevas_aplicaciones" class="form-space theme-form row needs-validation" novalidate="" autocomplete="off" method="post">
                                        <!-- CODIGO APLICACION -->
                                        <div class="col-sm-6">
                                            <div class="mb-4">
                                                <label class="form-label">C&oacute;digo Aplicaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                                <input class="form-control input-air-primary form-control-lg" id="txtcodigoaplicaciones_laboratorio" name="txtcodigoaplicaciones_laboratorio" type="text" placeholder="Ingrese el c&oacute;digo de la aplicaci&oacute;n..." aria-describedby="inputGroupPrepend" required="">
                                                <div class="invalid-feedback">Por favor ingrese c&oacute;digo de la aplicaci&oacute;n.</div>
                                            </div>
                                        </div>
                                        <!-- NOMBRE APLICACION -->
                                        <div class="col-sm-6">
                                            <div class="mb-4">
                                                <label class="form-label">Nombre Aplicaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                                <input class="form-control input-air-primary form-control-lg" id="txtnombreaplicaciones_laboratorio" name="txtnombreaplicaciones_laboratorio" type="text" placeholder="Ingrese el nombre de la aplicaci&oacute;n..." aria-describedby="inputGroupPrepend" required="">
                                                <div class="invalid-feedback">Por favor ingrese el nombre de la aplicaci&oacute;n.</div>
                                            </div>
                                        </div>
                                        <!-- CLASIFICACION APLICACION -->
                                        <div class="col-sm-12 mb-4">
                                            <div class="mb-0">
                                                <label class="form-label">Clasificaci&oacute;n Aplicaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                                <select class="form-select digits input-air-primary form-control-lg" id="slclasificacionaplicaciones_laboratorio" name="slclasificacionaplicaciones_laboratorio" required="">
                                                    <option value="">Seleccione una opci&oacute;n...</option>
                                                    <?php 
                                                        // TODOS LAS CLASIFICACIONES DE APLICACIONES LABORATORIO REGISTRADAS
                                                        while ($filas = mysqli_fetch_array($consulta2)){
                                                            echo "
                                                                <option value=".$filas['idclasificacionlaboratorio'].">".$filas['codigoclasificacionlaboratorio']."</option>
                                                            ";
                                                        }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">Por favor seleccione una clasicaci&oacute;n.</div>
                                            </div>
                                        </div> 

                                        <div class="col-sm-12">
                                            <label class="form-label">Laboratorios Instalados <span style="color: var(--bs-danger);">(*)</span></label>
                                        </div>
                                        <div class="col">
                                            <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab1()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-1" type="checkbox" name="chklab1">
                                                <label for="inline-1">Laboratorio<span class="digits"> 1</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab2()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-2" type="checkbox" name="chklab2">
                                                <label for="inline-2">Laboratorio<span class="digits"> 2</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab3()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-3" type="checkbox" name="chklab3">
                                                <label for="inline-3">Laboratorio<span class="digits"> 3</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab4()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-4" type="checkbox" name="chklab4">
                                                <label for="inline-4">Laboratorio<span class="digits"> 4</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab5()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-5" type="checkbox" name="chklab5">
                                                <label for="inline-5">Laboratorio<span class="digits"> 5</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab6()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-6" type="checkbox" name="chklab6">
                                                <label for="inline-6">Laboratorio<span class="digits"> 6</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab7()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-7" type="checkbox" name="chklab7">
                                                <label for="inline-7">Laboratorio<span class="digits"> 7</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab8()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-8" type="checkbox" name="chklab8">
                                                <label for="inline-8">Laboratorio<span class="digits"> 8</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab9()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-9" type="checkbox" name="chklab9">
                                                <label for="inline-9">Laboratorio<span class="digits"> 9</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab10()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-10" type="checkbox" name="chklab10">
                                                <label for="inline-10">Laboratorio<span class="digits"> 10</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab11()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-11" type="checkbox" name="chklab11">
                                                <label for="inline-11">Laboratorio<span class="digits"> 11</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab12()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-12" type="checkbox" name="chklab12">
                                                <label for="inline-12">Laboratorio<span class="digits"> 12</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab13()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-13" type="checkbox" name="chklab13">
                                                <label for="inline-13">Laboratorio<span class="digits"> 13</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab14()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-14" type="checkbox" name="chklab14">
                                                <label for="inline-14">Laboratorio<span class="digits"> 14</span></label>
                                            </div>
                                            <?php } ?>
                                            <?php if ($Gestiones->getLaboratorioAsignadoLab15()=="si"){ ?>
                                            <div class="checkbox checkbox-dark">
                                                <input id="inline-15" type="checkbox" name="chklab15">
                                                <label for="inline-15">Laboratorio<span class="digits"> 15</span></label>
                                            </div>
                                            <?php } ?>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" id="envio-datosusuarios" class="btn btn-outline-primary-2x"><i class="icofont icofont-save"></i> Guardar</button>
                                        <button type="reset" class="btn btn-outline-info-2x"><i class="icofont icofont-undo"></i> Limpiar</button>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-registro-nuevas-aplicaciones.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
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