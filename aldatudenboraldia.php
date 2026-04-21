<?php
    session_start();
    // Formularioan aukeratu duzun deboraldia hemen gordetzen da. 
    // Adibidez 2023-2024 denboraldia aukeratzean " $_SESSION["unekodenboraldia"] = 2023-2024 Denboraldia" gordeko da
    $_SESSION["unekodenboraldia"] = $_POST["denboraldia"];
    
    // Birbideratzen da automatikoki klasifikazioa.php-ra
    header("Location: klasifikazioa.php");
?>