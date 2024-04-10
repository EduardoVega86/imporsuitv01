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


$sql = "SELECT * FROM `ciudad_cotizacion` WHERE `ciudad` = '$ciudad_origen'";
$result = mysqli_query($conexion, $sql);

$row = mysqli_fetch_array($result);

$codigo_provincia_gintracom = $row['codigo_provincia_gintracom'];
$codigo_ciudad_gintracom = $row['codigo_ciudad_gintracom'];

$patron = '/([a-zA-Z\s]+)x(\d+)/';

$productos_guias = $_POST['productos_guia'];
$resultado = preg_replace($patron, '$2 * $1', $productos_guias);

$resultado_final = preg_replace('/(\d)\s/', '$1 | ', $resultado);

$resultado_final = rtrim($resultado_final, ' | ');

echo $resultado_final;

$resultado = preg_replace($patron, '$2 * $1', $productos_guias);

$data = array("remitente" => array(
    "codigo_provincia_gintracom" => $codigo_provincia_gintracom,
    "codigo_ciudad_gintracom" => $codigo_ciudad_gintracom
));

$data = array_merge($data, array("destinatario" => array(
    "nombre_remitente" => $nombre_remitente,
    "direccion_remitente" => $direccion_remitente,
    "telefono_remitente" => $telefono_remitente
)));

echo json_encode($data);
