<?php
require_once __DIR__ . 'models/Usuario.php';
require_once __DIR__ . 'config/db.php';

class UsuarioController {
    public static function crear() {
        $db = Database::connect();
        $usuario = new Usuario($db);
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($usuario->crear($data));
    }
}
?>