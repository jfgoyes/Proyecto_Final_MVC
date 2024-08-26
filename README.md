
# Aplicación Web en PHP con el Modelo MVC para la Gestión de Libros y Autores 

A continuación se mostrará una breve explicación de cada parte implementada en la creación de la aplicación web con el modelo MVC-PHP.

## Instrucciones para ejecutar la aplicación

### Paso 1: Descargar en instalar un servidor local

Primeramente se debe tener en cuenta que se necesita de un servidor local a elección, en este caso se utilizó XAMPP de Apache.

Enlace página oficial XAMPP: https://www.apachefriends.org/es/index.html

En el enlace anterior es posible descargar e instalar este servidor local.

### Paso 2: Inicializar el servidor local y descargar el proyecto

Una vez se tenga instalado XAMPP, se lo debe ejecutar e inicializar las dos primeras opciones que son Apache y MySQL, basta con darle click en "Start".

Una vez listo el servidor local, se procede a descargar el proyecto respectivo, en este caso de nombre Proyecto_Final_MVC-PHP, en formato .zip, una vez descargado darle click derecho y buscar la opción extraer aqui, aparecerá una carpeta del mismo nombre, esa carpeta debe ser copiada y pegada dentro de la carpeta htdocs que se encuentra en la dirección donde se haya instalado el servidor local, por lo general suele ser en C:\xampp\htdocs.

### Paso 3: Ingreso al proyecto desde Visual Studio Code

Una vez ubicada la carpeta del proyecto en el directorio correspondiente, se debe proceder a abrir Visual Studio Code.

En caso de que se requiera descargar e instalar el mismo, se especifica el siguiente enlace: https://code.visualstudio.com/ el cual direcciona a la página oficial de visual studio.

Dentro de Visual Studio Code, dirigirse hacia la parte superior izquierda sección "File", luego buscar la opción "Open Folder" y buscar la carpeta anteriormente ubicada en htdocs de nombre Proyecto_Final_MVC, apenas se abra la carpeta se mostrarán todas las implementaciones.

### Paso 4: Creación de la base de datos en XAMPP phpMyAdmin

Una vez completados todos los pasos anteriores, se procede a crear una base de datos en MySQL phpMyAdmin presente en XAMPP, para ello es de dirigirse al servidor local, buscar MySQL y darle click en la opción "Admin", automáticamente abrirá el navegador, mostrando phpMyAdmin.

**Base de datos:** Una vez dentro de phpMyAdmin, se debe crear una base de datos de nombre proyecto_final_mvc-php (El nombre debe ser tal cual como se menciona, sin embargo es posible cambiarlo en la parte de los modelos DB.php dentro de Visual Studio Code).

**Tabla autores:** Una vez creada la base de datos se procede a crear la tabla autores con el siguiente código:

```
  CREATE TABLE autores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);
```
Luego de haber digitado el código, se debe proceder a ejecutarlo, para ello se dará click en la opción continuar presente en la parte inferior izquierda.

**Tabla libros:** Una vez se haya creado la tabla mencionada anteriormente, se procede a crear la tabla libros, para ello se digita el siguiente código (en una nueva consulta):

```
  CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor_id INT NOT NULL,
    fecha_publicacion DATE,
    FOREIGN KEY (autor_id) REFERENCES autores(id)
);
```
Luego de digitar el código se procede a ejecutarlo realizando los mismos pasos que la anterior tabla creada.

### Paso 5: Aplicación web en el navegador utilizando XAMPP

Por último, se procede a abrir la aplicación web en el navegador utilizando el servidor local.

Para entrar en la página de inicio de la aplicación, se digitará lo siguiente (mientras se tiene abierto XAMPP en segundo plano): localhost/Proyecto_Final_MVC-PHP/inicio

Una vez digitada la ruta anterior, se presionará la tecla "enter" y automáticamente aparecerá la página de inicio de la aplicación respectiva, asi también en la misma página es posible navegar hacia la gestión de libros como la gestión de autores correspondientemente.

### Funcionalidad para gestionar Libros y autores

Una aclaración adicional respecto a la aplicación web esta en que, la tabla libros es una tabla subordinada de la tabla autores, puesto que un autor puede tener varios libros, cumpliendose una relación uno a varios.

