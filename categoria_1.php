<?php
session_start();
if (!isset($_SESSION["comprar"])) {
  $session_id = 'user_' . mt_rand();
  $_SESSION["comprar"] = $session_id;
} else {
  $session_id = $_SESSION["comprar"];
}
if (isset($_GET['id_cat'])) {
  $id_categoria = $_GET['id_cat'];
}

require_once "sysadmin/vistas/db.php";
require_once "sysadmin/vistas/php_conexion.php";
require_once "sysadmin/vistas/funciones.php";

$id_producto = 0;
$pagina = 'CATALOGO';
include './auditoria.php';
include './includes/style.php';
if (isset($_GET['id_cat'])) {
  $sql = "select * from lineas where online='1' and padre='$id_categoria'";
  //echo $sql;
  $query = mysqli_query($conexion, $sql);
  $categorias = '';
  while ($row = mysqli_fetch_array($query)) {
    $id_linea         = $row['id_linea'];
    $nombre_linea     = $row['nombre_linea'];
    $padre  = $row['padre'];
    $categorias .= "'" . $row['id_linea'] . "',";
  }
}
?>
<!doctype html>
<html lang="es">

<head>
  <style>
    .card {
      transition: transform .2s;
      /* Animación para el efecto de hover */
    }

    .card:hover {
      transform: scale(1.05);
      /* Aumenta ligeramente el tamaño de la tarjeta al pasar el ratón */
    }

    .product-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .text-muted {
      text-decoration: line-through;
      /* Efecto tachado para el precio anterior */
    }

    .text-price {
      color: red;
      font-weight: bold;
    }

    .left-column {
      width: 20%;
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
      width: 80%;
      padding: 20px;
      padding-top: 60px;
    }

    .content_left_right {
      display: flex;
    }
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

