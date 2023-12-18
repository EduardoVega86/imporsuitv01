<!-- Top Bar Start -->
<?php
require_once "../funciones.php";
$marketplace_url = $_SERVER['HTTP_HOST'];
$marketplace_url = str_replace(["www.", ".com"], "", $marketplace_url);

$marketplace_url_conexion = 'imporsuit_marketplace';
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$marketplace_conexion_2 = new mysqli('localhost', 'root', '', 'master');
} else {
	$marketplace_conexion_2 = mysqli_connect('localhost', $marketplace_url_conexion, $marketplace_url_conexion, $marketplace_url_conexion);
}


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

$dominio_completo =     $protocol . $_SERVER['HTTP_HOST'];


$query_total_ventas = "SELECT SUM(valor_pendiente) AS total_pendiente_a_la_tienda FROM cabecera_cuenta_pagar WHERE tienda = '$dominio_completo'";
$total_venta = mysqli_query($marketplace_conexion_2, $query_total_ventas);

@$total_venta = mysqli_fetch_assoc($total_venta);
@$total_venta = $total_venta['total_pendiente_a_la_tienda'];
$color = '';
if ($total_venta == null) {
	$total_venta = 0;
	$color = 'text-white';
} elseif ($total_venta > 0) {
	$color = 'text-success';
} else {
	$color = 'text-danger';
}
$total_venta = number_format($total_venta, 2, '.', ',');
?>
<div class="topbar">

	<!-- LOGO -->
	<div class="topbar-left">
		<div class="text-center">
			<a href="#" class="logo"> <span>IMPORSUIT</span></a>
		</div>
	</div>

	<!-- Button mobile view to collapse sidebar menu -->
	<nav class="navbar-custom">

		<ul class="list-inline float-right mb-0">

			<li class="list-inline-item notification-list hide-phone   waves-light waves-effect">
				<i class="ti-wallet"></i>
				<span class="<?php echo $color ?>">$ <?php echo $total_venta ?></span>
			</li>

			<li class="list-inline-item notification-list hide-phone">
				<a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
					<i class="mdi mdi-crop-free noti-icon"></i>
				</a>
			</li>
			<li class="list-inline-item notification-list hide-phone">
				<a class="nav-link waves-light waves-effect" onclick="actualizar()" id="">
					<i class="mdi mdi-radar noti-icon"></i>
				</a>
			</li>

			<li class="list-inline-item dropdown notification-list">
				<a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
					<img src="<?php echo get_row('perfil', 'logo_url', 'id_perfil', 1); ?>" alt="user" class="rounded-circle">
				</a>
				<div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">

					<!-- item-->
					<a href="javascript:void(0);" class="dropdown-item notify-item">
						<i class="mdi mdi-account-star-variant"></i> <span>Perfil</span>
					</a>

					<!-- item-->
					<a href="../../login.php?logout" class="dropdown-item notify-item">
						<i class="mdi mdi-logout"></i> <span>Salir</span>
					</a>

				</div>
			</li>

		</ul>

		<ul class="list-inline menu-left mb-0">
			<li class="float-left">
				<button class="button-menu-mobile open-left waves-light waves-effect">
					<i class="mdi mdi-menu"></i>
				</button>
			</li>
		</ul>

	</nav>

