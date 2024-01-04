<?php

require_once "vendor/autoload.php";

$documento = '
<!DOCTYPE html>
    <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia Impresas</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .table {
        padding: 10px;
    }

    table {
        border-collapse: collapse;
    }

    table tr th {
        width: 100%;
        border: 1px solid rgba(0, 0, 0, 0.8);
        border-spacing: 0px;
        text-align: start;
        padding: 0% 30px 0px 5px;
    }

    table tr td {
        width: 100%;
        border-spacing: 0px;
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 0px 30px 0px 5px;
    }

    .grid-container-title {
        display: flex;
        grid-template-columns: 1fr 1fr;
        padding: 10px;

    }

    .grid-container-title>div {
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding-top: 1em;
    }

    .grid-container-title>div:nth-child(even) {
        border-left: none;
    }

    .grid-container-title>div:first-child {
        padding-right: 2em;
    }
</style>

<body>
    
        <div class="grid-container-title">
            <div>
                Productos
            </div>
            <div>
                FECHA MANIFIESTO (DD/MM/YYYY):
            </div>

        </div>

        <div class="table">

            <table>
                <thead>
                    <tr>
                        <th colspan="3">Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">Nombre</td>
                        <td>Cantidad</td>
                    </tr>
                </tbody>
            </table>

        </div>


    
   
</body>

</html>   
';

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(10, 15, 10, 15));
$html2pdf->writeHTML($documento);
$html2pdf->output('example.pdf');
