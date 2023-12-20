<?php
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
require_once "../funciones.php"; //Contiene funcion que conecta a la base de datos

$data = file_get_contents("php://input");
parse_str($data, $data);

$numero_factura = $data['numero_factura'];

$consulta = "SELECT * FROM cabecera_cuenta_pagar WHERE numero_factura = '$numero_factura'";
$resultado = mysqli_query($conexion, $consulta);
$rw = mysqli_fetch_array($resultado);
$visto = $rw['visto'];

if ($visto == 1) {
    $visto = 0;
} else {
    $visto = 1;
}

$consulta = "UPDATE cabecera_cuenta_pagar SET visto = '$visto' WHERE numero_factura = '$numero_factura'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    echo "Visto";
} else {
    echo "Error";
}
