<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        <label for="texto">Texto: </label>
        <textarea name="texto" id="texto" cols="40" rows="5"></textarea>
        <br>
        <input type="submit" value="Enviar">
    </form>
    <?php
    function encontrarFechas ($texto) { 
            $patron= "/[0-9]{2}\\/[0-9]{2}\\/[0-9]{4}/";
            $fechas = [];

            if (preg_match_all($patron, $texto, $iguales)) {
                $fechas = $iguales[0];
            }
        return $fechas;
    }
    if (isset($_POST["texto"])) {
    $texto = $_POST["texto"];

    $fechasIguales = encontrarFechas($texto);
    foreach ($fechasIguales as $fecha) {
        echo "$fecha, ";
        }
    }
    ?>
</body>
</html>