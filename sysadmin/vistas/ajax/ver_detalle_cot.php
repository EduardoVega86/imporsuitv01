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
?>


<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalles de factura</h4>
            </div>
            <div class="modal-body relative">
                <div class="fs-7">
                    <span>Orden para: <?php echo $rw["nombre"] ?></span> <br>
                    <span>Dirección: <?php echo $rw["c_principal"] . " " . $rw["c_secundaria"] . " - " . $provincia  ?></span>
                    <span>Teléfono: <?php echo $rw["telefono"] ?></span>
                </div>
                <div class="absolute rigth-0">
                    <span># Orden: <?php echo $rw["numero_factura"] ?></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>