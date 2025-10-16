<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diario Digital Estudiantil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="header">
        <nav class="header__nav">
            <div class="nav__brand">
                <h2 class="brand__title">📚 Diario Digital Estudiantil</h2>
            </div>
            <ul class="nav__menu">
                <li class="nav__item">
                    <a href="#inicio" class="nav__link">Inicio</a>
                </li>
                <li class="nav__item">
                    <a href="#noticias" class="nav__link">Noticias</a>
                </li>
                <li class="nav__item">
                    <a href="#galeria" class="nav__link">Galería</a>
                </li>
                <li class="nav__item">
                    <a href="#contacto" class="nav__link">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="main">
        <section id="inicio" class="hero">
            <div class="hero__container">
                <div class="hero__image">
                    <img src="assets/img/banner.jpg" alt="Banner del Diario Digital Estudiantil">
                    <div class="hero__image-placeholder">
                        <span class="placeholder-icon">📚</span>
                        <p class="placeholder-text">Banner Principal</p>
                    </div>
                </div>
                
                <h1 class="hero__title">Bienvenido al Diario Digital Estudiantil</h1>
                <div class="hero__content">
                    <p class="hero__description">
                        Nuestro Diario Digital Estudiantil es un espacio creado por y para estudiantes de informática, 
                        donde compartimos las últimas noticias académicas, eventos universitarios y proyectos destacados. 
                        Aquí encontrarás información actualizada sobre tecnología, programación, y todo lo relacionado con 
                        nuestra carrera. Este sitio web fue desarrollado como proyecto educativo usando HTML y CSS puro, 
                        aplicando las mejores prácticas de desarrollo web que aprendemos en clase. Nuestro objetivo es 
                        crear una comunidad digital donde los estudiantes puedan mantenerse informados sobre los 
                        acontecimientos más importantes de la facultad, conocer los logros de sus compañeros y participar 
                        activamente en la vida universitaria. Te invitamos a explorar nuestro contenido y ser parte 
                        de esta iniciativa estudiantil que busca fortalecer la comunicación y el aprendizaje colaborativo 
                        en nuestra institución educativa.
                    </p>
                    <a href="#noticias" class="hero__button">Ver Noticias</a>
                </div>
            </div>
        </section>

        <section id="noticias" class="news">
            <div class="news__container">
                <h2 class="news__title">Últimas Noticias</h2>
                <div class="news__grid">
                    <?php
                    // 1. Incluir la conexión a la base de datos
                    include 'php/conex.php';

                    // 2. Crear la consulta SQL usando JOIN para obtener los nombres del autor y la categoría
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
                            LIMIT 3"; // Limitar a las 3 noticias más recientes

                    $result = $con->query($sql);

                    // 3. Generar el HTML dinámicamente si hay resultados
                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Formatear la fecha para que se vea mejor
                            $fecha = date_create($row['fecha_publicacion']);
                            $fecha_formateada = date_format($fecha, 'd M Y');
                    ?>
                            <article class="news__item">
                                <div class="news__image">
                                    <div class="news__image-placeholder">
                                        <span class="placeholder-icon">📚</span>
                                        <p class="placeholder-text"><?php echo htmlspecialchars($row['nombre_categoria']); ?></p>
                                    </div>
                                </div>
                                
                                <div class="news__content">
                                    <div class="news__header">
                                        <span class="news__date"><?php echo $fecha_formateada; ?></span>
                                        <span class="news__category"><?php echo htmlspecialchars($row['nombre_categoria']); ?></span>
                                    </div>
                                    <h3 class="news__item-title"><?php echo htmlspecialchars($row['titulo']); ?></h3>
                                    <p class="news__text">
                                        <?php echo htmlspecialchars($row['resumen']); ?>
                                    </p>
                                    <a href="#" class="news__link">Leer más</a>
                                </div>
                            </article>
                            <?php
                        } // Fin del bucle while
                    } else {
                        echo "<p>No hay noticias para mostrar en este momento.</p>";
                    }
                    // 4. Cerrar la conexión
                    $con->close();
                    ?>
                </div>
            </div>
        </section>
        <section id="galeria" class="gallery">
            <div class="gallery__container">
                <h2 class="gallery__title">Galería de Momentos</h2>
                <div class="gallery__grid">
                    <div class="gallery__item">
                        <div class="gallery__image">
                            <img src="assets/img/labprograacion.jpg" alt="Laboratorio de Programación">
                            <div class="gallery__image-placeholder">
                                <span class="placeholder-icon">💻</span>
                                <p class="placeholder-text">Laboratorio de Programación</p>
                            </div>
                        </div>
                        <div class="gallery__caption">
                            <h3 class="caption__title">Clase de Algoritmos</h3>
                            <p class="caption__description">Estudiantes trabajando en proyectos colaborativos</p>
                        </div>
                    </div>

                    <div class="gallery__item">
                        <div class="gallery__image">
                            <img src="assets/img/ganadoreshackaton.jpg" alt="Ganadores del Hackathón">
                            <div class="gallery__image-placeholder">
                                <span class="placeholder-icon">🏆</span>
                                <p class="placeholder-text">Hackathón 2023</p>
                            </div>
                        </div>
                        <div class="gallery__caption">
                            <h3 class="caption__title">Ganadores del Hackathón</h3>
                            <p class="caption__description">Equipo universitario que obtuvo el primer lugar</p>
                        </div>
                    </div>

                    <div class="gallery__item">
                        <div class="gallery__image">
                            <img src="assets/img/graduados.png" alt="Ceremonia de Graduación">
                            <div class="gallery__image-placeholder">
                                <span class="placeholder-icon">🎓</span>
                                <p class="placeholder-text">Graduación 2024</p>
                            </div>
                        </div>
                        <div class="gallery__caption">
                            <h3 class="caption__title">Ceremonia de Graduación</h3>
                            <p class="caption__description">Nuevos ingenieros en informática</p>
                        </div>
                    </div>

                    <div class="gallery__item">
                        <div class="gallery__image">
                            <img src="assets/img/conferencia.jpg" alt="Conferencia de Tecnología">
                            <div class="gallery__image-placeholder">
                                <span class="placeholder-icon">🤝</span>
                                <p class="placeholder-text">Conferencia Tech</p>
                            </div>
                        </div>
                        <div class="gallery__caption">
                            <h3 class="caption__title">Conferencia de Tecnología</h3>
                            <p class="caption__description">Charla magistral con expertos de la industria</p>
                        </div>
                    </div>

                    <div class="gallery__item">
                        <div class="gallery__image">
                            <img src="assets/img/labia2.jpeg" alt="Laboratorio de Investigación">
                            <div class="gallery__image-placeholder">
                                <span class="placeholder-icon">🔬</span>
                                <p class="placeholder-text">Lab Investigación</p>
                            </div>
                        </div>
                        <div class="gallery__caption">
                            <h3 class="caption__title">Laboratorio de IA</h3>
                            <p class="caption__description">Nuevo espacio para investigación en inteligencia artificial</p>
                        </div>
                    </div>

                    <div class="gallery__item">
                        <div class="gallery__image">
                            <img src="assets/img/feria.jpg" alt="Feria de Proyectos">
                            <div class="gallery__image-placeholder">
                                <span class="placeholder-icon">🌟</span>
                                <p class="placeholder-text">Proyectos Destacados</p>
                            </div>
                        </div>
                        <div class="gallery__caption">
                            <h3 class="caption__title">Feria de Proyectos</h3>
                            <p class="caption__description">Exposición de los mejores trabajos estudiantiles</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contacto" class="contact">
            <div class="contact__container">
                <h2 class="contact__title">Contáctanos</h2>
                <div class="contact__content">
                    <div class="contact__info">
                        <div class="contact__image">
                            <img src="assets/img/facultad.jpg" alt="Facultad de Informática">
                            <div class="contact__image-placeholder">
                                <span class="placeholder-icon">🏫</span>
                                <p class="placeholder-text">Facultad de Informática</p>
                            </div>
                        </div>
                        
                        <h3 class="contact__subtitle">Información del Diario</h3>
                        <p class="contact__text">
                            ¿Tienes una noticia que compartir o quieres colaborar con nuestro diario digital? 
                            Nos encantaría escucharte. Envíanos tus ideas, sugerencias o artículos a través 
                            del formulario de contacto.
                        </p>
                        <div class="contact__details">
                            <div class="contact__item">
                                <span class="contact__label">📧 Email:</span>
                                <span class="contact__value">diario@universidad.edu</span>
                            </div>
                            <div class="contact__item">
                                <span class="contact__label">📱 WhatsApp:</span>
                                <span class="contact__value">+56 9 1234 5678</span>
                            </div>
                            <div class="contact__item">
                                <span class="contact__label">📍 Ubicación:</span>
                                <span class="contact__value">Facultad de Informática, Edificio A</span>
                            </div>
                        </div>

                        <button id="mostrar-datos" class="form__button" style="margin-top: 2rem;">
                            Mostrar Últimos Mensajes Recibidos
                        </button>
                        <div id="contenedor-datos" style="margin-top: 1rem; padding: 1rem; border-radius: 8px; background-color: #f0f0f0;">
                            <p>Presiona el botón para cargar los últimos 5 mensajes.</p>
                        </div>
                    </div>
                    
                    <form class="contact__form" action="php/insert.php" method="POST">
                        <h3 class="form__title">Envíanos un mensaje</h3>
                        <div class="form__group">
                            <label for="name" class="form__label">Nombre completo</label>
                            <input type="text" id="name" name="name" class="form__input" required>
                        </div>
                        <div class="form__group">
                            <label for="email" class="form__label">Correo electrónico</label>
                            <input type="email" id="email" name="email" class="form__input" required>
                        </div>
                        <div class="form__group">
                            <label for="message" class="form__label">Mensaje</label>
                            <textarea id="message" name="message" rows="5" class="form__textarea" required></textarea>
                        </div>
                        <button type="submit" class="form__button">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer__container">
            <p class="footer__text">
                © 2024 Diario Digital Estudiantil - Facultad de Informática | 
                Proyecto educativo desarrollado por estudiantes de primer año
            </p>

            <p>
                <a href="https://jigsaw.w3.org/css-validator/check/referer">
                  <img style="border:0;width:88px;height:31px"
                    src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
                     alt="¡CSS Válido!" />
                </a>
            </p>

            <p>
                <a href="https://jigsaw.w3.org/css-validator/check/referer">
                  <img style="border:0;width:88px;height:31px"
                   src="https://jigsaw.w3.org/css-validator/images/vcss"
                   alt="¡CSS Válido!" /> 
                </a>
            </p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>