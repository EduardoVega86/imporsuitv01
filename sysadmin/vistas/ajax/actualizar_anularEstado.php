<?php
// Datos de autenticación
require_once "../db.php";
require_once "../php_conexion.php";


$numero_factura = $_POST['numero_factura'];

$sql_servientrega_update = "UPDATE facturas_cot SET estado_guia_sistema = 101 WHERE numero_factura = '$numero_factura'";
$result_servientrega_update = mysqli_query($conexion, $sql_servientrega_update);
echo "anulada";
