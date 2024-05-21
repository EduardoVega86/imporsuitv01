<?php
/*-----------------------
Autor: Tony Plaza
----------------------------*/
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
	header("location: ../../login.php");
	exit;
}
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Productos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$count      = mysqli_query($conexion, "select MAX(codigo_producto) as codigo from productos");
$rw         = mysqli_fetch_array($count);
//si tiene letras o caracteres especiales separarlos y sumarle 1
$product_id = $rw['codigo'];
//si posee letras hacer
if (preg_match('/([A-Za-z-]+)(\d+)$/', $product_id, $matches)) {
	$letras = $matches[1]; // Captura letras y guiones
	$numero = $matches[2]; // Captura la parte numérica

	// Incrementar el número
	$numero++;

	// Mantener el formato original de las letras (con guiones)
	$letras = strtoupper($letras);

	// Asegurarse de que el número tenga al menos 3 dígitos
	$numero = str_pad($numero, 3, "0", STR_PAD_LEFT);

	// Combinar letras y número para formar el nuevo ID de producto
	$product_id = $letras . $numero;
} else {
	// Si el código no tiene letras (solo números), simplemente incrementar
	$product_id = str_pad($product_id + 1, 3, "0", STR_PAD_LEFT);
}

//consulta para elegir el impuesto en la modal
$query    = $conexion->query("select * from impuestos");
$impuesto = array();
while ($r = $query->fetch_object()) {
	$impuesto[] = $r;
}
?>

<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>
<style>
	.nav-tabs .nav-item.show .nav-link,
	.nav-tabs .nav-link.active {
		background-color: #171931 !important;
		color: white !important;
	}

	.modal .modal-dialog .modal-title {
		color: white;
	}

	.modal .modal-dialog .modal-content .modal-header {
		background-color: #171931 !important;
	}

	.border-left {
		border-right: 1px solid #ccc;
		/* Ajusta el color según tu diseño */
		padding-right: 30px;
		/* Espacio adicional para separar el contenido de la línea */
	}
</style>
<!-- Begin page -->
<div id="wrapper" class="forced enlarged"> <!-- DESACTIVA EL MENU -->

	<?php require 'includes/menu.php'; ?>

	<!-- ============================================================== -->
	<!-- Start right Content here -->
	<!-- ============================================================== -->
	<div class="content-page">
		<!-- Start content -->
		<div class="content">
			<div class="container">
				<?php if ($permisos_ver == 1) {
				?>
					<div class="col-lg-12">
						<div class="portlet">
							<div class="portlet-heading" style="background: #171931">
								<h3 class="portlet-title">
									Bitacora de Combos
								</h3>
								<div class="portlet-widgets">
									<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
									<span class="divider"></span>
									<a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
									<span class="divider"></span>
									<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div id="bg-primary" class="panel-collapse collapse show">
								<div class="portlet-body">

									<?php
									if ($permisos_editar == 1) {
										include '../modal/registro_combos.php';
										/* include '../modal/subir_producto.php'; */
										include "../modal/editar_combos.php";
										include "../modal/eliminar_combos.php";
									}
									?>


									<div class="d-flex flex-row" style="width: 100%;">

										<div class="d-flex flex-column border-left" style="width: 35%;">
											<div class="row">
												<div class="col-md-8">
													<div class="input-group mb-3">
														<select class="form-control select2" id="select_producto" style="width: 100%;">
															<option value="" selected>Seleccione un producto</option>
															<?php
															// Consulta para obtener los IDs únicos de productos en la tabla combos
															$sql = "SELECT DISTINCT id_producto_combo FROM combos";
															$result = $conexion->query($sql);

															// Verificar si se obtuvieron resultados
															if ($result->num_rows > 0) {
																// Recorrer los resultados y crear las opciones del select
																while ($row = $result->fetch_assoc()) {
																	$nombre_producto = get_row('productos', 'nombre_producto', 'id_producto', $row['id_producto_combo']);
																	$image_path_producto = get_row('productos', 'image_path', 'id_producto', $row['id_producto_combo']);

																	echo '<option value="' . $row['id_producto_combo'] . '" data-image="' . $image_path_producto . '">' . $nombre_producto . '</option>';
																}
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-md-8">
													<div class="input-group">
														<input type="text" class="form-control" id="q" placeholder="Código o Nombre" onkeyup='load(1);'>
													</div>
												</div>
												<div class="col-md-2">
													<span id="loader"></span>
												</div>

												<div class="col-md-2">

													<div class="btn-group pull-right">
														<button type="button" class="btn btn-success btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#nuevoCombo"><i class="fa fa-plus"></i> Agregar</button>
													</div>
												</div>
											</div>


											<div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
											<div class="row" style="padding-top: 10px;">
												<div class="col-md-12">
													<div class='outer_div'></div><!-- Carga los datos ajax -->
												</div>
											</div>
										</div>
										<div class="row" style="width: 65%; padding-left:30px;">
											<div id='outer_div_detalle_combo'></div> <!-- Cambiado de clase a ID -->
										</div>

									</div>
								</div>

							</div>
						</div>
					</div>
			</div>
		<?php
				} else {
		?>
			<section class="content">
				<div class="alert alert-danger" align="center">
					<h3>Acceso denegado! </h3>
					<p>No cuentas con los permisos necesario para acceder a este módulo.</p>
				</div>
			</section>
		<?php
				}
		?>

		</div>
		<!-- end container -->
	</div>
	<!-- end content -->

	<?php require 'includes/pie.php'; ?>

</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<?php require 'includes/footer_start.php'
?>
<!-- ============================================================== -->
<!-- Todo el codigo js aqui-->
<!-- ============================================================== -->
<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
<script type="text/javascript" src="../../js/combos.js"></script>
<script>
	$(document).ready(function() {
		$(".UpperCase").on("keypress", function() {
			$input = $(this);
			setTimeout(function() {
				$input.val($input.val().toUpperCase());
			}, 50);
		})
	})
</script>

<script>
$(document).ready(function() {
    function formatState(state) {
        if (!state.id) {
            return state.text;
        }

        var imageUrl = $(state.element).attr('data-image');
        if (!imageUrl) {
            console.warn('No se encontró la imagen para el producto: ' + state.text);
        }

        var $state = $(
            '<span><img src="' + imageUrl + '" class="img-flag" style="width: 20px; height: 20px; margin-right: 10px;" /> ' + state.text + '</span>'
        );
        return $state;
    }

    $('#select_producto').select2({
        placeholder: 'Seleccione un producto',
        allowClear: true,
        templateResult: formatState,
        templateSelection: formatState
    }).on('change', function() {
        load(1); // Llamar a la función load cuando se cambia la selección
    });
});

	function ajustarCombo(button) {
		var fila = $(button).closest('tr');
		var id_combo = fila.data('id_combo'); // Asegurarse de que el data attribute se captura correctamente

		// Debugging: Verificar que se obtiene el correcto id_combo
		console.log("ID Combo:", id_combo);

		// Actualizamos los valores en los campos correspondientes
		$('#id_combo').val(id_combo); // Asegúrate de que este input existe en tu formulario

		// Cargar detalles del combo en un contenedor específico
		$('#outer_div_detalle_combo').load("../ajax/carga_detalle_combo.php?id_combo=" + id_combo, function(response, status, xhr) {
			if (status == "error") {
				var msg = "Sorry but there was an error: ";
				console.error(msg + xhr.status + " " + xhr.statusText);
			} else {
				/* $.Notification.notify('custom', 'bottom center', 'Éxito!', 'Ajuste de combo iniciado!'); */
			}
		});
	}
</script>

<?php require 'includes/footer_end.php'
?>