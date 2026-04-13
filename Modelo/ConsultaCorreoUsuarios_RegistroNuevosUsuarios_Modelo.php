<?php 

     /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/


    // IMPORTAR ARCHIVO DE CONEXION
    require('conexion.php');
    // EVITAR CONSULTAS USUARIOS VACIOS
    if(!empty($_POST["txtcorreo_usuarios"])) {
        $resultado=mysqli_query($conectarsistema,"CALL sp_ConsultarExistenciaUsuarios_RecuperacionCuentas('".$_POST["txtcorreo_usuarios"] ."');");
        // LEER COINCIDENCIAS DE USUARIOS SEGUN INGRESADO EN CAJA DE TEXTO
        $usuario_encontrado = mysqli_num_rows($resultado); // CONTADOR DE BUSQUEDA
        if($usuario_encontrado>0) { // USUARIO EXISTENTE
            // TRUE -> 1 = HA ENCONTRADO LA INFORMACION SOLICITADA
            echo json_decode($usuario_encontrado);
        }else{ // USUARIO NO EXISTENTE
            // FALSE -> 0 = NO HA ENCONTRADO LA INFORMACION SOLICITADA
            echo json_encode($usuario_encontrado);
        }
    }
?>