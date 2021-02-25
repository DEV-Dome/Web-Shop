<?php

$id = $_GET["id"];
$pid = $_GET["pid"];

include "../sql/Sql.php";

foreach ($pdo->query("SELECT * FROM artikel_img WHERE is_first = true AND artikelnr like " . $pid) as $row ) {
    $pdo->query("UPDATE artikel_img SET is_first=false WHERE imgnr like " . $row['imgnr']);
}
$pdo->query("UPDATE artikel_img SET is_first=true WHERE imgnr like " . $id);

echo "artikel Bild geändert";
