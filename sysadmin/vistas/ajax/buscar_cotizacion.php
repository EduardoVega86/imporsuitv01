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
$modulo = "Ventas";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q      = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $sTable = "facturas_cot, clientes, users";
    $sWhere = "";
    $sWhere .= " WHERE facturas_cot.id_cliente=clientes.id_cliente and facturas_cot.id_vendedor=users.id_users";
    if ($_GET['q'] != "") {
        $sWhere .= " and  (clientes.nombre_cliente like '%$q%' or facturas_cot.numero_factura like '%$q%')";

    }

    $sWhere .= " order by facturas_cot.id_factura desc";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row         = mysqli_fetch_array($count_query);
    $numrows     = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../reportes/facturas.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {
        echo mysqli_error($conexion);
        ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped">
             <tr  class="info">
                <th># Factura</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Telefono</th>
                <th>Provincia</th>
                <th>Ciudad</th>
                <th>Direccion</th>
                <th>Observacion</th>
                <th>Guia</th>
                <th>Pago</th>
                <th class='text-center'>Total</th>
                <th></th>

            </tr>
            <?php
while ($row = mysqli_fetch_array($query)) {
            $id_factura       = $row['id_factura'];
            $numero_factura   = $row['numero_factura'];
            $fecha            = date("d/m/Y", strtotime($row['fecha_factura']));
            $nombre_cliente   = $row['nombre_cliente'];
            $nombre   = $row['nombre'];
            
            $telefono   = $row['telefono'];
            $id_prvo=$row['provincia'];
            //echo  $id_prvo;
            $provincia   = get_row('provincia_laar', 'provincia', 'codigo_provincia', $id_prvo);
            //echo $provincia;
            $ciudad_cot   = $row['ciudad_cot'];
            //echo $ciudad_cot;
             $ciudad_cot   = get_row('ciudad_laar', 'nombre', 'codigo', $ciudad_cot);
            
            $observacion   = $row['observacion'];
            $direccion   = $row['c_principal'].' y '.$row['c_secundaria'].'-'.$row['referencia'];
            $telefono_cliente = $row['telefono_cliente'];
            $email_cliente    = $row['email_cliente'];
            $nombre_vendedor  = $row['nombre_users'] . " " . $row['apellido_users'];
            $estado_factura   = $row['estado_factura'];
            $guia_enviada   = $row['guia_enviada'];
            
            if ($estado_factura == 1) {
                $text_estado = "CONTADO";
                $label_class = 'badge-success';} else {
                $text_estado = "CREDITO";
                $label_class = 'badge-danger';}
            $total_venta    = $row['monto_factura'];
            $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
            ?>
                        <tr>
                         <td><label class='badge badge-purple'><?php echo $numero_factura; ?></label></td>
                         <td><?php echo $fecha; ?></td>
                         <td><?php echo $nombre; ?></td>
                         <td><?php echo $telefono; ?></td>
                         <td><?php echo $provincia; ?></td>
                         <td><?php echo $ciudad_cot; ?></td>
                         <td><?php echo $direccion; ?></td>
                          <td><?php echo $observacion; ?></td>
                           <td><?php 
                           if ($guia_enviada==1){
                               $url= get_row('guia_laar', 'url_guia', 'id_pedido', $id_factura);
                    $traking="https://fenix.laarcourier.com/Tracking/Guiacompleta.aspx?guia=".get_row('guia_laar', 'guia_laar', 'id_pedido', $id_factura);
           ?>
                               <a style="cursor: pointer;"  href="<?php echo $url; ?>" target="blank"  ><span class="badge badge-primary">Imprimir Guía</span></a><BR>
                               <a style="cursor: pointer;"  href="<?php echo $traking; ?>" target="blank"  ><span class="badge badge-primary">Ver estado</span></a>
                               
                                   <?php
                           }else{
                            echo 'NO ENVIADA' ;  
                           }?>
                           </td>
                         <td><span class="badge <?php echo $label_class; ?>"><?php echo $text_estado; ?></span></td>
                         <td class='text-left'><b><?php echo $simbolo_moneda . '' . number_format($total_venta, 2); ?></b></td>
                         <td class="text-center">
                          <div class="btn-group dropdown">
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                            <div class="dropdown-menu dropdown-menu-right">
                               <?php if ($permisos_editar == 1) {?>
                               <a class="dropdown-item" href="editar_cotizacion.php?id_factura=<?php echo $id_factura; ?>"><i class='fa fa-edit'></i> Editar</a>
                               <!--a class="dropdown-item" href="#" onclick="imprimir_factura('<?php echo $id_factura; ?>');"><i class='fa fa-print'></i> Imprimir</a-->
                               <?php }
            if ($permisos_eliminar == 1) {?>
                               <!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id_factura']; ?>"><i class='fa fa-trash'></i> Eliminar</a>-->
                               <?php }?>


                           </div>
                       </div>

                   </td>

               </tr>
               <?php
}
        ?>
           <tr>
              <td colspan=7><span class="pull-right"><?php
echo paginate($reload, $page, $total_pages, $adjacents);
        ?></span></td>
            </tr>
        </table>
           
            <input>Aviso!</histrong>
    </div>
    <?php
}
//Este else Fue agregado de Prueba de prodria Quitar
    else {
        ?>
    <div class="alert alert-warning alert-dismissible" role="alert" align="center">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Aviso!</strong> No hay Registro de Cotizaciones
  </div>
  <?php
}
// fin else
}
?>