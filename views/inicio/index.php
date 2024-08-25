<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Proyecto Bibliotecario ESPE-Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f0f8ff; /* Color de fondo claro para la página */
            color: #333; /* Color de texto */
        }
        .navbar {
            background-color: #007bff; /* Color de fondo azul para la barra de navegación */
            border-radius: 10px; /* Bordes redondeados */
            padding: 10px; /* Espaciado interno */
            margin: 20px auto; /* Centrado horizontalmente */
            max-width: 800px; /* Ancho máximo de la barra de navegación */
        }
        .navbar-nav {
            margin: 0 auto; /* Centrar el contenido del menú */
        }
        .navbar-brand, .nav-link {
            color: white !important; /* Texto en blanco para destacar sobre el fondo azul */
        }
        .nav-link:hover {
            text-decoration: underline; /* Hover con texto subrayado */
        }
        .hero {
            background-color: #ffe4b5; /* Color de fondo beige claro para la sección héroe */
            padding: 50px 0; /* Padding de 50px a la izquierda */
            text-align: justify; /* Texto justificado */
            margin-left: 15px; /* Margen izquierdo */
            margin-right: 15px; /* Margen derecho */
            border-radius: 10px; /* Bordes redondeados */
        }
        .centrado {
            text-align: center; /* Texto centrado */
        }
        .texto-margen {
            margin-left: 30px; /* Margen izquierdo para el texto */
            margin-right: 30px; /* Margen derecho para el texto */
            font-size: medium; /* Tamaño de la fuente */
        }
        .news-section img {
            max-width: 100%; /* Tamaño de la imagen */
            height: auto; /* Altura automática */
        }
        .social-icons img {
            width: 60px; /* Ancho de los íconos */
            margin: 0 10px; /* Margen derecho de los íconos */
        }
        .integrantes {
            background-color: #f8f9fa; /* Fondo claro para la sección de integrantes */
            padding: 20px; /* Espacio entre el elemento y el borde */
            border-radius: 10px; /* Bordes redondeados */
            margin-top: 30px; /* Margen superior */
        }
    </style>
