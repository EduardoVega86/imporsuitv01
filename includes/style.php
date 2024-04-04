<style>
  .superior {
    background-color: <?php echo get_row('perfil', 'color', 'id_perfil', '1') ?> !important;
  }

  .footer {
    background-color: <?php echo get_row('perfil', 'color_footer', 'id_perfil', '1') ?> !important;
  }

  .boton {
    background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
    border-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;

  }

  .comparison-table__row-name {
    color: <?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1') ?> !important;
    background-color: <?php echo get_row('perfil', 'color', 'id_perfil', '1') ?> !important;
  }

  .boton2 {
    background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
    border-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
    border-radius: 25px;
    height: 60px;
  }

  .boton2:hover {

    margin-bottom: 2px;

    box-shadow: inset 0 0 10px 0 white;
    ;

  }

  .menu_activo {
    background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
    padding: 5px;
    border-radius: 5px;


  }

  .migas_enlace {
    font-weight: bold !important;
    color: <?php echo get_row('perfil', 'color', 'id_perfil', '1') ?>
  }

  .migas {
    color: <?php echo get_row('perfil', 'color', 'id_perfil', '1') ?>
  }

  .texto_cabecera {
    color: <?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1') ?> !important;
    font-size: 20px !important;
  }

  .texto_boton {
    color: <?php echo get_row('perfil', 'texto_boton', 'id_perfil', '1') ?> !important;
  }

  .texto_footer {
    color: <?php echo get_row('perfil', 'texto_footer', 'id_perfil', '1') ?> !important;
  }

  .precio_oferta {
    color: <?php echo get_row('perfil', 'texto_precio', 'id_perfil', '1') ?> !important;
    font-weight: bold;
  }

  .precio_normal {
    font-weight: bold;
  }

  .ahorro {
    color: #ea2929;
    border-style: solid;
    border-radius: 7px;
    padding: 3px;
    font-size: 11px
  }

  .contactos {
    background-color: #f3f3f3 !important;
  }

  .btn-flotante {
    font-size: 16px;
    /* Cambiar el tama���o de la tipografia */
    text-transform: uppercase;
    /* Texto en mayusculas */
    font-weight: bold;
    /* Fuente en negrita o bold */
    color: #ffffff;
    /* Color del texto */
    border-radius: 5px;
    /* Borde del boton */
    letter-spacing: 2px;
    /* Espacio entre letras */
    background-color: #2db742;
    /* Color de fondo */
    padding: 18px 30px;
    /* Relleno del boton */
    position: fixed;
    bottom: 40px;
    right: 40px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
  }

  .btn-flotante:hover {
    background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
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
    font-size: 16px;
    /* Cambiar el tama���o de la tipografia */
    text-transform: uppercase;
    /* Texto en mayusculas */
    font-weight: bold;
    /* Fuente en negrita o bold */
    color: #ffffff;
    /* Color del texto */
    border-radius: 5px;
    /* Borde del boton */
    letter-spacing: 2px;
    /* Espacio entre letras */
    background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
    padding: 18px 30px;
    /* Relleno del boton */
    position: fixed;
    bottom: 40px;
    right: 40px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
  }

  .btn-flotante-producto:hover {
    background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
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
    background-color: <?php echo get_row('perfil', 'color', 'id_perfil', '1') ?>;
    /* Cambia el color de fondo según tus preferencias */
    color: <?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1') ?>;
    /* Color del texto */

  }

  .marquee-container p {
    font-size: 18px !important;
    margin-top: 12px !important;
  }

  .marquee {
    display: block;
    white-space: nowrap;
    overflow: hidden;
    position: relative;
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
      max-height: 80px;
      /* O el valor que mejor se ajuste a tu diseño */

    }
  }

  /* Fondo para el menú desplegable en modo responsive */
  @media (max-width: 768px) {
    .navbar-collapse {
      background-color: <?php echo get_row('perfil', 'color', 'id_perfil', '1') ?>;
      /* o el color que prefieras */
      color: black !important;
      border-radius: 0.5rem;
    }

    .navbar-brand {
      padding-top: 0;
      margin-top: -10px;
    }

    .navbarResponsive {
      margin-top: -11px;
    }

    /* Cambia el color de texto de los ítems del dropdown */
    .navbar-dark .navbar-nav .dropdown-menu .nav-link {
      color: black !important;
      /* Esto hará que el texto sea negro */
    }

    /* O para cambiar el color de texto de todos los ítems dentro del dropdown */
    .navbar-dark .navbar-nav .dropdown-menu {
      color: black !important;
      /* Esto aplicará a todos los textos dentro del dropdown */
    }

    /* Para cambiar el color de fondo del dropdown */
    .navbar-dark .navbar-nav .dropdown-menu {
      background-color: white;
      /* Asegura que el fondo sea blanco para que contraste con el texto negro */
    }

  }

  .navbar {
    transition: height 0.3s;
  }

  .smaller-navbar {
    height: 50px !important;
    /* Add !important to ensure override */
  }

  .navbar-small {
    padding: 0px 0;
    /* Reduce el padding cuando el usuario se desplaza hacia abajo */
  }

  .navbar-small .navbar-brand img {
    height: 50px;
    width: 50px;
    /* Ajusta el tamaño del logo */
  }

  @media (max-width: 768px) {
    #navbarLogo {
      max-width: 100% !important; /* Ajusta el ancho al contenedor */
    height: auto !important;  /* Ajusta la altura proporcionalmente */
    }
  }
