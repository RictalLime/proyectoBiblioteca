<?php
class Database {
    public static function connect() {
        $conn = new mysqli("localhost", "root", "4560", "libreria");
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>