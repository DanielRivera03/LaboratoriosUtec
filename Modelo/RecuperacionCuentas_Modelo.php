<?php 

     /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/

    class RecuperacionCuentas
    {
        // INSERTAR DATOS DE RECUPERACION -> SOLICITUD DE REESTABLECIMIENTO DE CONTRASEÑAS USUARIOS
        public function RecuperarCuentasUsuarios($conectarsistema, $Destinatario, $Token, $CodigoRecuperacion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_ReestablecerContrasenias('" . $Destinatario . "','" . $Token . "','" . $CodigoRecuperacion . "');");
            /*if($resultado){
                // CORREO ENVIADO
                header('location:../controlador/InicioSesionUsuarios_Controlador.php?laboratorios=confirmacion-correo-recuperacion-cuentas');
            }else{
                 // CORREO NO ENVIADO
                 header('location:../controlador/InicioSesionUsuarios_Controlador.php?laboratorios=error-correo-recuperacion-cuentas');
            }*/
            return $resultado;
        }
        // CAMBIO DE CONTRASEÑAS USUARIOS -> RECUPERACION DE CUENTAS
        public function CambioContraseniaRecuperacion($conectarsistema, $Correo, $Contrasenia)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_CambioContraseniaRecuperacion('" . $Contrasenia . "','" . $Correo . "');");
            return $resultado;
        }
        // CAMBIO ESTADO CODIGO DE SEGURIDAD ENVIADO A CORREO DE USUARIOS [NOUSADO -> USADO]
        public function CambioEstadoCodigoSeguridad($conectarsistema, $Correo, $TokenSeguridad, $CodigoSeguridad, $Estado)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_CambioEstadoToken('" . $Correo . "','" . $TokenSeguridad . "','" . $CodigoSeguridad . "','" . $Estado . "');");
            return $resultado;
        }
        // REGISTRO DE ACCESOS -> DATOS DE INICIO DE SESION TODOS LOS USUARIOS
        public function RegistrarAccesosUsuarios($conectarsistema, $FechaIngreso, $IdUsuarios)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroAccesosUsuarios('" . $FechaIngreso . "','" . $IdUsuarios . "');");
            return $resultado;
        }
        // REGISTRO CIERRE DE SESIONES USUARIOS -> TODOS LOS ROLES AL MOMENTO DE PRESIONAR BOTON DE CIERRE DE SESION
        public function RegistroCierreSesionUsuarios($conectarsistema, $IdUsuarios, $FechaCierreSesion)
        {
            $resultado = mysqli_query($conectarsistema, "CALL sp_RegistroCierreSesionUsuarios('" . $IdUsuarios . "','" . $FechaCierreSesion . "');");
            if ($resultado) {
                return "OK";
            } else {
                return "ERROR";
            }
        }
    }
?>