Para agregar un autor, basta con darle click en el botón agregar, aparecerá una interfaz para digitar el nómbre cualquiera del autor.

Asi también, es posible editar y eliminar cualquier autor agregado posteriormente.

Para agregar un libro, se realiza el mismo procedimiento, solo que en caso de que no exista ningun autor agregado, el campo autor aparecerá vacío, de igual forma la gestión de libros tambiñen cuenta con opciones para editar y eliminar libros creados.
## Estructura del proyecto aplicación web MVC-PHP

## Parte 1: Controladores

### 1.- Archivo controlador para los autores de nombre AutoresController.php

Para este apartado se procedió a implementar una clase de nombre AutoresController la cual se encargará de gestionar las solicitudes relacionadas con los autores.

### Código implementado

```php
    <?php

// Definición de la clase AutoresController que maneja las solicitudes relacionadas con los autores
class AutoresController {
    
    // Método para mostrar todos los autores
    public function index()
    {
        // Obtiene todos los registros de autores desde la base de datos usando el modelo Autor
        $autores = Autor::all();
        
        // Renderiza la vista "autores.index" pasando los datos de los autores a la vista
        view("autores.index", ["autores" => $autores]);
    }

    // Método para mostrar un mensaje indicando que estamos en el proceso de crear un autor
    public function crear()
    {
        // Muestra un mensaje en la salida estándar
        echo "Estamos en crear autor";
    }

    // Método para crear un nuevo autor basado en datos recibidos en formato JSON
    public function create()
    {
        // Lee el contenido JSON enviado en la solicitud y lo decodifica en un objeto PHP
        $data = json_decode(file_get_contents('php://input'));
        
        // Crea una nueva instancia del modelo Autor
        $autor = new Autor();
        
        // Asigna el nombre del autor desde los datos decodificados
        $autor->nombre = $data->nombre;
        
        // Guarda el nuevo autor en la base de datos
        $autor->save();
        
        // Retorna los datos del autor recién creado en formato JSON
        echo json_encode($autor);
    }

    // Método para actualizar un autor existente basado en datos recibidos en formato JSON
    public function update()
    {
        // Lee el contenido JSON enviado en la solicitud y lo decodifica en un objeto PHP
        $data = json_decode(file_get_contents('php://input'));
        
        // Busca un autor existente en la base de datos por su ID
        $autor = Autor::find($data->id);
        
        // Actualiza el nombre del autor con el nuevo valor proporcionado
        $autor->nombre = $data->nombre;
        
        // Guarda los cambios en la base de datos
        $autor->save();
        
        // Retorna los datos del autor actualizado en formato JSON
        echo json_encode($autor);
    }

    // Método para eliminar un autor basado en su ID
    public function delete($id)
    {
        try {
            // Busca el autor a eliminar en la base de datos por su ID
            $autor = Autor::find($id);
            
            // Elimina el autor de la base de datos
            $autor->remove();
            
            // Retorna un JSON indicando que la eliminación fue exitosa
            echo json_encode(['status' => true]);
        } catch (\Exception $e) {
            // En caso de error, retorna un JSON indicando que la eliminación falló
            echo json_encode(['status' => false]);
        }
    }
}
?>
```
### 2.- Archivo controlador para los libros de nombre LibrosController.php

Para este apartado se procedió a implementar una clase de nombre LibrosController la cual se encargará de gestionar las solicitudes relacionadas con los libros.

### Código implementado

