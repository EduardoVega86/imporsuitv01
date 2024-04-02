<?php
session_start();
if (!isset($_SESSION["comprar"])) {
  $session_id = 'user_' . mt_rand();
  $_SESSION["comprar"] = $session_id;
} else {
  $session_id = $_SESSION["comprar"];
}
//echo $session_id;
require_once "sysadmin/vistas/db.php";
require_once "sysadmin/vistas/php_conexion.php";
require_once "sysadmin/vistas/funciones.php";

$id_producto = $_GET['id'];

$pagina = 'PRODUCTO';
include './auditoria.php';
include './includes/style.php';



$aColumns     = array('codigo_producto', 'nombre_producto'); //Columnas de busqueda
$sTable       = "productos";
$sWhere       = "where id_producto=$id_producto ";
$sql   = "SELECT * FROM  $sTable $sWhere ";
$query = mysqli_query($conexion, $sql);
while ($row = mysqli_fetch_array($query)) {


  $id_producto          = $row['id_producto'];
  $codigo_producto      = $row['codigo_producto'];
  $nombre_producto      = $row['nombre_producto'];
  $descripcion_producto = $row['descripcion_producto'];
  $linea_producto       = $row['id_linea_producto'];
  $med_producto         = $row['id_med_producto'];
  $id_proveedor         = $row['id_proveedor'];
  $inv_producto         = $row['inv_producto'];
  $impuesto_producto    = $row['iva_producto'];
  $costo_producto       = $row['costo_producto'];
  $utilidad_producto    = $row['utilidad_producto'];
  $precio_producto      = $row['valor1_producto'];
  $precio_mayoreo       = $row['valor2_producto'];
  $precio_especial      = $row['valor3_producto'];
  $stock_producto       = $row['stock_producto'];
  $stock_min_producto   = $row['stock_min_producto'];
  $precio_normal      = $row['valor4_producto'];



  $online   = $row['pagina_web'];
  $status_producto      = $row['estado_producto'];
  $date_added           = date('d/m/Y', strtotime($row['date_added']));
  $image_path           = $row['image_path'];

  $id_imp_producto      = $row['id_imp_producto'];
  $formato      = $row['formato'];
}
?>
<!doctype html>
<html lang="es">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
  <style>
    .carousel-indicators {
      position: static;
      margin-top: 20px;
    }

    .carousel-indicators>li {
      width: 100px;
      border: none;
      margin-right: 5px;
      cursor: pointer;
    }

    .carousel-indicators>li.active {
      border-bottom: 2px solid blue;
    }

    .carousel-inner img {
      width: auto;
      max-height: 600px;
      margin: auto;
    }

    #carouselExampleIndicators {
      max-width: 100px;
      float: left;
    }

    .main-image {
      max-width: 500px;
      float: right;
    }
  </style>



  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
    }

    .left-column {
      width: 40%;
      padding: 20px;
    }

    .right-column {
      width: 60%;
      padding: 20px;
    }

    .product-image {
      max-width: 100%;
    }

    .product-price {
      font-size: 28px;
      color: #333;
    }

    .product-title {
      font-size: 24px;
    }

    .color-options {
      list-style: none;
      padding: 0;
    }

    .color-option {
      display: inline-block;
      width: 24px;
      height: 24px;
      margin-right: 10px;
    }

    .color-option input[type="radio"] {
      display: none;
    }

    .color-option label {
      display: block;
      width: 100%;
      height: 100%;
      border: 1px solid #ccc;
      cursor: pointer;
    }

    .color-option input[type="radio"]:checked+label {
      border: 2px solid blue;
    }

    .button {
      background-color: red;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
    }

    /* Añade más estilos según sea necesario */
  </style>
  <?php
  include './includes/head_1.php';
  ?>
  <link href="css_nuevo/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

  <meta name="theme-color" content="#7952b3">



  <link href="css_nuevo/carousel.css" rel="stylesheet" type="text/css" />
  <!-- Custom styles for this template -->

