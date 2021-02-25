<?php
include "../obj.php";
include "../security/XSS.php";

$ErrorHandler = new ErrorObj("Eingabe-Fehler");

if(isset($_GET["update"])){
    $update = true;
    $id_update = $_GET["id"];
}else {
    $update = false;
}

$beschreibung = xss_clean( $_GET["beschreibung"]);
if($beschreibung != ""){

    $temp = str_split($beschreibung);
    $max = sizeof($temp);

    if($max <= 2){
        $ErrorHandler->addError("Die Beschreibung, muss min. 3 Zeichen lang seinen!");
    }

    if($max >= 250){
        $ErrorHandler->addError("Die Beschreibung, darf max. 250 Zeichen lang seinen!");
    }
}else {
    $ErrorHandler->addError("Es muss eine Beschreibung angeben werden.");
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
    include "../sql/Sql.php";
    if(!$update){
        foreach ($pdo->query("SELECT * FROM rang WHERE Name like '$name' LIMIT 1") as $row){
            $ErrorHandler->addError("Es gibt Bereits einen Rang mit dem Namen!");
        }
    }

}else {
    $ErrorHandler->addError("Es muss ein Name angeben werden.");
}

$pem = $_GET["perm"];
//$pem = explode(";",$pem[0]);
//print count($values) . " values passed.";

echo $ErrorHandler->giveErro();
if($ErrorHandler->isNoError()){
    if($update){
        $pdo->query("UPDATE rang SET Name='$name',Dscribe='$beschreibung' WHERE ID like $id_update");
        for($i = 0; $i < sizeof($pem); $i++){
            $tmp = explode(":",$pem[$i]);

            $permission = 0;
            if($tmp[1] == "yes") $permission = 1;


            foreach ($pdo->query("SELECT * FROM rang_permission WHERE Permission like '$tmp[0]'") as $row){
                $id = $row["ID"];

                $pdo->query("UPDATE rang_permission_syc SET Permission=$id,Rang=$id_update,Haspermission=$permission WHERE Permission like $id AND Rang like $id_update");
            }
        }
        echo "Rang Daten geändert";
    }else {
        $pdo->query("INSERT INTO rang (Name, Dscribe, Isdefault) VALUES ('$name', '$beschreibung', false)");
        $rang = "";
        foreach ($pdo->query("SELECT * FROM rang WHERE Name like '$name' LIMIT 1") as $row) {
            $rang = $row["ID"];
        }
        for ($i = 0; $i < sizeof($pem); $i++) {
            $tmp = explode(":", $pem[$i]);

            $permission = 0;
            if ($tmp[1] == "yes") $permission = 1;


            foreach ($pdo->query("SELECT * FROM rang_permission WHERE Permission like '$tmp[0]'") as $row) {
                $id = $row["ID"];
                $pdo->query("INSERT INTO rang_permission_syc (Permission , Rang, Haspermission) VALUES ($id, $rang, $permission)");
            }
        }
        echo "Rang Angelegt";
    }
}