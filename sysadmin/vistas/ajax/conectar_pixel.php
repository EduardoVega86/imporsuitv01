<?php

require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
$get_datos = file_get_contents("php://input");

$request = json_decode($get_datos, true); // Convertir JSON a array

$pixel = $request['pixel'];

$sql = "SELECT * FROM pixel WHERE nombre = 'FACEBOOK'";
$resultado = mysqli_query($conexion, $sql);
$rw = mysqli_fetch_array($resultado);

if (empty($rw)) {
    $sql_insert = "INSERT INTO pixel (nombre, codigo) VALUES ('FACEBOOK', '$pixel')";
    $resultado_insert = mysqli_query($conexion, $sql_insert);
    if ($resultado_insert) {
        echo "oki";
    } else {
        echo "errori";
    }
} else {
    $sql_update = "UPDATE pixel SET codigo = '$pixel' WHERE nombre = 'FACEBOOK'";
    $resultado_update = mysqli_query($conexion, $sql_update);
    if ($resultado_update) {
        echo "oku";
    } else {
        echo "erroru";
    }
}
