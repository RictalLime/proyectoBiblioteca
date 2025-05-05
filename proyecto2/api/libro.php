<?php
header('Content-Type: application/json');
include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        try {
            $stmt = $pdo->query("SELECT * FROM libro");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode([
                "total_registros" => count($result),
                "datos" => $result
            ]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            echo json_encode(["error" => "Datos JSON inválidos"]);
            exit;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO libro (isbn, titulo, genero, editorial, autor, fecha_lanzamiento, num_copias) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$data['isbn'], $data['titulo'], $data['genero'], $data['editorial'], $data['autor'], $data['fecha_lanzamiento'], $data['num_copias']]);
            echo json_encode(["message" => "Libro agregado correctamente"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['id'])) {
            echo json_encode(["error" => "ID no proporcionado"]);
            exit;
        }

        try {
            $stmt = $pdo->prepare("UPDATE libro SET titulo=?, genero=?, editorial=?, autor=?, fecha_lanzamiento=?, num_copias=? WHERE id=?");
            $stmt->execute([$data['titulo'], $data['genero'], $data['editorial'], $data['autor'], $data['fecha_lanzamiento'], $data['num_copias'], $data['id']]);
            echo json_encode(["message" => "Libro actualizado correctamente"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['id'])) {
            echo json_encode(["error" => "ID no proporcionado"]);
            exit;
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM libro WHERE id=?");
            $stmt->execute([$data['id']]);
            echo json_encode(["message" => "Libro eliminado correctamente"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(["error" => "Método HTTP no permitido"]);
}
?>