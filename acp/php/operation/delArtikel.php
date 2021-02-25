<?php
$id = $_GET["id"];

include "../sql/Sql.php";

foreach ($pdo->query("SELECT * FROM  artikel_img WHERE artikelnr = ". $id) as $row) {
    $pdo->query("DELETE FROM artikel_img WHERE artikelnr =". $id);
}

$pdo->query("DELETE FROM artikel WHERE artikelnr = " . $id);
echo "artikel gelöscht";
