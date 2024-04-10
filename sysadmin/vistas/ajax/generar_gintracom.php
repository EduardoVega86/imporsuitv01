<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

$nombre_remitente = $_POST['nombre_remitente'];
$direccion_remitente = $_POST['direccion_remitente'];
$telefono_remitente = $_POST['telefono_remitente'];

$direccion_remitente = explode(" - ", $direccion_remitente);
$direccion_remitente = $direccion_remitente[0];

$sql = "SELECT * FROM `ciudad_cotizacion` WHERE `ciudad` = '$direccion_remitente'";
$result = mysqli_query($conexion, $sql);
