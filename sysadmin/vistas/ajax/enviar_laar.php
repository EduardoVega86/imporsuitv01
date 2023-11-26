<?php
// Datos de usuario y contraseña
$usuario = "prueba.importshop.api";
$contrasena = "!mp0rt@sh@23";

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
    
// Configuración de la base de datos de destino
if ($_SERVER['HTTP_HOST']=='localhost'){
    $destino = new mysqli('localhost', 'root', '', 'master');
}else{
 $destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');   
}

if ($destino->connect_error) {
    die('Error en la conexión a la base de datos de destino: ' . $destino->connect_error);
}

$sql   = "SELECT * FROM guia_laar order by id_guia desc limit 1" ;

    $query = mysqli_query($destino, $sql);
    $row_cnt = mysqli_num_rows($query);
    if ($row_cnt > 0) {
      while ($row = mysqli_fetch_array($query)) {
        $guia_sistema     = $row['id_guia']+1;
    }
    }else{
        $guia_sistema=1;
    }
     if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}
$server_url = $protocol . $_SERVER['HTTP_HOST'];

$date_added = date("Y-m-d H:i:s");

$sql   = "INSERT INTO `guia_laar` (`tienda_venta`, `guia_sistema`, `guia_laar`, `fecha`, `zpl`, `tienda_proveedor`, `url_guia`) "
        . "VALUES ( '$server_url', '', '', '$date_added', '1.3', '1', '1');" ;
    $query = mysqli_query($destino, $sql);

    $ultimoid=mysqli_insert_id($destino);
  $sql_update =  "UPDATE `guia_laar` SET `guia_sistema` = '$ultimoid' WHERE `guia_laar`.`id_guia` = $ultimoid";
  $query_update = mysqli_query($destino, $sql_update);
        
//origen
$identificacionO= get_row('origen_laar', 'identificacion', 'id_origen', 1);
$provinciaO= get_row('origen_laar', 'provinciaO','id_origen', 1);
$ciudadO= get_row('origen_laar',  'ciudadO','id_origen', 1);
$nombreO= get_row('origen_laar',  'nombreO','id_origen', 1);
$direccionO= get_row('origen_laar',  'direccion', 'id_origen',1);
$refenciaO= get_row('origen_laar',  'referencia','id_origen', 1);
$numeroCasaO= get_row('origen_laar', 'numeroCasa','id_origen',  1);
$telefonoO= get_row('origen_laar',  'telefono','id_origen', 1);
$celularO= get_row('origen_laar',  'celular','id_origen', 1);

//destino
$nombre_destino=$_POST['nombre_destino'];
$ciudad_entrega=$_POST['ciudad'];
$direccion=$_POST['direccion'];
//echo $direccion;
$referencia=$_POST['referencia'];
$telefono=$_POST['telefono'];
$celular=$_POST['celular'];
$valorasegurado=$_POST['valorasegurado'];

$numerocasa=$_POST['numerocasa'];
$cod=$_POST['cod'];
$cod = filter_var($cod, FILTER_VALIDATE_BOOLEAN);

$seguro=$_POST['seguro'];
$observacion=$_POST['observacion'];

$fechaActual = date("m/y/Y");
//echo $fechaActual;
if($seguro==1){
  $valorasegurado=$valorasegurado;  
}else{
    $valorasegurado=0;
}
$productos_guia=$_POST['productos_guia'];
$cantidad_total=$_POST['cantidad_total'];
//echo $cantidad_total;
$identificacion=$_POST['identificacion'];
$valor_total=$_POST['valor_total'];
// URL del servicio web al que deseas enviar los datos con el token
$destino_url = "https://api.laarcourier.com:9727/guias";
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
    
    
$id_pedido_cot=$_POST['id_pedido_cot'];



@$guia = $data["guia"];
@$url = $data["url"];

if(isset($guia)){
    $sql_update =  "UPDATE `facturas_cot` SET `guia_enviada` = '1', transporte='LAAR' WHERE `id_factura` = $id_pedido_cot";
 //echo $sql_update;
$query_update = mysqli_query($conexion, $sql_update);

    $date_added = date("Y-m-d H:i:s");
$sql_insertar_guia="INSERT INTO `guia_laar` ( `tienda_venta`, `guia_sistema`, `guia_laar`, `fecha`, `zpl`, `tienda_proveedor`, `url_guia`,`id_pedido` ) 
        VALUES (  '$server_url', '$ultimoid', '$guia', '$date_added', '', '','$url','$id_pedido_cot')"; 
//echo $sql_insertar_guia;
$query_insertar = mysqli_query($conexion, $sql_insertar_guia);
echo 'ok';
}else{
    var_dump($data);
}



} else {
    echo 'No se recibió respuesta del servicio de destino';
}

?>
