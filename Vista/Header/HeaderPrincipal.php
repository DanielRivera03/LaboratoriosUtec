    <?php
      // NO PERMITIR VISTA SIN NO EXISTE SESION ACTIVA 
        if(empty($_SESSION["id_usuario"])){
            header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
        }else{
    ?>
    <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <div class="logo-wrapper"><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas"><img class="img-fluid" src="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/logo.png" alt=""></a></div>
            <div class="dark-logo-wrapper"><a href="<?php echo $UrlGlobal; ?>Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=redirecciones-sistema-predeterminadas"><img class="img-fluid" src="<?php echo $UrlGlobal; ?>Vista/assets/images/logo/dark-logo.png" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
          </div>
          
          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
            <li class="onhover-dropdown">
              <?php 
                if($hora->format('G')>=17 && $hora->format('G')<18){
                  echo "
                  <img class='icon-info-horarios' style='width: 40px; margin: 0; padding:0; border: 0;' src='". $UrlGlobal. "Vista/assets/images/icon-weather/sunset.svg'>
                  ";
                }else if($hora->format('G')>=18 && $hora->format('G')<=23 || $hora->format('G')>=0 && $hora->format('G')<5){
                  echo "
                  <img class='icon-info-horarios' style='width: 40px; margin: 0; padding:0; border: 0;' src='". $UrlGlobal. "Vista/assets/images/icon-weather/falling-stars.svg'>
                  ";
                }else if($hora->format('G')>=5 && $hora->format('G')<7){
                  echo "
                  <img class='icon-info-horarios' style='width: 40px; margin: 0; padding:0; border: 0;' src='". $UrlGlobal. "Vista/assets/images/icon-weather/moonset.svg'>
                  ";
                }else if($hora->format('G')>=6 && $hora->format('G')<8){
                  echo "
                  <img class='icon-info-horarios' style='width: 40px; margin: 0; padding:0; border: 0;' src='". $UrlGlobal. "Vista/assets/images/icon-weather/sunrise.svg'>
                  ";
                }else if($hora->format('G')>=7 && $hora->format('G')<17){
                  echo "
                  <img class='icon-info-horarios' style='width: 40px; margin: 0; padding:0; border: 0;' src='". $UrlGlobal. "Vista/assets/images/icon-weather/sun-hot.svg'>
                  ";
                }
              ?>
              <span> </span><span id="reloj"></span>
              </li>
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li class="onhover-dropdown">
                <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
                <ul class="notification-dropdown onhover-show-div">
                  <?php 
                     $ComprobarNotificaciones = 0;
                     // TODAS LAS NOTIFICACIONES RECIBIDAS
                     while ($filas = mysqli_fetch_array($consulta)){
                         if ($ComprobarNotificaciones == 0)
                             $ComprobarNotificaciones = 1;
                          // CAMBIO DE ESTADO APROBADO SOLICITUDES DE RESERVACIONES
                          if($filas["idclasificacion"] == 1){
                            echo '<li class="noti-primary">
                            <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="alert-octagon"> </i></span>
                            <div class="media-body">
                              <p style="font-size: .8rem">'.$filas['titulonotificacion'].' </p><span><time class="timeago" datetime="'.$filas["fechanotificacion"].'"></time></span>
                            ';
                          }
                          // CAMBIO DE ESTADO DENEGADO SOLICITUDES DE RESERVACIONES
                          if($filas["idclasificacion"] == 2){
                            echo '<li class="noti-primary">
                            <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="alert-octagon"> </i></span>
                            <div class="media-body">
                              <p style="font-size: .8rem">'.$filas['titulonotificacion'].' </p><span><time class="timeago" datetime="'.$filas["fechanotificacion"].'"></time></span>
                            ';
                          }
                          // NUEVOS MENSAJES RECIBIDOS
                          else if($filas["idclasificacion"] == 3){
                            echo '<li class="noti-primary">
                            <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="mail"> </i></span>
                            <div class="media-body">
                              <p style="font-size: .8rem">Has recibido un nuevo mensaje </p><span><time class="timeago" datetime="'.$filas["fechanotificacion"].'"></time></span>
                            ';
                          // CAMBIO DE ESTADO APROBACION INICIAL SOLICITUDES DE RESERVACIONES
                          }else if($filas["idclasificacion"] == 4){
                            echo '<li class="noti-primary">
                            <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="alert-octagon"> </i></span>
                            <div class="media-body">
                              <p style="font-size: .8rem">'.$filas['titulonotificacion'].' </p><span><time class="timeago" datetime="'.$filas["fechanotificacion"].'"></time></span>
                            ';
                          // CAMBIO DE ESTADO CANCELADO SOLICITUDES DE RESERVACIONES [GRUPO DE RESERVACIONES]
                          }else if($filas["idclasificacion"] == 5){
                            echo '<li class="noti-primary">
                            <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="alert-octagon"> </i></span>
                            <div class="media-body">
                              <p style="font-size: .8rem">'.$filas['titulonotificacion'].' </p><span><time class="timeago" datetime="'.$filas["fechanotificacion"].'"></time></span>
                            ';
                          }
                          // CAMBIO DE ESTADO CANCELADO SOLICITUDES DE RESERVACIONES [RESERVACIONES INDIVIDUALES]
                          else if($filas["idclasificacion"] == 6){
                            echo '<li class="noti-primary">
                            <div class="media"><span class="notification-bg bg-light-primary"><i data-feather="alert-octagon"> </i></span>
                            <div class="media-body">
                              <p style="font-size: .8rem">'.$filas['titulonotificacion'].' </p><span><time class="timeago" datetime="'.$filas["fechanotificacion"].'"></time></span>
                            ';
                          }
                          echo '
                            
                            </div>
                          </div>
                        </li>
                          
                          ';
                     }
                     // SI NO EXISTEN REGISTROS, NO HAY CONSULTA QUE MOSTRAR
								            if ($ComprobarNotificaciones == 0){
                              echo '
                              <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
                                          <div class="card">
                                              <div class="card-body text-center ai-icon  text-primary">
                                                  <img style="width: 100%; height: 100%; max-width: 100px;" class="img-fluid" src="';
                                                  echo $UrlGlobal; echo'Vista/assets/images/coffee-cup.gif">
                                                  <h4 class="my-2"><button class="btn btn-danger" type="button"><span class="badge rounded-pill badge-light text-dark"></span>A&uacute;n no has recibido notificaciones<br><span style="background: #000; color: #fff;">Tranquilo, pronto las recibir&aacute;s</span></span></button></h4>
                                              </div>
                                          </div>
                                      </div>
                              ';
                          }
                  ?>
                  
                  
                </ul>
              </li>
              <li>
                <div class="mode"><i class="fa fa-moon-o"></i></div>
              </li>
              <li class="onhover-dropdown"><i data-feather="message-square"></i>
                <ul class="chat-dropdown onhover-show-div">
                  <?php 
                    $ComprobarMensajes = 0;
                    // TODAS LAS NOTIFICACIONES RECIBIDAS
                    while ($filas = mysqli_fetch_array($consulta1)){
                      if ($ComprobarMensajes == 0)
                        $ComprobarMensajes = 1;
                        echo '
                        <li>
                        <div class="media"><img style="max-width: 30px;" class="img-fluid rounded-circle me-3" src="'.$UrlGlobal.'Vista/assets/images/FotoPerfil/'.$filas["fotoperfil"].'" alt="">
                          <div class="media-body"><span>'.$filas["nombres"].' '.$filas["apellidos"].'</span>
                            <p class="f-12 light-font">Asunto del mensaje: '.$filas["asuntomensaje"].'</p>
                          </div>
                          <p class="f-12"><time class="timeago" datetime="'.$filas["fechamensaje"].'"></time></p>
                        </div>
                      </li>
                  
                        ';
                    }
                    // SI NO EXISTEN REGISTROS, NO HAY CONSULTA QUE MOSTRAR
                    if ($ComprobarMensajes == 0){
                      echo '
                      <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
                                  <div class="card">
                                      <div class="card-body text-center ai-icon  text-primary">
                                          <img style="width: 100%; height: 100%; max-width: 100px;" class="img-fluid" src="';
                                          echo $UrlGlobal; echo'Vista/assets/images/coffee-cup.gif">
                                          <h4 class="my-2"><button class="btn btn-danger" type="button"><span class="badge rounded-pill badge-light text-dark"></span>A&uacute;n no has recibido mensajes<br><span style="background: #000; color: #fff;">Tranquilo, pronto los recibir&aacute;s</span></span></button></h4>
                                      </div>
                                  </div>
                              </div>
                      ';
                  }
                  ?>
                  
                  
                  <li class="text-center"><a class="f-w-700" href="<?php echo $UrlGlobal; ?><?php 
                    if($_SESSION['id_rolusuario'] == 1){
                      echo "Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria";
                    }else if($_SESSION['id_rolusuario'] == 2){
                      echo "Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria-administrador-laboratorios";
                    }else if($_SESSION['id_rolusuario'] == 3){
                      echo "Controlador/GestionesLaboratorios_Controlador.php?gestioneslaboratorios=bandeja-entrada-mensajeria-docentes";
                    }
                  ?>">Ver Todos     </a></li>
                </ul>
              </li>
              <li class="onhover-dropdown p-0">
                <button class="btn btn-primary-light" type="button"><a href="<?php echo $UrlGlobal; ?>Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=cerrarsesion"><i data-feather="log-out"></i>Salir</a></button>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>
      <!-- Page Header Ends -->
      <?php } ?>