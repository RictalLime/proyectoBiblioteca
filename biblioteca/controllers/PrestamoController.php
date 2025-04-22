<?php
require_once __DIR__ . 'models/Prestamo.php';
require_once __DIR__ . 'config/db.php';

class PrestamoController {
    public static function prestar() {
        $db = Database::connect();
        $prestamo = new Prestamo($db);
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($prestamo->prestar($data));
    }
}
?>