```php
<?php

// Definición de la clase LibrosController que maneja las solicitudes relacionadas con los libros
class LibrosController
{
    // Método para mostrar todos los libros y autores
    public function index()
    {
        // Obtiene todos los registros de libros desde la base de datos usando el modelo Libro
        $libros = Libro::all();
        
        // Obtiene todos los registros de autores desde la base de datos usando el modelo Autor
        // Esto es útil para mostrar una lista de autores en un menú desplegable o similar en la vista
        $autores = Autor::all();
        
        // Renderiza la vista "libros.index" pasando los datos de los libros y los autores a la vista
        view("libros.index", ["libros" => $libros, "autores" => $autores]);
    }

    // Método para mostrar un mensaje indicando que estamos en el proceso de crear un libro
    public function crear()
    {
        // Muestra un mensaje en la salida estándar
        echo "Estamos en crear libro";
    }

    // Método para crear un nuevo libro basado en datos recibidos en formato JSON
    public function create()
    {
        // Lee el contenido JSON enviado en la solicitud y lo decodifica en un objeto PHP
        $data = json_decode(file_get_contents('php://input'));
        
        // Crea una nueva instancia del modelo Libro
        $libro = new Libro();
        
        // Asigna el título del libro desde los datos decodificados
        $libro->titulo = $data->titulo;
        
        // Asigna el ID del autor al libro desde los datos decodificados
        $libro->autor_id = $data->autor_id;
        
        // Asigna la fecha de publicación del libro desde los datos decodificados
        $libro->fecha_publicacion = $data->fecha_publicacion;
        
        // Guarda el nuevo libro en la base de datos
        $libro->save();
        
        // Retorna los datos del libro recién creado en formato JSON
        echo json_encode($libro);
    }

    // Método para actualizar un libro existente basado en datos recibidos en formato JSON
    public function update()
    {
        // Lee el contenido JSON enviado en la solicitud y lo decodifica en un objeto PHP
        $data = json_decode(file_get_contents('php://input'));
        
        // Busca un libro existente en la base de datos por su ID
        $libro = Libro::find($data->id);
        
        // Actualiza el título del libro con el nuevo valor proporcionado
        $libro->titulo = $data->titulo;
        
        // Actualiza el ID del autor del libro con el nuevo valor proporcionado
        $libro->autor_id = $data->autor_id;
        
        // Actualiza la fecha de publicación del libro con el nuevo valor proporcionado
        $libro->fecha_publicacion = $data->fecha_publicacion;
        
        // Guarda los cambios en la base de datos
        $libro->save();
        
        // Retorna los datos del libro actualizado en formato JSON
        echo json_encode($libro);
    }

    // Método para eliminar un libro basado en su ID
    public function delete($id)
    {
        try {
            // Busca el libro a eliminar en la base de datos por su ID
            $libro = Libro::find($id);
            
            // Elimina el libro de la base de datos
            $libro->remove();
            
            // Retorna un JSON indicando que la eliminación fue exitosa
            echo json_encode(['status' => true]);
        } catch (\Exception $e) {
            // En caso de error, retorna un JSON indicando que la eliminación falló
            echo json_encode(['status' => false]);
        }
    }
}
?>
```
### 3.- Archivo controlador para la página de inicio de nombre InicioController.php

En este punto solo se implementó una pequeña sentencia que se encargará de redirigir la petición url hacia la página de inicio principal.

### Código implementado

```php
<?php
class InicioController {
    public function index() {
        view("inicio.index", []);
    }
}
```
## Parte 2: Modelos

### 1.- Archivo clase DB encargada de manejar e interconectar el servicio MySQL hacia los modelos correspondientes Autor y Libro, de nombre DB.php

En la base de datos se especifica el método de conexión, en este caso MySQL de donde se podrá ingresar directamente desde XAMPP, por este hecho se procede a definir el tipo de host como localhost, el nombre de la base de datos a crear en este caso proyecto_final_mvc-php, el usuario como root y sin contraseña, con el fin de agilizar el proceso de ingreso.

### Código implementado

```php
<?php

// Definición de la clase DB que extiende la clase PDO
// La clase DB se utiliza para gestionar la conexión a la base de datos
class DB extends PDO
{
    // Constructor de la clase DB
    public function __construct()
    {
        // Define el DSN (Data Source Name) para la conexión a la base de datos MySQL
        // 'host' especifica el servidor de base de datos, 'dbname' especifica el nombre de la base de datos
        $dsn = "mysql:host=localhost;dbname=proyecto_final_mvc-php";
        
        // Llama al constructor de la clase PDO para establecer la conexión a la base de datos
        // El DSN se pasa como primer argumento, el nombre de usuario como segundo, y la contraseña como tercero
        // En este caso, el nombre de usuario es "root" y la contraseña está vacía
        parent::__construct($dsn, "root", "");
    }
}
?>
```
### 2.- Archivo clase modelo para los autores de nombre Autor.php

En esta implementación se optó por ingresar funciones para mostrar los autores presentes en la base de datos establecida, de esta forma generando un modelo de la tabla presente en la mencionada, para este caso la entidad/tabla autores de la base de datos, será contenedora de dos atributos que son el identificador "id" y el nombre.

### Código implementado

