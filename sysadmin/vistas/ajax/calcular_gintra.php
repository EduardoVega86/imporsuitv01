<?php
require_once "../db.php";
require_once "../php_conexion.php";

$sql = "SELECT * FROM `ciudad_cotizacion` WHERE `ciudad` = '$ciudad_origen'";
$result = mysqli_query($conexion, $sql);

$row = mysqli_fetch_array($result);

$trayecto = $row['trayecto_gintracom'];

$sql = "SELECT * FROM `cotizacion_gintracom` WHERE `trayecto` = '$trayecto'";
$result = mysqli_query($conexion, $sql);

$row = mysqli_fetch_array($result);

$valor = $row['precio'];
