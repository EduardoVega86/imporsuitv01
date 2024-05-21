<?php
/*-----------------------
Autor: Tony Plaza
----------------------------*/
include 'is_logged.php';
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Archivo de funciones PHP  
require_once "../funciones.php";

if (!empty($_POST['nombre']) && !empty($_POST['selected_product_id'])) {
    $nombre = mysqli_real_escape_string($conexion, strip_tags($_POST["nombre"], ENT_QUOTES));
    $id_producto = $_POST['selected_product_id'];

    $target_dir = "../../img/productos/";

    $image_update = "";
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $original_image_name = basename($_FILES["imagen"]["name"]);
        $target_file = $target_dir . time() . "_" . $original_image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $imageFileSize = $_FILES["imagen"]["size"];

        // Verificar si el archivo es una imagen real
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            // Verificar el tipo de archivo
            $allowed_types = array("jpg", "jpeg", "png", "gif");
            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                    $image_update = ", image_path='$target_file'";
                } else {
                    $errors[] = "Lo siento, hubo un error al subir tu archivo.";
                }
            } else {
                $errors[] = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            }
        } else {
            $errors[] = "El archivo no es una imagen válida.";
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO combos (nombre, id_producto_combo" . ($image_update ? ", image_path" : "") . ") 
                VALUES ('$nombre', '$id_producto'" . ($image_update ? ", '$target_file'" : "") . ")";
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Producto ha sido ingresado satisfactoriamente.";
        } else {
            $errors[] = "Lo siento, algo ha salido mal. Intenta nuevamente." . mysqli_error($conexion);
        }
    }
} else {
    if (!empty($_POST['valor_combo'])) {
        $valor_combo = $_POST['valor_combo'];
        $id_combo = $_POST['id_combo'];
        $estado_combo = $_POST['estado_combo'];
        $sql = "UPDATE combos SET valor = '$valor_combo', estado_combo = '$estado_combo' WHERE id = '$id_combo'";
        $query_update = mysqli_query($conexion, $sql);
        if ($query_update) {
            $messages[] = "Producto ha sido ingresado satisfactoriamente.";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        }
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