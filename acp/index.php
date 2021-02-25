<?php
session_start();
include "php/sql/CreateTable.php";
include "php/rang/DefaultValuePermission.php";
include "php/rang/Rang.php";
if(isset($_SESSION['login'])){
    $login = true;
    $rang = new Rang($_SESSION['rang'], $pdo);
}else {
    $rang = new Rang(-1, $pdo);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Control Pannel</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/pages/login/login.js"></script>
    <script type="text/javascript" src="js/pages/login/logout.js "></script>
<style>
  body {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    main {
        flex: 1 0 auto;
    }
</style>
</head>
<body class="#b2dfdb teal lighten-4" style="width: 100vw;>
<div style=" width: 100vw;">
    <nav class="nav-extended #4db6ac teal lighten-2">
        <div class="nav-wrapper ">
            <a href="" style="padding-left: 1vw;" class="brand-logo">ACP</a>
            <ul class="right hide-on-med-and-down">
                <li onclick="location.href='../'"><a><i  class="material-icons">store</i></a></li>
                <li onclick="logout(true);"><a><i  class="material-icons">power_settings_new</i></a></li>
            </ul>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a>Home</a></li>
                <li class="tab" onclick="loadMainPage('pages/BenutzerVerwaltung.php')"><a>Benutzer</a></li>
                <li class="tab" onclick="loadMainPage('pages/ArtikelVerwaltung.php')"><a>Artikel</a></li>
                <li class="tab" onclick="loadMainPage('pages/KundenVerwaltung.php')"><a>Kunden</a></li>
                <li class="tab" onclick="loadMainPage('pages/RangVerwaltung.php')"><a>Rang</a></li>
            </ul>
        </div>
    </nav>
</div>
<div style="width: 100vw;" id="page_value" class="" style=" width: 100vw; height: 100vh;">
    <?php
    if (!isset($_SESSION['login']) || !$rang->hasPermission("acp.use")){
        ?>
        <div class="row">
            <div class="col s12"><p>Bitte logge dich ein:</p></div>
            <div class="col s12"><div class="input-field col s6"> <input placeholder="" id="user" type="text" class="validate black-text"></div></div>
            <div class="col s12"><div class="input-field col s6"> <input  id="pw" type="password" class="validate"></div></div>
            <div class="col s12"><a onclick="login(document.getElementById('user').value, document.getElementById('pw').value)" class="waves-effect waves-light btn">Einloggen</a></div>
        </div>
        <?php
    }else {
        echo "<script>loadMainPage('pages/BenutzerVerwaltung.php')</script>";
    }
    ?>
</div>


<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>