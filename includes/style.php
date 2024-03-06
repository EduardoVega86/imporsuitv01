
<style>
.superior {
  background-color: <?php echo get_row('perfil', 'color', 'id_perfil', '1')?> !important;
}
.footer {
  background-color: <?php echo get_row('perfil', 'color_footer', 'id_perfil', '1')?> !important;
}
.boton {
  background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
  border-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;

}

.comparison-table__row-name {
    color:<?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1')?> !important;
    background-color:<?php echo get_row('perfil', 'color', 'id_perfil', '1')?> !important;
}

.boton2 {
  background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
  border-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
  border-radius: 25px;
  height: 60px;
}
.boton2:hover {

    margin-bottom: 2px;

    box-shadow: inset 0 0 10px 0 white;;

  }
.menu_activo{
 background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
 // padding: 5px;
  border-radius: 5px;
 
   
}
    
.migas_enlace{
  font-weight: bold !important;
  color: <?php echo get_row('perfil', 'color', 'id_perfil', '1')?>
}
.migas{
  color: <?php echo get_row('perfil', 'color', 'id_perfil', '1')?>
}
.texto_cabecera{
   color: <?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1')?> !important; 
   font-size: 25px !important;
}
.texto_boton{
    color: <?php echo get_row('perfil', 'texto_boton', 'id_perfil', '1')?> !important; 
}  
.texto_footer{
    color: <?php echo get_row('perfil', 'texto_footer', 'id_perfil', '1')?> !important; 
} 

.precio_oferta{
    color: <?php echo get_row('perfil', 'texto_precio', 'id_perfil', '1')?> !important; 
    font-weight: bold;
} 
.precio_normal{
    font-weight: bold;
}

.ahorro{
    color: #ea2929;
    border-style: solid;
    border-radius: 7px;
    padding: 3px;
    font-size:11px
} 

.contactos{
 background-color: #f3f3f3 !important; 
}

.btn-flotante {
	font-size: 16px; /* Cambiar el tama���o de la tipografia */
	text-transform: uppercase; /* Texto en mayusculas */
	font-weight: bold; /* Fuente en negrita o bold */
	color: #ffffff; /* Color del texto */
	border-radius: 5px; /* Borde del boton */
	letter-spacing: 2px; /* Espacio entre letras */
	background-color: #2db742; /* Color de fondo */
	padding: 18px 30px; /* Relleno del boton */
	position: fixed;
	bottom: 40px;
	right: 40px;
	transition: all 300ms ease 0ms;
	box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
	z-index: 99;
}
.btn-flotante:hover {
	 background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
	box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
	transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
 	.btn-flotante {
		font-size: 14px;
		padding: 12px 20px;
		bottom: 20px;
		right: 20px;
	}
}



.btn-flotante-producto {
	font-size: 16px; /* Cambiar el tama���o de la tipografia */
	text-transform: uppercase; /* Texto en mayusculas */
	font-weight: bold; /* Fuente en negrita o bold */
	color: #ffffff; /* Color del texto */
	border-radius: 5px; /* Borde del boton */
	letter-spacing: 2px; /* Espacio entre letras */
	background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
	padding: 18px 30px; /* Relleno del boton */
	position: fixed;
	bottom: 40px;
	right: 40px;
	transition: all 300ms ease 0ms;
	box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
	z-index: 99;
}
.btn-flotante-producto:hover {
	background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
	box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
	transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
 	.btn-flotante-producto {
		font-size: 14px;
		padding: 12px 20px;
		bottom: 20px;
		right: 20px;
	}
}


  </style>
  
  <style>
  .marquee-container {
     
  overflow: hidden;
  background-color: <?php echo get_row('perfil', 'color', 'id_perfil', '1')?>; /* Cambia el color de fondo según tus preferencias */
  color: <?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1')?>; /* Color del texto */
  
}
.marquee-container p{
    font-size: 35px !important; 
}
.marquee {
  display: block;
  white-space: nowrap;
  overflow: hidden;
  position: relative;
}

.marquee p {
  display: inline-block;
  padding-left: 100%; /* Inicia la animación fuera de la pantalla */
  animation: marqueeAnimation 20s linear infinite; /* Ajusta la duración según tus necesidades */
}

@keyframes marqueeAnimation {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-100%);
  }
}
</style>

