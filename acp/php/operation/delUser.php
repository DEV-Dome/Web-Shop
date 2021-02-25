<?php
$id = $_GET["id"];

include "../sql/Sql.php";


$pdo->query("DELETE FROM user WHERE ID like " . $id);
echo "user gelöscht";