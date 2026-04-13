<?php
    /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/
    
// RUTA - httpdocs/Modelo/CambioForzadoEstadoNuevaCredencialesUsuarios.php
$servername = "";
$username = "";
$password = "";
$dbname = "";
// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
// Ejecutar procedimiento almacenado
$sql = "CALL sp_CambioEstadoCambioCredencialesUsuarios()";
$result = mysqli_query($conn, $sql);
// Verificar si se ejecutó correctamente
if (!$result) {
    die("Error al ejecutar el procedimiento almacenado: " . mysqli_error($conn));
}
// Cerrar conexión
mysqli_close($conn);
?>
