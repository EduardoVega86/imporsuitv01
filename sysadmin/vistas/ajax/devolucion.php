<?php

require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

$data = file_get_contents('php://input');
parse_str($data, $output);

$guia_laar = $output['guia_laar'];

$sql = "SELECT * FROM cabecera_cuenta_pagar WHERE guia_laar = '$guia_laar'";
$resultado = mysqli_query($conexion, $sql);
$rw = mysqli_fetch_array($resultado);

$id_cabecera = $rw['id_cabecera'];

$precio_envio = $rw['precio_envio'];

$nuevo = 0 - $precio_envio - ($precio_envio * 0.25);

$nuevo = number_format($nuevo, 2, '.', '');

$sql_update = "UPDATE cabecera_cuenta_pagar SET monto_recibir = '$nuevo', valor_pendiente='$nuevo', estado_guia ='9' WHERE id_cabecera = '$id_cabecera'";
$resultado_update = mysqli_query($conexion, $sql_update);

if ($resultado_update) {
    echo "Actualizado";
} else {
    echo "Error";
}
