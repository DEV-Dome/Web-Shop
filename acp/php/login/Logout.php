<?php
session_start();
if(isset($_SESSION['login'])){
    session_destroy();
    echo "Erfolgrich ausgeloggt!";
}