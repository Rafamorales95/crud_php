<?php

require_once 'database.php';

class Database {

    private $host = 'localhost'; // Cambia esto según tu configuración
    private $dbname = 'root';
    private $username = 'reservsas';
    private $password = '';

    public function conectar() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }
        return $this->conn;
    }
}
