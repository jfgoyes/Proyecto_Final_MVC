<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Define el tipo de documento y el lenguaje de la página -->
    <meta charset="UTF-8">
    <!-- Configura la compatibilidad con navegadores antiguos -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Establece la escala inicial para dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página que aparece en la pestaña del navegador -->
    <title>Listado de libros - Proyecto Bibliotecario ESPE-Web</title>
    <!-- Enlace al CSS de Bootstrap desde un CDN para estilos prediseñados -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace al script de Axios desde un CDN para realizar solicitudes HTTP -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Enlace al script de Bootstrap desde un CDN para funcionalidades JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Estilos personalizados */
        body {
            background-color: white; /* Color de fondo claro para la página */
            color: black; /* Color de texto */
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
        /* Se establece el color de los botones en la página */
        .btn-danger, .btn-success, .btn-secondary { /* Botones eliminar, agregar y cancelar */
            background-color: gray; /* Fondo gris */
            border: black /* Borde negro */
        }
        .btn-warning, .btn-primary { /* Botones editar y guardar */
            background-color: #007bff; /* Fondo azul */
            border: black; /* Borde negro */
            color: white; /* Texto blanco */
        }
        .btn-success:hover { /* Efecto hover botón agregar */
            background-color: white;
            color: black;
        }
        .btn-warning:hover { /* Efecto hover botón editar */
            background-color: white;
            color: black;
        }
        .btn-danger:hover { /* Efecto hover botón eliminar */
            background-color: red;
        }
        .btn-primary:hover { /* Efecto hover botón guardar */
            background-color: white;
            color: black;
        }
        .btn-secondary:hover { /* Efecto hover botón cancelar */
            background-color: white;
            color: black;
        }
        .table { /* Estilo para las tablas */
            background-color: #ffe4b5; /* Color de fondo beige claro */
            border: black; /* Borde negro */
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
    <!-- Contenedor principal para la página -->
    <div class="container">
        <!-- Título principal de la página con margen superior -->
        <h1 class="mt-5">Lista de libros</h1>
        <!-- Botón para agregar un nuevo libro que abre un modal -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#librosModal">Agregar</button>
        <!-- Tabla para mostrar la lista de libros con estilo Bootstrap -->
        <table class="table table-striped mt-4" id="table">
            <thead>
                <tr>
                    <!-- Encabezados de la tabla -->
                    <th>Id</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Fecha de Publicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Itera sobre la lista de libros y crea una fila para cada uno -->
                <?php foreach ($libros as $libro) : ?>
                    <tr data-id="<?php echo $libro->id; ?>">
                        <!-- Celdas con los datos del libro -->
                        <td><?php echo $libro->id; ?></td>
                        <td><?php echo $libro->titulo; ?></td>
                        <td><?php echo $libro->autor_id; ?></td>
                        <td><?php echo $libro->fecha_publicacion; ?></td>
                        <td>
                            <!-- Botones para editar y eliminar el libro -->
                            <button class="btn btn-warning btnEditar">Editar</button>
                            <button class="btn btn-danger btnEliminar">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para crear o editar libros -->
    <div class="modal fade" id="librosModal" tabindex="-1" aria-labelledby="librosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Título del modal -->
                    <h5 class="modal-title" id="librosModalLabel">Crear libro</h5>
                    <!-- Botón para cerrar el modal -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal para ingresar datos del libro -->
                    <div class="form-floating mb-3">
                        <input type="text" name="titulo" class="form-control" placeholder="Título">
                        <label>Título</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="autor_id" class="form-control">
                            <!-- Itera sobre la lista de autores para crear opciones en el select -->
                            <?php foreach ($autores as $autor) : ?>
                                <option value="<?php echo $autor->id; ?>"><?php echo $autor->nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Autor</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="fecha_publicacion" class="form-control">
                        <label>Fecha de Publicación</label>
                    </div>
                </div>
                <!-- Campo oculto para almacenar el identificador del libro -->
                <input type="hidden" id="identificador" value="">
                <div class="modal-footer">
                    <!-- Botones para cancelar o guardar -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar la funcionalidad de la página -->
    <script>
        // Inicializa el modal de Bootstrap
        let myModal = new bootstrap.Modal(document.getElementById('librosModal'));

        // Función para obtener y mostrar los datos del libro en el modal
        const fetchLibro = (event) => {
            // Obtiene el ID del libro desde el atributo data-id de la fila
            let id = event.target.closest('tr').dataset.id;
            // Realiza una solicitud GET para obtener los detalles del libro
            axios.get(`http://localhost/Proyecto_Final_MVC-PHP/libros/find/${id}`).then((res) => {
                let info = res.data;
                // Actualiza el título del modal y los campos con los datos del libro
                document.querySelector("#librosModalLabel").textContent = "Editar Libro";
                document.querySelector('input[name="titulo"]').value = info.titulo;
                document.querySelector('select[name="autor_id"]').value = info.autor_id;
                document.querySelector('input[name="fecha_publicacion"]').value = info.fecha_publicacion;
                // Establece el ID del libro en un campo oculto
                document.querySelector('#identificador').value = id;
                // Muestra el modal
                myModal.show();
            });
        }

        // Función para eliminar un libro
        const deleteLibro = (event) => {
            // Obtiene el ID del libro desde el atributo data-id de la fila
            let id = event.target.closest('tr').dataset.id;
            // Realiza una solicitud DELETE para eliminar el libro
            axios.delete(`http://localhost/Proyecto_Final_MVC-PHP/libros/delete/${id}`).then((res) => {
                let info = res.data;
                // Si la respuesta indica éxito, elimina la fila de la tabla
                if (info.status) {
                    document.querySelector(`tr[data-id="${id}"]`).remove();
                }
            });
        }

        // Maneja el clic en el botón de agregar para mostrar el modal vacío
        document.querySelector('.btn.btn-success')
            .addEventListener('click', () => {
                // Configura el modal para la creación de un nuevo libro
                document.querySelector("#librosModalLabel").textContent = "Crear Libro";
                document.querySelector('input[name="titulo"]').value = "";
                document.querySelector('select[name="autor_id"]').value = "";
                document.querySelector('input[name="fecha_publicacion"]').value = "";
                document.querySelector('#identificador').value = "";
                // Muestra el modal
                myModal.show();
            });

        // Maneja el clic en el botón de guardar en el modal
        document.querySelector('.btn-guardar')
            .addEventListener('click', () => {
                // Obtiene los datos del formulario del modal
                let titulo = document.querySelector('input[name="titulo"]').value;
                let autor_id = document.querySelector('select[name="autor_id"]').value;
                let fecha_publicacion = document.querySelector('input[name="fecha_publicacion"]').value;
                let id = document.querySelector('#identificador').value;
                // Realiza una solicitud POST para crear o actualizar el libro
                axios.post(`http://localhost/Proyecto_Final_MVC-PHP/libros/${id === "" ? 'create' : 'update'}`, {
                        titulo,
                        autor_id,
                        fecha_publicacion,
                        id
                    })
                    .then((r) => {
                        let info = r.data;
                        // Si el ID está vacío, se crea un nuevo libro
                        if (id === "") {
                            let tr = document.createElement("tr");
                            tr.setAttribute('data-id', info.id);
                            tr.innerHTML = `<td>${info.id}</td>
                                            <td>${info.titulo}</td>
                                            <td>${info.autor_id}</td>
                                            <td>${info.fecha_publicacion}</td>
                                            <td><button class='btn btn-warning btnEditar'>Editar</button>
                                            <button class='btn btn-danger btnEliminar'>Eliminar</button></td>`;
                            document.getElementById("table").querySelector("tbody").append(tr);
                            // Asocia eventos de clic a los nuevos botones de editar y eliminar
                            tr.querySelector('.btnEditar').addEventListener('click', fetchLibro);
                            tr.querySelector('.btnEliminar').addEventListener('click', deleteLibro);
                        } else {
                            // Actualiza la fila existente en la tabla con los nuevos datos
                            let tr = document.querySelector(`tr[data-id="${id}"]`);
                            let cols = tr.querySelectorAll("td");
                            // Actualiza el contenido de cada celda con los nuevos datos del libro
                            cols[1].textContent = info.titulo;
                            cols[2].textContent = info.autor_id;
                            cols[3].textContent = info.fecha_publicacion;
                        }
                        // Oculta el modal después de guardar
                        myModal.hide();
                    });
            });

        // Asocia eventos de clic a los botones de editar y eliminar existentes
        // Los botones de editar muestran el modal con los datos del libro
        document.querySelectorAll('.btnEditar').forEach(btn => btn.addEventListener('click', fetchLibro));
        // Los botones de eliminar eliminan el libro de la tabla
        document.querySelectorAll('.btnEliminar').forEach(btn => btn.addEventListener('click', deleteLibro));
    </script>
</body>
</html>

<!-- Navegación del sitio web -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Enlace de marca para el proyecto -->
        <a class="navbar-brand" href="#">Proyecto Final MVC PHP</a>
        
        <!-- Contenedor que permite la expansión de la barra de navegación en pantallas grandes -->
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!-- Elemento de navegación para la página de inicio -->
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto_Final_MVC-PHP/inicio">Inicio</a>
                </li>
                <!-- Elemento de navegación para la gestión de libros -->
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto_Final_MVC-PHP/libros">Gestión de Libros</a>
                </li>
                <!-- Elemento de navegación para la gestión de autores -->
                <li class="nav-item">
                    <a class="nav-link" href="/Proyecto_Final_MVC-PHP/autores">Gestión de Autores</a>
                </li>
            </ul>
        </div>
    </nav>
</html>
