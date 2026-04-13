<script>
			// FUNCION PARA MOSTRAR ALERTAS A USUARIOS
			function AlertaUsuarioMostrar(titulo, descripcion, icono) {
				swal(
					titulo, // ENCABEZADO 
					descripcion, // CUERPO
					icono // ICONO DE ALERTA
				);
			}
		<?php 
			if($_SESSION['id_rolusuario']>=1 && $_SESSION['id_rolusuario']<=2){
				echo "var TiempoInactividad = 300;"; // COORDINADORES Y ADMINISTRADORES DE LABORATORIOS
			}else{
				echo "var TiempoInactividad = 180;"; // DOCENTES
			}
		?>
		// DETECTAR EVENTOS PARA REINICIO DE CONTADOR -> EJECUTAR TODAS LAS FUNCIONES ASIGNADAS
        $(document).ready(function() {
            let idleInterval =
                setInterval(CalcularInactividadUsuarios, 1000);
            $(this).mousemove(ReiniciarContadorTiempoInactividad);
            $(this).keypress(ReiniciarContadorTiempoInactividad);
        });
		// REINICIO DE CONTADOR CON SOLO MOVER EL CURSOR, O CUALQUIER PULSACION DE TECLA
        function ReiniciarContadorTiempoInactividad() {
			<?php 
				if($_SESSION['id_rolusuario']>=1 && $_SESSION['id_rolusuario']<=3){
					echo "TiempoInactividad = 300;";
				}else{
					echo "TiempoInactividad = 180;";
				}
			?>
        }
		// CALCULAR INACTIVIDAD DE USUARIOS
        function CalcularInactividadUsuarios() {
            TiempoInactividad = TiempoInactividad - 1;
			if(TiempoInactividad == 10){
				AlertaUsuarioMostrar("Advertencia", "Tu sesión se cerrará por seguridad, si no presentas actividad durante los próximos 10 segundos", "warning");
			}
			else if (TiempoInactividad == 0){
				// SESION FINALIZADA
				AlertaUsuarioMostrar("Sesión Finalizada", "Hemos cerrado tu sesión por seguridad", "error");
				/*setTimeout(function (){
					location.href = "<?php echo $UrlGlobal; ?>Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=cerrarsesion";
				}, 1000); */
			}
        }
    </script>