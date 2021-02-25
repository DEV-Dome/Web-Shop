<?php
include "../obj.php";
include "../security/XSS.php";

$ErrorHandler = new ErrorObj("Eingabe-Fehler");
if(isset($_GET["update"])){
    $update = true;
    $id = $_GET["id"];
}else {
    $update = false;
}

if(isset($_GET["usid"])){
    $usid = $_GET["usid"];
}else {
    $usid = null;
}


$name = xss_clean($_GET["name"]);
if($name != ""){

    $temp = str_split($name);
    $max = sizeof($temp);

    if($max <= 2){
        $ErrorHandler->addError("Der Name, muss min. 3 Zeichen lang seinen!");
    }

    if($max >= 30){
        $ErrorHandler->addError("Der Name, darf max. 30 Zeichen lang seinen!");
    }
}else {
    $ErrorHandler->addError("Es muss ein Name angeben werden.");
}

$beschreibung = xss_clean($_GET["beschreibung"]);
if($beschreibung != ""){

    $temp = str_split($beschreibung);
    $max = sizeof($temp);

    if($max <= 2){
        $ErrorHandler->addError("Die Beschreibung muss min. 3 Zeichen lang seinen!");
    }

    if($max >= 500){
        $ErrorHandler->addError("Die Beschreibung, darf max. 500 Zeichen lang seinen!");
    }
}else {
    $ErrorHandler->addError("Es muss eine Beschreibung angeben werden.");
}


$preis = xss_clean($_GET["preis"]);
if($beschreibung == ""){
    $ErrorHandler->addError("Es muss ein Preis angeben werden.");
}
$preis = floatval($preis);
if(!is_float($preis)){
    $ErrorHandler->addError("Der Preis muss eine Zahl seinen.");
}


$bestand = xss_clean($_GET["bestand"]);
if($bestand == ""){
    $ErrorHandler->addError("Es muss ein Bestand angeben werden.");
}

//Admin artikel = Im Admininterface angelegt; = system
if($usid == null) {
    echo $ErrorHandler->giveErro();
    if($ErrorHandler->isNoError()){

        include "../sql/Sql.php";
        if($update){
            $pdo->query("UPDATE artikel SET beschreibung = '".$beschreibung."', preis = '".$preis."', bestand = '".$bestand."', name = '".$name."' WHERE artikelnr = ".$id);
            echo "artikel Daten geändert";
            exit();
        }
        $pdo->query("INSERT INTO artikel (name, beschreibung, preis, bestand) VALUES ('".$name."','".$beschreibung."', '$preis' , $bestand)");
        echo "artikel Angelegt";
    }
}else {
    //User artikel
    echo $ErrorHandler->giveErro();
    if($ErrorHandler->isNoError()){
        include "../sql/Sql.php";
        $pdo->query("INSERT INTO artikel (name, beschreibung, preis, bestand, Owner) VALUES ('".$name."','".$beschreibung."', '$preis' , $bestand, $usid)");
        echo "artikel Angelegt";
    }
}
