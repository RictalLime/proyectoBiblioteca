<?php
require_once __DIR__ . '/../models/Libro.php';
require_once __DIR__ . '/../config/db.php';

class LibroController {
    public static function verDisponibilidad($isbn) {
        $db = Database::connect();
        $libro = new Libro($db);
        echo json_encode($libro->disponibilidad($isbn));
    }

    public static function buscar() {
        $db = Database::connect();
        $libro = new Libro($db);
        echo json_encode($libro->buscar($_GET));
    }

    public static function crear() {
        $db = Database::connect();
        $libro = new Libro($db);
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($libro->crear($data));
    }
}
?>