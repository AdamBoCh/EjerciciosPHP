<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Formulario de Registro con Validacion</h1>
    <form method="post" action="">
        <label for="usuario">Introduce el nombre: </label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="email">Introduce el email: </label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="contrasena">Introduce la contraseña: </label>
        <input type="text" id="contrasena" name="contrasena" required>
        <br>
        <label for="conf_contrasena">Confirmar contraseña: </label>
        <input type="text" id="conf_contrasena" name="conf_contrasena" required>
        <br>
        <input type="submit" value="Enviar">
    </form>
    <?php
    if (isset($_POST["contrasena"]) && isset($_POST["conf_contrasena"]) && isset($_POST["usuario"]) && isset($_POST["email"])) {
        $contrasena = $_POST["contrasena"];
        $conf_contrasena = $_POST["conf_contrasena"];
        $usuario = $_POST["usuario"];
        $email = $_POST["email"];

        if (empty($usuario)) {
            $usuarioError = "El nombre es requerido.";
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/", $usuario)) {
                $usuarioError = "El nombre debe contener solo letras mayusculas, minusculas y espacios.";
            }
        }

        if (empty($email)) {
            $emailError = "El email es requerido.";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailError = "El correo electronico debe tener un formato valido.";
            }
        }

        if (empty($contrasena) || strlen($contrasena) < 6) {
            $contrasenaError = "La contraseña es requerida y debe tener 8 caracteres.";
        } else {
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#%!$&])/", $contrasena)) {
                $contrasenaError = "La contraseña debe contener una letra mayuscula, una minuscula, un numero y un caracter especial.";
            } else if ($contrasena !== $conf_contrasena) {
                $contrasenaError = "Las contraseñas no coinciden.";
            } else {
                echo "La contraseña es valida.";
            }
        }

        if (isset($usuarioError)) {
            echo $usuarioError . "<br>";
        }
        if (isset($emailError)) {
            echo $emailError . "<br>";
        }
        if (isset($contrasenaError)) {
            echo $contrasenaError . "<br>";
        }
    }
?>

</body>
</html>