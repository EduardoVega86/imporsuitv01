<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
/*-------------------------
Autor: Eduardo Vega
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
require_once "../funciones_destino.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Ventas";

if (isset($_POST['factura'])) {
    $sql_command = "SELECT * FROM facturas_cot WHERE id_factura = '" . $_POST['factura'] . "'";
    $result = mysqli_query($conexion, $sql_command);
    $row = mysqli_fetch_array($result);
    $tienda = $row['tienda'];
    $id_factura_origen = $row['id_factura_origen'];

    $archivo_tienda = $tienda . '/sysadmin/vistas/db1.php';
    $archivo_destino_tienda = $tienda . '../db_destino_guia.php';
    $contenido_tienda = file_get_contents($archivo_tienda);
    $get_data =  json_decode($contenido_tienda, true);
    if (file_put_contents($archivo_destino_tienda, $contenido_tienda) !== false) {
        $conexion_destino = new mysqli($get_data['DB_HOST'], $get_data['DB_USER'], $get_data['DB_PASS'], $get_data['DB_PASS']);
        if ($conexion_destino->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $conexion_destino->connect_errno . ") " . $conexion_destino->connect_error;
        }
        $sql_command = "SELECT * FROM guia_laar g inner join facturas_cot f on g.id_pedido = f.id_factura inner join detalle_fact_cot dt on f.numero_factura = dt.numero_factura inner join productos p on p.id_producto = dt.id_producto WHERE g.id_pedido = '" . $_POST['factura'] . "'";
        $result = mysqli_query($conexion_destino, $sql_command);
        $contador = 1;
        $manifiestoT = '';
        $manifiesto = '';
        $transporte = '';
        $fecha_actual = date("d-m-Y");
        while ($row = mysqli_fetch_array($result)) {
            $guia_laar = $row['guia_laar'];
            $ciudad = $row['ciudadD'];
            $ciudad_destino = get_row('ciudad_laar', 'nombre', 'codigo', $ciudad);
            $costo_producto = $row['costo_producto'];
            $cod = $row['cod'];
            if ($cod == 1) {
                $cod = 'CON RECAUDO';
            } else {
                $cod = 'SIN RECAUDO';
            }
            $transporte = $row['id_transporte'];
            $id_producto = $row['id_producto'];
            $codigo_producto = $row['codigo_producto'];
            $nombre_producto = $row['nombre_producto'];
            $cantidad = $row['cantidad'];

            $manifiesto .= "
                <section class='grid-container-multiple'>      
                        <article>
                                Nro: " . $contador . "
                            </article>
                            <article>
                                Guia: " . $guia_laar . "
                            </article>
                            <article>
                                Ciudad Destino: " . $ciudad_destino . "
                            </article>
                            <article>
                                Valor de Recaudo: " . $costo_producto . "
                            </article>
                            <article>
                                Tipo de logistica: " . $cod . "
                        </article>
                </section>
                        ";
        }
        $manifiestoT = "
        <section class='grid-container'>
            <article>
                Transportadora
            </article>
            <article>
                TRANSPORTADORA:
            </article>
            <article>
                RELACION DE GUÍAS IMPRESAS
            </article>
            <article>
                FECHA MANIFIESTO (DD/MM/YYYY):
            </article>
        </section>
        
        " . $manifiesto;

        return $manifiestoT;
    }
}
