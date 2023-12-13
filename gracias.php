<!doctype html>
<?php
session_start();

require_once "sysadmin/vistas/db.php";
//echo DB_HOST;
require_once "sysadmin/vistas/php_conexion.php";
require_once "sysadmin/vistas/funciones.php";

if ($_SERVER['HTTP_HOST']=='localhost'){
    $or_marketplace = 'http://localhost/marketplace/';
}else{
 $or_marketplace = 'https://marketplace.imporsuit.com/';  
}
        $archivo_origen=$or_marketplace.'sysadmin/vistas/db1.php';
       // echo $archivo_origen;
        $contenido = file_get_contents($archivo_origen);
      //  echo $contenido;
        $archivo_destino = 'sysadmin/vistas/db_destino_marketplace.php'; // Nombre del archivo de destino
        // Obtener el contenido del archivo original
       // $origen = fopen($archivo_origen_marketplace, 'r');
if (file_put_contents($archivo_destino, $contenido) !== false) {
    //echo "El JSON se ha guardado correctamente en el archivo.";
} else {
    echo "Error al guardar eddl JSON en el archivo.";
}
  require_once "sysadmin/vistas/php_conexion_marketplace.php";
  
// echo 'sysadmin/vistas/ajax/banner/'.get_row('perfil', 'banner', 'id_perfil', 1);
$id_producto = 0;
$pagina = 'gracias';
include './auditoria.php';
include './includes/style.php';
//include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['session'])) {
    $errors[] = "ID VACIO";
} else if (!empty($_POST['cliente'])) {

    $session_id     = $_POST['session'];
    $nombre     = $_POST['nombre'];
    $telefono    = $_POST['telefono'];
    $calle_principal    = $_POST['calle_principal'];
    $calle_secundaria    = $_POST['calle_secundaria'];
    $referencia    = $_POST['referencia'];
    $provincia     = $_POST['provinica'];
    $ciudad     = $_POST['ciudad'];
    $observacion     = $_POST['observacion'];

    $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
    $contenido = '';
    $direccion = get_row('provincia_laar', 'provincia', 'codigo_provincia', $provincia) . ' ' . get_row('ciudad_laar', 'nombre', 'codigo', $ciudad) . ' ' . $calle_principal . ' ' . $calle_secundaria . ' ' . $referencia;
    //Comprobamos si hay archivos en la tabla temporal
    // echo "select * from tmp_ventas where session_id='" . $session_id . "'";
    $sql_count = mysqli_query($conexion, "select * from tmp_ventas where session_id='" . $session_id . "'");
    $count     = mysqli_num_rows($sql_count);

    // escaping, additionally removing everything that could be (html/javascript-) code
    $id_cliente     = intval($_POST['cliente']);
    $id_vendedor    = 1;
    $users          = 1;
    $condiciones    = 1;
    //$numero_factura = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST["factura"], ENT_QUOTES)));
    $validez        = 3;
    $date_added     = date("Y-m-d H:i:s");
    //Operacion de Creditos
    if ($condiciones == 4) {
        $estado = 2;
    } else {
        $estado = 1;
    }
    //echo "select LAST_INSERT_ID(id_factura) as last from facturas_cot order by id_factura desc limit 0,1 ";
    //Seleccionamos el ultimo compo numero_fatura y aumentamos una
    $sql = "SELECT MAX(id_factura) as ultima_factura FROM facturas_cot";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        $ultima_factura = $fila['ultima_factura'];

        if ($ultima_factura !== null) {
            $id_factura =  $ultima_factura + 1;;
        } else {
            $id_factura = 1;
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    // finde la ultima fatura
    //Control de la  numero_fatura y aumentamos una
    //echo "SELECT RIGHT(numero_factura,6) as factura FROM facturas_cot ORDER BY factura DESC LIMIT 1";
    $query_id = mysqli_query($conexion, "SELECT RIGHT(numero_factura,6) as factura FROM facturas_cot ORDER BY factura DESC LIMIT 1")
        or die('error ' . mysqli_error($conexion));
  $query_id_marketplace = mysqli_query($conexion_marketplace, "SELECT RIGHT(numero_factura,6) as factura FROM facturas_cot ORDER BY factura DESC LIMIT 1")
    or die('error ' . mysqli_error($conexion_marketplace));
  
    $count = mysqli_num_rows($query_id);
    $count_marketplace = mysqli_num_rows($query_id_marketplace);

    if ($count != 0) {

        $data_id = mysqli_fetch_assoc($query_id);
        $factura = $data_id['factura'] + 1;
    } else {
        $sql        = mysqli_query($conexion, "select LAST_INSERT_ID(id_factura) as last from facturas_cot order by id_factura desc limit 0,1 ");
        $rw         = mysqli_fetch_array($sql);
        $id_factura = $rw['last'] + 1;
    }
    
     if ($count_marketplace != 0) {
        $data_id_marketplace = mysqli_fetch_assoc($query_id_marketplace);
        $factura_marketplace = $data_id_marketplace['factura'] + 1;
    } else {
        $factura_marketplace = 1;
    }

    $buat_id = str_pad($factura, 6, "0", STR_PAD_LEFT);
    $factura = "COT-$buat_id";
    // fin de numero de fatura
    // consulta principal
    $nums          = 1;
    $impuesto      = get_row('perfil', 'impuesto', 'id_perfil', 1);
    $sumador_total = 0;
    $sum_total     = 0;
    $t_iva         = 0;
    //echo  "select * from productos, tmp_ventas where productos.id_producto=tmp_ventas.id_producto and tmp_ventas.session_id='" . $session_id . "'";
    $sql           = mysqli_query($conexion, "select * from productos, tmp_ventas where drogshipin_tmp=0 and productos.id_producto=tmp_ventas.id_producto and tmp_ventas.session_id='" . $session_id . "'");
    $resultado = mysqli_num_rows($sql);
    
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
     //echo $server_url;
     
     $contenido_productos="";
    if ($resultado > 0) {
        while ($row = mysqli_fetch_array($sql)) {
            $id_tmp          = $row["id_tmp"];
            $id_producto     = $row['id_producto'];
            $codigo_producto = $row['codigo_producto'];
            $cantidad        = $row['cantidad_tmp'];
            $drogshipin        = $row['drogshipin_tmp'];
            $desc_tmp        = $row['desc_tmp'];
            $nombre_producto = $row['nombre_producto'];
            $contenido_productos .= ' %3a%0A ' . $nombre_producto . ' x ' . $cantidad;
            //echo $contenido;
            // control del impuesto por productos.
            if ($row['iva_producto'] == 0) {
                $p_venta   = $row['precio_tmp'];
                $p_venta_f = number_format($p_venta, 2); //Formateo variables
                $p_venta_r = str_replace(",", "", $p_venta_f); //Reemplazo las comas
                $p_total   = $p_venta_r * $cantidad;
                $f_items   = rebajas($p_total, $desc_tmp); //Aplicando el descuento
                /*--------------------------------------------------------------------------------*/
                $p_total_f = number_format($f_items, 2); //Precio total formateado
                $p_total_r = str_replace(",", "", $p_total_f); //Reemplazo las comas

                $sum_total += $p_total_r; //Sumador
                $t_iva = ($sum_total * $impuesto) / 100;
                $t_iva = number_format($t_iva, 2, '.', '');
            }
            //end impuesto

            $precio_venta   = $row['precio_tmp'];
            $precio_venta_f = number_format($precio_venta, 2); //Formateo variables
            
            $precio_venta_r = str_replace(",", "", $precio_venta_f); //Reemplazo las comas
            $precio_total   = $precio_venta_r * $cantidad;
            $final_items    = rebajas($precio_total, $desc_tmp); //Aplicando el descuento
            /*--------------------------------------------------------------------------------*/
            $precio_total_f = number_format($final_items, 2); //Precio total formateado
            $precio_total_r = str_replace(",", "", $precio_total_f); //Reemplazo las comas
            $sumador_total += $precio_total_r; //Sumador

            $contenido .= ' %3a%0A ' . '*Precio: * $' . number_format($precio_venta, 2);
            $sql_f_marketplace = "SELECT MAX(id_factura) as ultima_factura FROM facturas_cot";
$resultado_f_marketplace = mysqli_query($conexion_marketplace, $sql_f_marketplace);
if ($resultado_f_marketplace) {
    
    $fila_marketplace = mysqli_fetch_assoc($resultado_f_marketplace);
    $ultima_factura_marketplace = $fila_marketplace['ultima_factura'];
  
    if ($ultima_factura_marketplace !== null) {
       $id_factura_marketplace =  $ultima_factura_marketplace + 1;
       //  echo $id_factura_marketplace;
    } else {
       $id_factura_marketplace=1;
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conexion_marketplace);
}
            //Insert en la tabla detalle_factura
            // echo "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura','$factura','$id_producto','$cantidad','$desc_tmp','$precio_venta_r')";
            $insert_detail = mysqli_query($conexion, "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura','$factura','$id_producto','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin',NULL)");
        $insert_detail = mysqli_query($conexion_marketplace, "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura_marketplace','$factura_marketplace','$id_producto','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin','$id_producto')");
            
}
        // Fin de la consulta Principal
        $subtotal      = number_format($sumador_total, 2, '.', '');
        $total_iva     = ($subtotal * $impuesto) / 100;
        $total_iva     = number_format($total_iva, 2, '.', '') - number_format($t_iva, 2, '.', '');
        $total_factura = $subtotal + $total_iva;
        $contenido .= ' %3a%0A ' . '*Total Pedido: * $' . number_format($total_factura, 2);
        //echo "INSERT INTO facturas_cot VALUES (NULL,'$factura','$date_added','$id_cliente','$id_vendedor','$condiciones','$total_factura','$estado','$users','$validez','1')";
        $sql = "INSERT INTO `facturas_cot` ( `numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`,  `drogshipin`) "
            . "VALUES ( '$factura', '$date_added', '$id_cliente', '$id_vendedor', '$condiciones', '$total_factura', '$estado', '$users', '$validez', '1', '$nombre', '$telefono', '$provincia', '$calle_principal', '$ciudad', '$calle_secundaria', '$referencia', '$observacion', '0', '', 0); ";
        //echo $sql;
        $insert      = mysqli_query($conexion, $sql);

    $ultimo_id = mysqli_insert_id($conexion);
$sql_marketplace="INSERT INTO `facturas_cot` ( `numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `drogshipin`, `tienda`, `id_factura_origen`) "
            . "VALUES ( '$factura_marketplace', '$date_added', '$id_cliente', '$id_vendedor', '$condiciones', '$total_factura', '$estado', '$users', '$validez', '1', '$nombre', '$telefono', '$provincia', '$calle_principal', '$ciudad', '$calle_secundaria', '$referencia', '$observacion', '0', '', 4,'$server_url','$ultimo_id'); ";
//echo $sql_marketplace;
$insert      = mysqli_query($conexion_marketplace, $sql_marketplace);
        // SI ES DROGSHIPDEBE GENERARSE EN EL MARKETPLACE

    }
    //si la venta es drgoshipin





    //require_once "$server_url/marketplace/sysadmin/vistas/db.php";



    // Guardar el contenido descargado en un archivo local

    //require_once "sysadmin/vistas/funciones.php";


    $sql_productos = "SELECT tienda, COUNT(*) as cantidad_productos
FROM productos, tmp_ventas 
WHERE drogshipin_tmp=1 
    AND productos.id_producto=tmp_ventas.id_producto 
    AND tmp_ventas.session_id='$session_id'
GROUP BY tienda;";

    // echo $sql_productos;


    $sql_producto_tienda = mysqli_query($conexion, $sql_productos);

    if ($sql_producto_tienda) {

        while ($row_tienda = mysqli_fetch_assoc($sql_producto_tienda)) {
            $tienda         = $row_tienda["tienda"];

            if ($_SERVER['HTTP_HOST'] == 'localhost') {
                $or_marketplace = 'http://localhost/marketplace/';
            } else {
                $or_marketplace = 'https://marketplace.imporsuit.com/';
            }
            $archivo_origen = $or_marketplace . 'sysadmin/vistas/db1.php';
            // echo $archivo_origen;
            $contenido = file_get_contents($archivo_origen);
            //  echo $contenido;

            $archivo_destino = 'sysadmin/vistas/db_destino_marketplace.php'; // Nombre del archivo de destino
            // Obtener el contenido del archivo original

            // $origen = fopen($archivo_origen_marketplace, 'r');
            if (file_put_contents($archivo_destino, $contenido) !== false) {
                //echo "El JSON se ha guardado correctamente en el archivo.";


            } else {
                echo "Error al guardar eddl JSON en el archivo.";
            }

            require_once "sysadmin/vistas/php_conexion_marketplace.php";

            //conexion a la base destino
            $archivo_tienda = $tienda . '/sysadmin/vistas/db1.php'; // Nombre del archivo original
            // echo $archivo_tienda;
            $contenido_tienda = file_get_contents($archivo_tienda);
            $archivo_destino_tienda = 'sysadmin/vistas/db_destino.php'; // Nombre del archivo de destino

            // $origen = fopen($archivo_origen_marketplace, 'r');
            if (file_put_contents($archivo_destino_tienda, $contenido_tienda) !== false) {
                //echo "El JSON se ha guardado correctamente en el archivo.";


            } else {
                echo "Error al guardar eddl JSON en el archivo.";
            }

            require_once "sysadmin/vistas/php_conexion_destino.php";

            $nums          = 1;
            $impuesto      = get_row('perfil', 'impuesto', 'id_perfil', 1);
            $sumador_total = 0;
            $sum_total     = 0;
            $t_iva         = 0;

            $query_id = mysqli_query($conexion, "SELECT RIGHT(numero_factura,6) as factura FROM facturas_cot ORDER BY factura DESC LIMIT 1")
                or die('error ' . mysqli_error($conexion));

            $query_id_destino = mysqli_query($conexion_destino, "SELECT RIGHT(numero_factura,6) as factura FROM facturas_cot ORDER BY factura DESC LIMIT 1")
                or die('error ' . mysqli_error($conexion_destino));

            $query_id_marketplace = mysqli_query($conexion_marketplace, "SELECT RIGHT(numero_factura,6) as factura FROM facturas_cot ORDER BY factura DESC LIMIT 1")
                or die('error ' . mysqli_error($conexion_marketplace));

            $count = mysqli_num_rows($query_id);
            $count_destino = mysqli_num_rows($query_id_destino);
            $count_marketplace = mysqli_num_rows($query_id_marketplace);

            if ($count_marketplace != 0) {

                $data_id_marketplace = mysqli_fetch_assoc($query_id_marketplace);
                $factura_marketplace = $data_id_marketplace['factura'] + 1;
            } else {
                $factura_marketplace = 1;
            }

            if ($count_destino != 0) {

                $data_id_destino = mysqli_fetch_assoc($query_id_destino);
                $factura_destino = $data_id_destino['factura'] + 1;
            } else {
                $factura_destino = 1;
            }

            if ($count != 0) {

                $data_id = mysqli_fetch_assoc($query_id);
                $factura = $data_id['factura'] + 1;
            } else {
                $factura = 1;
            }

            $buat_id = str_pad($factura, 6, "0", STR_PAD_LEFT);
            $buat_id_destino = str_pad($factura_destino, 6, "0", STR_PAD_LEFT);
            $buat_id_marketplace = str_pad($factura_marketplace, 6, "0", STR_PAD_LEFT);
            $factura = "COT-$buat_id";
            $factura_destino = "COT-$buat_id_destino";
            $factura_marketplace = "COT-$buat_id_marketplace";



            // $sql_tienda           = mysqli_query($conexion, "select * from productos, tmp_ventas where  tienda=$tienda and drogshipin_tmp=1 and productos.id_producto=tmp_ventas.id_producto and tmp_ventas.session_id='" . $session_id . "'");
            //echo "select * from productos, tmp_ventas where tienda='$tienda' and drogshipin_tmp=1 and productos.id_producto=tmp_ventas.id_producto and tmp_ventas.session_id='" . $session_id . "'";
            $sql           = mysqli_query($conexion, "select * from productos, tmp_ventas where tienda='$tienda' and  drogshipin_tmp=1 and productos.id_producto=tmp_ventas.id_producto and tmp_ventas.session_id='" . $session_id . "'");
            $resultado = mysqli_num_rows($sql);
            $contenido_productos="";
            if ($resultado > 0) {
                while ($row = mysqli_fetch_array($sql)) {
                    $id_tmp          = $row["id_tmp"];
                    $id_producto     = $row['id_producto'];
                    $codigo_producto = $row['codigo_producto'];
                    $cantidad        = $row['cantidad_tmp'];
                    $drogshipin        = $row['drogshipin_tmp'];
                    $desc_tmp        = $row['desc_tmp'];
                    $nombre_producto = $row['nombre_producto'];
                    $id_producto_origen = $row['id_producto_origen'];
                    $id_marketplace = $row['id_marketplace'];
                    $contenido_productos .= ' %3a%0A ' . $nombre_producto . ' x ' . $cantidad;
                    // control del impuesto por productos.
                    if ($row['iva_producto'] == 0) {
                        $p_venta   = $row['precio_tmp'];
                        $p_venta_f = number_format($p_venta, 2); //Formateo variables
                        $p_venta_r = str_replace(",", "", $p_venta_f); //Reemplazo las comas
                        $p_total   = $p_venta_r * $cantidad;
                        $f_items   = rebajas($p_total, $desc_tmp); //Aplicando el descuento
                        /*--------------------------------------------------------------------------------*/
                        $p_total_f = number_format($f_items, 2); //Precio total formateado
                        $p_total_r = str_replace(",", "", $p_total_f); //Reemplazo las comas

                        $sum_total += $p_total_r; //Sumador
                        $t_iva = ($sum_total * $impuesto) / 100;
                        $t_iva = number_format($t_iva, 2, '.', '');
                    }
                    //end impuesto

                    $precio_venta   = $row['precio_tmp'];
                    $precio_venta_f = number_format($precio_venta, 2); //Formateo variables
                    $precio_venta_r = str_replace(",", "", $precio_venta_f); //Reemplazo las comas
                    $precio_total   = $precio_venta_r * $cantidad;
                    $final_items    = rebajas($precio_total, $desc_tmp); //Aplicando el descuento
                    /*--------------------------------------------------------------------------------*/
                    $precio_total_f = number_format($final_items, 2); //Precio total formateado
                    $precio_total_r = str_replace(",", "", $precio_total_f); //Reemplazo las comas
                    $sumador_total += $precio_total_r; //Sumador

                    $contenido .= ' %3a%0A ' . '*Precio: * $' . number_format($precio_venta, 2);
                    //Insert en la tabla detalle_factura
                    // echo "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura','$factura','$id_producto','$cantidad','$desc_tmp','$precio_venta_r')";
                    $sql_f = "SELECT MAX(id_factura) as ultima_factura FROM facturas_cot";
                    $resultado_f = mysqli_query($conexion, $sql_f);

                    if ($resultado_f) {
                        $fila = mysqli_fetch_assoc($resultado_f);
                        $ultima_factura = $fila['ultima_factura'];

                        if ($ultima_factura !== null) {
                            $id_factura =  $ultima_factura + 1;;
                        } else {
                            $id_factura = 1;
                        }
                    } else {
                        echo "Error en la consulta: " . mysqli_error($conexion);
                    }

                    $sql_f_destino = "SELECT MAX(id_factura) as ultima_factura FROM facturas_cot";
                    $resultado_f_destino = mysqli_query($conexion_destino, $sql_f_destino);

                    if ($resultado_f_destino) {
                        $fila_destino = mysqli_fetch_assoc($resultado_f_destino);
                        $ultima_factura_destino = $fila_destino['ultima_factura'];

                        if ($ultima_factura_destino !== null) {
                            $id_factura_destino =  $ultima_factura_destino + 1;;
                        } else {
                            $id_factura_destino = 1;
                        }
                    } else {
                        echo "Error en la consulta: " . mysqli_error($conexion_destino);
                    }

                    //marketplace
                    $sql_f_marketplace = "SELECT MAX(id_factura) as ultima_factura FROM facturas_cot";
                    $resultado_f_marketplace = mysqli_query($conexion_marketplace, $sql_f_marketplace);

                    if ($resultado_f_marketplace) {
                        $fila_marketplace = mysqli_fetch_assoc($resultado_f_marketplace);
                        $ultima_factura_marketplace = $fila_marketplace['ultima_factura'];

                        if ($ultima_factura_marketplace !== null) {
                            $id_factura_marketplace =  $ultima_factura_marketplace + 1;;
                        } else {
                            $id_factura_marketplace = 1;
                        }
                    } else {
                        echo "Error en la consulta: " . mysqli_error($conexion_marketplace);
                    }
                    //echo "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura','$factura','$id_producto','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin')";



                    $insert_detail = mysqli_query($conexion, "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura','$factura','$id_producto','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin','$id_producto_origen')");
                    //$sql_insertar_detalle="INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura_destino','$factura_destino','$id_producto_origen','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin','$id_producto_origen')";
                    $insert_detail = mysqli_query($conexion_destino, "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura_destino','$factura_destino','$id_producto_origen','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin','$id_producto_origen')");
                   // echo "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura_marketplace','$factura_marketplace','$id_marketplace','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin','$id_producto_origen')";
                    $insert_detail = mysqli_query($conexion_marketplace, "INSERT INTO detalle_fact_cot VALUES (NULL,'$id_factura_marketplace','$factura_marketplace','$id_marketplace','$cantidad','$desc_tmp','$precio_venta_r','$drogshipin','$id_producto_origen')");
                }
                // Fin de la consulta Principal
                $subtotal      = number_format($sumador_total, 2, '.', '');
                $total_iva     = ($subtotal * $impuesto) / 100;
                $total_iva     = number_format($total_iva, 2, '.', '') - number_format($t_iva, 2, '.', '');
                $total_factura = $subtotal + $total_iva;
                $contenido .= ' %3a%0A ' . '*Total Pedido: * $' . number_format($total_factura, 2);
                //echo "INSERT INTO facturas_cot VALUES (NULL,'$factura','$date_added','$id_cliente','$id_vendedor','$condiciones','$total_factura','$estado','$users','$validez','1')";
                $sql = "INSERT INTO `facturas_cot` ( `numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `drogshipin`, `tienda`) "
                    . "VALUES ( '$factura', '$date_added', '$id_cliente', '$id_vendedor', '$condiciones', '$total_factura', '$estado', '$users', '$validez', '1', '$nombre', '$telefono', '$provincia', '$calle_principal', '$ciudad', '$calle_secundaria', '$referencia', '$observacion', '0', '', 1,'$tienda'); ";
                // echo $sql;

                $insert      = mysqli_query($conexion, $sql);
                $ultimo_id = mysqli_insert_id($conexion_destino);

                if (
                    isset($_SERVER['HTTPS']) &&
                    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
                    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
                ) {
                    $protocol = 'https://';
                } else {
                    $protocol = 'http://';
                }
                //$image_path = str_replace('../..', 'sysadmin', $image_path);

                $server_url = $protocol . $_SERVER['HTTP_HOST'];

                $sql_destino = "INSERT INTO `facturas_cot` ( `numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `drogshipin`, `tienda`, `id_factura_origen`) "
                    . "VALUES ( '$factura_destino', '$date_added', '$id_cliente', '$id_vendedor', '$condiciones', '$total_factura', '$estado', '$users', '$validez', '1', '$nombre', '$telefono', '$provincia', '$calle_principal', '$ciudad', '$calle_secundaria', '$referencia', '$observacion', '0', '', 3,'$server_url','$ultimo_id'); ";
                // echo $sql;

                $insert_destino      = mysqli_query($conexion_destino, $sql_destino);



                $sql_marketplace = "INSERT INTO `facturas_cot` ( `numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `monto_factura`, `estado_factura`, `id_users_factura`, `validez`, `id_sucursal`, `nombre`, `telefono`, `provincia`, `c_principal`, `ciudad_cot`, `c_secundaria`, `referencia`, `observacion`, `guia_enviada`, `transporte`, `drogshipin`, `tienda`, `id_factura_origen`) "
                    . "VALUES ( '$factura_marketplace', '$date_added', '$id_cliente', '$id_vendedor', '$condiciones', '$total_factura', '$estado', '$users', '$validez', '1', '$nombre', '$telefono', '$provincia', '$calle_principal', '$ciudad', '$calle_secundaria', '$referencia', '$observacion', '0', '', 3,'$server_url','$ultimo_id'); ";
                // echo $sql;

                $insert_destino      = mysqli_query($conexion_marketplace, $sql_marketplace);
            }
        }
    }

    $delete        = mysqli_query($conexion, "DELETE FROM tmp_ventas WHERE session_id='" . $session_id . "'");
    //header("Location: ../gracias.php");
    // SI TODO ESTA CORRECTO


}

?>

<html>
<?php
include 'includes/head.php'

?>

<body class="gradient">
    <style>
        .contenido {
            padding: 100px;

        }
    </style>

    <a class="skip-to-content-link button visually-hidden" href="#MainContent">
        Skip to content
    </a>

    <script src="js/product-info.js" type="text/javascript"></script>
    <script src="js/product-form.js" type="text/javascript"></script>
    <script src="js/cart.js?v=139383546597281746371693673626" defer="defer"></script>
    <script src="js/product-info.js?v=174806172978439001541693673628" defer="defer"></script>

    <style>
        .drawer {
            visibility: hidden;
        }
    </style>
    <?php
    include 'includes/carrito.php';
    ?>
    <!-- BEGIN sections: header-group -->
    <div id="shopify-section-sections--20805847122201__2c2ec774-3430-481f-b927-e9c035b9d24e" class="shopify-section shopify-section-group-header-group">
        <link href="ccs/component-tickers.css?v=30346802988262109031693673627" rel="stylesheet" type="text/css" media="all" />

        <?php include './includes/flotante.php' ?>
        <!-- <div class="horizontal-ticker__inner"> -->
        <?php
        include 'includes/horizontal_items.php';
        ?>
        <!-- </div> -->
    </div>
    <div id="shopify-section-sections--20805847122201__header" class="shopify-section shopify-section-group-header-group section-header">
        <link href="ccs/component-list-menu.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="ccs/component-list-menu.css?v=151968516119678728991693673627" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="ccs/component-search.css?v=184225813856820874251693673627" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="ccs/component-menu-drawer.css?v=183501262910778191901693673627" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="ccs/component-cart-notification.css?v=137625604348931474661693673627" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="ccs/component-cart-items.css?v=68325217056990975251693673627" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="ccs/component-price.css?v=183165605081763449011693673627" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="ccs/component-loading-overlay.css?v=167310470843593579841693673627" media="print" onload="this.media='all'">
        <link href="ccs/component-cart-drawer.css?v=103351759924144934211693673627" rel="stylesheet" type="text/css" media="all" />
        <link href="ccs/component-cart.css?v=183883492810467818381693673627" rel="stylesheet" type="text/css" media="all" />
        <link href="ccs/component-totals.css?v=54425048278126878361693673627" rel="stylesheet" type="text/css" media="all" />
        <link href="ccs/component-price.css?v=183165605081763449011693673627" rel="stylesheet" type="text/css" media="all" />
        <link href="ccs/component-discounts.css?v=152760482443307489271693673627" rel="stylesheet" type="text/css" media="all" />
        <link href="ccs/component-loading-overlay.css?v=167310470843593579841693673627" rel="stylesheet" type="text/css" media="all" />
        <noscript>
            <link href="ccs/component-list-menu.css?v=151968516119678728991693673627" rel="stylesheet" type="text/css" media="all" />
        </noscript>
        <noscript>
            <link href="ccs/component-search.css?v=184225813856820874251693673627" rel="stylesheet" type="text/css" media="all" />
        </noscript>
        <noscript>
            <link href="ccs/component-menu-drawer.css?v=183501262910778191901693673627" rel="stylesheet" type="text/css" media="all" />
        </noscript>
        <noscript>
            <link href="ccs/component-cart-notification.css?v=137625604348931474661693673627" rel="stylesheet" type="text/css" media="all" />
        </noscript>
        <noscript>
            <link href="ccs/component-cart-items.css?v=68325217056990975251693673627" rel="stylesheet" type="text/css" media="all" />
        </noscript>
        <script src="js/details-disclosure.js?v=153497636716254413831693673628" defer="defer"></script>
        <script src="js/details-modal.js?v=4511761896672669691693673628" defer="defer"></script>
        <script src="js/cart-notification.js?v=160453272920806432391693673626" defer="defer"></script>
        <script src="js/cart.js" type="text/javascript"></script>
        <script src="js/search-form.js?v=113639710312857635801693673628" defer="defer"></script>

        <svg xmlns="http://www.w3.org/2000/svg" class="hidden">
            <symbol id="icon-search" viewbox="0 0 18 19" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.03 11.68A5.784 5.784 0 112.85 3.5a5.784 5.784 0 018.18 8.18zm.26 1.12a6.78 6.78 0 11.72-.7l5.4 5.4a.5.5 0 11-.71.7l-5.41-5.4z" fill="currentColor" />
            </symbol>
            <symbol id="icon-reset" class="icon icon-close" fill="none" viewBox="0 0 18 18" stroke="currentColor">
                <circle r="8.5" cy="9" cx="9" stroke-opacity="0.2" />
                <path d="M6.82972 6.82915L1.17193 1.17097" stroke-linecap="round" stroke-linejoin="round" transform="translate(5 5)" />
                <path d="M1.22896 6.88502L6.77288 1.11523" stroke-linecap="round" stroke-linejoin="round" transform="translate(5 5)" />
            </symbol>
            <symbol id="icon-close" class="icon icon-close" fill="none" viewBox="0 0 18 17">
                <path d="M.865 15.978a.5.5 0 00.707.707l7.433-7.431 7.579 7.282a.501.501 0 00.846-.37.5.5 0 00-.153-.351L9.712 8.546l7.417-7.416a.5.5 0 10-.707-.708L8.991 7.853 1.413.573a.5.5 0 10-.693.72l7.563 7.268-7.418 7.417z" fill="currentColor">
            </symbol>
        </svg>
        <?php
        $index_activa = "menu_activo texto_boton";
        $categoria_activa = "";
        include 'includes/styky-header.php';
        ?>
    </div>

    <div class="contenido">
        <input type="hidden" id="nombre" name='nombre' value="<?php echo $nombre; ?>">
        <input type="hidden" id="telefono" value="<?php echo $telefono; ?>">
        <input type="hidden" id="direccion" value="<?php echo $direccion; ?>">
        <input type="hidden" id="contenido" value="<?php echo $contenido_productos; ?>">

        <?php
        echo get_row('gracias', 'contenido', 'id_gacias', 1);
        ?>

    </div>
    <div id="shopify-section-sections--20805847089433__footer" class="shopify-section shopify-section-group-footer-group">
        <link href="ccs/section-footer.css?v=46383091618275559031693673628" rel="stylesheet" type="text/css" media="all" />



        <link rel="stylesheet" href="ccs/component-card.css?v=171622893807557687511693673627" media="print" onload="this.media='all'">

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <style data-shopify>
            .footer {
                margin-top: 0px;
            }

            .section-sections--20805847089433__footer-padding {
                padding-top: 24px;
                padding-bottom: 15px;
            }

            @media screen and (min-width: 750px) {
                .footer {
                    margin-top: 0px;
                }

                .section-sections--20805847089433__footer-padding {
                    padding-top: 32px;
                    padding-bottom: 20px;
                }
            }
        </style>
        <?php include './includes/footer.php'; ?>
        <?php if (get_row('perfil', 'whatsapp', 'id_perfil', '1')) {
        ?>
            <a href="https://api.whatsapp.com/send?phone=<?php
                                                            echo get_row('perfil', 'whatsapp', 'id_perfil', '1');
                                                            ?>" class="btn-flotante">Podemos ayudarte</a>
        <?php  } ?>
    </div>
    <!-- Otro contenido de la página -->
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    window.onload = function() {
        //  alert();
        <?php if (get_row('perfil', 'whatsapp', 'id_perfil', '1')) { ?>

                 enviar_registro();       
        <?php } ?>
    };

    function enviar_registro() {

//alert($("#contenido").val());
        whatsapp = '%3a%0A' + "<?php echo get_row('perfil', 'whatsapp', 'id_perfil', '1') ?>";

        nombre = '%3a%0A' + '*Nombre:* ' + $("#nombre").val();
        //  alert('entro');
        telefono = '%3a%0A' + '*Celular:* ' + ($("#telefono").val());

        direccion = '%3a%0A' + '*Dirección:* ' + ($("#direccion").val());
        comentario = '%3a%0A' + '*Productos:* ' + ($("#contenido").val());

        //Producto 1%3a* SOLUTION PACK "PRIMEROS FRIOS"%0A*Cantidad%3a*1%20%0A*Precio%3a* %241500%0A%0A*Total*%3a %241500%0A%0APor favor tengan a bien responder para coordinar la entrega.&source=&data=&app_absent=
        variable = 'https://api.whatsapp.com/send?phone=' + <?php
                                                            echo get_row('perfil', 'whatsapp', 'id_perfil', '1');
                                                            ?> + '&text=Nuevo pedido' + nombre + telefono + direccion + comentario;
        window.location.href = variable;

        //window.open(variable,'width=400,height=300,resizable=yes');   


    }
</script>

</html>