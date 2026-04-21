<?php
session_start();
if (!isset($_SESSION["rolUsuario"]) || $_SESSION["rolUsuario"] !== "epaile") {
    header("Location: index.php");
    exit;
}
?>