<?php
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";
include "../permisos.php";

header('Content-Type: application/json');

$conexion_marketplace = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');

if ($conexion_marketplace->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conexion_marketplace->connect_error]);
    exit();
}

if (isset($_GET['tienda'])) {
    $tienda = $conexion_marketplace->real_escape_string($_GET['tienda']);

    $sql = "SELECT * FROM cabecera_cuenta_pagar WHERE tienda = '$tienda' AND visto = 1";
    $query = mysqli_query($conexion_marketplace, $sql);

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
} else {
    echo json_encode(["error" => "No tienda parameter"]);
}
?>
