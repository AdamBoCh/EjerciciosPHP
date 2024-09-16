<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Acertar el Numero</title>
</head>
<body>
    <h1>Juego de Acertar el Numero</h1>
    <form method="get" action="">
        <label for="usuario">Introduce el nombre: </label>
        <input type="text" id="usuario">
        <br>
        <label for="email">Introduce el email: </label>
        <input type="text" id="email">
        <br>
        <label for="contrasena">Introduce la contraseña: </label>
        <input type="text" id="contrasena">
        <br>
        <label for="rep_contrasena">Repetir la contrseña: </label>
        <input type="text" id="rep_contrasena">
        <br>
        <input type="submit" value="Enviar">
    </form>
<?php
    if (isset($_POST['contrasena]) && isset($_POST['rep_contrasena'])){
        $contrasena = $_POST['contrasena'];
        $rep_contrasena = $_POST['rep_contrasena'];
        if ($contrasena === rep_contrsena) {
            echo "Las contraseñas coinciden.";
        } else {
            echo "Las contraseñas no coinciden."; 
        }
)
?>
</body>
</html>