<?php

/*-----------------------
Autor: Tony Plaza
----------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Archivo de funciones PHP
include "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Productos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q            = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $id_producto  = intval($_REQUEST['id_producto']); // ID del producto seleccionado
    $aColumns     = array('nombre'); // Columnas de búsqueda
    $sTable       = "combos";
    $sWhere       = "";

    // Construcción de la cláusula WHERE para la búsqueda por nombre
    if (!empty($q)) {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }

    // Añadir la búsqueda por ID de producto
    if ($id_producto != 0) {
        if (empty($sWhere)) {
            $sWhere = "WHERE id_producto_combo = $id_producto";
        } else {
            $sWhere .= " AND id_producto_combo = $id_producto";
        }
    }

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
    $reload      = '../html/productos.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    //echo $sql;
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>
        <div class="table-responsive" style="max-height: 620px; overflow:auto;">
            <table id="solicitudes" class="table table-sm table-striped">
                <tr class="info">
                    <th class='text-center'>ID</th>
                    <th class='text-center'>Nombre</th>
                    <th class='text-center'>Nombre Producto</th>
                    <th class='text-center'></th>
                    <th class='text-center'>Visualizar combo</th>
                    <th class='text-right'>Acciones</th>

                </tr>
                <?php
                if ($_SERVER['HTTP_HOST'] == 'localhost') {
                    $conexion_destino = new mysqli('localhost', 'root', '', 'master');
                } else {
                    $conexion_destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');
                }


                while ($row = mysqli_fetch_array($query)) {
                    $id_combo         = $row['id'];
                    $nombre_combo      = $row['nombre'];
                    $id_producto_combo_principal = $row['id_producto_combo'];

                    $nombre_producto_principal = get_row('productos', 'nombre_producto', 'id_producto', $id_producto_combo_principal);
                    if (empty($row['image_path'])) {
                        $image_path_principal = get_row('productos', 'image_path', 'id_producto', $id_producto_combo_principal);
                    } else {
                        $image_path_principal = $row['image_path'];
                    }
                ?>

                    <input type="hidden" value="<?php echo $nombre_combo; ?>" id="nombre_combo<?php echo $id_combo; ?>">

                    <tr class='text-center' data-id_combo="<?php echo $id_combo; ?>">
                        <td><span class="badge badge-purple"><?php echo $id_combo; ?></span>

                        </td>

                        <td class='text-center'><?php echo $nombre_combo; ?></td>


                        <td class='text-center'><?php echo $nombre_producto_principal; ?></td>

                        <td class='text-center'>
                            <?php
                            if ($image_path_principal == null) {
                                echo '<img src="../../img/productos/default.jpg" class="" width="60">';
                            } else {
                                echo '<img src="' . $image_path_principal . '" class="" width="60">';
                            }

                            ?>
                            <!--<img src="<?php echo $image_path_principal; ?>" alt="Product Image" class='rounded-circle' width="60">-->
                        </td>

                        <td class='text-center'>
                            <button type="button" class="btn btn-solucion" onclick="ajustarCombo(this);"><i class='bx bxs-shield-plus'></i> Ajustar Productos</button>
                        </td>
                        <!-- <td>
                            <a class="" href="#" data-toggle="modal" data-target="#editarProducto2" onclick="obtener_datos('<?php echo $id_producto; ?>');carga_img('<?php echo $id_producto; ?>');"> <img style="width: 40px" src="../../img/3342177.png" alt="" /></a>
                        </td> -->

                        <td>

                            <div class="btn-group dropdown pull-right">
                                <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php if ($permisos_ver == 1) { ?>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarCombo" onclick="obtener_datos('<?php echo $id_combo; ?>');carga_img('<?php echo $id_combo; ?>');"><i class='fa fa-edit'></i> Editar</a>
                                    <?php }
                                    if ($permisos_editar == 1) { ?>
                                        <!--<a class="dropdown-item" href="historial.php?id=<?php echo $id_combo; ?>"><i class='fa fa-calendar'></i> Historial</a>-->
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_combo; ?>"><i class='fa fa-trash'></i> Borrar</a>
                                    <?php }
                                    ?>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan=12><span class="pull-right">
                            <?php
                            echo paginate($reload, $page, $total_pages, $adjacents);
                            ?></span></td>
                </tr>
            </table>
        </div>
    <?php
    }
    //Este else Fue agregado de Prueba de prodria Quitar
    else {
    ?>
        <div class="alert alert-warning alert-dismissible" role="alert" align="center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Aviso!</strong> No hay Registro de Producto
        </div>
<?php
    }
    // fin else
}
?>