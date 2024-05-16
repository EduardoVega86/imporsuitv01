<?php
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos

$data = file_get_contents("php://input");
parse_str($data, $datos);
$estado = $datos['estado'];
$guia = $datos['guia'];
$cot = $datos['cot'];
$peso = $datos['peso'];
$sql = "UPDATE cabecera_cuenta_pagar SET estado_pedido = '$estado' WHERE guia_laar = '$guia' AND peso = '$peso' ";
$result = mysqli_query($conexion, $sql);
$result_cot = mysqli_query($conexion, $sql_cot);
if ($result) {
    echo "1";
} else {
    echo "0";
}
