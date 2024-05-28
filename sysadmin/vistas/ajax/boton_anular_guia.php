<?php
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos

$id_factura_origen = $_POST['id_factura_origen'];
$numero_factura = $_POST['numero_factura'];
$transportadora = $_POST['transportadora'];

if ($transportadora == 'FAST' || $transportadora == 'LAAR'){
    $estado_guia = 8;
} else if ($transportadora == 'SERVIENTREGA'){
    $estado_guia = 101;
}

$sql_factura_update = "UPDATE facturas_cot SET estado_guia_sistema = '$estado_guia' WHERE numero_factura = '$numero_factura'";
$result_factura_update = mysqli_query($conexion, $sql_factura_update);

$sql_guia_update = "UPDATE facturas_cot SET estado_guia = '$estado_guia' WHERE id_pedido = '$id_factura_origen'";
$result_guia_update = mysqli_query($conexion, $sql_guia_update);

echo $estado_guia;