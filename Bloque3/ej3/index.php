<?php
session_start();

if (!isset($_COOKIE["tema"])) {
    setcookie("tema", "claro", time() + (86400 * 30), "/"); // 30 días
}
if (!isset($_COOKIE["idioma"])) {
    setcookie("idioma", "español", time() + (86400 * 30), "/");
}

$tema = isset($_COOKIE["tema"]) ? $_COOKIE["tema"] : "claro";
$idioma = isset($_COOKIE["idioma"]) ? $_COOKIE["idioma"] : "español";

$mensajes = [
    "español" => "Bienvenido",
    "euskera" => "Ongi Etorri"
];

if ($tema == "oscuro") {
    $fondo = "#000";
    $texto = "#FFF";
} else {
    $fondo = "#FFF";
    $texto = "#000";
}
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Tema e Idioma</title>
    <style>
        body {
            background-color: <?php echo $fondo; ?>;
            color: <?php echo $texto; ?>;
            font-family: Arial, sans-serif;
        }
        .configuracion {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1><?php echo $mensajes[$idioma]; ?></h1>
    
    <div class="configuracion">
        <form action="guardar.php" method="POST">
            <label for="tema">Selecciona el tema:</label>
            <select id="tema" name="tema">
                <option value="claro" <?php echo ($tema == "claro") ? "selected" : ""; ?>>Claro</option>
                <option value="oscuro" <?php echo ($tema == "oscuro") ? "selected" : ""; ?>>Oscuro</option>
            </select>
            
            <label for="idioma">Selecciona el idioma:</label>
            <select id="idioma" name="idioma">
                <option value="español" <?php echo ($idioma == "español") ? "selected" : ""; ?>>Español</option>
                <option value="euskera" <?php echo ($idioma == "euskera") ? "selected" : ""; ?>>Euskera</option>
            </select>
            <br>
            <br>        
            <input type="submit" value="Guardar Preferencias">
        </form>
    </div>
</body>
</html>
