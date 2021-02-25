<?php
session_start();

include "../php/sql/Sql.php";
include "./../php/rang/Rang.php";
$rang = new Rang($_SESSION['rang'], $pdo);

if (!isset($_SESSION['login']) || !$rang->hasPermission("acp.use")){
    echo "<script>location.reload()</script>";
    exit();
}

?>
<script src="js/pages/ArtikelVerwalten.js"></script>
<div class="row">
    <div class="col s3 m4 l2"></div>
    <div class="col s6 m4 l8"><p>
        <div class="input-field col s6">
            <input oninput="suchen(document.getElementById('suchen').value);" id="suchen" type="text" class="validate">
            <label for="suchen">Artikel Suchen [Name]</label>
        </div></p></div>

    <div class="col s3 m4 l2"><p><a <?php if(!($rang->hasPermission("artikel.img.upload"))) echo "disabled";?> onclick="loadMainPage('pages/add/ArtikelImgAdd.php')" class="waves-effect waves-light btn-small #2196f3 blue"><i class="material-icons left">add</i>Artikel Bild Uploden</a></p></div>
    <div class="col s3 m4 l2"><p><a <?php if(!($rang->hasPermission("artikel.add"))) echo "disabled";?> onclick="loadMainPage('pages/add/ArtikelAdd.php')" class="waves-effect waves-light btn-small green"><i class="material-icons left">add</i>Artikel Erstellen</a></p></div>


</div>

<table>
    <thead>
    <tr>
        <th>Arikel Nummer</th>
        <th>Name</th>
        <th>Verkäufer</th>
        <th>Preis</th>
        <th>Bestand</th>
        <th>Arikel-Bearbeiten</th>
        <th>Bilder-Bearbeiten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody id="such_output">
    <?php
    $edit = $rang->hasPermission("artikel.edit");
    $delete = $rang->hasPermission("artikel.delete");
    $img = $rang->hasPermission("artikel.img.edit");

    foreach ($pdo->query("SELECT * FROM artikel ") as $row) {
        if($row["Owner"] == null){
            $Owner = "Shop";
        }else {
            foreach ($pdo->query("SELECT * FROM user WHERE id = " . $row["Owner"] ) as $row1) {
                $Owner = $row1["Username"];
            }
        }


        echo "<tr><td>".$row['artikelnr']."</td><td>".$row['name']."</td><td>".$Owner."</td><td>".$row['preis']."</td><td>".$row['bestand']."</td>";
        if($edit){
            echo "<td><a class=\"waves-effect waves-light btn-small green  \" onclick='updateArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>";
        }else {
            echo "<td><a disabled class=\"waves-effect waves-light btn-small green  \" onclick='updateArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>";
        }

        if($img){
            echo " <td><a class=\"waves-effect waves-light btn-small #2196f3 blue \" onclick='imgArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>Bilder</a></td>";
        }else {
            echo " <td><a disabled class=\"waves-effect waves-light btn-small #2196f3 blue \" onclick='imgArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>Bilder</a></td>";
        }

        if($delete){
            echo " <td><a class=\"waves-effect waves-light btn-small red \" onclick='delArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
        }else {
            echo " <td><a disabled class=\"waves-effect waves-light btn-small red \" onclick='delArtikel(".$row['artikelnr'].")'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
        }



    }

    ?>
    </tbody>
</table>
