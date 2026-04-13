<?php
require('../vendor/setasign/fpdf/fpdf.php');
use Luecano\NumeroALetras\NumeroALetras;
// DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA EL SALVADOR (UTC-6)
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/El_Salvador');
$Nombre = $_SESSION['nombres_usuario'];
$PrimerNombre = explode(' ', $Nombre, 2);
// CONVERTIR NUMERO A LETRAS
$formatter = new NumeroALetras();
// NO PERMITIR INGRESO SIN INICIAR SESION
if(!isset($_SESSION['id_usuario'])){
    header('location:../Controlador/InicioSesionUsuarios_Controlador.php?laboratorios=iniciarsesion');
  }
// INICIO REPORTE
class PDF extends FPDF{
    private $headerDisplayed = false;
    // CABECERA DE DOCUMENTO
    function Header(){
        if (!$this->headerDisplayed) {
            $this->Image('../Vista/assets/images/ModelosInformesPDF/CabeceraUno.png', 10, 9, 250);
            $this->headerDisplayed = true;
        }
    }

    // PIE DE PAGINA
    function Footer(){
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,' '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
// CREACION DE INSTANCIA DE CLASE
$pdf = new PDF();
$pdf->SetTitle("Informe Reservaciones Procesadas (Rango Fechas - Codigo)");
$pdf->AliasNbPages();
$pdf->AddPage('L', array(300, 1028));
// CONTENIDO DE REPORTE [DOCUMENTO]
$pdf->SetFont('Arial','',13);
$pdf->Ln(20);
$pdf->MultiCell(988,5,utf8_decode("San Salvador, ".utf8_encode(strftime("%A %d de %B de %Y")).""),'','R');
$pdf->Ln(15);
$pdf->MultiCell(988,5,utf8_decode("Estimado(a) ".$PrimerNombre[0].", usted ha solicitado el respectivo informe de reservaciones procesadas en el rango del ciclo ".$Ciclo.". Tome en consideración si los respectivos módulos aparecen vacíos, quiere decir que ese laboratorio en cuestión no maneja el servicio por módulos. A continuación le mostramos el detalle general:"));
$pdf->Ln(5);
// Definir colores y fuentes personalizadas
$color_fondo_cabecera = array(126, 13, 38);
$color_fondo_celda_par = array(242, 245, 246);
$color_fondo_celda_impar = array(222, 235, 247);
$color_borde = array(65, 131, 215);
$fuente_cabecera = 'Arial';
$fuente_celdas = 'Arial';
// Encabezado de la tabla
$pdf->SetFont($fuente_cabecera, 'B', 10);
$pdf->SetFillColor($color_fondo_cabecera[0], $color_fondo_cabecera[1], $color_fondo_cabecera[2]);
$pdf->SetTextColor(255);
$pdf->Cell(15, 10, '#', 1, 0, 'C', 1);
$pdf->Cell(90, 10, 'Identificador', 1, 0, 'C', 1);
$pdf->Cell(40, 10, utf8_decode("Código"), 1, 0, 'C', 1);
$pdf->Cell(35, 10, 'Ciclo', 1, 0, 'C', 1);
$pdf->Cell(75, 10, utf8_decode("Facultad"), 1, 0, 'C', 1);
$pdf->Cell(75, 10, utf8_decode("Escuela"), 1, 0, 'C', 1);
$pdf->Cell(75, 10, utf8_decode("Tipo Reservación"), 1, 0, 'C', 1);
$pdf->Cell(75, 10, utf8_decode("Nombre Reservación"), 1, 0, 'C', 1);
$pdf->Cell(25, 10, utf8_decode("Sección"), 1, 0, 'C', 1);
$pdf->Cell(90, 10, utf8_decode("Títular"), 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Fecha Inicio', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Fecha Fin', 1, 0, 'C', 1);
$pdf->Cell(45, 10, 'Hora Inicio', 1, 0, 'C', 1);
$pdf->Cell(45, 10, 'Hora Fin', 1, 0, 'C', 1);
//$pdf->Cell(35, 10, utf8_decode("Total Prácticas"), 1, 0, 'C', 1);
//$pdf->Cell(55, 10, utf8_decode("Usuarios Atendidos"), 1, 0, 'C', 1);
$pdf->Cell(55, 10, utf8_decode("Aula Procedencia"), 1, 0, 'C', 1);
$pdf->Cell(35, 10, utf8_decode("Laboratorio"), 1, 0, 'C', 1);
$pdf->Cell(35, 10, utf8_decode("Módulo 1"), 1, 0, 'C', 1);
$pdf->Cell(35, 10, utf8_decode("Módulo 2"), 1, 0, 'C', 1);
$pdf->Cell(35, 10, utf8_decode("Módulo 3"), 1, 0, 'C', 1);
$pdf->Cell(35, 10, utf8_decode("Módulo 4"), 1, 1, 'C', 1);
$pdf->SetFont($fuente_celdas, '', 10);
$contador = 1;
foreach ($consulta as $filas) {
    $color_fondo = $contador % 2 == 0 ? $color_fondo_celda_par : $color_fondo_celda_impar;
    $pdf->SetFillColor($color_fondo[0], $color_fondo[1], $color_fondo[2]);
    $pdf->SetTextColor(0);
    $pdf->Cell(15, 10, $contador, 0, 0, 'C', 1);
    $pdf->Cell(90, 10, utf8_decode($filas['codigounico_identificador']), 0, 0, 'C', 1);
    $pdf->Cell(40, 10, utf8_decode($filas['codigoreservacion']), 0, 0, 'C', 1);
    $pdf->Cell(35, 10, utf8_decode($filas['ciclo']), 0, 0, 'C', 1);
    $pdf->Cell(75, 10, utf8_decode($filas['nombrefacultad']), 0, 0, 'C', 1);
    $pdf->Cell(75, 10, utf8_decode($filas['nombre_escuela']), 0, 0, 'C', 1);
    $pdf->Cell(75, 10, utf8_decode($filas['tiporeservacion']), 0, 0, 'C', 1);
    $pdf->Cell(75, 10, utf8_decode($filas['nombrereservacion']), 0, 0, 'C', 1);
    $pdf->Cell(25, 10, (($filas['seccionreservacion'] == 0) ? 'Ninguna' : $filas['seccionreservacion']), 0, 0, 'C', 1);
    $pdf->Cell(90, 10, utf8_decode($filas['nombre_otrotitular']), 0, 0, 'C', 1);
    $pdf->Cell(40, 10, utf8_decode($filas['fechainicioreservacion']), 0, 0, 'C', 1);
    $pdf->Cell(40, 10, utf8_decode($filas['fechafinreservacion']), 0, 0, 'C', 1);
    $pdf->Cell(45, 10, utf8_decode($filas['horainicioreservacion']), 0, 0, 'C', 1);
    $pdf->Cell(45, 10, utf8_decode($filas['horafinreservacion']), 0, 0, 'C', 1);
    //$pdf->Cell(35, 10, utf8_decode($filas['total_practicas']), 0, 0, 'C', 1);
    //$pdf->Cell(55, 10, utf8_decode($filas['usuarios_atendidos']), 0, 0, 'C', 1);
    $pdf->Cell(55, 10, utf8_decode($filas['aula_procedencia']), 0, 0, 'C', 1);
    $pdf->Cell(35, 10, utf8_decode("LAB".$filas['idlaboratorio']), 0, 0, 'C', 1);
    $pdf->Cell(35, 10, (($filas['mod1'] < 0) ? '' : $filas['mod1']), 0, 0, 'C', 1);
    $pdf->Cell(35, 10, (($filas['mod2'] < 0) ? '' : $filas['mod2']), 0, 0, 'C', 1);
    $pdf->Cell(35, 10, (($filas['mod3'] < 0) ? '' : $filas['mod3']), 0, 0, 'C', 1);
    $pdf->Cell(35, 10, (($filas['mod4'] < 0) ? '' : $filas['mod4']), 0, 1, 'C', 1);
    $contador++;
}

$pdf->SetFont('Arial','',13);
$pdf->Ln(5);
$pdf->MultiCell(833,5,utf8_decode("* Este informe ha sido generado el: ".date("d-m-Y"))." a las ".date("H:i:s").".");


$pdf->Output();
?>