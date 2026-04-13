<?php 

    /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/

    session_start();
    // IMPORTAR ARCHIVO DE CONEXION
    require('conexion.php');
    // EVITAR CONSULTAS USUARIOS VACIOS
    if(!empty($_POST["txtcodigoseguridad"])) {
        $resultado=mysqli_query($conectarsistema,"CALL sp_VerificarCodigoSeguridad('".$_POST["txtcodigoseguridad"] ."','".$_SESSION['CorreoUsuarios'] ."','".$_SESSION['TokenUsuarios'] ."');");
        // LEER COINCIDENCIAS DE USUARIOS SEGUN INGRESADO EN CAJA DE TEXTO
        $usuario_encontrado = mysqli_num_rows($resultado); // CONTADOR DE BUSQUEDA
        if($usuario_encontrado>0) { // USUARIO EXISTENTE
            echo json_decode($usuario_encontrado);
        }else{ // USUARIO NO EXISTENTE
            // USUARIOS NO REGISTRADOS EN EL SISTEMA
            // IMPRESIO DE BOTON -> RESTRICCION PARA REESTABLECER CONTRASEÑA [BLOQUEADO]
            $UsuarioNoDisponible = "<div class='alert alert-danger outline alert-dismissible fade show mt-2' role='alert'><i class='icofont icofont-close-circled'></i>
            Lo sentimos, el c&oacute;digo de seguridad ingresado no es v&aacute;lido. Ingrese el &uacute;ltimo c&oacute;digo de seguridad recibido si ha realizado m&uacute;ltiples peticiones. [Error: Expirado y/o Inv&aacute;lido].</p>";
            echo json_decode($usuario_encontrado);
        }
    }
?>