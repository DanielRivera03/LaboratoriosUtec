<?php 
  // DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA EL SALVADOR (UTC-6)
  setlocale(LC_TIME, "spanish");
  date_default_timezone_set('America/El_Salvador');
  // OBTENER HORA LOCAL
  $hora = new DateTime("now");
  // NO PERMITIR VISTA SI EL PARAMETRO DE LABORATORIO NO ES IGUAL A PARAMETRO DE SOLICITUD
  if($_GET['laboratorio']!=$Gestiones->getIdLaboratorio()){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI EL PARAMETRO DE CODIGO UNICO RESERVACION NO ES IGUAL A PARAMETRO DE SOLICITUD
  if($_GET['identificador_reservacion']!=$Gestiones->getCodigoUnicoIdentificadorReservacion()){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI EL PARAMETRO DE ESTADO NO ES IGUAL A [PENDIENTE]
  if($Gestiones->getEstadoReservacion()!="pendiente"){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
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
    <title><?php echo $TituloPrincipal; ?> Gesti&oacute;n Reservaci&oacute;n <?php echo $Gestiones->getCodigoUnicoIdentificadorReservacion(); ?></title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/datatable-extension.css">
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
                  <h3>Gestionar Reservaciones</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Inicio</a></li>
                    <li class="breadcrumb-item">Reservaciones</li>
                    <li class="breadcrumb-item">Gestionar Reservaciones</li>
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
                        <div class="row learning-block">
                            <div class="col-xl-12 xl-12">
                                <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="card">
                                    <div class="blog-box blog-list row">
                                        <div class="col-xl-5 col-12"><img class="img-fluid sm-100-w" src="<?php echo $UrlGlobal; ?>Vista/assets/images/laboratorios-reservacion.jpg" alt=""></div>
                                        <div class="col-xl-7 col-12">
                                        <div class="blog-details">
                                            <h6 style="background-color: #000; color: #fff; text-align: center;">Datos Generales Reservaci&oacute;n Procesada:</h6>
                                            <h6><?php echo $Gestiones->getNombreReservacion(); ?> [<?php echo $Gestiones->getCodigoReservacion(); ?>]</h6></a>
                                            <div class="blog-date"><b>* Laboratorio N&uacute;mero <?php echo $Gestiones->getIdLaboratorio(); ?> Inform&aacute;tica</b></div>
                                            <div class="blog-date"><b>Identificador:</b> <span style="font-size: .9rem;"><?php echo $Gestiones->getCodigoUnicoIdentificadorReservacion(); ?></span></div>
                                            <div class="blog-date"><b>Aplicaci&oacute;n:</b> <?php echo $Gestiones->getNombreAplicacion(); ?></div>
                                            <div class="blog-date"><b>Facultad:</b> <?php echo $Gestiones->getNombreFacultadReservacion(); ?></div>
                                            <div class="blog-date"><b>Escuela:</b> <?php echo $Gestiones->getNombreEscuelaReservacion(); ?></div>
                                            <div class="blog-date"><b>Docente:</b> <?php if($Gestiones->getEstadoTitularReservacion()=="no"){
                                              if(empty($Gestiones->getNombreOtroTitularReservacion())){echo "Desconocido";}
                                              else{echo $Gestiones->getNombreOtroTitularReservacion();}
                                              }else{echo $Gestiones->getNombresUsuarios(); echo " "; echo $Gestiones->getApellidosUsuarios(); echo"["; echo $Gestiones->getCodigoUnicoUsuarios(); echo "]";} ?></div>
                                            <div class="blog-date"><b>Cantidad:</b> <?php echo $Gestiones->getCantidadUsuariosReservacion(); ?> Usuarios</div>
                                            <div class="blog-date"><b>Aula Procedencia:</b> <?php if(empty($Gestiones->getAulaProcedenciaReservacion())){echo "Desconocido";}else{echo $Gestiones->getAulaProcedenciaReservacion();} ?></div>
                                            <?php 
                                              if($Gestiones->getIdLaboratorio() == 3){
                                            ?>
                                            <div class="blog-date"><b>M&oacute;dulo 1:</b> <?php echo $Gestiones->getCantidadModulo1(); ?> Usuarios</div>
                                            <div class="blog-date"><b>M&oacute;dulo 2:</b> <?php echo $Gestiones->getCantidadModulo2(); ?> Usuarios</div>
                                            <div class="blog-date"><b>M&oacute;dulo 3:</b> <?php echo $Gestiones->getCantidadModulo3(); ?> Usuarios</div>
                                            <div class="blog-date"><b>M&oacute;dulo 4:</b> <?php echo $Gestiones->getCantidadModulo4(); ?> Usuarios</div>
                                            <?php 
                                              }else if($Gestiones->getIdLaboratorio() == 8){
                                            ?>
                                            <div class="blog-date"><b>M&oacute;dulo 1:</b> <?php echo $Gestiones->getCantidadModulo1(); ?> Usuarios</div>
                                            <div class="blog-date"><b>M&oacute;dulo 2:</b> <?php echo $Gestiones->getCantidadModulo2(); ?> Usuarios</div>
                                            <div class="blog-date"><b>M&oacute;dulo 3:</b> <?php echo $Gestiones->getCantidadModulo3(); ?> Usuarios</div>
                                            <?php 
                                              }else if($Gestiones->getIdLaboratorio() == 14){
                                            ?>
                                            <div class="blog-date"><b>M&oacute;dulo 1:</b> <?php echo $Gestiones->getCantidadModulo1(); ?> Usuarios</div>
                                            <div class="blog-date"><b>M&oacute;dulo 2:</b> <?php echo $Gestiones->getCantidadModulo2(); ?> Usuarios</div>
                                            <?php } ?>
                                            <div class="blog-bottom-content">
                                            <hr>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="dt-ext table-responsive mb-3">
                                    <table class="display" id="consulta-reservaciones-pendientes-gestionreservaciones">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th>Docente</th>
                                            <th>Secci&oacute;n</th>
                                            <th>Ciclo</th>
                                            <th>Aula</th>
                                            <th>Laboratorio</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                          $ContadorReservaciones = 1;
                                          while ($filas = mysqli_fetch_array($consulta4)){
                                            // FORMATO DD-MM-YYYY FECHA INICIO
                                            $FechaInicioOriginal = $filas['fechainicioreservacion'];
                                            $NuevoFormatoFechaInicio = date('d/m/Y', strtotime($FechaInicioOriginal)); 
                                            // FORMATO DD-MM-YYYY FECHA FIN
                                            $FechaFinOriginal = $filas['fechafinreservacion'];
                                            $NuevoFormatoFechaFin = date('d/m/Y', strtotime($FechaFinOriginal)); 
                                            echo '
                                              <tr>
                                                <td>'.$ContadorReservaciones.'</td>
                                                <td>'.$NuevoFormatoFechaInicio.'</td>
                                                <td>'.$NuevoFormatoFechaFin.'</td>
                                                <td>'.$filas['horainicioreservacion'].'</td>
                                                <td>'.date('H:i:s', strtotime($filas['horafinreservacion'] . ' +1 minute')).'</td>
                                                <td>'; 
                                                  if($filas['titular_reservacion']=="no"){
                                                    if(empty($filas['nombre_otrotitular'])){
                                                      echo "Desconocido";
                                                    }else{
                                                      echo $filas['nombre_otrotitular'];
                                                    }
                                                  }else{
                                                    echo $filas['nombres']." ".$filas['apellidos'];
                                                  }
                                                echo'</td>
                                                <td>'.$filas['seccionreservacion'].'</td>
                                                <td>'.$filas['ciclo'].'</td>
                                                <td>'.$filas['aula_procedencia'].'</td>
                                                <td>'.$filas['codigolaboratorio'].'</td>
                                              </tr>
                                            ';
                                            $ContadorReservaciones++;
                                          }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th>Docente</th>
                                            <th>Secci&oacute;n</th>
                                            <th>Ciclo</th>
                                            <th>Aula</th>
                                            <th>Laboratorio</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            <div class="alert alert-primary inverse fade show" role="alert"><i class="icon-alert txt-white"></i>
                            <p>Atenci&oacute;n: <b><?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2); print_r($PrimerNombre[0]); ?></b>, en base a la informaci&oacute;n procesada por el usuario <?php echo $Gestiones->getCodigoUnicoUsuarios(); ?>,
                            por favor verifique que esta solicitud no conlleva a ning&uacute;n conflicto con otra reservaci&oacute;n ya aprobada en las fechas, horas y laboratorio estipulados. A continuaci&oacute;n le mostramos el calendario de actividades de todas las reservaciones aprobadas 
                            en el laboratorio <?php echo $Gestiones->getIdLaboratorio();?>.</p>
                        </div>
                            <div class="container-fluid calendar-basic">
                            <button class="btn btn-primary" type="button">Calendario Actividades Laboratorio <?php echo $Gestiones->getIdLaboratorio(); ?> <span class="badge rounded-pill badge-light text-dark"><i data-feather="calendar"></i></span></button>
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
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="alert alert-danger" role="alert">
                              <h4 class="alert-heading">¡Importante!</h4>
                              <p>En base a toda la informaci&oacute;n presentada, usted debe seleccionar si esta solicitud ser&aacute; aprobada o denegada. <b>Le recordamos que en caso de ser aprobada, esta solicitud
                                pasa a revisi&oacute;n de parte del coordinador de laboratorios. S&iacute; por alg&uacute;n motivo el titular de esta reservaci&oacute;n le notifica que la misma debe ser cancelada, usted 
                                debe seleccionar esa opci&oacute;n
                              </b></p>
                              <hr>
                              <p class="mb-0">* El comentario de retroalimentaci&oacute;n es obligatorio.</p>
                            </div>
                            
                            <hr>

                            <div class="ribbon ribbon-clip ribbon-primary"><i class="icofont icofont-ssl-security"></i> Gestionar Reservaciones</div>
                                <div class="card-body">
                                    <form id="frm_actualizacioninicial_reservaciones" class="form-space theme-form row needs-validation" novalidate="" autocomplete="off" method="post">
                                        <input type="hidden" id="txtCodigoIdentificadorUnico" name="txtCodigoIdentificadorUnico" value="<?php echo $Gestiones->getCodigoUnicoIdentificadorReservacion(); ?>">
                                        <!-- ESTADO SOLICITUD RESERVACION -->
                                        <div class="col-sm-12">
                                            <div class="mb-4">
                                                <label class="form-label">En base a la informaci&oacute;n ¿Qu&eacute; procede? Seleccione un estado <span style="color: var(--bs-danger);">(*)</span></label>
                                                <select class="form-select digits input-air-primary form-control-lg" id="sltestadoinicial_reservaciones" name="sltestadoinicial_reservaciones" required="">
                                                    <option value="">Seleccione un estado...</option>
                                                    <option value="aprobacioninicial">Solicitud Reservaci&oacute;n Aprobada (Aprobaci&oacute;n Inicial)</option>
                                                    <option value="denegada">Solicitud Reservaci&oacute;n Denegada</option>
                                                    <option value="cancelado">Cancelar Solicitud Reservaci&oacute;n</option>
                                                </select>
                                                <div class="invalid-feedback">Por favor seleccione un estado.</div>
                                            </div>
                                        </div>
                                        <?php 
                                          if($Gestiones->getEstadoTitularReservacion()=="no"){
                                        ?>
                                        <!-- NOMBRE OTRO TITULAR -->
                                        <div class="col-sm-12">
                                            <div class="mb-4">
                                            <label class="form-label">El nombre del t&iacute;tular de esta reservaci&oacute;n es desconocido. Si lo conoce ingrese su nombre <span style="color: var(--bs-blue);">(No Obligatorio)</span></label>
                                                <input type="text" class="form-control input-air-primary form-control-lg" id="txtnombreotrotitular_reservaciones" name="txtnombreotrotitular_reservaciones" placeholder="Ingrese el nombre del t&iacute;tular..." aria-describedby="inputGroupPrepend">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- COMENTARIO RETROALIMENTACION -->
                                        <div class="col-sm-12">
                                            <div class="mb-2">
                                                <label class="form-label">Comentario Retroalimentaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                                <textarea class="form-control input-air-primary form-control-lg" id="txtcomentarioinicial_reservaciones" name="txtcomentarioinicial_reservaciones" rows="4" placeholder="Ingrese el comentario de retroalimentaci&oacute;n de esta solicitud..." aria-describedby="inputGroupPrepend" required=""><?php echo $Gestiones->getDescripcionRolUsuario(); ?></textarea>
                                                <div class="invalid-feedback">Por favor ingrese el comentario de retroalimentaci&oacute;n.</div>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-actualizacion-inicial-reservaciones.js"></script>
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
        while ($filas = mysqli_fetch_array($consulta5)){
      ?>
      var Reservacion_<?php echo $ContadorReservaciones ?> = new ScheduleInfo();
      Reservacion_<?php echo $ContadorReservaciones ?>.id = '<?php echo $filas['idreservacion']; ?>';
      Reservacion_<?php echo $ContadorReservaciones ?>.calendarId = '<?php echo $filas['idlaboratorio']; ?>';
      Reservacion_<?php echo $ContadorReservaciones ?>.title = '<?php echo $filas['nombrereservacion']; ?>';
      Reservacion_<?php echo $ContadorReservaciones ?>.location = '<?php echo $filas['numerousuarios']; ?> Personas';
      Reservacion_<?php echo $ContadorReservaciones ?>.state = '<?php if($filas['titular_reservacion']=="si"){echo $filas['nombres']; ?> <?php echo $filas['apellidos'];}else{ echo "Desconocido";}  ?> [<?php echo $filas['codigoreservacion']; ?>]';
      Reservacion_<?php echo $ContadorReservaciones ?>.body = "Tipo: <b><?php echo $filas['tiporeservacion']; ?></b>" + 
      "<br>Secci&oacute;n: <b><?php if($filas['seccionreservacion']==0){echo "Ninguna";}elseif ($filas['seccionreservacion']>=1 && $filas['seccionreservacion']<=9){echo '0'.$filas['seccionreservacion'];}else{echo $filas['seccionreservacion'];}?></b> " +
      <?php if($filas['idlaboratorio']==3){ ?>
        "<br>M&oacute;dulo 1: <b><?php echo $filas['mod1']?> personas</b> " +
        "<br>M&oacute;dulo 2: <b><?php echo $filas['mod2']?> personas</b> " +
        "<br>M&oacute;dulo 3: <b><?php echo $filas['mod3']?> personas</b> " +
        "<br>M&oacute;dulo 4: <b><?php echo $filas['mod4']?> personas</b> " +
      <?php }else if($filas['idlaboratorio']==8){?>
        "<br>M&oacute;dulo 1: <b><?php echo $filas['mod1']?> personas</b> " +
        "<br>M&oacute;dulo 2: <b><?php echo $filas['mod2']?> personas</b> " +
        "<br>M&oacute;dulo 3: <b><?php echo $filas['mod3']?> personas</b> " +
      <?php }else if($filas['idlaboratorio']==14){ ?>
        "<br>M&oacute;dulo 1: <b><?php echo $filas['mod1']?> personas</b> " +
        "<br>M&oacute;dulo 2: <b><?php echo $filas['mod2']?> personas</b> " +
      <?php } ?>
      "<br>Aula Procedencia: <b><?php echo $filas['aula_procedencia']?></b> " +
      "<br>Aplicaci&oacute;n: <b><?php echo $filas['nombreaplicacion'] ?></b>";
      Reservacion_<?php echo $ContadorReservaciones ?>.category = 'time';
      Reservacion_<?php echo $ContadorReservaciones ?>.start = new Date("<?php echo $filas['fechainicioreservacion']; ?>T<?php echo $filas['horainicioreservacion']; ?>");
      Reservacion_<?php echo $ContadorReservaciones ?>.end = new Date("<?php echo $filas['fechafinreservacion']; ?>T<?php echo date('H:i:s', strtotime($filas['horafinreservacion'] . ' +1 minute')); ?>");
    <?php $ContadorReservaciones++; } ?>
      function generateSchedule(viewName, renderStart, renderEnd) {
          ScheduleList = [];
          <?php 
          $ContadorReservacionesRender = 1;
          //-> TODAS LAS RESERVACIONES REGISTRADAS [IMPRESION EN CALENDARIO (RENDER)]
          while ($filas = mysqli_fetch_array($consulta6)){
          ?>
          ScheduleList.push(Reservacion_<?php echo $ContadorReservacionesRender; ?>);
          <?php $ContadorReservacionesRender++; } ?>
      }
    </script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/app.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
    </script>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/Configuracion_Datatable_ReservacionesPendientesGestiones.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <?php 
      /** -> IMPORTAR CONTROLADOR DE INACTIVIDAD SESIONES */
      require_once('../Vista/ControlSesionesInactividad/ControladorInactividadSesionesUsuarios.php');
    ?>
  </body>
</html>
<?php } ?>