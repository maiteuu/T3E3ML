<?php
session_start();

// POST bidez bidali bada bakarrik prozesatu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datuak jaso eta garbitu
    $izena = trim($_POST['izena'] ?? '');
    $emaila = trim($_POST['emaila'] ?? '');
    $telefonoa = trim($_POST['telefonoa'] ?? '');
    $mezua = trim($_POST['mezua'] ?? '');

    // Balioztatzeak
    $errors = [];
    if (empty($izena)) {
        $errors[] = 'Izen-abizenak beharrezkoak dira.';
    }
    if (empty($emaila)) {
        $errors[] = 'Helbide elektronikoa beharrezkoa da.';
    } elseif (!filter_var($emaila, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Helbide elektronikoa ez da baliozkoa.';
    }
    if (empty($mezua)) {
        $errors[] = 'Mezua beharrezkoa da.';
    }

    if (empty($errors)) {
        // XML fitxategiaren bidea definitu
        $xmlFile = 'XML/kontaktua_mensajes.xml';

        // DOMDocument sortu
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        // Fitxategia existitzen bada, kargatu; bestela, erro egitura sortu
        if (file_exists($xmlFile)) {
            $dom->load($xmlFile);
            $root = $dom->documentElement;
        } else {
            $root = $dom->createElement('mensajes');
            $dom->appendChild($root);
        }

        // Mezu berria sortu
        $mensaje = $dom->createElement('mensaje');

        // Data gehitu
        $fecha = $dom->createElement('fecha', date('Y-m-d'));
        $mensaje->appendChild($fecha);

        // Eremuak gehitu
        $nombreElem = $dom->createElement('izena', htmlspecialchars($izena));
        $emailElem = $dom->createElement('emaila', htmlspecialchars($emaila));
        $telefonoElem = $dom->createElement('telefonoa', htmlspecialchars($telefonoa));
        $mensajeElem = $dom->createElement('mezua', htmlspecialchars($mezua));

        $mensaje->appendChild($nombreElem);
        $mensaje->appendChild($emailElem);
        $mensaje->appendChild($telefonoElem);
        $mensaje->appendChild($mensajeElem);

        // Erroari gehitu
        $root->appendChild($mensaje);

        // Fitxategia gorde
        if ($dom->save($xmlFile)) {
            $_SESSION['contact_success'] = 'Mezua behar bezala gorde da. Eskerrik asko!';
        } else {
            $_SESSION['contact_error'] = 'Errorea mezua gordetzean. Saiatu berriro.';
        }
    } else {
        // Erroreak saioan gorde
        $_SESSION['contact_error'] = implode('<br>', $errors);
    }

    // Berriro birbideratu
    header('Location: kontaktuDiseinua.php');
    exit;
} else {
    // POST gabe zuzeneko sarbidea
    header('Location: kontaktuDiseinua.php');
    exit;
}
?>