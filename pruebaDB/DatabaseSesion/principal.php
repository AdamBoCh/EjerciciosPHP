<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario"]); ?></h1>
    <p>Has iniciado sesión correctamente.</p>
    <button><a href="cerrar.php">Cerrar sesión</a></button>
</body>
</html>
