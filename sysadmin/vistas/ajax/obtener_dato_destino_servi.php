<?php

require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php";

$ciudad = $_POST['ciudad'];

$sql = "SELECT * FROM ciudad_laar WHERE codigo = '$ciudad'";
$result = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($result);

$nombre = $row['nombre'];
$provincia = $row['provincia'];

echo json_encode(array('nombre' => $nombre, 'provincia' => $provincia));
