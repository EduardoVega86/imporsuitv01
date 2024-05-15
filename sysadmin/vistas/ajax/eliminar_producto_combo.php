<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'is_logged.php';
if (empty($_POST['id_detalle_combo'])) {
    $errors[] = "Detalle del combo vacío";
} else if (
    !empty($_POST['id_detalle_combo']) 
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    //Archivo de funciones PHP  
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $id_detalle_combo = $_POST['id_detalle_combo'];

    $query_new_insert = '';

    $sql = "DELETE FROM detalle_combo WHERE id = '$id_detalle_combo'";

    $query_new_insert = mysqli_query($conexion, $sql);

    if ($query_new_insert) {
        $messages[] = "Producto ha sido ingresado satisfactoriamente.";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
    }
} else {
    $errors[] = "Error desconocido.";
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