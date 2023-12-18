<?php
if (isset($conexion)) {
    ?>
	<div id="editarProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"><i class='fa fa-edit'></i> Información Técnica</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
						<div id="resultados_ajax2"></div>

						<ul class="nav nav-tabs">
							
							
<!--							<li class="nav-item">
								<a href="#img2" data-toggle="tab" aria-expanded="true" class="nav-link">
									Imagen
								</a>
							</li>
                                                        <li class="nav-item">
								<a href="#imagenes" data-toggle="tab" aria-expanded="true" class="nav-link">
									Imagenes Adicionales
								</a>
							</li>-->
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="mod_info">

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="mod_codigo" class="control-label">Código:</label>
											<input disabled type="text" class="form-control" id="mod_codigo" name="mod_codigo"  autocomplete="off" required>
											<input id="mod_id" name="mod_id" type='hidden'>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label for="mod_nombre" class="control-label">Nombre:</label>
                                                                                        <input disabled type="text" class="form-control UpperCase" id="mod_nombre" name="mod_nombre" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label disabled for="mod_descripcion" class="control-label">Descripción</label>
											<textarea disabled class="form-control UpperCase"  id="mod_descripcion" name="mod_descripcion" maxlength="255"  autocomplete="off"></textarea>
										</div>
									</div>
                                                                    <div class="col-md-6"></div>
								</div>
								
                                                            
								

							</div>
							
<!--							<div class="tab-pane fade" id="img2">

								<div class="outer_img"></div>


							</div>-->
                                                    
<!--                                                    <div class="tab-pane fade" id="imagenes">

								
                                                            
                                                          <div class="outer_img_a1"></div>
                                                          <div class="outer_img_a2"></div>
                                                          <div class="outer_img_a3"></div>
                                                          <div class="outer_img_a4"></div>
                                                          <div class="outer_img_a5"></div>
                                                           
                                                          
                                                           
                                                        
                                                          
                                                            
                                                        
                                                          
                                                            
                                                        
                                                          
                                                            
								

							</div>-->

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