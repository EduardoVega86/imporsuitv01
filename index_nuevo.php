<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImporShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Contenedor para alinear el contenido -->
        <div class="container-fluid">
            <!-- Logo e interruptor para versión móvil -->
            <a class="navbar-brand" href="#">IMPORSHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Enlaces de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Catálogo</a>
                    </li>
                    <!-- Agregar más elementos de navegación según sea necesario -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Encabezado Principal -->
    <header class="bg-light p-5 text-center">
        <h1>Los mejores productos en un solo lugar</h1>
        <p>"Descubre lo mejor para ti."</p>
    </header>

    <!-- Sección de Categorías -->
    <section class="container my-5">
        <div class="row">
            <!-- Tarjetas de Categorías -->
            <!-- Repite el siguiente bloque para cada categoría -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="tu-imagen.jpg" class="card-img-top" alt="Categoría">
                    <div class="card-body">
                        <h5 class="card-title">Categoría</h5>
                        <p class="card-text">Descripción breve de la categoría.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Testimonios -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Testimonios</h2>
            <div class="row">
                <!-- Testimonios -->
                <!-- Repite el siguiente bloque para cada testimonio -->
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de la Persona</h5>
                            <p class="card-text">"Testimonio de la persona."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Contacto -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Contáctanos</h2>
        <form>
            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Tu nombre">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Tu email">
            </div>
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" id="mensaje" rows="3"></textarea>
            </div>
            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary">Enviar Mensaje a Whatsapp</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3">
            © 2024 ImporShop: Todos los derechos reservados
        </div>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
