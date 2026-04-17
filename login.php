<?php

session_start();

// XML kargatu DOM erabilita
$xml = new DOMDocument();
$xml->load('./XML/boleibol_federazioa.xml');

#XPath erabiltzcko aldagai berri bat sortuko dugu
$xpath = new DOMXPath($xml);
#php: namespace erregistratu behar dugu
$xpath->registerNamespace("php", "http://php.net/xpath");
#PHP funtzioak ere erregistratu behar ditugu (no restrictions)
$xpath->registerPHPFunctions();

// Sortu aldagaia bilatu behar den izenarekin
$user = $_POST["erabiltzailea"];
$pass = $_POST["pasahitza"];

#XPath kontsulta
$consulta = "//user[username= '$user' and password= '$pass']";

#Xpath kontsulta betetzen duten nodoak bilatzen ditut
$erabiltzaileak = $xpath->query($consulta);

#Zenbat nodo bueltatu duen kontsultak aztertzen dugu
$numNodos = $erabiltzaileak->length;

if ($numNodos > 0) {

    foreach ($erabiltzaileak as $erabiltzailea) {

    $rol = $erabiltzailea->getElementsByTagName("rol")->item(0)->nodeValue;

    $_SESSION["nombreUsuario"] = $user;
    $_SESSION["rolUsuario"] = $rol;
}

    header("Location:index.php");
} else {
    header("Location:loginDiseinua.php?error");
}
