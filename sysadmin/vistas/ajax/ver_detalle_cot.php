<?php

$data = file_get_contents("php://input");

parse_str($data, $datos);

require_once "../db.php";
require_once "../php_conexion.php";

$numero_factura = $datos['numero_factura'];

$sql = "SELECT * from facturas_cot fc inner join detalle_fact_cot dc on fc.id_factura = dc.id_factura where fc.numero_factura = '$numero_factura'";

$query = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_array($query);

?>


<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalles de factura</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>