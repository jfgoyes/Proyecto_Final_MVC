<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Define el tipo de documento como HTML5 -->
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Asegura compatibilidad con la versión más reciente del motor de renderizado de IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura el viewport para que el diseño sea responsive -->
    <title>Listado de autores - Proyecto Bibliotecario ESPE-Web</title> <!-- Título que aparece en la pestaña del navegador -->
    
    <!-- Enlaza el archivo de estilos CSS de Bootstrap desde un CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Enlaza el archivo de scripts de Axios desde un CDN para hacer peticiones HTTP -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <!-- Enlaza el archivo de scripts de Bootstrap desde un CDN, incluyendo dependencias como Popper.js -->
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
    <!-- Contenedor principal de la página con margen superior -->
    <div class="container">
        <!-- Título de la página con margen superior -->
        <h1 class="mt-5">Lista de autores</h1>
        
        <!-- Botón para abrir el modal de agregar autor con clase de éxito (verde) -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#autoresModal">Agregar</button>
        
        <!-- Tabla que lista los autores con estilo de Bootstrap -->
        <table class="table table-striped mt-4" id="table">
            <thead>
                <!-- Encabezados de la tabla -->
                <tr>
                    <th>Id</th> <!-- Columna para el ID del autor -->
                    <th>Nombre</th> <!-- Columna para el nombre del autor -->
                    <th>Acciones</th> <!-- Columna para las acciones (editar y eliminar) -->
                </tr>
            </thead>
            <tbody>
                <!-- Itera sobre la lista de autores y crea una fila para cada autor -->
                <?php foreach ($autores as $autor) : ?>
                    <tr data-id="<?php echo $autor->id; ?>">
                        <td><?php echo $autor->id; ?></td> <!-- Muestra el ID del autor -->
                        <td><?php echo $autor->nombre; ?></td> <!-- Muestra el nombre del autor -->
                        <td>
                            <!-- Botones para editar y eliminar el autor -->
                            <button class="btn btn-warning btnEditar">Editar</button>
                            <button class="btn btn-danger btnEliminar">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para crear o editar un autor -->
    <div class="modal fade" id="autoresModal" tabindex="-1" aria-labelledby="autoresModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Título del modal y botón para cerrarlo -->
                    <h5 class="modal-title" id="autoresModalLabel">Crear autor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal para ingresar el nombre del autor -->
                    <div class="form-floating mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                        <label>Nombre</label>
                    </div>
                </div>
                <!-- Campo oculto para almacenar el ID del autor cuando se edita -->
                <input type="hidden" id="identificador" value="">
                <div class="modal-footer">
                    <!-- Botones para cancelar o guardar cambios en el modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar la lógica del frontend con JavaScript -->
    <script>
        // Crea una instancia del modal de Bootstrap para controlar su visibilidad
        let myModal = new bootstrap.Modal(document.getElementById('autoresModal'));

        // Función para cargar y mostrar información del autor en el modal para edición
        const fetchAutor = (event) => {
            let id = event.target.closest('tr').dataset.id; // Obtiene el ID del autor desde el atributo data-id
            axios.get(`http://localhost/Proyecto_Final_MVC-PHP/autores/find/${id}`).then((res) => {
                let info = res.data; // Obtiene la información del autor desde la respuesta de la petición
                document.querySelector("#autoresModalLabel").textContent = "Editar Autor"; // Cambia el título del modal
                document.querySelector('input[name="nombre"]').value = info.nombre; // Llena el campo de nombre con la información del autor
                document.querySelector('#identificador').value = id; // Llena el campo oculto con el ID del autor
                myModal.show(); // Muestra el modal
            });
        }

        // Función para eliminar un autor
        const deleteAutor = (event) => {
            let id = event.target.closest('tr').dataset.id; // Obtiene el ID del autor desde el atributo data-id
            axios.delete(`http://localhost/Proyecto_Final_MVC-PHP/autores/delete/${id}`).then((res) => {
                let info = res.data; // Obtiene la respuesta de la eliminación
                if (info.status) { // Si la eliminación fue exitosa
                    document.querySelector(`tr[data-id="${id}"]`).remove(); // Elimina la fila correspondiente de la tabla
                }
            });
        }

        // Agrega un evento click al botón de agregar para mostrar el modal en modo de creación
        document.querySelector('.btn.btn-success')
            .addEventListener('click', () => {
                document.querySelector("#autoresModalLabel").textContent = "Crear Autor"; // Cambia el título del modal
                document.querySelector('input[name="nombre"]').value = ""; // Limpia el campo de nombre
                document.querySelector('#identificador').value = ""; // Limpia el campo oculto
                myModal.show(); // Muestra el modal
            });

        // Agrega un evento click al botón de guardar para crear o actualizar el autor
        document.querySelector('.btn-guardar')
            .addEventListener('click', () => {
                let nombre = document.querySelector('input[name="nombre"]').value; // Obtiene el valor del nombre del autor
                let id = document.querySelector('#identificador').value; // Obtiene el ID del autor
                axios.post(`http://localhost/Proyecto_Final_MVC-PHP/autores/${id === "" ? 'create' : 'update'}`, {
                        nombre,
                        id
                    })
                    .then((r) => {
                        let info = r.data; // Obtiene la información del autor desde la respuesta de la petición
                        if (id === "") { // Si el ID está vacío, se trata de una creación
                            let tr = document.createElement("tr"); // Crea una nueva fila en la tabla
                            tr.setAttribute('data-id', info.id); // Establece el atributo data-id de la fila con el ID del nuevo autor
                            tr.innerHTML = `<td>${info.id}</td>
                                            <td>${info.nombre}</td>
                                            <td><button class='btn btn-warning btnEditar'>Editar</button>
                                            <button class='btn btn-danger btnEliminar'>Eliminar</button></td>`; // Añade el contenido HTML para la fila
                            document.getElementById("table").querySelector("tbody").append(tr); // Añade la nueva fila al cuerpo de la tabla
                            // Agrega eventos click a los botones de editar y eliminar de la nueva fila
                            tr.querySelector('.btnEditar').addEventListener('click', fetchAutor);
                            tr.querySelector('.btnEliminar').addEventListener('click', deleteAutor);
                        } else { // Si el ID no está vacío, se trata de una actualización
                            let tr = document.querySelector(`tr[data-id="${id}"]`); // Selecciona la fila correspondiente
                            let cols = tr.querySelectorAll("td"); // Obtiene todas las celdas de la fila
                            cols[1].textContent = info.nombre; // Actualiza el nombre del autor en la fila
                        }
                        myModal.hide(); // Oculta el modal
                    });
            });

        // Agrega eventos click a todos los botones de editar y eliminar ya presentes en la tabla
        document.querySelectorAll('.btnEditar').forEach(btn => btn.addEventListener('click', fetchAutor));
        document.querySelectorAll('.btnEliminar').forEach(btn => btn.addEventListener('click', deleteAutor));
    </script>
</body>
</html>
