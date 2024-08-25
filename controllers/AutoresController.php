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
