<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$data = file_get_contents("php://input");

parse_str($data, $datos);

require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

$numero_factura = $datos['numero_factura'];

$esDrop = get_row("facturas_cot", "drogshipin", "numero_factura", $numero_factura);
if ($esDrop == 3) {
    $sql = "SELECT * from facturas_cot fc inner join detalle_fact_cot dc on fc.numero_factura = dc.numero_factura INNER join productos p on p.id_producto = dc.id_producto where fc.numero_factura = '$numero_factura'";
    $query = mysqli_query($conexion, $sql);
    $rw = mysqli_fetch_array($query);
} else {
    $prove_temp = get_row("facturas_cot", "tienda", "numero_factura", $numero_factura);
    $id_factura_origen = get_row("facturas_cot", "id_factura_origen", "numero_factura", $numero_factura);
    $archivo_tienda = $prove_temp . '/sysadmin/vistas/db1.php';
    $archivo_destino_tienda = "../db_destino_guia.php";
    $contenido_tienda = file_get_contents($archivo_tienda);
    $get_data = json_decode($contenido_tienda, true);
    $host_d = $get_data['DB_HOST'];
    $user_d = $get_data['DB_USER'];
    $pass_d = $get_data['DB_PASS'];
    $base_d = $get_data['DB_NAME'];
    echo $host_d;
    echo $user_d;
    echo $pass_d;
    echo $base_d;


    $conexionAX = mysqli_connect($host_d, $user_d, $pass_d, $base_d);
    $sql = "SELECT * from facturas_cot fc inner join detalle_fact_cot dc on fc.numero_factura = dc.numero_factura INNER join productos p on p.id_producto = dc.id_producto where fc.id_factura = '$id_factura_origen'";
    echo $sql;
    $query = mysqli_query($conexionAX, $sql);
    $rw = mysqli_fetch_array($query);
}


$provincia = get_row("provincia_laar", "provincia", "codigo_provincia", $rw["provincia"]);

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
$dominio_actual = $protocol . $_SERVER['HTTP_HOST'];


?>


<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalles de factura</h4>
            </div>
            <div class="modal-body grid-cot">
                <div class="fs-7 w-35">
                    <span>Orden para: <?php echo $rw["nombre"] ?></span> <br>
                    <span>Dirección: <?php echo $rw["c_principal"] . " " . $rw["c_secundaria"] . " - " . $provincia  ?></span> <br>
                    <span>Teléfono: <?php echo $rw["telefono"] ?></span>
                </div>
                <div class="text-right">
                    <span># Orden: <?php echo $rw["numero_factura"] ?></span> <br>
                    <span>Fecha: <?php echo $rw["fecha_factura"] ?></span> <br>
                    <?php if ($rw["guia_enviada"] == 1) {
                        if ($dominio_actual == "https://marketplace.imporsuit.com") {
                            $transportista = get_row("guia_laar", "id_transporte", "tienda_venta ='" . $rw["tienda"] . "' and id_pedido", $rw["id_factura_origen"]);
                            $cod = get_row("guia_laar", "cod", "tienda_venta ='" . $rw["tienda"] . "' and id_pedido", $rw["id_factura_origen"]);
                        } else {
                            $transportista = get_row("guia_laar", "id_transporte", "tienda_venta ='" . $dominio_actual . "' and id_pedido", $rw["id_factura"]);
                            $cod = get_row("guia_laar", "cod", "tienda_venta ='" . $dominio_actual . "' and id_pedido", $rw["id_factura"]);
                        }

                        if ($transportista == 1) {
                            $transportista = "Laar Courier";
                        } else {
                            $transportista = "Motorizado";
                        }
                    ?>
                        <span>Compañia de envío: <?php echo $transportista ?></span> <br>

                        <span>Tipo de envio: <?php if ($cod == 1) {
                                                    echo "Con recaudo";
                                                } else {
                                                    echo "Sin recaudo";
                                                } ?> </span>
                    <?php } else {
                        echo "<span>Compañia de envío: Guia no enviada</span> <br>";
                        echo "<span>Tipo de envio: Guia no enviada</span>";
                    } ?>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Factura</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $rw["numero_factura"] ?></td>
                                <td><?php echo $rw["nombre_producto"] ?></td>
                                <td><?php echo number_format(floatval($rw["cantidad"]), 2) ?></td>
                                <td><?php echo number_format(floatval($rw["precio_venta"]), 2) ?></td>
                                <td><?php echo number_format(floatval($rw["cantidad"] * $rw["precio_venta"]), 2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>