</style>



<style>
  body,
  html {
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
    border-top: 1px solid #ccc;
    /* Cambia el color según prefieras */
    /* Resto de tus estilos para footer-container */
  }

  .footer-container hr {
    border-top: 1px solid #fff;
    /* Ajusta el color y el estilo de la línea divisoria */
    width: 80%;
    /* Ajusta el ancho según necesites */
    margin-top: 20px;
    /* Espacio antes de la línea divisoria */
    margin-bottom: 20px;
    /* Espacio después de la línea divisoria */
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
  .div-alineado-izquierda {
    align-items: flex-start !important;
     padding-left: 50px;
}
</style>
<style>
  .carousel-item {
    height: 100vh;
    /* Esto hará que cada slide tenga la altura de la ventana del navegador */
    min-height: 300px;
    /* Altura mínima para asegurarse de que se vea bien en pantallas pequeñas */
    background-repeat: no-repeat;
    /* Esto evitará que la imagen se repita */
    background-position: center;
    /* Centra la imagen de fondo */
    background-size: cover;
    /* Esto hará que la imagen cubra todo el contenedor sin deformarse */
  }

  .carousel-item {
    position: relative;
    /* Esto es necesario para posicionar el pseudo-elemento */
  }

  .carousel-item::before {
    content: '';
    /* Necesario para que se muestre el pseudo-elemento */
    position: absolute;
    /* Posicionamiento absoluto respecto al padre */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: <?php echo get_row('perfil', 'banner_color_filtro', 'id_perfil', '1') ?> !important;
    opacity: <?php echo get_row('perfil', 'banner_opacidad', 'id_perfil', '1') ?> !important;
    /* Color negro con transparencia */
    /*z-index: 2;*/
    /* Asegurándose de que se coloque sobre la imagen de fondo pero debajo del texto */
  }

  /* Asegúrate de que el contenido del carrusel se sitúe sobre el overlay */
  .carousel-caption {
    position: relative;
    z-index: 3;
  }

  .carousel-control-prev,
  .carousel-control-next {
    z-index: 1;
    /* Asegúrate de que este valor sea mayor que el de .carousel-item */
  }
</style>
<style>
  /* Degradado delinea */
  .degraded-line {
    width: 100%;
    height: 1px;
    /* Ajusta esto para tener una línea súper fina */
    background: radial-gradient(circle, #000000 30%, transparent 90%);
  }

  /*inconos */
  .card_icon {
    width: 75% !important;
    border-radius: 0.5rem !important;
    /* Añade bordes redondeados a la tarjeta */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1) !important;
    /* Añade sombra a la tarjeta */
  }
  @media (max-width: 768px){
    .icon_responsive {
    padding-bottom: 20px;
  }
  }


  .card-body_icon i {
    color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1') ?> !important;
    /* Cambia el color de los íconos, ajusta según tu esquema de color */
    margin-bottom: 15px !important;
    /* Espacio debajo del ícono */
  }

  .card-title_icon {
    font-size: 1rem !important;
    /* Tamaño del título de la tarjeta */
    color: #000 !important;
    /* Color del título de la tarjeta */
  }

  .card-text_icon {
    font-size: 0.9rem !important;
    /* Tamaño del texto de la tarjeta */
    color: #6c757d !important;
    /* Color del texto de la tarjeta */
  }

  /*cards */
  .card {
    width: 80%;
    /* Ajusta esto al tamaño que prefieras */
    margin: auto;
    /* Centra la tarjeta si es más pequeña que el contenedor */
  }

  /* Para un enfoque responsivo, puedes utilizar media queries */
  @media (max-width: 768px) {
    .card {
      width: 100%;
      /* Las tarjetas ocuparán más espacio en pantallas pequeñas */
    }
  }

  .category-card {
    overflow: hidden;
    /* Asegúrate de que cualquier parte de la imagen que se agrande no se salga de los límites del div */
    position: relative;
    /* Establece una referencia de posición para la imagen */
    margin-bottom: 20px;
  }

  .category-image {
    width: 125px;
    /* Ancho del círculo */
    height: 125px;
    /* Alto del círculo */
    border-radius: 50%;
    /* Hace que el div sea un círculo */
    background-position: center;
    /* Centra la imagen de fondo */
    background-size: cover;
    /* Asegura que la imagen de fondo cubra completamente el círculo */
    display: inline-block;
    ;
    /* Cambia el tipo de display si es necesario */
    margin-bottom: 10px;
    /* Centra el div si está dentro de un contenedor más grande */
  }

  .category-image:hover {
    transform: scale(1.1);
    /* Aumenta el tamaño de la imagen al 110% cuando se pasa el ratón por encima */
  }

  .category-button {
    display: inline-block;
    /* Cambia el display a inline-block */
    width: auto;
    /* Cambia de width fijo a auto para adaptar al contenido */
    padding: 5px 20px;
    /* Ajusta el relleno para controlar el tamaño */
    margin: 0 auto;
    /* Centra el botón horizontalmente */
    border: none;
    cursor: pointer;
    text-align: center;
    /* Asegura que el texto del botón esté centrado */
  }

  .category-container {
    text-align: center;
    /* Asegura que el contenido interno esté centrado */
  }

  /* CSS para cambiar el diseño de flechas del carrucel de categorias */
  .owl-carousel .owl-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
  }

  /* Ajustes adicionales para la posición y tamaño de los botones si es necesario */
  .owl-carousel .owl-nav button.owl-prev,
  .owl-carousel .owl-nav button.owl-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    /* Establecer un tamaño adecuado para el botón si estás utilizando un icono más grande */
  }

  .owl-carousel .owl-nav .owl-prev {
    left: -2px;
    /* Ajusta según sea necesario */
  }

  .owl-carousel .owl-nav .owl-next {
    right: -2px;
    /* Ajusta según sea necesario */
  }

  /* Estilos personalizados para aumentar el tamaño de las flechas */
  .owl-carousel .owl-nav button {
    font-size: 10em;
    /* Aumenta el tamaño del icono */
    color: #333;
    /* Cambia al color deseado */
  }

  /* fin de css para modificar carrusel de categorias*/
