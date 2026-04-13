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
  // NO PERMITIR VISTA SI CODIGO UNICO IDENTIFICADOR, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getCodigoUnicoIdentificadorReservacion() != $_GET['identificador_reservacion']){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI ID APLICACION, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getIdAplicacion() != $_GET['app']){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI FECHA INICIO RESERVACION, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getFechaInicioReservacion() != $_GET['fi']){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI FECHA FIN RESERVACION, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getFechaInicioReservacion() != $_GET['ff']){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI HORA INICIO, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getHoraInicioReservacion() != $_GET['hi']){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI HORA FIN, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getHoraFinReservacion() != $_GET['hf']){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI NUMERO DE USUARIOS, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getCantidadUsuariosReservacion() != $_GET['nu']){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI ID RESERVACION, ES DIFERENTE A PARAMETRO ASIGNADO
  if($Gestiones->getIdReservacion() != $_GET['idreservacion']){
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
    <title><?php echo $TituloPrincipal; ?> Reasignar Reservaci&oacute;n</title>
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
                    <li class="breadcrumb-item">Reasignar Reservaci&oacute;n</li>
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
                      <h5>Reasignar Reservaci&oacute;n</h5>
                    </div>
                    <div class="card-body">
                    <div class="container-fluid general-widget">
                    <div class="row">
                    <div class="alert alert-dark inverse fade show" role="alert"><i class="icon-info-alt"></i>
                      <p>Estimado(a) <?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2); print_r($PrimerNombre[0]); ?>. En base a la informaci&oacute;n que el usuario registro en la plataforma, usted puede reasignar dicha
                      reservaci&oacute;n a otro laboratorio o m&oacute;dulo seg&uacute;n sea el caso. Tome en cuenta que esto afectar&aacute; &uacute;nicamente a esta reservaci&oacute;n y si existiesen m&aacute;s dentro de este c&oacute;digo &uacute;nico, deber&aacute;n procesarse manualmente.
                    </div>
                    <div class="table-responsive mb-4">
                    <table class="table">
                      <thead style="background-color: var(--bs-green);">
                        <tr>
                          <th class="text-white" scope="col">Aplicaci&oacute;n</th>
                          <th class="text-white" scope="col">N&uacute;mero Personas</th>
                          <th class="text-white" scope="col">Fecha Inicio</th>
                          <th class="text-white" scope="col">Fecha Fin</th>
                          <th class="text-white" scope="col">Horario</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                          <?php 
                        // OBTENER EL NOMBRE DE LA APLICACION A UTILIZAR
                        while ($filas = mysqli_fetch_array($consulta4)){
                            if($AplicacionReservacion == $filas['idaplicacion']){
                                echo $filas['nombreaplicacion'];
                            }
                      ?>
                      <?php } ?>
                          </td>
                          <td><?php echo $Gestiones->getCantidadUsuariosReservacion(); ?> personas</td>
                          <td><?php echo $FechaInicioReservacion; ?></td>
                          <td><?php echo $FechaFinReservacion; ?></td>
                          <td><?php echo $HoraInicioReservacion; ?>-<?php echo $HoraFinReservacion; ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                      <?php 
                        $ContadorLaboratorios = 1;
                        $ComprobarOfertaLaboratorios = 0;
                        while ($filas = mysqli_fetch_array($consulta2)){
                          if ($ComprobarOfertaLaboratorios == 0)
                            $ComprobarOfertaLaboratorios = 1;
                          // VERIFICAR SI LABORATORIOS CON MODULOS NO TIENEN RESERVACION Y APARECEN EN LISTADO
                          $lab3EncontradoTablaSugerencia = false; $lab3EncontradoTablaSugerencia = false;
                      ?>
                        <div class="col-sm-12 col-xl-3 col-lg-12">
                            <div class="card o-hidden border-0">
                            <div class="bg-<?php if($filas['estadolaboratorio'] == "activo"){echo "success";}else if($filas['estadolaboratorio'] == "inactivo"){echo "danger";} ?> b-r-4 card-body">
                                <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="airplay"></i></div>
                                <div class="media-body"><span class="m-0"><?php echo $filas['codigolaboratorio']; ?> (Disponible)</span>
                                    <h4 class="mb-0 counter"><?php echo $filas['capacidadreal']; ?></h4><i class="icon-bg" data-feather="info"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <?php $ContadorLaboratorios++; }
                        if ($ComprobarOfertaLaboratorios == 0){
                          echo '
                          <div class="alert alert-danger outline fade show" role="alert"><i data-feather="thumbs-down"></i>
                          <p><b> ¡Lo sentimos! </b> Lamentablemente todos los laboratorios est&aacute;n ocupados y no hemos encontrado una oferta que se ajuste a tus par&aacute;metros de consulta.
                          Te invitamos a que consultes nuevamente m&aacute;s tarde, ya que nuestras solicitudes se somenten a revisi&oacute;n y no todas son aprobadas. Puedes consultar m&aacute;s abajo 
                          si se ofrecen los laboratorios que tienen diferentes m&oacute;dulos de capacidad. Si se oferta alguno de ellos, puedes dividir tu reservaci&oacute;n sin exceder la capacidad m&aacute;xima
                          del laboratorio ofertado. Para ello regresa nuevamente al inicio y ajusta la cantidad de usuarios a procesar.</p>
                        </div>
                          ';
                        }
                        ?>
                        <p>* No obstante, en algunos de nuestros laboratorios ofrecemos el servicio de reservaci&oacute;n por m&oacute;dulos, D&oacute;nde le ofreceremos dicho laboratorio si no aparece en el listado principal. Recuerde que la reservaci&oacute;n por m&oacute;dulos
                        esta sujeta a disponibilidad, adem&aacute;s si usted no supera el l&iacute;mite m&aacute;ximo de cada m&oacute;dulo as&iacute; como su sumatoria. <b>Tome en cuenta que s&iacute; todos aparecen con el mensaje "No Disponible". Significa que ese m&oacute;dulo en cuesti&oacute;n ya se encuentra ocupado.
                        <span style="color: #f00";>Igualmente tome en cuenta que cada m&oacute;dulo se llena autom&aacute;ticamente seg&uacute;n el n&uacute;mero de usuarios procesados en cada reservaci&oacute;n.</span>
                        </b>
                      </p>
                      <div class="alert alert-light dark fade show" role="alert"><i data-feather="alert-triangle"></i>
                      <p> <b>Tomar Nota: S&iacute; existiese la posibilidad de registrar su reservaci&oacute;n en un laboratorio que posee m&oacute;dulos, pero el orden de los mismos no es en orden secuencial, por favor 
                          comunicarse con el administrador del laboratorio concreto para que proceda a registrar su reservaci&oacute;n. <span style="color: #f00;">Estos casos son atendidos si el total de usuarios no excede la capacidad
                          m&aacute;xima del m&oacute;dulo que usted est&aacute; interesado.</span>
                      </b></p>
                    </div>
                    <div class="table-responsive mb-4">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Laboratorio</th>
                          <th scope="col">M&oacute;dulo 1</th>
                          <th scope="col">M&oacute;dulo 2</th>
                          <th scope="col">M&oacute;dulo 3</th>
                          <th scope="col">M&oacute;dulo 4</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $ContadorEspacios = 1;
                        // OBTENER LOS LABORATORIOS CON MODULOS SI APLICA
                        while ($filas = mysqli_fetch_array($consulta3)){
                          // VALIDAR SI EL NUMERO DE USUARIOS NO EXCEDE LA CAPACIDAD DE CADA MODULO
                          if($filas['idlaboratorio'] == 1){
                            $SumatoriaModulosTablaInformacionLab1 = $filas['espacio_disponible_mod1']+$filas['espacio_disponible_mod2']+$filas['espacio_disponible_mod3']+$filas['espacio_disponible_mod4'];
                          }else if($filas['idlaboratorio'] == 3){
                            $SumatoriaModulosTablaInformacionLab3 = $filas['espacio_disponible_mod1']+$filas['espacio_disponible_mod2']+$filas['espacio_disponible_mod3']+$filas['espacio_disponible_mod4'];
                          }
                          echo '
                          <tr ';  echo'>
                          <th scope="row">'.$ContadorEspacios.'</th>
                          <td>'.$filas['codigolaboratorio'].'</td>
                          <td>'; 
                          if($filas['espacio_disponible_mod1'] < $filas['mod1']){
                            echo '
                            <a class="badge badge-danger" href="#">No Disponible</a>
                            ';
                          }else{
                            echo '
                            <a class="badge badge-success" href="#">'.$filas['espacio_disponible_mod1'].' espacios</a>
                            ';
                          }
                          echo'</td>
                          <td>'; 
                          if($filas['espacio_disponible_mod2'] < $filas['mod2']){
                            echo '
                            <a class="badge badge-danger" href="#">No Disponible</a>
                            ';
                          }else{
                            echo '
                            <a class="badge badge-success" href="#">'.$filas['espacio_disponible_mod2'].' espacios</a>
                            ';
                          }
                          echo'</td>
                          <td>'; 
                          if($filas['espacio_disponible_mod3'] < $filas['mod3']){
                            echo '
                            <a class="badge badge-danger" href="#">No Disponible</a>
                            ';
                          }else{
                            echo '
                            <a class="badge badge-success" href="#">'.$filas['espacio_disponible_mod3'].' espacios</a>
                            ';
                          }
                          echo'</td>
                          <td>'; 
                          if($filas['espacio_disponible_mod4'] < $filas['mod4']){
                            echo '
                            <a class="badge badge-danger" href="#">No Disponible</a>
                            ';
                          }else{
                            echo '
                            <a class="badge badge-success" href="#">'.$filas['espacio_disponible_mod4'].' espacios</a>
                            ';
                          }
                          echo'</td>
                          
                        </tr>
                          ';
                          $ContadorEspacios++;
                        }
                        // MOSTRAR MENSAJE DE ALERTA CAPACIDAD DE MODULOS EXCEDIDA
                        if(!empty($SumatoriaModulosTablaInformacionLab1)){
                          if($Gestiones->getCantidadUsuariosReservacion() > $SumatoriaModulosTablaInformacionLab1){
                            echo '
                              <div class="alert alert-primary inverse fade show" role="alert"><i class="icon-timer"></i>
                                <p>Aviso Laboratorio 1: <b>Usted no podr&aacute; seleccionar el laboratorio 1 por dos motivos: el total de los usuarios a reservar excede todas las capacidades 
                                de nuestros m&oacute;dulos; o bien, ya tiene reservaciones y est&aacute; totalmente ocupado.</b></p>
                            </div>
                            ';
                          }
                        }
                        
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                    <form id="frm_reservaciones_reasignacion" class="form-space theme-form row needs-validation" novalidate="" autocomplete="off" method="post">
                    <input type="hidden" name="txtIdReservacion" id="txtIdReservacion" value="<?php echo $Gestiones->getIdReservacion(); ?>">
                    <input type="hidden" name="txtCodigoUnicoReservacion" id="txtCodigoUnicoReservacion" value="<?php echo $Gestiones->getCodigoUnicoIdentificadorReservacion(); ?>">
                    <input type="hidden" name="txtIdLaboratorio" id="txtIdLaboratorio" value="<?php echo $Gestiones->getIdLaboratorio(); ?>">
                    <input type="hidden" name="txtNumeroUsuariosReservacion" id="txtNumeroUsuariosReservacion" value="<?php echo $Gestiones->getCantidadUsuariosReservacion(); ?>">
                    
                    <?php 
                      // VERIFICAR ESPACIOS DISPONIBLES POR MODULOS -> LABORATORIOS DISPONIBLES
                      // YA QUE NO SON TODOS LOS LABORATORIOS, ESTA INFORMACION SE MANEJA DE MODO MANUAL EN VALIDAR CADA LABORATORIO
                      while ($filas = mysqli_fetch_array($consulta10)){
                        // -> LABORATORIO 3
                        if($filas['idlaboratorio'] == 3){
                          echo '
                            <input type="hidden" name="txtEspacioMod1Lab3" id="txtEspacioMod1Lab3" value="'; 
                              /*********************
                               *  -> MODULO 1
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod1'] == 0 || $filas['espacio_disponible_mod1'] < $filas['mod1']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod1'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod1'] == $filas['mod1']){echo $filas['espacio_disponible_mod1'];}
                            echo'">
                            <input type="hidden" name="txtEspacioMod2Lab3" id="txtEspacioMod2Lab3" value="'; 
                              /*********************
                               *  -> MODULO 2
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod2'] == 0 || $filas['espacio_disponible_mod2'] < $filas['mod2']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod2'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod2'] == $filas['mod2']){echo $filas['espacio_disponible_mod2'];}
                            echo'">
                            <input type="hidden" name="txtEspacioMod3Lab3" id="txtEspacioMod3Lab3" value="'; 
                              /*********************
                               *  -> MODULO 3
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod3'] == 0 || $filas['espacio_disponible_mod3'] < $filas['mod3']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod3'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod3'] == $filas['mod3']){echo $filas['espacio_disponible_mod3'];}
                            echo'"> 
                            <input type="hidden" name="txtEspacioMod4Lab3" id="txtEspacioMod4Lab3" value="'; 
                              /*********************
                               *  -> MODULO 4
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod4'] == 0 || $filas['espacio_disponible_mod4'] < $filas['mod4']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod4'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod4'] == $filas['mod4']){echo $filas['espacio_disponible_mod4'];}
                            echo'">
                          ';
                        }
                         // -> LABORATORIO 8
                         if($filas['idlaboratorio'] == 8){
                          echo '
                            <input type="hidden" name="txtEspacioMod1Lab8" id="txtEspacioMod1Lab8" value="'; 
                              /*********************
                               *  -> MODULO 1
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod1'] == 0 || $filas['espacio_disponible_mod1'] < $filas['mod1']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod1'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod1'] == $filas['mod1']){echo $filas['espacio_disponible_mod1'];}
                            echo'">
                            <input type="hidden" name="txtEspacioMod2Lab8" id="txtEspacioMod2Lab8" value="'; 
                              /*********************
                               *  -> MODULO 2
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod2'] == 0 || $filas['espacio_disponible_mod2'] < $filas['mod2']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod2'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod2'] == $filas['mod2']){echo $filas['espacio_disponible_mod2'];}
                            echo'">
                            <input type="hidden" name="txtEspacioMod3Lab8" id="txtEspacioMod3Lab8" value="'; 
                              /*********************
                               *  -> MODULO 3
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod3'] == 0 || $filas['espacio_disponible_mod3'] < $filas['mod3']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod3'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod3'] == $filas['mod3']){echo $filas['espacio_disponible_mod3'];}
                            echo'"> 
                          ';
                        }
                        // -> LABORATORIO 14
                        if($filas['idlaboratorio'] == 14){
                          echo '
                            <input type="hidden" name="txtEspacioMod1Lab14" id="txtEspacioMod1Lab14" value="'; 
                              /*********************
                               *  -> MODULO 1
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod1'] == 0 || $filas['espacio_disponible_mod1'] < $filas['mod1']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod1'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod1'] == $filas['mod1']){echo $filas['espacio_disponible_mod1'];}
                            echo'">
                            <input type="hidden" name="txtEspacioMod2Lab14" id="txtEspacioMod2Lab14" value="'; 
                              /*********************
                               *  -> MODULO 2
                               ********************/
                              // SI MODULO YA ESTA OCUPADO, IMPRIMIR CERO
                              if($filas['espacio_disponible_mod2'] == 0 || $filas['espacio_disponible_mod2'] < $filas['mod2']){echo 0;}
                              // SI MODULO EN ESE LABORATORIO NO EXISTE -> IMPRIMIR -1
                              else if(empty($filas['espacio_disponible_mod2'])){echo -1;}
                              // SI MODULO ESTA DISPONIBLE, IMPRIMIR LA DISPONIBILIDAD DE ESE MODULO
                              else if($filas['espacio_disponible_mod2'] == $filas['mod2']){echo $filas['espacio_disponible_mod2'];}
                            echo'">
                          ';
                        }
                      }
                    ?>
                        <!-- LABORATORIO RESERVACION -->
                        <div class="col-sm-12">
                            <div class="mb-4">
                                <label class="form-label">Seg&uacute;n las recomendaciones ¿Qu&eacute; laboratorio desea seleccionar? <span style="color: var(--bs-danger);">(*)</span></label>
                                <select class="js-example-placeholder-multiple col-sm-12 form-control input-air-primary form-control-lg" name="sltlaboratorio_reservacion" id="sltlaboratorio_reservacion" required="">
                                            <option value=""></option>
                                            <?php
                                                // VERIFICAR SI LABORATORIOS CON MODULOS NO TIENEN RESERVACION Y APARECEN EN LISTADO
                                                $lab3Encontrado = false; $lab1Encontrado = false;
                                                // TODOS LOS LABORATORIOS DISPONIBLES
                                                while ($filas = mysqli_fetch_array($consulta5)){
                                                    if($filas['idlaboratorio']==3){ $lab3Encontrado = true;}
                                                    else if($filas['idlaboratorio']==1){ $lab1Encontrado = true;}
                                                    echo "
                                                    <option value=".$filas['idlaboratorio'].">".$filas['nombrelaboratorio'].""."</option>
                                                    ";
                                                }
                                                // MOSTRAR LOS LABORATORIOS CON MODULOS DISPONIBLES
                                                // SI NO APARECE EN LISTADO, YA TIENE RESERVACION PERO POSIBLEMENTE TENGA ESPACIO EN SUS MODULOS. MOSTRAR DISPONIBLES
                                                if (!$lab3Encontrado || !$lab1Encontrado) {
                                                  while ($filas = mysqli_fetch_array($consulta9)) {
                                                      // VALIDAR SI EL NUMERO DE USUARIOS NO EXCEDE LA CAPACIDAD DE CADA MODULO
                                                      $SumatoriaModulos = $filas['espacio_disponible_mod1'] + $filas['espacio_disponible_mod2'] + $filas['espacio_disponible_mod3'] + $filas['espacio_disponible_mod4'];
                                                      if ($Gestiones->getCantidadUsuariosReservacion() <= $SumatoriaModulos) {
                                                          $modulosDisponibles = [];
                                                          if ($filas['espacio_disponible_mod1'] == $filas['mod1']) {
                                                              $modulosDisponibles[] = 1;
                                                          }
                                                          if ($filas['espacio_disponible_mod2'] == $filas['mod2']) {
                                                              $modulosDisponibles[] = 2;
                                                          }
                                                          if ($filas['espacio_disponible_mod3'] == $filas['mod3']) {
                                                              $modulosDisponibles[] = 3;
                                                          }
                                                          if ($filas['espacio_disponible_mod4'] == $filas['mod4']) {
                                                              $modulosDisponibles[] = 4;
                                                          }
                                                          sort($modulosDisponibles);
                                              
                                                          $ultimoModuloDisponible = null;
                                                          $mostrarLaboratorio = true;
                                              
                                                          foreach ($modulosDisponibles as $moduloDisponible) {
                                                              if ($ultimoModuloDisponible !== null && $ultimoModuloDisponible + 1 != $moduloDisponible) {
                                                                  $mostrarLaboratorio = false;
                                                                  break;
                                                              }
                                                              $ultimoModuloDisponible = $moduloDisponible;
                                                          }
                                              
                                                          if ($mostrarLaboratorio) {
                                                              echo "<option value=".$filas['idlaboratorio'].">Laboratorio ".$filas['idlaboratorio']." Inform&aacute;tica ";
                                              
                                                              foreach ($modulosDisponibles as $moduloDisponible) {
                                                                  echo "(M&oacute;dulo ".$moduloDisponible.")";
                                                              }
                                              
                                                              echo "</option>";
                                                          }
                                                      }
                                                  } 
                                              }
                                            ?>
                                        </select>
                                <div class="invalid-feedback">Por favor seleccione un laboratorio.</div>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-reasignacion-reservaciones-procesadas.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2.full.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/select2/select2-custom.js"></script>
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