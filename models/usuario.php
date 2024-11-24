<?php
require_once 'database.php';

class Usuario {
    private $conn;
    private $table = 'usuarios';

    public $id;
    public $nombre;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    // crear un nuevo usuario
    public function crear($nombre, $email) {
        $query = "INSERT INTO " . $this->table . " (nombre, email) VALUES (:nombre, :email)";

        $stmt = $this->conn->prepare($query);

        $nombre = htmlspecialchars(strip_tags($nombre));
        $email = htmlspecialchars(strip_tags($email));

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Método para obtener todos los usuarios
    public function obtenerTodos() {
        $query = "SELECT id, nombre, email FROM " . $this->table . " ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los registros
    }

    // Obtener un usuario por su ID
    public function obtenerPorId($id) {
        $query = "SELECT id, nombre, email FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un solo usuario
    }

    // Método para actualizar un usuario
    public function actualizar($id, $nombre, $email) {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $nombre = htmlspecialchars(strip_tags($nombre));
        $email = htmlspecialchars(strip_tags($email));

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // eliminar un usuario
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
