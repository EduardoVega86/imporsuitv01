<?php
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos

$data = file_get_contents("php://input");
parse_str($data, $datos);
$guia = $datos['guia'];
$cot = $datos['cot'];
$sql_servientrega = "SELECT estado_guia FROM guia_laar WHERE guia_laar = '$guia'";
$result_servientrega = mysqli_query($conexion, $sql_servientrega);
$row = mysqli_fetch_assoc($result_servientrega);
$estado_guia = $row['estado_guia'];

$sql_servientrega_update = "UPDATE facturas_cot SET estado_guia_sistema = '$estado_guia' WHERE numero_factura = '$cot'";
$result_servientrega_update = mysqli_query($conexion, $sql_servientrega_update);

echo $estado_guia;
