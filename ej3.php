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
        <label for="num_usuario">Introduce el numero: </label>
        <input type="number" id="num_usuario">
        <input type="submit" value="Adivinar Numero">
    </form>
    <?php
        $num_aleatorio = random_int(0, 5);
        if (isset($_GET['num_usuario']) == $num_aleatorio) {
            echo "Has acertado!!";
        } else {
            echo "No has acertado!. Era el numero $num_aleatorio";
        }
    ?>
</body>
</html>