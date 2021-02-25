<?php
include "../security/XSS.php";

$str = xss_clean($_GET["str"]);

include "../sql/Sql.php";

?>
<tbody>
        <?php
            foreach ($pdo->query("SELECT * FROM user WHERE Username like '%$str%' OR Username like '$str%' OR Username like '%$str' OR Username like '$str'") as $row) {
                echo "<tr><td>".$row['ID']."</td><td>".str_replace($str, "<font color='#ff0009'>$str</font>", $row['Username'])."</td>
                <td><a class=\"waves-effect waves-light btn-small green  \" onclick='updateKunden(".$row['ID'].");'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>
                <td><a class=\"waves-effect waves-light btn-small red \" onclick='delUser(".$row['ID'].");'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
            }
        ?>
</tbody>