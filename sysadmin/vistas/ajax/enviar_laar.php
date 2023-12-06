<?php

// Datos de usuario y contraseña
$usuario = "import.uio.api";
$contrasena = "Imp@rt*23";

$token_url = "https://api.laarcourier.com:9727/authenticate";

// Datos a enviar en formato JSON
$auth_data = json_encode(array('username' => $usuario, 'password' => $contrasena));

// Configuración de la solicitud cURL para obtener el token
$token_ch = curl_init($token_url);
curl_setopt($token_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($token_ch, CURLOPT_POSTFIELDS, $auth_data);
curl_setopt($token_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($token_ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($auth_data)
));

// Realizar la solicitud cURL para obtener el token
$token_response = curl_exec($token_ch);

// Verificar si hubo errores en la solicitud
if (curl_errno($token_ch)) {
    echo 'Error en la solicitud cURL para obtener el token: ' . curl_error($token_ch);
}

// Cerrar la conexión cURL
curl_close($token_ch);

// Procesar la respuesta del servicio web para obtener el token
if ($token_response) {
    $token_data = json_decode($token_response, true);
    $token = $token_data['token']; // Suponiendo que el token se encuentra en la respuesta
    // Ahora tenemos el token que debemos enviar en la cabecera Bearer
    // a otro servicio web
} else {
    echo 'No se recibió respuesta del servicio web para obtener el token';
}

require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";
require_once "../funciones_destino.php";

// Configuración de la base de datos de destino
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $destino = new mysqli('localhost', 'root', '', 'master');
} else {
    $destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');
}

if ($destino->connect_error) {
    die('Error en la conexión a la base de datos de destino: ' . $destino->connect_error);
}

$sql = "SELECT * FROM guia_laar order by id_guia desc limit 1";

$query = mysqli_query($destino, $sql);
$row_cnt = mysqli_num_rows($query);
if ($row_cnt > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $numero_sig=$row['id_guia']+1;
        $guia_sistema = 'IMP'.$numero_sig;
    }
} else {
    $guia_sistema = "IMP1";
}
if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
} else {
    $protocol = 'http://';
}
$server_url = $protocol . $_SERVER['HTTP_HOST'];

$date_added = date("Y-m-d H:i:s");

$sql = "INSERT INTO `guia_laar` (`tienda_venta`, `guia_sistema`, `guia_laar`, `fecha`, `zpl`, `tienda_proveedor`, `url_guia`, `estado_guia`) "
        . "VALUES ( '$server_url', '', '', '$date_added', '1.3', '1', '1',2);";
$query = mysqli_query($destino, $sql);

$ultimoid = mysqli_insert_id($destino);
$ultimoid='IMP'.$ultimoid;
$sql_update = "UPDATE `guia_laar` SET `guia_sistema` = '$ultimoid' WHERE `guia_laar`.`id_guia` = $ultimoid";
$query_update = mysqli_query($destino, $sql_update);

