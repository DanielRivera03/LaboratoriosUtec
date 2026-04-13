<?php 
  // DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA EL SALVADOR (UTC-6)
  setlocale(LC_TIME, "spanish");
  date_default_timezone_set('America/El_Salvador');
  // OBTENER HORA LOCAL
  $hora = new DateTime("now");
  //-> PARA OBTENER DIAS DE RESERVACION
  $ObtenerDiaInicio = date('N', strtotime($FechaInicioReservacion));
  $ObtenerDiaFin = date('N', strtotime($FechaFinReservacion));
  // VALIDACION DE PARAMETRO gestioneslaboratorios -> SI NO EXISTE MOSTRAR PAGINA 404 ERROR
  if (!isset($_GET['gestioneslaboratorios'])) {
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=error-404');
  }
  // NO PERMITIR INGRESO SIN INICIAR SESION
  if(!isset($_SESSION['id_usuario'])){
    header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
  }
  // NO PERMITIR VISTA SI FECHA DE INICIO RESERVACION SE ENCUENTRA VACIO
  if(empty($FechaInicioReservacion)){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI FECHA DE FIN RESERVACION SE ENCUENTRA VACIO
  if(empty($FechaFinReservacion)){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
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
    <title><?php echo $TituloPrincipal; ?> Registrar Nueva Reservaci&oacute;n</title>
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
    <style>
      #OtroTipoReservacion{
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
            require('../Vista/MenuNavegacion/menu_administradoreslaboratorios.php');
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
                    <li class="breadcrumb-item">Nueva Reservaci&oacute;n Pr&aacute;ctica Libre</li>
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
                      <h5>Oferta Disponible</h5>
                    </div>
                    <div class="card-body">
                    <div class="container-fluid general-widget">
                    <div class="row">
                    <div class="alert alert-dark inverse fade show" role="alert"><i class="icon-info-alt"></i>
                      <p>Estimado(a) <?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2); print_r($PrimerNombre[0]); ?>. En base a la informaci&oacute;n que usted nos ha proporcionado, 
                    nuestro sistema le ofrece los siguientes laboratorios para realizar su pr&aacute;ctica libre. <hr><h6 style="font-size: .8rem"><strong>Aplicaci&oacute;n a utilizar: </strong> 
                      <?php 
                        // OBTENER EL NOMBRE DE LA APLICACION A UTILIZAR
                        while ($filas = mysqli_fetch_array($consulta3)){
                            if($AplicacionReservacion == $filas['idaplicacion']){
                                echo $filas['nombreaplicacion'];
                            }
                      ?>
                      <?php } ?>
                      </h6></p>
                    </div>
                      <?php 
                        $ContadorLaboratorios = 1;
                        while ($filas = mysqli_fetch_array($consulta2)){
                        // VERIFICAR SI USUARIO SE ENCUENTRA ASIGNADO EN LABORATORIO
                        if($filas['idlaboratorio']==1){
                            if($Gestiones->getLaboratorioAsignadoLab1()=="si"){
                      ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==2){
                                if($Gestiones->getLaboratorioAsignadoLab2()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==3){
                                if($Gestiones->getLaboratorioAsignadoLab3()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==4){
                                if($Gestiones->getLaboratorioAsignadoLab4()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==5){
                                if($Gestiones->getLaboratorioAsignadoLab5()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==6){
                                if($Gestiones->getLaboratorioAsignadoLab6()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==7){
                                if($Gestiones->getLaboratorioAsignadoLab7()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==8){
                                if($Gestiones->getLaboratorioAsignadoLab8()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==9){
                                if($Gestiones->getLaboratorioAsignadoLab9()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==10){
                                if($Gestiones->getLaboratorioAsignadoLab10()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==11){
                                if($Gestiones->getLaboratorioAsignadoLab11()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==12){
                                if($Gestiones->getLaboratorioAsignadoLab12()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==13){
                                if($Gestiones->getLaboratorioAsignadoLab13()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==14){
                                if($Gestiones->getLaboratorioAsignadoLab14()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php 
                            if($filas['idlaboratorio']==15){
                                if($Gestiones->getLaboratorioAsignadoLab15()=="si"){
                        ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php } } ?>
                        <?php $ContadorLaboratorios++; } ?>
                        <div class="alert alert-danger outline fade show" role="alert"><i data-feather="alert-triangle"></i>
                                <p> S&iacute; uno de los laboratorios ya tiene una reservaci&oacute;n en curso, le mostraremos en la solicitud de oferta la cantidad 
                                de espacios a&uacute;n disponibles (Al llenarse los espacios, desaparecer&aacute; de su pantalla ese laboratorio ofrecido). Caso contrario se mostrar&aacute; el total m&aacute;ximo de usuarios que cada laboratorio puede atender.
                                <b>Tome en cuenta que se mostrar&aacute;n en pantalla los laboratorios en los que usted se encuentra asignado.</b></p>
                            </div>
                    <form id="frm_reservacionespracticaslibres_segundafase" class="form-space theme-form row needs-validation" novalidate="" 
                    autocomplete="off" action="" method="post">
                    <input type="hidden" name="txtAplicacionReservacionPL" id="txtAplicacionReservacionPL" value="<?php echo $AplicacionReservacion; ?>">
                    <input type="hidden" name="txtFechaInicioReservacionPL" id="txtFechaInicioReservacionPL" value="<?php echo $FechaInicioReservacion; ?>">
                    <input type="hidden" name="txtHoraInicioReservacionPL" id="txtHoraInicioReservacionPL" value="<?php echo $HoraInicioReservacion; ?>">
                        <!-- LABORATORIO RESERVACION -->
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <label class="form-label">Seg&uacute;n las recomendaciones ¿Qu&eacute; laboratorio desea seleccionar? <span style="color: var(--bs-danger);">(*)</span></label>
                                <select class="js-example-placeholder-multiple col-sm-12 form-control input-air-primary form-control-lg" name="sltlaboratorio_reservacionPL" id="sltlaboratorio_reservacionPL" required="">
                                            <option value=""></option>
                                            <?php
                                                // TODOS LOS LABORATORIOS DISPONIBLES
                                                while ($filas = mysqli_fetch_array($consulta4)){
                                                    if($filas['idlaboratorio']==1){
                                                        if($Gestiones->getLaboratorioAsignadoLab1()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==2){
                                                        if($Gestiones->getLaboratorioAsignadoLab2()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==3){
                                                        if($Gestiones->getLaboratorioAsignadoLab3()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==4){
                                                        if($Gestiones->getLaboratorioAsignadoLab4()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==5){
                                                        if($Gestiones->getLaboratorioAsignadoLab5()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==6){
                                                        if($Gestiones->getLaboratorioAsignadoLab6()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==7){
                                                        if($Gestiones->getLaboratorioAsignadoLab7()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==8){
                                                        if($Gestiones->getLaboratorioAsignadoLab8()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==9){
                                                        if($Gestiones->getLaboratorioAsignadoLab9()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==10){
                                                        if($Gestiones->getLaboratorioAsignadoLab10()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==11){
                                                        if($Gestiones->getLaboratorioAsignadoLab11()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==12){
                                                        if($Gestiones->getLaboratorioAsignadoLab12()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==13){
                                                        if($Gestiones->getLaboratorioAsignadoLab13()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==14){
                                                        if($Gestiones->getLaboratorioAsignadoLab14()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }else if($filas['idlaboratorio']==15){
                                                        if($Gestiones->getLaboratorioAsignadoLab15()=="si"){
                                                            echo "
                                                            <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                            ";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                <div class="invalid-feedback">Por favor seleccione una aplicaci&oacute;n.</div>
                            </div>
                        </div>
                        <!-- FACULTAD QUE PERTENECE -->
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <label class="form-label">¿A qu&eacute; facultad pertenece? <span style="color: var(--bs-danger);">(*)</span></label>
                                <select class="js-example-placeholder-multiple col-sm-12 form-control input-air-primary form-control-lg" name="sltfacultad_reservacionPL" id="sltfacultad_reservacionPL" required="">
                                            <option value=""></option>
                                            <option value="1">Informática y Ciencias Aplicadas</option>
                                            <option value="2">Ciencias Sociales</option>
                                            <option value="3">Ciencias Empresariales</option>
                                            <option value="4">Derecho</option>
                                            <?php
                                            /*
                                                // TODAS LAS FACULTADES
                                                while ($filas = mysqli_fetch_array($consulta6)){
                                                    echo "
                                                    <option value=".$filas['idfacultad'].">".$filas['nombrefacultad'].""."</option>
                                                    ";
                                                }*/
                                            ?>
                                        </select>
                                <div class="invalid-feedback">Por favor seleccione una aplicaci&oacute;n.</div>
                            </div>
                        </div>
                        <!-- NOMBRE USUARIO -->
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Nombres Usuarios <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input type="text" class="form-control input-air-primary form-control-lg digits" data-position="top left" 
                                         id="txtNombreUsuarioReservacionPL" name="txtNombreUsuarioReservacionPL" placeholder="Ej: Juan Alberto Perez" aria-describedby="inputGroupPrepend" required="">
                                        <div class="invalid-feedback">Por favor ingrese el c&oacute;digo de la reservaci&oacute;n.</div>
                                    </div>
                                </div>
                        <!-- CARNE USUARIO -->
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                                    <div class="mb-4">
                                        <label class="form-label">Carn&eacute; Usuarios <span style="color: var(--bs-danger);">(*)</span></label>
                                        <input type="text" class="form-control input-air-primary form-control-lg digits" data-position="top left" 
                                         id="txtCarneUsuarioReservacionPL" name="txtCarneUsuarioReservacionPL" placeholder="Ej: 22-0000-2023" aria-describedby="inputGroupPrepend" required="">
                                        <div class="invalid-feedback">Por favor ingrese la cantidad de personas a asistir.</div>
                                    </div>
                                </div>
                            
                                        
                        <div class="card-footer text-end">
                            <button type="submit" id="envio-datosusuarios" class="btn btn-primary"><i class="icofont icofont-save"></i> Guardar</button>
                            <a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-laboratorios-primera-fase" class="btn btn-danger"><i class="icofont icofont-error"></i> Cancelar</a>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-nuevas-practicas-libres-laboratorios.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2-custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/mask.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/Scripts/MascaraDatos_PracticasLibres.js"></script>
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