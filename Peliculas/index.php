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
    $accion = isset($_POST["accion"]) ? $_POST["accion"] : '';

    $error = ''; 

    $sqlUsuario = "SELECT nombre FROM usuarios WHERE nombre = '$usuario'";
    $resultUsuario = $conn->query($sqlUsuario);

    if ($resultUsuario->num_rows > 0) {
        $sqlPeliculas = "SELECT * FROM peliculasUsuario WHERE usuario = '$usuario' AND ISAN = '$ISAN'";
        $resultPeliculas = $conn->query($sqlPeliculas);

        if (strlen($ISAN) == 8) {
            if ($accion == 'agregar' && $resultPeliculas->num_rows == 0) {
                if (!empty($nombrePelicula) && $puntuacion >= 0 && $año > 0) {
                    $sqlInsert = "INSERT INTO peliculasUsuario (usuario, ISAN, nombre_pelicula, puntuacion, año) 
                                  VALUES ('$usuario', '$ISAN', '$nombrePelicula', $puntuacion, $año)";
                    if ($conn->query($sqlInsert) === TRUE) {
                        echo "Pelicula agregada.";
                    } else {
                        $error = "Error al agregar pelicula: " . $conn->error;
                    }
                } else {
                    $error = "Completa los campos correctamente.";
                }
            } elseif ($accion == 'eliminar' && $resultPeliculas->num_rows > 0) {
                $sqlDelete = "DELETE FROM peliculasUsuario WHERE usuario = '$usuario' AND ISAN = '$ISAN'";
                if ($conn->query($sqlDelete) === TRUE) {
                    echo "Pelicula eliminada.";
                } else {
                    $error = "Error al eliminar pelicula: " . $conn->error;
                }
            } elseif ($accion == 'actualizar' && $resultPeliculas->num_rows > 0) {
                if (!empty($nombrePelicula)) {
                    $sqlUpdate = "UPDATE peliculasUsuario 
                                   SET nombre_pelicula = '$nombrePelicula', puntuacion = $puntuacion, año = $año 
                                   WHERE usuario = '$usuario' AND ISAN = '$ISAN'";
                    if ($conn->query($sqlUpdate) === TRUE) {
                        echo "Pelicula actualizada.";
                    } else {
                        $error = "Error al actualizar pelicula: " . $conn->error;
                    }
                } else {
                    $error = "Proporciona un nombre para la pelicula ha actualizar.";
                }
            } else {
                $error = "";
            }
        } else {
            $error = "El ISAN debe tener exactamente 8 dígitos.";
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
    <title>Películas</title>
</head>
<body>
    <div class="movie-form">
        <h2>Agregar Nueva Película</h2>
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
            <label for="puntuacion">Puntuación:</label>
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
            <input type="hidden" name="accion" value="agregar">
            <input type="submit" value="Agregar Película">
        </form>
    </div>
    
    <br><br>
    
    <div>
        <h2>Películas Registradas</h2>
        <form action="#" method="post">
            <table style="border: 1px solid black;">
                <tr>
                    <th style="border: 1px solid black; padding: 8px; text-align:center;">Nombre Usuario</th>
                    <th style="border: 1px solid black; padding: 8px; text-align:center;">Nombre Pelicula</th>
                    <th style="border: 1px solid black; padding: 8px; text-align:center;">ISAN</th>
                    <th style="border: 1px solid black; padding: 8px; text-align:center;">Año</th>
                    <th style="border: 1px solid black; padding: 8px; text-align:center;">Puntuacion</th>
                </tr>
                <?php if ($resultPeliculas->num_rows > 0): ?>
                    <?php while ($row = $resultPeliculas->fetch_assoc()): ?>
                        <tr>
                            <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['usuario']); ?></td>
                            <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['nombre_pelicula']); ?></td>
                            <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['ISAN']); ?></td>
                            <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['año']); ?></td>
                            <td style="border: 1px solid black; padding: 8px; text-align:center;"><?php echo htmlspecialchars($row['puntuacion']); ?></td>
                                <form action="#" method="POST" style="display:inline;">
                                    <input type="hidden" name="isan" value="<?php echo htmlspecialchars($row['ISAN']); ?>">
                                    <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($row['nombre_pelicula']); ?>">
                                    <input type="hidden" name="puntuacion" value="<?php echo htmlspecialchars($row['puntuacion']); ?>">
                                    <input type="hidden" name="ano" value="<?php echo htmlspecialchars($row['año']); ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="border: 1px solid black; padding: 8px; text-align: center;">No hay peliculas registradas.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </form>
    </div>

    <div class="update-form">
        <h2>Actualizar Película</h2>
        <form action="#" method="POST">
            <br>
            <label for="isan">ISAN:</label>
            <input type="text" id="isan" name="isan" required>
            <br>
            <input type="hidden" name="accion" value="actualizar">
            <input type="submit" value="Actualizar Pelicula">
        </form>
    </div>

    <div class="delete-form">
        <h2>Eliminar Pelicula</h2>
        <form action="#" method="POST">
            <br>
            <label for="isan">ISAN:</label>
            <input type="text" id="isan" name="isan" required>
            <br>
            <input type="hidden" name="accion" value="eliminar">
            <input type="submit" value="Eliminar">
        </form>
    </div>

    <?php if(!empty($error)): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
</body>
</html>
