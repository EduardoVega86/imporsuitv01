<?php
/*-----------------------
Autor: Tony Plaza
----------------------------*/
include 'is_logged.php';
if (empty($_POST['mod_nombre_combo'])) {
    $errors[] = "Nombre del combo vacío";
} else {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    //Archivo de funciones PHP  
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_nombre_combo"], ENT_QUOTES)));
    $id_combo = intval($_POST['mod_id_combo']);

    // Verificar si se ha cargado un archivo
    $image_update = "";
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $target_dir = "../../img/productos/";
        $image_name = time() . "_" . basename($_FILES["imagen"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $imageFileSize = $_FILES["imagen"]["size"];

        // Validaciones
        if (($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") && $imageFileSize > 0) {
            $errors[] = "Lo sentimos, sólo se permiten archivos JPG, JPEG, PNG y GIF.";
        } else if ($imageFileSize > 1048576) { // 1MB
            $errors[] = "Lo sentimos, pero el archivo es demasiado grande. Selecciona una imagen de menos de 1MB.";
        } else {
            // Subir el archivo
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                $image_update = ", image_path='$target_file'";
            } else {
                $errors[] = "Lo siento, hubo un error al subir tu archivo.";
            }
        }
    }

    // Actualizar el registro en la base de datos
    if (empty($errors)) {
        $sql = "UPDATE combos SET nombre='$nombre' $image_update WHERE id='$id_combo'";
        $query_update = mysqli_query($conexion, $sql);

        if ($query_update) {
            $messages[] = "Producto ha sido actualizado satisfactoriamente.";
        } else {
            $errors[] = "Lo siento, algo ha salido mal. Intenta nuevamente. " . mysqli_error($conexion);
        }
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