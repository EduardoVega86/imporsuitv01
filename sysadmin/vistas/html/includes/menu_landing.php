<!-- Top Bar Start -->
<?php
require_once "../funciones.php";

$marketplace_url_conexion = 'imporsuit_marketplace';
$marketplace_conexion = mysqli_connect($host, $marketplace_conexion, $marketplace_conexion, $marketplace_conexion);
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

$dominio_completo =     $protocol . $_SERVER['HTTP_HOST'];

$query_total_ventas = "SELECT SUM(valor_pendiente) AS total_pendiente_a_la_tienda FROM cabecera_cuenta_cobrar WHERE tienda = '$dominio_completo'";
$total_venta = mysqli_query($marketplace_conexion, $query_total_ventas);
$total_venta = mysqli_fetch_assoc($total_venta);
$total_venta = $total_venta['total_pendiente_a_la_tienda'];

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
			<li class="list-inline-item notification-list hide-phone">
				<a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
					<i class="mdi mdi-crop-free noti-icon"></i>
				</a>
			</li>

			<li class="list-inline-item dropdown notification-list">
				<span>$ <?php echo $total_venta ?> </span>
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



	</nav>

</div>
<!-- Top Bar End -->
<!-- ========== Left Sidebar Start ========== -->


<!-- Left Sidebar End -->