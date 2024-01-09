<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
/*-------------------------
Autor: Eduardo Vega
---------------------------*/

/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
require_once "../funciones_destino.php";
//Inicia Control de Permisos



if (isset($_POST['factura']) && isset($_POST['tipo'])) {
    if ($_POST['tipo'] == "simple") {

        $sql_command = "SELECT * FROM facturas_cot WHERE numero_factura = '" . $_POST['factura'] . "'";
        $result = mysqli_query($conexion, $sql_command);
        $row = mysqli_fetch_array($result);
        $tienda = $row['tienda'];
        $id_factura_origen = $row['id_factura_origen'];
        $sql_command = "SELECT id_transporte FROM guia_laar WHERE id_pedido = '" . $id_factura_origen . "' and tienda_venta = '" . $tienda . "'";
        $result = mysqli_query($conexion, $sql_command);
        $row = mysqli_fetch_array($result);

        $id_transporte = $row['id_transporte'];
        $archivo_tienda = $tienda . '/sysadmin/vistas/db1.php';
        $archivo_destino_tienda = '../db_destino_guia.php';
        $contenido_tienda = file_get_contents($archivo_tienda);
        $get_data =  json_decode($contenido_tienda, true);
        $guias_impresas = array();

        if (file_put_contents($archivo_destino_tienda, $contenido_tienda) !== false) {
            $conexion_destino = mysqli_connect($get_data['DB_HOST'], $get_data['DB_USER'], $get_data['DB_PASS'], $get_data['DB_PASS']);
            if ($conexion_destino->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $conexion_destino->connect_errno . ") " . $conexion_destino->connect_error;
            }
            $sql_command = "SELECT * FROM guia_laar g inner join facturas_cot f on g.id_pedido = f.id_factura inner join detalle_fact_cot dt on f.numero_factura = dt.numero_factura inner join productos p on p.id_producto = dt.id_producto WHERE g.id_pedido = '" . $id_factura_origen . "'";
            $result = mysqli_query($conexion_destino, $sql_command);
            $contador = 1;

            $manifiestoT = '';
            $manifiesto = '';

            $productoT = '';
            $producto = '';

            $transporte = '';
            $fecha_actual = date("d-m-Y");
            while ($row = mysqli_fetch_array($result)) {
                $guia_laar = $row['guia_laar'];
                array_push($guias_impresas, $guia_laar);
                $ciudad = $row['ciudadD'];
                $ciudad_destino = get_row('ciudad_laar', 'nombre', 'codigo', $ciudad);
                $costo_producto = $row[34];
                $cod = $row[32];
                if ($cod == 1) {
                    $cod = 'CON RECAUDO';
                } else {
                    $cod = 'SIN RECAUDO';
                }
                $transporte = $id_transporte;
                if ($transporte == 1) {
                    $transporte = 'Laar Courier';
                } else {
                    $transporte = 'Motorizado';
                }
                $id_producto = $row['id_producto'];
                $codigo_producto = $row['codigo_producto'];
                $nombre_producto = $row['nombre_producto'];
                $cantidad = $row['cantidad'];

                $manifiesto .= "
                <tr>
                    <td>Nro: " . $contador . "</td>
                    <td>Guia: " . $guia_laar . " </td>
                    <td>Ciudad Destino: " . $ciudad_destino . " </td>
                    <td>Valor de Recaudo: " . $costo_producto . "</td>
                    <td>Tipo de logistica: " . $cod . "</td>
                </tr>
                ";

                $producto .= "
                <tr>
                    <td> ( ID: " . $id_producto . " ) - ( SKU: " . $codigo_producto . " ) - " . $nombre_producto . " </td>
                    <td> " . $cantidad . "</td>
                </tr>
                ";
                $contador++;
            }
            $manifiestoT = "
            <table class='section1-table'>
                <tr>
                    <td>
                    TRANSPORTADORA
                    </td>
                    <td>
                    TRANSPORTADORA: " . $transporte . "
                    </td>
                </tr>
                <tr>
                    <td>
                    RELACION DE GUIAS IMPRESAS
                    </td>
                    <td>
                    FECHA MANIFIESTO (DD/MM/YYYY): " . $fecha_actual . "
                    </td>
                </tr>
            </table>
            <table class='section2-table'>
            " . $manifiesto
                . "
            </table>
            "
                . "
                <table class='section3-table'>
            <tr>
                <td>NOMBRE DE AUXILIAR:</td>
            </tr>
            <tr>
                <td>PLACA DEL VEHICULO:</td>
            </tr>
            <tr>
                <td>FIRMA DEL AUXILIAR:</td>
            </tr>
        </table>";


            $productoT .= "
            <div class='page-break'></div>

                <table class='products-table'>
                    
                    <tr>
                        <th>Productos</th>
                        <th>FECHA MANIFIESTO (DD/MM/YYYY) " . $fecha_actual . "
                        </th>
                    </tr>
                    
                </table>
            
            <table class='products-table-inv'>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                " . $producto . "
                </tbody>
            </table>
            </section>
            ";

            $devolucion = array(
                'manifiesto' => $manifiestoT,
                'producto' => $productoT,
                'guias' => $guias_impresas
            );
            echo json_encode($devolucion);
        } else {
            print_r('Error al copiar el archivo');
        }
    } else {
        if ($_POST['tipo'] == "multiple") {
            $facturas = $_POST['factura'];
            $contador = 1;

            $manifiestoT = '';
            $manifiesto = '';

            $productoT = '';
            $producto = '';

            $transporte = '';
            $fecha_actual = date("d-m-Y");
            $guias_impresas = array();
            while ($factura = current($facturas)) {
                $sql_command = "SELECT * FROM facturas_cot WHERE numero_factura = '" . $factura . "'";
                $result = mysqli_query($conexion, $sql_command);
                $row = mysqli_fetch_array($result);
                $tienda = $row['tienda'];
                $id_factura_origen = $row['id_factura_origen'];
                $sql_command = "SELECT id_transporte FROM guia_laar WHERE id_pedido = '" . $id_factura_origen . "' and tienda_venta = '" . $tienda . "'";
                $result = mysqli_query($conexion, $sql_command);
                $row = mysqli_fetch_array($result);

                $id_transporte = $row['id_transporte'];
                $archivo_tienda = $tienda . '/sysadmin/vistas/db1.php';
                $archivo_destino_tienda = '../db_destino_guia.php';
                $contenido_tienda = file_get_contents($archivo_tienda);
                $get_data =  json_decode($contenido_tienda, true);
                if (file_put_contents($archivo_destino_tienda, $contenido_tienda) !== false) {
                    $conexion_destino = mysqli_connect($get_data['DB_HOST'], $get_data['DB_USER'], $get_data['DB_PASS'], $get_data['DB_PASS']);
                    if ($conexion_destino->connect_errno) {
                        echo "Fallo al conectar a MySQL: (" . $conexion_destino->connect_errno . ") " . $conexion_destino->connect_error;
                    }
                    $sql_command = "SELECT * FROM guia_laar g inner join facturas_cot f on g.id_pedido = f.id_factura inner join detalle_fact_cot dt on f.numero_factura = dt.numero_factura inner join productos p on p.id_producto = dt.id_producto WHERE g.id_pedido = '" . $id_factura_origen . "'";
                    $result = mysqli_query($conexion_destino, $sql_command);
                    while ($row = mysqli_fetch_array($result)) {
                        $guia_laar = $row['guia_laar'];
                        array_push($guias_impresas, $guia_laar);
                        $ciudad = $row['ciudadD'];
                        $ciudad_destino = get_row('ciudad_laar', 'nombre', 'codigo', $ciudad);
                        $costo_producto = $row[34];
                        $cod = $row[32];
                        if ($cod == 1) {
                            $cod = 'CON RECAUDO';
                        } else {
                            $cod = 'SIN RECAUDO';
                        }
                        $transporte = $id_transporte;
                        if ($transporte == 1) {
                            $transporte = 'Laar Courier';
                        } else {
                            $transporte = 'Motorizado';
                        }
                        $id_producto = $row['id_producto'];
                        $codigo_producto = $row['codigo_producto'];
                        $nombre_producto = $row['nombre_producto'];
                        $cantidad = $row['cantidad'];

                        $manifiesto .= "
                            <tr>
                                <td>Nro: " . $contador . "</td>
                                <td>Guia: " . $guia_laar . " </td>
                                <td>Ciudad Destino: " . $ciudad_destino . " </td>
                                <td>Valor de Recaudo: " . $costo_producto . "</td>
                                <td>Tipo de logistica: " . $cod . "</td>
                            </tr>
                            ";

                        $producto .= "
                <tr>
                    <td> ( ID: " . $id_producto . " ) - ( SKU: " . $codigo_producto . " ) - " . $nombre_producto . " </td>
                    <td> " . $cantidad . "</td>
                </tr>
                ";
                    }
                    $contador++;
                }
                next($facturas);
            }
            $manifiestoT = "
            <table class='section1-table'>
                <tr>
                    <td>
                    TRANSPORTADORA
                    </td>
                    <td>
                    TRANSPORTADORA: " . $transporte . "
                    </td>
                </tr>
                <tr>
                    <td>
                    RELACION DE GUIAS IMPRESAS
                    </td>
                    <td>
                    FECHA MANIFIESTO (DD/MM/YYYY): " . $fecha_actual . "
                    </td>
                </tr>
            </table>
            <table class='section2-table'>
            " . $manifiesto
                . "
            </table>
            "
                . "
                <table class='section3-table'>
            <tr>
                <td>NOMBRE DE AUXILIAR:</td>
            </tr>
            <tr>
                <td>PLACA DEL VEHICULO:</td>
            </tr>
            <tr>
                <td>FIRMA DEL AUXILIAR:</td>
            </tr>
        </table>";



            $productoT .= "
        <div class='page-break'></div>

            <table class='products-table'>
                
                <tr>
                    <th>Productos</th>
                    <th>FECHA MANIFIESTO (DD/MM/YYYY) " . $fecha_actual . "
                    </th>
                </tr>
                
            </table>
        
        <table class='products-table-inv'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            " . $producto . "
            </tbody>
        </table>
        </section>
        ";
            $devolucion = array(
                'manifiesto' => $manifiestoT,
                'producto' => $productoT,
                'guias' => $guias_impresas
            );

            echo json_encode($devolucion);

            // print_r($manifiesto);
        }
    }
}
