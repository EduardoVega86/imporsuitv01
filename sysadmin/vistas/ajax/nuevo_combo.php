<?php
include 'is_logged.php';

if (
    !empty($_POST['nombre']) &&
    !empty($_POST['selected_product_id'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    //Archivo de funciones PHP  
    require_once "../funciones.php";

    $nombre      = mysqli_real_escape_string($conexion, strip_tags($_POST["nombre"], ENT_QUOTES));
    $id_producto = $_POST['selected_product_id'];

    // Verificar si valor_combo ha sido enviado y no está vacío

    // Consulta de inserción
    $sql = "INSERT INTO combos (nombre, id_producto_combo) VALUES ('$nombre', '$id_producto')";


    $query_new_insert = mysqli_query($conexion, $sql);

    if ($query_new_insert) {
        $messages[] = "Producto ha sido ingresado satisfactoriamente.";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
    }
} else {
    if (!empty($_POST['valor_combo'])) {
        $valor_combo = $_POST['valor_combo'];
        // Consulta de actualización
        $sql = "UPDATE combos SET nombre = '$nombre', id_producto_combo = '$id_producto' WHERE id_combo = '$valor_combo'";
    } else {
        $errors[] = "Error desconocido.";
    }
}

if (isset($errors)) {
?>
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
<?php
}
if (isset($messages)) {
?>
    <div class="alert alert-success" role="alert">
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}

?>