<?php
session_start();
if(!isset($_SESSION['WB'])){
    $_SESSION['WB'] = array(["id" => $_GET["id"], "anzahl" => 1]);
}else {
    array_push( $_SESSION['WB'], ["id" => $_GET["id"], "anzahl" => 1]);
}


echo "Warenkorb hinzugefügt";
?>
