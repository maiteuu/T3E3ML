<?php
require_once 'erabiltzaile_check.php';

// Ez badugu denboraldia aukeratu, defektuki 2024-2025 denboraldia kargatuko da
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

    <title>Kontaktatu - Boleibol Federazioa</title>

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

        <section class="tabla-contenedor">

            <h1 class="taldeak-titulua"><b>Kontaktatu gurekin!! ;)</b></h1>

            <!-- Mezua ondo bidali bada -->
            <?php if (isset($_SESSION['contact_success'])): ?>

                <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                    <?= $_SESSION['contact_success'] ?>
                </div>

                <!-- Mezua garbitu sessionetik -->
                <?php unset($_SESSION['contact_success']); ?>
            <?php endif; ?>

            <!-- Errore mezua -->
            <?php if (isset($_SESSION['contact_error'])): ?>
                
                <div class="errore_mezua">
                    <?= $_SESSION['contact_error'] ?>
                </div>

                <!-- Sessionetik kendu -->
                <?php unset($_SESSION['contact_error']); ?>
            <?php endif; ?>

            <!-- Kontaktu diseinua "Uiverse.io" -etik dator -->
            <div class="form-container">

                <form action="kontaktatu.php" method="POST" class="form">
                    <div class="form-group">
                        <label>Izen-abizenak</label>
                        <input type="text" name="izena" required>
                    </div>

                    <div class="form-group">
                        <label>Helbide elektronikoa</label>
                        <input type="email" name="emaila" required>
                    </div>

                    <div class="form-group">
                        <label>Telefonoa</label>
                        <input type="tel" name="telefonoa" required placeholder= "Ej: 6256784" pattern="[0-9]{9}">
                    </div>

                    <div class="form-group">
                        <label>Mezua</label>
                        <textarea name="mezua" rows="10" cols="50" required></textarea>
                    </div>

                    
                    <button class="form-submit-btn" type="submit">Bidali</button>
                </form>

            </div>

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
</body>

</html>