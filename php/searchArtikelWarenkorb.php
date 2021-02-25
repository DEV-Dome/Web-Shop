<?php
session_start();
include "../acp/php/security/XSS.php";

$str = xss_clean($_GET["str"]);
if(!isset($_SESSION['WB'])){
   exit();
}



?>
<tbody>
<?php
include "../acp/php/sql/Sql.php";
for($i = 0; $i < count($_SESSION['WB']); $i++){
    foreach ($pdo->query("SELECT * FROM artikel WHERE (name like '%$str%' OR name like '$str%' OR name like '%$str' OR name like '$str') AND artikelnr like ". $_SESSION['WB'][$i]["id"]) as $row) {
        echo "<tr><td>".str_replace($str, "<font color='#ff0009'>$str</font>", $row['name'])." </td><td>". $_SESSION['WB'][$i]["anzahl"] ." </td><td>". $row['preis'] ." </td><td>". $row['preis'] * $_SESSION['WB'][$i]["anzahl"] ." </td><td><a onclick='addOneArtikel($i)' class='waves-effect waves-light btn #00b8d4 cyan accent-4'><i class='material-icons left'>exposure_plus_1</i> Stück</a><td><a onclick='minusOneArtikel($i)' class='waves-effect waves-light btn #00b8d4 cyan accent-4'><i class='material-icons left'>exposure_neg_1</i> Stück</a></td><td><a onclick='deleteArtikel($i)' class='waves-effect waves-light btn #f44336 red'><i class='material-icons left'>delete</i>Löschen</a></td></tr>";
    }
}

?>
</tbody>
