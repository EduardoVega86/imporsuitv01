<?php
include 'is_logged.php';
if (empty($_POST['mod_nombre_combo'])) {
    $errors[] = "Nombre del combo vacío";
} else if (
    !empty($_POST['mod_nombre_combo'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    //Archivo de funciones PHP  
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre      = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_nombre_combo"], ENT_QUOTES)));

    $query_update = '';

    $sql             = "UPDATE combos SET nombre='" . $nombre . "'";
    //echo $sql;
    $query_update = mysqli_query($conexion, $sql);

    if ($query_update) {
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