<?php 


     /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/


    class conexion
    {
        private $servidor = "localhost"; // NOMBRE SERVIDOR
        private $usuario = "root"; // USUARIO SERVIDOR
        private $clave = ""; // CONTRASEÑA SERVIDOR 
        private $base = "control_laboratorios_utec"; // NOMBRE DE BASE DE DATOS
        public $establecerconexion; // VARIABLE PUBLICA DE CONEXION*/
        // DATOS DE CONECTIVIDAD BD -> SISTEMA
        public function setServidor($obteniendoservidor)
        {
            $this->servidor = $obteniendoservidor;
        }
        public function getServidor()
        {
            return $this->servidor;
        }
    
        // CONECTAR SISTEMA Y COMPROBACION DE CONEXION
        public function conectar($bd)
        {
            $miconexion = new mysqli($this->servidor, $this->usuario, $this->clave, $bd);
            if ($miconexion->connect_errno) {
                /*echo*/
                $mensaje = "Lo sentimos, ha ocurrido un error de conexion" . $miconexion->connect_error;
            } else {
                /*echo*/
                $mensaje = "Enhorabuena, conexion exitosa";
                $this->establecerconexion = $miconexion;
            }
            return $mensaje;
        }
        
        // INICIO DE SESION -> TODOS LOS USUARIOS
        public function IniciarSesionUsuarios($conectarsistema, $usuario, $contrasenia)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_InicioSesionUsuarios('$usuario','$contrasenia');");
            return $resultado;
        }
    
        public function CosultarCredencialEncriptada($conectarsistema, $usuario)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ConsultarCredencialesUsuarios('$usuario');");
            return $resultado;
        }
        
    } // CIERRE CLASE CONEXION
    
    // CONECTAR SISTEMA CON BASE DE DATOS {CONEXION PRINCIPAL TODO EL SISTEMA}
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema = $conectando->establecerconexion;
    /*
	    -> CONEXIONES AUXILIARES -> GESTIONES ESPECIFICAS CASHMAN H.A.
	    DISPONIBLES EN MULTIPLES CONSULTAS REALIZADAS EN UNA SOLA PAGINA
    */
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema1 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema2 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema3 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema4 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema5 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema6 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema7 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema8 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema9 = $conectando->establecerconexion;
    $conectando = new conexion();
    $conectando->conectar("control_laboratorios_utec");
    $conectarsistema10 = $conectando->establecerconexion;
    ?>