<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Dos Números (GET)</title>
</head>
<body>
    <h1>Formulario Suma (GET)</h1>
    <form method="get" action="">
        <label for="numero1">Número 1:</label>
        <input type="number" id="numero1" name="numero1" required>
        <br>
        <label for="numero2">Número 2:</label>
        <input type="number" id="numero2" name="numero2" required>
        <br>
        <input type="submit" value="Calcular Suma">
    </form>

    <?php
    if (isset($_GET['numero1']) && isset($_GET['numero2'])) {
        $numero1 = (int)$_GET['numero1'];
        $numero2 = (int)$_GET['numero2'];
        $suma = $numero1 + $numero2;
        echo "<p>La suma de $numero1 y $numero2 es $suma.</p>";
    }
    ?>
</body>
</html>
