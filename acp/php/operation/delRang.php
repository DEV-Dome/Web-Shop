<?php
$id = $_GET["id"];

include "../sql/Sql.php";

$pdo->query("DELETE FROM rang_permission_syc WHERE Rang like " . $id);
$pdo->query("DELETE FROM rang WHERE ID like " . $id);
echo "Rang gelöscht";