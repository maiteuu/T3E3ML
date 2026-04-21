<?php
session_start();
if (!isset($_SESSION["rolUsuario"]) || $_SESSION["rolUsuario"] !== "erabiltzaile") {
    header("Location: index.php");
    exit;
}
?>