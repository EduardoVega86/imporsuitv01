<?php

$data = file_get_contents("php://input");

parse_str($data, $datos);

require_once "../db.php";
require_once "../php_conexion.php";

$numero_factura = $datos['numero_factura'];

$sql = "SELECT * FROM cabecera_cuenta_pagar WHERE numero_factura = '$numero_factura'";

$query = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_array($query);
$cabecera = $rw['id_cabecera'];

$sql = "SELECT * FROM detalle_cuenta_pagar WHERE id_cabecera_cpp = '$cabecera'";
$query = mysqli_query($conexion, $sql);

$rw = mysqli_fetch_array($query);

$id_pago = $rw['id_pago'];

$sql = "SELECT * FROM pagos WHERE id_pago = '$id_pago'";
$query = mysqli_query($conexion, $sql);

?>


<!-- ajax modal -->


<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalles de factura</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table table-condensed table-hover table-striped ">
                        <tr>
                            <th>#Documento</th>
                            <th>Fecha</th>
                            <th>Valor</th>
                            <th>Forma de pago</th>


                            <th></th>
                        </tr>
                        <?php
                        $finales = 0;
                        foreach ($query as $rws) {
                            $finales++;
                        ?>
                            <tr>
                                <td><?php echo $rws['numero_documento']; ?></td>
                                <td><?php echo $rws['fecha']; ?></td>
                                <td><?php echo $rws['valor']; ?></td>
                                <td><?php echo $rws['forma_pago']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>