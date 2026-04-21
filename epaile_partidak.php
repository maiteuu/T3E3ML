<?php
// Fitxategi honek erabiltzailea epailea dela egiaztatzen du (saioa eta baimenak)
require_once 'epaile_check.php';

// ================== DENBORALDIA (SESSION) ==================
// Saioan denboraldirik ez badago, lehenetsia ezarri
if (!isset($_SESSION["unekodenboraldia"])) {
    $_SESSION["unekodenboraldia"] = "2024-2025 Denboraldia";
}

// ================== XML FITXATEGIA ==================
// XML fitxategiaren kokapena
$xmlFile = 'XML/boleibol_federazioa.xml';

// Denboraldiak gordetzeko array hutsa
$temporadas = [];

// XML existitzen bada
if (file_exists($xmlFile)) {

    // XML fitxategia kargatu
    $xml = simplexml_load_file($xmlFile);

    // Denboraldi guztiak hartu eta array batean gorde
    foreach ($xml->denboraldiak->denboraldia as $denb) {
        $temporadas[] = (string)$denb->denboraldiIzena;
    }
}

// ================== DENBORALDIA AUKERATU ==================
// GET bidez datorren denboraldia baliozkoa bada → hori erabili
if (isset($_GET['denboraldia']) && in_array($_GET['denboraldia'], $temporadas)) {
    $denboraldiaAukeratua = $_GET['denboraldia'];
} else {
    // Bestela → session-eko lehenetsia
    $denboraldiaAukeratua = $_SESSION["unekodenboraldia"];
}

// ================== JARDUNALDIAK LORTU ==================
$jornadas = [];

if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);

    foreach ($xml->denboraldiak->denboraldia as $denb) {

        // Aukeratutako denboraldia aurkitu
        if ((string)$denb->denboraldiIzena === $denboraldiaAukeratua) {

            // Denboraldi horretako jardunaldi guztiak gorde
            foreach ($denb->jardunaldiak->jardunaldia as $jard) {
                $jornadas[] = (string)$jard->jardunaldiZbk;
            }

            break; // aurkitu ondoren irten
        }
    }
}

// ================== JARDUNALDIA AUKERATU ==================
// GET bidez badator eta zuzena bada → hori
// Bestela → lehenengo jardunaldia
$jardunaldiaAukeratua = isset($_GET['jardunaldia']) && in_array($_GET['jardunaldia'], $jornadas)
    ? $_GET['jardunaldia']
    : ($jornadas[0] ?? null);
?>

<!DOCTYPE html>
<html lang="eu">

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

    <title>Partiduak Ikusi - Epaile</title>

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

        <!-- Logueatuta zaudenean ongi etorria,  erabiltzailearen izena eta bere rola aterako da -->
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

                <!-- Logueatuta dagoenean logout aterako da -->
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

        <section class="tabla-contenedor">

            <h1 class= "taldeak-titulua"><b>Partiduak Ikusi (Epaile)</b></h1>

            <!-- ================== FILTROAK ================== -->
            <form method="get" class="comboBox">

                <!-- Denboraldia aukeratzeko -->
                <div class="filtro-item">
                    <label>Denboraldia</label>

                    <select name="denboraldia" onchange="this.form.submit()">
                        <?php foreach ($temporadas as $temp): ?>

                            <option value="<?= htmlspecialchars($temp) ?>" <?= $temp === $denboraldiaAukeratua ? 'selected' : '' ?>>
                                <?= htmlspecialchars($temp) ?>
                            </option>

                        <?php endforeach; ?>
                    </select>

                </div>

                <!-- Jardunaldia aukeratzeko -->
                <div class="filtro-item">
                    <label>Jardunaldia</label>

                    <select name="jardunaldia" onchange="this.form.submit()">

                        <?php foreach ($jornadas as $jorn): ?>
                            
                            <option value="<?= htmlspecialchars($jorn) ?>" <?= $jorn == $jardunaldiaAukeratua ? 'selected' : '' ?>>
                                <?= htmlspecialchars($jorn) ?>. Jardunaldia
                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>

            </form>

            <?php if ($jardunaldiaAukeratua): ?>

                <?php
                // ================== PARTIDUAK ERAKUTSI ==================
                if (file_exists($xmlFile)) {

                    $xml = simplexml_load_file($xmlFile);

                    foreach ($xml->denboraldiak->denboraldia as $denb) {

                        if ((string)$denb->denboraldiIzena === $denboraldiaAukeratua) {

                            foreach ($denb->jardunaldiak->jardunaldia as $jard) {

                                if ((string)$jard->jardunaldiZbk == $jardunaldiaAukeratua) {

                                    echo '<h2 class = "partidu_tituloa"> ' . $denboraldiaAukeratua . ' - ' . $jardunaldiaAukeratua . '. Jardunaldia</h2>';
                                    echo '<div class="partida-taulak">';

                                    // Partida bakoitza erakutsi
                                    foreach ($jard->partidak->partida as $partida) {

                                        $etxekoa = (string)$partida->etxekoTaldea;
                                        $kanpokoa = (string)$partida->kanpokoTaldea;
                                        $emaitza = (string)$partida->emaitza;

                                        // Emaitza hutsik badago → "—"
                                        $emaitzaMostrar = !empty($emaitza) ? $emaitza : '—';

                                        echo '<div class="partida">';

                                        // Taldeak (ezker/eskuin)
                                        echo '<div class="taldeak">';
                                        echo '<span class="etxekoa">' . htmlspecialchars($etxekoa) . '</span>';
                                        echo '<span class="vs">vs</span>';
                                        echo '<span class="kanpokoa">' . htmlspecialchars($kanpokoa) . '</span>';
                                        echo '</div>';

                                        // Emaitza behean
                                        echo '<div class="emaitza">' . htmlspecialchars($emaitzaMostrar) . '</div>';

                                        echo '</div>';
                                    }

                                    echo '</div>';

                                    break 2;
                                }
                            }
                        }
                    }
                }
                ?>

            <?php else: ?>
                <p>Ez dago jardunaldirik aukeratutako denboraldian.</p>
            <?php endif; ?>

        </section>

    </main>

</body>

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

