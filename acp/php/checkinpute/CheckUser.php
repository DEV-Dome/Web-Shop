<?php
$salt = 'bQ423hbHM8Sbdb9pjquUQU1IWxcxnybBSjqnyBJ23HjqnI3WbkxUQsxnPw813jkq';

function mySha512($str, $salt, $iterations) {
    for ($x=0; $x<$iterations; $x++) {
        $str = hash('sha512', $str . $salt);
    }
    return $str;
}

include "../obj.php";
include "../security/XSS.php";

$ErrorHandler = new ErrorObj("Eingabe-Fehler");



if(isset($_GET["update"])){
    $update = true;
    $id = $_GET["id"];
}else {
    $update = false;
}
$name = xss_clean($_GET["name"]);
if($name != ""){

    $temp = str_split($name);
    $max = sizeof($temp);

    if($max <= 2){
        $ErrorHandler->addError("Der Name, muss min. 3 Zeichen lang seinen!");
    }

    if($max >= 100){
        $ErrorHandler->addError("Der Name, darf max. 100 Zeichen lang seinen!");
    }
}else {
    $ErrorHandler->addError("Es muss ein Name angeben werden.");
}

$password = xss_clean($_GET["password"]);
if($password != ""){

    $temp = str_split($password);
    $max = sizeof($temp);

    if($max <= 2){
        $ErrorHandler->addError("Der Password, muss min. 3 Zeichen lang seinen!");
    }

    if($max >= 100){
        $ErrorHandler->addError("Der Password, darf max. 100 Zeichen lang seinen!");
    }
}else if(!$update){
    $ErrorHandler->addError("Es muss ein Password angeben werden.");
}

$kunde = xss_clean($_GET["kunde"]);
$rang = xss_clean($_GET["rang"]);
if($rang == -1) $rang = 2;


$safepw = mySha512($password, $salt, 10000);

echo $ErrorHandler->giveErro();
if($ErrorHandler->isNoError()){
    include "../sql/Sql.php";
    if($update){
        if($kunde == -1 && $_GET["password"] != ""){
            $pdo->query("UPDATE user SET Username =  '$name', Password = '".$safepw ."',Rang = $rang WHERE ID = ". $id);
        }else if($kunde == -1 && $_GET["password"] == ""){
            $pdo->query("UPDATE user SET Username =  '$name'WHERE ID = ". $id);
        }else if($kunde != -1 && $_GET["password"] != ""){
            if($id == -1){
                $pdo->query("UPDATE user SET Username =  '$name', Password = '".$safepw."', Kunde = NULL,Rang = $rang WHERE ID = ". $id);
            }else {
                $pdo->query("UPDATE user SET Username =  '$name', Password = '".$safepw."', Kunde = $kunde,Rang = $rang WHERE ID = ". $id);
            }
        }else {
            if($id == -1){
                $pdo->query("UPDATE user SET Username =  '$name', Kunde = ,Rang = $rang WHERE ID = ". $id);
            }else {
                $pdo->query("UPDATE user SET Username =  '$name', Kunde = $kunde,Rang = $rang WHERE ID = ". $id);
            }
        }
        echo "user Daten geändert";
        exit();
    }

    if($kunde == -1){
        $pdo->query("INSERT INTO user (Username, Password,Rang) VALUES ('".$name."', '".$safepw."', $rang)");
    }else {
        $pdo->query("INSERT INTO user (Username, Password,Kunde,Rang) VALUES ('".$name."', '".$safepw."' , $kunde, $rang)");
    }
    echo "user Angelegt";
}
?>