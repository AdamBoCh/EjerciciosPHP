<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "mydatabase";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Fallo de conexión: " . $conn->connect_error);
    }

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $conf_contrasena = $_POST["conf_contrasena"];

    if ($contrasena !== $conf_contrasena) {
        echo "Las contraseñas no coinciden.";
    } else {
        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$usuario', '$email', '$contrasena')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["usuario"] = $usuario;
            header("Location: principal.php"); 
            exit();
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Registro</h1>
    
    <form method="post" action="">
        <label for="usuario">Nombre:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <label for="conf_contrasena">Confirmar Contraseña:</label>
        <input type="password" id="conf_contrasena" name="conf_contrasena" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
