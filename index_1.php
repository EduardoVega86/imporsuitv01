<?php
session_start();
require_once "sysadmin/vistas/db.php";
require_once "sysadmin/vistas/php_conexion.php";
require_once "sysadmin/vistas/funciones.php";
// echo 'sysadmin/vistas/ajax/banner/'.get_row('perfil', 'banner', 'id_perfil', 1);
$id_producto = 0;
$pagina = 'INICIO';
//include './includes/style.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Titulo</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">

    

    <!-- Bootstrap core CSS -->
    <link href="css_nuevo/bootstrap.min.css" rel="stylesheet" type="text/css"/>


    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
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
  
    <link href="css_nuevo/carousel.css" rel="stylesheet" type="text/css"/>
    <!-- Custom styles for this template -->
    
  </head>
  <body>
    
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Nombre de la tienda</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Catalogo</a>
          </li>
          
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>
</header>

<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" style="background-image: url('<?php echo 'sysadmin/vistas/ajax/' . get_row('perfil', 'banner', 'id_perfil', 1) ?>');">
      <div class="container">
        <div class="carousel-caption text-start">
          <h1>Texto</h1>
          <p>Some representative placeholder content for the first slide of the carousel.</p>
          <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
        </div>
      </div>
    </div>
    <div class="carousel-item" style="background-image: url('ruta-a-tu-imagen-2.jpg');">
      <div class="container">
        <div class="carousel-caption">
          <h1>Another example headline.</h1>
          <p>Some representative placeholder content for the second slide of the carousel.</p>
          <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
        </div>
      </div>
    </div>
    <div class="carousel-item" style="background-image: url('ruta-a-tu-imagen-3.jpg');">
      <div class="container">
        <div class="carousel-caption text-end">
          <h1>One more for good measure.</h1>
          <p>Some representative placeholder content for the third slide of this carousel.</p>
          <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->
<div class="container mt-4">
  <h2>Categorías</h2>
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
        <a class="btn category-button" href="categoria.php?id_cat=<?php echo  $id_linea ?>" role="button"><?php echo  $nombre_linea; ?></a>
      </div>
    </div>
    <!-- Categoría 2 -->
    
    <!-- Categoría 3 -->
     <?php
                     }

                     ?>
  </div>
</div>
  


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>


    
    <script src="js_nuevo/bootstrap.bundle.min.js" type="text/javascript"></script>
      
  </body>
</html>
