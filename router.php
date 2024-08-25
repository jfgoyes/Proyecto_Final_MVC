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
