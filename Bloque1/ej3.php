<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro Simple</title>
</head>
<body>
    <h1>Formulario de Registro Simple</h1>
    <form method="post" action="">
        <label for="usuario">Introduce el nombre: </label>
        <input type="text" id="usuario" name="usuario">
        <br>
        <label for="email">Introduce el email: </label>
        <input type="text" id="email" name="email">
        <br>
        <label for="contrasena">Introduce la contraseña: </label>
        <input type="text" id="contrasena" name="contrasena">
        <br>
        <label for="rep_contrasena">Repetir la contrseña: </label>
        <input type="text" id="rep_contrasena" name="rep_contrasena">
        <br>
        <input type="submit" value="Enviar">
    </form>
<?php
    if (isset($_POST["contrasena"]) && isset($_POST["rep_contrasena"]) && isset($_POST["usuario"]) && isset($_POST["email"])) {
        $contrasena = $_POST["contrasena"];
        $rep_contrasena = $_POST["rep_contrasena"];
        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        if ($contrasena === $rep_contrasena) {
            echo "Las contraseñas coinciden.";
        } else {
            echo "Las contraseñas no coinciden."; 
        }
        echo "Su nombre es $usuario y su email es $email.";
    }
?>
</body>
</html>