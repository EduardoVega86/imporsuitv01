<?php
/*-----------------------
Autor: Tony Plaza
----------------------------*/
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

$sql_combo_principal = "SELECT * FROM combos WHERE id = $id_combo";
//echo $sql_combo_principal;
$query_combo_principal = mysqli_query($conexion, $sql_combo_principal);
$row_combo_principal = mysqli_fetch_array($query_combo_principal);

$estado_combo_principal = $row_combo_principal['estado_combo'];
$valor_principal = $row_combo_principal['valor'];
?>

<style>
    .caja_combo {
        padding: 20px;
        border-radius: 25px;
        -webkit-box-shadow: -2px 5px 5px 0px rgba(0, 0, 0, 0.23);
        -moz-box-shadow: -2px 2px 5px 0px rgba(0, 0, 0, 0.23);
        box-shadow: -2px 2px 5px 0px rgba(0, 0, 0, 0.23);
        background-color: white;
    }

    .title_combo {
        font-size: 20px;
        color: black;
        text-align: center;
        margin-bottom: 20px;
    }

    .price_combo {
        font-size: 18px;
        color: blue;
        float: right;
    }

    .discount_combo {
        color: green;
    }

    .subtotal_combo {
        text-align: left;
        margin-top: 10px;
    }

    .total_combo {
        font-weight: bold;
        text-align: left;
    }

    .product-box {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px;
        display: flex;
        align-items: center;
    }

    .product-image {
        width: 50px;
        height: 50px;
        margin-right: 15px;
    }

    .product-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .product-price {
        font-size: 24px;
        color: #000;
        font-weight: bold;
    }

    .product-old-price {
        text-decoration: line-through;
        color: #999;
        margin-right: 10px;
    }

    .product-discount {
        margin-top: 10px;
        color: white;
        background-color: #007bff;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .align-end {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .caja_variable {
        padding: 10px;
        border-radius: 0.5rem;
        background-color: #dedbdb;
    }
