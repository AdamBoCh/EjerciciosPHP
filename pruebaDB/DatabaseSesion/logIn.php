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

    $contrasena = $_POST["contrasena"];
    $email = $_POST["email"];

    $sql = "SELECT nombre FROM usuarios WHERE email='$email' AND contrasena='$contrasena'";
    $result = $loginDB->query($sql);


    if ($result->num_rows > 0) {
        $_SESSION["email"] = $email;
        header("Location: principal.php"); 
        exit();
    } else {
        echo "Conexion denegada.";
    }
    $loginDB->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="logIn.php">
        <label for="email">Introduce el email: </label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>