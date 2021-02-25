<?php
include "../security/XSS.php";

$str = xss_clean($_GET["str"]);

include "../sql/Sql.php";

?>
<tbody>
        <?php
            foreach ($pdo->query("SELECT * FROM rang WHERE Name like '%$str%' OR Name like '$str%' OR Name like '%$str' OR Name like '$str'") as $row) {
                if($row['Isdefault']){
                    echo "<tr><td>".$row['ID']."</td><td>".str_replace($str, "<font color='#ff0009'>$str</font>", $row['Name'])."</td><td>".$row['Dscribe']."</td><td>Standart Rang, Kann nicht gelöscht werden</td>
                <td><a class='waves-effect waves-light btn-small green' onclick='updateRang(".$row['ID'].");'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>
                <td><a class='waves-effect waves-light btn-small red disabled'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
                }else {
                    echo "<tr><td>".$row['ID']."</td><td>".str_replace($str, "<font color='#ff0009'>$str</font>", $row['Name'])."</td><td>".$row['Dscribe']."</td><td>Keine Information</td>
                <td><a class='waves-effect waves-light btn-small green' onclick='updateRang(".$row['ID'].");'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>
                <td><a class='waves-effect waves-light btn-small red' onclick='delRang(".$row['ID'].");'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
                }

            }
        ?>
</tbody>