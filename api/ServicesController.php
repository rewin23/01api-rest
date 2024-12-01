<?php

include_once 'Database.php';
include_once 'config.php';

class ServicesController {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function index() {
        $query = "SELECT * FROM services WHERE activo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id) {
        $query = "SELECT * FROM services WHERE id = :id AND activo = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function store($data) {
        $query = "INSERT INTO services (titulo, descripcion, activo) VALUES (:titulo, :descripcion, :activo)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titulo', $data['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(':activo', $data['activo'], PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            return ['success' => true, 'id' => $this->conn->lastInsertId()];
        } else {
            return ['success' => false, 'error' => 'No se pudo crear el servicio'];
        }
    }
}
