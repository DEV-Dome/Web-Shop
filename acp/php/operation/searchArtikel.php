<?php
session_start();
include "../security/XSS.php";

$str = xss_clean($_GET["str"]);

include "../sql/Sql.php";
include "../rang/Rang.php";
$rang = new Rang($_SESSION['rang'], $pdo);

if (!isset($_SESSION['login']) || !$rang->hasPermission("acp.use")){
    echo "<script>location.reload()</script>";
    exit();
}
?>
<tbody>
	<?php
    $edit = $rang->hasPermission("artikel.edit");
    $delete = $rang->hasPermission("artikel.delete");
    $img = $rang->hasPermission("artikel.img.edit");

    foreach ($pdo->query("SELECT * FROM artikel ") as $row) {
        if ($row["Owner"] == null) {
            $Owner = "Shop";
        } else {
            foreach ($pdo->query("SELECT * FROM user WHERE id = " . $row["Owner"]) as $row1) {
                $Owner = $row1["Username"];
            }
        }
    }

    foreach ($pdo->query("SELECT * FROM artikel WHERE name like '%$str%' OR name like '$str%' OR name like '%$str' OR name like '$str'") as $row) {
        echo "<tr><td>".$row['artikelnr']."</td><td>".str_replace($str, "<font color='#ff0009'>$str</font>", $row['name'])."</td><td>".$Owner."</td><td>".$row['preis']."</td><td>".$row['bestand']."</td>";
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
