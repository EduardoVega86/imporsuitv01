<style>
	.left-column {
		width: 50%;
		padding: 20px;
		padding-top: 60px;
		position: -webkit-sticky;
		/* Para compatibilidad con Safari */
		position: sticky;
		top: 0;
		/* Ajusta esto a la altura de cualquier cabecera o menú que tengas */
		height: 100%;
		/* O la altura que quieras que tenga */
	}

	.right-column {
		width: 50%;
		padding: 20px;
		padding-top: 60px;
	}

	/* Seccion Hidden */
	.list-group-item {
		display: flex;
		flex-direction: column;
		/* Asegura que el contenido fluya de arriba hacia abajo */
	}

	.edit-section {
		width: 100%;
		/* Ocupa todo el ancho disponible */
		/* Otros estilos que desees aplicar */
	}

	.hidden {
		display: none;
		/* Oculta la sección */
	}

	/* Este estilo se aplica cuando se muestra la sección */
	.edit-section:not(.hidden) {
		display: block;
		/* O 'flex' si necesitas más control sobre el contenido interior */
	}

	.caja_transparente {
		border-radius: 0.5rem;
		border: 1px solid #ccc;
		padding: 10px;
	}

	.caja_variable {
		padding-top: 10px;
		padding-right: 10px !important;
		padding-left: 10px !important;
		border-radius: 0.5rem;
		background-color: #dedbdb;
	}

	.discount-code-container {
		max-width: 300px;
		/* O el ancho que prefieras */
		padding-top: 10px;
	}

	.applied-discount {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-top: 10px;
		padding: 5px 10px;
		background: #f2f2f2;
		/* Fondo gris claro para destacar */
		border-radius: 5px;
	}

	.discount-tag {
		font-weight: bold;
	}

	.close {
		font-size: 20px;
		color: #000;
		opacity: 0.6;
	}

	.close:hover {
		opacity: 1;
	}

	.sub_titulos {
		font-size: 17px;
		font-weight: 700;
	}

	hr {
		border: none;
		/* Quita el borde predeterminado */
		height: 2px;
		/* Ajusta el grosor de la línea */
		background-color: #000;
		/* Ajusta el color de la línea */
		margin: 20px 0;
		/* Ajusta el espaciado vertical de la línea */
	}

	.input-group-text {
		background: transparent;
		padding-right: 0;
		/* Remover el espacio a la derecha del ícono si es necesario */
	}

	.form-group .input-group .form-control {
		border: 1px solid #ced4da;
		/* Ajusta al color de borde deseado */
		border-left: none;
		/* Remueve el borde izquierdo donde se unen el ícono y el input */
	}

	/* Ajusta el tamaño y el color del icono según sea necesario */
	.bx {
		font-size: 1.5rem;
		/* Tamaño del icono */
		color: #757575;
		/* Color del icono */
	}

	.icon-btn.active i {
		color: white;
		/* O puedes usar #FFFFFF */
	}

	.form-group {
		margin: 0 !important;
	}

	.btn_comprar {
		border-radius: 0.5rem;
		padding: 10px;
	}
</style>


