<?php
class Usuario {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function crear($data) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, correo, contrasena, matricula) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nombre'], $data['correo'], $data['contrasena'], $data['matricula']);
        return $stmt->execute();
    }
}
?>