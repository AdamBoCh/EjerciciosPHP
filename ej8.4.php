<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contactos</title>
</head>
<body>
    <h1>Formulario de Contactos</h1>
    <form method="post" action="">
        <label for="nombre">Introduce el nombre: </label>
        <input type="text" id="nombre" name="nombre">
        <br>
        <label for="apellido">Introduce el apellido: </label>
        <input type="text" id="apellido" name="apellido">
        <br>
        <label for="email">Introduce el email: </label>
        <input type="text" id="email" name="email">
        <br>
        <label for="numTlf">Introduce numero telefonico: </label>
        <input type="number" id="numTlf" name="numTlf">
        <br>
        <input type="submit" value="Guardar">
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
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["numTlf"])) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $numTlf = $_POST["numTlf"];

        echo "Nombre: $nombre<br>";
        echo "Apellido: $apellido<br>";
        echo "Email: $email<br>";
        echo "Número de Teléfono: $numTlf<br>";
    }
?>
</body>
</html>