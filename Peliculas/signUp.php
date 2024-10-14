<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "db";
    $username = "root";
    $password = "root";
    $dbname = "mydatabase";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Fallo de conexión: " . $conn->connect_error);
    }

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $conf_contrasena = $_POST["conf_contrasena"]; 

    $error = ''; 

    if (empty($usuario) || empty($email) || empty($contrasena) || empty($conf_contrasena)) {
        $error = "Todos los campos son requeridos.";
    } elseif ($contrasena !== $conf_contrasena) {
        $error = "Las contraseñas no coinciden.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del correo electrónico no es válido.";
    } else {
        $sql = "SELECT * FROM usuarios WHERE nombre='$usuario' OR email='$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $error = "El nombre de usuario o el correo ya están en uso.";
        } else {
            $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$usuario', '$email', '$contrasena')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION["usuario"] = $usuario; 
                header("Location: logIn.php"); 
                exit();
            } else {
                $error = "Error al registrar el usuario: " . $conn->error;
            }
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
        <label for="usuario">Nombre de Usuario:</label>
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
        <span style="color:red;"><?php echo $error; ?></span>
    <?php endif; ?>
</body>
</html>
