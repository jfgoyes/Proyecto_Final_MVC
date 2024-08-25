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
