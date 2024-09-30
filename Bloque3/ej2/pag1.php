<?php
session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: pag2.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
</head>
<body>
<h1>Inicio de Sesión</h1>
    <form method="post" action="pag2.php">
        <label for="usuario">Introduce el usuario: </label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="contrasena">Introduce la contraseña: </label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
