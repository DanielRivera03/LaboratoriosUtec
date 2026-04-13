<?php 
  // DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA EL SALVADOR (UTC-6)
  setlocale(LC_TIME, "spanish");
  date_default_timezone_set('America/El_Salvador');
  // CALCULAR DISPONIBILIDAD MAQUINAS EN USO
  $NumeroEquiposDisponibles = $Gestiones->getCapacidadMaximaLaboratorio() - $Gestiones->getEquiposFueraUsoLaboratorio();
  // OBTENER HORA LOCAL
  $hora = new DateTime("now");
  // OBTENER FECHA ACTUAL
  $FechaActual = date('d/m/Y');
  // NO PERMITIR VISTA SI EL PARAMETRO DE LABORATORIO NO ES IGUAL A PARAMETRO DE SOLICITUD
  if($_GET['laboratorio']!=$Gestiones->getIdLaboratorio()){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI EL PARAMETRO DE CODIGO UNICO RESERVACION NO ES IGUAL A PARAMETRO DE SOLICITUD
  if($_GET['identificador_reservacion']!=$Gestiones->getCodigoUnicoIdentificadorReservacion()){
    header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  }
  // NO PERMITIR VISTA SI EL PARAMETRO DE ESTADO NO ES IGUAL A [APROBADO]
  //if($Gestiones->getEstadoReservacion()!="aprobado"){
    //header('location:../Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas');
  //}
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
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/estilos-ordenadores-reservaciones.css">
    <link id="color" rel="stylesheet" href="<?php echo $UrlGlobal; ?>Vista/assets/css/color-7.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $UrlGlobal; ?>Vista/assets/css/calendar.css">
    <style>
      #cantidad-grupos{
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
                  <h3>Gestionar Reservaciones Aprobadas</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Inicio</a></li>
                    <li class="breadcrumb-item">Reservaciones</li>
                    <li class="breadcrumb-item">Gestionar Reservaciones Aprobadas</li>
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
                                            <h6><?php echo $Gestiones->getNombreReservacion(); ?> [<?php echo $Gestiones->getCodigoReservacion(); ?>]</h6></a>
                                            <div class="blog-date"><b>* Laboratorio N&uacute;mero <?php echo $Gestiones->getIdLaboratorio(); ?></b></div>
                                            <p class="mb-1"><b>Estado: </b><span style="font-size: .7rem;" class="badge rounded-pill badge-success">Aprobado</span></p>
                                            <div class="blog-date"><b>Identificador:</b> <span style="font-size: .9rem;"><?php echo $Gestiones->getCodigoUnicoIdentificadorReservacion(); ?></span></div>
                                            <div class="blog-date"><b>Tipo:</b> <?php echo $Gestiones->getNombreTipoReservacion(); ?></div>
                                            <div class="blog-date"><b>Aplicaci&oacute;n:</b> <?php echo $Gestiones->getNombreAplicacion(); ?></div>
                                            <div class="blog-date"><b>Facultad:</b> <?php echo $Gestiones->getNombreFacultadReservacion(); ?></div>
                                            <div class="blog-date"><b>Escuela:</b> <?php echo $Gestiones->getNombreEscuelaReservacion(); ?></div>
                                            <div class="blog-date"><b>Docente:</b> <?php if($Gestiones->getEstadoTitularReservacion()=="no"){
                                              if(empty($Gestiones->getNombreOtroTitularReservacion())){echo "Desconocido";}
                                              else{echo $Gestiones->getNombreOtroTitularReservacion();}
                                              }else{echo $Gestiones->getNombresUsuarios(); echo " "; echo $Gestiones->getApellidosUsuarios(); echo"["; echo $Gestiones->getCodigoUnicoUsuarios(); echo "]";} ?></div>
                                            <div class="blog-date"><b>Cantidad:</b> <?php echo $Gestiones->getCantidadUsuariosReservacion(); ?> Usuarios</div>
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
                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                <thead>
                                                    <tr class="bg-primary">
                                                    <th class="text-white" scope="col">#</th>
                                                    <th class="text-white" scope="col">Fecha Inicio</th>
                                                    <th class="text-white" scope="col">Fecha Fin</th>
                                                    <th class="text-white" scope="col">Hora Inicio</th>
                                                    <th class="text-white" scope="col">Hora Fin</th>
                                                    <th class="text-white" scope="col">Laboratorio</th>
                                                    <th class="text-white" scope="col">Cancelar</th>
                                                    <th class="text-white" scope="col">Reasignar</th>
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
                                                            <th scope="row">'.$ContadorReservaciones.'</th>
                                                            <td>'.$NuevoFormatoFechaInicio.'</td>
                                                            <td>'.$NuevoFormatoFechaFin.'</td>
                                                            <td>'.$filas['horainicioreservacion'].'</td>
                                                            <td>'.date('H:i:s', strtotime($filas['horafinreservacion'] . ' +1 minute')).'</td>
                                                            <td>'.$filas['codigolaboratorio'].'</td>
                                                            
                                                            <td>'; 
                                                                $FechaInicioValidacion = $filas['fechainicioreservacion'];
                                                                $FechaActualValidacion = date('Y-m-d');
                                                                if($FechaActualValidacion <= $FechaInicioValidacion){
                                                                  if($filas['estadoreservacion'] != "cancelada"){
                                                                    echo '
                                                                            <button style="background: var(--bs-red); color: #fff;" class="btn btn-square btn-sm" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg'; echo $filas['idreservacion']; echo'"><i class="icofont icofont-ui-clock"></i> Cancelar</button>
                                                                            <div class="modal fade bd-example-modal-lg'; echo $filas['idreservacion']; echo'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                              <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                  <h4 class="modal-title" id="myLargeModalLabel">Cancelar Reservaci&oacute;n</h4>
                                                                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                <form id="frm_cancelar_reservaciones'; echo $filas['idreservacion']; echo'" class="form-space theme-form row needs-validation" novalidate="" autocomplete="off" method="post">
                                                                                  <input type="hidden" id="txtIdReservacion" name="txtIdReservacion" value="'; echo $filas['idreservacion']; echo'">
                                                                                  <!-- MOTIVOS CANCELACION -->
                                                                                  <div class="col-sm-12">
                                                                                      <div class="mb-4">
                                                                                          <label class="form-label">Por favor ingrese los motivos de la cancelaci&oacute;n <span style="color: var(--bs-danger);">(*)</span></label>
                                                                                          <textarea class="form-control input-air-primary form-control-lg" rows="4" id="txtcomentariocancelacion_reservacion" name="txtcomentariocancelacion_reservacion"
                                                                                          placeholder="Ingrese los motivos de la cancalaci&oacute;n..." aria-describedby="inputGroupPrepend" required=""></textarea>
                                                                                          <div class="invalid-feedback">Por favor ingrese la cantidad de usuarios que asistieron.</div>
                                                                                      </div>
                                                                                  </div>
                                                                                  
      
                                                                              </div>
                                                                              <div class="card-footer text-end">
                                                                                  <button type="submit" id="envio-datosusuarios" class="btn btn-outline-primary-2x"><i class="icofont icofont-save"></i> Procesar</button>
                                                                                  <button type="reset" class="btn btn-outline-info-2x"><i class="icofont icofont-save"></i> Limpiar</button>
                                                                              </div>
                                                                            </form>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                          '; 
                                                                  }else{
                                                                    echo '<span class="badge rounded-pill badge-light text-dark">No Disponible</span>';   
                                                                  }
                                                                }else if($FechaActualValidacion > $FechaInicioValidacion){
                                                                  echo '<span class="badge rounded-pill badge-light text-dark">No Disponible</span>';
                                                                }
                                                            echo'
                                                            </td>
                                                            <td>'; 
                                                                $FechaInicioValidacion = $filas['fechainicioreservacion'];
                                                                $FechaActualValidacion = date('Y-m-d');
                                                                if($FechaActualValidacion <= $FechaInicioValidacion){
                                                                  if($filas['estadoreservacion'] != "cancelada"){
                                                                    echo '
                                                                      <a href=';echo $UrlGlobal; echo'Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=modificar-grupo-completo-reservacion-procesada-administrador-laboratorios&identificador_reservacion='; echo $filas['codigounico_identificador']; 
                                                                      echo'&app='; echo $filas['idaplicacion']; echo'&fi='; echo $filas['fechainicioreservacion']; echo'&ff='; echo $filas['fechafinreservacion']; echo'&hi='; echo $filas['horainicioreservacion']; echo'&hf='; echo $filas['horafinreservacion']; echo'&nu='; echo $filas['numerousuarios']; echo'&idreservacion='; echo $filas['idreservacion']; echo' style="background: var(--bs-cyan); color: #fff;" class="btn btn-square btn-sm" type="button"><i class="icofont icofont-edit"></i> Reasignar</a>

                                                                          '; 
                                                                  }else{
                                                                    echo '<span class="badge rounded-pill badge-light text-dark">No Disponible</span>';   
                                                                  }
                                                                }else if($FechaActualValidacion > $FechaInicioValidacion){
                                                                  echo '<span class="badge rounded-pill badge-light text-dark">No Disponible</span>';
                                                                }
                                                            echo'
                                                            </td>
                                                            </tr>
                                                            ';
                                                            $ContadorReservaciones++;
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="card ribbon-wrapper">
                                        <div class="card-body">
                                            <div class="ribbon ribbon-primary ribbon-space-bottom">Control Seguimiento Reservaciones</div>
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                <thead>
                                                    <tr class="bg-primary">
                                                    <th class="text-white" scope="col">#</th>
                                                    <th class="text-white" scope="col">Fecha Inicio</th>
                                                    <th class="text-white" scope="col">Fecha Fin</th>
                                                    <th class="text-white" scope="col">Hora Inicio</th>
                                                    <th class="text-white" scope="col">Hora Fin</th>
                                                    <th class="text-white" scope="col">¿Dividi&oacute; Grupo?</th>
                                                    <th class="text-white" scope="col">Cantidad Grupos</th>
                                                    <th class="text-white" scope="col">Cantidad Usuarios</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $ContadorReservaciones = 1; $TotalEstudiantes = 0;
                                                        while ($filas = mysqli_fetch_array($consulta5)){
                                                            // FORMATO DD-MM-YYYY FECHA INICIO
                                                            $FechaInicioOriginal = $filas['fechainicioreservacion'];
                                                            $NuevoFormatoFechaInicio = date('d/m/Y', strtotime($FechaInicioOriginal)); 
                                                            // FORMATO DD-MM-YYYY FECHA FIN
                                                            $FechaFinOriginal = $filas['fechafinreservacion'];
                                                            $NuevoFormatoFechaFin = date('d/m/Y', strtotime($FechaFinOriginal)); 
                                                            echo '
                                                            <tr>
                                                            <th scope="row">'.$ContadorReservaciones.'</th>
                                                            <td>'.$NuevoFormatoFechaInicio.'</td>
                                                            <td>'.$NuevoFormatoFechaFin.'</td>
                                                            <td>'.$filas['horainicioreservacion'].'</td>
                                                            <td>'.$filas['horafinreservacion'].'</td>
                                                            <td>'; 
                                                                if($filas['dividio_grupo']=="si"){
                                                                    echo '<span class="badge rounded-pill badge-success">'.$filas['dividio_grupo'].'</span>';
                                                                }else{
                                                                    echo '<span class="badge rounded-pill badge-danger">'.$filas['dividio_grupo'].'</span>';
                                                                }
                                                            echo'</td>
                                                            <td>'.$filas['cantidad_grupos'].'</td>
                                                            <td>'.$filas['cantidadusuarios'].'</td>
                                                            </tr>
                                                            ';
                                                            $ContadorReservaciones++;
                                                            // DESCONTAR EN UNO LA CANTIDAD DE RESERVACIONES PROCESADAS
                                                            $CalcularReservacionesProcesadas = $ContadorReservaciones-1;
                                                            // CALCULAR EL TOTAL DE ESTUDIANTES ATENDIDOS
                                                            $CantidadUsuarios = $filas['cantidadusuarios'];
                                                            if (strpos($CantidadUsuarios, ',') !== false) {
                                                                // SUMAR INDIVIDUALMENTE SI LA CANTIDAD DE ESTUDIANTES ESTAN SEPARADAS POR COMAS
                                                                $usuarios = explode(',', $CantidadUsuarios);
                                                                foreach ($usuarios as $usuario) {// SOLO TOMAR EN CUENTA NUMEROS
                                                                    if (is_numeric($usuario)) {
                                                                        $TotalEstudiantes += $usuario;
                                                                    }
                                                                }
                                                            } else {
                                                                // SUMAR DIRECTAMENTE SI NO ESTAN SEPARADAS POR COMAS
                                                                if (is_numeric($CantidadUsuarios)) {// SOLO TOMAR EN CUENTA NUMEROS
                                                                    $TotalEstudiantes += $CantidadUsuarios;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                                </table>
                                                <?php 
                                                    echo '<p class="mt-4">* <b>El total de usuarios atendidos es de: '.$TotalEstudiantes.' usuarios.</b></p>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    /*
                                    <h6>Distribuci&oacute;n M&aacute;quinas Ocupadas</h6>
                                    <div class="container">
                                      <div class="row">
                                        <div class="col-lg-12">
                                          <div class="row justify-content-around">
                                            <?php
                                              for($equiposusados=1; $equiposusados <= $NumeroEquiposDisponibles ; $equiposusados++){
                                                // MOSTRAR LEYENDA OCUPADO EN EQUIPOS USADOS
                                                if($equiposusados <= $Gestiones->getCantidadUsuariosReservacion()){
                                                  echo '
                                                <div class="col-2 mb-3 mt-4 grid">
                                                  <img class="reveal distribucion-ordenadores" itemprop="associatedMedia" data-wow-delay="0.5s" itemscope="" src="'.$UrlGlobal.'Vista/assets/images/ordenador-personal-ocupado.png" alt="Máquina '.$equiposusados.'" class="img-fluid mx-auto d-block">
                                                  <a class="badge badge-primary" href="#">'.$equiposusados.'</a>
                                                </div>
                                                ';
                                                }else{// MOSTRAR EQUIPOS DISPONIBLES
                                                  echo '
                                                <div class="col-2 mb-3 mt-4">
                                                  <img class="reveal distribucion-ordenadores" itemprop="associatedMedia" data-wow-delay="0.5s" itemscope="" src="'.$UrlGlobal.'Vista/assets/images/ordenador-personal.png" alt="Máquina '.$equiposusados.'" class="img-fluid mx-auto d-block">
                                                  <a class="badge badge-primary" href="#">'.$equiposusados.'</a>
                                                  </div>
                                                ';
                                                }
                                                
                                              }
                                            ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    */ ?>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <p class="mb-2"></p>
                        <div class="ribbon ribbon-clip ribbon-primary"><i class="icofont icofont-ssl-security"></i> Gestionar Reservaciones</div></div>
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
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-actualizacion-final-reservaciones.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_cancelar-reservaciones-individual.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/tui-code-snippet.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/tui-time-picker.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/tui-date-picker.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/calendar/moment.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/animation/scroll-reveal/scrollreveal.min.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/modernizr.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/animation/scroll-reveal/reveal-custom.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/assets/js/jquery.timeago.js"></script>
    <script src="<?php echo $UrlGlobal; ?>Vista/AJAX/AJAX_envio-datos-cancelar-reservaciones.js"></script>
    <script>
        jQuery(document).ready(function() {
            $("time.timeago").timeago();
        });
        function ConsultaTipoReservacionInicial(){
          var ValorDivisionGruposReservacion = document.getElementById("sltdivision_grupos");
          var CantidadGruposReservacion = document.getElementById("cantidad-grupos");
          if (ValorDivisionGruposReservacion.value == "si") {
            CantidadGruposReservacion.style.display = "block";
          } else {
            CantidadGruposReservacion.style.display = "none";
          }}
          const myInput = document.getElementById("txtcantidadusuarios_reservacion");
          myInput.addEventListener("keydown", (event) => {
            const key = event.key;
            // VERIFICAR SI LO INGRESADO ES NUMERICO O COMA UNICAMENTE
            if (!/^[0-9,\b]+$/.test(key)) {
              event.preventDefault();
            }});
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