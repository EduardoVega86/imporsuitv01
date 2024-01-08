<?php
$factura = $_POST['factura'];
$pdfs = $_POST['pdfs'];

use Dompdf\Dompdf;
use setasign\Fpdi\Fpdi;

require_once '../../../vendor/autoload.php';

// Cargar el contenido HTML y PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($factura);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$output = $dompdf->output();

// Guardar el HTML convertido a PDF temporalmente
file_put_contents('combined.pdf', $output);

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
$pageCount = $pdf->setSourceFile($pdfs);
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    $templateId = $pdf->importPage($pageNo);
    $size = $pdf->getTemplateSize($templateId);
    $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
    $tplId = $pdf->importPage($pageNo);
    $pdf->useTemplate($tplId);
}

// Salida del PDF combinado
$pdf->Output('D', 'combined.pdf');
