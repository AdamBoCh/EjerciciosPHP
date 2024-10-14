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

    $usuario = $_SESSION['usuario'];  
    $ISAN = isset($_POST["isan"]) ? $_POST["isan"] : '';  
    $nombrePelicula = isset($_POST["nombre"]) ? $_POST["nombre"] : '';  
    $puntuacion = isset($_POST["puntuacion"]) ? intval($_POST["puntuacion"]) : 0; 
    $año = isset($_POST["ano"]) ? intval($_POST["ano"]) : 0; 

    $error = ''; 

    $sqlUsuario = "SELECT nombre FROM usuarios WHERE nombre = '$usuario'";
    $resultUsuario = $conn->query($sqlUsuario);

    if ($resultUsuario->num_rows > 0) {

        $sqlPeliculas = "SELECT * FROM peliculasUsuario WHERE usuario = '$usuario'";
        $resultPeliculas = $conn->query($sqlPeliculas);

        if ($resultPeliculas->num_rows > 0) {
        } else {
            $error = "No hay peliculas registradas para este usuario.";
        }

        if (!empty($usuario) && !empty($ISAN) && !empty($nombrePelicula) && $puntuacion >= 0 && $año > 0) {
            $sqlInsert = "INSERT INTO peliculasUsuario (usuario, ISAN, nombre_pelicula, puntuacion, año) 
                          VALUES ('$usuario', '$ISAN', '$nombrePelicula', $puntuacion, $año)";

            if ($conn->query($sqlInsert) === TRUE) {
                echo "Pelicula agregada con exito.";
            } else {
                $error = "Error al agregar pelicula: " . $conn->error;
            }
        } else {
            $error = "Completa todos los campos correctamente.";
        }
    } else {
        $error = "El usuario no existe en la base de datos.";
    }

    $conn->close();
}

$servername = "db";
$username = "root";
$password = "root";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Fallo de conexión: " . $conn->connect_error);
}

$sqlPeliculas = "SELECT * FROM peliculasUsuario WHERE usuario = '" . $_SESSION["usuario"] . "'";
$resultPeliculas = $conn->query($sqlPeliculas);
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
<body>
    <div class="movie-form">
        <h2>Agregar Nueva Pelicula</h2>
        <form action="#" method="POST">
            <label for="usuario">Nombre del Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>" disabled>
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($_SESSION['usuario']); ?>">
            <br>
            <label for="nombre">Nombre de la Pelicula:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="isan">ISAN:</label>
            <input type="text" id="isan" name="isan" required>
            <br>
            <label for="ano">Año:</label>
            <input type="number" id="ano" name="ano" min="1900" max="2100" required>
            <br>
            <label for="puntuacion">Puntuacion:</label>
            <select id="puntuacion" name="puntuacion" required>
                <option value="" disabled selected>Selecciona una puntuacion</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br>
            <input type="submit" value="Agregar Pelicula">
        </form>
    </div>
    
    <br><br>
    
    <div>
    <h2>Peliculas Registradas</h2>
    <form action="#" method="post">
        <table style="border: 1px solid black;">
            <tr>
                <th style="border: 1px solid black; padding: 8px; text-align:center;">Nombre Usuario</th>
                <th style="border: 1px solid black; padding: 8px; text-align:center;">Nombre Película</th>
                <th style="border: 1px solid black; padding: 8px; text-align:center;">ISAN</th>
                <th style="border: 1px solid black; padding: 8px; text-align:center;">Año</th>
                <th style="border: 1px solid black; padding: 8px; text-align:center;">Puntuación</th>
            </tr>
            <?php if ($resultPeliculas->num_rows > 0): ?>
                <?php while ($row = $resultPeliculas->fetch_assoc()): ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['usuario']); ?></td>
                        <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['nombre_pelicula']); ?></td>
                        <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['ISAN']); ?></td>
                        <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['año']); ?></td>
                        <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['puntuacion']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="border: 1px solid black; padding: 8px; text-align: center;">No hay películas registradas para este usuario.</td>
                </tr>
            <?php endif; ?>
        </table>
    </form>
    </div>

    <?php if(!empty($error)): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
</body>
</html>
