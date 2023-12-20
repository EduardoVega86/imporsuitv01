<?php

include 'is_logged.php'; //Archivo comprueba si el usuario esta logueado

$tienda = $_SESSION['tienda'];

/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";

$consultar = mysqli_query($conexion, "SELECT * FROM `cabecera_cuenta_pagar` where tienda ='$tienda';");
$rw = mysqli_fetch_array($consultar);

?>

<div class="table-responsive">
    <table class="table table-sm table table-condensed table-hover table-striped ">
        <tr>
            <th>#Cabecera</th>
            <th>Factura</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Tienda</th>
            <th>Venta total</th>
            <th>Costo</th>
            <th>Precio Envio</th>
            <th>Monto a Recibir</th>
            <th>Monto Cobrado</th>
            <th>Monto Pendiente</th>

            <th>Ver</th>
            <th>Editar</th>
        </tr>
        <?php
        $finales = 0;
        foreach ($consultar as $rws) {
            $finales++;
        ?>
            <tr>
                <td><?php echo $rws['id_cabecera']; ?></td>
                <td><?php echo $rws['numero_factura']; ?></td>
                <td><?php echo $rws['fecha']; ?></td>
                <td><?php echo $rws['cliente']; ?></td>
                <td><?php echo $rws['tienda']; ?></td>
                <td><?php echo $rws['total_venta']; ?></td>
                <td><?php echo $rws['costo']; ?></td>
                <td><?php echo $rws['precio_envio']; ?></td>
                <td><?php echo $rws['monto_recibir']; ?></td>
                <td><?php echo $rws['valor_cobrado']; ?></td>
                <td><?php echo number_format($rws['valor_pendiente'], 2); ?></td>
                <td>
                    <button onclick="ver_detalles('<?php echo $rws['numero_factura']; ?>')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                    <a href="editar_wallet.php?id_factura=<?php echo $rws['numero_factura']; ?>" class="btn btn-secondary btn-sm"><i class="fa fa-wrench"></i></a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>