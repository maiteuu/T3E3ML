<?php
session_start();

// Denboraldi bat hautatuta ez badago, lehenetsita 2024-2025 jarriko da

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
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="author" content="3.Taldea: Ekaitz Miguel, Urtzi Estevez eta Irati Ballaz">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="shortcut icon" href="irudiak/Logo_sinFondo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/boleibol.css">
    <link rel="stylesheet" href="css/w3.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script/jquery-3.7.1.min.js"></script>
    <script src="script/boleibol_federazioa.js"></script>

    <title>Klasifikazioa - Boleibol Federazioa</title>

</head>

<body>

    <header>
        <!-- Aukeratutako denboraldia agertuko da orriaren eskinan -->
        <div class="denboraldiak">
            <?php
            if (isset($_SESSION["unekodenboraldia"])) {
                echo $_SESSION["unekodenboraldia"];
            }
            ?>
        </div>

        <div class="tituloa">
            <!-- Logoan klikatzerakoan hasierara eramaten du -->
            <a class="hasiera" href="index.php">
                <img src="irudiak/Logo_sinFondo.png" alt="Federazioaren logoa" width="120px">
            </a>

            <h1>Boleibol Federazioa</h1>

        </div>

        <!-- Logueatuta zaudenean ongi etorria, erabiltzailearen izena eta bere rola aterako da -->
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
                <li>
                    <a class="hasiera" href="index.php">Hasiera</a>
                </li>

                <li>
                    <a id="klasifikazioa" href="klasifikazioa.php">Klasifikazioa</a>
                </li>

                <li>
                    <a class="berriak" href="berriak.php">Berriak</a>
                </li>

                <!-- Orri hau bakarrik erabiltzaile rola ikusiko dute -->
                <?php if (isset($_SESSION["rolUsuario"]) && $_SESSION["rolUsuario"] == "erabiltzaile"): ?>
                    <li>
                        <a href="kontaktuDiseinua.php">Kontaktua</a>
                    </li>
                <?php endif; ?>

                <!-- Orri hau bakarrik admin erabiltzaileak ikusiko dute -->
                <?php if (isset($_SESSION["rolUsuario"]) && $_SESSION["rolUsuario"] == "admin"): ?>
                    <li>
                        <a href="admin_messages.php">Mezuak</a>
                    </li>
                <?php endif; ?>

                <!-- Orri hau bakarrik epaile erabiltzaileak ikusiko dute -->
                <?php if (isset($_SESSION["rolUsuario"]) && $_SESSION["rolUsuario"] == "epaile"): ?>
                    <li>
                        <a href="epaile_partidak.php">Partiduak ikusi</a>
                    </li>
                <?php endif; ?>

                <!-- ======== Logueatuta dagoenean logout aterako da ======== -->
                <?php if (isset($_SESSION["nombreUsuario"])): ?>

                    <li>
                        <a href="logout.php">Logout</a>
                    </li>

                <?php else: ?>

                    <li>
                        <a href="loginDiseinua.php">Login</a>
                    </li>

                <?php endif; ?>
            </ul>
        </nav>

    </header>

    <main>

        <section class="denboraldi-section">

            <!-- Atal honetan erabiltzaileak zein denboraldi ikusi nahi duen aukeratzen du -->
            <form method="post" action="aldatudenboraldia.php" class="denboraldi-form">

                <h2>Aukeratu Denboraldia</h2>

                <label for="denboraldiaAukeratu">Denboraldiak</label>

                <!-- erabiltzaileari zer aukeratu behar duen adierazten dio -->
                <select name="denboraldia" id="denboraldiaAukeratu">

                    <!-- erabiltzaileak denboraldia aukeratzeko desplegable zerrenda -->
                    <!-- Aukera: 2024-2025 denboraldia -->
                    <!-- Berdina bada, "selected" atributua gehitzen da -->
                    <!-- Horrela, orria kargatzean denboraldi hau automatikoki hautatuta agertzen da -->
                    <option value="2024-2025 Denboraldia" <?php if ($_SESSION["unekodenboraldia"] == "2024-2025 Denboraldia")
                        echo "selected"; ?>> 2024-2025 Denboraldia
                    </option>

                    <!-- Aukera: 2023-2024 denboraldia -->
                    <!--  SESSION gordeta dagoen denboraldia hau bada, aukera hau hautatuta agertuko da -->
                    <option value="2023-2024 Denboraldia" <?php if ($_SESSION["unekodenboraldia"] == "2023-2024 Denboraldia")
                        echo "selected"; ?>> 2023-2024 Denboraldia
                    </option>

                    <!-- Aukera: 2022-2023 denboraldia -->
                    <!-- PHP-k berriro konprobatzen du SESSION gordeta dagoen denboraldia -->
                    <!-- Berdina bada, aukera hau hautatuta geratuko da -->
                    <option value="2022-2023 Denboraldia" <?php if ($_SESSION["unekodenboraldia"] == "2022-2023 Denboraldia")
                        echo "selected"; ?>> 2022-2023 Denboraldia
                    </option>

                </select>

                <!-- erabiltzaileak aukeratutako denboraldia bidaltzeko -->
                <input type="submit" value="Ikusi Denboraldia" class="botoia">

            </form>

        </section>

        <br>

        <!-- XML eta XSL-ak kargatzeko -->
        <section>
            <?php
            $denboraldiak = $_SESSION["unekodenboraldia"];

            $xml = new DOMDocument();
            $xml->load('./XML/boleibol_federazioa.xml');

            $xsl = new DOMDocument();
            $xsl->load('./XML/klasifikazioa.xsl');

            $proc = new XSLTProcessor();
            $proc->importStylesheet($xsl);
            $proc->setParameter('', 'denboraldia', $denboraldiak);

            echo $proc->transformToXML($xml);
            ?>

        </section>

    </main>

</body>

<br>
<br>

<!-- ================ FOOTER ================ -->
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

            <a href="#" aria-label="Instagram">
                <img src="irudiak/instagram.png" alt="Instagram">
            </a>
            
            <a href="#" aria-label="YouTube">
                <img src="irudiak/youtube.png" alt="YouTube">
            </a>

            <a href="#" aria-label="Twitter">
                <img src="irudiak/twitter.png" alt="Twitter">
            </a>

            <a href="#" aria-label="Facebook">
                <img src="irudiak/facebook.png" alt="Facebook">
            </a>

        </div>

    </section>

    <div class="footer-divider"></div>

    <div class="footer-bottom">
        © 2025 Boleibol Federazioa · Eskubide guztiak erreserbatuta
    </div>

</footer>

</html>