<div id="exampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="post" action="gracias.php" id="formulario">
					<div id="gracias" class="modal-content">
						<div id="previewContainer" class="p-3">

							<div id="tituloFormularioPreview">
								<h4 id="texto_tituloPreview">PAGA AL RECIBIR EN CASA!</h4>
							</div>
							<div id="resultados" class="modal-body">

							</div>
							<div id="tarifasEnvioPreview">
								<p id="titulo_tarifaPreview" style="font-weight:bold;">Método de envío</p>
								<div class="caja_transparente d-flex flex-row">
									<input type="radio" name="metodoEnvio" checked>
									<label for="envioGratisPreview"> Envío gratis</label>
									<label id="gratisPreview" style="width: 60%; text-align: end; font-weight:bold;">Gratis</label>
								</div>
							</div>
							<div class="discount-code-container" id="codigosDescuentoPreview">
								<!-- Campo de entrada para el código de descuento -->
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Código de descuento" id="etiqueta_descuentoPreview" aria-label="Código de descuento">
									<div class="input-group-append">
										<button class="btn btn-dark" id="textoBtn_aplicarPreview" type="button">Aplicar</button>
									</div>
								</div>

								<!-- Código de descuento aplicado -->
								<div class="applied-discount">
									<span class="discount-tag">4SALE $4.00</span>
								</div>
							</div>
							<!-- Nombre y apellidos -->
							<div class="form-group" id="nombresApellidosPreview" style="position: relative; padding-top: 10px;">
								<hr />
								<label class="sub_titulos">Nombres y Apellidos</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="icono_nombresApellidosPreview"><i class='bx bxs-user'></i></span>
									</div>
									<input type="text" class="form-control" id="txt_nombresApellidosPreview" placeholder="Nombre y Apellido">
								</div>
							</div>
							<!-- Fin Nombre y apellidos -->
							<!-- Telefono -->
							<div class="form-group" id="telefonoPreview" style="position: relative; padding-top: 10px;">
								<label class="sub_titulos">Teléfono</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="icono_telefonoPreview"><i class='bx bxs-phone-call'></i></span>
									</div>
									<input type="text" class="form-control" id="txt_telefonoPreview" placeholder="Teléfono">
								</div>
							</div>
							<!-- Fin Telefono -->
							<!-- calle_principal -->
							<div class="form-group" id="calle_principalPreview" style="position: relative; padding-top: 10px;">
								<label class="sub_titulos" id="titulo_calle_principalPreview">Calle Principal</label>
								<div class="">
									<input type="text" class="form-control" id="txt_calle_principalPreview" placeholder="">
								</div>
							</div>
							<!-- Fin calle_principal -->
							<!-- calle_secundaria -->
							<div class="form-group" id="calle_secundariaPreview" style="position: relative; padding-top: 10px;">
								<label class="sub_titulos" id="titulo_calle_secundariaPreview">Calle Secundaria</label>
								<div class="">
									<input type="text" class="form-control" id="txt_calle_secundariaPreview" placeholder="">
								</div>
							</div>
							<!-- Fin calle_secundaria -->
							<!-- barrio_referencia -->
							<div class="form-group" id="barrio_referenciaPreview" style="position: relative; padding-top: 10px;">
								<label class="sub_titulos" id="titulo_barrio_referenciaPreview">Barrio o Referencia</label>
								<div class="">
									<input type="text" class="form-control" id="txt_barrio_referenciaPreview" placeholder="">
								</div>
							</div>
							<!-- Fin barrio_referencia -->
							<!-- provincia -->
							<div class="form-group" id="provinciaPreview" style="position: relative; padding-top: 10px;">
								<label class="sub_titulos" id="titulo_provinciaPreview">Provincia</label>
								<div class="">
									<select class="datos form-control " onchange="cargar_provincia_pedido()" id="provinica" name="provinica" required>
										<option value="">Provincia *</option>
										<?php
										$sql2 = "select * from provincia_laar where id_pais = $pais";

										$query2 = mysqli_query($conexion, $sql2);
										while ($row2 = mysqli_fetch_array($query2)) {

											$id_prov = $row2['id_prov'];

											$provincia = $row2['provincia'];
											$cod_provincia = $row2['codigo_provincia'];

											// Imprimir la opción con la marca de "selected" si es el valor almacenado
											echo '<option value="' . $cod_provincia . '">' . $provincia . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<!-- Fin provincia -->
							<!-- ciudad -->
							<div class="form-group" id="ciudadPreview" style="position: relative; padding-top: 10px;">
								<label class="sub_titulos" id="titulo_ciudadPreview">Ciudad</label>
								<div>
									<div id="div_ciudad" onclick="verify()">
										<select class="datos form-control" id="ciudad_entrega" name="ciudad_entrega" onchange="seleccionarProvincia()" required disabled>
											<option value="">Ciudad *</option>
											<?php
											$sql2 = "select * from ciudad_cotizacion where id_pais='$pais' ";
											$query2 = mysqli_query($conexion, $sql2);
											$rowcount = mysqli_num_rows($query2);
											$i = 1;
											while ($row2 = mysqli_fetch_array($query2)) {
												$id_ciudad = $row2['id_cotizacion'];
												$nombre = $row2['ciudad'];
												$cod_ciudad = $row2['codigo_ciudad_laar'];
												$valor_seleccionado = $ciudaddestino;
												$selected = ($valor_seleccionado == $cod_ciudad) ? 'selected' : '';
												echo '<option value="' . $cod_ciudad . '>' . $nombre . '</option>';
											?>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<!-- Fin ciudad -->
							<!-- comentario -->
							<div class="form-group" id="comentarioPreview" style="position: relative; padding-top: 10px;">
								<label class="sub_titulos" id="titulo_comentarioPreview">Barrio o Referencia</label>
								<div class="">
									<input type="text" class="form-control" id="txt_comentarioPreview" placeholder="">
								</div>
							</div>
							<!-- Fin comentario -->

						</div>

					</div>
			</div>
			<div class="modal-footer">
				<!-- Boton Comprar -->
				<div id="btn_comprarPreview" style="padding-top: 20px;">

					<div class="input-group mb-3 d-flex justify-content-center">

						<button class="btn_comprar btn-dark" id="textoBtn_comprarPreview" type="submit">COMPRAR AHORA</button>

					</div>

				</div>
				<!-- Fin Boton Comprar -->
			</div>
			</form>
		</div>
	</div>
</div><!-- /.modal -->

<script>
	// Funcion para que consuma los datos de checkout.json y los utilice

	document.addEventListener('DOMContentLoaded', function() {
		loadAndSetInitialData();
	});

	function loadAndSetInitialData() {
		$.getJSON('../json/checkout.json', function(data) {
			data.forEach(item => {
				processItem(item);
			});
		}).fail(handleLoadingError);
	}

	function processItem(item) {
		Object.keys(item.content).forEach(key => {
			updateFieldAndPreview(key, item.content[key], item.id_elemento);
		});
		toggleVisibility(item.estado, item.id_elemento);
		reorderElements(item.id_elemento, item.posicion);
	}

	function updateFieldAndPreview(key, value, id_elemento) {
		const field = $('#' + key);
		const previewField = $('#' + key + 'Preview');

		updateFieldValue(field, value);
		updatePreviewField(key, previewField, value);

		if (key === 'alineacion_titulo') {
			updateTextAlignment(value);
		} else if (key.startsWith('color')) {
			updateColor(key, value);
		}
	}

	function updateFieldValue(field, value) {
		if (field.is(':checkbox')) {
			field.prop('checked', value === 'on');
		} else {
			field.val(value).change(); // Trigger change for preview updates
		}
	}

	function updatePreviewField(key, previewField, value) {
		if (!previewField.length) {
			console.warn('No preview field found for', key);
			return;
		}

		if (key.includes('txt_')) {
			previewField.attr('placeholder', value);
		} else if (key.includes('icono')) {
			previewField.html("<i class='" + value + "'></i>");
		} else {
			previewField.text(value);
		}
	}

	function toggleVisibility(state, id_elemento) {
		const preview = $('#' + id_elemento + 'Preview');
		state === '0' ? preview.hide() : preview.show();
	}

	function reorderElements(id_elemento, position) {
		const element = $('#' + id_elemento);
		const preview = $('#' + id_elemento + 'Preview');
		reorderElement(element, position, '.list-group');
		reorderElement(preview, position, '#previewContainer');
	}

	function reorderElement(element, position, containerSelector) {
		if (element.index() !== position) {
			element.detach();
			position === 0 ? $(containerSelector).prepend(element) : $(containerSelector).children().eq(position - 1).after(element);
		}
	}

	function updateTextAlignment(value) {
		const textAlign = value === '1' ? 'left' : value === '2' ? 'center' : 'right';
		$('#tituloFormularioPreview').css('text-align', textAlign);
	}

	function updateColor(key, value) {
		if (key === 'colorTxt_titulo') {
			$('#texto_tituloPreview').css('color', value);
		} else if (key === 'colorBtn_aplicar') {
			$('#textoBtn_aplicarPreview').css('background-color', value);
		} else if (key === 'colorBtn_comprar') {
			$('#textoBtn_comprarPreview').css('background-color', value);
		}
	}


	function handleLoadingError(jqXHR, textStatus, errorThrown) {
		console.error('Error loading JSON:', textStatus, errorThrown);
	}
</script>