<?php
session_start();

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

    <title>Berriak - Boleibol Federazioa</title>
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

    <main class="berriak-container">

        <h1 class="taldeak-titulua"> Federazioaren <span>Berriak</span></h1>

        <section class="notizien-grid">

            <!--  ========== 1. Albistea ========== -->
            <article id="notizia-card" class="albiste1-card">

                <div class="notizia-header">
                    <span class="notizia-category">Federazioa</span>
                    <span class="notizia-date">2025-03-10</span>
                </div>

                <div class="notizia-content">
                    <h2 class="notizia-title">Matiko Txirrindulariak eta Txurdinaga Harriak lidergoan sendotzen dira</h2>

                    <div class="notizia-summary">
                        <p>
                            Asteburu garrantzitsua izan da federazioko ligan, Matiko Txirrindulariak eta Txurdinaga
                            Harriak
                            garaipen garrantzitsuak lortuta sailkapenaren goialdean kokatu direlarik...
                        </p>
                    </div>

                    <div id="notizia-full" class="albiste1-full" style="display:none;">
                        <p>
                            Federazioko ligako azken jardunaldian, Matiko Txirrindulariak eta Txurdinaga Harriak taldeek
                            maila bikaina erakutsi dute. Matikoko taldeak partida sendoa jokatu zuen etxean,
                            defentsan eta erasoan nagusituz.
                        </p>

                        <p>
                            Bestalde, Txurdinaga Harriak taldeak kanpoan lortutako garaipenarekin bere sendotasuna
                            berretsi du. Bi taldeak ligako faborito nagusien artean daude eta denboraldia
                            oso irekia aurreikusten da.
                        </p>

                        <p>
                            Federaziotik zorionak eman zaizkie bi taldeei egindako lanagatik eta kiroltasunagatik.
                        </p>

                        <div class="notizia-image">
                            <img src="irudiak/albiste1.jpg" alt="Matiko Txirrindularien partidua jokatzen">
                            <p class="image-caption">
                                Matiko Txirrindularien partidua jokatzen.
                            </p>
                        </div>

                    </div>

                </div>

                <div class="notizia-actions">
                    <button class="erakutsi1" id="btnErakutsi">Irakurri gehiago</button>
                    <button class="ezkutatu1" id="bntEzkutatu" style="display:none;">Itxi</button>
                </div>

            </article>

            <!-- ========== 2. Albistea ==========-->
            <article id="notizia-card" class="albiste2-card">
                
                <div class="notizia-header">
                    <span class="notizia-category">Taldeak</span>
                    <span class="notizia-date">2025-03-08</span>
                </div>

                <div class="notizia-content">
                    <h2 class="notizia-title">Santutxu Haizeak eta Usansolo Ortzadak harrobiko lana indartzen</h2>

                    <div class="notizia-summary">
                        <p>
                            Santutxu Haizeak eta Usansolo Ortzadak taldeek harrobiko jokalarien garapenean
                            apustu sendoa egiten jarraitzen dute denboraldi honetan...
                        </p>
                    </div>

                    <div class="albiste2-full" style="display:none;">
                        <p>
                            Santutxu Haizeak taldeak gazte mailako entrenamendu saio bereziak antolatu ditu,
                            teknika eta talde lana indartzeko helburuarekin. Emaitzak nabariak izaten ari dira
                            ligako partiduetan.
                        </p>

                        <p>
                            Usansolo Ortzadak, bere aldetik, eskola-mailako jokalariekin lan handia egiten ari da,
                            federazioaren laguntzarekin. Bi klubak etorkizuneko erreferente bihurtzeko bidean daude.
                        </p>

                        <div class="notizia-image">
                            <video width="100%" height="250" autoplay muted loop>
                                <source src="bideoak/albiste2.mp4" type="video/mp4">
                                <source src="bideoak/albiste2.webm" type="video/webm">
                                Zure arakatzaileak ez du bideoa onartzen.
                            </video>
                            <p class="image-caption">
                                Euskal taldearen ospakizuna partidaren ostean
                            </p>
                        </div>

                    </div>

                </div>

                <div class="notizia-actions">
                    <button class="erakutsi2" id="btnErakutsi">Irakurri gehiago</button>
                    <button class="ezkutatu2" id="bntEzkutatu" style="display:none;">Itxi</button>
                </div>
            </article>

            <!-- ========== 3. Albistea ==========-->
            <article id="notizia-card" class="albiste3-card">
                <div class="notizia-header">
                    <span class="notizia-category">Emakumeen Fitxaketak Federazioan</span>
                    <span class="notizia-date">2025-03-12</span>
                </div>

                <div class="notizia-content">
                    <h2 class="notizia-title">Emakumeen boleibola hazten ari da federazioan</h2>

                    <div class="notizia-summary">
                        <p>Federazioko emakumeen taldeek aurrerapauso handia eman dute denboraldi honetan,
                            partaidetza handituz eta lehiaketa maila sendotuz...</p>
                    </div>

                    <div class="albiste3-full" style="display:none;">
                        <p>
                            Azken denboraldietan, federazioak emakumeen boleibolaren garapena lehentasun
                            gisa hartu du. Horren ondorioz, emakumeen talde kopurua handitu da eta
                            entrenamendu baldintzak nabarmen hobetu dira.
                        </p>

                        <p>
                            Matiko Txirrindulariak, Santutxu Haizeak eta Otxarkoaga Distira taldeek
                            emakumezkoen atalak indartu dituzte, harrobiko jokalariei aukera berriak
                            eskainiz. Gazte askok federazioko ligan debutatzeko aukera izan dute.
                        </p>

                        <p>
                            Federazioak lanean jarraituko du berdintasuna, ikusgarritasuna eta
                            emakumeen kirola sustatzeko, klubekin elkarlanean.
                        </p>

                        <div class="notizia-image">
                            <img src="irudiak/emakumeak.jpg" alt="berdintasuna">
                            <p class="image-caption">
                                Euskal taldearen ospakizuna partidaren ostean
                            </p>

                        </div>

                    </div>
                </div>

                <div class="notizia-actions">
                    <button class="erakutsi3" id="btnErakutsi">Irakurri gehiago</button>
                    <button class="ezkutatu3" id="bntEzkutatu" style="display:none;">Itxi</button>

                </div>
            </article>
            <!-- ========== 4. Albistea ========== -->
            <article id="notizia-card" class="albiste4-card">
                <div class="notizia-header">
                    <span class="notizia-category">Fitxaketak Federazioan</span>
                    <span class="notizia-date">2025-03-18</span>
                </div>

                <div class="notizia-content">
                    <h2 class="notizia-title">
                        Miribilla Uhinen Jokoak taldeak fitxaketa estrategikoak aurkeztu ditu
                    </h2>

                    <div class="notizia-summary">
                        <p>
                            Miribilla Uhinen Jokoak taldeak denboraldi berriari begira egindako fitxaketa
                            berriak aurkeztu ditu, taldea indartzeko helburuarekin...
                        </p>
                    </div>

                    <div class="albiste4-full" style="display:none;">
                        <p>
                            Miribilla Uhinen Jokoak klubak azken asteetan hainbat fitxaketa garrantzitsu
                            egin ditu, bai esperientzia handiko jokalariekin bai harrobiko promesekin.
                            Helburua lehiakortasuna handitzea eta denboraldiari indarrez ekitea da.
                        </p>

                        <p>
                            Taldeko zuzendaritzak adierazi du fitxaketa hauek federazioko ligan protagonismo
                            handiagoa izateko pentsatuta daudela. Entrenamendu saioetan jarrera oso positiboa
                            eta lan giro bikaina nabarmendu dira.
                        </p>

                        <p>
                            Miribilla Uhinen Jokoak taldeak zaleei eskerrak eman dizkie jasotako babesagatik
                            eta denboraldian zehar ahalik eta emaitzarik onenak lortzeko konpromisoa berretsi du.
                        </p>

                        <div class="notizia-image">
                            <img src="irudiak/4. berria.jpg" alt="Miribilla Uhinen Jokoak fitxaketak">
                            <p class="image-caption">
                                Miribilla Uhinen Jokoak taldeko jokalari berrien aurkezpena.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="notizia-actions">
                    <button class="erakutsi4" id="btnErakutsi">Irakurri gehiago</button>
                    <button class="ezkutatu4" id="bntEzkutatu" style="display:none;">Itxi</button>
                </div>
            </article>

            <!-- ========== 5. Albistea ========== -->
            <article id="notizia-card" class="albiste5-card">
                <div class="notizia-header">
                    <span class="notizia-category">Denboraldiaren Prestaketa</span>
                    <span class="notizia-date">2025-03-20</span>
                </div>

                <div class="notizia-content">
                    <h2 class="notizia-title">
                        Santutxu Haizeak prestaketa fasean erritmo ona hartzen ari da
                    </h2>

                    <div class="notizia-summary">
                        <p>
                            Santutxu Haizeak taldeak denboraldi berrirako prestaketa lanekin jarraitzen du,
                            entrenamendu saio biziekin eta helburu argiekin...
                        </p>
                    </div>

                    <div class="albiste5-full" style="display:none;">
                        <p>
                            Santutxu Haizeak klubak azken asteetan entrenamendu intentsiboak burutu ditu,
                            jokalarien egoera fisikoa eta talde kohesioa indartzeko asmoz.
                            Taldeak konpromiso handia erakutsi du saio guztietan.
                        </p>

                        <p>
                            Entrenatzaileak azpimarratu du jarrera eta lanerako gogoa ezin hobeak izan direla,
                            eta jokalarien arteko elkarlana nabarmen hobetu dela.
                            Helburua denboraldia sendo hastea da.
                        </p>

                        <p>
                            Zuzendaritzak zaleei dei egin die harmailetatik babesa ematen jarraitzeko,
                            Santutxu Haizeak komunitatearen indarra ezinbestekoa baita.
                        </p>

                        <div class="notizia-image">
                            <video width="100%" height="250" autoplay muted loop>
                                <source src="bideoak/5. berria.mp4" type="video/mp4">
                                <source src="bideoak/5. berria.webm" type="video/webm">
                                Zure arakatzaileak ez du bideoa onartzen.
                            </video>
                            <p class="image-caption">
                                Santutxu Haizeak taldeko entrenamendu saio bat.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="notizia-actions">
                    <button class="erakutsi5" id="btnErakutsi">Irakurri gehiago</button>
                    <button class="ezkutatu5" id="bntEzkutatu" style="display:none;">Itxi</button>
                </div>
            </article>

            <!-- 6. Berria -->
            <article id="notizia-card" class="albiste6-card">
                <div class="notizia-header">
                    <span class="notizia-category">PARTIDU BEREZIA !!!</span>
                    <span class="notizia-date">2025-03-24</span>
                </div>

                <div class="notizia-content">
                    <h2 class="notizia-title">
                        Otxarkoaga Distira hondartzan hasi da, dibertsioz beteriko garaipenarekin.
                    </h2>

                    <div class="notizia-summary">
                        <p>
                            Otxarkoaga Distira taldeak bere lehen partida jokatu zuen hondartzan, merezitako
                            garaipenarekin
                            amaitu zen esperientzia ezberdinaz gozatuz...
                        </p>
                    </div>

                    <div class="albiste6-full" style="display:none;">
                        <p>

                            Otxarkoagako Distira taldeak oso jardunaldi berezia bizi izan zuen bere lehen partida
                            hondartzan
                            jokatzean. Giroa, ingurua eta ondo pasatzeko gogoaz etorri dira, partida ahaztezina izan zen
                            jokalari guztientzat.

                        </p>

                        <p>
                            Ohikoa ez den lekua izan arren, taldea berehala egokitu zen hondarrera, eta joko-maila
                            bikaina erakutsi zuten, ahalegina, laguntasuna eta barre ugari uztartuz partida osoan zehar.
                        </p>

                        <p>
                            Partida irabazi batekin amaitu zen Otxarkoaga Distira taldearentzat, baina garrantzitsuena
                            taldearen gozamena eta taldearen batasuna izan zen, taldearen espiritua indartuz zelai
                            barruan
                            eta kanpoan.
                        </p>

                        <div class="notizia-image">
                            <img src="irudiak/6. berria.jpg" alt="Otxarkoaga Distira en la playa">
                            <p class="image-caption">
                                Otxarkoaga Distira hondartzan jokatutako lehen partidua.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="notizia-actions">
                    <button class="erakutsi6" id="btnErakutsi">Irakurri gehiago</button>
                    <button class="ezkutatu6" id="bntEzkutatu" style="display:none;">Itxi</button>
                </div>
            </article>
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