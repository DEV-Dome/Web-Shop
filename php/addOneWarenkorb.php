<?php
session_start();
if(isset($_SESSION['WB'])){
    $_SESSION['WB'][$_GET["id"]]["anzahl"]++;
}
echo "Anzahl verändert";