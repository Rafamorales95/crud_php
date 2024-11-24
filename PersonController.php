<?php


require_once 'database.php';
require_once 'usuario.php';

class PersonController
{
    private $usuario;

    public function __construct()
    {
        // Crear la conexión a la base de datos
        $db = new Database();
        $conn = $db->conectar();

        // Instanciar la clase Usuario
        $this->usuario = new Usuario($conn);
    }

    public function crear($nombre, $email)
    {
        return $this->usuario->crear($nombre, $email);
    }

    // Leer todos los usuarios
    public function leerTodos()
    {
        return $this->usuario->obtenerTodos();
    }

    // Obtener un usuario por ID
    public function leerPorId($id)
    {
        return $this->usuario->obtenerPorId($id);
    }

    // Actualizar un usuario existente
    public function actualizar($id, $nombre, $email)
    {
        return $this->usuario->actualizar($id, $nombre, $email);
    }

    // Eliminar un usuario
    public function eliminar($id)
    {
        return $this->usuario->eliminar($id);
    }
}


