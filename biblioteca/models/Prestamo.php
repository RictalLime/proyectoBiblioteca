<?php
class Prestamo {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function prestar($data) {
        $stmt = $this->conn->prepare("INSERT INTO prestamos (usuario_id, isbn) VALUES (?, ?)");
        $stmt->bind_param("is", $data['usuario_id'], $data['isbn']);
        return $stmt->execute();
    }
}
?>