<?php
session_start();

include "../../acp/php/sql/Sql.php";
include "../../acp/php/rang/Rang.php";
$rang = new Rang($_SESSION['rang'], $pdo);
if(!isset($_SESSION['login'])){
    echo "Du musst eingeloggt seinen, um deinen Account verwalten zu können.";
    exit();
}
if (!$rang->hasPermission("artikel.user.see")){
    echo "<center>Du hast nicht nötigen Berechtigungen, um artikel im Shop zu verkaufen.</center>";
    echo "<center>Bitte wende dich an die Administratoren des Shop, wenn du dies tun möchtest.</center>";
    exit();
}
?>
<script type="text/javascript" src="js/functions.js"></script>
<script src="js/pages/artikel/UserArtikelVerwalten.js"></script>

<div class="row">
    <div class="col s3 m4 l2"></div>
    <div class="col s6 m4 l8"><p>
        <div class="input-field col s6">
            <input oninput="suchen(document.getElementById('suchen').value);" id="suchen" type="text" class="validate">
            <label for="suchen">Artikel Suchen [Name]</label>
        </div></p></div>

    <div class="col s3 m4 l2"><p><a <?php if(!($rang->hasPermission("artikel.user.add"))) echo "disabled";?> onclick="loadSubPageAccount('pages/user/Artikel/UserArtikelImgUpload.php')" class="waves-effect waves-light btn-small #2196f3 blue"><i class="material-icons left">add</i>Artikel Bild Uploden</a></p></div>
    <div class="col s3 m4 l2"><p><a <?php if(!($rang->hasPermission("artikel.user.add"))) echo "disabled";?> onclick="loadSubPageAccount('pages/user/Artikel/UserArtikelCreate.php')" class="waves-effect waves-light btn-small green"><i class="material-icons left">add</i>Artikel Erstellen</a></p></div>


</div>

<table>
    <thead>
    <tr>
        <th>Arikel Nummer</th>
        <th>Name</th>
        <th>Preis</th>
        <th>Bestand</th>
        <th>Arikel-Bearbeiten</th>
        <th>Bilder-Bearbeiten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody id="such_output">
    <?php

    foreach ($pdo->query("SELECT * FROM artikel WHERE Owner = ". $_SESSION['id']) as $row) {
            echo "<tr><td>".$row['artikelnr']."</td><td>".$row['name']."</td><td>".$row['preis']."</td><td>".$row['bestand']."</td>";
            echo "<td><a class=\"waves-effect waves-light btn-small green  \" onclick='updateArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>";
            echo " <td><a class=\"waves-effect waves-light btn-small #2196f3 blue \" onclick='imgArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>Bilder</a></td>";
            echo " <td><a class=\"waves-effect waves-light btn-small red \" onclick='delArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
    }

    ?>
    </tbody>
</table>
