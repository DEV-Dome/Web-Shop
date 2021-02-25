<?php
session_start();
include "../../../acp/php/security/XSS.php";

$str = xss_clean($_GET["str"]);
include "../../../acp/php/sql/Sql.php";
include "../../../acp/php/rang/Rang.php";
$rang = new Rang($_SESSION['rang'], $pdo);

if (!isset($_SESSION['login']) || !$rang->hasPermission("artikel.user.add")){
    exit();
}
?>
<tbody>
	<?php
    $edit = $rang->hasPermission("artikel.user.add");
    $delete = $rang->hasPermission("artikel.user.add");
    $img = $rang->hasPermission("artikel.user.add");


    foreach ($pdo->query("SELECT * FROM artikel WHERE name like '%$str%' OR name like '$str%' OR name like '%$str' OR name like '$str'") as $row) {
        if($row["Owner"] !== $_SESSION['id']){
            continue;
        }

        echo "<tr><td>".$row['artikelnr']."</td><td>".str_replace($str, "<font color='#ff0009'>$str</font>", $row['name'])."</td><td>".$row['preis']."</td><td>".$row['bestand']."</td>";
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