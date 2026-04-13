<?php
require('../vendor/setasign/fpdf/fpdf.php');
// DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA EL SALVADOR (UTC-6)
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/El_Salvador');
$Nombre = $_SESSION['nombres_usuario'];
$PrimerNombre = explode(' ', $Nombre, 2);
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
            $this->Image('../Vista/assets/images/ModelosInformesPDF/CabeceraUno.png', 10, 9, 190);
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
$pdf->SetTitle("Informe nuevos usuarios - CashMan H.A");
$pdf->AliasNbPages();
$pdf->AddPage();
// CONTENIDO DE REPORTE [DOCUMENTO]
$pdf->SetFont('Arial','',10);
$pdf->Ln(20);
$pdf->MultiCell(190,5,utf8_decode("San Salvador, ".utf8_encode(strftime("%A %d de %B de %Y")).""),'','R');
$pdf->Ln(10);
$pdf->MultiCell(190,5,utf8_decode("Estimado(a) ".$PrimerNombre[0].", usted ha solicitado una reservación en el laboratorio ".$Gestiones->getIdLaboratorio()." de informática, bajo el identificador único ".$Gestiones->getCodigoUnicoIdentificadorReservacion().". A continuación le mostramos el detalle general de su reservación:"));
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
$pdf->Cell(10, 10, '#', 1, 0, 'C', 1);
$pdf->Cell(36, 10, 'Fecha Inicio', 1, 0, 'C', 1);
$pdf->Cell(36, 10, 'Fecha Fin', 1, 0, 'C', 1);
$pdf->Cell(36, 10, 'Hora Inicio', 1, 0, 'C', 1);
$pdf->Cell(36, 10, 'Hora Fin', 1, 0, 'C', 1);
$pdf->Cell(36, 10, 'Laboratorio', 1, 1, 'C', 1);
$pdf->SetFont($fuente_celdas, '', 10);
$contador = 1;
foreach ($consulta as $filas) {
    $color_fondo = $contador % 2 == 0 ? $color_fondo_celda_par : $color_fondo_celda_impar;
    $pdf->SetFillColor($color_fondo[0], $color_fondo[1], $color_fondo[2]);
    $pdf->SetTextColor(0);
    $pdf->Cell(10, 10, $contador, 0, 0, 'C', 1);
    $pdf->Cell(36, 10, $filas['fechainicioreservacion'], 0, 0, 'C', 1);
    $pdf->Cell(36, 10, $filas['fechafinreservacion'], 0, 0, 'C', 1);
    $pdf->Cell(36, 10, $filas['horainicioreservacion'], 0, 0, 'C', 1);
    $pdf->Cell(36, 10, $filas['horafinreservacion'], 0, 0, 'C', 1);
    $pdf->Cell(36, 10, $filas['codigolaboratorio'], 0, 1, 'C', 1);
    $contador++;
}
$pdf->SetFont('Arial','',10);
$pdf->Ln(3);
$pdf->MultiCell(190,5,utf8_decode("Por favor tome en cuenta algunas generalidades al momento de iniciar su reservación en las fechas y horas indicadas:"));
$pdf->Ln(3);
$pdf->MultiCell(190,5,utf8_decode("1. Su reservación ha sido registrada bajo el identificador único ".$Gestiones->getCodigoUnicoIdentificadorReservacion()."."));
$pdf->Ln(2);
$pdf->MultiCell(190,5,utf8_decode("2. Nos reservamos el derecho, de a pesar de tener su reservación aprobada, por motivos de fuerza mayor, a cancelar su reservación, o bien reasignar la misma a otro laboratorio."));
$pdf->Ln(2);
$pdf->MultiCell(190,5,utf8_decode("3. Usted está obligado a registrar el seguimiento de cada una de las reservaciones que le ha sido asignado. Le rogamos y lo realice en el mismo día que fue atendida su reservación, ya que esto nos ayuda a llevar un control estadístico de todas las reservaciones procesadas."));
$pdf->Ln(2);
$pdf->MultiCell(190,5,utf8_decode("4. Si por algún motivo su reservación no puede llevarse a cabo, por favor informarlo oportunamente al encargado del laboratorio el cual usted ha solicitado la respectiva reservación. Esto con el fin de liberar nuevamente el espacio que usted ha solicitado a otro usuario que desee realizar una reservación en el mismo día y horarios establecidos."));
$pdf->Ln(2);
$pdf->MultiCell(190,5,utf8_decode("Agradecemos mucho su buena disposición en seguir los líneamientos, esto nos ayuda a ofrecer un mejor servicio a todos nuestros usuarios."));

$pdf->Output();
?>