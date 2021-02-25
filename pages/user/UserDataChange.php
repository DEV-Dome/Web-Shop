<?php
session_start();
include "../../acp/php/sql/Sql.php";
include "../../acp/php/rang/Rang.php";

$login = false;
if(isset($_SESSION['login'])){
    $login = true;
    $rang = new Rang($_SESSION['rang'], $pdo);


    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $kunde = -1;
    foreach ($pdo->query("SELECT * FROM user WHERE ID like $id AND Kunde != NULL") as $row) {
        $kunde = $row["Kunde"];
    }
}else{
    echo "Du musst eingeloggt seinen, um deinen Account verwalten zu können.";
    exit();
}
?>
<script src="acp/js/pages/add/Useradd.js"></script>
<div style="padding-left: 1vw; padding-top: 2vh;" class=" row">
        <div class="input-field col s5">
            <input value="" min="6" max="100" id="password" type="password" class="validate">
            <label for="password">Neues-Password</label>
        </div>
        <div class="col s12 m4 l8"><p><button class="btn waves-effect waves-light" onclick="updateformula(<?php echo $kunde; ?>, '<?php echo $name; ?>',document.getElementById('password'),<?php echo $id;?>, <?php echo $_SESSION['rang']; ?>,  false);">Update<i class="material-icons right">arrow_forward</i></p></button></div>
    </div>
</div>