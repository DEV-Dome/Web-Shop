<?php
session_start();

include "../../../acp/php/sql/Sql.php";

if(!isset($_SESSION['login'])){
    echo "Du musst eingeloggt seinen, um deinen Account verwalten zu können.";
    exit();
}

$uid =  $_GET["id"];
?>
<center><h4>Kunden: <?php echo $uid?></h4></center>
<br/>
<br/>

<table>
    <thead>
    <tr>
        <th>Nachname</th>
        <th>Vorname</th>
        <th>starsse</th>
        <th>plz</th>
        <th>hausnnumer</th>
        <th>email</th>
        <th>iban</th>
    </tr>
    </thead>
    <tbody id="such_output">
    <?php
    //
    foreach ($pdo->query("SELECT * FROM user WHERE ID =". $uid) as $row) {
        $kid = $row["Kunde"];
    }
    foreach ($pdo->query("SELECT * FROM adresse WHERE ID =". $kid) as $row) {
                    echo "<tr><td>".$row["nachname"]."</td><td>".$row["vorname"]."</td><td>".$row["starsse"]."</td><td>".$row["plz"]."</td>
                              <td>".$row["hausnnumer"]."</td><td>".$row["email"]."</td><td>".$row["iban"]."</td></tr>";
    }

    ?>
    </tbody>



