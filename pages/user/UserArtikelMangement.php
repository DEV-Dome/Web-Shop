<?php
session_start();

include "../../acp/php/sql/Sql.php";
include "../../acp/php/rang/Rang.php";
$rang = new Rang($_SESSION['rang'], $pdo);
if(!isset($_SESSION['login'])){
    echo "Du musst eingeloggt seinen, um deinen Account verwalten zu können.";
    exit();
}
if (!$rang->hasPermission("artikel.user.see")){
    echo "<center>Du hast nicht nötigen Berechtigungen, um artikel im Shop zu verkaufen.</center>";
    echo "<center>Bitte wende dich an die Administratoren des Shop, wenn du dies tun möchtest.</center>";
    exit();
}
?>

<table>
    <thead>
    <tr>
        <th>Bestellnummer Nummer</th>
        <th>Bestellung sehen</th>
        <th>Kundendaten sehen</th>
        <th>Versenden</th>
    </tr>
    </thead>
    <tbody id="such_output">
    <?php
//
    foreach ($pdo->query("SELECT * FROM warenkorb_arikel_syc ") as $row) {
        foreach ($pdo->query("SELECT * FROM artikel WHERE artikelnr  = " . $row["artikel"]) as $row1) {
            foreach ($pdo->query("SELECT * FROM bestellungen WHERE ID  = " . $row["bestellungesid"]) as $row2) {
                if(intval($row1["Owner"], 10) == intval($_SESSION['id'], 10)){
                    echo "<tr><td>".$row["bestellungesid"]."</td>";
                    echo "<td><a class=\"waves-effect waves-light btn-small green  \" onclick='loadSubPageAccount(\"pages/user/Bestellung/Bestellung.php?id=". $row["bestellungesid"] ." \")'><i class=\"material-icons left\">loyalty</i>Bestellung</a></td>";
                    echo "<td><a class=\"waves-effect waves-light btn-small green  \" onclick='loadSubPageAccount(\"pages/user/Bestellung/KundenDaten.php?id=". $row2["user"] ." \")'><i class=\"material-icons left\">perm_identity</i>Kundendaten</a></td>";
                  //  echo " <td><a href=\"#modal\" class=\"waves-effect waves-light btn-small #2196f3 blue modal-trigger \" ><i class=\"material-icons left\">forward</i>Versenden</a></td>";
                }
            }
        }
    }

    ?>
    </tbody>

    <div id="modal" class="modal bottom-sheet">
        <div class="modal-content ">
            <h4>Sendenummer eingeben</h4>
            <p>Bitte gebe die Sendenummer ein: </p>

            <div class="input-field col s6">
                <input  id="first_name" type="text" class="validate">
            </div>
        </div>
        <div class="modal-footer">
            <a onclick="kauf(<?php echo $_SESSION['id']; ?>)" class="modal-close waves-effect waves-green btn-flat">Versenden</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
    </script>
