<?php
include "../security/XSS.php";

$str = xss_clean($_GET["str"]);

include "../sql/Sql.php";

?>
<tbody>
        <?php
            foreach ($pdo->query("SELECT * FROM adresse WHERE nachname like '%$str%' OR nachname like '$str%' OR nachname like '%$str' OR nachname like '$str'") as $row) {
                echo "<tr><td>".$row['ID']."</td><td>".$row['vorname']."</td><td>".str_replace($str, "<font color='#ff0009'>$str</font>", $row['nachname'])."</td>
                <td>".$row['tefonnummer']."</td><td>".$row['faxnummer']."</td>
                <td>".$row['geburtstag']."</td><td>".$row['iban']."</td>



                <td><a class='waves-effect waves-light btn-small green' onclick='updateKunden(".$row['ID'].");'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>
                <td><a class='waves-effect waves-light btn-small red' onclick='delKunden(".$row['ID'].");'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";


            }
        ?>
</tbody>