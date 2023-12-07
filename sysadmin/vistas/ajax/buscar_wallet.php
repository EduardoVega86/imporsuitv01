<?php
/*-------------------------
Autor: Eduardo Vega
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Wallets";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == "ajax") {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $sTable = "wallet_cot";
    $sWhere = "";
    $sWhere .= "WHERE facturas_cot.id_cliente=clientes.id_cliente and facturas_cot.id_vendedor=users.id_users";
    if ($_GET['q'] != "") {
        $sWhere .= " and  (clientes.nombre_cliente like '%$q%' or facturas_cot.numero_factura like '%$q%')";
    }
    $sWhere .= " order by facturas_cot.id_factura desc";
    include 'pagination.php'; //include pagination file
    //pagination variables  
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 10; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = '../reportes/wallet.php';
    //main query to fetch the data
    $sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {
?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr class="info">
                        <th class="text-center"># Orden </th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Tienda</th>
                        <th class="text-center">Estado Guia</th>
                        <th class="text-center">Total Venta</th>
                        <th class="text-center">Costo</th>
                        <th class="text-center">Precio de Envio</th>
                        <th class="text-center">Monto a recibir</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($query)) {
                        $id_factura = $row['id_factura'];
                        $fecha = date('d/m/Y', strtotime($row['fecha']));
                        $nombre_cliente = $row['nombre_cliente'];
                        $tienda = $row['tienda'];
                        $estado_guia = $row['estado_guia'];
                        $total_venta = $row['total_venta'];
                        $costo = $row['costo'];
                        $precio_envio = $row['precio_envio'];
                        $monto_recibir = $row['monto_recibir'];
                        $estado_factura = $row['estado_factura'];
                        $guia_enviada   = $row['guia_enviada'];

                        if ($estado_factura == 1) {
                            $text_estado = "INGRESADA";
                            $label_class = 'badge-success';
                        } else {
                            $text_estado = "CREDITO";
                            $label_class = 'badge-danger';
                        }

                        switch ($estado_factura) {
                            case 1:
                                $text_estado = "Confirmar";
                                $label_class = 'badge-success';
                                break;
                            case 2:
                                $text_estado = "Pick y Pack ";
                                $label_class = 'badge-info';
                                break;
                            case 3:
                                $text_estado = "Despachado";
                                $label_class = 'badge-success';
                                break;
                            case 4:
                                $text_estado = "Zona de entrega ";
                                $label_class = 'badge-purple';
                                break;
                            case 5:
                                $text_estado = "Cobrado";
                                $label_class = 'badge-warning';
                                break;
                            case 6:
                                $text_estado = "Pagado ";
                                $label_class = 'badge-purple';
                                break;

                            case 7:
                                $text_estado = "Liquidado";
                                $label_class = 'badge-primary';
                                break;
                            case 8:
                                $text_estado = "Anulado";
                                $label_class = 'badge-danger';
                                break;
                            default:
                                echo "Estado no reconocido";
                        }

                        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
                    ?>
                        <input type="hidden" value="<?php echo $estado_factura; ?>" id="estado<?php echo $id_factura; ?>">

                        <tr>
                            <td class="text-center"><label class="badge badge-purple"> <?php echo $id_factura; ?></label></td>
                            <td class="text-center"><?php echo $fecha; ?></td>
                            <td class="text-center"><?php echo $nombre_cliente; ?></td>
                            <td class="text-center"><?php echo $tienda; ?></td>
                            <td class="text-center"><?php
                                                    $estado_guia = "NO ENVIADA";
                                                    if ($guia_enviada == 1 && $estado_guia != 0) {
                                                        $guia_numero = get_row('guia_laar', 'guia_laar', 'id_pedido', $id_factura);
                                                        $url = 'https://api.laarcourier.com:9727/guias/' . $guia_numero;

                                                        $curl = curl_init($url);

                                                        // Establecer opciones para la solicitud cURL
                                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                        curl_setopt($curl, CURLOPT_HTTPHEADER, [
                                                            'Accept: application/json'
                                                        ]);

                                                        // Realizar la solicitud GET
                                                        $response = curl_exec($curl);

                                                        // Verificar si hubo algún error en la solicitud
                                                        if ($response === false) {
                                                            echo 'Error en la solicitud: ' . curl_error($curl);
                                                        } else {
                                                            // Procesar la respuesta
                                                            $data = json_decode($response, true);
                                                            if ($data !== null && isset($data['estadoActualCodigo'])) {
                                                                // Imprimir el estadoActual
                                                                //echo 'Estado Actual: ' . $data['estadoActual'];
                                                                switch ($data['estadoActualCodigo']) {
                                                                    case '1':

                                                                        $span_estado = 'badge-danger';
                                                                        $estado_guia = 'Anulado';
                                                                        break;
                                                                    case '2':
                                                                        $span_estado = 'badge-purple';
                                                                        $estado_guia = 'Por recolectar';
                                                                        break;
                                                                    case '3':
                                                                        $span_estado = 'badge-purple';
                                                                        $estado_guia = 'Por recolectar';
                                                                        break;
                                                                    case '4':
                                                                        $span_estado = 'badge-purple';
                                                                        $estado_guia = 'Por recolectar';
                                                                        break;
                                                                    case '5':
                                                                        $span_estado = 'badge-purple';
                                                                        $estado_guia = 'Por recolectar';
                                                                        break;
                                                                    case '6':
                                                                        $span_estado = 'badge-purple';
                                                                        $estado_guia = 'Por recolectar';
                                                                        break;
                                                                    case '7':
                                                                        $span_estado = 'badge-purple';
                                                                        $estado_guia = 'Anulada';
                                                                        break;
                                                                    case '8':
                                                                        $span_estado = 'badge-purple';
                                                                        $estado_guia = 'Anulada';
                                                                        break;
                                                                    case '9':
                                                                        echo "i es igual a 2";
                                                                        break;
                                                                }
                                                            } else {
                                                                echo 'No se pudo obtener el estadoActual';
                                                            }
                                                        }

                                                        // Cerrar la sesión cURL
                                                        curl_close($curl);

                                                        $url = get_row('guia_laar', 'url_guia', 'id_pedido', $id_factura);
                                                        $traking = "https://fenix.laarcourier.com/Tracking/Guiacompleta.aspx?guia=" . get_row('guia_laar', 'guia_laar', 'id_pedido', $id_factura);


                                                    ?>
                                    <a style="cursor: pointer;" href="<?php echo $url; ?>" target="blank"><span class="badge <?php echo $span_estado; ?>"><?php echo $estado_guia; ?></span></a><BR>
                                    <a style="cursor: pointer;" href="<?php echo $url; ?>" target="blank"><span class=""><?php echo $guia_numero; ?></span></a><BR>
                                    <a style="cursor: pointer;" href="<?php echo $traking; ?>" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>
                                <?php
                                                    } else {
                                                        if ($estado_factura == 8) {
                                                            echo 'GUIA ANULADA';
                                                        } else {
                                                            echo 'NO ENVIADA';
                                                        }
                                                    }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $simbolo_moneda . $total_venta; ?></td>
                            <td class="text-center"><?php echo $simbolo_moneda . $costo; ?></td>
                            <td class="text-center"><?php echo $simbolo_moneda . $precio_envio; ?></td>
                            <td class="text-center"><?php echo $monto_recibir; ?></td>
                            <td class="text-center">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php if ($permisos_editar == 1) { ?>
                                            <a class="dropdown-item" href="editar_cotizacion.php?id_factura=<?php echo $id_factura; ?>"><i class='fa fa-edit'></i> Editar</a>
                                            <!--a class="dropdown-item" href="#" onclick="imprimir_factura('<?php echo $id_factura; ?>');"><i class='fa fa-print'></i> Imprimir</a-->
                                        <?php }
                                        if ($permisos_eliminar == 1) { ?>
                                            <!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id_factura']; ?>"><i class='fa fa-trash'></i> Eliminar</a>-->
                                        <?php } ?>


                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan=10><span class="pull-right">
                                <?php
                                echo paginate($reload, $page, $total_pages, $adjacents);
                                ?></span></td>
                    </tr>
                </tbody>

            </table>
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-warning alert-dismissible" role="alert" align="center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Aviso!</strong> No hay Registro de Cotizaciones
        </div>
<?php
    }
}
?>