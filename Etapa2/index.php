<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diario Digital Estudiantil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- NAVBAR de Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#inicio">
                <span class="fs-4">📚 Diario Digital Estudiantil</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#noticias">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeria">Galería</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        <!-- SECCIÓN HERO con CAROUSEL de Bootstrap -->
        <section id="inicio" class="py-5">
            <div class="container">
                <!-- Fila con un solo encabezado -->
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h1 class="display-4 fw-bold text-primary">Bienvenido al Diario Digital Estudiantil</h1>
                        <!-- ALERT de Bootstrap -->
                        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                            <strong>¡Nuevo!</strong> Mantente al día con las últimas noticias académicas y eventos universitarios.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                <!-- CAROUSEL de Bootstrap -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div id="carouselHero" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="2"></button>
                            </div>
                            <div class="carousel-inner rounded">
                                <div class="carousel-item active">
                                    <img src="assets/img/banner.jpg" class="d-block w-100" alt="Banner Principal" style="height: 400px; object-fit: cover;">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                                        <h5>Noticias Universitarias</h5>
                                        <p>Tu fuente de información académica</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/hackaton.jpg" class="d-block w-100" alt="Hackathón" style="height: 400px; object-fit: cover;">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                                        <h5>Eventos Tecnológicos</h5>
                                        <p>Participa en nuestros hackathones</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/img/ia.jpg" class="d-block w-100" alt="Inteligencia Artificial" style="height: 400px; object-fit: cover;">
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                                        <h5>Investigación en IA</h5>
                                        <p>Descubre los proyectos de investigación</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Fila con el contenido principal -->
                <div class="row">
                    <div class="col-12">
                        <p class="lead text-center">
                            Nuestro Diario Digital Estudiantil es un espacio creado por y para estudiantes de informática, 
                            donde compartimos las últimas noticias académicas, eventos universitarios y proyectos destacados. 
                            Aquí encontrarás información actualizada sobre tecnología, programación, y todo lo relacionado con 
                            nuestra carrera.
                        </p>
                        <div class="text-center mt-4">
                            <!-- BUTTON de Bootstrap con Tooltip -->
                            <a href="#noticias" class="btn btn-primary btn-lg" data-bs-toggle="tooltip" 
                               data-bs-placement="top" title="Descubre las últimas publicaciones">
                                Ver Noticias 📰
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN DE NOTICIAS con CARDS de Bootstrap -->
        <section id="noticias" class="py-5 bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="display-5 fw-bold text-primary">Últimas Noticias</h2>
                    </div>
                </div>
                <div class="row g-4">
                    <?php
                    // 1. Incluir la conexión a la base de datos
                    include 'php/conex.php';

                    // 2. Crear la consulta SQL usando JOIN
                    $sql = "SELECT 
                                articulos.titulo,
                                articulos.resumen,
                                articulos.fecha_publicacion,
                                autores.nombre AS nombre_autor,
                                categorias.nombre_categoria
                            FROM 
                                articulos
                            JOIN 
                                autores ON articulos.id_autor = autores.id_autor
                            JOIN 
                                categorias ON articulos.id_categoria = categorias.id_categoria
                            ORDER BY 
                                articulos.fecha_publicacion DESC
                            LIMIT 3";

                    $result = $con->query($sql);

                    // 3. Generar CARDS de Bootstrap dinámicamente
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $fecha = date_create($row['fecha_publicacion']);
                            $fecha_formateada = date_format($fecha, 'd M Y');
                    ?>
                            <!-- CARD de Bootstrap -->
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($row['nombre_categoria']); ?></span>
                                            <small class="text-muted"><?php echo $fecha_formateada; ?></small>
                                        </div>
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['titulo']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($row['resumen']); ?></p>
                                        <p class="text-muted small mb-3">
                                            <strong>Autor:</strong> <?php echo htmlspecialchars($row['nombre_autor']); ?>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" 
                                                data-bs-target="#modalNoticia">
                                            Leer más
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="col-12"><div class="alert alert-warning">No hay noticias para mostrar en este momento.</div></div>';
                    }
                    $con->close();
                    ?>
                </div>
            </div>
        </section>
        <!-- SECCIÓN GALERÍA con CARDS de Bootstrap -->
        <section id="galeria" class="py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="display-5 fw-bold text-primary">Galería de Momentos</h2>
                    </div>
                </div>
                <!-- Fila con 3 columnas responsivas -->
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <img src="assets/img/labprograacion.jpg" class="card-img-top" alt="Laboratorio" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">💻 Clase de Algoritmos</h5>
                                <p class="card-text">Estudiantes trabajando en proyectos colaborativos</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <img src="assets/img/ganadoreshackaton.jpg" class="card-img-top" alt="Hackathón" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">🏆 Ganadores del Hackathón</h5>
                                <p class="card-text">Equipo universitario que obtuvo el primer lugar</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <img src="assets/img/graduados.png" class="card-img-top" alt="Graduación" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">🎓 Ceremonia de Graduación</h5>
                                <p class="card-text">Nuevos ingenieros en informática</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <img src="assets/img/conferencia.jpg" class="card-img-top" alt="Conferencia" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">🤝 Conferencia de Tecnología</h5>
                                <p class="card-text">Charla magistral con expertos de la industria</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <img src="assets/img/labia2.jpeg" class="card-img-top" alt="IA" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">🔬 Laboratorio de IA</h5>
                                <p class="card-text">Nuevo espacio para investigación en inteligencia artificial</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow">
                            <img src="assets/img/feria.jpg" class="card-img-top" alt="Feria" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">🌟 Feria de Proyectos</h5>
                                <p class="card-text">Exposición de los mejores trabajos estudiantiles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECCIÓN CONTACTO con sistema de grillas de Bootstrap -->
        <section id="contacto" class="py-5 bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="display-5 fw-bold text-primary">Contáctanos</h2>
                    </div>
                </div>
                
                <!-- Fila con 2 columnas: Info (col-lg-6) y Formulario (col-lg-6) -->
                <div class="row g-4">
                    <!-- Columna izquierda: Información -->
                    <div class="col-lg-6">
                        <div class="card shadow h-100">
                            <img src="assets/img/facultad.jpg" class="card-img-top" alt="Facultad" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h3 class="card-title">🏫 Información del Diario</h3>
                                <p class="card-text">
                                    ¿Tienes una noticia que compartir o quieres colaborar con nuestro diario digital? 
                                    Nos encantaría escucharte. Envíanos tus ideas, sugerencias o artículos.
                                </p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>📧 Email:</strong> diario@universidad.edu
                                    </li>
                                    <li class="list-group-item">
                                        <strong>📱 WhatsApp:</strong> +56 9 1234 5678
                                    </li>
                                    <li class="list-group-item">
                                        <strong>📍 Ubicación:</strong> Facultad de Informática, Edificio A
                                    </li>
                                </ul>
                                
                                <!-- BUTTON con Modal -->
                                <button id="mostrar-datos" class="btn btn-info mt-3 w-100" data-bs-toggle="tooltip" 
                                        title="Ver los últimos mensajes recibidos">
                                    📩 Mostrar Últimos Mensajes Recibidos
                                </button>
                                <div id="contenedor-datos" class="alert alert-secondary mt-3" role="alert">
                                    Presiona el botón para cargar los últimos 5 mensajes.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Columna derecha: Formulario -->
                    <div class="col-lg-6">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <h3 class="card-title mb-4">✉️ Envíanos un mensaje</h3>
                                <form action="php/insert.php" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre completo</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Mensaje</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100" data-bs-toggle="tooltip" 
                                            title="Enviar tu mensaje">
                                        Enviar Mensaje 📤
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- MODAL de Bootstrap -->
    <div class="modal fade" id="modalNoticia" tabindex="-1" aria-labelledby="modalNoticiaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalNoticiaLabel">📰 Noticia Completa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Esta es una noticia de ejemplo. En una implementación completa, aquí se mostraría el contenido completo de la noticia seleccionada.</p>
                    <p class="text-muted">Autor: Estudiante UCT | Fecha: 18 Nov 2025</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER con Bootstrap -->
    <footer class="bg-primary text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-2">
                        © 2024 Diario Digital Estudiantil - Facultad de Informática | 
                        Proyecto educativo desarrollado por estudiantes
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://jigsaw.w3.org/css-validator/check/referer" target="_blank">
                            <img style="border:0;width:88px;height:31px"
                                src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
                                alt="¡CSS Válido!" />
                        </a>
                        <a href="https://jigsaw.w3.org/css-validator/check/referer" target="_blank">
                            <img style="border:0;width:88px;height:31px"
                                src="https://jigsaw.w3.org/css-validator/images/vcss"
                                alt="¡CSS Válido!" /> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script personalizado -->
    <script src="js/script.js"></script>
    
    <!-- Inicializar Tooltips de Bootstrap -->
    <script>
        // Inicializar todos los tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>