```php
<?php

// Definición de la clase Autor que hereda de la clase DB
// La clase Autor representa un modelo de datos para la tabla 'autores' en la base de datos
class Autor extends DB
{
    // Propiedades públicas para almacenar los datos del autor
    public $id;       // Identificador único del autor
    public $nombre;   // Nombre del autor

    // Método estático para obtener todos los autores de la base de datos
    public static function all()
    {
        // Crea una nueva instancia de la clase DB para interactuar con la base de datos
        $db = new DB();
        
        // Prepara una consulta SQL para seleccionar todos los registros de la tabla 'autores'
        $prepare = $db->prepare("SELECT * FROM autores");
        
        // Ejecuta la consulta SQL
        $prepare->execute();
        
        // Recupera todos los registros como objetos de la clase Autor y los retorna
        return $prepare->fetchAll(PDO::FETCH_CLASS, Autor::class);
    }

    // Método estático para encontrar un autor por su ID
    public static function find($id)
    {
        // Crea una nueva instancia de la clase DB para interactuar con la base de datos
        $db = new DB();
        
        // Prepara una consulta SQL para seleccionar un registro de la tabla 'autores' donde el ID coincida
        $prepare = $db->prepare("SELECT * FROM autores WHERE id=:id");
        
        // Ejecuta la consulta SQL pasando el ID como parámetro
        $prepare->execute([":id" => $id]);
        
        // Recupera el registro como un objeto de la clase Autor y lo retorna
        return $prepare->fetchObject(Autor::class);
    }

    // Método para guardar o actualizar un autor en la base de datos
    public function save()
    {
        // Prepara los parámetros para la consulta SQL
        $params = [":nombre" => $this->nombre];
        
        // Si el autor no tiene ID, se considera una nueva entrada
        if (empty($this->id)) {
            // Prepara una consulta SQL para insertar un nuevo registro en la tabla 'autores'
            $prepare = $this->prepare("INSERT INTO autores(nombre) VALUES (:nombre)");
            
            // Ejecuta la consulta SQL con los parámetros
            $prepare->execute($params);
            
            // Establece el ID del autor a partir del ID del último registro insertado
            $this->id = $this->lastInsertId();
        } else {
            // Si el autor tiene un ID, se considera una actualización
            $params[":id"] = $this->id;
            
            // Prepara una consulta SQL para actualizar el registro existente en la tabla 'autores'
            $prepare = $this->prepare("UPDATE autores SET nombre=:nombre WHERE id=:id");
            
            // Ejecuta la consulta SQL con los parámetros
            $prepare->execute($params);
        }
    }

    // Método para eliminar un autor de la base de datos
    public function remove()
    {
        // Prepara una consulta SQL para eliminar un registro de la tabla 'autores' donde el ID coincida
        $prepare = $this->prepare("DELETE FROM autores WHERE id=:id");
        
        // Ejecuta la consulta SQL pasando el ID como parámetro
        $prepare->execute([":id" => $this->id]);
    }
}
?>
```
### 3.- Archivo clase modelo para los libros de nombre Libro.php

Al igual que la anterior implementación, en este caso se especificaron funciones para mostrar los libros presentes en la base de datos establecida, de esta forma generando un modelo de la tabla presente en la mencionada, sin embargo, se muestra una situacióon importante la cual es la relación con la tabla autores, debido a que un autor puede tener varios libros, de este modo la entidad autores y libros tendrían una relación de uno a varios respectivamente, para este caso la entidad/tabla libros de la base de datos, será contenedora de cuatro atributos que son el identificador "id", el título, el identificador del autor por ser una entidad subordinada y la fecha de publicación.

### Código implementado

