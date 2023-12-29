<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$data = file_get_contents("php://input");

parse_str($data, $datos);

require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

$numero_factura = $datos['numero_factura'];
$sql = "SELECT * from facturas_cot fc inner join detalle_fact_cot dc on fc.id_factura = dc.id_factura where fc.numero_factura = '$numero_factura'";

$query = mysqli_query($conexion, $sql);
$rw = mysqli_fetch_array($query);
$provincia = get_row("provincia_laar", "provincia", "codigo_provincia", $rw["provincia"]);
print_r($rw);
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
echo $dominio_actual;

?>


<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalles de factura</h4>
            </div>
            <div class="modal-body flex-row">
                <div class="fs-7">
                    <span>Orden para: <?php echo $rw["nombre"] ?></span> <br>
                    <span>Dirección: <?php echo $rw["c_principal"] . " " . $rw["c_secundaria"] . " - " . $provincia  ?></span>
                    <span>Teléfono: <?php echo $rw["telefono"] ?></span>
                </div>
                <div class="">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>