<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro con Validación</title>
</head>
<body>
    <h1>Formulario de Registro con Validación</h1>
    
    <form method="post" action="index.php">
        <label for="usuario">Introduce el nombre: </label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="email">Introduce el email: </label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="contrasena">Introduce la contraseña: </label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <label for="conf_contrasena">Confirmar contraseña: </label>
        <input type="password" id="conf_contrasena" name="conf_contrasena" required>
        <br>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "db";
        $username = "root";
        $password = "root";
        $dbname = "mydatabase";
        /*
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }*/

        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        $conf_contrasena = $_POST["conf_contrasena"];

        $errores = [];

        if (empty($usuario)) {
            $errores[] = "El nombre es requerido.";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $usuario)) {
            $errores[] = "El nombre debe tener solo letras mayusculas, minusculas y espacios.";
        }

        if (empty($email)) {
            $errores[] = "El correo electrónico es requerido.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo electrónico debe tener un formato válido.";
        }

        if (empty($contrasena)) {
            $errores[] = "La contraseña es requerida.";
        } elseif (strlen($contrasena) < 6) {
            $errores[] = "La contraseña debe tener mas de 6 caracteres.";
        } elseif (!preg_match("/[A-Z]/", $contrasena)) {
            $errores[] = "La contraseña debe tener una letra mayúscula.";
        } elseif (!preg_match("/[a-z]/", $contrasena)) {
            $errores[] = "La contraseña debe tener una letra minuscula.";
        } elseif (!preg_match("/\d/", $contrasena)) {
            $errores[] = "La contraseña debe tener un numero.";
        } elseif (!preg_match("/[@#%!$&]/", $contrasena)) {
            $errores[] = "La contraseña debe tener un caracter especial (@, #, %, !, $, &).";
        }

        if ($contrasena !== $conf_contrasena) {
            $errores[] = "Las contraseñas no coinciden.";
        }

        if (empty($errores)) {
            $sql = "INSERT INTO usuarios (nombre, email, contrasena, conf_contrasena) VALUES ('$usuario', '$email', '$contrasena', '$conf_contrasena')";
                
            if ($conn->query($sql) === TRUE) {
                echo "Registro exitoso. <br>";
                echo "Usuario: $usuario <br>";
                echo "Email: $email <br>";
            } else {
                foreach ($errores as $error) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    }
    ?>
</body>
</html>


