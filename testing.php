<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$get_data = file_get_contents("https://marketplaceonline.imporsuit.com/sysadmin/vistas/db1.php");

$get_data = json_decode($get_data, true);

$host = $get_data['DB_HOST'];
$user = $get_data['DB_USER'];
$pass = $get_data['DB_PASS'];
$base = $get_data['DB_NAME'];

$sql = "SELECT tienda FROM facturas_cot WHERE id_factura='57'";
$conexion = mysqli_connect($host, $user, $pass, $base);

if (!$conexion) {
    die("imposible conectarse: " . mysqli_error($conexion));
}

if (@mysqli_connect_errno()) {
    die("Conexión falló: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
}

date_default_timezone_set("America/Guayaquil");

mysqli_query($conexion, "SET NAMES utf8");

mysqli_query($conexion, "SET CHARACTER_SET utf8");

$resultado = mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_array($resultado)) {
    $tienda = $row['tienda'];
}



mysqli_close($conexion);
