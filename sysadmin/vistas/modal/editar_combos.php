<?php
if (isset($conexion)) {
?>
    <div id="editarCombo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i> Editar Producto</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="editar_producto1" name="editar_producto1">
                        <div id="resultados_ajax2"></div>


                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="mod_info">

                                <div class="row ">
                                    <input id="mod_id_combo" name="mod_id_combo" type='hidden'>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="mod_nombre_combo" class="control-label">Nombre:</label>
                                            <input type="text" class="form-control UpperCase" id="mod_nombre_combo" name="mod_nombre_combo" autocomplete="off" required>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="actualizar_datos">Actualizar</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
<?php
}
?>