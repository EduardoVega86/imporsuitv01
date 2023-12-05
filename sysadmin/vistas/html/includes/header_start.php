<?php
require_once "../funciones.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<link rel="shortcut icon" href="<?php
									if (get_row('perfil', 'favicon', 'id_perfil', '1') == "") {
										echo "../../assets/images/favicon.png";
									} else {
										echo str_replace("../..", "sysadmin", get_row('perfil', 'favicon', 'id_perfil', '1'));
									}
									?>">
	<!-- daterange picker -->
	<link rel="stylesheet" href="../../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css">
	<link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<!-- librerias para la busqueda de de autocomplete -->
	<link type="text/css" href="../../js/jquery-ui.css" rel="stylesheet" />

	<title>IMPORSUIT</title>

	<!-- Sweet Alert css -->
	<link href="../../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
	<link href="../../assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
	<link href="../../assets/plugins/select2/select2.css" rel="stylesheet" type="text/css" />
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>