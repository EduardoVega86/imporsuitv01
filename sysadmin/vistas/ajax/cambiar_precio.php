<?php

$data = file_get_contents("php://input");
parse_str($data, $datos);

$precio = $datos['precio'];
$id_factura = $datos['id_factura'];

$marketplace = 'imporsuit_marketplace';
$conexion_marketplace = mysqli_connect('localhost', $marketplace, $marketplace, $marketplace);

$sql = "UPDATE `cabecera_cuenta_cobrar` SET `precio_envio`=$precio WHERE `numero_factura`='$id_factura'";
$resultado = mysqli_query($conexion_marketplace, $sql);

if ($resultado) {
    echo 'si';
} else {
    echo 'no';
}
echo mysqli_error($conexion_marketplace);
