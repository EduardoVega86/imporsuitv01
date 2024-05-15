<?php
if (isset($conexion)) {
?>
    <div id="nuevoCombo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i> Nuevo Combo</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="guardar_combo" name="guardar_combo">
                        <div id="resultados_ajax"></div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info">

                                <div class="row ">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="nombre" class="control-label">Nombre:</label>
                                            <input type="text" class="form-control UpperCase" id="nombre" name="nombre" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="valor" class="control-label">valor:</label>
                                            <input type="text" class="form-control" id="valor" name="valor" autocomplete="off" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="12" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="table-responsive" style="max-height: 400px; overflow:auto;">
                                    <table id="solicitudes" class="table table-sm table-striped">
                                        <tr class="info">
                                            <th>ID producto</th>
                                            <th></th>
                                            <th>Nombre Producto</th>
                                            <th>Precio</th>

                                            <th class='text-right'>Mover</th>

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

                                        ?>

                                            <tr>

                                                <td><?php echo $id_producto; ?></td>

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
                                                <input type="checkbox" name="selected_product" value="<?php echo $id_producto; ?>" class="product-checkbox">
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


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="guardar_datos">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
    <script>
        function visualiza(valor) {
            //alert(valor) 
            // var selectElement = document.querySelector('select');
            var tabInventarioVariable = document.getElementById('tabInventarioVariable');
            //alert(selectElement.value);
            if (valor === '0') {
                tabInventarioVariable.style.display = 'block'; // o 'flex' si tu diseño lo requiere
            } else if (valor === '1') {
                tabInventarioVariable.style.display = 'none';
            }
        }
    </script>
<?php
}
?>