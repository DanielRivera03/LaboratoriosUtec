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
    <title><?php echo $TituloPrincipal; ?> Portal Administradores</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/chartist.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/prism.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/vector-map.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?php echo $UrlGlobal; ?>Vista/assets/css/color-7.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/whether-icon.css">
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
    <!-- page-wrapper Start       -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <?php
        // IMPORTANDO HEADER PRINCIPAL -> MENU DE NAVEGACION SUPERIOR
        require('../Vista/Header/HeaderPrincipal.php');
      ?>
      
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <?php 
            // IMPORTANDO MENU DE NAVEGACION -> VALIDO SOLO ADMINISTRADOR GENERAL
            require('../Vista/MenuNavegacion/menu_administradores.php');
          ?>
          
        </header>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-default-sec">
            <div class="row">
            <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">
            <div class="col-sm-12 col-xl-12 col-lg-12">
                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="thumbs-up"></i></div>
                      <div class="media-body"><span class="m-0">Portal Coordinador de Laboratorios Bienvenido(a)</span>
                        <h6 class="mb-0"><?php echo $_SESSION['usuario_unico'] ?></h6><i class="icon-bg" data-feather="home"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user"></i></div>
                      <div class="media-body"><span class="m-0">Total Administradores Laboratorios</span>
                        <h4 class="mb-0" id="totaladminlaboratorios">0</h4><i class="icon-bg" data-feather="user"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card o-hidden border-0">
                  <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                      <div class="media-body"><span class="m-0">Total Docentes</span>
                        <h4 class="mb-0" id="totaldocentes">0</h4><i class="icon-bg" data-feather="user-plus"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                      <div class="media-body"><span class="m-0">Total Aplicaciones Registradas</span>
                        <h4 class="mb-0" id="totalaplicaciones">0</h4><i class="icon-bg" data-feather="airplay"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-6 col-lg-6">
                <div class="card o-hidden border-0">
                  <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                      <div class="align-self-center text-center"><i data-feather="alert-circle"></i></div>
                      <div class="media-body"><span class="m-0">Total Laboratorios Inactivos</span>
                        <h4 class="mb-0" id="totallabsinactivos">0</h4><i class="icon-bg" data-feather="alert-circle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 xl-100 box-col-12">
                <div class="card">
                  <div class="cal-date-widget card-body">
                    <div class="row">
                      <div class="col-xl-6 col-xs-6 col-md-6 col-sm-6">
                        <div class="cal-info text-center">
                          <div>
                            <h2><?php echo date("d"); ?></h2>
                            <div class="d-inline-block"><span class="b-r-dark pe-3">
                              <?php
                                if(date("M")=="Jan"){
                                  echo "Enero";
                                }else if(date("M")=="Feb"){
                                  echo "Febrero";
                                }if(date("M")=="Mar"){
                                  echo "Marzo";
                                }else if(date("M")=="Apr"){
                                  echo "Abril";
                                }else if(date("M")=="May"){
                                  echo "Mayo";
                                }else if(date("M")=="Jun"){
                                  echo "Junio";
                                }else if(date("M")=="Jul"){
                                  echo "Julio";
                                }else if(date("M")=="Aug"){
                                  echo "Agosto";
                                }else if(date("M")=="Sep"){
                                  echo "Septiembre";
                                }else if(date("M")=="Oct"){
                                  echo "Octubre";
                                }else if(date("M")=="Nov"){
                                  echo "Noviembre";
                                }else if(date("M")=="Dec"){
                                  echo "Diciembre";
                                } 
                              ?>
                            </span><span class="ps-3"><?php echo date("Y"); ?></span></div>
                            <p class="f-16">Hola estimado(a), <?php echo $_SESSION["usuario_unico"]; ?> </strong> bienvenido(a) .</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-xs-6 col-md-6 col-sm-6">
                        <div class="cal-datepicker">
                          <div class="datepicker-here float-sm-end" data-language="en">           </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 xl-50 col-sm-6 box-col-6">
                <div class="card">
                  <div 
                  <?php 
                    if($hora->format('G')>=17 && $hora->format('G')<18){
                      echo '
                      style="background-image: url('; echo $UrlGlobal; echo'Vista/assets/images/banner/France-sunset.gif); background-size: 100% 100%; background-color: #4036;"
                      ';
                    }else if($hora->format('G')>=18 && $hora->format('G')<=23 || $hora->format('G')>=0 && $hora->format('G')<6){
                      echo '
                      style="background-image: url('; echo $UrlGlobal; echo'Vista/assets/images/banner/France-night.gif); background-size: 100% 100%; background-color: #4036;"
                      ';
                    }else if($hora->format('G')>=6 && $hora->format('G')<17){
                      echo '
                      style="background-image: url('; echo $UrlGlobal; echo'Vista/assets/images/banner/France-day.gif); background-size: 100% 100%; background-color: #4036;"
                      ';
                    }
                  ?>
                  class="mobile-clock-widget">
                    <div class="bg-svg">
                      <?php 
                        if($hora->format('G')>=18 && $hora->format('G')<=23 || $hora->format('G')>=0 && $hora->format('G')<5){
                          echo '
                          <svg class="climacon climacon_cloudMoonFill" id="cloudMoonFill" version="1.1" viewBox="15 15 70 70">
                          <g class="climacon_iconWrap climacon_iconWrap-cloudMoonFill">
                          <g class="climacon_wrapperComponent climacon_wrapperComponent-moon climacon_componentWrap-moon_cloud">
                          <path class="climacon_component climacon_component-stroke climacon_component-stroke_moon" 
                          d="M61.023,50.641c-6.627,0-11.999-5.372-11.999-11.998c0-6.627,5.372-11.999,11.999-11.999c0.755,0,1.491,0.078,2.207,0.212c-0.132,0.576-0.208,
                          1.173-0.208,1.788c0,4.418,3.582,7.999,8,7.999c0.614,0,1.212-0.076,1.788-0.208c0.133,0.717,0.211,1.452,0.211,2.208C73.021,45.269,67.649,50.641,
                          61.023,50.641z"></path><path class="climacon_component climacon_component-fill climacon_component-fill_moon" fill="#FFFFFF" 
                          d="M59.235,30.851c-3.556,0.813-6.211,3.989-6.211,7.792c0,4.417,3.581,7.999,7.999,7.999c3.802,0,6.979-2.655,7.791-6.211C63.961,
                          39.527,60.139,35.705,59.235,30.851z"></path></g><g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                          <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M44.033,65.641c-8.836,
                          0-15.999-7.162-15.999-15.998c0-8.835,7.163-15.998,15.999-15.998c6.006,0,11.233,3.312,13.969,8.203c0.664-0.113,1.338-0.205,
                          2.033-0.205c6.627,0,11.998,5.373,11.998,12c0,6.625-5.371,11.998-11.998,11.998C57.26,65.641,47.23,65.641,44.033,65.641z">
                          </path><path class="climacon_component climacon_component-fill climacon_component-fill_cloud" fill="#FFFFFF" 
                          d="M60.035,61.641c4.418,0,8-3.582,8-7.998c0-4.418-3.582-8-8-8c-1.6,0-3.082,0.481-4.334,1.291c-1.23-5.316-5.976-9.29-11.668-9.29c-6.627,
                          0-11.999,5.372-11.999,11.999c0,6.627,5.372,11.998,11.999,11.998C47.65,61.641,57.016,61.641,60.035,61.641z"></path></g></g></svg>                     
                          ';
                        }
                      ?>
                    </div>
                    <div>
                      <ul class="clock" id="clock">
                        <li class="hour" id="hour"></li>
                        <li class="min" id="min"></li>
                        <li class="sec" id="sec"></li>
                      </ul>
                      <div class="date f-24 mb-2" id="date">
                        <?php 
                          if($hora->format('G')>=18 && $hora->format('G')<=23 || $hora->format('G')>=0 && $hora->format('G')<6){
                            echo "Buenas Noches";
                          }else if($hora->format('G')>=6 && $hora->format('G')<12){
                            echo "Buenos D&iacute;as";
                          }else if($hora->format('G')>=12 && $hora->format('G')<18){
                            echo "Buenas Tardes";
                          }
                        ?>
                      </div>
                      <div>
                        <p class="m-0 f-14 text-light">San Salvador, El Salvador</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 xl-50 col-sm-6 box-col-6">
                <div class="card">
                  <div class="weather-widget-two">
                    <div class="card-body">
                      <div class="media">
                        
                        
                        
                        <!-- cloudDrizzle-->
                        <div class="media-body align-self-center text-white">
                          <p class="m-0 f-14">Temperatura Actual</p>
                          <h4 class="m-0 f-w-600 num"><?php echo number_format($data->main->temp, 1) ?> &deg;C</h4>
                          <?php 
                            // RANGO DE HORAS DESDE 06:00 HASTA 18:00 [A.M -> P.M -> [[DIA]]]
                              if ($hora->format('G') >= 6 && $hora->format('G') < 18) {
                                if (strtolower(ucwords($data->weather[0]->description)) == "broken clouds") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/cloudy.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "clear sky") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/clear-day.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "few clouds") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-day.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "scattered clouds") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/haze-day.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-day-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-day-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-day-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-day-extreme.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-day.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-day-extreme.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-day.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/partly-cloudy-day-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain and drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy shower rain and drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "moderate rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "very heavy rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "extreme rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "overcast clouds") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/partly-cloudy-day.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "mist") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/mist.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "smoke") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-day-smoke.svg" alt="icono-clima-dia"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "haze") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-day-haze.svg" alt="icono-clima-dia"/></div>';
                                }
                                // RANGO DE HORAS DESDE 18:00 HASTA 5:00 [P.M -> A.M -> [[NOCHE]]]
                              } else if ($hora->format('G') >= 0 && $hora->format('G') <= 5 || $hora->format('G') >= 18 && $hora->format('G') <= 23) {
                                if (strtolower(ucwords($data->weather[0]->description)) == "broken clouds") {
                                  echo '<div style="margin-left: .5rem;width:230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/cloudy.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "clear sky") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/clear-night.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "few clouds") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-night.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "scattered clouds") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/haze-night.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-night-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-night-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-night-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-night-extreme.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-night.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-night-extreme.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged thunderstorm") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-night.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/thunderstorms-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/partly-cloudy-night-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain and drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy shower rain and drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower drizzle") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "moderate rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "very heavy rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "extreme rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged shower rain") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "overcast clouds") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/partly-cloudy-night.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "mist") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/mist.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "smoke") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-night-smoke.svg" alt="icono-clima-noche"/></div>';
                                } else if (strtolower(ucwords($data->weather[0]->description)) == "haze") {
                                  echo '<div style="margin-left: .5rem;width: 230px; height: 150px;" class="wi-icon"><img src="';
                                  echo $UrlGlobal;
                                  echo 'Vista/assets/images/icon-weather/extreme-night-haze.svg" alt="icono-clima-noche"/></div>';
                                }
                              }
                          ?>
                          <p class="m-0 f-14"></p>
                        </div>
                      </div>
                      <div class="top-bg-whether">
                        <svg class="climacon climacon_cloudHailAltFill" id="cloudHailAltFill" version="1.1" viewBox="15 15 70 70">
                          <g class="climacon_iconWrap climacon_iconWrap-cloudHailAltFill">
                            <g class="climacon_wrapperComponent climacon_wrapperComponent-hailAlt">
                              <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left">
                                <circle cx="42" cy="65.498" r="2"></circle>
                              </g>
                              <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle">
                                <circle cx="49.999" cy="65.498" r="2"></circle>
                              </g>
                              <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right">
                                <circle cx="57.998" cy="65.498" r="2"></circle>
                              </g>
                              <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left">
                                <circle cx="42" cy="65.498" r="2"></circle>
                              </g>
                              <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle">
                                <circle cx="49.999" cy="65.498" r="2"></circle>
                              </g>
                              <g class="climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right">
                                <circle cx="57.998" cy="65.498" r="2"></circle>
                              </g>
                            </g>
                            <g class="climacon_componentWrap climacon_componentWrap_cloud">
                              <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M43.945,65.639c-8.835,0-15.998-7.162-15.998-15.998c0-8.836,7.163-15.998,15.998-15.998c6.004,0,11.229,3.312,13.965,8.203c0.664-0.113,1.338-0.205,2.033-0.205c6.627,0,11.998,5.373,11.998,12c0,6.625-5.371,11.998-11.998,11.998C57.168,65.639,47.143,65.639,43.945,65.639z"></path>
                              <path class="climacon_component climacon_component-fill climacon_component-fill_cloud" fill="#FFFFFF" d="M59.943,61.639c4.418,0,8-3.582,8-7.998c0-4.417-3.582-8-8-8c-1.601,0-3.082,0.481-4.334,1.291c-1.23-5.316-5.973-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,11.999c0,6.626,5.372,11.998,11.998,11.998C47.562,61.639,56.924,61.639,59.943,61.639z"></path>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="bottom-whetherinfo">
                        <div class="row">
                          <div class="col-6"><i data-feather="cloud-drizzle"></i></div>
                          <div class="col-6">
                            <div class="whether-content"><span>Humedad</span>
                              <h6 class="num mb-1"><?php echo $data->main->humidity; ?>%</h6>
                            </div>
                            <div class="whether-content"><span>Viento</span>
                              <h6 class="num mb-0"><?php echo $data->wind->speed; ?> KM/H</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Pr&oacute;ximas Actividades Laboratorios</h5>
                  </div>
                  <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                      <div class="table-responsive">
                        <table class="table">
                          <thead class="bg-primary">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">C&oacute;digo</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Docente</th>
                              <th scope="col">Fecha</th>
                              <th scope="col">Hora</th>
                              <th scope="col">Estado</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              while ($filas = mysqli_fetch_array($consulta2)){
                                echo '
                                <tr>
                                <th scope="row">Lab'.$filas["idlaboratorio"].'</th>
                                <td>'.$filas["codigoreservacion"].'</td>
                                <td>'.$filas["nombrereservacion"].'</td>
                                <td>'.$filas["nombres"].' '.$filas["apellidos"].'</td>
                                <td>';
                                // NUEVO FORMATO FECHA
                                $FechaOriginal = $filas["fechainicioreservacion"];
                                $NuevoFormatoFecha = date('d-m-Y', strtotime($FechaOriginal));
                                echo $NuevoFormatoFecha;
                                echo'</td>
                                <td>';
                                // NUEVO FORMATO HORAS
                                $HoraInicioOriginal = $filas["horainicioreservacion"];
                                $NuevaHoraInicio = substr($HoraInicioOriginal, 0, 5);
                                $HoraFinOriginal = date('H:i', strtotime($filas["horafinreservacion"]) + 60);
                                $NuevaHoraFin = substr($HoraFinOriginal, 0, 5);
                                echo $NuevaHoraInicio; echo "-"; echo $NuevaHoraFin;
                                echo'</td>
                                <td>'; 
                                  echo '<span class="badge rounded-pill badge-primary">En Curso</span>';
                                echo'</td>
                              </tr>
                                
                                ';
                              }
                            ?>        
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="container-fluid">
                <div class="row">
                  <!-- APROBADAS -->
                  <div class="col-xl-4 col-md-12 box-col-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h6>Reservaciones Aprobadas (2023)</h6>
                      </div>
                      <div class="card-body chart-block">
                        <canvas id="ReservacionesAprobadas"></canvas>
                        <button class="btn btn-pill btn-outline-primary btn-air-primary btn-xs" onclick="ImpresionGraficoReservacionesAprobadas()" type="button"><i class="icon-printer"></i> Imprimir</button>
                      </div>
                    </div>
                  </div>
                  <!-- DENEGADAS -->
                  <div class="col-xl-4 col-md-12 box-col-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h6>Reservaciones Denegadas (2023)</h6>
                      </div>
                      <div class="card-body chart-block">
                        <canvas id="ReservacionesDenegadas"></canvas>
                        <button class="btn btn-pill btn-outline-primary btn-air-primary btn-xs" onclick="ImpresionGraficoReservacionesDenegadas()" type="button"><i class="icon-printer"></i> Imprimir</button>
                      </div>
                    </div>
                  </div>
                  <!-- CANCELADAS -->
                  <div class="col-xl-4 col-md-12 box-col-12">
                    <div class="card">
                      <div class="card-header pb-0">
                        <h6>Reservaciones Canceladas (2023)</h6>
                      </div>
                      <div class="card-body chart-block">
                        <canvas id="ReservacionesCanceladas"></canvas>
                        <button class="btn btn-pill btn-outline-primary btn-air-primary btn-xs" onclick="ImpresionGraficoReservacionesCanceladas()" type="button"><i class="icon-printer"></i> Imprimir</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-sm-12 box-col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Reservaciones Por Facultades</h5>
                  </div>
                  <div class="card-body chart-block">
                    <div class="chart-overflow" id="combo-chart"></div>
                    <button class="btn btn-pill btn-outline-primary btn-air-primary btn-xs" onclick="ImpresionGraficoReservacionesAprobadasPorFacultad()" type="button"><i class="icon-printer"></i> Imprimir</button>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/prism/prism.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/clipboard/clipboard.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/counter/counter-custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/custom-card/custom-card.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/general-widget.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/height-equal.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/script.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/theme-customizer/customizer.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/reloj.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
    </script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/chart/chartjs/chart.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorGraficosInicioCoordinadorGeneralReservaciones.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ConteoInicialInicioCoordinadoresLaboratorios.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/chart/google/google-chart-loader.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorGraficosInicioGeneralReservacionesPorFacultades.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/sweet-alert/sweetalert.min.js"></script>
		<script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorNotificacionesSweetAlert2.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/ControladorImpresionGraficosInicio.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <?php 
      /** -> IMPORTAR CONTROLADOR DE INACTIVIDAD SESIONES */
      require_once('../Vista/ControlSesionesInactividad/ControladorInactividadSesionesUsuarios.php');
    ?>
  </body>
</html>
<?php } ?>