<?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
include "../permisos.php";
//Archivo de funciones PHP
require_once "../funciones.php";
$user_id = $_SESSION['id_users'];
$action  = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $daterange      = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    //$estado_factura = intval($_REQUEST['estado_factura']);
    //$employee_id    = intval($_REQUEST['employee_id']);
    //$tables         = "facturas_ventas,  users, comprobantes_sri";
    //$campos         = "*";
    //$sWhere         = "users.id_users=facturas_ventas.id_users_factura and facturas_ventas.id_factura = comprobantes_sri.id_factura";
    /*if ($estado_factura > 0) {
        $sWhere .= " and facturas_ventas.estado_factura = '" . $estado_factura . "' ";
    }
    if ($employee_id > 0) {
        $sWhere .= " and facturas_ventas.id_vendedor = '" . $employee_id . "' ";
    }*/
    
    $sWhere = "";
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";


        $sWhere .= "facturas_ventas.fecha_factura between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by facturas_ventas.id_factura";

    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 100; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM facturas_ventas
    INNER JOIN users ON facturas_ventas.id_vendedor=users.id_users
    LEFT JOIN comprobantes_sri ON facturas_ventas.id_factura = comprobantes_sri.id_factura 
    where $sWhere ");
    if ($row = mysqli_fetch_array($count_query)) {$numrows = $row['numrows'];} else {echo mysqli_error($conexion);}
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../rep_ventas_detalladas.php';
    //main query to fetch the data
    //echo "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page";
    /*$sql = "SELECT $campos 
            FROM facturas_ventas
            INNER JOIN users ON facturas_ventas.id_vendedor=users.id_users
            LEFT JOIN comprobantes_sri ON facturas_ventas.id_factura = comprobantes_sri.id_factura 
            where $sWhere LIMIT $offset,$per_page";*/
    $query = mysqli_query($conexion, "SELECT * 
                                    FROM facturas_ventas
                                    INNER JOIN users ON facturas_ventas.id_vendedor=users.id_users
                                    LEFT JOIN comprobantes_sri ON facturas_ventas.id_factura = comprobantes_sri.id_factura 
                                    where $sWhere LIMIT $offset,$per_page");
    //loop through fetched data
    //var_dump($query);die;
    if ($numrows > 0) {
        ?>

        <div class="table-responsive">
            <table class="table table-condensed table-hover table-striped table-sm">
                <tr>
                    <th class='text-center'>Factura Nº</th>
                    <th>Cliente</th>
                    <th class='text-center'>Fecha </th>
                    <th class='text-center'>Estado Factura </th>
                    <th class='text-center'>Estado Autoriazacion </th>
                    <th>Mensaje</th>
                    <th>Forma de Pago</th>
                    <th>Vendedor</th>
                    <th>Recibido</th>
                    <th class='text-left'>Total </th>
                </tr>
                <?php
$finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            //var_dump($row);die;
            $factura           = $row['numero_factura'];
            $date_added        = $row['fecha_factura'];
            $user_fullname     = $row['nombre_users'] . ' ' . $row['apellido_users'];
            $subtotal          = $row['monto_factura'];
            $total             = $row['monto_factura'];
            $Estado            = $row['Estado'];
            $id_cliente        = $row['id_cliente'];
            $id_vendedor        = $row['id_vendedor'];
            $estado_factura    = $row['estado_factura'];
            $sql               = mysqli_query($conexion, "select * from clientes where id_cliente='" . $id_cliente . "'");
            $rw                = mysqli_fetch_array($sql);
            $cliente           = $rw['nombre_cliente'];
            $dias_credito           = $rw['dias_credito'];
            $formapago             = $row['formaPago'];
            $mensajesri        = $row['Mensaje'];
            $dinero_resibido_fac    = $row['dinero_resibido_fac'];
            if($Estado == null){
                $Estado = 'Sin Envio';
                $label_classe = 'badge-warning';
                $mensajesri = '';
            }elseif($Estado == 'AUTORIZADO'){
                $Estado = $row['Estado'];
                $label_classe = 'badge-success';
                $mensajesri = '';
            }else{
                $Estado = $row['Estado'];
                $label_classe = 'badge-danger';
                $mensajesri = $row['Mensaje'];
            }

            if($formapago == '01'){
                $formapago = 'SIN UTILIZACION DEL SISTEMA FINANCIERO';
            }elseif($formapago == '15'){
                $formapago = 'COMPENSACIÓN DE DEUDAS';
            }elseif($formapago == '16'){
                $formapago = 'TARJETA DE DÉBITO';
            }elseif($formapago == '17'){
                $formapago = 'DINERO ELECTRÓNICO';
            }elseif($formapago == '18'){
                $formapago = 'TARJETA PREPAGO';
            }elseif($formapago == '19'){
                $formapago = 'TARJETA DE CRÉDITO';
            }elseif($formapago == '20'){
                $formapago = 'OTROS CON UTILIZACION DEL SISTEMA FINANCIERO';
            }elseif($formapago == '21'){
                $formapago = 'ENDOSO DE TÍTULOS';
            }


            $date_added=Date($date_added);
            $date=Date("Y-m-d H:i:s");
            
            $date1 = new DateTime($date_added);
             date_default_timezone_set('America/Guayaquil');
            $date2 = new DateTime("now");
            $diff = $date1->diff($date2);
// 38 minutes to go [number is variable]

// passed means if its negative and to go means if its positive

            //$diff = $date->diff($date_added);
            
            //echo $date;
            list($date, $hora) = explode(" ", $date_added);
            list($Y, $m, $d)   = explode("-", $date);
            $fecha             = $d . "-" . $m . "-" . $Y;
            $finales++;
            $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
            $nombre_vendedor = get_row('users', 'CONCAT(nombre_users, " ", apellido_users)', 'id_users', $id_vendedor);
             if ($estado_factura == 0) {
                $text_estado = "Anulada";
                $label_class = 'badge-warning';
                
            }
            if ($estado_factura == 1) {
                $text_estado = "Pagada";
                $label_class = 'badge-success';
                
            } 
             if ($estado_factura == 2) {
                $text_estado = "Pendiente";
                $label_class = 'badge-danger';
                
            }
            ?>
                    <tr>
                        <td class='text-center'><label class='badge badge-purple'><?php echo $factura; ?></label></td>
                        <td><?php echo $cliente; ?></td>
                        <td class='text-center'><?php echo $fecha; ?></td>
                        <td class='text-center'><span class="badge <?php echo $label_class; ?>"><?php echo $text_estado; ?></span></td>
                        <td class='text-center'><span class="badge <?php echo $label_classe; ?>"><?php echo $Estado; ?></span></td>
                        <td class='text-center'><?php echo $mensajesri; ?></td>
                        <td class='text-center'><?php echo $formapago; ?></td>
                        <?php
                    /*if($diff->days>$dias_credito){
                                        $label_dias = 'badge-danger';

                    }else{
                        $label_dias = 'badge-success';
                    }*/
                        ?>
                        <!--<td class='text-center'><span class="badge <?php echo $label_dias; ?>"><?php echo $diff->days ;?></span></td>-->
                       
                        <!--<td><?php echo $user_fullname; ?></td>-->
                        <td><?php echo $nombre_vendedor; ?></td>
                        <td><?php echo $dinero_resibido_fac; ?></td>
                        <td class='text-left'><b><?php echo $simbolo_moneda . '' . number_format($total, 2); ?></b></td>
                    </tr>
                    <?php }?>
                </table>
            </div>

            <div class="box-footer clearfix" align="right">

                <?php
$inicios = $offset + 1;
        $finales += $inicios - 1;
        echo "Mostrando $inicios al $finales de $numrows registros";
        echo paginate($reload, $page, $total_pages, $adjacents);?>

            </div>

            <?php
}
}
?>

