<?php

$cookie_tema = ["claro"];
$cookie_idioma = ["español"];

if (isset($_COOKIE["tema"])) {
    $cookie_tema = $_COOKIE["tema"];
    header("Location: pag1.php");
    exit();
}
if (isset($_COOKIE["idoma"])) {
    $cookie_idioma = $_COOKIE["idioma"];
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
<form method="post" action="guardar.php">
    <p> <?php echo "Tema seleccionado:" .$tema;?></p>
    <input type="radio" id="oscuro" name="oscuro" value="oscuro">
    <label for="Oscuro">Oscuro</label>
    <input type="radio" id="claro" name="claro" value="claro">
    <label for="Claro">Claro</label>
    <br>
    <p> <?php echo "Idioma seleccionado:" .$idioma;?></p>
    <input type="radio" id="euskera" name="euskera" value="euskera">
    <label for="Euskera">Euskera</label>
    <input type="radio" id="español" name="español" value="español">
    <label for="Español">Español</label>
    <input type="submit" value="submit">
</form>
</body>
</html>