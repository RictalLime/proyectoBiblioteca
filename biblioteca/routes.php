<?php
require_once __DIR__ . 'controllers/LibroController.php';
require_once __DIR__ . 'controllers/UsuarioController.php';
require_once __DIR__ . 'controllers/PrestamoController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && preg_match("#/libros/disponibilidad/(.+)#", $uri, $matches)) {
    LibroController::verDisponibilidad($matches[1]);
} elseif ($method === 'GET' && strpos($uri, '/libros/buscar') !== false) {
    LibroController::buscar();
} elseif ($method === 'POST' && $uri === '/libros') {
    LibroController::crear();
} elseif ($method === 'PUT' && $uri === '/prestamos') {
    PrestamoController::prestar();
} elseif ($method === 'POST' && $uri === '/usuarios') {
    UsuarioController::crear();
} else {
    http_response_code(404);
    echo json_encode(["error" => "Ruta no encontrada"]);
}
?>