```php
<?php

// Definición de la clase Libro que extiende la clase DB
// La clase Libro representa un modelo de datos para la tabla 'libros' en la base de datos
class Libro extends DB
{
    // Propiedades públicas para almacenar los datos del libro
    public $id;               // Identificador único del libro
    public $titulo;           // Título del libro
    public $autor_id;         // ID del autor del libro
    public $fecha_publicacion; // Fecha de publicación del libro

    // Método estático para obtener todos los libros de la base de datos
    public static function all()
    {
        // Crea una nueva instancia de la clase DB para interactuar con la base de datos
        $db = new DB();
        
        // Prepara una consulta SQL para seleccionar todos los registros de la tabla 'libros'
        $prepare = $db->prepare("SELECT * FROM libros");
        
        // Ejecuta la consulta SQL
        $prepare->execute();
        
        // Recupera todos los registros como objetos de la clase Libro y los retorna
        return $prepare->fetchAll(PDO::FETCH_CLASS, Libro::class);
    }

    // Método estático para encontrar un libro por su ID
    public static function find($id)
    {
        // Crea una nueva instancia de la clase DB para interactuar con la base de datos
        $db = new DB();
        
        // Prepara una consulta SQL para seleccionar un registro de la tabla 'libros' donde el ID coincida
        $prepare = $db->prepare("SELECT * FROM libros WHERE id=:id");
        
        // Ejecuta la consulta SQL pasando el ID como parámetro
        $prepare->execute([":id" => $id]);
        
        // Recupera el registro como un objeto de la clase Libro y lo retorna
        return $prepare->fetchObject(Libro::class);
    }

    // Método para guardar o actualizar un libro en la base de datos
    public function save()
    {
        // Prepara los parámetros para la consulta SQL
        $params = [
            ":titulo" => $this->titulo,
            ":autor_id" => $this->autor_id,
            ":fecha_publicacion" => $this->fecha_publicacion
        ];
        
        // Si el libro no tiene ID, se considera una nueva entrada
        if (empty($this->id)) {
            // Prepara una consulta SQL para insertar un nuevo registro en la tabla 'libros'
            $prepare = $this->prepare("INSERT INTO libros(titulo, autor_id, fecha_publicacion) VALUES (:titulo, :autor_id, :fecha_publicacion)");
            
            // Ejecuta la consulta SQL con los parámetros
            $prepare->execute($params);
            
            // Establece el ID del libro a partir del ID del último registro insertado
            $this->id = $this->lastInsertId();
        } else {
            // Si el libro tiene un ID, se considera una actualización
            $params[":id"] = $this->id;
            
            // Prepara una consulta SQL para actualizar el registro existente en la tabla 'libros'
            $prepare = $this->prepare("UPDATE libros SET titulo=:titulo, autor_id=:autor_id, fecha_publicacion=:fecha_publicacion WHERE id=:id");
            
            // Ejecuta la consulta SQL con los parámetros
            $prepare->execute($params);
        }
    }

    // Método para eliminar un libro de la base de datos
    public function remove()
    {
        // Prepara una consulta SQL para eliminar un registro de la tabla 'libros' donde el ID coincida
        $prepare = $this->prepare("DELETE FROM libros WHERE id=:id");
        
        // Ejecuta la consulta SQL pasando el ID como parámetro
        $prepare->execute([":id" => $this->id]);
    }
}
?>
```
## Parte 3: Utilidades

### 1.- Archivo por defecto de nombre defaults.php

Para este apartado se procedió a implementar un archivo el cual tiene como finalidad realizar una inclusión dinámica de vistas en la estructura de archivos que se está creando, esto lo logra realizando un intercambio de parámetroos sin la necesidad de usar variables globales o modificaciones dirigidas hacia el alcance de las variables.

### Código implementado
```php
<?php

if (!function_exists("view")) {
    function view($nombreVista, $params)
    {
        foreach ($params as $key => $param) {
            $$key = $param;
        }
        $vista = explode('.', $nombreVista);
        include_once "./views/{$vista[0]}/$vista[1].php";
    }
}
```
## Parte 4: Vistas

### 1.- Vista para la página principal presente en la carpeta inicio/archivo index.php

La creación de esta estructura, está dirigida a la página principal de la aplicacion web, para el diseño de la interfaz se utiliza una combinación entre boostrap y CSS, asi también se aplican modales y axios correspondientes para las respectivas peticiones.

### Código implementado
```php
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
```
### 2.- Vista para la sección Lista de autores presente en autores/ archivo index.php

La implementación mostrada, está orientada a la parte visual de la gestión de autores correspondientemente, al igual que en la página de inicio, se aplican los conceptos de boostrap junto a CSS, implementacióon de modales y axios para las peticiones.

### Código implementado
```php
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
```
### 3.- Vista para la sección Lista de libros presente en libros/ archivo index.php

Al igual que la implementación de la parte visual para los autores, la parte visual para los libros se mantiene con las mismas estructuras tanto para la interfaz como para las peticiones correspondientes.

