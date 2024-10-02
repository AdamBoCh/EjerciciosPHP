<?php 
session_start();
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
    <h1>Bienvenido</h1>
    <p>Inicie sesion</p>
    <button><a href="logIn.php">Iniciar sesion</a></button>
    </form>
    <form method="post" action="Registro.php">
    <p>Debe registrarse si no lo esta.</p>
    <button><a href="Registro.php">Registrarse</a></button>
    </form>
</body>
</html>