//origen
$id_pedido_cot = $_POST['id_pedido_cot'];
$tipo_origen= get_row('facturas_cot', 'drogshipin', 'id_factura', $id_pedido_cot);
if($tipo_origen==1){
    //conexion a marketplace para guardar guia
 
  ///
  
  //conexion a marketplace para guardar guia
 $tienda         = $tipo_origen= get_row('facturas_cot', 'tienda', 'id_factura', $id_pedido_cot);
        if ($_SERVER['HTTP_HOST']=='localhost'){
    $or_marketplace = 'http://localhost/marketplace/';
}else{
 $or_marketplace = 'https://marketplace.imporsuit.com/';  
}
        $archivo_origen=$or_marketplace.'sysadmin/vistas/db1.php';
        $contenido = file_get_contents($archivo_origen);
        $archivo_destino = '../db_destino_marketplace.php';
if (file_put_contents($archivo_destino, $contenido) !== false) {
} else {
    echo "Error al guardar eddl JSON en el archivo.";
}
  require_once "../php_conexion_marketplace_guia.php";
  ///
  // conexion destino
  $archivo_tienda = $tienda.'/sysadmin/vistas/db1.php'; // Nombre del archivo original
       // echo $archivo_tienda;
       $contenido_tienda = file_get_contents($archivo_tienda);
       $archivo_destino_tienda = '../db_destino_guia.php'; // Nombre del archivo de destino
       
       // $origen = fopen($archivo_origen_marketplace, 'r');
if (file_put_contents($archivo_destino_tienda, $contenido_tienda) !== false) {
    //echo "El JSON se ha guardado correctamente en el archivo.";
   

} else {
    echo "Error al guardar eddl JSON en el archivo.";
}

  require_once "../php_conexion_destino_guia.php";
  
$identificacionO = get_row_destino($conexion_destino, 'origen_laar', 'identificacion', 'id_origen', 1);
$provinciaO = get_row_destino($conexion_destino,'origen_laar', 'provinciaO', 'id_origen', 1);
$ciudadO = get_row_destino($conexion_destino, 'origen_laar', 'ciudadO', 'id_origen', 1);
$nombreO = get_row_destino($conexion_destino, 'origen_laar', 'nombreO', 'id_origen', 1);
$direccionO = get_row_destino($conexion_destino, 'origen_laar', 'direccion', 'id_origen', 1);
$refenciaO = get_row_destino($conexion_destino, 'origen_laar', 'referencia', 'id_origen', 1);
$numeroCasaO = get_row_destino($conexion_destino, 'origen_laar', 'numeroCasa', 'id_origen', 1);
$telefonoO = get_row_destino($conexion_destino, 'origen_laar', 'telefono', 'id_origen', 1);
$celularO = get_row_destino($conexion_destino, 'origen_laar', 'celular', 'id_origen', 1);

}else{
  
$identificacionO = get_row('origen_laar', 'identificacion', 'id_origen', 1);
$provinciaO = get_row('origen_laar', 'provinciaO', 'id_origen', 1);
$ciudadO = get_row('origen_laar', 'ciudadO', 'id_origen', 1);
$nombreO = get_row('origen_laar', 'nombreO', 'id_origen', 1);
$direccionO = get_row('origen_laar', 'direccion', 'id_origen', 1);
$refenciaO = get_row('origen_laar', 'referencia', 'id_origen', 1);
$numeroCasaO = get_row('origen_laar', 'numeroCasa', 'id_origen', 1);
$telefonoO = get_row('origen_laar', 'telefono', 'id_origen', 1);
$celularO = get_row('origen_laar', 'celular', 'id_origen', 1);  
}

//echo $ciudadO;
//echo $celularO;

//destino
$nombre_destino = $_POST['nombre_destino'];
$ciudad_entrega = $_POST['ciudad'];
$direccion = $_POST['direccion'];
//echo $direccion;
$referencia = $_POST['referencia'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$valorasegurado = $_POST['valorasegurado'];

$numerocasa = $_POST['numerocasa'];
$cod = $_POST['cod'];
$cod_guia= $cod;
$cod = filter_var($cod, FILTER_VALIDATE_BOOLEAN);

$seguro = $_POST['seguro'];
$observacion = $_POST['observacion'];

$fechaActual = date("m/y/Y");
//echo $fechaActual;
if ($seguro == 1) {
    $valorasegurado = $valorasegurado;
} else {
    $valorasegurado = 0;
}
$productos_guia = $_POST['productos_guia'];
$cantidad_total = $_POST['cantidad_total'];
//echo $cantidad_total;
$identificacion = $_POST['identificacion'];
$valor_total = $_POST['valor_total'];
$costo_total = $_POST['costo_total'];
// URL del servicio web al que deseas enviar los datos con el token
$destino_url = "https://api.laarcourier.com:9727/guias/contado";
// Datos a enviar en formato JSON al servicio de destino
$datos_destino = array(
    "origen" => array(
        "identificacionO" => "$identificacionO",
        "ciudadO" => "$ciudadO",
        "nombreO" => "$nombreO",
        "direccion" => "$direccionO",
        "referencia" => "$refenciaO",
        "numeroCasa" => "$numeroCasaO",
        "postal" => "",
        "telefono" => "$telefonoO",
        "celular" => "$celularO"
    ),
    "destino" => array(
        "identificacionD" => "$identificacion",
        "ciudadD" => "$ciudad_entrega",
        "nombreD" => "$nombre_destino",
        "direccion" => "$direccion",
        "referencia" => "$referencia",
        "numeroCasa" => "$numerocasa",
        "postal" => "",
        "telefono" => "$telefono",
        "celular" => "$celular"
    ),
    "numeroGuia" => "$guia_sistema",
    "tipoServicio" => "201202002002013",
    "noPiezas" => $cantidad_total,
    "peso" => 2,
    "valorDeclarado" => $valorasegurado,
    "contiene" => "$productos_guia",
    "tamanio" => "",
    "cod" => $cod,
    "costoflete" => 0,
    "costoproducto" => $valor_total,
    "tipocobro" => 0,
    "comentario" => "$observacion",
    "fechaPedido" => "$fechaActual",
    "extras" => array(
        "Campo1" => "",
        "Campo2" => "",
        "Campo3" => ""
    )
);

// Configuración de la solicitud cURL para el servicio de destino
$ch = curl_init($destino_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos_destino));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token // Agregar el token en la cabecera Bearer
));