</head>
<body>
    <!-- Barra de navegación centrada -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto_Final_MVC-PHP/inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto_Final_MVC-PHP/libros">Gestión de Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto_Final_MVC-PHP/autores">Gestión de Autores</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sección de héroe con nombre y descripción -->
    <div class="hero">
        <div class="centrado">
            <h1>Proyecto Bibliotecario ESPE-Web</h1>
        </div>
            <div class="texto-margen">
                <p>
                    Bienvenido a la plataforma de gestión de libros y autores, nuestra misión es facilitar el acceso a la 
                    información para lograr fomentar la lectura, ya que creemos que la lectura es fundamental para el desarrollo personal
                    como para el desarrollo social. Leer expande el conocimiento, mejora la concentración, mejora el pensamiento crítico, 
                    y enriquece el vocabulario junto con la expresión verbal. Además, la lectura es una herramienta poderosa para el 
                    aprendizaje continuo, permitiendo a las personas descubrir nuevas ideas, culturas o perspectivas. Al fomentar la 
                    lectura, también promovemos la empatía junto con la comprensión, creando una sociedad más educada e informada. 
                    En nuestra plataforma, hacemos que la gestión para el acceso a libros y autores sean sencillos como accesibles, 
                    para que todos puedan disfrutar de los innumerables beneficios de la lectura.
                </p>
            </div>
    </div>
    <br>
    <!-- Contenedor principal -->
    <div class="container">
        <!-- Misión -->
        <h2>Misión</h2>
        <p>
            Nuestra misión es proporcionar un sistema eficiente para la gestión y consulta de libros y autores, 
            promoviendo el aprendizaje y la cultura.
        </p>

        <!-- Visión -->
        <h2>Visión</h2>
        <p>
            Ser una plataforma líder en la gestión bibliotecaria en línea, reconocida por su facilidad de uso 
            y su compromiso con la educación.
        </p>

        <!-- Noticias Relevantes -->
        <div class="news-section">
            <h2>Artículos Relevantes</h2>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h3>Noticias</h3>
                    <a href="https://www.msn.com/es-xl/deportes/other/el-detalles-en-la-u%C3%B1as-de-michael-morales-durante-la-victoria-ante-neil-magny/ar-AA1pnRY0?ocid=msedgntp&pc=U531&cvid=dca14ea88a6843a1a52895691561e5ca&ei=9"><img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1pnDCH.img?w=594&h=396&m=6" alt="Noticia 1"></a>
                    <p>
                        El ecuatoriano Michael Morales derrotó al estadounidense Neil Magny por nocaut en el primer round de su 
                        quinta pelea en la UFC, manteniendo su invicto y alcanzando su décima séptima victoria 
                        consecutiva en MMA. Morales destacó no solo por su habilidad en el octágono, sino 
                        también por rendir homenaje a Spiderman con una uña pintada y salir con una canción de 
                        Waldokinc El Troyano, un artista ecuatoriano.
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Autores destacados</h3>
                    <a href="https://www.msn.com/es-xl/noticias/otras/george-rr-martin-desvela-el-%C3%BAnico-cambio-que-har%C3%ADa-a-los-libros-de-juego-de-tronos-y-el-gran-escritor-de-fantas%C3%ADa-al-que-envidia/ar-AA1p7VeI?ocid=BingNewsSerp"><img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1p7Vet.img?w=768&h=431&m=6&x=375&y=122&s=216&d=216" alt="Noticia 2"></a>
                    <p>
                    Durante un evento en la Oxford Writer's House, George R.R. Martin, autor de la saga 
                    "Canción de hielo y fuego", en la que se basan "Juego de Tronos" y "La Casa del Dragón", 
                    comentó en tono jocoso que si pudiera cambiar algo de sus libros sería tenerlos terminados. 
                    Martin también explicó que la larga espera por "Vientos de invierno" se debe a que, a 
                    diferencia de otros autores como Gene Wolfe, no tuvo el lujo de poder escribir toda la saga 
                    antes de publicarla. A pesar de que los fans esperan ansiosamente el sexto libro, aún no hay 
                    fecha de lanzamiento.
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Libros destacados</h3>
                    <a href="https://www.latercera.com/culto/2024/08/24/asi-vuelve-los-anillos-de-poder-hay-una-especie-de-relacion-simbiotica-entre-tolkien-y-lo-que-estamos-haciendo/"><img src="https://static1.srcdn.com/wordpress/wp-content/uploads/2024/05/j-r-r.jpg?q=49&fit=crop&w=500&dpr=2" alt="Noticia 3"></a>
                    <p>
                    En 2022, Amazon lanzó la serie "El señor de los anillos: Los anillos de poder", 
                    ambientada en la Tierra Media antes de los eventos de "El señor de los anillos". 
                    La primera temporada recibió críticas mixtas, mientras que la segunda, que se estrena 
                    este jueves en Prime Video, promete ser más oscura y conectar a los personajes. Los 
                    actores expresan entusiasmo por la nueva temporada, que explora más a fondo el universo 
                    de Tolkien y presenta nuevos desafíos, incluyendo la revelación de la identidad de Sauron 
                    y la decadencia de Númenor.
                    </p>
                </div>
            </div>
        </div>

        <!-- Indicaciones Generales -->
        <h2>Indicaciones Generales</h2>
        <p>
            Utiliza el menú de navegación de la parte superior para acceder a las secciones de gestión 
            de libros y autores. Puedes ver, agregar, editar y eliminar registros de manera sencilla.
        </p>

        <!-- Redes Sociales -->
        <div class="social-icons">
            <h2>Conéctate con Nosotros</h2>
            <a href="https://www.facebook.com/ESPE.U/"><img src="https://giffiles.alphacoders.com/144/14485.gif" alt="Facebook"></a>
            <a href="https://www.instagram.com/espe.u/"><img src="https://www.bing.com/th/id/OGC.5f41d26080f8ea53be7e2f87327ba041?pid=1.7&rurl=https%3a%2f%2fcdnl.iconscout.com%2flottie%2ffree%2fthumb%2ffree-instagram-4398550-3645639.gif&ehk=JAeYksqKxo1Lqcnu0Pp3TrSgn8%2bdZ0KsMl9YlW6n1Mc%3d" alt="Instagram"></a>
            <a href="https://www.espe.edu.ec"><img src="https://img.freepik.com/vector-premium/icono-globo-efecto-purpura-degradado_197792-4858.jpg" alt="Sitio Web ESPE"></a>
        </div>
    </div>

        <!-- Sección de Integrantes del Grupo -->
        <div class="integrantes">
        <h3>Integrantes del Grupo:</h3>
            <ul>
                <li>Hernández Ojeda Jonathan Rodrigo</li>
                <li>Cantuña Cela Carlos Eduardo</li>
                <li>Goyes Arcalle Job Francesco</li>
            </ul>
        </div>

    <!-- Script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
