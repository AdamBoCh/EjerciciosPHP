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
        <label for="usuario">Introduce el nombre: </label>
        <input type="text" id="usuario" name="usuario">
        <br>
        <label for="email">Introduce el email: </label>
        <input type="text" id="email" name="email">
        <br>
        <label for="contrasena">Introduce la contraseña: </label>
        <input type="password" id="contrasena" name="contrasena">
        <br>
        <label for="rep_contrasena">Repetir la contraseña: </label>
        <input type="password" id="rep_contrasena" name="rep_contrasena">
        <br>
        <input type="submit" value="Enviar">
    </form>

<?php

    class Usuario {
        private $usuario;
        private $email;
        private $contrasena;

        public function __construct($usuario, $email, $contrasena) {
            $this->usuario = $usuario;
            $this->email = $email;
            $this->contrasena = $contrasena;
        }

        public function get_usuario() {
            return $this->usuario;
        }

        public function get_email() {
            return $this->email;
        }

        public function get_contrasena() {
            return $this->contrasena;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST["usuario"]) && !empty($_POST["email"]) && !empty($_POST["contrasena"]) && !empty($_POST["rep_contrasena"])) {
            $usuarioInput = $_POST["usuario"];
            $emailInput = $_POST["email"];
            $contrasenaInput = $_POST["contrasena"];
            $repContrasenaInput = $_POST["rep_contrasena"];

            if ($contrasenaInput === $repContrasenaInput) {
                $usuarioObj = new Usuario($usuarioInput, $emailInput, $contrasenaInput);

                echo "Las contraseñas coinciden.<br>";
                echo "Usuario: " . $usuarioObj->get_usuario() . "<br>";
                echo "Email: " . $usuarioObj->get_email() . "<br>";
            } else {
                echo "Las contraseñas no coinciden.<br>";
            }
        } else {
            echo "Por favor, rellena todos los campos.<br>";
        }
    }
?>
</body>
</html>
