<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "mydatabase";

    $loginDB = new mysqli($servername, $username, $password, $dbname);
    
    if ($loginDB->connect_error) {
        die("Conexión Fallida: " . $loginDB->connect_error);
    }

    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT nombre FROM usuarios WHERE email='$email' AND contrasena='$contrasena'";
    $result = $loginDB->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["usuario"] = $result->fetch_assoc()["nombre"];
        header("Location: principal.php"); 
        exit();
    } else {
        echo "Sesion incorrecta.";
    }

    $loginDB->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="POST" action="logIn.php">
        <label for="email">Introduce el email:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
