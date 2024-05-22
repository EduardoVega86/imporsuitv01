<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "../sysadmin/vistas/db.php";
require_once "../sysadmin/vistas/php_conexion.php";

// Obtener el session_id de la solicitud POST
$session_id = $_POST['session_id'];

$delete = mysqli_query($conexion, "DELETE FROM tmp_ventas WHERE session_id = '$session_id'");

if ($delete) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conexion)]);
}
?>