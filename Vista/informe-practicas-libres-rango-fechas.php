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
$pdf->SetTitle("Informe Practicas Libres Finalizadas (Rango Fechas)");
$pdf->AliasNbPages();
$pdf->AddPage('L', array(300, 658));
// CONTENIDO DE REPORTE [DOCUMENTO]
$pdf->SetFont('Arial','',13);
$pdf->Ln(20);
$pdf->MultiCell(633,5,utf8_decode("San Salvador, ".utf8_encode(strftime("%A %d de %B de %Y")).""),'','R');
$pdf->Ln(15);
$pdf->MultiCell(633,5,utf8_decode("Estimado(a) ".$PrimerNombre[0].", usted ha solicitado el respectivo informe de prácticas libres procesadas y finalizadas en el rango de fechas desde ".$FechaInicio." hasta ".$FechaFin.". A continuación le mostramos el detalle general:"));
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
$pdf->Cell(110, 10, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(70, 10, utf8_decode("Carné"), 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'Fecha', 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'Hora Inicio', 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'Hora Fin', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Laboratorio', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Ciclo', 1, 0, 'C', 1);
$pdf->Cell(80, 10, 'Facultad', 1, 0, 'C', 1);
$pdf->Cell(45, 10, utf8_decode("Duración"), 1, 0, 'C', 1);
$pdf->Cell(70, 10, utf8_decode("Aplicación"), 1, 1, 'C', 1);
$pdf->SetFont($fuente_celdas, '', 10);
$contador = 1;
$ContadorFacultadInformatica = 0;
$ContadorFacultadCienciasSociales = 0;
$ContadorFacultadCienciasEmpresariales = 0;
$ContadorFacultadDerecho = 0;
foreach ($consulta as $filas) {
    // CONTADOR POR FACULTAD
    if($filas['idfacultad']==1){
        $ContadorFacultadInformatica++;
    }else if($filas['idfacultad']==2){
        $ContadorFacultadCienciasSociales++;
    }else if($filas['idfacultad']==3){
        $ContadorFacultadCienciasEmpresariales++;
    }else if($filas['idfacultad']==4){
        $ContadorFacultadDerecho++;
    }
    // CONVERTIR MINUTOS A HORAS SI EXCEDE LOS 60 MINUTOS
    if($filas['duracionpractica']>60){
        $ConvertirDuracionMinutos = $filas['duracionpractica'] / 60;
    }else{
        $ConvertirDuracionMinutos = $filas['duracionpractica'];
    }
    $color_fondo = $contador % 2 == 0 ? $color_fondo_celda_par : $color_fondo_celda_impar;
    $pdf->SetFillColor($color_fondo[0], $color_fondo[1], $color_fondo[2]);
    $pdf->SetTextColor(0);
    $pdf->Cell(15, 10, $contador, 0, 0, 'C', 1);
    $pdf->Cell(110, 10, utf8_decode($filas['nombreusuario_reservacion']), 0, 0, 'C', 1);
    $pdf->Cell(70, 10, $filas['carneusuario_reservacion'], 0, 0, 'C', 1);
    $pdf->Cell(55, 10, $filas['fechainicio'], 0, 0, 'C', 1);
    $pdf->Cell(55, 10, $filas['horainicio'], 0, 0, 'C', 1);
    $pdf->Cell(55, 10, $filas['horafin'], 0, 0, 'C', 1);
    $pdf->Cell(40, 10, "LAB".$filas['idlaboratorio'], 0, 0, 'C', 1);
    $pdf->Cell(40, 10, $filas['ciclo'], 0, 0, 'C', 1);
    $pdf->Cell(80, 10, utf8_decode($filas['nombrefacultad']), 0, 0, 'C', 1);
    $pdf->Cell(45, 10, round($ConvertirDuracionMinutos,2) . (($filas['duracionpractica'] > 60) ? ' horas' : ' minutos'), 0, 0, 'C', 1);
    $pdf->Cell(70, 10, $filas['nombreaplicacion'], 0, 1, 'C', 1);
    $contador++;
}

$pdf->SetFont('Arial','',13);
$pdf->Ln(5);
$pdf->MultiCell(595,5,utf8_decode("* En base a todas las prácticas libres procesadas, a continuación se desglosa información de interés respecto a todos los registros. Tome en consideración que acá se muestran absolutamente todos los laboratorios de informática"));
$pdf->Ln(3);
$pdf->SetFont('Arial','',11);
// Define el ancho de la tabla
$tableWidth = 160;

// Define los datos de las celdas de la tabla
$tableData = array(
    array("1. FACULTAD INFORMATICA Y CIENCIAS APLICADAS:", $formatter->towords($ContadorFacultadInformatica, 0)." USUARIOS"),
    array("2. FACULTAD CIENCIAS SOCIALES:", $formatter->towords($ContadorFacultadCienciasSociales, 0)." USUARIOS"),
    array("3. FACULTAD CIENCIAS EMPRESARIALES:", $formatter->towords($ContadorFacultadCienciasEmpresariales, 0)." USUARIOS"),
    array("4. FACULTAD DERECHO:", $formatter->towords($ContadorFacultadDerecho, 0)." USUARIOS")
);

// Inicializa la variable que almacenará el contenido de la tabla
$tableContent = "";
// Recorre los datos de las celdas de la tabla para generar el contenido de la tabla
foreach ($tableData as $rowData) {
    // Obtiene el contenido de la celda de la columna 1 y la columna 2
    $cellContent1 = $rowData[0];
    $cellContent2 = $rowData[1];
    // Genera el contenido de la fila con los espacios en blanco
    $rowContent = "| " . str_pad($cellContent1, 35) . " " . str_pad($cellContent2, 10) . "";
    // Agrega el contenido de la fila al contenido de la tabla
    $tableContent .= $rowContent . "\n";
}
// Genera la tabla completa con los bordes
$table = "+" . str_repeat("-", $tableWidth - 2) . "+\n" . $tableContent . "+" . str_repeat("-", $tableWidth - 2) . "+";
// Imprime la tabla
$pdf->MultiCell(0, 5, utf8_decode($table));
$pdf->SetFont('Arial','',13);
$pdf->Ln(5);
$pdf->MultiCell(633,5,utf8_decode("* Este informe ha sido generado el: ".date("d-m-Y"))." a las ".date("H:i:s").".");


$pdf->Output();
?>