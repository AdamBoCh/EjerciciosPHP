<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "mydatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Fallo de conexion: " . $conn->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS mydatabase";
    if ($conn->query($sql) === TRUE) {
        echo "Base de datos existente.";
    }

    $conn->select_db("mydatabase");

    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        nombre VARCHAR(50) PRIMARY KEY,
        email VARCHAR(100) UNIQUE,
        contrasena VARCHAR(255) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Tabla usuarios ya existe";
    }

    $sql = "CREATE TABLE IF NOT EXISTS peliculas(
        usuario VARCHAR(50),
        ISAN CHAR(8),
        nombre_pelicula VARCHAR(100),
        puntuacion INT CHECK (puntuacion BETWEEN 0 AND 5),
        ano INT CHECK (ano BETWEEN 1900 AND 2100),
        FOREIGN KEY (usuario) REFERENCES usuarios(nombre) ON DELETE CASCADE
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Tabla peliculas ya existe.";
    }

    $conn->close();
}
?>