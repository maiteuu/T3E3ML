<?php
require_once 'admin_check.php';

if (!isset($_SESSION["unekodenboraldia"])) {
    $_SESSION["unekodenboraldia"] = "2024-2025 Denboraldia";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gure boleiboleko federazioaren web orrialdea sortu dugu">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="3.Taldea">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="shortcut icon" href="irudiak/Logo_sinFondo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/boleibol.css">
    <link rel="stylesheet" href="css/w3.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script/jquery-3.7.1.min.js"></script>
    <script src="script/boleibol_federazioa.js"></script>
    <title>Mezuak - Boleibol Federazioa (Admin)</title>
</head>

<body>
    <header>
        <div class="denboraldiak">
            <?php echo $_SESSION["unekodenboraldia"] ?? ''; ?>
        </div>
        <div class="tituloa">
            <a class="hasiera" href="#">
                <img src="irudiak/Logo_sinFondo.png" alt="Federazioaren logoa" width="120px">
            </a>
            <h1>Boleibol Federazioa</h1>
        </div>
        <div class="usertituloa">
            <?php
            if (isset($_SESSION["nombreUsuario"]) && isset($_SESSION["rolUsuario"])) {
                echo "<h2>Ongi etorri " . $_SESSION["nombreUsuario"] . " (" . $_SESSION["rolUsuario"] . ")</h2>";
            }
            ?>
        </div>
        <br>
        <nav>
            <ul>
                <li><a href="index.php">Hasiera</a></li>
                <li><a href="klasifikazioa.php">Klasifikazioa</a></li>
               
                <li><a href="berriak.php">Berriak</a></li>
               <?php if (isset($_SESSION["rolUsuario"]) && $_SESSION["rolUsuario"] == "erabiltzaile"): ?>
                    <li><a href="kontaktuDiseinua.php">Kontaktua</a></li>
                <?php endif; ?>
                <!-- Bakarrik admin erabiltzaileak ikusiko dute -->
                <?php if (isset($_SESSION["rolUsuario"]) && $_SESSION["rolUsuario"] == "admin"): ?>
                    <li><a href="admin_messages.php">Mezuak</a></li>
                <?php endif; ?>

                <!-- Logueatuta dagoenean logout aterako da -->

                <?php if (isset($_SESSION["nombreUsuario"])): ?>
                    <li><a href="logout.php">Logout</a></li>

                <?php else: ?>
                    <li><a href="loginDiseinua.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="tabla-contenedor">
            <h1 class="taldeak-titulua"><b>Jasotako kontaktuen zerrenda</b></h1>
            <br>

            <?php
            $xmlFile = 'XML/kontaktua_mensajes.xml';
            if (file_exists($xmlFile)) {
                $xml = simplexml_load_file($xmlFile);
                if ($xml && count($xml->mensaje) > 0) {
                    echo '<table class="tabla-klasi">';
                    echo '<thead><tr><th>Data</th><th>Izena</th><th>Emaila</th><th>Telefonoa</th><th>Mezua</th></tr></thead><tbody>';
                    foreach ($xml->mensaje as $msg) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($msg->fecha) . '</td>';
                        echo '<td>' . htmlspecialchars($msg->izena) . '</td>';
                        echo '<td>' . htmlspecialchars($msg->emaila) . '</td>';
                        echo '<td>' . htmlspecialchars($msg->telefonoa) . '</td>';
                        echo '<td>' . nl2br(htmlspecialchars($msg->mezua)) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>Oraindik ez dago mezurik.</p>';
                }
            } else {
                echo '<p>Oraindik ez da mezurik jaso.</p>';
            }
            ?>
        </section>
    </main>

    <footer>
        <section class="footer-container">
            <button id="flecha">⬆</button>
            <div class="footer-brand">
                <h3>Boleibol Federazioa</h3>
                <p>Euskal boleibolaren garapena eta sustapena.</p>
            </div>
            <div class="footer-section">
                <h4>Kontaktua</h4>
                <p>📧 BoleiFede@gmail.com</p>
                <p>📞 +34 600 123 456</p>
            </div>
            <div class="footer-section">
                <h4>Kokapena</h4>
                <p>Ornilla Doctor Kalea 2</p>
                <p>Otxarkoaga - Txurdinaga, 48004</p>
                <p>Bilbao, Bizkaia</p>
            </div>
            <div class="footer-social">
                <a href="#" aria-label="Instagram"><img src="irudiak/instagram.png" alt="Instagram"></a>
                <a href="#" aria-label="YouTube"><img src="irudiak/youtube.png" alt="YouTube"></a>
                <a href="#" aria-label="Twitter"><img src="irudiak/twitter.png" alt="Twitter"></a>
                <a href="#" aria-label="Facebook"><img src="irudiak/facebook.png" alt="Facebook"></a>
            </div>
        </section>
        <div class="footer-divider"></div>
        <div class="footer-bottom">
            © 2025 Boleibol Federazioa · Eskubide guztiak erreserbatuta
        </div>
    </footer>
</body>

</html>