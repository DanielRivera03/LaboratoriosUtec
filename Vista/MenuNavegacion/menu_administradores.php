<?php 
    if($_SESSION["id_rolusuario"] == 1){
?>
<style>.menu-content{ width: auto !important;} .menu-title{ font-size: .85rem;}</style>
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="<?php echo $UrlGlobal; ?>Vista/assets/images/FotoPerfil/<?php echo $_SESSION["foto_usuario"]; ?>" alt="">
            <div class="badge-bottom"></div><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=perfil-administrador-general">
              <h6 class="mt-3 f-14 f-w-600">Hola, <?php $Nombre = $_SESSION['nombres_usuario'];$PrimerNombre = explode(' ', $Nombre, 2);
              print_r($PrimerNombre[0]); ?></h6></a>
            <p class="mb-0 font-roboto">Rol: Coordinador Laboratorios</p>
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
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=inicioadministradores">Inicio</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=perfil-administrador-general">Mi Perfil</a></li>
                    </ul>
                  </li>
                  <!-- ROLES DE USUARIOS -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="eye"></i><span>Roles</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-nuevos-roles-usuarios">Registrar Roles Usuarios</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-roles-usuarios-registrados">Consultar Roles Usuarios</a></li>
                    </ul>
                  </li>
                  <!-- USUARIOS -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="user"></i><span>Usuarios</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-nuevos-usuarios">Registrar Usuarios</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-general-usuarios">Consultar Usuarios</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-laboratorios-asignados-usuarios">Laboratorios Asignados</a></li>
                    </ul>
                  </li>
                   <!-- LABORATORIOS -->
                   <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="hard-drive"></i><span>Laboratorios</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-nuevos-laboratorios-informatica">Registrar Laboratorios</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-laboratorios-informatica">Consultar Laboratorios</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-laboratorios-informatica-inactivos">Consultar Laboratorios Inactivos</a></li>
                    </ul>
                  </li>
                  <!-- APLICACIONES COMPUTADORAS -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="monitor"></i><span>Aplicaciones</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-aplicaciones-laboratorios-informatica">Registrar Aplicaciones</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-general">Gestionar Aplicaciones</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-uno">Aplicaciones Laboratorio 1</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-dos">Aplicaciones Laboratorio 2</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-tres">Aplicaciones Laboratorio 3</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-cuatro">Aplicaciones Laboratorio 4</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-cinco">Aplicaciones Laboratorio 5</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-seis">Aplicaciones Laboratorio 6</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-siete">Aplicaciones Laboratorio 7</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-ocho">Aplicaciones Laboratorio 8</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-nueve">Aplicaciones Laboratorio 9</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-diez">Aplicaciones Laboratorio 10</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-once">Aplicaciones Laboratorio 11</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-doce">Aplicaciones Laboratorio 12</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-trece">Aplicaciones Laboratorio 13</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-catorce">Aplicaciones Laboratorio 14</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-aplicaciones-laboratorio-informatica-quince">Aplicaciones Laboratorio 15</a></li>
                    </ul>
                  </li>
                  <!-- TIPOS RESERVACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="filter"></i><span>Tipos Reservaciones</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-nuevos-tipos-reservaciones">Registrar Nuevos Tipos Reservaciones</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-tipos-reservaciones-general">Gestionar Tipos Reservaciones</a></li>
                    </ul>
                  </li>
                  <!-- RESERVACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="zap"></i><span>Reservaciones</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=instrucciones-reservaciones-laboratorios-primera-fase">Instrucciones Uso</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-laboratorios-primera-fase">Nueva Reservaci&oacute;n</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-solicitadas-laboratorios-primera-fase">Nueva Reservaci&oacute;n Solicitada</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-pendientes">Reservaciones Pendientes</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-aprobacion-inicial">Reservaciones Aprobaci&oacute;n Inicial</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-aprobadas">Reservaciones Aprobadas</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-denegadas">Reservaciones Denegadas</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-reservaciones-canceladas">Reservaciones Canceladas</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-mis-reservaciones-procesadas">Mis Reservaciones (Ciclo Actual)</a></li>
                    </ul>
                  </li>
                  <!-- HISTORICO RESERVACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="gitlab"></i><span>Hist&oacute;rico</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=historico-reservaciones-procesadas">Hist&oacute;rico Reservaciones</a></li>
                    </ul>
                  </li>
                  <!-- PRACTICAS LIBRES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="activity"></i><span>Pr&aacute;cticas Libres</span></a>
                    <ul class="nav-submenu menu-content">
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=gestion-reservaciones-laboratorios-practicas-libres">Nueva Reservaci&oacute;n Pr&aacute;ctica Libre</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-activas">Pr&aacute;cticas Libres Activas</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizadas">Pr&aacute;cticas Libres Finalizadas</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-uno">Pr&aacute;cticas Libres Finalizadas Lab1</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-dos">Pr&aacute;cticas Libres Finalizadas Lab2</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-tres">Pr&aacute;cticas Libres Finalizadas Lab3</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-cuatro">Pr&aacute;cticas Libres Finalizadas Lab4</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-cinco">Pr&aacute;cticas Libres Finalizadas Lab5</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-seis">Pr&aacute;cticas Libres Finalizadas Lab6</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-siete">Pr&aacute;cticas Libres Finalizadas Lab7</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-ocho">Pr&aacute;cticas Libres Finalizadas Lab8</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-nueve">Pr&aacute;cticas Libres Finalizadas Lab9</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-diez">Pr&aacute;cticas Libres Finalizadas Lab10</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-once">Pr&aacute;cticas Libres Finalizadas Lab11</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-doce">Pr&aacute;cticas Libres Finalizadas Lab12</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-trece">Pr&aacute;cticas Libres Finalizadas Lab13</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-catorce">Pr&aacute;cticas Libres Finalizadas Lab14</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-practicas-libres-finalizada-laboratorio-quince">Pr&aacute;cticas Libres Finalizadas Lab15</a></li>
                    </ul>
                  </li>
                  <!-- CALENDARIO -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="calendar"></i><span>Calendario</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-general">Calendario Actividades General</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-uno">Calendario Actividades Laboratorio 1</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-dos">Calendario Actividades Laboratorio 2</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-tres">Calendario Actividades Laboratorio 3</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-cuatro">Calendario Actividades Laboratorio 4</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-cinco">Calendario Actividades Laboratorio 5</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-seis">Calendario Actividades Laboratorio 6</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-siete">Calendario Actividades Laboratorio 7</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-ocho">Calendario Actividades Laboratorio 8</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-nueve">Calendario Actividades Laboratorio 9</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-diez">Calendario Actividades Laboratorio 10</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-once">Calendario Actividades Laboratorio 11</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-doce">Calendario Actividades Laboratorio 12</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-trece">Calendario Actividades Laboratorio 13</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-catorce">Calendario Actividades Laboratorio 14</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-calendario-actividades-laboratorio-quince">Calendario Actividades Laboratorio 15</a></li>
                    </ul>
                  </li>
                  <!-- MENSAJERIA -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="mail"></i><span>Mensajer&iacute;a</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=envio-nuevo-mensaje-usuarios">Enviar Nuevo Mensaje</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria">Bandeja de Entrada</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria-oculta">Mensajes Ocultos</a></li>
                    </ul>
                  </li>
                  <!-- NOTIFICACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title link-nav" href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=listado-mis-notificaciones"><i data-feather="bell"></i><span>Notificaciones</span></a></li>
                  <!-- CLASIFICACION NOTIFICACIONES -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="arrow-up-circle"></i><span>Tipos Notificaciones</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=registro-clasificaciones-notificaciones">Registrar Nuevas Clasificaciones</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-clasificaciones-notificaciones">Consultar Clasificaciones</a></li>
                    </ul>
                  </li>
                  <!-- PROBLEMAS PLATAFORMA [MANIFIESTOS] -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layout"></i><span>Reporte Problemas</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=soporte-tecnico-reporte-problemas">Registrar Problema</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=consulta-soporte-tecnico-reporte-problemas">Consultar Reportes Problemas</a></li>
                    </ul>
                  </li>
                  <!-- REPORTERIA -->
                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="coffee"></i><span>Reporter&iacute;a</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=generar-reporte-practicas-libres-rango-fechas">Reporte Pr&aacute;cticas Libres (Todos)</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=reporte-practicas-libres-rango-fechas-laboratorios">Reporte Pr&aacute;cticas Libres (Por Lab)</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=reportes-practicas-libres-rango-ciclos">Reporte Pr&aacute;cticas Libres (Por Ciclo)</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=generar-reporte-reservaciones-por-codigo">Reporte Reservaciones (Por C&oacute;digo)</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=generar-reporte-reservaciones-por-estado">Reporte Reservaciones (Por Estado)</a></li>
                      <li><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=reporte-reservaciones-por-estados-laboratorios">Reporte Reservaciones (Por Estado y Labs)</a></li>
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