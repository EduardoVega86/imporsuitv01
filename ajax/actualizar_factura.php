<?php
/* Connect To Database*/
require_once "../sysadmin/vistas/db.php";
require_once "../sysadmin/vistas/php_conexion.php";
//Archivo de funciones PHP
require_once "../sysadmin/vistas/funciones.php";
if (isset($_POST['id_detalle_combo'])) {
    $id_detalle_combo = $_POST['id_detalle_combo'];
    $id_combo = $_POST['id_combo'];
    $session_id = $_POST['session_id'];

    //eliminar informacion de session tmp
    $delete = mysqli_query($conexion, "DELETE FROM tmp_ventas WHERE session_id = '$session_id'");

    $sql2   = "SELECT * FROM  detalle_combo WHERE id_combo= $id_combo";
    //echo $sql2;
    $query2 = mysqli_query($conexion, $sql2);

    // Inicializar arreglo para almacenar productos del combo
    $productos_combo = [];

    $suma_total_precio = 0;
    $precio_total_cantidad = 0;
    while ($row2 = mysqli_fetch_array($query2)) {
        $id_detalle_combo         = $row2['id'];
        $id_producto_combo         = $row2['id_producto'];
        $nombre_producto_combo = get_row('productos', 'nombre_producto', 'id_producto', $id_producto_combo);
        $image_path_combo = get_row('productos', 'image_path', 'id_producto', $id_producto_combo);
        $precio_especial_combo = get_row('productos', 'valor1_producto', 'id_producto', $id_producto_combo);
        $cantidad_combo      = $row2['cantidad'];

        $precio_total_cantidad = $precio_especial_combo * $cantidad_combo;
        $suma_total_precio = $suma_total_precio + $precio_total_cantidad;

        // Agregar producto al arreglo de productos del combo
        $productos_combo[] = [
            'id_detalle' => $id_detalle_combo,
            'id_producto' => $id_producto_combo,
            'precio_especial' => $precio_especial_combo,
            'cantidad' => $cantidad_combo,
            'precio_total_cantidad' => $precio_total_cantidad
        ];
    }
    // Convertir el arreglo a JSON si es necesario para usar en otra parte del código o enviar al cliente
    $json_productos_combo = json_encode($productos_combo);

    $estado_combo_principal = get_row('combos', 'estado_combo', 'id', $id_combo);
    $imagen_principal = get_row('combos', 'image_path', 'id', $id_combo);
    $nombre_combo_principal = get_row('combos', 'nombre', 'id', $id_combo);
    $valor_combo_principal = get_row('combos', 'valor', 'id', $id_combo);

    if ($estado_combo_principal == 1) {
        $precio_total = $suma_total_precio * (1 - ($valor_combo_principal / 100));
        $descuento_porcentaje = $valor_combo_principal;
    } else {
        $precio_total = $suma_total_precio - $valor_combo_principal;
        $descuento_porcentaje = ($valor_combo_principal / $suma_total_precio) * 100;
    }

    // Preparar el arreglo final con todos los datos necesarios
    $respuesta = [
        'productos' => $productos_combo,
        'precio_total' => $precio_total,
        'descuento_porcentaje' => $descuento_porcentaje,
        'session_id' => $session_id
    ];

    // Codificar la respuesta en JSON y enviarla
    echo json_encode($respuesta);
}
