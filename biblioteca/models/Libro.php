<?php
class Libro {
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function disponibilidad($isbn) {
        $stmt = $this->conn->prepare("SELECT cantidad > 0 AS disponibilidad FROM libros WHERE isbn = ?");
        $stmt->bind_param("s", $isbn);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function buscar($params) {
        $query = "SELECT * FROM libros WHERE 1=1";
        $types = "";
        $values = [];
        foreach (["nombre", "autor", "isbn", "anio", "genero"] as $key) {
            if (!empty($params[$key])) {
                $query .= " AND $key LIKE ?";
                $types .= "s";
                $values[] = "%" . $params[$key] . "%";
            }
        }
        $stmt = $this->conn->prepare($query);
        if ($types) $stmt->bind_param($types, ...$values);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function crear($data) {
        $stmt = $this->conn->prepare("INSERT INTO libros (nombre, autor, isbn, anio, genero, cantidad) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisi", $data['nombre'], $data['autor'], $data['isbn'], $data['anio'], $data['genero'], $data['cantidad']);
        return $stmt->execute();
    }
}
?>