### Código implementado
```php
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
                                            <td>${info.autor_nombre}</td>
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
```
## Parte 5: Router y implementación para direccionar rutas amigables

### 1.- Estructura del archivo router.php

Para la estructura funcional del router, se optó por incluir todas las rutas referentes a los modelos creados anteriormente, como lo son la base de datos, el modelo para los libros y los autores, toda la búsqueda de las URLs las realiza mediante identificadores para cada modelo correspondiente.

### Código implementado
```php
<?php
// Incluye el archivo de configuración que puede definir valores predeterminados o utilidades generales para el proyecto
include_once "utils/defaults.php";

// Incluye el archivo que contiene la clase para la gestión de la base de datos
include_once "models/DB.php";

// Incluye el archivo que contiene la clase del modelo para los libros
include_once "models/Libro.php";

// Incluye el archivo que contiene la clase del modelo para los autores
include_once "models/Autor.php";

// Obtiene el nombre del controlador a partir de los parámetros de la URL
$controller = $_GET['controller'];

// Obtiene la acción que el controlador debe realizar a partir de los parámetros de la URL
$action = $_GET['action'];

// Obtiene el identificador (id) a partir de los parámetros de la URL, si está presente
$id = $_GET['id'];

// Si la acción no está especificada en la URL, se asigna la acción por defecto "index"
if (empty($action))
    $action = "index";

// Construye el nombre completo de la clase del controlador añadiendo "Controller" al nombre del controlador obtenido de la URL
$ctrlName = $controller . "Controller";

// Incluye el archivo del controlador correspondiente basado en el nombre de la clase
include "./controllers/$ctrlName.php";

// Crea una instancia del controlador
$ctrl = new $ctrlName;

// Llama al método correspondiente del controlador usando la acción obtenida de la URL y pasa el id si está presente
$ctrl->{$action}($id);
```
### 2.- Estructura del archivo .htaccess

La estructura implementada para el archivo de configuración, se basa en la petición de rutas dirigidas directamente hacia el router implementado.

### Código implementado
```php
RewriteEngine On
RewriteRule ^([a-z]+)\/?([a-z]*)\/?([0-9]*)$ router.php?controller=$1&action=$2&id=$3
```
## Documentación

## Estructura de todo el proyecto realizado

A continuación se detallará la estructura general del proyecto MVC-PHP realizado.

### 1. Carpeta principal de nombre Proyecto_Final_MVC-PHP

Esta es la carpeta principal donde se especifican todas las demas subcarpetas encargadas de almacenar los archivos de configuración y las implementaciones que se realizen respectivamente.

Dentro de esta carpeta existen las subcarpetas controllers, models, utils y views.

Sin embargo también tiene ubicados directamente los archivos .htaccess y router.php.

### 2. Subcarpeta controllers

Esta subcarpeta contenida dentro de la principal, se encarga de contener todos los controladores respectivos llamados como AutoresController.php, LibrosController.php y InicioController.php. 

Los cuales gestionan la lógica de la aplicación como tal, asi como la interacción con el modelo correspondiente de la aplicación.

### 3. Subcarpeta models

En esta subcarpeta se encuentran las clases que representan todos los datos y las operaciones que se realizarán sobre ellos, en este caso se encuentran implemetadas las clases DB.php para la base de datos, Autor.php para los autores y Libro.php para el modelo de los libros respectivamente.

### 4. Subcarpeta utils

En esta subcarpeta se encuentra el archivo de nombre defaults.php que se encarga principalmente de realizar una inclusión dinámica de vistas en la estructura de los archivos que se crearón anteriormente en las otras subcarpetas correspondeintes.

Esta inclusión la logra realizando un intercambio de parámetroos sin la necesidad de usar variables globales o modificaciones dirigidas hacia el alcance de las variables.

### 5. Subcarpeta views

Siendo la subcarpeta encargada me mostrar las interfaces de la aplicación web, se optó por dividir cada interfaz en otras subcarpetas diferentes para cada sección, quedando de la siguiente manera.

### 5.1. Subcarpeta inicio

Contiene el archivo con la plantilla de vista para el usuario, el nómbre del archivo está denotado como index.php, al estar orientada para ser la página principal, se destaca la barra de navegación con la posibilidad de dirigirse hacia las otras secciones correspondientes.