</head>
<?php
if ($formato == 3) {
  $imporsuit_db = mysqli_connect("194.163.183.231", 'administrador', '69635201d674bcb6f0897604c7c97cf8', 'suit-imporcomex');
  $url_site = $_SERVER['HTTP_HOST'];
  $sql_usuario = "SELECT * FROM users WHERE url like '%" . $url_site . "%'";
  $query_usuario = mysqli_query($imporsuit_db, $sql_usuario);
  $rw_usuario = mysqli_fetch_array($query_usuario);
  echo mysqli_error($imporsuit_db);
  $users = $rw_usuario['id'];
  $pagina = $nombre_producto . "_" . $users;


  echo '
<frameset>
<frame src="https://drag.imporsuit.com/' . $pagina . '">
</frameset>
    
';
  exit;
}
?>

<body>
  <?php
  include 'modal/comprar.php';
  ?>
  <header>
    <nav id="navbarId" style="height: 100px" class="navbar navbar-expand-lg  fixed-top superior ">
      <div class="container">
        <!-- Logo en el centro para todas las vistas -->
        <a class="navbar-brand" href="#"><a class="navbar-brand" href="#"><img id="navbarLogo" class="" style="vertical-align: top; height: 100px;" src="<?php
                                                                                                                                                          if (empty(get_row('perfil', 'logo_url', 'id_perfil', '1'))) {
                                                                                                                                                            echo "assets/img/imporsuit.png";
                                                                                                                                                          } else {
                                                                                                                                                            echo "sysadmin" . str_replace("../..", "", get_row('perfil', 'logo_url', 'id_perfil', '1'));
                                                                                                                                                          }
                                                                                                                                                          ?>" alt="Imagen" /></a></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars" style="color: #000; text-shadow: 0px 0px 3px #fff;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <!-- Elementos a la izquierda -->
          <ul class="navbar-nav mr-auto ">
            <li class="nav-item active">
              <a class="nav-link texto_cabecera" href="#">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link texto_cabecera" href="#">Catálogo</a>
            </li>

          </ul>
          <!-- Elementos a la derecha -->
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle texto_cabecera" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Políticas
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Política 1</a>
                <a class="dropdown-item" href="#">Política 2</a>
                <a class="dropdown-item" href="#">Política 3</a>
              </div>
            </li>

            <form class="form-inline my-2 my-lg-0">
              <input class="form-control" type="search" placeholder="Buscar" aria-label="Buscar">

            </form>

          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <?php $banner = get_row('perfil', 'banner', 'id_perfil', 1);
    if ($banner != "") {
      $texto_slider = get_row('perfil', 'texto_slider', 'id_perfil', 1);
      $text_btn_slider = get_row('perfil', 'texto_btn_slider', 'id_perfil', 1);
      $enlace_btn_slider = get_row('perfil', 'enlace_btn_slider', 'id_perfil', 1);
      $titulo_slider = get_row('perfil', 'titulo_slider', 'id_perfil', 1);
      $alineacion_slider = get_row('perfil', 'alineacion_slider', 'id_perfil', 1);

      $resultado = $conexion->query("SELECT banner FROM perfil WHERE id_perfil = 1");
      $slidePrincipal = $resultado->fetch_assoc();


      if ($alineacion_slider == 1 or $alineacion_slider == 0 or $alineacion_slider == "") {
        $alineacion = "text-start";
      }
      if ($alineacion_slider == 2) {
        $alineacion = "";
      }
      if ($alineacion_slider == 3) {
        $alineacion = "text-end";
      }
      // Consulta para slides adicionales
      $resultadoAdicionales = $conexion->query("SELECT fondo_banner, texto_banner, titulo, texto_boton, enlace_boton, alineacion FROM banner_adicional");

    ?>



    <?php
    } ?>

    <div class="marquee-container">
      <div class="marquee">
        <p style="font-size: 22px;">
          -
          <?php

          $sql   = "SELECT * FROM  horizontal  where posicion=1 or posicion is null";
          $query = mysqli_query($conexion, $sql);
          while ($row = mysqli_fetch_array($query)) {
            $texto       = $row['texto'];
            echo $texto . ' - ';
          } ?>
        </p>

      </div>
    </div>
    <!-- Marketing messaging and featurettes
  ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container">
      <div class="left-column">


        <div class="col-md-4">
          <div class="carousel-vertical owl-carousel owl-theme">
            <!-- Imágenes del carrusel -->
            <div class="item"><img src="imagen1.jpg" alt="Imagen 1" /></div>
            <div class="item"><img src="imagen2.jpg" alt="Imagen 2" /></div>
            <div class="item"><img src="imagen3.jpg" alt="Imagen 3" /></div>
            <!-- Más imágenes... -->
          </div>
        </div>

        <img src="<?php
                  $subcadena = "http";

                  if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
                  ?>
    <?php echo  $image_path . '"'; ?>
    <?php
                  } else {
    ?>
    sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" <?php
                                                                }
                                                                  ?>alt="Producto" class="product-image">
      </div>


      <div class="right-column">
        <div class="product-title"><?php echo $nombre_producto ?></div>
        <div class="cart-item__price-wrapper"><span class="price price--end">
            <?php echo get_row('perfil', 'moneda', 'id_perfil', 1) . number_format($precio_especial, 2); ?>
          </span>
        </div>
        <div>Color:</div>
        <ul class="color-options">
          <li class="color-option">
            <input type="radio" id="color1" name="color" value="color1">
            <label for="color1" style="background-color: #0000FF;"></label>
          </li>
          <!-- Más colores si son necesarios -->
        </ul>
        <!-- Otras opciones del producto -->
        <button class="button">AGREGAR A MIS COMPRAS</button>
      </div>
    </div>



    <!-- FOOTER -->
    <!-- Botón flotante para WhatsApp -->
    <a href="https://wa.me/tunúmero" class="whatsapp-float" target="_blank">
      PODEMOS AYUDARTE
    </a>

    <footer class="footer-container footer">
      <div class="container text-center">
        <h3 class="texto_footer">Contacto:</h3>
        <p class="texto_footer"><?php echo get_row('perfil', 'texto_contactos', 'id_perfil', '1'); ?></p>
        <hr class="texto_footer"> <!-- Línea divisoria -->
        <p class="texto_footer">&copy; 2024 Sitio Web desarrollado por IMPORSUIT.</p>
        <p><a class="texto_footer" href="#">Política</a></p>
      </div>
    </footer>


  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function() {
      var carousel = $(".carousel-vertical").owlCarousel({
        autoPlay: 3000,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: false,
        navigation: true,
        navigationText: ["prev", "next"],
        pagination: false,
        scrollPerPage: true
      });

      $('.carousel-vertical .item').click(function() {
        var index = $(this).index();
        $('.product-detail').removeClass('active');
        $('#detail' + (index + 1)).addClass('active');
      });
    });
  </script>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="js_nuevo/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
  <script src="assets/js/custom_1.js"></script>
  <script>
    window.onscroll = function() {
      var nav = document.getElementById('navbarId'); // Asegúrate de que el ID coincida con el ID de tu navbar
      var logo = document.getElementById("navbarLogo");
      logo.style.maxHeight = "60px"; // o el tamaño que desees para el logo
      if (window.pageYOffset > 100) {
        nav.style.height = "70px";
        // Aquí también puedes cambiar otros estilos si es necesario, como el tamaño del logo o de la fuente
      } else {
        nav.style.height = "100px";
        logo.style.maxHeight = "100px"; // tamaño original del logo
        // Restablece los estilos si el usuario vuelve a la parte superior de la página
      }
    };
  </script>

</body>

</html>