</style>


<style>
  .testimonio-container {
    text-align: center;
    padding: 20px;
  }

  .testimonio-imagen {
    border-radius: 50%;
    /* Hace la imagen redonda */
    width: 100px;
    /* Ajusta el tamaño de la imagen */
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
    background-color: #fff;
    /* Fondo blanco */
    min-height: 500px;
  }

  .testimonios-carousel .carousel-item ::before {
    background-color: #fff;
    /* Fondo blanco */
  }

  .testimonios-carousel .carousel-item::before {
    background: none;
    /* Elimina el fondo oscuro */
  }

  .search-box {
    display: flex;
    border: 1px solid #ccc;
    /* Ajusta el color del borde como necesites */
    border-radius: 20px;
    /* Ajusta para obtener la curvatura deseada */
    overflow: hidden;
  }

  .search-input {
    border: none;
    padding: 10px;
    flex-grow: 1;
    /* Asegúrate de que el input se expanda para llenar el espacio */
  }

  .search-button {
    background: none;
    border: none;
    padding: 10px;
    /* Ajusta el padding si es necesario */
    cursor: pointer;
  }

  .search-button i {
    color: white;
  }

  .search-input:focus,
  .search-button:focus {
    outline: none;
  }


  .contact-section {
    padding: 40px 0;
    /* Ajusta el relleno según tu diseño */
    background-color: #f8f9fa;
    /* Fondo gris claro, cambia según el diseño */
  }

  .contact-form {
    background: #ffffff;
    /* Fondo blanco para el formulario */
    padding: 20px;
    /* Relleno interno para el formulario */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Sombra suave para profundidad */
    border-radius: 8px;
    /* Bordes redondeados */
    margin-top: 20px;
    /* Margen superior */
  }

  .contact-form h3 {
    margin-bottom: 15px;
    /* Espaciado debajo del título */
    color: #333;
    /* Color de texto para el título */
  }

  .contact-form .form-control {
    border-radius: 0;
    /* Bordes cuadrados para los campos de entrada */
    border: 1px solid #ced4da;
    /* Borde gris para los campos */
  }

  .contact-form .btn-primary {
    background-color: #d9534f;
    /* Cambia el color de fondo del botón */
    border-color: #d9534f;
    /* Borde del mismo color */
    padding: 10px 20px;
    /* Relleno del botón */
  }

  .contact-form .btn-primary:hover {
    background-color: #c9302c;
    /* Color de fondo al pasar el ratón */
    border-color: #ac2925;
    /* Color del borde al pasar el ratón */
  }

  /* Ajustes adicionales para el responsive design */
  @media (max-width: 768px) {
    .contact-form {
      margin-top: 0;
    }
  }
