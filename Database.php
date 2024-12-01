<?php
class Database {
    private $host = 'db';
    private $db_name = 'app';
    private $username = 'app';
    private $password = 'app';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
            exit;
        }

        return $this->conn;
    }
}
