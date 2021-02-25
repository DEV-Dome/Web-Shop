<?php
$id = $_GET["id"];

include "../sql/Sql.php";

foreach ($pdo->query("SELECT * FROM  user WHERE Kunde = ". $id) as $row) {
    $pdo->query("UPDATE user SET Kunde = NULL");
}
$pdo->query("DELETE FROM adresse WHERE ID like " . $id);
echo "Kunde gelöscht";
?>
