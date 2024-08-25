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
