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
