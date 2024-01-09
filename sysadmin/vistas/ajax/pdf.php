<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '../../../vendor/autoload.php';

use Dompdf\Dompdf;
use setasign\Fpdi\Fpdi;

ob_start(); // Iniciar buffer de salida

function generateUniqueFilename($prefix, $directory = '.')
{
    $tempFile = tempnam($directory, $prefix);
    unlink($tempFile); // Eliminar el archivo temporal creado por tempnam
    return $tempFile . '.pdf'; // Devolver el nombre de archivo con extensión .pdf
}

function combinePdfs($pdfPaths, $outputPath)
{
    $pdf = new Fpdi();
    foreach ($pdfPaths as $filePath) {
        $pageCount = $pdf->setSourceFile($filePath);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($templateId);
        }
    }
    $pdf->Output('F', $outputPath);
}

$factura = $_POST['factura'];
$pdfs = $_POST['pdf'];
$combinedPdfPath = generateUniqueFilename('combined_', __DIR__ . '/save'); // Ruta al directorio donde guardar los archivos

// Convertir HTML a PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($factura);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$htmlOutputPath = generateUniqueFilename('html_', '/temps'); // Asegúrate de que '/path/to/directory' sea un directorio escribible
file_put_contents($htmlOutputPath, $dompdf->output());

if (is_array($pdfs)) {
    $downloadedPdfs = [$htmlOutputPath]; // Incluir el HTML PDF al principio del array
    foreach ($pdfs as $pdfUrl) {
        $pdfContent = file_get_contents("https://api.laarcourier.com:9727/guias/pdfs/DescargarV2?guia=" . $pdfUrl);
        if ($pdfContent === false) {
            exit("No se pudo obtener el PDF de la guía: $pdfUrl");
        }
        $tempPdfPath = generateUniqueFilename('temp_', '/temps');
        file_put_contents($tempPdfPath, $pdfContent);
        array_push($downloadedPdfs, $tempPdfPath);
    }
    combinePdfs($downloadedPdfs, $combinedPdfPath);
    // Eliminar archivos temporales
    foreach ($downloadedPdfs as $filePath) {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
} else {
    // Manejo de un solo PDF
    $pdfUrl = $pdfs;
    $pdfContent = file_get_contents("https://api.laarcourier.com:9727/guias/pdfs/DescargarV2?guia=" . $pdfUrl);
    if ($pdfContent === false) {
        exit("No se pudo obtener el PDF de la guía: $pdfUrl");
    }
    $tempPdfPath = generateUniqueFilename('temp_', '/temps');
    file_put_contents($tempPdfPath, $pdfContent);
    combinePdfs([$htmlOutputPath, $tempPdfPath], $combinedPdfPath);
    // Eliminar el archivo temporal
    if (file_exists($tempPdfPath)) {
        unlink($tempPdfPath);
    }
}

echo $combinedPdfPath; // Devolver el nombre del PDF combinado final
ob_end_flush(); // Vaciar y desactivar el buffer de salida
