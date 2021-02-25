<?php
$id = $_GET["id"];

include "../sql/Sql.php";


$pdo->query("DELETE FROM artikel_img WHERE imgnr like " . $id);
echo "artikel Bild gelöscht";
?>