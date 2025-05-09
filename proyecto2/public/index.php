<?php
require_once '/var/www/html/api/config.php';

$conn = getConnection();

// INSERTAR libro
if (isset($_POST['agregar'])) {
    $stmt = $conn->prepare("INSERT INTO libro (isbn, titulo, genero, editorial, autor, fecha_lanzamiento, num_copias) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['isbn'],
        $_POST['titulo'],
        $_POST['genero'],
        $_POST['editorial'],
        $_POST['autor'],
        $_POST['fecha_lanzamiento'],
        $_POST['num_copias']
    ]);
    header("Location: index.php");
    exit;
}

// ACTUALIZAR libro
if (isset($_POST['editar'])) {
    $stmt = $conn->prepare("UPDATE libro SET isbn=?, titulo=?, genero=?, editorial=?, autor=?, fecha_lanzamiento=?, num_copias=? WHERE id=?");
    $stmt->execute([
        $_POST['isbn'],
        $_POST['titulo'],
        $_POST['genero'],
        $_POST['editorial'],
        $_POST['autor'],
        $_POST['fecha_lanzamiento'],
        $_POST['num_copias'],
        $_POST['id']
    ]);
    header("Location: index.php");
    exit;
}

// ELIMINAR libro
if (isset($_GET['eliminar'])) {
    $stmt = $conn->prepare("DELETE FROM libro WHERE id = ?");
    $stmt->execute([$_GET['eliminar']]);
    header("Location: index.php");
    exit;
}

// Mostrar todos los libros
$stmt = $conn->query("SELECT * FROM libro");
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Biblioteca - Libros</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        form { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Listado de Libros</h1>

    <table>
        <tr>
            <th>ID</th><th>ISBN</th><th>Título</th><th>Género</th><th>Editorial</th><th>Autor</th><th>Lanzamiento</th><th>Copias</th><th>Acciones</th>
        </tr>
        <?php foreach ($libros as $libro): ?>
        <tr>
            <td><?= $libro['id'] ?></td>
            <td><?= $libro['isbn'] ?></td>
            <td><?= $libro['titulo'] ?></td>
            <td><?= $libro['genero'] ?></td>
            <td><?= $libro['editorial'] ?></td>
            <td><?= $libro['autor'] ?></td>
            <td><?= $libro['fecha_lanzamiento'] ?></td>
            <td><?= $libro['num_copias'] ?></td>
            <td>
                <a href="index.php?editar=<?= $libro['id'] ?>">Editar</a> |
                <a href="index.php?eliminar=<?= $libro['id'] ?>" onclick="return confirm('¿Eliminar este libro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php
    // Modo edición
    if (isset($_GET['editar'])):
        $stmt = $conn->prepare("SELECT * FROM libro WHERE id = ?");
        $stmt->execute([$_GET['editar']]);
        $libroEditar = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
        <h2>Editar Libro</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $libroEditar['id'] ?>">
            <input type="text" name="isbn" value="<?= $libroEditar['isbn'] ?>" required>
            <input type="text" name="titulo" value="<?= $libroEditar['titulo'] ?>" required>
            <input type="text" name="genero" value="<?= $libroEditar['genero'] ?>">
            <input type="text" name="editorial" value="<?= $libroEditar['editorial'] ?>">
            <input type="text" name="autor" value="<?= $libroEditar['autor'] ?>" required>
            <input type="date" name="fecha_lanzamiento" value="<?= $libroEditar['fecha_lanzamiento'] ?>" required>
            <input type="number" name="num_copias" value="<?= $libroEditar['num_copias'] ?>" required>
            <button type="submit" name="editar">Actualizar</button>
        </form>
    <?php else: ?>
        <h2>Agregar Nuevo Libro</h2>
        <form method="POST">
            <input type="text" name="isbn" placeholder="ISBN" required>
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="text" name="genero" placeholder="Género">
            <input type="text" name="editorial" placeholder="Editorial">
            <input type="text" name="autor" placeholder="Autor" required>
            <input type="date" name="fecha_lanzamiento" required>
            <input type="number" name="num_copias" placeholder="Número de Copias" required>
            <button type="submit" name="agregar">Agregar</button>
        </form>
    <?php endif; ?>

</body>
</html>
