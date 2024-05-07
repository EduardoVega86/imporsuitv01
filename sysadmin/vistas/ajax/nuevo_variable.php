<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['descripcion'])) {
    $errors[] = "referencia vacío";
} else if (!empty($_POST['descripcion'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $id_tmp      = $_POST["id_tmp"];
    $descripcion      = $_POST["descripcion"];
   
    $estado      = 1;
 
  
   
    $users       = intval($_SESSION['id_users']);
    // check if user or email address already exists
  
 
        // write new user's data into database

       $sql = "INSERT INTO variedades (variedad, id_atributo)
        VALUES ('$descripcion','$id_tmp')";
        $query_new_insert = mysqli_query($conexion, $sql);

        echo $sql;
        if ($query_new_insert) {
            $messages[] = "Texto ha sido ingresada con Exito.";
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