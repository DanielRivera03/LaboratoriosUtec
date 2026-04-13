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
  //if($Gestiones->getEstadoNuevoUsuario() == "si"){
    //header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-nuevos-usuarios');
  //}
  // NO PERMITIR VISTA SI USUARIO NO HA COMPLETADO PERFIL DE USUARIO
  //if($Gestiones->getEstadoCompletoPerfil() == "no"){
  //  header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=completar-perfil-nuevos-usuarios');
  //}
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
    <title><?php echo $TituloPrincipal; ?> Mi Perfil</title>
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
    <!-- Bootstrap Dropzone CSS -->
    <link href="<?php echo $UrlGlobal; ?>Vista/assets/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Dropzone CSS -->
    <link href="<?php echo $UrlGlobal; ?>Vista/assets/dropify/dist/css/dropify.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/datatable-extension.css">
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
                  <h3>Mi Perfil</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                    <li class="breadcrumb-item">Usuarios</li>
                    <li class="breadcrumb-item active">Mi Perfil</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="user-profile">
              <div class="row">
                <!-- user profile header start-->
                <div class="col-sm-12">
                  <div class="card profile-header"><img class="img-fluid bg-img-cover" src="<?php echo $UrlGlobal; ?>Vista/assets/images/bg-perfilusuariosprincipal.jpg" alt="">
                    <div class="profile-img-wrrap"><img class="img-fluid bg-img-cover" src="<?php echo $UrlGlobal; ?>Vista/assets/images/bg-perfilusuariosprincipal.jpg" alt=""></div>
                    <div class="userpro-box">
                      <div class="img-wrraper">                              
                        <div class="avatar"><img class="img-fluid" alt="" src="<?php echo $UrlGlobal; ?>Vista/assets/images/FotoPerfil/<?php echo $Gestiones->getFotoPerfilUsuarios(); ?>"></div>
                      </div>
                      <div class="user-designation">
                        <div class="title"><a href="javascript:void(0)"> 
                            <h4><?php echo $Gestiones->getNombresUsuarios(); ?> <?php echo $Gestiones->getApellidosUsuarios(); ?></h4>
                            <h6>Rol: <?php 
                                if($Gestiones->getIdRolUsuarios() == 1){
                                    echo "Administrador General";
                                }else if($Gestiones->getIdRolUsuarios() == 2){
                                    echo "Administrador de Laboratorios";
                                }else if($Gestiones->getIdRolUsuarios() == 3){
                                    echo "Docente";
                                }
                            ?></h6></a></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- user profile header end-->
                <div class="col-xl-3 col-lg-12 col-md-5 xl-35">
                  <div class="default-according style-1 faq-accordion job-accordion">
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="p-0">
                              <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">Sobre M&iacute;</button>
                            </h5>
                          </div>
                          <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                            <div class="card-body post-about">
                              <ul>
                                <li>
                                  <div class="icon"><i data-feather="user"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php echo $Gestiones->getCodigoUnicoUsuarios(); ?></h5>
                                    <p>C&oacute;digo Usuario</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="mail"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php echo $Gestiones->getCorreoUsuarios(); ?></h5>
                                    <p>Correo</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="phone"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php echo $Gestiones->getTelefonoPrincipal(); ?></h5>
                                    <p>Tel&eacute;fono Principal</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="paperclip"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php echo $Gestiones->getEstadoCivil(); ?></h5>
                                    <p>Estado C&iacute;vil</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="feather"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php 
                                        if($Gestiones->getGeneroUsuarios()== "m"){
                                            echo "Hombre";
                                        }else if($Gestiones->getGeneroUsuarios()== "f"){
                                            echo "Mujer";
                                        }
                                    ?></h5>
                                    <p>G&eacute;nero</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="calendar"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php 
                                        $Fecha = $Gestiones->getFechaNacimiento();
                                        $FechaCompleta = strtotime($Fecha);
                                        $ObtenerMes = date("m", $FechaCompleta);
                                        $ObtenerDia = date("d", $FechaCompleta);
                                        echo $ObtenerDia;
                                        echo " de ";
                                        // VALIDACIONES SEGUN MES OBTENIDO
                                        if ($ObtenerMes == 1) {
                                            echo "Enero";
                                        } else if ($ObtenerMes == 2) {
                                            echo "Febrero";
                                        } else if ($ObtenerMes == 3) {
                                            echo "Marzo";
                                        } else if ($ObtenerMes == 4) {
                                            echo "Abril";
                                        } else if ($ObtenerMes == 5) {
                                            echo "Mayo";
                                        } else if ($ObtenerMes == 6) {
                                            echo "Junio";
                                        } else if ($ObtenerMes == 7) {
                                            echo "Julio";
                                        } else if ($ObtenerMes == 8) {
                                            echo "Agosto";
                                        } else if ($ObtenerMes == 9) {
                                            echo "Septiembre";
                                        } else if ($ObtenerMes == 10) {
                                            echo "Octubre";
                                        } else if ($ObtenerMes == 11) {
                                            echo "Noviembre";
                                        } else if ($ObtenerMes == 12) {
                                            echo "Diciembre";
                                        }
                                        $ObtenerAnio = date("Y", $FechaCompleta);
                                        echo " ";
                                        echo $ObtenerAnio;
                                    ?></h5>
                                    <p>Fecha Nacimiento</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="database"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php 
                                        $Fecha = $Gestiones->getUltimoCambio_Contrasenia();
                                        $FechaCompleta = strtotime($Fecha);
                                        $ObtenerMes = date("m", $FechaCompleta);
                                        $ObtenerDia = date("d", $FechaCompleta);
                                        echo $ObtenerDia;
                                        echo " de ";
                                        // VALIDACIONES SEGUN MES OBTENIDO
                                        if ($ObtenerMes == 1) {
                                            echo "Enero";
                                        } else if ($ObtenerMes == 2) {
                                            echo "Febrero";
                                        } else if ($ObtenerMes == 3) {
                                            echo "Marzo";
                                        } else if ($ObtenerMes == 4) {
                                            echo "Abril";
                                        } else if ($ObtenerMes == 5) {
                                            echo "Mayo";
                                        } else if ($ObtenerMes == 6) {
                                            echo "Junio";
                                        } else if ($ObtenerMes == 7) {
                                            echo "Julio";
                                        } else if ($ObtenerMes == 8) {
                                            echo "Agosto";
                                        } else if ($ObtenerMes == 9) {
                                            echo "Septiembre";
                                        } else if ($ObtenerMes == 10) {
                                            echo "Octubre";
                                        } else if ($ObtenerMes == 11) {
                                            echo "Noviembre";
                                        } else if ($ObtenerMes == 12) {
                                            echo "Diciembre";
                                        }
                                        $ObtenerAnio = date("Y", $FechaCompleta);
                                        echo " ";
                                        echo $ObtenerAnio;
                                    ?></h5>
                                    <p>&Uacute;ltimo Cambio Contrase&ntilde;a</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="award"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;"><?php 
                                        $Fecha = $Gestiones->getFechaNacimiento();
                                        // CALCULAR EDAD ANTES DE CUMPLEAÑOS
                                        $FechaCumpleanos = new DateTime($Fecha);
                                        $Ahora = new DateTime();
                                        // COMPRUEBA SEGUN AÑO -> MES -> DIA
                                        $CalcularEdad = $Ahora->diff($FechaCumpleanos);
                                        echo $CalcularEdad->y;
                                        echo " A&ntilde;os";
                                    ?></h5>
                                    <p>Edad</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="icon"><i data-feather="shuffle"></i></div>
                                  <div>
                                    <h5 style="text-transform: lowercase;">
                                      <?php echo $Gestiones->getExtensionesUsuarios(); ?>
                                    </h5>
                                    <p>Extensiones Asignadas</p>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="col-xl-9 col-lg-12 col-md-7 xl-65">
                  <div class="row">
                  <!-- LABORATORIOS ASIGNADOS -->
                  <?php if($Gestiones->getIdRolUsuarios()==2){ ?>
                  <div class="col-sm-12">
                      <div class="card">
                        <div class="profile-post">
                          <div class="post-header">
                            <div class="media">
                            <div class="media-body align-self-center">
                                  <h5 class="user-name"> Laboratorios Asignados</h5>
                              </div>
                            </div>
                            <div class="post-setting"><i data-feather="cloud"></i></div>
                          </div>
                          
                          <div class="post-body">
                          <section class="cd-container" id="cd-timeline">
                            <?php if ($Gestiones->getLaboratorioAsignadoLab1() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 1</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio1(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab2() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 2</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio2(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab3() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 3</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio3(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab4() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 4</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio4(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab5() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 5</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio5(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab6() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 6</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio6(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab7() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 7</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio7(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab8() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 8</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio8(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab9() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 9</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio9(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab10() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 10</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio10(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab11() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 11</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio11(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab12() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 12</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio12(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab13() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 13</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio13(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab14() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 14</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio14(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                            <?php if ($Gestiones->getLaboratorioAsignadoLab15() == "si"){ ?>
                            <div class="cd-timeline-block">
                              <div class="cd-timeline-img cd-picture bg-primary"><i class="icofont icofont-license"></i></div>
                              <div class="cd-timeline-content">
                                <h4>Laboratorio<span class="digits"> 15</span></h4>
                                <p class="m-0"><?php echo $Gestiones->getUbicacionLaboratorio15(); ?></p></span>
                              </div>
                            </div>
                            <?php } ?>
                        </section>
                          </div>
                          </div>
                        </div>
                      </div>
                      <?php } ?>

                    <!-- ACCESOS -->
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="profile-post">
                          <div class="post-header">
                            <div class="media">
                            <div class="media-body align-self-center">
                                  <h5 class="user-name"> Accesos</h5>
                              </div>
                            </div>
                            <div class="post-setting"><i data-feather="cloud"></i></div>
                          </div>
                          <div class="post-body">
                          <div class="dt-ext table-responsive">
                                    <table class="display" id="accesos-usuarios-registrados">
                                        <thead>
                                        <tr>
                                        <th>#</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Fecha Salida</th>
                                            <th>Duraci&oacute;n</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                          $NumeroSesion = 1;
                                          while ($filas = mysqli_fetch_array($consulta3)){
                                            echo "
                                              <tr>
                                                <td><span class='badge rounded-pill badge-info'>".$NumeroSesion."</span></td>
                                                <td>".$filas['fecha_ingreso']."</td>
                                                <td>"; 
                                                  if(empty($filas['fecha_cierresesion'])){
                                                    echo "----/--/--";
                                                  }else{
                                                    echo $filas['fecha_cierresesion'];
                                                  }
                                                echo"</td>
                                                <td>"; 
                                                  if(empty($filas['duracion_sesion'])){
                                                    echo "<span class='badge rounded-pill badge-danger'>Sin Registro</span>";
                                                  }else{
                                                    echo "<span class='badge rounded-pill badge-success'>".$filas['duracion_sesion']." Minutos</span>";
                                                  }
                                                echo"</td>
                                              </tr>
                                            ";
                                            $NumeroSesion++;
                                          }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha Ingreso</th>
                                            <th>Fecha Salida</th>
                                            <th>Duraci&oacute;n</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                          </div>
                          </div>
                          </div>
                        </div>
                      </div>
                 
                    <!-- profile post end-->
                  </div>
                </div>
              </div>
            </div>
          </div>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/dashboard/default.js"></script>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-modificar-configuracion-perfil-usuarios.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-modificar-detalles-usuarios-perfil-usuarios.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/tooltip-init.js"></script>
    <!-- Dropzone JavaScript -->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/dropzone/dist/dropzone.js"></script>
    <!-- Dropify JavaScript -->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/dropify/dist/js/dropify.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/dropzone/dropzone-configuration.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/jszip.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/pdfmake.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/vfs_fonts.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.select.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/buttons.print.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datatable/datatable-extension/custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/Configuracion_Datatable_AccesosMiPerfil.js"></script>
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