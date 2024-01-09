<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '../../../vendor/autoload.php';

use Dompdf\Dompdf;
use setasign\Fpdi\Fpdi;
// Asegúrate de que no haya ninguna salida antes de este punto
ob_start();
// Recolectar datos POST
$factura = $_POST['factura'];

// verificar si hay varios PDFs


$pdfs = $_POST['pdf'];
if (count($pdfs) > 1) {
    // Descargar los PDFs desde la URL
    $guias_laar = [];
    for ($i = 0; $i < count($pdfs); $i++) {
        $pdfContent = file_get_contents("https://api.laarcourier.com:9727/guias/pdfs/DescargarV2?guia=" . $pdfs[$i]);
        if ($pdfContent === false) {
            exit("No se pudo obtener el PDF");
        }
        $temp_pdf = "./temp.pdf";
        file_put_contents($temp_pdf, $pdfContent);
        array_push($guias_laar, $temp_pdf);
    }

    $temp_pdf = "./temp.pdf";
    // Convertir HTML a PDF y guardarlo
    $dompdf = new Dompdf();
    $dompdf->loadHtml($factura);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $output = $dompdf->output();
    file_put_contents('./combined.pdf', $output);

    // Combinar PDFs con FPDI
    for ($i = 0; $i < count($guias_laar); $i++) {
        $pdfContent = file_get_contents($guias_laar[$i]);
        file_put_contents($temp_pdf, $pdfContent);
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile('combined.pdf');
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $pdf->AddPage();
            $tplId = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplId);
        }
        $pageCount = $pdf->setSourceFile($temp_pdf);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $tplId = $pdf->importPage($pageNo);
            $pdf->useTemplate($tplId);
        }
    }
    // Guardar el PDF combinado
    $combinedPdfPath = './combined.pdf';
    $pdf->Output('F', $combinedPdfPath);

    echo $url;
} else {
    $pdfs = $_POST['pdf'][0];

    // Descargar el PDF desde la URL
    $pdfContent = file_get_contents("https://api.laarcourier.com:9727/guias/pdfs/DescargarV2?guia=" . $pdfs);
    if ($pdfContent === false) {
        exit("No se pudo obtener el PDF");
    }
    $temp_pdf = "./temp.pdf";
    file_put_contents($temp_pdf, $pdfContent);



    // Convertir HTML a PDF y guardarlo
    $dompdf = new Dompdf();
    $dompdf->loadHtml($factura);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $output = $dompdf->output();
    file_put_contents('./combined.pdf', $output);

    // Combinar PDFs con FPDI
    $pdf = new Fpdi();
    $pageCount = $pdf->setSourceFile('combined.pdf');
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $pdf->AddPage();
        $tplId = $pdf->importPage($pageNo);
        $pdf->useTemplate($tplId);
    }
    $pageCount = $pdf->setSourceFile($temp_pdf);
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $pdf->importPage($pageNo);
        $size = $pdf->getTemplateSize($templateId);
        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $tplId = $pdf->importPage($pageNo);
        $pdf->useTemplate($tplId);
    }

    // Guardar el PDF combinado
    $combinedPdfPath = './combined.pdf';
    $pdf->Output('F', $combinedPdfPath);

    // Descargar el PDF combinado
    $url = 'combined.pdf';

    echo $url;
}
