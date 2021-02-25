<?php
session_start();

$userId = $_GET["id"];
$failBestand = false;
$failMessage = "";
$j = 0;

if(!isset($_SESSION['WB'])){
    echo "Kein Artikel im Warenkorb vorhanden!";
    exit();
}

include "../acp/php/sql/Sql.php";

foreach ($pdo->query("SELECT * FROM artikel WHERE artikelnr like ". $_SESSION['WB'][$j]["id"]) as $row) {
    if ($row["bestand"] < $_SESSION['WB'][$j]["anzahl"]) {
        $failBestand = true;
        $failMessage = $row["name"];
    }
 $j++;
}
if(!$failBestand){
    $pdo->query("INSERT INTO bestellungen (user, sendeverfolung, rechnung) VALUE ($userId, NULL, NULL)");

    foreach ($pdo->query("SELECT * FROM bestellungen WHERE user = ". $userId . " ORDER BY ID DESC LIMIT 1") as $row) {
        $id = $row["ID"];
    }

    for($i = 0; $i < count($_SESSION['WB']); $i++){
        foreach ($pdo->query("SELECT * FROM artikel WHERE artikelnr like ". $_SESSION['WB'][$i]["id"]) as $row) {

           // echo "INSERT INTO warenkorb_arikel_syc (bestellungesid, artikel, menge) VALUE (".$id.",".$row["artikelnr"].",".$_SESSION['WB'][$i]["anzahl"].")";
            $pdo->query("INSERT INTO warenkorb_arikel_syc (bestellungesid, artikel, menge) VALUE (".$id.",".$row["artikelnr"].",".$_SESSION['WB'][$i]["anzahl"].")");
            $pdo->query("UPDATE artikel set bestand =" . ($row["bestand"] - $_SESSION['WB'][$i]["anzahl"]) . " WHERE artikelnr =" . $row["artikelnr"]);
        }
    }
}


if($failBestand){
    echo "Es sind nicht Ausreind Artikel von: '". $failMessage . "' vorhanden.";
    exit();
}
unset($_SESSION['WB']);
echo "Einkauf erfolgreich";