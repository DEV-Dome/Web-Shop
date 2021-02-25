<?php
session_start();
include "../../php/sql/Sql.php";
include "../../php/rang/Rang.php";

$rang = new Rang($_SESSION['rang'], $pdo);
if (!isset($_SESSION['login']) || !$rang->hasPermission("acp.use")){
    echo "<script>location.reload()</script>";
    exit();
}

if(isset($_GET["id"])){
    $id = $_GET["id"];
    foreach ($pdo->query("SELECT * FROM  rang WHERE ID = ". $id . " LIMIT 1") as $row) {
        $name = $row["Name"];
        $beschreibung = $row["Dscribe"];
    }

}else {
    $id = null;
}

?>
<script src="js/pages/add/Rangadd.js"></script>
<div class="row center">
    <div class="col s12 center"><h5>Rang Daten:</h5></div><br/>
    <div class="col s6 input-field"><input value="<?php if($id != null) echo $name ?>" id="name" type="text" class="validate"><?php if($id == null) echo '<label class="black-text" for="name">Name</label>'?></div>
    <div class="col s5 input-field "><input value="<?php if($id != null) echo $beschreibung ?>" id="beschreibung" type="text" class="validate"><?php if ($id == null) echo '<label  class="black-text"for="beschreibung">Beschreibung</label>' ?></div>
</div>

<table style="width: 100vw;">
    <thead>
    <tr>
       <!--<th>Permission</th>-->
        <th>Beschreibung</th>
        <th>Permission</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if($id != null){
        foreach ($pdo->query("SELECT * FROM rang_permission") as $row){
            foreach ($pdo->query("SELECT * FROM rang_permission_syc WHERE Rang like $id AND Permission like ".$row['ID'] ." LIMIT 1") as $row1){
                if($row1["Haspermission"] == 1){
                    echo "<tr><td>" . $row["Dscribe"] . "</td> <td> <label><input id='".$row["Permission"]."' name='permission' type='checkbox' checked/><span></span></label>  </td></tr>";
                }else {
                    echo "<tr><td>" . $row["Dscribe"] . "</td> <td> <label><input id='".$row["Permission"]."' name='permission' type='checkbox'/><span></span></label>  </td></tr>";
                }
            }

        }
    }else {
        foreach ($pdo->query("SELECT * FROM rang_permission") as $row){
            echo "<tr><td>" . $row["Dscribe"] . "</td> <td> <label><input id='".$row["Permission"]."' name='permission' type='checkbox' /><span></span></label>  </td></tr>";
        }
    }

    ?>
    </tbody>
</table>

<?php
if ($id != null) {
?>
<div class="col s12 input-field center"> <a onclick="updateformula( document.getElementById('name'), document.getElementById('beschreibung'), <?php echo $id;?>);" class="waves-effect waves-light btn "><i class="material-icons right">play_arrow</i>Rang Update</a></div>

<?php
}else {
?>
<div class="col s12 input-field center"> <a onclick="addRang( document.getElementById('name'), document.getElementById('beschreibung'));" class="waves-effect waves-light btn "><i class="material-icons right">play_arrow</i>Rang Anlegen</a></div>

<?php
}
?>