</style>
<style>
  .footer-contenedor {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    padding: 20px;
    justify-content: space-around;
    place-content: center;
    background-color: #f1f1f1;
    flex-wrap: wrap;
  }

  .footer-contenido {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .descripcion {
    font-size: 12px;
    text-align: center;
  }

  .lista_legal {
    list-style: none;
    padding: 0;
  }

  .lista_legal li {
    font-size: 12px;
    margin: 5px;
  }

  #navbarLogo {
    width: 50px;
    height: 50px;
  }

  .icon-redes {
    margin: 5px;
  }

  .redes {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .icon-redes img {
    width: 40px;
    height: 40px;
  }

  .icon-redes img:hover {
    transform: scale(1.4);
  }

  .icon-redes img:active {
    transform: scale(1);
  }

  .ws {
    color: green;
    font-size: 2em;
  }

  .send {
    color: red;
    font-size: 2em;
  }

  @keyframes sacudir {
    0% {
      transform: rotate(0deg);
    }

    25% {
      transform: rotate(10deg);
    }

    50% {
      transform: rotate(-10deg);
    }

    75% {
      transform: rotate(10deg);
    }

    100% {
      transform: rotate(-10deg);
    }
  }

  .icon-redes:hover {
    animation: sacudir 0.5s;
  }

  .icons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
  }

  /* Añadir media queries para responsividad */
  @media (max-width: 768px) {
    .footer-contenedor {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 480px) {
    .footer-contenedor {
      grid-template-columns: 1fr;
    }

    .descripcion,
    .lista_legal li {
      font-size: 14px;
      /* Hacer el texto más legible en pantallas pequeñas */
    }

    .icon-redes img {
      width: 30px;
      /* Ajustar el tamaño de los iconos para pantallas pequeñas */
      height: 30px;
    }
  }

  owl-carousel .footer-contenedor {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    justify-content: space-around;
    place-content: center;
    background-color: #f1f1f1;
    flex-wrap: wrap;
  }

  .footer-contenido {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .descripcion {
    font-size: 12px;
    text-align: center;
  }

  .lista_legal {
    list-style: none;
    padding: 0;
  }

  .lista_legal li {
    font-size: 12px;
    margin: 5px;
  }

  #navbarLogo {
    width: 50px;
    height: 50px;
  }

  .icon-redes {
    margin: 5px;
  }

  .redes {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .icon-redes img {
    width: 40px;
    height: 40px;
  }

  .icon-redes img:hover {
    transform: scale(1.4);
  }

  .icon-redes img:active {
    transform: scale(1);
  }

  .ws {
    color: green;
    font-size: 2em;
  }

  .send {
    color: red;
    font-size: 2em;
  }

  @keyframes sacudir {
    0% {
      transform: rotate(0deg);
    }

    25% {
      transform: rotate(10deg);
    }

    50% {
      transform: rotate(-10deg);
    }

    75% {
      transform: rotate(10deg);
    }

    100% {
      transform: rotate(-10deg);
    }
  }

  .icon-redes:hover {
    animation: sacudir 0.5s;
  }

  .icons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
  }

  /* Añadir media queries para responsividad */
  @media (max-width: 768px) {
    .footer-contenedor {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 480px) {
    .footer-contenedor {
      grid-template-columns: 1fr;
    }

    .descripcion,
    .lista_legal li {
      font-size: 14px;
      /* Hacer el texto más legible en pantallas pequeñas */
    }

    .icon-redes img {
      width: 30px;
      /* Ajustar el tamaño de los iconos para pantallas pequeñas */
      height: 30px;
    }
  }

  .footer-container {
    background-color: #333;
    /* Color de fondo del footer */
    color: white;
    /* Color del texto */
    padding: 20px 0;
    /* Relleno para el footer */
    text-align: center;
    /* Alineación del texto al centro */
  }

  .footer-container h3,
  .footer-container p {
    margin: 5px 0;
    /* Margen para el título y párrafos */
  }

  .footer-container a {
    color: white;
    /* Color de los enlaces */
    text-decoration: none;
    /* Sin subrayado */
  }

  .footer-container a:hover {
    text-decoration: underline;
    /* Subrayado al pasar el ratón */
  }

  /* Botón flotante para WhatsApp */
  .whatsapp-float {
    position: fixed;
    /* Posición fija en la pantalla */
    width: auto;
    /* Ancho automático */
    bottom: 40px;
    /* Distancia desde el fondo de la pantalla */
    right: 40px;
    /* Distancia desde el lado derecho de la pantalla */
    background-color: #25D366;
    /* Color de fondo de WhatsApp */
    color: white;
    /* Color del texto */
    padding: 10px 20px;
    /* Relleno interno del botón */
    border-radius: 5px;
    /* Bordes redondeados */
    text-decoration: none;
    /* Sin subrayado del texto */
    z-index: 100;
    /* Asegura que el botón esté sobre otros elementos */
  }

  .whatsapp-float:hover {
    background-color: #128C7E;
    /* Color al pasar el ratón */
  }

  @media (max-width: 768px) {
    .whatsapp-float {
      bottom: 20px;
      /* Distancia desde el fondo para dispositivos móviles */
      right: 20px;
      /* Distancia desde el lado derecho para dispositivos móviles */
    }
  }

  .caja {
    padding-top: 40px !important;
    padding-bottom: 40px !important;
    border-radius: 25px;
    -webkit-box-shadow: -2px 5px 5px 0px rgba(0, 0, 0, 0.23);
    -moz-box-shadow: -2px 2px 5px 0px rgba(0, 0, 0, 0.23);
    box-shadow: -2px 2px 5px 0px rgba(0, 0, 0, 0.23);
    background-color: white;
  }
</style>