// Realizar la solicitud cURL al servicio de destino
$response = curl_exec($ch);


// Verificar si hubo errores en la solicitud
if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL para el servicio de destino: ' . curl_error($ch);
}

// Cerrar la conexión cURL
curl_close($ch);

// Procesar la respuesta del servicio de destino
if ($response) {
    $data = json_decode($response, true);
    // Puedes trabajar con los datos de respuesta aquí


    $id_pedido_cot = $_POST['id_pedido_cot'];



    @$guia = $data["guia"];
    @$url = $data["url"];

    if (isset($guia)) {
        $sql_update = "UPDATE `facturas_cot` SET `guia_enviada` = '1', transporte='LAAR' WHERE `id_factura` = $id_pedido_cot";
        //echo $sql_update;
        $query_update = mysqli_query($conexion, $sql_update);

        $date_added = date("Y-m-d H:i:s");
        $sql_insertar_guia = "INSERT INTO `guia_laar` ( `tienda_venta`, `guia_sistema`, `guia_laar`, `fecha`, `zpl`, `tienda_proveedor`, `url_guia`,`id_pedido`, 
            `identificacionO`,`ciudadO`, `nombreO`,
            `direccionO`, `referenciaO`,`numeroCasaO`, 
            `postalO`,`telefonoO`, `celularO`,
            `identificacionD`, `ciudadD`,`nombreD`, 
            `direccionD`,`referenciaD`, `numeroCasaD`,
            `postalD`, `telefonoD`,`celularD`, 
            `tipoServicio`,`noPiezas`, `peso`,
            `valorDeclarado`, `contiene`,`cod` ,
            `costoflete`,`costoproducto`, `tipocobro`,
            `comentario`,`valor_costo`, `estado_guia`) 
        VALUES (  '$server_url', '$ultimoid', '$guia', '$date_added', '', '$server_url','$url','$id_pedido_cot',"
                . "'$identificacionO','$ciudadO','$nombreO',"
                . "'$direccionO','$refenciaO','$numeroCasaO',"
                . "'','$telefonoO','$celularO',"
                . "'$identificacion','$ciudad_entrega','$nombre_destino',"
                . "'$direccion','$referencia','$numerocasa',"
                . "'','$telefono','$celular',"
                . "'201202002002013','$cantidad_total','2',"
                . "'$valorasegurado','$productos_guia','$cod_guia','0','$valor_total',"
                . "'0','$observacion','$costo_total',2)";
//echo $sql_insertar_guia;
        $query_insertar = mysqli_query($conexion, $sql_insertar_guia);
        
        //ingresar guia destino
        $sql_insertar_guia_destino = "INSERT INTO `guia_laar` ( `tienda_venta`, `guia_sistema`, `guia_laar`, `fecha`, `zpl`, `tienda_proveedor`, `url_guia`,`id_pedido`, 
            `identificacionO`,`ciudadO`, `nombreO`,
            `direccionO`, `referenciaO`,`numeroCasaO`, 
            `postalO`,`telefonoO`, `celularO`,
            `identificacionD`, `ciudadD`,`nombreD`, 
            `direccionD`,`referenciaD`, `numeroCasaD`,
            `postalD`, `telefonoD`,`celularD`, 
            `tipoServicio`,`noPiezas`, `peso`,
            `valorDeclarado`, `contiene`,`cod` ,
            `costoflete`,`costoproducto`, `tipocobro`,
            `comentario`,`valor_costo`, `estado_guia`) 
        VALUES (  '$server_url', '$ultimoid', '$guia', '$date_added', '', '$server_url','$url','$id_pedido_cot',"
                . "'$identificacionO','$ciudadO','$nombreO',"
                . "'$direccionO','$refenciaO','$numeroCasaO',"
                . "'','$telefonoO','$celularO',"
                . "'$identificacion','$ciudad_entrega','$nombre_destino',"
                . "'$direccion','$referencia','$numerocasa',"
                . "'','$telefono','$celular',"
                . "'201202002002013','$cantidad_total','2',"
                . "'$valorasegurado','$productos_guia','$cod_guia','0','$valor_total',"
                . "'0','$observacion','$costo_total',2)";
//echo $sql_insertar_guia;
        
        if($tipo_origen==1){
            
        
        $query_insertar_destino = mysqli_query($conexion_destino, $sql_insertar_guia_destino);
        
        $id_fact_destino=get_row_destino($conexion_destino, 'facturas_cot', 'id_factura', 'id_origen_factura', $id_pedido_cot);
         $sql = "UPDATE facturas_cot SET  estado_factura=2
                                WHERE id_factura='" . $id_fact_destino . "'";
    $query_update_destino = mysqli_query($conexion_destino, $sql);
    
     //ingresar guia marketplace
        $sql_insertar_guia_marketplace = "INSERT INTO `guia_laar` ( `tienda_venta`, `guia_sistema`, `guia_laar`, `fecha`, `zpl`, `tienda_proveedor`, `url_guia`,`id_pedido`, 
            `identificacionO`,`ciudadO`, `nombreO`,
            `direccionO`, `referenciaO`,`numeroCasaO`, 
            `postalO`,`telefonoO`, `celularO`,
            `identificacionD`, `ciudadD`,`nombreD`, 
            `direccionD`,`referenciaD`, `numeroCasaD`,
            `postalD`, `telefonoD`,`celularD`, 
            `tipoServicio`,`noPiezas`, `peso`,
            `valorDeclarado`, `contiene`,`cod` ,
            `costoflete`,`costoproducto`, `tipocobro`,
            `comentario`,`valor_costo`, `estado_guia`) 
        VALUES (  '$server_url', '$ultimoid', '$guia', '$date_added', '', '$server_url','$url','$id_pedido_cot',"
                . "'$identificacionO','$ciudadO','$nombreO',"
                . "'$direccionO','$refenciaO','$numeroCasaO',"
                . "'','$telefonoO','$celularO',"
                . "'$identificacion','$ciudad_entrega','$nombre_destino',"
                . "'$direccion','$referencia','$numerocasa',"
                . "'','$telefono','$celular',"
                . "'201202002002013','$cantidad_total','2',"
                . "'$valorasegurado','$productos_guia','$cod_guia','0','$valor_total',"
                . "'0','$observacion','$costo_total',2)";
//echo $sql_insertar_guia;
        $query_insertar_marketplace = mysqli_query($conexion_marketplace, $sql_insertar_guia_marketplace);
        
        $id_fact_marketplace=get_row_destino($conexion_marketplace, 'facturas_cot', 'id_factura', 'id_origen_factura', $id_pedido_cot);
         $sql = "UPDATE facturas_cot SET  estado_factura=2
                                WHERE id_factura='" . $id_fact_marketplace . "'";
    $query_update_destino = mysqli_query($conexion_marketplace, $sql);
  
        
    }
    
    $query = "SELECT * FROM detalle_fact_cot WHERE id_factura = $id_pedido_cot";

// Realizar la consulta
$resultado = mysqli_query($conexion, $query);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Iterar sobre los resultados usando un bucle while
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $conexion_destino = new mysqli('localhost', 'root', '', 'master');
} else {
    $conexion_destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');
}

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
    while ($fila = mysqli_fetch_assoc($resultado)) {
       
        $id_producto = $fila['id_producto'];
        $drogshipin = get_row('productos', 'drogshipin', 'id_producto', $id_producto);
        $id_marketplace= get_row('productos', 'id_marketplace', 'id_producto', $id_producto);
        $cantidad= $fila['cantidad'];
    if($drogshipin==1){
        $sql2    = mysqli_query($conexion_destino, "select * from productos where id_producto='" . $id_marketplace . "'");
        $rw      = mysqli_fetch_array($sql2);
        $old_qty = $rw['stock_producto']; //Cantidad encontrada en el inventario
        $new_qty = $old_qty - $cantidad; //Nueva cantidad en el inventario
        $update  = mysqli_query($conexion_destino, "UPDATE productos SET stock_producto='" . $new_qty . "' WHERE id_producto='" . $id_marketplace . "' and inv_producto=0"); //Actualizo la nueva cantidad en el inventario
    }else{
        $sql2    = mysqli_query($conexion, "select * from productos where id_producto='" . $id_producto . "'");
        $rw      = mysqli_fetch_array($sql2);
        $old_qty = $rw['stock_producto']; //Cantidad encontrada en el inventario
        $new_qty = $old_qty - $cantidad; //Nueva cantidad en el inventario
        $update  = mysqli_query($conexion, "UPDATE productos SET stock_producto='" . $new_qty . "' WHERE id_producto='" . $id_producto . "' and inv_producto=0"); //Actualizo la nueva cantidad en el inventario
    }
       
    }

    // Liberar el resultado
    mysqli_free_result($resultado);
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
        echo 'ok';
    } else {
        var_dump($data);
    }
} else {
    echo 'No se recibió respuesta del servicio de destino';
}
?>
