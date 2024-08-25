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
