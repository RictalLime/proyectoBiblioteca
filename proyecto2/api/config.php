<?php
$host = 'mysql_db';
$db   = 'libreria';
$user = 'user';
$pass = 'password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}

// Agregar esta función para que index.php pueda llamarla
function getConnection() {
    global $conn;
    return $conn;
}