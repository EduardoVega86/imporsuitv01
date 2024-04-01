<?php
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

if (isset($conexion)) {
?>
    <div id="editarLinea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class='fa fa-edit'></i> Editar Item</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="editar_linea" name="editar_linea">
                        <div id="resultados_ajax2"></div>

                        <div class="form-group d-flex flex-column">
                            <input type="hidden" id="mod_id" name="mod_id">
                            <div class="d-flex flex-row">
                                <!-- contenido modal -->
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Titulo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control UpperCase" name="titulo_slider2" id="titulo_slider2" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Boton</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control UpperCase" name="texto_btn_slider2" id="texto_btn_slider2" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Enlace Boton</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="enlace_btn_slider2" id="enlace_btn_slider2" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <span class="help-block">Texto del slider </span>
                                    <textarea type="text" class="form-control " name="texto_slider2" id="texto_slider2" autocomplete="off"></textarea>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Alineacion</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="alineacion" id="alineacion">
                                                <option value="1">Izquierda </option>
                                                <option value="2">Centro </option>
                                                <option value="3">Derecha </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <div id='load_img4'>
                                        <?php
                                        $modId = $_POST['mod_id'];
                                        echo $modId;
                                        $query_empresa = mysqli_query($conexion, "select * from banner_adicional where id=$modId");
                                        $row           = mysqli_fetch_array($query_empresa);
                                        ?>
                                        <strong>BANNER HOME</strong>
                                        <img src="<?php echo $row['fondo_banner']; ?>" class="img-responsive" alt="profile-image" width="200px" height="200px">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" data-buttonText="Logo" type="file" name="imagefile4" id="imagefile4" onchange="upload_image_banner2();">
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