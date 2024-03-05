<?php

/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";

$get_data = json_decode(file_get_contents('php://input'), true);
$id_producto = $get_data['codigo'];

$query = mysqli_query($conexion, "SELECT * FROM productos WHERE id_producto = '$id_producto'");
$row = mysqli_fetch_assoc($query);

echo json_encode($row);
