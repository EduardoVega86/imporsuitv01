<?php
include 'is_logged.php';

$tienda = $_SESSION['tienda'];
require_once "../db.php";

if (empty($_POST['abono'])) {
    $errors[] = "Cantidad vacía";
} elseif (!empty($_POST['abono'])) {
    require_once "../php_conexion.php";
    require_once "../funciones.php";

    $abono = floatval($_POST['abono']);
    $total_abonado = $abono;
    $forma_pago = $_POST["forma_pago"];

    $imagen = $_FILES['img']['name'];
    $ruta = $_FILES['img']['tmp_name'];

    $nombre_alterado = date("Y-m-d-H-i-s") . "-" . $imagen;
    $url_ubicacion = "https://marketplace.imporsuit.com/sysadmin/img/facturas/" . $nombre_alterado;

    $destino = "../../img/facturas/" . $nombre_alterado;
    copy($ruta, $destino);

    $user_id  = $_SESSION['id_users'];
    $fecha    = date("Y-m-d H:i:s");

    $consultar = mysqli_query($conexion, "SELECT * FROM `cabecera_cuenta_pagar` WHERE tienda ='$tienda' AND `valor_pendiente` != 0 AND visto ='1' ORDER by monto_recibir ASC;");

    while ($rws = mysqli_fetch_assoc($consultar)) {
        if ($abono > 0) {
            $bct = 0;

            $saldo = $rws['valor_pendiente'] - $abono;

            if ($saldo < 0) {
                $abono = -$saldo;
                $bct = $rws['monto_recibir'];
                $saldo = 0;
                $cobrado = $rws['monto_recibir'];
            } elseif ($saldo == 0) {
                $cobrado = $rws['total_venta'] - $rws['costo'] - $rws['precio_envio'];
                $bct = $abono;
                $abono = 0;
            } else {
                $cobrado = $rws['valor_cobrado'] + $abono;
                $bct = $abono;
                $abono = 0;
            }


            $numero_factura = $rws['numero_factura'];

            $sql_update = "UPDATE `cabecera_cuenta_pagar` SET `valor_cobrado`='$cobrado', valor_pendiente='$saldo' WHERE `numero_factura`='$numero_factura';";
            $query_update = mysqli_query($conexion, $sql_update);

            if ($i == 0) {
                $sql_pago = "INSERT INTO `pagos`(`fecha`, `numero_documento`, `valor`, `forma_pago`, `tienda`, `imagen`) VALUES ('$fecha', '$numero_factura', $total_abonado, '$forma_pago', '$tienda', '$url_ubicacion');";
                $query_pago = mysqli_query($conexion, $sql_pago);
            }

            $i++;

            $sql_detalle_pago = "INSERT INTO `detalle_cuenta_pagar`(`valor`, `id_cabecera_cpp`, `signo`, `metodo_pago`, `id_pago`) VALUES " .
                "($bct, (SELECT MAX(id_cabecera) FROM `cabecera_cuenta_pagar` WHERE numero_factura = '$numero_factura'), '+', '$forma_pago', (SELECT MAX(id_pago) FROM `pagos`));";
            $query_detalle_pago = mysqli_query($conexion, $sql_detalle_pago);

            $comprobar = mysqli_query($conexion, "SELECT * FROM cabecera_cuenta_pagar WHERE numero_factura='$numero_factura'");
            $rww = mysqli_fetch_array($comprobar);

            if ($rww['monto_recibir'] == 0) {
                $up_credito = mysqli_query($conexion, "UPDATE cabecera_cuenta_pagar SET estado_factura=1 WHERE numero_factura='$numero_factura'");
                echo "<script>
                $.Notification.notify('info','bottom center','NOTIFICACIÓN', 'LA FACTURA SE HA CANCELADO EN SU TOTALIDAD')
                </script>";
            }

            if ($rww) {
                $messages[] = "El Abono ha sido ingresado satisfactoriamente. $numero_factura";
            } else {
                $errors[] = "Lo siento, algo ha salido mal. Intenta nuevamente. " . mysqli_error($conexion);
            }
        } else {
            break;
        }
    }
} else {
    $errors[] = "Error desconocido.";
}

if (isset($errors)) {
?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
<?php
}

if (isset($messages)) {
?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}
?>