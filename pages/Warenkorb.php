<?php
session_start();
if(!isset($_SESSION['WB'])){

    echo  'Du hast noch nichts im Warenkorb!';

    exit();
}

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
<script type="text/javascript" src="js/pages/Warenkorb.js"></script>
<script type="text/javascript" src="js/functions.js"></script>

<!-- <script src="js/pages/UserVerwalten.js"></script> -->

<div class="row">
    <div class="col s12 m4 l2"><p></p></div>
    <div class="col s12 m4 l8"><p>
        <div class="input-field col s6">
            <input oninput="seatchArtikel(document.getElementById('suchen').value);"  id="suchen" type="text" class="validate">
            <label for="suchen">Artikel Suchen [Name]</label>
        </div></p></div>
    <div class="col s12 m4 l2"><p><td><a  href="#modal1" <?php  if(!(isset($_SESSION['login']))) echo "disabled";?> onclick="" class="waves-effect waves-light btn-small green modal-trigger"><i class="material-icons left">add</i>Kaufen</a></td></p></div>
</div>


<table>
    <thead>
    <tr>
        <th>Produckt-Name</th>
        <th>Stückzahl</th>
        <th>Preis</th>
        <th>Gesamter Preis</th>
        <th>Stückzahl +1</th>
        <th>Stückzahl -1</th>
        <th>Entfernen</th>
    </tr>
    </thead>
    <tbody id="searchOutput">
    <?php
    $preis = 0;
    for($i = 0; $i < count($_SESSION['WB']); $i++){
        foreach ($pdo->query("SELECT * FROM artikel WHERE artikelnr like ". $_SESSION['WB'][$i]["id"]) as $row) {
            $gp = $row['preis'] * $_SESSION['WB'][$i]["anzahl"];
            $preis += $gp;
            echo "<tr><td>". $row['name'] ." </td><td>". $_SESSION['WB'][$i]["anzahl"] ." </td><td>". $row['preis'] ." </td><td>". $gp ." </td><td><a onclick='addOneArtikel($i)' class='waves-effect waves-light btn #00b8d4 cyan accent-4'><i class='material-icons left'>exposure_plus_1</i> Stück</a><td><a onclick='minusOneArtikel($i)' class='waves-effect waves-light btn #00b8d4 cyan accent-4'><i class='material-icons left'>exposure_neg_1</i> Stück</a></td><td><a onclick='deleteArtikel($i)' class='waves-effect waves-light btn #f44336 red'><i class='material-icons left'>delete</i>Löschen</a></td></tr>";
        }
    }

    ?>
    </tbody>

    <div id="modal1" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>Einkauf bezahlen</h4>
            <p>Möchten du deinen Einkauf im Wert von <?php echo $preis; ?>€ Bezahlen ?</p>
        </div>
        <div class="modal-footer">
            <a onclick="kauf(<?php echo $_SESSION['id']; ?>)" class="modal-close waves-effect waves-green btn-flat">Bezahlen</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>
    <span id="output_kauf"></span>

