<?php
require_once 'config.php';
header('Content-Type: application/json');

$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'listar':
        // Obtener los parámetros de consulta
        $id = $_GET['id'] ?? null;
        $genero = $_GET['genero'] ?? null;

        $sql = "SELECT * FROM libro";
        $params = [];

        // Filtrar por ID si está presente
        if ($id !== null) {
            $sql .= " WHERE id = ?";
            $params[] = $id;
        }

        // Filtrar por género si está presente
        elseif ($genero !== null) {
            $sql .= " WHERE genero = ?";
            $params[] = $genero;
        }

        $stmt = getConnection()->prepare($sql);
        $stmt->execute($params);
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['datos' => $datos]);
        break;

    case 'crear':
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';

        if ($titulo && $autor) {
            $stmt = getConnection()->prepare("INSERT INTO libro (titulo, autor) VALUES (?, ?)");
            $stmt->execute([$titulo, $autor]);
        }

        header("Location: /public/index.php");
        break;

    case 'eliminar':
        $id = $_POST['id'] ?? 0;

        if ($id) {
            $stmt = getConnection()->prepare("DELETE FROM libro WHERE id = ?");
            $stmt->execute([$id]);
        }

        header("Location: /public/index.php");
        break;

    default:
        echo json_encode(['error' => 'Acción no válida']);
}