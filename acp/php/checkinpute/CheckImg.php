<?php
include "../obj.php";
$ErrorHandler = new ErrorObj("Eingabe-Fehler");

$id  = $_POST["id"];
$img =  $_POST["img"];

if(!(isset($_POST["id"]))){
    $ErrorHandler->addError("Du musst eine ID angeben!");
}

if(!(isset($_POST["img"]))){
    $ErrorHandler->addError("Du musst ein Bild angeben!");
}

$imgNew = "";

$temp = str_split($img);
$max = sizeof($temp);

for($i = 0; $i < $max; $i++){
    if($temp[$i] == "."){
        $imgNew .= "+";
        continue;
    }
    $imgNew .= $temp[$i];
}

echo $ErrorHandler->giveErro();
if($ErrorHandler->isNoError()){
    include "../sql/Sql.php";
    $fist = false;
    foreach ($pdo->query("SELECT * FROM artikel_img WHERE artikelnr like " . $id . " LIMIT 1") as $row ) {
        $fist = true;
    }
    if ($fist) {
        $pdo->query("INSERT INTO artikel_img (artikelnr, img, is_first) VALUES ('".$id."', '".$imgNew."' , false)");
    }else {
        $pdo->query("INSERT INTO artikel_img (artikelnr, img, is_first) VALUES ('".$id."', '".$imgNew."' , true)");
    }


    echo "artikel Bild Angelegt";
}
