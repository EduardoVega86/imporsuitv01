<?php
/* Connect To Database */
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

// Validación de entrada
if (isset($_POST["tienda"])) {
    $tienda = $_POST["tienda"];
} else {
    die("Error: No se proporcionó la tienda.");
}

// Reiniciar los valores en cabecera_cuenta_pagar
$sql_reinicio = "UPDATE cabecera_cuenta_pagar SET valor_pendiente = monto_recibir, valor_cobrado = 0 WHERE tienda = '$tienda';";
$reinicio_query = mysqli_query($conexion, $sql_reinicio);

if (!$reinicio_query) {
    die("Error al reiniciar los valores: " . mysqli_error($conexion));
}

// Obtener los pagos de la tienda
$sql_pagos = "SELECT * FROM pagos WHERE tienda = '$tienda';";
$pagos_query = mysqli_query($conexion, $sql_pagos);

if (!$pagos_query) {
    die("Error al obtener los pagos: " . mysqli_error($conexion));
}

$valores = array();
while ($pagos = mysqli_fetch_array($pagos_query)) {
    $valores[] = $pagos['valor'];
}

// Abonar a la tienda
foreach ($valores as $valor) {
    // Enviar la solicitud cURL solo si el cálculo es válido
    $ch = curl_init();
    $url = "https://marketplace.imporsuit.com/sysadmin/vistas/ajax/agregar_abono_wallet1.php";
    $data = array(
        'abono' => $valor,
        'forma_pago' => 'Efectivo',
        'img' => 'default.jpg',
    );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error en curl: ' . curl_error($ch);
    }
    curl_close($ch);
}

// Obtener los pagos actuales y actualizar los pagos viejos
$sql_pagos_nuevos = "SELECT * FROM pagos WHERE tienda = '$tienda';";
$pagos_query_nuevos = mysqli_query($conexion, $sql_pagos_nuevos);

if (!$pagos_query_nuevos) {
    die("Error al obtener los pagos nuevos: " . mysqli_error($conexion));
}

while ($pagos_nuevos = mysqli_fetch_array($pagos_query_nuevos)) {
    $id_pago = $pagos_nuevos['id_pago'];
    $imagen_nueva = $pagos_nuevos['imagen'];

    // Obtener la imagen del pago anterior correspondiente al id_pago
    $sql_pago_anterior = "SELECT imagen FROM pagos WHERE id_pago = $id_pago AND tienda = '$tienda' LIMIT 1;";
    $pago_anterior_query = mysqli_query($conexion, $sql_pago_anterior);

    if ($pago_anterior_query && mysqli_num_rows($pago_anterior_query) > 0) {
        $pago_anterior = mysqli_fetch_assoc($pago_anterior_query);
        $imagen_anterior = $pago_anterior['imagen'];

        // Actualizar la imagen del pago nuevo con la imagen del pago anterior
        $sql_actualizar = "UPDATE pagos SET imagen = '$imagen_anterior' WHERE id_pago = $id_pago AND tienda = '$tienda';";
        $actualizar_query = mysqli_query($conexion, $sql_actualizar);

        if (!$actualizar_query) {
            die("Error al actualizar los pagos: " . mysqli_error($conexion));
        }
    }
}

echo "Proceso completado con éxito.";
