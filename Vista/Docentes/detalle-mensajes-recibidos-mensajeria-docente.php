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
    <title><?php echo $TituloPrincipal; ?> Bandeja de Entrada</title>
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
    <!-- Bootstrap Dropzone CSS -->
    <link href="<?php echo $UrlGlobal; ?>Vista/assets/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Dropzone CSS -->
    <link href="<?php echo $UrlGlobal; ?>Vista/assets/dropify/dist/css/dropify.css" rel="stylesheet" type="text/css" />
  </head>
  <style>
    .marker{
        background-color: yellow;
    }
  </style>
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
            require('../Vista/MenuNavegacion/menu_docentes.php');
          ?>
        </header>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Detalle Mensaje</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Inicio</a></li>
                    <li class="breadcrumb-item">Mensajer&iacute;a</li>
                    <li class="breadcrumb-item">Detalle Mensaje</li>
                  </ol>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap">
              <div class="row">
              <div class="col-xl-3 col-md-6 xl-30">
                  <div class="email-sidebar"><a class="btn btn-primary email-aside-toggle" href="javascript:void(0)">Opciones Mensajer&iacute;a</a>
                    <div class="email-left-aside">
                      <div class="card">
                        <div class="card-body">
                          <div class="email-app-sidebar">
                            <div class="media">
                              <div class="media-size-email"><img class="me-3 rounded-circle" style="max-width: 50px;" src="<?php echo $UrlGlobal; ?>Vista/assets/images/FotoPerfil/<?php echo $_SESSION["foto_usuario"]; ?>" alt=""></div>
                              <div class="media-body">
                                <h6 class="f-w-600"><?php echo $_SESSION["usuario_unico"]; ?></h6>
                              </div>
                            </div>
                            <ul class="nav main-menu" role="tablist">
                              <li class="nav-item"><a class="btn-primary btn-block btn-mail" id="pills-darkhome-tab" data-bs-toggle="pill" href="#pills-darkhome"><i class="icofont icofont-envelope me-2"></i> Nuevo Mensaje</a></li>
                              <li><a href="#"><span class="title"><i class="icon-folder"></i> Bandeja de Entrada</span></a></li>
                              <li>
                                <hr>
                              </li>
                              
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-9 col-md-12 xl-70">
                  <div class="email-right-aside">
                    <div class="card email-body">
                      <div class="email-profile">                                                                     
                        <div class="email-right-aside">
                          <div class="email-body">
                            <div class="email-content">
                              <div class="email-top">
                                <div class="row">
                                  <div class="col-xl-12">
                                    <div class="media"><img style="max-width: 50px; max-height: 60px;" class="me-3 rounded-circle" src="<?php echo $UrlGlobal; ?>Vista/assets/images/FotoPerfil/<?php echo $Gestiones->getFotoPerfilUsuarios(); ?>" alt="">
                                      <div class="media-body">
                                        <h6 class="d-block"><?php echo $Gestiones->getNombresUsuarios(); ?> <?php echo $Gestiones->getApellidosUsuarios(); ?>                                                            </h6>
                                        <p><i class="fa fa-clock-o"></i> <?php $FechaMensajeFormato = date_create($Gestiones->getFechaMensaje()); echo date_format($FechaMensajeFormato, 'd-m-Y H:i:s');  ?>.</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="email-wrapper">
                                <div class="emailread-group">
                                  <div class="read-group">
                                    <p><strong><?php echo $Gestiones->getNombreMensaje(); ?></strong></p>
                                    <p><strong>Asunto:</strong> <?php echo $Gestiones->getAsuntoMensaje(); ?></p>
                                  </div>
                                  <div class="read-group">
                                    <p><?php echo $Gestiones->getDetalleMensaje(); ?></p>
                                    <p class="mt-4">ATENTAMENTE:</p>
                                    <p><?php echo $Gestiones->getNombresUsuarios(); ?> <?php echo $Gestiones->getApellidosUsuarios(); ?></p>
                                  </div>
                                </div>
                                <div class="emailread-group">
                                  <h6 class="text-muted mb-0"><i class="icofont icofont-clip"></i> ARCHIVO ADJUNTO</h6><a class="text-muted text-end right-download font-primary f-w-600" href="#"></a>
                                  <div class="clearfix"></div>
                                  <div class="attachment">
                                    <ul>
                                        <?php 
                                            if(empty($Gestiones->getArchivoAdjunto())){
                                                echo "* No se adjunto ning&uacute;n archivo";
                                            }else{
                                                echo '
                                                    <li><a href="'.$UrlGlobal."Vista/ArchivosAdjuntosMensajeria/".$Gestiones->getArchivoAdjunto().'">'.$Gestiones->getArchivoAdjunto().'</a></li>
                                                ';
                                            }
                                        ?>
                                    </ul>
                                  </div>
                                </div>
                                <div class="emailread-group">
                                  <div class="action-wrapper">
                                    <ul class="actions">
                                      <?php 
                                        if($Gestiones->getEstadoOcultarMensaje() == "no"){
                                            echo '
                                            <li><a class="btn btn-primary" data-id="'; echo $Gestiones->getIdMensajeria(); echo'" id="ocultar-mensaje"><i class="fa fa-eye-slash"></i> Ocultar Mensaje</a></li>
                                            ';
                                        }
                                        if($Gestiones->getEstadoMensajeLeido() == "no"){
                                            echo '
                                            <li><a class="btn btn-success" data-id="'; echo $Gestiones->getIdMensajeria(); echo'" id="marcar-leido"><i class="fa fa-check"></i> Marcar Como Le&iacute;do</a></li>
                                            ';
                                        }else{
                                          echo '
                                            <li><a class="btn btn-info"><i class="fa fa-exclamation-circle"></i> Mensaje Le&iacute;do</a></li>
                                            ';
                                        }
                                      ?>
                                    </ul>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_Ocultar-mensajes-usuarios.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_Marcar-leido-mensajes.js"></script>
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