### 5.2. Subcarpeta autores

Contiene el archivo encargado de mostrar la interfaz de la gestión de autores correspondientes, al igual que la plantilla de inicio, el archivo de esta subcarpeta es de nombre index.php.

### 5.3. Subcarpeta libros

Al igual que la subcarpeta autores, esta subcarpeta contiene el archivo encargado de mostrar la interfaz de la gestión de libros correspondientes.

## Funcionamiento del router en el diseño

El archivo llamado router.php es el nucleo de todo el proyecto, ya que su función principal es la de dirigir las solicitudes tanto a los controladores como a las acciones correspondientes, basándose en los parámetros presentes en la URL.

**Lo que realiza en su estructura:**
- *Incluir archivos necesarios:* Incluye los archivos defaults.php, DB.php, Libro.php y Autor.php, lo que permite usar sus funciones y clases en el enrutador.
- *Obtener parámetros de la URL:* Extrae los parámetros controller, action e id de la URL. Estos parámetros determinan qué controlador y acción se deben ejecutar.
- *Controlador predeterminado:* Si action no está especificado, se asigna un valor predeterminado "index".
- *Incluir y crear controlador:* Incluye el archivo del controlador correspondiente (nombrado como NombreController.php) y crea una instancia del controlador.
- *Llamar a la acción del controlador:* Llama al método correspondiente en el controlador con el parámetro id, si está presente.

## Funcionamiento de .htaccess en el diseño

El archivo .htaccess se usa para reescribir URLs, permitiendo que las URLs sean más limpias y amigables para el usuario.

**Funcionalidad de su estructura:**
- *Reescritura de URL:* Utiliza RewriteRule para transformar las URLs amigables en parámetros que router.php puede entender.
- *Regla de reescritura:* La regla ^([a-z]+)\/?([a-z]*)\/?([0-9]*)$ captura tres grupos:
  - ([a-z]+): El nombre del controlador.
  - ([a-z]*): La acción que el controlador debe realizar.
  - ([0-9]*): Un identificador opcional.
- *Redirección:* Redirige las solicitudes a router.php con los parámetros correspondientes, como controller, action e id.

## Funcionamiento y uso de Axios en el diseño

Principalmente Axios se utiliza para gestionar la interacción entre el frontend (la vista en HTML) y el backend (el servidor).

En el diseño implementado, Axios juega un papel crucial en la carga, actualización y eliminación de datos sin necesidad de recargar la página. 

A continuación se explica la funcionalidad respectiva.

### Axios en la implementación fetchAutoor presente en la interfaz para la gestión de autores

En primera instancia Axios principalmente se usa para cargar datos específicos cuando el usuario desea editar un autor o un libro.

Para autor tenemos Axios en la siguiente parte presente en la subcarpeta views/autores/index.php:

- **Función fetchAutor**:
```
  javascript
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
```

En esta parte, Axios realiza una solicitud GET para obtener los datos del autor que se va a editar. La respuesta de la solicitud se usa para llenar los campos del modal con la información del autor seleccionado.

### Axios en la implementación fetchLibro presente en la interfaz para la gestión de libros

Para libro tenemos Axios en la siguiente parte presente en la subcarpeta views/libros/index.php:

- **Función fetchLibro**:
```
  javascript
  const fetchLibro = (event) => {
    let id = event.target.closest('tr').dataset.id;
    axios.get(`http://localhost/Proyecto_Final_MVC-PHP/libros/find/${id}`).then((res) => {
      let info = res.data;
      document.querySelector("#librosModalLabel").textContent = "Editar Libro";
      document.querySelector('input[name="titulo"]').value = info.titulo;
      document.querySelector('select[name="autor_id"]').value = info.autor_id;
      document.querySelector('input[name="fecha_publicacion"]').value = info.fecha_publicacion;
      document.querySelector('#identificador').value = id;
      myModal.show();
    });
  }
