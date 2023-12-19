<?php
include 'is_logged.php'; //Archivo comprueba si el usuario esta logueado

$tienda = $_SESSION['tienda'];

/* Connect To Database*/
require_once "../db.php";
if (empty($_POST['abono'])) {
    $errors[] = "Cantidad vacía";
} else if (!empty($_POST['abono'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    require_once "../funciones.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $abono    = floatval($_POST['abono']);
    $total_abonado = $abono;
    $forma_pago = $_POST["forma_pago"];

    $user_id  = $_SESSION['id_users'];
    $fecha    = date("Y-m-d H:i:s");
    // Consulta para Extraer los datos del credito

    $consultar     = mysqli_query($conexion, "SELECT * FROM `cabecera_cuenta_pagar` where tienda ='$tienda' AND `valor_pendiente` != 0;");
    $rw            = mysqli_fetch_array($consultar);

    $total_monto_recibir_sql = "SELECT SUM(subquery.total_venta) as total_ventas, SUM(subquery.total_pendiente) as total_pendiente FROM ( SELECT numero_factura, MAX(total_venta) as total_venta, MAX(valor_pendiente) as total_pendiente FROM cabecera_cuenta_pagar WHERE tienda = '$tienda' GROUP BY numero_factura ) as subquery;";
    $total_monto_recibir_query = mysqli_query($conexion, $total_monto_recibir_sql);
    $total_monto_recibir_SQL = mysqli_fetch_array($total_monto_recibir_query);
    $total_monto_recibir = $total_monto_recibir_SQL['total_pendiente'];
    // verificamos si el monto esta cancelado
    if ($rw['monto_recibir'] == 0) {
        echo "<script>
        $.Notification.notify('info','bottom center','NOTIFICACIÓN', 'LA FACTURA YA FUE CANCELADA EN SU TOTALIDAD')
        </script>";
        exit;
    }
    // verificamos si el abono es mayor a la deunda
    if ($abono > $total_monto_recibir) {
        echo "<script>
        $.Notification.notify('error','bottom center','NOTIFICACIÓN', 'EL ABONO ES MAYOR A LA DEUDA, INTENTAR NUEVAMENTE')
        </script>";
        exit;
    }
    $i = 0;
    foreach ($consultar as $rws) {

        if ($abono > 0) {

            $bct = 0;
            $saldo = $rws['monto_recibir'] - $abono;
            if ($saldo < 0) {
                $abono =  -$saldo;
                $bct = $rws['monto_recibir'];
                $saldo = 0;
                $cobrado = $rws['total_venta'] - $rws['costo'] - $rws['precio_envio'];
            } else if ($saldo == 0) {
                $cobrado = $rws['total_venta'] - $rws['costo'] - $rws['precio_envio'];
                $bct = $abono;
                $abono = 0;
            } else {
                $cobrado = $rws['valor_cobrado'] + $abono;
                $bct = $abono;
                $abono = 0;
            }
            $numero_factura = $rws['numero_factura'];
            // Se actualiza la primera factura que se encuentra en la base de datos
            $sql_update = "UPDATE `cabecera_cuenta_pagar` SET `monto_recibir`='$saldo',`valor_cobrado`='$cobrado', valor_pendiente='$saldo' WHERE `numero_factura`='$numero_factura';";

            $query_update = mysqli_query($conexion, $sql_update);
            if ($i == 0) {
                $sql_pago = "INSERT INTO `pagos`( `fecha`, `numero_documento`, `valor`, `forma_pago`,`tienda` ) VALUES ('$fecha', '$numero_factura', $total_abonado, '$forma_pago', '$tienda');";
                $query_pago = mysqli_query($conexion, $sql_pago);
            }
            $i++;

            $sql_detalle_pago = "INSERT INTO `detalle_cuenta_pagar`(`valor`, `id_cabecera_cpp`, `signo`, `metodo_pago`, `id_pago`) VALUES " .
                "($bct, (SELECT MAX( id_cabecera) FROM `cabecera_cuenta_pagar` WHERE numero_factura = '$numero_factura'), '+', '$forma_pago', (SELECT MAX(id_pago) FROM `pagos`));";
            $query_detalle_pago = mysqli_query($conexion, $sql_detalle_pago);

            $comprobar = mysqli_query($conexion, "select * from cabecera_cuenta_pagar where numero_factura='" . $numero_factura . "'");
            $rww       = mysqli_fetch_array($comprobar);
            if ($rww['monto_recibir'] == 0) {
                $up_credito = mysqli_query($conexion, "update cabecera_cuenta_pagar set estado_factura=1 where numero_factura='$numero_factura'");
                echo "<script>
                $.Notification.notify('info','bottom center','NOTIFICACIÓN', 'LA FACTURA SE HA CANCELADO EN SU TOTALIDAD')
                </script>";
            }
            if ($rww) {
                $messages[] = "El Abono  ha sido ingresado satisfactoriamente." . '' . $numero_factura;
            } else {
                $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
            }
        } else {
            break;
        }
    }
    // guardamos los datos la tabla de abonos

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