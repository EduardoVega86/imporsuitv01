<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

$nombre_remitente = $_POST['nombre_remitente'];
$direccion_remitente = $_POST['direccion_remitente'];
$telefono_remitente = $_POST['telefono_remitente'];
$ciudad_origen = $_POST['origen_texto'];

$nombre_destino = $_POST['nombre_destino'];
$direccion_destino = $_POST['direccion'];
$telefono_destino = $_POST['celular'];
$ciudad_destino = $_POST['ciudad_texto'];


$sql = "SELECT * FROM `ciudad_cotizacion` WHERE `ciudad` = '$ciudad_origen'";
$result = mysqli_query($conexion, $sql);

$row = mysqli_fetch_array($result);

$codigo_provincia_gintracom = $row['codigo_provincia_gintracom'];
$codigo_ciudad_gintracom = $row['codigo_ciudad_gintracom'];

$sql = "SELECT * FROM `ciudad_cotizacion` WHERE `ciudad` = '$ciudad_destino'";
$result = mysqli_query($conexion, $sql);

$row = mysqli_fetch_array($result);

$codigo_provincia_gintracom_destino = $row['codigo_provincia_gintracom'];
$codigo_ciudad_gintracom_destino = $row['codigo_ciudad_gintracom'];

$productos_guias = $_POST['productos_guia'];

preg_match_all('/([^\dx]+)x(\d+)/', $productos_guias, $coincidencias, PREG_SET_ORDER);

$resultado_final = [];

foreach ($coincidencias as $producto) {
    $nombre = trim($producto[1]); // Eliminamos espacios en blanco alrededor del nombre del producto
    $cantidad = $producto[2];
    $resultado_final[] = "$cantidad * $nombre"; // Formateamos
}

// Unimos los productos formateados con el separador deseado
$productos_guias = implode(' | ', $resultado_final);

$cant_paquetes = "1";
$peso = "2.00";
$observacion = $_POST['observacion'];
$fecha = date("Y-m-d H:i:s");
$declarado = $_POST['valor_total'];
$cod = $_POST['cod'];
$con_recaudo = $cod == "1" ? true : false;

$data = array(
    "remitente" => array(
        "nombre" => $nombre_remitente,
        "direccion" => $direccion_remitente,
        "telefono" => $telefono_remitente,
        "ciudad" => $ciudad_origen,
        "provincia" => $codigo_provincia_gintracom,
        "ciudad" => $codigo_ciudad_gintracom
    ),
    "cant_paquetes" => $cant_paquetes,
    "peso_total" => $peso,
    "observacion" => $observacion,
    "fecha" => $fecha,
    "declarado" => $declarado,
    "con_recaudo" => $con_recaudo,
    "contenido" => $productos_guias,
    "documento_venta" => "000" . rand(100000, 999999),
);

$data = array_merge($data, array("destinatario" => array(
    "nombre" => $nombre_destino,
    "direccion" => $direccion_destino,
    "telefono" => $telefono_destino,
    "ciudad" => $ciudad_destino,
    "provincia" => $codigo_provincia_gintracom_destino,
    "ciudad" => $codigo_ciudad_gintracom_destino
)));

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://ec.gintracom.site/web/import-suite/pedido");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$usuario = "importsuite";
$clave = "ab5b809caf73b2c1abb0e4586a336c3a";

$credenciales = base64_encode($usuario . ":" . $clave);

$headers = array();
$headers[] = "Content-Type: application/json";
// basic auth
$headers[] = "Authorization : Basic " . $credenciales;

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close($ch);

echo $result;
