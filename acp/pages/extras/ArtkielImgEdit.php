<?php
session_start();

include "../../php/sql/Sql.php";
include "../../php/rang/Rang.php";
$rang = new Rang($_SESSION['rang'], $pdo);

if (!isset($_SESSION['login'])) {
    echo "<script>location.reload()</script>";
    exit();
}



?>
<script src="../../js/pages/ArtikelVerwalten.js"></script>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Bild</th>
        <th>Artikel Bild setzten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $delete = $rang->hasPermission("artikel.img.delete");
    foreach ($pdo->query("SELECT * FROM artikel_img WHERE artikelnr like " . $_GET['id']) as $row) {
        $out = $row['img'];
        echo "<tr><td>". $row['imgnr'] ."</td><td><img width='100px' height='100px' src='$out'/></td>";

        if(!$row['is_first']){
            echo " <td><a class=\"waves-effect waves-light btn-small 2196f3 blue \" onclick='ChangeImgArtikel(".$row['imgnr'].", ".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>artikel Bild</a></td>";
        }else {
            echo " <td><a disabled class=\"waves-effect waves-light btn-small 2196f3 blue \" onclick='ChangeImgArtikel(".$row['imgnr'].", ".$row['artikelnr'].")'><i class=\"material-icons left\">border_color</i>artikel Bild</a></td>";
        }

        if($delete){
            echo " <td><a class=\"waves-effect waves-light btn-small red \" onclick='delImgArtikel(".$row['imgnr'].")'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
        }else {
            echo " <td><a disabled class=\"waves-effect waves-light btn-small red \" onclick='delImgArtikel(".$row['imgnr'].")'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
        }
    }



    ?>
    </tbody>
</table>
