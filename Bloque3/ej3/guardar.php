<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("tema", $_POST["tema"], time() + (86400 * 30), "/");
    setcookie("idioma", $_POST["idioma"], time() + (86400 * 30), "/");

    header("Location: index.php");
    exit();
}
?>
