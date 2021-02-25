<?php
session_start();

include "../php/sql/Sql.php";
include "./../php/rang/Rang.php";

$rang = new Rang($_SESSION['rang'], $pdo);
if (!isset($_SESSION['login']) || !$rang->hasPermission("acp.use")){
    echo "<script>location.reload()</script>";
    exit();
}

?>
<script src="js/pages/UserVerwalten.js"></script>
<div class="row">
    <div class="col s12 m4 l2"><p></p></div>
    <div class="col s12 m4 l8"><p>
        <div class="input-field col s6">
            <input oninput="suchen(document.getElementById('suchen').value);"  id="suchen" type="text" class="validate">
            <label for="suchen">User Suchen [Username]</label>
        </div></p></div>
    <div class="col s12 m4 l2"><p><td><a <?php if(!($rang->hasPermission("benutzer.add"))) echo "disabled";?> onclick="loadMainPage('pages/add/UserAdd.php')" class="waves-effect waves-light btn-small green"><i class="material-icons left">add</i>Benutzer Erstellen</a></td></p></div>
</div>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Bearbeiten</th>
        <th >Löschen</th>
    </tr>
    </thead>
    <tbody id="such_output">
        <?php
        $edit = $rang->hasPermission("benutzer.edit");
        $delete = $rang->hasPermission("benutzer.delete");
            foreach ($pdo->query("SELECT * FROM user") as $row) {
                echo "<tr><td>".$row['ID']."</td><td>".$row['Username']."</td>";
                if($edit){
                    echo " <td><a class=\"waves-effect waves-light btn-small green  \" onclick='updateKunden(".$row['ID'].");'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>";
                }else {
                    echo " <td><a disabled class=\"waves-effect waves-light btn-small green  \" onclick='updateKunden(".$row['ID'].");'><i class=\"material-icons left\">border_color</i>Bearbeiten</a></td>";
                }
                if($delete){
                    echo  "<td><a class=\"waves-effect waves-light btn-small red \" onclick='delUser(".$row['ID'].");'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
                }else {
                    echo  "<td><a disabled class=\"waves-effect waves-light btn-small red \" onclick='delUser(".$row['ID'].");'><i class=\"material-icons left\">delete</i>Löschen</a></td></tr>";
                }

            }
        ?>
    </tbody>
</table>