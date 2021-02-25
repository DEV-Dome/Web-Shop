<?php
session_start();
include "../acp/php/sql/Sql.php";
include "../acp/php/rang/Rang.php";

$login = false;
if(isset($_SESSION['login'])){
    $login = true;
    $rang = new Rang($_SESSION['rang'], $pdo);
}else {
    $rang = new Rang(-1, $pdo);
}

?>
<script type="text/javascript" src="js/pages/Shop.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<table>
<thead>
<tr>
    <th>Produckt-Bild</th>
    <th>Name</th>
    <th>Preis</th>
    <th>Melden</th>
</tr>
</thead>
<tbody>
<?php
foreach ($pdo->query("SELECT * FROM artikel") as $row) {
foreach ($pdo->query("SELECT * FROM artikel_img WHERE artikelnr like " . $row['artikelnr'] . " AND is_first = true") as $row1) {
    $out = $row1['img'];

    echo "<tr onclick='DisplayArtikel( ". "\"" . $row["artikelnr"]. "\"" . ")' ><td><img width='100px' height='100px' src='$out'/></td><td>".$row['name']."</td><td>".$row['preis']."</td><td><a class='waves-effect waves-light btn #f44336 red'><i class='material-icons left'>report_problem</i>Melden</a></td></tr>";
}

}
?>
</tbody>
