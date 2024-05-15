<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/

/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Productos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$id_combo    = intval($_REQUEST['id_combo']);
$_SESSION['id'] = $id_combo;
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>

<div class="d-flex flex-row">
    <div>
        <div class="col-lg-12 col-md-6">
            <input type="hidden" id="id_combo" name="id_combo" value="<?php echo $id_combo; ?>">
            <h3>Asiganacion de producto</h3>
            <div class="table-responsive" style="max-height: 620px; overflow:auto;">
                <table id="solicitudes" class="table table-sm table-striped">
                    <tr class="info">
                        <th style="text-align: center">ID producto</th>
                        <th></th>
                        <th>Nombre Producto</th>
                        <th>Precio</th>
                        <th style="text-align: center">Cantidad</th>
                        <th>Mover</th>

                    </tr>
                    <?php
                    if ($_SERVER['HTTP_HOST'] == 'localhost') {
                        $conexion_destino = new mysqli('localhost', 'root', '', 'master');
                    } else {
                        $conexion_destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');
                    }

                    //main query to fetch the data

                    $sql = "SELECT * FROM productos WHERE id_linea_producto != 1000";
                    //echo $sql;
                    $query = mysqli_query($conexion, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        $id_producto         = $row['id_producto'];
                        $nombre_producto = $row['nombre_producto'];
                        $image_path = $row['image_path'];
                        $costo_producto = $row['costo_producto'];

                        $sql = "SELECT * FROM productos WHERE id_linea_producto != 1000";
                        //echo $sql;

                        // Consulta para verificar si el producto ya está en detalle_combo
                        $sql_check = "SELECT 1 FROM detalle_combo WHERE id_producto = '$id_producto'";
                        $query_check = mysqli_query($conexion, $sql_check);
                        if (mysqli_fetch_array($query_check)) {
                            // Si encuentra el producto en detalle_combo, salta al siguiente producto
                            continue;
                        }
                    ?>

                        <tr>

                            <td style="text-align: center"><?php echo $row['id_producto']; ?></td>

                            <td class='text-center'>
                                <?php
                                if ($image_path == null) {
                                    echo '<img src="../../img/productos/default.jpg" class="" width="60">';
                                } else {
                                    echo '<img src="' . $image_path . '" class="" width="60">';
                                }

                                ?>
                                <!--<img src="<?php echo $image_path; ?>" alt="Product Image" class='rounded-circle' width="60">-->
                            </td>

                            <td class="text-wrap" style="max-width: 50px;"><?php echo $nombre_producto; ?></td>

                            <td class='text-center'><span><?php echo $simbolo_moneda . '' . number_format($costo_producto, 2); ?></span></td>

                            <td>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary decrement-btn" type="button">-</button>
                                    <input type="text" id="cantidad_producto" class="form-control text-center quantity-input" style="max-width: 50px !important;" value="1" min="1">
                                    <button class="btn btn-outline-secondary increment-btn" type="button">+</button>
                                </div>
                            </td>

                            <td>
                                <button class="btn btn-primary" onclick="agregarProducto(<?php echo $row['id_producto']; ?>, this)">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </td>

                            <td>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div>
        <div class="panel panel-color panel-info">
            <h3>Detalle de Combo</h3>
            <div class="table-responsive" style="max-height: 620px; overflow:auto;">
                <table id="solicitudes" class="table table-sm table-striped">
                    <tr class="info">
                        <th>ID</th>
                        <th style="text-align: center">ID producto</th>
                        <th></th>
                        <th style="text-align: center">Nombre Producto</th>
                        <th style="text-align: center" colspan="1">Cantidad</th>

                        <th class='text-right'>Mover</th>

                    </tr>
                    <?php
                    if ($_SERVER['HTTP_HOST'] == 'localhost') {
                        $conexion_destino = new mysqli('localhost', 'root', '', 'master');
                    } else {
                        $conexion_destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');
                    }

                    //main query to fetch the data
                    $sql   = "SELECT * FROM  detalle_combo WHERE id_combo= $id_combo";
                    //echo $sql;
                    $query = mysqli_query($conexion, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        $id_detalle_combo         = $row['id'];
                        $id_producto_combo         = $row['id_producto'];
                        $nombre_producto_combo = get_row('productos', 'nombre_producto', 'id_producto', $id_producto_combo);
                        $image_path_combo = get_row('productos', 'image_path', 'id_producto', $id_producto_combo);
                        $cantidad_combo      = $row['cantidad'];

                    ?>

                        <tr>
                            <td><span class="badge badge-purple"><?php echo $id_detalle_combo; ?></span>

                            </td>

                            <td style="text-align: center"><?php echo $id_producto_combo; ?></td>

                            <td class='text-center'>
                                <?php
                                if ($image_path_combo == null) {
                                    echo '<img src="../../img/productos/default.jpg" class="" width="60">';
                                } else {
                                    echo '<img src="' . $image_path_combo . '" class="" width="60">';
                                }

                                ?>
                                <!--<img src="<?php echo $image_path_combo; ?>" alt="Product Image" class='rounded-circle' width="60">-->
                            </td>

                            <td><?php echo $nombre_producto_combo; ?></td>

                            <td style="text-align: center"><?php echo $cantidad_combo; ?></td>

                            <td>
                                <button class="btn btn-primary" onclick="eliminarProducto(<?php echo $row['id']; ?>, this)">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    $(document).ready(function() {
        $('.increment-btn').click(function(e) {
            e.preventDefault();
            var inc_value = $(this).closest('.input-group').find('.quantity-input');
            var current_val = parseInt(inc_value.val(), 10);
            inc_value.val(current_val + 1);
        });

        $('.decrement-btn').click(function(e) {
            e.preventDefault();
            var dec_value = $(this).closest('.input-group').find('.quantity-input');
            var current_val = parseInt(dec_value.val(), 10);
            if (current_val > 1) {
                dec_value.val(current_val - 1);
            }
        });
    });
</script>