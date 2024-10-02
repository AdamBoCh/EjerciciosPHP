<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "mydatabase";

    $loginDB = new mysqli($servername, $username, $password, $dbname);
    if ($loginDB->connect_error){
        die ("Conexion Fallida " . $loginDB->connect_error);
    }

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT nombre, contrasena FROM usuarios WHERE nombre='$usuario' AND contrasena='$contrasena'";
    $result = $loginDB->query($sql);


    if ($result->num_rows > 0) {
        $_SESSION["usuario"] = $usuario;
        header("Location: index.php"); 
        exit();
    } else {
        echo "Conexion denegada.";
    }
    $loginDB();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesion</title>
</head>
<body>
    <h1>Iniciar Sesion</h1>
    
    <form method="POST" action="login.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
