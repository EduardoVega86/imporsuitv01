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
  $url_a1            = $row['url_a1'];
  $url_a2            = $row['url_a2'];
  $url_a3            = $row['url_a3'];
  $url_a4            = $row['url_a4'];
  $url_a5            = $row['url_a5'];


  $id_imp_producto      = $row['id_imp_producto'];
  $formato      = $row['formato'];
}
?>
<!doctype html>
<html lang="es">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    #main-image {
      /* Añade una sombra o borde si es necesario */
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      border-radius: 1rem;
      /* Ejemplo de sombra */
    }

    .list-group-item {
      background-color: transparent;
      /* Esto hará que el fondo sea transparente */
      border: none;
      /* Esto elimina el borde si lo hay */
    }

    .list-group-item img {
      opacity: 0.6;
      /* Esto hará que las miniaturas no seleccionadas sean un poco transparentes */
    }

    .list-group-item.active img {
      opacity: 1;
      /* Esto hará que la miniatura seleccionada sea completamente opaca */
      border: 2px solid grey;
      /* Esto añadirá un borde gris alrededor de la miniatura seleccionada */
    }

    .list-group-item {
      background-color: white !important;
      /* Esto hará que el fondo sea transparente */
      border-color: white !important;
      /* Esto elimina el borde si lo hay */
    }

    #list-tab .list-group-item img.img-thumbnail {
      width: 150px;
      /* El ancho deseado para las miniaturas */
      height: auto;
      /* Para mantener la proporción de aspecto */
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
    }

    .left-column {
      width: 40%;
      padding: 20px;
      padding-top: 80px;
      position: -webkit-sticky;
      /* Para compatibilidad con Safari */
      position: sticky;
      top: 0;
      /* Ajusta esto a la altura de cualquier cabecera o menú que tengas */
      height: 100%;
      /* O la altura que quieras que tenga */
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

    .iframe-container {
      position: relative;
      width: 100%;
      padding-bottom: 56.25%;
      /* Aspect ratio 16:9 */
      height: 0;
    }

    .iframe-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .button {
      background-color: red;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
    }

    @keyframes jump {
      0% {
        transform: translateY(0);
        /* Sin desplazamiento vertical */
      }

      50% {
        transform: translateY(-5px);
        /* Desplazamiento hacia arriba */
      }

      100% {
        transform: translateY(0);
        /* Volver a la posición original */
      }
    }

    /* Aplicar la animación al botón */
    .jump-button {
      animation: jump 3s ease infinite;
      /* Animación llamada 'jump' que dura 3 segundos y se repite infinitamente */
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

<body class="main-content">
  <?php
  include 'modal/comprar.php';
  ?>
  <header>
    <nav id="navbarId" style="height: 100px" class="navbar navbar-expand-lg  fixed-top superior ">
      <div class="container">
        <!-- Logo en el centro para todas las vistas -->
        <a class="navbar-brand" href="#"><a class="navbar-brand" href="#"><img id="navbarLogo" class="" style="vertical-align: top; height: 100px; width: 100px;" src="<?php
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
              <a class="nav-link texto_cabecera" href="<?php echo $protocol ?>://<?php echo $domain ?>">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link texto_cabecera" href="<?php echo $protocol ?>://<?php echo $domain ?>/categoria.php">Catálogo</a>
            </li>

          </ul>
          <!-- Elementos a la derecha -->
          <ul class="navbar-nav">
            <div class="search-box">
              <input type="text" class="search-input" placeholder="Buscar">
              <button class="search-button">
                <i class="fas fa-search"></i> <!-- Este es un icono de FontAwesome, asegúrate de incluir la librería -->
              </button>
            </div>

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

    <div class="container flex-column">
      <div class="d-flex">
        <div class="left-column">

          <div class="d-flex flex-row">
            <div class="d-flex flex-column" style="max-width: 200px !important;">
              <!-- Indicadores del carrusel para las miniaturas -->
              <div class="list-group" style="max-width: 200px !important;" id="list-tab" role="tablist">

                <a class="list-group-item list-group-item-action active" id="list-image1-list" data-toggle="list" href="#list-image1" role="tab" aria-controls="image1">
                  <img src="<?php
                            $subcadena = "http";
                            if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
                            ?>
                <?php echo  $image_path . '"'; ?>
                <?php } else { ?>
                  sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" <?php } ?> class="img-thumbnail">
                </a>
                <!-- condiciones para imagenes adicionales -->
                <!-- url1 -->
                <?php if ($url_a1 !== "") { ?>
                  <a class="list-group-item list-group-item-action active" id="list-image1-list" data-toggle="list" href="#list-image1" role="tab" aria-controls="image1">
                    <img src="<?php
                              $subcadena = "http";
                              if (strpos(strtolower($url_a1), strtolower($subcadena)) === 0) {
                              ?>
                   <?php echo  $url_a1 . '"'; ?>
                   <?php } else { ?>
                    sysadmin/<?php echo str_replace("../..", "", $url_a1) ?>" <?php } ?> class="img-thumbnail">
                  </a>
                <?php } ?>

                <!-- url2 -->
                <?php if ($url_a2 !== "") { ?>
                  <a class="list-group-item list-group-item-action active" id="list-image1-list" data-toggle="list" href="#list-image1" role="tab" aria-controls="image1">
                    <img src="<?php
                              $subcadena = "http";
                              if (strpos(strtolower($url_a2), strtolower($subcadena)) === 0) {
                              ?>
                   <?php echo  $url_a2 . '"'; ?>
                   <?php } else { ?>
                    sysadmin/<?php echo str_replace("../..", "", $url_a2) ?>" <?php } ?> class="img-thumbnail">
                  </a>
                <?php } ?>

                <!-- url3 -->
                <?php if ($url_a3 !== "") { ?>
                  <a class="list-group-item list-group-item-action active" id="list-image1-list" data-toggle="list" href="#list-image1" role="tab" aria-controls="image1">
                    <img src="<?php
                              $subcadena = "http";
                              if (strpos(strtolower($url_a3), strtolower($subcadena)) === 0) {
                              ?>
                   <?php echo  $url_a3 . '"'; ?>
                   <?php } else { ?>
                    sysadmin/<?php echo str_replace("../..", "", $url_a3) ?>" <?php } ?> class="img-thumbnail">
                  </a>
                <?php } ?>

                <!-- url4 -->
                <?php if ($url_a4 !== "") { ?>
                  <a class="list-group-item list-group-item-action active" id="list-image1-list" data-toggle="list" href="#list-image1" role="tab" aria-controls="image1">
                    <img src="<?php
                              $subcadena = "http";
                              if (strpos(strtolower($url_a4), strtolower($subcadena)) === 0) {
                              ?>
                      <?php echo  $url_a4 . '"'; ?>
                      <?php } else { ?>
                        sysadmin/<?php echo str_replace("../..", "", $url_a4) ?>" <?php } ?> class="img-thumbnail">
                  </a>
                <?php } ?>

                <!-- url5 -->
                <?php if ($url_a5 !== "") { ?>
                  <a class="list-group-item list-group-item-action active" id="list-image1-list" data-toggle="list" href="#list-image1" role="tab" aria-controls="image1">
                    <img src="<?php
                              $subcadena = "http";
                              if (strpos(strtolower($url_a5), strtolower($subcadena)) === 0) {
                              ?>
                      <?php echo  $url_a5 . '"'; ?>
                      <?php } else { ?>
                        sysadmin/<?php echo str_replace("../..", "", $url_a5) ?>" <?php } ?> class="img-thumbnail">
                  </a>
                <?php } ?>
                <!-- Final de condiciones -->
                <!-- Repite para otras miniaturas -->
              </div>
            </div>
            <div class="col-lg-10">
              <!-- Área principal de visualización de imagen -->
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-image1" role="tabpanel" aria-labelledby="list-image1-list">
                  <img id="main-image" src="<?php
                                            $subcadena = "http";
                                            if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
                                            ?>
                      <?php echo  $image_path . '"'; ?>
                      <?php } else { ?>
                        sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" <?php } ?> class="img-fluid" alt="Responsive image">
                </div>
                <!-- Repite para otras imágenes -->
              </div>
            </div>
          </div>


        </div>

        <div class="right-column">
          <div class="product-title"><?php echo $nombre_producto ?></div>


          <h3>Descripción:</h3>
          <p><?php echo $descripcion_producto ?></p>

          <div class="cart-item__price-wrapper"><span class="price price--end" style="font-size: 24px;">
              <?php echo get_row('perfil', 'moneda', 'id_perfil', 1) . number_format($precio_especial, 2); ?>
            </span>
          </div>
          <div class="container" style="margin-bottom: 20px;">


          </div>
          <br>
          <!-- Otras opciones del producto -->
          <a style="height: 50px; font-size: 26px; width: 100%; border-radius: 15px" class="jump-button btn boton text-white " href="#" onclick="agregar_tmp(<?php echo $id_producto; ?>, <?php echo $precio_especial; ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span style="margin-top: 10px">COMPRAR AHORA </span></a><!-- comment -->


          <br><br>

          <br><br>

          <!-- Inicio de Iconos-->
          <div class="d-flex flex-row" style="padding-bottom: 75px;">
            <?php
            include './auditoria.php';
            $sql = "SELECT * FROM caracteristicas_tienda WHERE accion=1 or accion=2 or accion=3";
            $query = mysqli_query($conexion, $sql);
            while ($row = mysqli_fetch_array($query)) {
              $texto = $row['texto'];
              $icon_text = $row['icon_text'];
              $enlace_icon = $row['enlace_icon'];
              $subtexto_icon = $row['subtexto_icon'];

              if ($enlace_icon == '') {
                $enlace_icon = '';
              } else {
                $enlace_icon = 'href="' . $enlace_icon . '" target="_blank" style="text-decoration: none; color: inherit;"';
              }
              //$image_path = 'https://cdn.icon-icons.com/icons2/2633/PNG/512/office_gallery_image_picture_icon_159182.png';
            ?>
              <div class="col-md-4">
                <a <?php echo $enlace_icon ?>>
                  <div class="card card_icon text-center">
                    <div class="card-body card-body_icon d-flex flex-column">
                      <div>
                        <i class="fas <?php echo $icon_text ?> fa-2x"></i> <!-- Cambia el icono según corresponda -->
                      </div>
                      <div>
                        <h5 class="card-title card-title_icon"><?php echo $texto ?></h5>
                        <p class="card-text card-text_icon"><?php echo $subtexto_icon ?></p>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php
            }
            ?>
          </div>
          <!-- Fin Iconos -->
          <div>
            <?php


            $rutaArchivo = 'sysadmin/vistas/ajax/' . get_row('landing', 'contenido', 'id_producto', $id_producto); // Reemplaza con la ruta correcta

            // Verifica si el archivo existe
            if (file_exists($rutaArchivo)) {
              // Carga y muestra el contenido del archivo HTML
              $rutaArchivo = file_get_contents($rutaArchivo);
              echo $rutaArchivo;
            } else {

              //echo $rutaArchivo;
              $contenido = get_row('landing', 'contenido', 'id_producto', $id_producto);
              if (strpos($contenido, 'http') !== false) {
                //echo 'si';
                $rutaArchivo = $contenido;
                $rutaArchivo = file_get_contents($rutaArchivo);
                echo $rutaArchivo;
              } else {
                $rutaArchivo = '../ajax/' . $contenido; // Reemplaza con la ruta correcta   
                // Verifica si el archivo existe
                if (file_exists($rutaArchivo)) {
                  // Carga y muestra el contenido del archivo HTML
                  $rutaArchivo = file_get_contents($rutaArchivo);
                  echo $rutaArchivo;
                } else {

                  //echo $rutaArchivo;
                  echo $contenido;
                }
              }
            }
            ?>

          </div>
        </div>
      </div>

    </div>

  </main>

  <!-- FOOTER -->
  <!-- Botón flotante para WhatsApp -->
  <a href="https://wa.me/tunúmero" class="whatsapp-float" target="_blank">
    PODEMOS AYUDARTE
  </a>


  <footer class="footer-contenedor">
    <?php
    $sql   = "SELECT * FROM  perfil  where id_perfil=1";
    $query = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($query)) {
      $nombre_empresa       = $row['nombre_empresa'];
      $giro_empresa       = $row['giro_empresa'];
      $telefono       = $row['telefono'];
      $email       = $row['email'];
      $logo_url       = $row['logo_url'];
      $facebook       = $row['facebook'];
      $instagram       = $row['instagram'];
      $tiktok       = $row['tiktok'];

    ?>
      <div class="footer-contenido div-alineado-izquierda">
        <h4>Acerca de <?php echo $nombre_empresa ?></h4>
        <img id="navbarLogo" src="sysadmin/<?php echo str_replace("../..", "", $logo_url)
                                            ?>">
        <span class="descripcion">
          <?php echo $giro_empresa ?>
        </span>
      </div>
      <div class="footer-contenido">
        <h5>Legal</h5>
        <ul class="lista_legal">
          <?php
          $sql   = "SELECT * FROM  politicas_empresa";
          $query = mysqli_query($conexion, $sql);
          while ($row = mysqli_fetch_array($query)) {
            $nombre_politica       = $row['nombre'];
            $id_politica       = $row['id_politica'];
          ?>
            <li><a href="<?php echo $protocol ?>://<?php echo $domain ?>/politicas.php?id=<?php echo $id_politica ?>" target="_blank"><?php echo $nombre_politica; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="footer-contenido">
        <h5>Siguenos</h5>
        <div class="redes">
          <?php if ($facebook  !== "") { ?>
            <a class="icon-redes" href="<?php echo $facebook ?>">
              <img src="https://img.icons8.com/color/48/000000/facebook.png" alt="facebook">
            </a>
          <?php } ?>
          <?php if ($instagram  !== "") { ?>
            <a class="icon-redes" href="<?php echo $instagram ?>">
              <img src="https://img.icons8.com/color/48/000000/instagram-new.png" alt="instagram">
            </a>
          <?php } ?>
          <?php if ($tiktok  !== "") { ?>
            <a class="icon-redes" href="<?php echo $tiktok ?>">
              <img src="https://img.icons8.com/color/48/000000/tiktok.png" alt="tiktok">
            </a>
          <?php } ?>
        </div>
      </div>
      <div class="footer-contenido">
        <h5>
          Información de contacto
        </h5>
        <span class="descripcion">
          <span class="icons">
            <i class='bx bxl-whatsapp ws'></i> <?php echo $telefono ?>
          </span>
          <span class="icons">
            <i class='bx bx-mail-send send'></i><?php echo $email ?>
          </span>
        </span>
      </div>
    <?php } ?>

  </footer>
  <div class="text-center p-4" style="background-color: white;"><span> © 2019 IMPORSUIT S.A. | Todos los derechos reservados.</span>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="js_nuevo/bootstrap.bundle.min.js" type="text/javascript"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="assets/js/custom_1.js"></script>
  <script>
    window.onscroll = function() {
      var nav = document.getElementById('navbarId'); // Asegúrate de que el ID coincida con el ID de tu navbar
      var logo = document.getElementById("navbarLogo");
      logo.style.maxHeight = "60px"; // o el tamaño que desees para el logo
      logo.style.maxWidth = "60px"; // o el tamaño que desees para el logo
      if (window.pageYOffset > 100) {
        nav.style.height = "70px";
        // Aquí también puedes cambiar otros estilos si es necesario, como el tamaño del logo o de la fuente
      } else {
        nav.style.height = "100px";
        logo.style.maxHeight = "100px"; // tamaño original del logo
        logo.style.maxWidth = "100px"; // tamaño original del logo
        // Restablece los estilos si el usuario vuelve a la parte superior de la página
      }
    };
  </script>

  <script>
    $(document).ready(function() {
      // Actualiza la imagen principal cuando se hace clic en un enlace de la lista
      $('#list-tab a').on('click', function(e) {
        e.preventDefault();

        $('#list-tab a').removeClass('active'); // Remueve la clase 'active' de todos los enlaces
        $(this).addClass('active'); // Añade la clase 'active' al enlace clickeado

        var newSrc = $(this).find('img').attr('src');
        $('#main-image').attr('src', newSrc);
      });
    });
  </script>


</body>

</html>