<?php
session_start();

$usuario_valido = "admin";
$contrasena_valida = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    if ($usuario == $usuario_valido && $contrasena == $contrasena_valida) {
        $_SESSION["usuario"] = $usuario;
        header("Location: pag1.php"); 
        exit();
    } else {
        echo "Conexion denegada.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>Has iniciado sesión correctamente.</p>
    <button><a href="pag3.php">Cerrar sesión</a></button>
</body>
</html>
