<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="" >
        <label for="usuario">Usuario: </label>
        <input type="text" id="usuario" name="usuario">
        <br>
        <label for="valoracion">Valoracion: </label>
        <input type="number" id="valoracion" name="valoracion" min="1" max="5">
        <br>
        <label for="comentario">comentario: </label>
        <textarea id="comentario" name="comentario" rows="5" cols="40"></textarea>
        <br>
        <input type="submit" value="Enviar">
    </form>
    <?php
    if (isset($_POST["usuario"]) && isset($_POST["valoracion"]) && isset($_POST["comentario"])) {
        $usuario = $_POST["usuario"];
        $valoracion = $_POST["valoracion"];
        $comentario = $_POST["comentario"];

        echo "Usuario: " .htmlspecialchars($usuario)."<br>";
        if ($valoracion >= 1 && $valoracion <= 5) {
            echo "Valoracion: " .htmlspecialchars($valoracion)."<br>";
        }
        echo "Comentario: " .htmlspecialchars($comentario)."<br>";
    }    
    ?>
</body>
</html>