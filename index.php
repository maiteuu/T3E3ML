<?php
session_start();

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

    <title>Hasiera - Boleibol Federazioa</title>

</head>

<body>
    <header>

        <!-- Aukeratutako denboraldia agertuko da orriaren gohiko partean -->
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

        <section class="portada">

            <article class="portada-container">

                <div class="portada-img">
                    <img src="irudiak/portada.jpg" alt="webguneko portada">
                </div>

                <div class="portada-content">

                    <h1>Nortzuk gara?</h1>

                    <p class="intro">
                        Gure federazioa eskualdeko boleibolaren ardatza da: klubak biltzen ditugu,
                        txapelketak antolatzen ditugu eta gure kirolaren garapena sustatzen dugu.
                    </p>

                    <ul class="zerDago">
                        <li>🏐 Sailkapen eguneratuak</li>
                        <li>👥 Talde eta jokalarien informazioa</li>
                        <li>📊 Partidak eta emaitzak</li>
                        <li>📰 Federazioko berriak</li>
                    </ul>

                    <p class="ongiEtorria">
                        Ongi etorri gure boleibol federaziora — hemen hasten da emozioa! :)
                    </p>

                </div>

            </article>

            <br>

        </section>

        <h1 class="taldeak-titulua"> Federazioaren <span>Taldeak</span></h1>
        <h2 class="info">Hemen ikusi aha dira gure federazioan ze talde partaideek daukagun: </h2>

        <section class="kutxak_talde">

            <article>
                <div class="card">
                    <img src="irudiak/Miribilla Uhinen Jokoak.png" alt="Miribilla Uhinen Jokoak logoa" width="140px">
                </div>
                <p>Miribilla Uhinen Jokoak</p>
            </article>

            <article>
                <div class="card">
                    <img src="irudiak/Matiko Txirrindulariak.png" alt="Matiko Txirrindulariak logoa" width="140px">
                </div>
                <p>Matiko Txirrindulariak</p>
            </article>

            <article>
                <div class="card">
                    <img src="irudiak/Usansolo Ortzadak.png" alt="Usansolo Ortzadak logoa" width="140px">
                </div>
                <p>Usansolo Ortzadak</p>
            </article>

            <article>
                <div class="card">
                    <img src="irudiak/Santutxu Haizeak.png" alt="Santutxu Haizeak logoa" width="150px">
                </div>
                <p>Santutxu Haizeak</p>
            </article>

            <article>
                <div class="card">
                    <img src="irudiak/Otxarkoaga Distira.png" alt="Otxarkoaga Distira logoa" width="140px">
                </div>
                <p>Otxarkoaga Distira</p>
            </article>

            <article>
                <div class="card">
                    <img src="irudiak/Txurdinaga Harriak.png" alt="Txurdinaga Harriak logoa" width="140px">
                </div>
                <p>Txurdinaga Harriak</p>
            </article>

        </section>

    </main>

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

</body>

</html>