```
Esta función hace algo similar pero para los libros. Axios se utiliza para obtener los datos del libro que se va a editar y llenar el modal con esa información respectivamente.

### Axios en la implementación btn-guardar presente en la interfaz para la gestión de autores

Axios también se utiliza para enviar datos al servidor con la finalidad de crear o actualizar registros.

Para autor tenemos Axios en la siguiente parte presente en la subcarpeta views/autores/index.php:

- **Función btn-guardar**:
```
  javascript
  document.querySelector('.btn-guardar')
    .addEventListener('click', () => {
      let nombre = document.querySelector('input[name="nombre"]').value;
      let id = document.querySelector('#identificador').value;
      axios.post(`http://localhost/Proyecto_Final_MVC-PHP/autores/${id === "" ? 'create' : 'update'}`, {
          nombre,
          id
        })
        .then((r) => {
          let info = r.data;
          if (id === "") {
            let tr = document.createElement("tr");
            tr.setAttribute('data-id', info.id);
            tr.innerHTML = `<td>${info.id}</td>
                            <td>${info.nombre}</td>
                            <td><button class='btn btn-warning btnEditar'>Editar</button>
                            <button class='btn btn-danger btnEliminar'>Eliminar</button></td>`;
            document.getElementById("table").querySelector("tbody").append(tr);
            tr.querySelector('.btnEditar').addEventListener('click', fetchAutor);
            tr.querySelector('.btnEliminar').addEventListener('click', deleteAutor);
          } else {
            let tr = document.querySelector(`tr[data-id="${id}"]`);
            let cols = tr.querySelectorAll("td");
            cols[1].textContent = info.nombre;
          }
          myModal.hide();
        });
    });
```
Aquí, Axios se usa para enviar una solicitud POST al servidor, indicando si se está creando un nuevo autor o actualizando uno existente. Dependiendo del ID, el servidor procesa la solicitud y responde con los datos actualizados. Luego, el frontend actualiza la tabla con la nueva información.

### Axios en la implementación btn-guardar presente en la interfaz para la gestión de libros

Para libros tenemos Axios en la siguiente parte presente en la subcarpeta views/libros/index.php:

- **Función btn-guardar**:
```
  javascript
  document.querySelector('.btn-guardar')
    .addEventListener('click', () => {
      let titulo = document.querySelector('input[name="titulo"]').value;
      let autor_id = document.querySelector('select[name="autor_id"]').value;
      let fecha_publicacion = document.querySelector('input[name="fecha_publicacion"]').value;
      let id = document.querySelector('#identificador').value;
      axios.post(`http://localhost/Proyecto_Final_MVC-PHP/libros/${id === "" ? 'create' : 'update'}`, {
          titulo,
          autor_id,
          fecha_publicacion,
          id
        })
        .then((r) => {
          let info = r.data;
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
            tr.querySelector('.btnEditar').addEventListener('click', fetchLibro);
            tr.querySelector('.btnEliminar').addEventListener('click', deleteLibro);
          } else {
            let tr = document.querySelector(`tr[data-id="${id}"]`);
            let cols = tr.querySelectorAll("td");
            cols[1].textContent = info.titulo;
            cols[2].textContent = info.autor_id;
            cols[3].textContent = info.fecha_publicacion;
          }
          myModal.hide();
        });
    });
```
Esta función también utiliza Axios para enviar una solicitud POST para crear o actualizar un libro, y actualiza la tabla en consecuencia.

### Axios en la implementación deleteAutor presente en la interfaz para la gestión de autores

Axios se utiliza para eliminar registros, enviando una solicitud DELETE al servidor.

Para autor tenemos Axios en la siguiente parte presente en la subcarpeta views/autores/index.php:

- **Función deleteAutor**:
```
  javascript
  const deleteAutor = (event) => {
    let id = event.target.closest('tr').dataset.id;
    axios.delete(`http://localhost/Proyecto_Final_MVC-PHP/autores/delete/${id}`).then((res) => {
      let info = res.data;
      if (info.status) {
        document.querySelector(`tr[data-id="${id}"]`).remove();
      }
    });
  }
```
No hace falta mostrar la implementación de ambas partes, debido a que en ambas funciones, Axios envía una solicitud DELETE para eliminar el registro correspondiente. Si la eliminación es exitosa, la fila correspondiente se elimina de la tabla correspondiente.

## Autores

- [@Hernández Ojeda Jonathan Rodrigo](https://micampusvirtual.espe.edu.ec/)
- [@Cantuña Cela Carlos Eduardo](https://micampusvirtual.espe.edu.ec/)
- [@Goyes Arcalle Job Francesco](https://micampusvirtual.espe.edu.ec/)
