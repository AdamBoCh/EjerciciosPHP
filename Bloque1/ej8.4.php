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
    class Contacto {
        private $nombre;
        private $email;
        private $apellido;
        private $numTlf;

        public function __construct($nombre, $apellido, $email, $numTlf) {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->email = $email;
            $this->numTlf = $numTlf;
        }

        public function get_nombre() {
            return $this->nombre;
        }

        public function get_apellido() {
            return $this->apellido;
        }

        public function get_email() {
            return $this->email;
        }

        public function get_numTlf() {
            return $this->numTlf;
        }
    }
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["numTlf"])) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $numTlf = $_POST["numTlf"];
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Mete un formato de email valido.";
        } elseif (!preg_match('/^[0-9]{9}$/', $numTlf)){
            echo "Mete un formato de numero valido.";
        } else {
            $contactoNuevo = new Contacto($nombre, $apellido, $email, $numTlf);
                
            echo "Nombre:" . $contactoNuevo->get_nombre() . "<br>";
            echo "Apellido:" . $contactoNuevo->get_apellido() . "<br>";
            echo "Email:" . $contactoNuevo->get_email() . "<br>";
            echo "Numero de Telefono:" . $contactoNuevo->get_numTlf() . "<br>";
        }
    }
?>
</body>
</html>