<?php
//include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../sysadmin/vistas/db.php";
require_once "../sysadmin/vistas/php_conexion.php";
//Archivo de funciones PHP
require_once "../sysadmin/vistas/funciones.php";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['cantidad'])) {
    $cantidad = $_POST['cantidad'];
}
if (isset($_POST['precio_venta'])) {
    $precio_venta = $_POST['precio_venta'];
}
if (isset($_POST['descripcion_libre'])) {
    $descripcion_libre = $_POST['descripcion_libre'];
}
if (isset($_POST['valor_cantidad'])) {
    $valor_cantidad = $_POST['valor_cantidad'];
} else {
    $valor_cantidad = 1;
}
$estado_oferta = isset($_POST['estado_oferta']) ? $_POST['estado_oferta'] : 0;
$session_id = $_POST['sesion'];
//echo $descripcion_libre;
if ($estado_oferta == 1) {
    $sql3 = "select * from productos where id_linea_producto = 1000 ";
    $query3 = mysqli_query($conexion, $sql3);

    while ($row = mysqli_fetch_array($query3)) {
        $id_producto_oferta = $row["id_producto"];
        $nombre_producto_oferta = $row["nombre_producto"];
        $costo_producto_oferta = $row["costo_producto"];
        $drogshipin_oferta_tmp = $row["drogshipin"];
        $insert_tmp = mysqli_query($conexion, "INSERT INTO tmp_ventas (id_producto,cantidad_tmp,precio_tmp,desc_tmp,session_id, drogshipin_tmp) VALUES ('$id_producto_oferta',1,'$costo_producto_oferta','0','$session_id','$drogshipin_oferta_tmp')");
    }
} else {
    $sql3 = "SELECT * FROM productos WHERE id_linea_producto = 1000";
    $query3 = mysqli_query($conexion, $sql3);

    while ($row = mysqli_fetch_array($query3)) {
        $id_producto_oferta = $row["id_producto"];
        $query_eliminar = mysqli_query($conexion, "SELECT id_tmp FROM tmp_ventas WHERE id_producto = '$id_producto_oferta'");

        if ($row_eliminar = mysqli_fetch_array($query_eliminar)) {
            $id_tmp_eliminar = $row_eliminar["id_tmp"];
            $delete = mysqli_query($conexion, "DELETE FROM tmp_ventas WHERE id_tmp = '$id_tmp_eliminar'");
        }
    }
}
if (!empty($id) and !empty($cantidad) and !empty($precio_venta)) {
    // consulta para comparar el stock con la cantidad resibida
    $query = mysqli_query($conexion, "select stock_producto, drogshipin, inv_producto from productos where id_producto = '$id'");
    $rw    = mysqli_fetch_array($query);
    $stock = $rw['stock_producto'];
    $inv   = $rw['inv_producto'];
    $drogshipin_tmp   = $rw['drogshipin'];
    $session_id = $_POST['sesion'];
    //Comprobamos si agregamos un producto a la tabla tmp_compra
    $comprobar = mysqli_query($conexion, "select * from tmp_ventas, productos where productos.id_producto = tmp_ventas.id_producto and tmp_ventas.id_producto='" . $id . "' and tmp_ventas.session_id='" . $session_id . "'");
    if ($row = mysqli_fetch_array($comprobar)) {
        if ($valor_cantidad == 1) {
            $cant = $row['cantidad_tmp'] + 1;
        } else {
            $cant = $row['cantidad_tmp'] - 1;
        }

        // condicion si el stock e menor que la cantidad requerida
        if ($cant > $row['stock_producto'] and $inv == 0) {
            echo "<script>Swal.fire('LA CATIDAD SUPERA AL STOCK', 'INTENTAR NUEVAMENTE', 'error')
            ;
            </script>";
        } else {
            $sql          = "UPDATE tmp_ventas SET cantidad_tmp='" . $cant . "', precio_tmp='" . $precio_venta . "' WHERE id_producto='" . $id . "' and session_id='" . $session_id . "'";
            $query_update = mysqli_query($conexion, $sql);
            //echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
        }
        // fin codicion cantaidad

    } else {
        // condicion si el stock e menor que la cantidad requerida
        if ($cantidad > $stock and $inv == 0) {
            echo "<script>Swal.fire('LA CATIDAD SUPERA AL STOCK', 'INTENTAR NUEVAMENTE', 'error')
             ;
            </script>";
        } else {
            //echo "INSERT INTO tmp_ventas (id_producto,cantidad_tmp,precio_tmp,desc_tmp,session_id, drogshipin_tmp) VALUES ('$id','$cantidad','$precio_venta','0','$session_id','$drogshipin_tmp')";
            $insert_tmp = mysqli_query($conexion, "INSERT INTO tmp_ventas (id_producto,cantidad_tmp,precio_tmp,desc_tmp,session_id, drogshipin_tmp) VALUES ('$id','$cantidad','$precio_venta','0','$session_id','$drogshipin_tmp')");
            // echo "<script> $.Notification.notify('success','bottom center','NOTIFICACIÓN', 'PRODUCTO AGREGADO A LA FACTURA CORRECTAMENTE')</script>";
        }
        // fin codicion cantaidad
    }
}