<style>
  body { padding-top: 56px; }
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .navbar-collapse {
    justify-content: space-between;
  }
  .navbar-brand {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
     max-height: 100%; 
  max-width: 100%; 
  }
.navbar-brand {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}
 @media (max-width: 768px) {
  .navbar-brand {
    position: relative;
    left: 0;
    transform: none;
    /* Ajusta el tamaño del logo para pantallas pequeñas si es necesario */
    max-height: 80px; /* O el valor que mejor se ajuste a tu diseño */
    
  }
}

/* Fondo para el menú desplegable en modo responsive */
@media (max-width: 768px) {
  .navbar-collapse {
    background-color: #ffffff; /* o el color que prefieras */
    color: black !important;
  }
  .navbar-brand{
      padding-top: 0;
     // margin-top:-10px;
  }
  .navbarResponsive{
      //margin-top:-11px;
  }
  /* Cambia el color de texto de los ítems del dropdown */
.navbar-dark .navbar-nav .dropdown-menu .nav-link {
    color: black !important; /* Esto hará que el texto sea negro */
}

/* O para cambiar el color de texto de todos los ítems dentro del dropdown */
.navbar-dark .navbar-nav .dropdown-menu {
    color: black !important; /* Esto aplicará a todos los textos dentro del dropdown */
}

/* Para cambiar el color de fondo del dropdown */
.navbar-dark .navbar-nav .dropdown-menu {
    background-color: white; /* Asegura que el fondo sea blanco para que contraste con el texto negro */
}
  
}

.navbar {
  transition: height 0.3s;
}

.smaller-navbar {
  height: 50px !important; /* Add !important to ensure override */
}

.navbar-small {
  padding: 0px 0; /* Reduce el padding cuando el usuario se desplaza hacia abajo */
}

.navbar-small .navbar-brand img {
  height: 50px; /* Ajusta el tamaño del logo */
}

@media (max-width: 768px) {
  #navbarLogo {
    max-height: 40px; // Tamaño más pequeño para dispositivos móviles
  }
}
</style>



    <style>
        
        body, html {
  height: 100%;
  margin: 0;
}

/* Hace que el contenedor principal sea flexible y ocupe todo el espacio excepto el footer */
.main-content {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/* Agrega una línea divisoria antes del footer */
.footer-container {
  border-top: 1px solid #ccc; /* Cambia el color según prefieras */
  /* Resto de tus estilos para footer-container */
}

.footer-container hr {
    border-top: 1px solid #fff; /* Ajusta el color y el estilo de la línea divisoria */
   // width: 80%; /* Ajusta el ancho según necesites */
    margin-top: 20px; /* Espacio antes de la línea divisoria */
    margin-bottom: 20px; /* Espacio después de la línea divisoria */
}

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <style>
.carousel-item {
  height: 100vh; /* Esto hará que cada slide tenga la altura de la ventana del navegador */
  min-height: 300px; /* Altura mínima para asegurarse de que se vea bien en pantallas pequeñas */
  background-repeat: no-repeat; /* Esto evitará que la imagen se repita */
  background-position: center; /* Centra la imagen de fondo */
  background-size: cover; /* Esto hará que la imagen cubra todo el contenedor sin deformarse */
}

.carousel-item {
  position: relative; /* Esto es necesario para posicionar el pseudo-elemento */
}
.carousel-item::before {
  content: ''; /* Necesario para que se muestre el pseudo-elemento */
  position: absolute; /* Posicionamiento absoluto respecto al padre */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5); /* Color negro con transparencia */
  z-index: 2; /* Asegurándose de que se coloque sobre la imagen de fondo pero debajo del texto */
}
/* Asegúrate de que el contenido del carrusel se sitúe sobre el overlay */
.carousel-caption {
  //position: relative;
  z-index: 3;
}
.carousel-control-prev,
.carousel-control-next {
  z-index: 3; /* Asegúrate de que este valor sea mayor que el de .carousel-item */
}

</style>
    <style>
    .category-card {
  overflow: hidden; /* Asegúrate de que cualquier parte de la imagen que se agrande no se salga de los límites del div */
  position: relative; /* Establece una referencia de posición para la imagen */
  margin-bottom: 20px;
}

.category-image {
  width: 100%;
  height: 200px; /* o la altura que prefieras */
  background-size: cover;
  background-position: center;
  transition: transform 0.5s ease; /* Anima el cambio de escala */
}

