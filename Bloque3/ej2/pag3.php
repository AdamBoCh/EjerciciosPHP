<?php
session_start();
session_unset();
session_destroy();
header("Location: pag1.php");
exit();
?>