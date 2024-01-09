<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "vendor/autoload.php";

use Dompdf\Dompdf;
use setasign\Fpdi\Fpdi;

// Cargar el contenido HTML y PDF
$pdfContent = file_get_contents("https://api.laarcourier.com:9727/guias/pdfs/DescargarV2?guia=IMP21897"); // Simula el PDF recibido
$html = file_get_contents("./test.html"); // Simula el HTML recibido

// Convertir HTML a PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$output = $dompdf->output();

// Guardar el HTML convertido a PDF temporalmente
file_put_contents('combined.pdf', $output);
$temp_pdf = "./temp.pdf";
file_put_contents($temp_pdf, $pdfContent);
// Inicializar FPDI
$pdf = new Fpdi();

// Número de páginas del PDF original
$pageCount = $pdf->setSourceFile('combined.pdf');
// Importar cada página del HTML convertido a PDF y añadirla
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $pdf->AddPage();
    $tplId = $pdf->importPage($pageNo);
    $pdf->useTemplate($tplId);
}

// Añadir el PDF original
$pageCount = $pdf->setSourceFile($temp_pdf);
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $templateId = $pdf->importPage($pageNo);
    $size = $pdf->getTemplateSize($templateId);
    $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
    $tplId = $pdf->importPage($pageNo);
    $pdf->useTemplate($tplId);
}

// Salida del PDF combinado
$pdf->Output('D', 'combined.pdf');