.category-image:hover {
  transform: scale(1.1); /* Aumenta el tamaño de la imagen al 110% cuando se pasa el ratón por encima */
}

.category-button {
  background-color: #D9534F; /* Color de fondo del botón */
  color: white; /* Color del texto del botón */
  border: none; /* Sin bordes para el botón */
  padding: 10px 20px; /* Espaciado interior del botón */
  margin-top: 10px; /* Espacio superior del botón */
  width: 100%; /* El botón ocupa todo el ancho del 'div' */
  text-align: center; /* Centra el texto dentro del botón */
  display: block; /* Hace que el enlace se comporte como un bloque para llenar el contenedor */
  text-decoration: none; /* Elimina el subrayado del texto del enlace */
}
  </style>
   

<style>
.testimonio-container {
  text-align: center;
  padding: 20px;
}

.testimonio-imagen {
  border-radius: 50%; /* Hace la imagen redonda */
  width: 100px; /* Ajusta el tamaño de la imagen */
  height: 100px;
  margin-bottom: 20px;
}

.testimonio-texto {
  font-style: italic;
  color: #555;
}

.testimonio-autor {
  font-weight: bold;
  color: #333;
}

.testimonios-carousel .carousel-item {
  background-color: #fff; /* Fondo blanco */
  min-height: 500px;
}

.testimonios-carousel .carousel-item ::before{
  background-color: #fff; /* Fondo blanco */
}

.testimonios-carousel .carousel-item::before {
  background: none; /* Elimina el fondo oscuro */
}


.contact-section {
  padding: 40px 0; /* Ajusta el relleno según tu diseño */
  background-color: #f8f9fa; /* Fondo gris claro, cambia según el diseño */
}

.contact-form {
  background: #ffffff; /* Fondo blanco para el formulario */
  padding: 20px; /* Relleno interno para el formulario */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave para profundidad */
  border-radius: 8px; /* Bordes redondeados */
  margin-top: 20px; /* Margen superior */
}

.contact-form h3 {
  margin-bottom: 15px; /* Espaciado debajo del título */
  color: #333; /* Color de texto para el título */
}

.contact-form .form-control {
  border-radius: 0; /* Bordes cuadrados para los campos de entrada */
  border: 1px solid #ced4da; /* Borde gris para los campos */
}

.contact-form .btn-primary {
  background-color: #d9534f; /* Cambia el color de fondo del botón */
  border-color: #d9534f; /* Borde del mismo color */
  padding: 10px 20px; /* Relleno del botón */
}

.contact-form .btn-primary:hover {
  background-color: #c9302c; /* Color de fondo al pasar el ratón */
  border-color: #ac2925; /* Color del borde al pasar el ratón */
}

/* Ajustes adicionales para el responsive design */
@media (max-width: 768px) {
  .contact-form {
    margin-top: 0;
  }
}

 
</style>
<style>
.footer-container {
    background-color: #333; /* Color de fondo del footer */
    color: white; /* Color del texto */
    padding: 20px 0; /* Relleno para el footer */
    text-align: center; /* Alineación del texto al centro */
}

.footer-container h3, .footer-container p {
    margin: 5px 0; /* Margen para el título y párrafos */
}

.footer-container a {
    color: white; /* Color de los enlaces */
    text-decoration: none; /* Sin subrayado */
}

.footer-container a:hover {
    text-decoration: underline; /* Subrayado al pasar el ratón */
}

/* Botón flotante para WhatsApp */
.whatsapp-float {
    position: fixed; /* Posición fija en la pantalla */
    width: auto; /* Ancho automático */
    bottom: 40px; /* Distancia desde el fondo de la pantalla */
    right: 40px; /* Distancia desde el lado derecho de la pantalla */
    background-color: #25D366; /* Color de fondo de WhatsApp */
    color: white; /* Color del texto */
    padding: 10px 20px; /* Relleno interno del botón */
    border-radius: 5px; /* Bordes redondeados */
    text-decoration: none; /* Sin subrayado del texto */
    z-index: 100; /* Asegura que el botón esté sobre otros elementos */
}

.whatsapp-float:hover {
    background-color: #128C7E; /* Color al pasar el ratón */
}

@media (max-width: 768px) {
    .whatsapp-float {
        bottom: 20px; /* Distancia desde el fondo para dispositivos móviles */
        right: 20px; /* Distancia desde el lado derecho para dispositivos móviles */
    }
}

</style>