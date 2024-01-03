<?php

$data = file_get_contents("php://input");
parse_str($data, $datos);

$id_factura = $datos['id_factura'];

$precio = $datos['precio'];
$total_ventassss = $datos['venta'];
$costo = $datos['costo'];

$marketplace = 'imporsuit_marketplace';
$conexion_marketplace = mysqli_connect('localhost', $marketplace, $marketplace, $marketplace);
$sql_datos = "SELECT * FROM `cabecera_cuenta_pagar` WHERE `numero_factura`='$id_factura'";
$resultado_datos = mysqli_query($conexion_marketplace, $sql_datos);
$datos = mysqli_fetch_assoc($resultado_datos);
echo mysqli_error($conexion_marketplace);
$valor_pendiente = $datos['valor_pendiente'];
$total_venta = $datos['total_venta'];
$costo = $datos['costo'];
$estado_guia = $datos['estado_guia'];

if ($estado_guia == 9) {
    $actualizada = $precio + ($precio * 0.25);
    $actualizada *= -1;
} else {
    $actualizada = $total_venta - $costo - $precio;
}


$sql = "UPDATE `cabecera_cuenta_pagar` SET `precio_envio`=$precio, `monto_recibir`='$actualizada', `valor_pendiente`='$actualizada',`total_venta`='$total_ventassss',`costo`='$costo'  WHERE `numero_factura`='$id_factura'";
$resultado = mysqli_query($conexion_marketplace, $sql);

if ($resultado) {
    echo 'si';
} else {
    echo 'no';
}
echo mysqli_error($conexion_marketplace);
