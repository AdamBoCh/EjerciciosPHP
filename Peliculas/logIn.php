<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "mydatabase";

    $loginDB = new mysqli($servername, $username, $password, $dbname);
    
    if ($loginDB->connect_error) {
        die("Conexión Fallida: " . $loginDB->connect_error);
    }

    $input = $_POST["input"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT nombre, contrasena FROM usuarios WHERE nombre='$input' OR email='$input'";
    $result = $loginDB->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($contrasena === $row["contrasena"]) {
            $_SESSION["usuario"] = $row["nombre"];
            header("Location: index.php"); 
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $loginDB->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="POST" action="">
        <label for="input">Introduce el nombre de usuario o email:</label>
        <input type="text" id="input" name="input" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
        <br><br>
        <a href="signUp.php">Registrarse</a>
    </form>
    <?php if (!empty($error)): ?>
        <span style="color:red;"><?php echo $error; ?></span>
    <?php endif; ?>
</body>
</html>
