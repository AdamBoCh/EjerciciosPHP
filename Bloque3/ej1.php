<?php
    $cookie_contador = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    setcookie('contador','', time() - 3600);
    $cookie_contador = 0;
} else {
    if (isset($_COOKIE["contador"])) {
        $cookie_contador = $_COOKIE["contador"] + 1;
    } else {
        $cookie_contador = 1;
    }
    setcookie("contador", $cookie_contador);
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
<?php
    if ($cookie_contador == 1) {
        echo "Es tu primera visita.";
    } else {
        echo "Has entrado " . $cookie_contador;
    }
?> 
    <form action="" method="post">
        <button type="submit" name="enviar">Resetear</button>
    </form>
</body>
</html>