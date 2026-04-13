<?php 
    if($_SESSION["id_rolusuario"] == 3){
?>
<style>.menu-content{ width: auto !important;} .menu-title{ font-size: .85rem;}</style>
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="<?php echo $UrlGlobal; ?>Vista/assets/images/FotoPerfil/<?php echo $_SESSION["foto_usuario"]; ?>" alt="">
            <div class="badge-bottom"></div><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=perfil-administrador-general">
              <h6 class="mt-3 f-14 f-w-600">Hola, <?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2);
              print_r($PrimerNombre[0]); ?></h6></a>
            <p class="mb-0 font-roboto">Rol: Docente</p>
          </div>
        <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <!--
                  <li class="sidebar-main-title">
                    <div>
                      <h6></h6>
                    </div>
                  </li>-->
                  <!-- INICIO -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i><span>Inicio</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=iniciodocentes">Inicio</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=perfil-docente">Mi Perfil</a></li>
                    </ul>
                  </li>
                  <!-- RESERVACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="zap"></i><span>Reservaciones</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=instrucciones-reservaciones-laboratorios-primera-fase-docente">Instrucciones Uso</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-laboratorios-primera-fase-docentes">Nueva Reservaci&oacute;n</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-mis-reservaciones-procesadas-docentes">Mis Reservaciones (Ciclo Actual)</a></li>
                    </ul>
                  </li>
                  <!-- HISTORICO RESERVACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="gitlab"></i><span>Hist&oacute;rico</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=historico-reservaciones-procesadas-docentes">Hist&oacute;rico Reservaciones</a></li>
                    </ul>
                  </li>
                  <!-- MENSAJERIA -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="mail"></i><span>Mensajer&iacute;a</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-nuevo-mensaje-usuarios-docentes">Enviar Nuevo Mensaje</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria-docentes">Bandeja de Entrada</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria-oculta-docentes">Mensajes Ocultos</a></li>
                    </ul>
                  </li>
                  <!-- NOTIFICACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=listado-mis-notificaciones-docentes"><i data-feather="bell"></i><span>Notificaciones</span></a></li>
                  <!-- PROBLEMAS PLATAFORMA [MANIFIESTOS] -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layout"></i><span>Reporte Problemas</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=soporte-tecnico-reporte-problemas-docentes">Registrar Problema</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
<?php
    }else{
        header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
    }
?>
<!-- 
    -> CONTROLADOR AUTOMATICO PARAMETROS GET DE MENU DE NAVEGACION
    CAMBIAR "http://localhost:90" POR LA URL DE SU SERVIDOR EN DONDE SE MONTARA ESTE PROYECTO
-->
<script>
    var current = "http://localhost:90" + window.location.pathname + "?gestioneslaboratorios=<?php echo $_GET["gestioneslaboratorios"]; ?>";
</script>