</style>
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
                        $precio_especial = $row['valor1_producto'];

                        $sql = "SELECT * FROM productos WHERE id_linea_producto != 1000";
                        //echo $sql;

                        // Consulta para verificar si el producto ya está en detalle_combo
                        $sql_check = "SELECT 1 FROM detalle_combo WHERE id_producto = '$id_producto' AND id_combo = '$id_combo'";
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

                            <td class='text-center'><span><?php echo $simbolo_moneda . '' . number_format($precio_especial, 2); ?></span></td>

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
                        <th style="text-align: center">Precio</th>
                        <th style="text-align: center" colspan="1">Cantidad</th>

                        <th class='text-right'>Mover</th>

                    </tr>
                    <?php
                    if ($_SERVER['HTTP_HOST'] == 'localhost') {
                        $conexion_destino = new mysqli('localhost', 'root', '', 'master');
                    } else {
                        $conexion_destino = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');
                    }

                    $suma_total_precio = 0;
                    //main query to fetch the data
                    $sql   = "SELECT * FROM  detalle_combo WHERE id_combo= $id_combo";
                    //echo $sql;
                    $query = mysqli_query($conexion, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        $id_detalle_combo         = $row['id'];
                        $id_producto_combo         = $row['id_producto'];
                        $nombre_producto_combo = get_row('productos', 'nombre_producto', 'id_producto', $id_producto_combo);
                        $image_path_combo = get_row('productos', 'image_path', 'id_producto', $id_producto_combo);
                        $precio_especial_combo = get_row('productos', 'valor1_producto', 'id_producto', $id_producto_combo);
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

                            </td>

                            <td><?php echo $nombre_producto_combo; ?></td>

                            <td class='text-center'><span><?php echo $simbolo_moneda . '' . number_format($precio_especial_combo, 2); ?></span></td>
                            <?php
                            $precio_total_cantidad = $precio_especial_combo * $cantidad_combo;
                            $suma_total_precio = $suma_total_precio + $precio_total_cantidad;
                            ?>

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
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row">
                        <div class="col-sm-4">
                            <label for="valor_combo" class="control-label">Tipo de descuento</label>
                            <select class="form-control" name="estado_combo" id="estado_combo">
                                <option value="1" <?php echo $estado_combo_principal == '1' ? 'selected' : ''; ?>>Porcentaje</option>
                                <option value="2" <?php echo $estado_combo_principal == '2' ? 'selected' : ''; ?>>Valor fijo</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="valor_combo" class="control-label">valor del descuento:</label>
                                <input type="text" class="form-control UpperCase" id="valor_combo" name="valor_combo" autocomplete="off" value="<?php echo $valor_principal; ?>">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>

                <br>
                <?php
                $sql_principal   = "SELECT * FROM  combos WHERE id= $id_combo";
                //echo $sql;
                $query_principal = mysqli_query($conexion, $sql_principal);
                $row_principal = mysqli_fetch_array($query_principal);
                $estado_combo_principal         = $row_principal['estado_combo'];
                $nombre_combo_principal         = $row_principal['nombre'];
                $valor_combo_principal         = $row_principal['valor'];
                $id_producto_combo_principal = $row_principal['id_producto_combo'];
                if (empty($row_principal['image_path'])){
                $imagen_principal = get_row('productos', 'image_path', 'id_producto', $id_producto_combo_principal);
                }else{
                    $imagen_principal =  $row_principal['image_path'];
                }
                ?>

                <div class="container" style="padding-top: 10px; padding-bottom: 10px;">
                    <div class="caja_combo">
                        <div class="title_combo"><strong>PAGA AL RECIBIR EN CASA! POCAS UNIDADES</strong></div>
                        <div class="product-box">
                            <?php
                            if ($estado_combo_principal == 1) {
                            ?>
                                <div style="padding-right: 20px;">
                                    <?php
                                    if ($imagen_principal == null) {
                                        echo '<img src="../../img/productos/default.jpg" class="" width="60">';
                                    } else {
                                        echo '<img src="' . $imagen_principal . '" class="" width="60">';
                                    }
                                    ?>
                                </div>
                                <div class="product-details">
                                    <div class="d-flex flex-column">
                                        <div><?php echo $nombre_combo_principal; ?></div>
                                        <div class="product-discount" style="width: 115px;">Ahorra <?php echo $valor_combo_principal; ?>%</div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="product-old-price">$ <?php echo $suma_total_precio; ?></span>
                                        <?php
                                        $precio_total = $suma_total_precio * (1 - ($valor_combo_principal / 100));
                                        ?>
                                        <span class="product-price">$<?php echo $precio_total; ?></span>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div style="padding-right: 20px;">
                                    <?php
                                    if ($imagen_principal == null) {
                                        echo '<img src="../../img/productos/default.jpg" class="" width="60">';
                                    } else {
                                        echo '<img src="' . $imagen_principal . '" class="" width="60">';
                                    }
                                    ?>
                                </div>
                                <div class="product-details">
                                    <div class="d-flex flex-column">
                                        <div><?php echo $nombre_combo_principal; ?></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="product-old-price">$ <?php echo $suma_total_precio; ?></span>
                                        <?php
                                        $precio_total = $suma_total_precio - $valor_combo_principal;
                                        ?>
                                        <span class="product-price">$<?php echo $precio_total; ?></span>
                                    </div>

                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <br>
                        <div class="caja_variable">
                            <div class="subtotal_combo">Subtotal <span class="price_combo">$<?php echo $precio_total; ?></span></div>
                            <div class="subtotal_combo">Envío <span class="price_combo">Gratis</span></div>
                            <div class="total_combo">Total <span class="price_combo">$<?php echo $precio_total; ?></span></div>
                        </div>
                    </div>
                </div>
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

        $(document).ready(function() {
            $('#btnGuardar').click(function() {
                var valorCombo = $('#valor_combo').val(); // Obtener el valor del input de combo
                var idCombo = $('#id_combo').val(); // Obtener el valor del input de combo
                var estadoCombo = $('#estado_combo').val(); // Obtener el valor del select del tipo de descuento

                $.ajax({
                    type: "POST",
                    url: "../ajax/nuevo_combo.php", // Ruta al script PHP que procesará los datos
                    data: {
                        valor_combo: valorCombo, // Añadir el valor del combo al objeto de datos
                        id_combo: idCombo, // Añadir el valor del combo al objeto de datos
                        estado_combo: estadoCombo // Añadir el tipo de descuento al objeto de datos
                    },
                    success: function(data) {
                        $("#outer_div_detalle_combo").load(
                            "../ajax/carga_detalle_combo.php?id_combo=" + idCombo,
                            function(response, status, xhr) {
                                if (status == "error") {
                                    console.error("Error: " + xhr.status + " " + xhr.statusText);
                                } else {
                                    // alert("Producto agregado correctamente!");
                                }
                            }
                        );
                    },
                    error: function() {
                        alert('Error al guardar el valor.');
                    }
                });
            });
        });

    });
</script>