if (isset($_GET['id'])) //codigo elimina un elemento del array
{
    $id_tmp = intval($_GET['id']);
    $delete = mysqli_query($conexion, "DELETE FROM tmp_ventas WHERE id_tmp='" . $id_tmp . "'");
}
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
?>


<div class="_rsi-modal-line-items">
    <?php
    $impuesto       = get_row('perfil', 'impuesto', 'id_perfil', 1);
    $nom_impuesto   = get_row('perfil', 'nom_impuesto', 'id_perfil', 1);
    $sumador_total  = 0;
    $total_iva      = 0;
    $total_impuesto = 0;
    $subtotal       = 0;
    $sql            = mysqli_query($conexion, "select * from productos, tmp_ventas where productos.id_producto=tmp_ventas.id_producto and tmp_ventas.session_id='" . $session_id . "'");
    $cantidad_total = 0;

    while ($row = mysqli_fetch_array($sql)) {
        if ($row['id_linea_producto'] == 1000) {
            continue; // Salta a la siguiente iteración del bucle si el id_linea_producto es 1000
        }

        $id_tmp          = $row["id_tmp"];
        $codigo_producto = $row['codigo_producto'];
        $id_producto     = $row['id_producto'];
        $cantidad        = $row['cantidad_tmp'];
        $desc_tmp        = $row['desc_tmp'];
        $nombre_producto = $row['nombre_producto'];
        $precio = $row['valor3_producto'];
        $image_path           = $row['image_path'];
        $precio_venta   = $row['precio_tmp'];
        $precio_venta_unitario = $precio_venta;
        $precio_venta_f = number_format($precio_venta, 2); //Formateo variables
        $precio_venta_r = str_replace(",", "", $precio_venta_f); //Reemplazo las comas
        $precio_total   = $precio_venta_r * $cantidad;
        $final_items    = rebajas($precio_total, $desc_tmp); //Aplicando el descuento
        /*--------------------------------------------------------------------------------*/
        $impuesto = get_row('perfil', 'impuesto', 'id_perfil', 1);
        $valor = ($impuesto / 100) + 1;
        $precio_venta = $final_items;
        $precio_venta_f = $precio_venta; //Formateo variable
        $precio_venta_r1 = str_replace(",", "", $precio_venta_f); //Reemplazo las comas  
        //PRECIO DESGLOSADO
        $precio_venta_desglosado = $precio_venta_r1 / $valor;
        $impuesto_unitario = $precio_venta_f - $precio_venta_desglosado;
        /*--------*/
        $precio_total_f = number_format($final_items, 2); //Precio total formateado
        $precio_total_r = str_replace(",", "", $precio_total_f); //Reemplazo las comas
        $sumador_total += $precio_venta_desglosado; //Sumador
        $final_items = rebajas($precio_total, $desc_tmp); //Aplicando el descuento
        $subtotal    = number_format($sumador_total, 2, '.', '');
        /*  if ($row['iva_producto'] == 1) {
        $total_iva = $impuesto_unitario;
    } else {
        $total_iva = iva($precio_venta_desglosado);
    }*/
        //$total_impuesto += rebajas($subtotal, $desc_tmp) * $cantidad;
        $total_impuesto = $total_impuesto + $impuesto_unitario;
        $cantidad_total = $cantidad_total + $cantidad;
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
        //echo $total_impuesto.'<br>';
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
                transition: background-color 0.3s, color 0.3s;
            }

            .product-box:hover {
                background-color: lightblue;
                color: black;
            }

            .product-box.selected {
                background-color: lightblue;
                color: black;
                border: 2px solid black;
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
        <div class="_rsi-modal-line-item" data-line-item-variant-id="45622098493721">
            <div class="_rsi-modal-line-item-image-container">
                <!-- <div class="product-box"> -->
                <div>
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 20%">
                                <img style="width: 67px" src="
                             
                              <?php
                                $subcadena = "http";

                                if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
                                ?>
                               <?php echo  $image_path . '"'; ?>
                               <?php
                                } else {
                                ?>
                               sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" <?php
                                                                                            }
                                                                                                ?> class="_rsi-modal-line-item-image">
                            </td>
                            <td style="width: 10%">
                                <div class="input-group">
                                    <?php
                                    if (!isset($_POST['descuento_porcentaje'])) {
                                    ?>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-incrementar" data-id="<?php echo $id_producto; ?>">+</button>
                                        </span>

                                    <?php } ?>
                                    <style>
                                        .input-cantidad {
                                            background-color: transparent;
                                            /* Hace el fondo transparente */
                                            border: none;
                                            /* Remueve el borde */
                                            color: black;
                                            /* Establece el color del texto */
                                            outline: none;
                                            /* Remueve el resaltado al enfocar */
                                            pointer-events: none;
                                            /* Evita que el usuario interactúe con el campo */
                                        }
                                    </style>
                                    <input type="text" name="cantidad[<?php echo $id_producto; ?>]" class="form-control input-cantidad" value="<?php echo $cantidad; ?>" data-id="<?php echo $id_producto; ?>" data-precio="<?php echo $precio_venta_unitario; ?>">
                                    <?php
                                    if (!isset($_POST['descuento_porcentaje'])) {
                                    ?>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-decrementar" data-id="<?php echo $id_producto; ?>">-</button>
                                        </span>
                                    <?php } ?>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        function actualizarCantidad(id, cantidad, valor_cantidad) {
                                            var precio = $("input[name='cantidad[" + id + "]']").data('precio');
                                            var sesion = $("#session").val();
                                            // Realizar petición AJAX para actualizar cantidad
                                            $.ajax({
                                                url: 'ajax/agregar_tmp_modalventas_1.php',
                                                method: 'POST',
                                                data: {
                                                    id: id,
                                                    cantidad: cantidad,
                                                    precio_venta: precio,
                                                    sesion: sesion,
                                                    valor_cantidad
                                                },
                                                success: function(response) {
                                                    $("#resultados").html(response);
                                                    // Actualizar también los totales aquí si es necesario
                                                },
                                                error: function(error) {
                                                    console.error(error);
                                                }
                                            });
                                        }

                                        // Asignación de eventos para botones de incrementar y decrementar
                                        $('.btn-decrementar').click(function() {
                                            var id = $(this).data('id');
                                            var inputCantidad = $("input[name='cantidad[" + id + "]']");
                                            var cantidadActual = parseInt(inputCantidad.val());
                                            if (cantidadActual > 1) {
                                                actualizarCantidad(id, cantidadActual - 1, 2);
                                                inputCantidad.val(cantidadActual - 1);
                                            }
                                        });

                                        $('.btn-incrementar').click(function() {
                                            var id = $(this).data('id');
                                            var inputCantidad = $("input[name='cantidad[" + id + "]']");
                                            var cantidadActual = parseInt(inputCantidad.val());
                                            actualizarCantidad(id, cantidadActual + 1, 1);
                                            inputCantidad.val(cantidadActual + 1);
                                        });
                                    });
                                </script>
                            </td>
                            <td style="width: 50%">
                                <div class="_rsi-modal-line-item-info">
                                    <a class="_rsi-modal-line-item-title" href="/products/aquapure?variant=45622098493721" style="font-size: 15px;"><?php echo $nombre_producto; ?></a>
                                </div>
                            </td>
                            <td style="width: 10%">
                                <div class="_rsi-modal-line-item-final-price"><?php echo $simbolo_moneda . number_format($final_items, 2); ?></div>
                            </td>
                            <td style="width: 10%">
                                <?php
                                if (isset($_POST['descuento_porcentaje'])) {
                                    $descuento_porcentaje = $_POST['descuento_porcentaje'];
                                    $identificado_combo = 1;
                                ?>
                                    <input type="hidden" id="id_tmp" value="<?php echo $id_tmp ?>">
                                    <input type="hidden" id="estado_oferta" value="<?php echo $estado_oferta ?>">
                                    <input type="hidden" id="identificado_combo" value="<?php echo $identificado_combo ?>">
                                    <a href="#" class='btn btn-danger btn-sm waves-effect waves-light' onclick="eliminar_combo('<?php echo $id_tmp ?>', '<?php echo $estado_oferta ?>', '<?php echo $identificado_combo ?>')">x</a>
                                <?php } else { ?>
                                    <a href="#" class='btn btn-danger btn-sm waves-effect waves-light' onclick="eliminar('<?php echo $id_tmp ?>', '<?php echo $estado_oferta ?>')">x</a>
                                <?php } ?>
                        <tr>
                    </table>
                </div> <br>

                <?php

                $sql_count   = "SELECT * FROM tmp_ventas WHERE session_id = '" . $session_id . "'";
                //echo $sql_count;
                $query_count = mysqli_query($conexion, $sql_count);
                if (mysqli_num_rows($query_count) == 1) {

                    $sql_combos   = "SELECT * FROM  combos WHERE id_producto_combo= $id_producto";
                    //echo $sql_combo;
                    $query_combos = mysqli_query($conexion, $sql_combos);

                    while ($row_combos = mysqli_fetch_array($query_combos)) {
                        $id_combo = $row_combos['id'];

                        $sql2   = "SELECT * FROM  detalle_combo WHERE id_combo= $id_combo";
                        //echo $sql2;
                        $query2 = mysqli_query($conexion, $sql2);
                        $suma_total_precio = 0;
                        $precio_total_cantidad = 0;
                        while ($row2 = mysqli_fetch_array($query2)) {
                            $id_detalle_combo         = $row2['id'];
                            $id_producto_combo         = $row2['id_producto'];
                            $nombre_producto_combo = get_row('productos', 'nombre_producto', 'id_producto', $id_producto_combo);
                            $image_path_combo = get_row('productos', 'image_path', 'id_producto', $id_producto_combo);
                            $precio_especial_combo = get_row('productos', 'valor1_producto', 'id_producto', $id_producto_combo);
                            $cantidad_combo      = $row2['cantidad'];


                            $precio_total_cantidad = $precio_especial_combo * $cantidad_combo;
                            $suma_total_precio = $suma_total_precio + $precio_total_cantidad;
                        }
                        $estado_combo_principal = get_row('combos', 'estado_combo', 'id', $id_combo);
                        $imagen_principal = get_row('combos', 'image_path', 'id', $id_combo);
                        $nombre_combo_principal = get_row('combos', 'nombre', 'id', $id_combo);
                        $valor_combo_principal = get_row('combos', 'valor', 'id', $id_combo);

                ?>

                        <!-- <div class="product-box" id="product_<?php echo $id_detalle_combo; ?>" data-id="<?php echo $id_detalle_combo; ?>" onclick="seleccionarProducto('<?php echo $id_detalle_combo; ?>')"> -->
                        <div class="product-box" id="product_<?php echo htmlspecialchars($id_detalle_combo); ?>" data-id="<?php echo htmlspecialchars($id_detalle_combo); ?>" onclick="seleccionarProducto('<?php echo htmlspecialchars($id_detalle_combo); ?>', '<?php echo htmlspecialchars($id_combo); ?>', '<?php echo htmlspecialchars($session_id); ?>')">
                            <?php
                            if ($estado_combo_principal == 1) {
                            ?>

                                <div style="padding-right: 20px;">
                                    <?php
                                    if ($imagen_principal == null) {
                                        $imagen_principal = get_row('productos', 'image_path', 'id_producto', $id_producto);
                                    }

                                    echo '<img src="';
                                    $subcadena = "http";
                                    if (strpos(strtolower($imagen_principal), strtolower($subcadena)) === 0) {
                                        echo $imagen_principal . '"';
                                    } else {
                                        echo 'sysadmin/' . str_replace("../..", "", $imagen_principal) . '"';
                                    }
                                    echo ' width="60">';
                                    ?>
                                </div>
                                <div class="product-details">
                                    <div class="d-flex flex-column">
                                        <div><?php echo $nombre_combo_principal; ?></div>
                                        <div class="product-discount" style="width: 115px;">Ahorra <?php echo $valor_combo_principal; ?>%</div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="product-old-price">$ <?php echo number_format($suma_total_precio, 2); ?></span>
                                        <?php
                                        $precio_total = $suma_total_precio * (1 - ($valor_combo_principal / 100));
                                        ?>
                                        <span class="product-price">$<?php echo number_format($precio_total, 2); ?></span>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div style="padding-right: 20px;">
                                    <?php
                                    if ($imagen_principal == null) {
                                        $imagen_principal = get_row('productos', 'image_path', 'id_producto', $id_producto);
                                    }

                                    echo '<img src="';
                                    $subcadena = "http";
                                    if (strpos(strtolower($imagen_principal), strtolower($subcadena)) === 0) {
                                        echo $imagen_principal . '"';
                                    } else {
                                        echo 'sysadmin/' . str_replace("../..", "", $imagen_principal) . '"';
                                    }
                                    echo ' width="60">';
                                    ?>
                                </div>
                                <div class="product-details">
                                    <div class="d-flex flex-column">
                                        <div><?php echo $nombre_combo_principal; ?></div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="product-old-price">$ <?php echo number_format($suma_total_precio, 2); ?></span>
                                        <?php
                                        $precio_total = $suma_total_precio - $valor_combo_principal;
                                        ?>
                                        <span class="product-price">$<?php echo number_format($precio_total, 2); ?></span>
                                    </div>

                                </div>

                            <?php
                            }
                            ?>
                        </div> <br>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    <?php
    }
    $total_factura = $subtotal + $total_impuesto;

    $subtotal = $total_factura;

    ?>

    <div class="_rsi-build-block _rsi-build-block-totals-summary">
        <div style="background-color: #e8ecef; padding: 10px; border-radius: 0.3rem;" class="_rsi-modal-checkout-lines">
            <table style="width: 100%">

                <?php
                if ($estado_oferta == 1) {
                    $sql3 = "select * from productos where id_linea_producto = 1000 ";
                    $query3 = mysqli_query($conexion, $sql3);

                    while ($row = mysqli_fetch_array($query3)) {
                        $id_producto_oferta = $row["id_producto"];
                        $nombre_producto_oferta = $row["nombre_producto"];
                        $costo_producto_oferta = $row["costo_producto"];
                        $drogshipin_oferta_tmp = $row["drogshipin"];

                        $total_factura = $total_factura + $costo_producto_oferta;
                ?>
                        <div class="" data-checkout-line="subtotal">
                            <span style="text-align: left" class=""><?php echo $nombre_producto_oferta; ?></span>
                            <span style="float: right" class=""><?php echo $simbolo_moneda . number_format($costo_producto_oferta, 2); ?></span>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="" data-checkout-line="subtotal">
                    <span style="text-align: left" class="">Subtotal</span>
                    <span style="float: right" class="" id="precio_subtotal"><?php echo $simbolo_moneda . number_format($subtotal, 2); ?></span>
                </div>

                <?php
                if (isset($_POST['descuento_porcentaje'])) {
                    $descuento_porcentaje = $_POST['descuento_porcentaje'];
                    $suma_total_precio = $_POST['suma_total_precio'];
                    
                    $descuento = $suma_total_precio * ($descuento_porcentaje / 100);
                ?>
                    <div class="_rsi-modal-checkout-line" data-checkout-line="shipping">
                        <span class="_rsi-modal-checkout-line-title" style="color: #28C839;">Descuento</span>
                        <strong style="float: right; color: #28C839;"><?php echo $simbolo_moneda . number_format($descuento, 2); ?></strong>
                    </div>
                <?php } ?>

                <hr>
                <div class="" data-checkout-line="total" data-order-total="2999" data-partial-total-for-checkout="2999">
                    <strong class="">Total</strong><strong style="float: right" id="precio_total" class=""><?php echo $simbolo_moneda . number_format($total_factura, 2); ?></strong>
                </div>
            </table>
        </div>
    </div>
</div>



<script></script>
<script>
    //alert()

    $("#total_carrito").text(<?php echo $cantidad_total; ?>)

    function seleccionarProducto(id_detalle_combo, id_combo, session_id) {
        $.ajax({
            url: 'ajax/actualizar_factura.php',
            type: 'POST',
            data: {
                id_detalle_combo: id_detalle_combo,
                id_combo: id_combo,
                session_id: session_id
            },
            success: function(response) {
                // Reemplazar el contenido del div correspondiente con la respuesta del servidor
                //$('#product_' + id_detalle_combo).html(response);

                // Deseleccionar todos los elementos antes de seleccionar el actual
                $(".product-box").removeClass('selected');

                let data = JSON.parse(response);
                // Seleccionar el producto actual
                $('#product_' + id_detalle_combo).addClass('selected');

                let precioTotal = Number(data.precio_total)

                $('#precio_total').text('$' + precioTotal.toFixed(2));

                $('#precio_subtotal').text('$' + precioTotal.toFixed(2));

                for (let i = 0; i < data.productos.length; i++) {
                    agregar_combo_tmp(data.productos[i], data.descuento_porcentaje, data.session_id, data.suma_total_precio);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus, errorThrown);
            }
        });
    }
    $(document).ready(function() {
    $('#exampleModal').on('hidden.bs.modal', function() {
        const idTmp = $('#id_tmp').val();
        const estadoOferta = $('#estado_oferta').val();
        const identificadoCombo = $('#identificado_combo').val();
        if (identificadoCombo == 1) { 
            eliminar_combo(idTmp, estadoOferta, identificadoCombo);
        }
    });
});
</script>