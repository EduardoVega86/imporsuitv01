<?php
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";
include "../permisos.php";

header('Content-Type: application/json');

$sql = "SELECT * FROM productos";
$query = mysqli_query($conexion, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo json_encode(["error" => "No data found"]);
}

$conexion_marketplace->close();
