<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "mydatabase";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Fallo de conexion: " . $conn->connect_error);
    }

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $conf_contrasena = $_POST["conf_contrasena"];

    if (empty($email)) {
        $error = "El email es requerido.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del email no es valido.";
    } else {
        $sqlEmail = "SELECT * FROM usuarios WHERE email='$email'";
        if ($conn->query($sqlEmail)->num_rows > 0) {
            $error = "El email ya esta en uso.";
        }
    }

    if ($contrasena !== $conf_contrasena) {
        $error = "Las contraseñas no coinciden.";
    }

    if (empty($error)) {
        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$usuario', '$email', '$contrasena')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["usuario"] = $usuario; 
            header("Location: principal.php"); 
            exit();
        } else {
            $error = "Error al registrar el usuario: " . $conn->error;
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form method="post" action="">
        <label for="usuario">Nombre:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <label for="conf_contrasena">Confirmar Contraseña:</label>
        <input type="password" id="conf_contrasena" name="conf_contrasena" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
    <?php if (!empty($error)): ?>
        <?php echo $error; ?>
    <?php endif; ?>
</body>
</html>
