<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_GET['id'])) {
    $errors[] = "referencia vacío";
} else if (!empty($_GET['id'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    
    //$contenido      = $_POST['contenido'];
    $id      = $_GET['id'];
   
    // check if user or email address already exists
 // Nombre de la tabla que deseas copiar
$tabla = 'productos';

// Configuración de la base de datos de destino
$destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');
if ($destino->connect_error) {
    die('Error en la conexión a la base de datos de destino: ' . $destino->connect_error);
}

// Realiza una consulta para seleccionar todos los registros de la tabla de origen
$sql = "SELECT * FROM $tabla where id_producto=$id";
$query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        //update
        while ($fila = $query_check_user_name->fetch_assoc()) {
            //echo 'si entra';
            
      $codigo_producto = $fila['codigo_producto'];
      $nombre_producto = $fila['nombre_producto'];
      //echo $nombre_producto;
      $descripcion_producto = $fila['descripcion_producto'];
      $id_linea_producto = $fila['id_linea_producto'];
      $id_med_producto = $fila['id_med_producto'];
      $id_proveedor = 6;
      $inv_producto = $fila['inv_producto'];
      $iva_producto = $fila['iva_producto'];
      $estado_producto = $fila['estado_producto'];
      $costo_producto = $fila['costo_producto'];
      $utilidad_producto = $fila['utilidad_producto'];
        
       $moneda_producto = $fila['moneda_producto'];
       $valor1_producto = $fila['valor1_producto'];
       $valor2_producto = $fila['valor2_producto'];
       $valor3_producto = $fila['valor3_producto'];
        
       $stock_producto = $fila['stock_producto'];
       $stock_min_producto = $fila['stock_min_producto'];
       $date_added = $fila['date_added'];
       $image_path = $fila['image_path'];
        
       $id_imp_producto = $fila['id_imp_producto'];
       $pagina_web = $fila['pagina_web'];
       $formato = $fila['formato'];
       $url_a1 = $fila['url_a1'];
       
       $url_a2 = $fila['url_a2'];
       $url_a3 = $fila['url_a3'];
       $url_a4 = $fila['url_a4'];
       $url_a5 = $fila['url_a5'];
       
       $valor4_producto = $fila['valor4_producto'];
       echo $valor4_producto;
       $tienda = $fila['tienda'];
       $drogshipin = $fila['drogshipin'];
        
               if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}
$image_path = str_replace('../..', 'sysadmin', $image_path);

        $server_url = $protocol . $_SERVER['HTTP_HOST'];
        $image_path=$server_url.'/'.$image_path;
      //echo $campos;
        
        $insert_query = "INSERT INTO `productos` (`id_producto`, `codigo_producto`, `nombre_producto`, "
                . "`descripcion_producto`, `id_linea_producto`, `id_med_producto`, "
                . "`id_proveedor`, `inv_producto`, `iva_producto`,"
                . " `estado_producto`, `costo_producto`, `utilidad_producto`, "
                . " `valor1_producto`, `valor2_producto`, "
                . "`valor3_producto`, `stock_producto`, `stock_min_producto`, "
                . "`date_added`, `image_path`, `id_imp_producto`, "
                . "`pagina_web`, `formato`, `url_a1`, "
                . "`url_a2`, `url_a3`, `url_a4`, "
                . "`url_a5`, `valor4_producto`, `tienda`, "
                . "`drogshipin`) VALUES (NULL, '$codigo_producto', '$nombre_producto', "
                . "'$descripcion_producto', '$id_linea_producto', 0, "
                . "'$id_proveedor', '$inv_producto', '$iva_producto', "
                . "'$estado_producto', '$costo_producto', '$utilidad_producto', "
                . " '$valor1_producto', '$valor2_producto', "
                . "'$valor3_producto', '$stock_producto', '1', "
                . "'$date_added', '$image_path', '$id_imp_producto', "
                . "'$pagina_web', '$formato', '$url_a1', "
                . "'$url_a2', '$url_a3', '$url_a4', "
                . "'$url_a5', $valor4_producto, '0', '1');";
        
        echo $insert_query;
        
         if (!$destino->query($insert_query)) {
            echo "Error al insertar datos: " . $destino->error;
        }else{
        
        }
    }
    
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
      
        <?php
}

?>