<body>
  <?php
  include 'modal/comprar.php';
  ?>
  <header>
    <nav id="navbarId" style="height: 100px" class="navbar navbar-expand-lg  fixed-top superior ">
      <div class="container">
        <!-- Logo en el centro para todas las vistas -->
        <a class="navbar-brand" href="#"><a class="navbar-brand_1" href="#"><img id="navbarLogo" class="" style="vertical-align: top; height: 100px; width: 100px;" src="<?php
                                                                                                                                                                          if (empty(get_row('perfil', 'logo_url', 'id_perfil', '1'))) {
                                                                                                                                                                            echo "assets/img/imporsuit.png";
                                                                                                                                                                          } else {
                                                                                                                                                                            echo "sysadmin" . str_replace("../..", "", get_row('perfil', 'logo_url', 'id_perfil', '1'));
                                                                                                                                                                          }
                                                                                                                                                                          ?>" alt="Imagen" /></a></a>

        <button class="navbar-toggler" id="menuButton">
          <i class="fas fa-bars" style="color: white; text-shadow: 0px 0px 3px #fff;"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="navbarResponsive" style="padding-left: 10px; padding-right: 10px;">
        <!-- Elementos a la izquierda -->
        <ul class="navbar-nav mr-auto " style="padding-right: 15px;">
          <li class="nav-item active">
            <a class="nav-link texto_cabecera" href="<?php echo $protocol ?>://<?php echo $domain ?>">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link texto_cabecera" href="<?php echo $protocol ?>://<?php echo $domain ?>/categoria.php">Catálogo</a>
          </li>

        </ul>
        <!-- Elementos a la derecha -->
        <ul class="navbar-nav">
          <form id="searchForm">
            <div class="search-box">
              <input type="text" id="searchInput" class="search-input" placeholder="Buscar" required>
              <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
              </button>
            </div>
            <div id="suggestions" class="suggestions-dropdown" style="display: none; background-color: white; border-radius: 0.5rem; padding-left:10px;">
              <!-- Las sugerencias se insertarán aquí -->
            </div>
          </form>

          <script>
            // Autocompletar sugerencias
            document.getElementById('searchInput').addEventListener('input', function() {
              var inputVal = this.value;

              // Ocultar sugerencias si no hay valor
              if (inputVal.length === 0) {
                document.getElementById('suggestions').style.display = 'none';
                return;
              }

              // Realizar la solicitud AJAX al script PHP para obtener sugerencias
              fetch('/sysadmin/vistas/ajax/search_index.php', {
                  method: 'POST',
                  body: new URLSearchParams('query=' + inputVal)
                })
                .then(response => response.json())
                .then(data => {
                  var suggestionsContainer = document.getElementById('suggestions');
                  suggestionsContainer.innerHTML = '';
                  suggestionsContainer.style.display = 'block';

                  // Agregar las sugerencias al contenedor
                  data.forEach(function(item) {
                    var div = document.createElement('div');
                    div.innerHTML = item.nombre_producto; // Asumiendo que 'nombre_producto' es lo que quieres mostrar
                    div.onclick = function() {
                      // Al hacer clic, se actualiza el input y se redirige
                      document.getElementById('searchInput').value = this.innerText;
                      window.location.href = 'producto_1.php?id=' + item.id_producto;
                    };
                    suggestionsContainer.appendChild(div);
                  });
                })
                .catch(error => console.error('Error:', error));
            });

            // Evento submit del formulario
            document.getElementById('searchForm').addEventListener('submit', function(event) {
              event.preventDefault();
              var searchQuery = document.getElementById('searchInput').value;
              // Aquí puedes manejar la búsqueda, por ejemplo, redirigir a una página de resultados
              window.location.href = '/busqueda.php?query=' + encodeURIComponent(searchQuery);
            });
          </script>
        </ul>
      </div>

      <script>
        // Obtener el botón y el menú
        var menuButton = document.getElementById('menuButton');
        var menu = document.getElementById('navbarResponsive');

        // Función para alternar la visibilidad del menú
        function toggleMenu() {
          if (menu.classList.contains('show')) {
            menu.classList.remove('show');
          } else {
            menu.classList.add('show');
          }
        }

        // Evento click para el botón del menú
        menuButton.onclick = function() {
          toggleMenu();
        };

        // Opcional: cerrar el menú si se hace clic fuera de él
        window.onclick = function(event) {
          if (!menu.contains(event.target) && !menuButton.contains(event.target)) {
            menu.classList.remove('visible');
          }
        };
      </script>

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
    <div class="container-fluid mt-4">
      <h1 style="text-align: center">Categorías</h1>
      <br>

      <div class="content_left_right">
        <div class="left-column">
          <div class="filtro_productos caja px-3">
            <!-- Acordeón -->
            <div id="accordion" class="accordion">
              <div class="card mb-3">
                <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                  <a class="card-title">
                    Categoria
                  </a>
                </div>
                <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                  <p>Belleza</p>
                  <!-- Más categorías aquí -->
                </div>
              </div>
          </div>
          <!-- Fin Acordeón -->

          <div class="filter-section">
            <div class="filter-header">Rango de precios</div>
            <div class="range-slider">
              <span class="price-label">$0</span>
              <input type="range" min="0" max="12000" value="6000" class="slider" id="myRange">
              <span class="price-label">$12000</span>
            </div>
          </div>

          <button class="btn-filter">Filtrar</button>

          <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value;

            slider.oninput = function() {
              output.innerHTML = this.value;
            }
          </script>
        </div>
      </div>

      <div class="right-column">
        <div class="row">
          <!-- Categoría 1 -->
          <?php
          if (isset($_GET['id_cat'])) {
            if (isset($categorias) and $categorias != '') {
              $lista_cat = substr($categorias, 0, -1);
              $sql = "select * from productos where pagina_web='1' and stock_producto > 0 and id_linea_producto in ($lista_cat) or id_linea_producto=$id_categoria";
            } else {
              $lista_cat = "''";
              $sql = "select * from productos where pagina_web='1' and stock_producto > 0 and id_linea_producto=$id_categoria";
            }
          } else {
            $sql = "select * from productos where  pagina_web='1' and stock_producto > 0";
          }

          $query = mysqli_query($conexion, $sql);
          $num_registros = mysqli_num_rows($query);
          //echo $num_registros, ' Productos';
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
            $precio_normal      = $row['valor4_producto'];
            $stock_producto       = $row['stock_producto'];
            $stock_min_producto   = $row['stock_min_producto'];
            $online   = $row['pagina_web'];
            $status_producto      = $row['estado_producto'];
            $date_added           = date('d/m/Y', strtotime($row['date_added']));
            $image_path           = $row['image_path'];
            $id_imp_producto      = $row['id_imp_producto'];

          ?>




            <div class="col-6 col-md-4 col-lg-3" style="padding-bottom: 15px;">
              <div class="card h-100" style="border-radius: 15px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                <!-- Use inline styles or a dedicated class in your stylesheet to set the aspect ratio -->
                <div class="img-container d-flex" style="aspect-ratio: 1 / 1; overflow: hidden; justify-content: center; align-items: center;">
                  <img src=" <?php
                              $subcadena = "http";

                              if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
                              ?>
               <?php echo  $image_path . '"'; ?>
               <?php
                              } else {
                ?>
                  sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" <?php
                                                                              }
                                                                                ?> src="<?php
                                                                                        $subcadena = "http";

                                                                                        if (strpos(strtolower($image_path), strtolower($subcadena)) === 0) {
                                                                                        ?>
                  <?php echo  $image_path . '"'; ?>
                  <?php
                                                                                        } else {
                  ?>
                  sysadmin/<?php echo str_replace("../..", "", $image_path) ?>" <?php
                                                                                        }
                                                                                ?> class="card-img-top" alt="Product Name" style="object-fit: cover; width: 80%; height: 80%;">
                </div>
                <div class="card-body d-flex flex-column">
                  <a href="producto.php?id=<?php echo $id_producto ?>" style="text-decoration: none; color:black;">
                    <h6 class="card-title"><?php echo $nombre_producto; ?></h6>
                  </a>
                  <div class="product-footer mb-2">

                    <span class="text-muted"><?php if ($precio_normal > 0) {
                                                echo get_row('perfil', 'moneda', 'id_perfil', 1) . $precio_normal;
                                              } ?></span>

                    <span class="text-price"><?php echo get_row('perfil', 'moneda', 'id_perfil', 1) . number_format($precio_especial, 2); ?></span>
                  </div>
                  <a style="z-index:2; height: 40px; font-size: 16px" class="btn boton text-white mt-2" href="#" onclick="agregar_tmp(<?php echo $id_producto; ?>, <?php echo $precio_especial; ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal">Comprar</a>
                </div>
              </div>
            </div>
          <?php
          }

          ?>
        </div>
      </div>
    </div>
    </div>
    <div class="marquee-container">
      <div class="marquee">
        <p>
          <?php

          $sql   = "SELECT * FROM  horizontal  where posicion=2";
          $query = mysqli_query($conexion, $sql);
          while ($row = mysqli_fetch_array($query)) {
            $texto       = $row['texto'];
            echo $texto . ' - ';
          } ?>
        </p>
      </div>
    </div>




    <!-- FOOTER -->
    <!-- Botón flotante para WhatsApp -->
    <?php
    function formatPhoneNumber($number)
    {
      // Eliminar caracteres no numéricos excepto el signo +
      $number = preg_replace('/[^\d+]/', '', $number);

      // Verificar si el número ya tiene el código de país +593
      if (!preg_match('/^\+593/', $number)) {
        // Si el número comienza con 0, quitarlo
        if (strpos($number, '0') === 0) {
          $number = substr($number, 1);
        }
        // Agregar el código de país +593 al inicio del número
        $number = '+593' . $number;
      }

      return $number;
    }

    // Usar la función formatPhoneNumber para imprimir el número formateado
    $telefono = get_row('perfil', 'telefono', 'id_perfil', 1);
    $telefonoFormateado = formatPhoneNumber($telefono);
    ?>

    <?php
    $ws_flotante = get_row('perfil', 'whatsapp_flotante', 'id_perfil', 1);
    if ($ws_flotante == 1) { ?>
      <a href="https://wa.me/<?php echo $telefonoFormateado ?>" class="whatsapp-float" target="_blank"><i class="bx bxl-whatsapp-square ws_flotante"></i></a>
    <?php } ?>

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
    <div class="text-center p-4">© 2024 IMPORSUIT S.A. | Todos los derechos reservados.
    </div>


  </main>

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
</body>

</html>