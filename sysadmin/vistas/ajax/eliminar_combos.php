<?php
/*-----------------------
Autor: Tony Plaza
----------------------------*/
include 'is_logged.php'; // Archivo verifica que el usuario que intenta acceder a la URL está logueado
/* Connect To Database */
require_once "../db.php";
require_once "../php_conexion.php";
// Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Clientes";
permisos($modulo, $cadena_permisos);

/* Inicia validación del lado del servidor */
if (empty($_POST['id_combo'])) {
    $errors[] = "ID vacío";
} else if (!empty($_POST['id_combo'])) {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $id_combo = intval($_POST['id_combo']);

    // Obtener la ruta de la imagen
    $query = mysqli_query($conexion, "SELECT image_path FROM combos WHERE id='$id_combo'");
    $row = mysqli_fetch_assoc($query);
    $image_path = $row['image_path'];

    // Eliminar el registro de la base de datos
    if ($delete1 = mysqli_query($conexion, "DELETE FROM combos WHERE id='$id_combo'")) {

        $delete2 = mysqli_query($conexion, "DELETE FROM detalle_combo WHERE id_combo='$id_combo'");

        // Eliminar el archivo de imagen
        if (file_exists($image_path)) {
            unlink($image_path);
        }
?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Aviso!</strong> Datos eliminados exitosamente.
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>Error!</strong> Lo siento, algo ha salido mal, intenta nuevamente.
        </div>
    <?php
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
?>