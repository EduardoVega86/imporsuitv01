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
  transition: transform .2s; /* Animación para el efecto de hover */
}

.card:hover {
  transform: scale(1.05); /* Aumenta ligeramente el tamaño de la tarjeta al pasar el ratón */
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.text-muted {
  text-decoration: line-through; /* Efecto tachado para el precio anterior */
}

.text-price {
  color: red;
  font-weight: bold;
}
</style> 
<?php
include './includes/head_1.php';
?>
<link href="css_nuevo/bootstrap.min.css" rel="stylesheet" type="text/css"/>    
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<meta name="theme-color" content="#7952b3">



    <link href="css_nuevo/carousel.css" rel="stylesheet" type="text/css"/>
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
    <a class="navbar-brand"  href="#"><a class="navbar-brand" href="#"><img id="navbarLogo" class="" style="vertical-align: top; height: 100px;" src="<?php
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
<?php $banner=get_row('perfil', 'banner', 'id_perfil', 1);
        if ($banner!=""){
            $texto_slider=get_row('perfil', 'texto_slider', 'id_perfil', 1);
            $text_btn_slider=get_row('perfil', 'texto_btn_slider', 'id_perfil', 1);
            $enlace_btn_slider=get_row('perfil', 'enlace_btn_slider', 'id_perfil', 1);
            $titulo_slider=get_row('perfil', 'titulo_slider', 'id_perfil', 1);
            $alineacion_slider=get_row('perfil', 'alineacion_slider', 'id_perfil', 1);
            
$resultado = $conexion->query("SELECT banner FROM perfil WHERE id_perfil = 1");
$slidePrincipal = $resultado->fetch_assoc();


if($alineacion_slider==1 or $alineacion_slider==0 or $alineacion_slider==""){
 $alineacion="text-start";   
}
if($alineacion_slider==2){
  $alineacion="";  
}
if($alineacion_slider==3){
$alineacion="text-end";    
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
                     echo $texto.' - ';
                     }?>
            </p>
        
    </div>
</div>
  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->
<div class="container mt-4">
    <h1 style="text-align: center">Categorías</h1>
    <br>
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


                     
    
   <div class="col-md-4 mb-4">
      <div class="card h-100">
        <!-- Use inline styles or a dedicated class in your stylesheet to set the aspect ratio -->
        <div class="img-container" style="aspect-ratio: 1 / 1; overflow: hidden;">
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
                                                                        ?> class="card-img-top" alt="Product Name" style="object-fit: cover; width: 100%; height: 100%;">
        </div>
        <div class="card-body d-flex flex-column">
          <a href="producto.php?id=<?php echo $id_producto ?>" ><h5 class="card-title"><?php echo $nombre_producto; ?></h5> </a>
          <p class="card-text flex-grow-1"><?php echo $descripcion_producto ?></p>
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
<div class="marquee-container">
    <div class="marquee">
        <p>
        <?php 

            $sql   = "SELECT * FROM  horizontal  where posicion=2";
                     $query = mysqli_query($conexion, $sql);
                     while ($row = mysqli_fetch_array($query)) {
                         $texto       = $row['texto'];
                     echo $texto.' - ';
                     }?>
            </p>
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
        <p ><a class="texto_footer" href="#">Política</a></p>
    </div>
</footer>


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
