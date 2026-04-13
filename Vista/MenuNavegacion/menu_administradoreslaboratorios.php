<?php 
    if($_SESSION["id_rolusuario"] == 2){
?>
<style>.menu-content{ width: auto !important;} .menu-title{ font-size: .85rem;}</style>
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="<?php echo $UrlGlobal; ?>Vista/assets/images/FotoPerfil/<?php echo $_SESSION["foto_usuario"]; ?>" alt="">
            <div class="badge-bottom"></div><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=perfil-administrador-general">
              <h6 class="mt-3 f-14 f-w-600">Hola, <?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2);
              print_r($PrimerNombre[0]); ?></h6></a>
            <p class="mb-0 font-roboto">Rol: Administrador Laboratorios</p>
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
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=inicioadministradorlaboratorios">Inicio</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=perfil-administrador-laboratorios">Mi Perfil</a></li>
                    </ul>
                  </li>
                   <!-- LABORATORIOS -->
                   <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="hard-drive"></i><span>Laboratorios</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-laboratorios-informatica-administrador-laboratorios">Consultar Laboratorios</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-laboratorios-informatica-inactivos-administrador-laboratorios">Consultar Laboratorios Inactivos</a></li>
                    </ul>
                  </li>
                  <!-- APLICACIONES COMPUTADORAS -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="monitor"></i><span>Aplicaciones</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-aplicaciones-laboratorios-informatica-administrador-laboratorios">Registrar Aplicaciones</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-general-administrador-laboratorios">Gestionar Aplicaciones</a></li>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab1()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-uno-administrador-laboratorios">Aplicaciones Laboratorio 1</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab2()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-dos-administrador-laboratorios">Aplicaciones Laboratorio 2</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab3()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-tres-administrador-laboratorios">Aplicaciones Laboratorio 3</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab4()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-cuatro-administrador-laboratorios">Aplicaciones Laboratorio 4</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab5()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-cinco-administrador-laboratorios">Aplicaciones Laboratorio 5</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab6()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-seis-administrador-laboratorios">Aplicaciones Laboratorio 6</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab7()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-siete-administrador-laboratorios">Aplicaciones Laboratorio 7</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab8()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-ocho-administrador-laboratorios">Aplicaciones Laboratorio 8</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab9()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-nueve-administrador-laboratorios">Aplicaciones Laboratorio 9</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab10()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-diez-administrador-laboratorios">Aplicaciones Laboratorio 10</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab11()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-once-administrador-laboratorios">Aplicaciones Laboratorio 11</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab12()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-doce-administrador-laboratorios">Aplicaciones Laboratorio 12</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab13()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-trece-administrador-laboratorios">Aplicaciones Laboratorio 13</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab14()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-catorce-administrador-laboratorios">Aplicaciones Laboratorio 14</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab15()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-quince-administrador-laboratorios">Aplicaciones Laboratorio 15</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  <!-- RESERVACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="zap"></i><span>Reservaciones</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=instrucciones-reservaciones-laboratorios-primera-fase-administrador-laboratorios">Instrucciones Uso</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-laboratorios-primera-fase-administrador-laboratorios">Nueva Reservaci&oacute;n</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-solicitadas-laboratorios-primera-fase-administrador-laboratorios">Nueva Reservaci&oacute;n Solicitada</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-pendientes-administrador-laboratorios">Reservaciones Pendientes</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-aprobadas-administrador-laboratorios">Reservaciones Aprobadas</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-denegadas-administrador-laboratorios">Reservaciones Denegadas</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-canceladas-administrador-laboratorios">Reservaciones Canceladas</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-mis-reservaciones-procesadas-administrador-laboratorios">Mis Reservaciones (Ciclo Actual)</a></li>
                    </ul>
                  </li>
                  <!-- HISTORICO RESERVACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="gitlab"></i><span>Hist&oacute;rico</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=historico-reservaciones-procesadas-administrador-laboratorio">Hist&oacute;rico Reservaciones</a></li>
                    </ul>
                  </li>
                  <!-- PRACTICAS LIBRES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="activity"></i><span>Pr&aacute;cticas Libres</span></a>
                    <ul class="nav-submenu menu-content">
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-laboratorios-practicas-libres-administrador-laboratorios">Nueva Reservaci&oacute;n Pr&aacute;ctica Libre</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-activas-administrador-laboratorios">Pr&aacute;cticas Libres Activas</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizadas-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas</a></li>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab1()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-uno-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab1</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab2()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-dos-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab2</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab3()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-tres-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab3</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab4()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-cuatro-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab4</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab5()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-cinco-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab5</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab6()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-seis-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab6</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab7()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-siete-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab7</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab8()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-ocho-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab8</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab9()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-nueve-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab9</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab10()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-diez-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab10</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab11()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-once-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab11</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab12()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-doce-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab12</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab13()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-trece-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab13</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab14()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-catorce-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab14</a></li>
                    <?php } ?>
                    <?php if ($Gestiones->getLaboratorioAsignadoLab15()=="si"){ ?>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-quince-administrador-laboratorios">Pr&aacute;cticas Libres Finalizadas Lab15</a></li>
                    <?php } ?>
                  </ul>
                  </li>
                  <!-- CALENDARIO -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="calendar"></i><span>Calendario</span></a>
                    <ul class="nav-submenu menu-content">
                      <?php if ($Gestiones->getLaboratorioAsignadoLab1()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-uno-administrador-laboratorios">Calendario Actividades Laboratorio 1</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab2()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-dos-administrador-laboratorios">Calendario Actividades Laboratorio 2</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab3()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-tres-administrador-laboratorios">Calendario Actividades Laboratorio 3</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab4()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-cuatro-administrador-laboratorios">Calendario Actividades Laboratorio 4</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab5()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-cinco-administrador-laboratorios">Calendario Actividades Laboratorio 5</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab6()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-seis-administrador-laboratorios">Calendario Actividades Laboratorio 6</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab7()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-siete-administrador-laboratorios">Calendario Actividades Laboratorio 7</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab8()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-ocho-administrador-laboratorios">Calendario Actividades Laboratorio 8</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab9()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-nueve-administrador-laboratorios">Calendario Actividades Laboratorio 9</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab10()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-diez-administrador-laboratorios">Calendario Actividades Laboratorio 10</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab11()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-once-administrador-laboratorios">Calendario Actividades Laboratorio 11</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab12()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-doce-administrador-laboratorios">Calendario Actividades Laboratorio 12</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab13()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-trece-administrador-laboratorios">Calendario Actividades Laboratorio 13</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab14()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-catorce-administrador-laboratorios">Calendario Actividades Laboratorio 14</a></li>
                      <?php } ?>
                      <?php if ($Gestiones->getLaboratorioAsignadoLab15()=="si"){ ?>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-quince-administrador-laboratorios">Calendario Actividades Laboratorio 15</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  <!-- MENSAJERIA -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="mail"></i><span>Mensajer&iacute;a</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-nuevo-mensaje-usuarios-administrador-laboratorios">Enviar Nuevo Mensaje</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria-administrador-laboratorios">Bandeja de Entrada</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria-oculta-administrador-laboratorios">Mensajes Ocultos</a></li>
                    </ul>
                  </li>
                  <!-- NOTIFICACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=listado-mis-notificaciones-administrador-laboratorios"><i data-feather="bell"></i><span>Notificaciones</span></a></li>
                  <!-- PROBLEMAS PLATAFORMA [MANIFIESTOS] -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layout"></i><span>Reporte Problemas</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=soporte-tecnico-reporte-problemas-administrador-laboratorios">Registrar Problema</a></li>
                    </ul>
                  </li>
                  <!-- REPORTERIA -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="coffee"></i><span>Reporter&iacute;a</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=reporte-practicas-libres-rango-fechas-laboratorios-administrador-laboratorios">Reporte Pr&aacute;cticas Libres (Por Lab)</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=reporte-reservaciones-por-estados-laboratorios-administrador-laboratorios">Reporte Reservaciones (Por Estado y Labs)</a></li>
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