</div>
<!-- Top Bar End -->
<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<!--- Divider -->
		<div id="sidebar-menu">
			<ul>
				<li class="menu-title">Menu</li>

				<li>
					<a href="principal.php" class="waves-effect waves-primary"><i class="ti-home"></i><span> Inicio </span></a>
				</li>
				<li>
					<a href="marketplace.php" class="waves-effect waves-primary"><i class="ti-import"></i><span> Marketplace </span></a>
				</li>
				<li>
					<a href="../html/clientes.php" class="waves-effect waves-primary"><i class="ti-user"></i><span> Clientes </span></a>
				</li>

				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-package"></i><span> Productos </span>
						<span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/lineas.php">Categorias</a></li>
						<li><a href="../html/productos.php">Productos</a></li>
						<li><a href="../html/kardex.php">Kardex</a></li>
						<li><a href="../html/ajustes.php">Ajuste de Inventario</a></li>
					</ul>
				</li>

				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-bag"></i><span> Compras </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/proveedores.php">Proveedores</a></li>
						<li><a href="../html/new_compra.php">Nueva Compra</a></li>
						<li><a href="../html/bitacora_compras.php">Bitácora de Compras</a></li>
					</ul>
				</li>

				<!--<li>
					<a href="../html/traslados.php" class="waves-effect waves-primary"><i
					class="ti-truck"></i><span> Traslados </span></a>
				</li>-->

				<!-- <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-shopping-cart-full"></i><span> Ventas
						
						<li><a href="../html/new_notacredito.php">Nueva Nota Credito</a></li>
						<li><a href="../html/bitacora_credito.php">Bitacora Nota Cr&eacute;dito</a></li>
						
					</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/bitacora_ventas.php">Bitácora de Ventas</a></li>
						<li><a href="../html/new_venta.php">Nueva Venta</a></li>
											
											<li><a href="../html/new_liquidacioncompra.php">Nueva Liquidacion Compra</a></li>
											<li><a href="../html/bitacora_liquidacion.php">Bitacora Liquidacion Compra</a></li>
											<li><a href="../html/new_notadebito20.php">Nueva Nota D&eacute;bito</a></li>
											<li><a href="../html/bitacora_notadebito20.php">Bitacora Nota D&eacute;bito</a></li> -->

				<!--<li><a href="../html/new_notadebito.php">Nueva Nota D&eacute;bito</a></li>
											<li><a href="../html/bitacora_debito.php">Bitacora Nota D&eacute;bito</a></li>
											<br>
				li><a href="../html/new_guia.php">Nueva Gu&iacute;a</a></li>
				<i><a href="../html/bitacora_guia.php">Bitacora Gu&iacute;a</a></i>
										<li><a href="../html/new_retencion.php">Nueva Retenci&oacute;n</a></li>
											<li><a href="../html/bitacora_retencion.php">Bitacora Retenci&oacute;n</a></li>

				<li><a href="../html/new_retencion20.php">Nueva Retenci&oacute;n</a></li>
											<li><a href="../html/bitacora_retencion20.php">Bitacora Retenci&oacute;n</a></li>
											<li><a href="../html/caja.php">Caja</a></li>
										</ul>
									</li-->

				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-receipt"></i><span> Pedidos
						</span> <span class="menu-arrow"></span></a>

					<ul class="list-unstyled">
						<!--li><a href="../html/new_cotizacion.php">Agregar Pedido</a></li-->
						<li><a href="../html/new_cotizacion.php">Ingresar Pedidos</a></li>
						<li><a href="../html/bitacora_cotizacion.php">Pedidos</a></li>
						<li><a href="../html/bitacora_anulaciones.php">Anulados</a></li>
						<li><a href="../html/bitacora_noenviados.php">No enviados</a></li>
					</ul>
				</li>
				<!-- <li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-agenda"></i><span> Cobros y Pagos </span>
						<span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/cxc.php">Abono Cliente</a></li>
						<li><a href="../html/cxp.php">Abono Proveedor</a></li>
					</ul>
				</li> -->

				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-files"></i><span> Reportes </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<!--<li><a href="../html/rep_producto.php">Reporte Productos</a></li>-->
						<li><a href="../html/rep_ventas.php">Reporte de Ventas</a></li>
						<li><a href="../html/rep_ventas_clientes.php">Ventas por Cliente</a></li>
						<li><a href="../html/rep_compras.php">Reporte de Compras</a></li>
						<li><a href="../html/rep_caja_chica.php">Reporte Caja chica</a></li>
						<li><a href="../html/rep_caja_general.php">Corte de Caja General</a></li>
						<li><a href="../html/rep_financiero.php">Reporte Financiero</a></li>
					</ul>
				</li>

				<!--li class="has_sub">
												<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-files"></i><span> Reportes Facturaci&oacute;n </span> <span class="menu-arrow"></span></a>
												<ul class="list-unstyled">
													
													<li><a href="../html/rep_comprobantes.php">Reporte de Comprobantes</a></li>
													<li><a href="../html/rep_comprobantes_ventas.php">Ventas</a></li>
													<li><a href="../html/rep_ventas_detalladas.php">Ventas Detalladas</a></li>
													<li><a href="../html/rep_retenciones_totales.php">Reporte Retenciones Totales</a></li>
													<li><a href="../html/rep_retenciones_factura.php">Reporte Retenciones x Factura</a></li>
													
												</ul>
											</li-->

				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-settings"></i><span> Configuración </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/empresa.php">Empresa</a></li>
						<li><a href="../html/sucursales.php">Sucursales</a></li>
						<li><a href="../html/comprobantes.php">Comprobantes</a></li>
						<!--<li><a href="../html/impuestos.php">Impuestos</a></li>-->
						<li><a href="../html/grupos.php">Grupos de Usuarios</a></li>
						<li><a href="../html/usuarios.php">Usuario</a></li>
						<li><a href="../html/backup.php">Backup</a></li>
						<li><a href="../html/restore.php">Restore</a></li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-desktop"></i><span> Tienda On Line </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">

						<li><a href="../html/info_web.php">Tienda On Line</a></li>
						<li><a href="../html/politicas.php">Politicas de Privacidad</a></li>
						<li><a href="../html/pixel.php">Pixele Seg</a></li>
						<li><a href="../html/gracias.php">Pagina de Gracias</a></li>
						<li><a href="../html/horizontal.php">Texto Flotante</a></li>
						<li><a href="../html/testimonios.php">Testimonios</a></li>
						<li><a href="../html/integraciones.php">Integraciones</a></li>
						<li><a href="../html/dominios.php">Dominio</a></li>



					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-truck"></i><span> Transporte</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">

						<li><a href="../html/origen_laar.php">Configurar Origen Laar Courier</a></li>

					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-wallet"></i><span> Cartera</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/wallet.php">Configurar Cartera</a></li>
						<li><a href="../html/datos_banco.php">Datos Bancarios</a></li>
					</ul>
				</li>

				<!--li class="has_sub">
										<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-import"></i><span> Carga Txt
										</span> <span class="menu-arrow"></span></a>
										<ul class="list-unstyled">
											<li><a href="../html/cargatxt.php">Carga Facturacion Txt</a></li>
											
																																					   
										</ul>
</li-->

			</ul>

			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- Left Sidebar End -->