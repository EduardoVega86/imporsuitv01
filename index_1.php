<?php
session_start();
require_once "sysadmin/vistas/db.php";
require_once "sysadmin/vistas/php_conexion.php";
require_once "sysadmin/vistas/funciones.php";
// echo 'sysadmin/vistas/ajax/banner/'.get_row('perfil', 'banner', 'id_perfil', 1);
$id_producto = 0;
$pagina = 'INICIO';
//include './includes/style.php';
include './includes/style.php';

?>
<!doctype html>
<html lang="es">
  <head>
    
   

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
   
    <div id="myCarousel" style="margin-top: 52px" class="carousel slide" data-bs-ride="carousel">
    <!-- Indicadores dinámicos -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <?php for($i = 1; $i <= $resultadoAdicionales->num_rows; $i++): ?>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
        <?php endfor; ?>
    </div>
    
    <div class="carousel-inner">
        <!-- Slide principal -->
        <div class="carousel-item active" style="background-image: url('<?php echo 'sysadmin/vistas/ajax/' . $banner; ?>');">
            <div class="container">
                <div class="carousel-caption <?php echo $alineacion; ?>">
                    <h1><?php echo $titulo_slider; ?></h1>
                    <p><?php echo $texto_slider; ?></p>
                    <p><a class="btn btn-lg btn-primary boton texto_boton"  href="<?php echo $enlace_btn_slider; ?>"><?php echo $text_btn_slider; ?></a></p>
                </div>
            </div>
        </div>
        
        <!-- Slides adicionales -->
        <?php while($slide = $resultadoAdicionales->fetch_assoc()): ?>
        <div class="carousel-item" style="background-image: url('<?php echo 'sysadmin/vistas/ajax/'.$slide['fondo_banner']; ?>');">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1><?php echo $slide['titulo']; ?></h1>
                    <p><?php echo $slide['texto_banner']; ?></p>
                    <p><a class="btn btn-lg btn-primary boton texto_boton" href="<?php echo $slide['enlace']; ?>"><?php echo $slide['texto_boton']; ?></a></p>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    
    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

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
                     include './auditoria.php';
                     $sql = "select * from lineas where tipo='1' and online=1";
                     $query = mysqli_query($conexion, $sql);
                     while ($row = mysqli_fetch_array($query)) {
                        $id_linea        = $row['id_linea'];
                        $nombre_linea      = $row['nombre_linea'];

                        $image_path           = $row['imagen'];
                        //echo $image_path;


                     ?>
    <div class="col-md-4">
      <div class="category-card">
        <div class="category-image" style="background-image: url('sysadmin/<?php echo str_replace("../..", "", $image_path) ?>');"></div>
        <a class="btn category-button boton texto_boton" href="categoria_1.php?id_cat=<?php echo  $id_linea ?>" role="button"><?php echo  $nombre_linea; ?></a>
      </div>
    </div>
    <!-- Categoría 2 -->
    
    <!-- Categoría 3 -->
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
  <div  class="container mt-4 testimonios">

  <h1 style="text-align: center">Testimonios</h1>
   <br>
  <?php
// Consulta para obtener los testimonios
$resultadoTestimonios = $conexion->query("SELECT * FROM testimonios");
$testimonios = [];
while($fila = $resultadoTestimonios->fetch_assoc()) {
    $testimonios[] = $fila;
}
?>
  
  <div id="testimonialsCarousel" class="carousel slide testimonios-carousel" data-ride="carousel">
  <div class="carousel-inner">
    <?php
    $totalTestimonios = count($testimonios);
    for($i = 0; $i < $totalTestimonios; $i+=3) {
        $isActive = $i == 0 ? 'active' : '';
        echo '<div class="carousel-item '.$isActive.'">';
        echo '<div class="container"><div class="row">';
        
        for($j = 0; $j < 3; $j++) {
            if(($i + $j) < $totalTestimonios) {
                $testimonio = $testimonios[$i + $j];
                echo '<div class="col-md-4">';
                echo '<div class="testimonio-container" style="background-color: #fff;">';
                // Ajusta los siguientes campos según tu estructura de base de datos
                echo '<img class="testimonio-imagen" src="sysadmin/'.str_replace("../..", "", $testimonio['imagen']).'" alt="Autor">';
                echo '<p class="testimonio-texto">"'.$testimonio['testimonio'].'"</p>';
                echo '<p class="testimonio-autor">'.$testimonio['nombre'].'</p>';
                echo '</div></div>';
            }
        }
        
        echo '</div></div></div>';
    }
    ?>
  </div>
  <a class="carousel-control-prev" href="#testimonialsCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#testimonialsCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>
</div>

</div>


  <div class="contact-section ">
  <div class="container mt-4 contact-section ">
        <h1 style="text-align: center">Contáctanos</h1>
        <br>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="contact-form">
        
          <form action="tu-script-de-envio.php" method="POST">
            <div class="mb-3">
              <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email *" required>
            </div>
            <div class="mb-3">
              <input type="tel" class="form-control" name="telefono" placeholder="Teléfono">
            </div>
            <div class="mb-3">
              <textarea class="form-control" name="mensaje" rows="3" placeholder="Mensaje"></textarea>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary boton">Enviar Mensaje a Whatsapp</button>
            </div>
          </form>
        </div>
      </div>
    </div>
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
        <p class="texto_footer">Los mejores productos en un solo lugar.</p>
        <p class="texto_footer">AV. COLÓN Y DIEGO DE ALMAGRO</p>
        <hr class="texto_footer"> <!-- Línea divisoria -->
        <p class="texto_footer">&copy; 2021 Sitio Web desarrollado por [TU_EMPRESA].</p>
        <p ><a class="texto_footer" href="#">Política</a></p>
    </div>
</footer>


</main>
     
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="js_nuevo/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
