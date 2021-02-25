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
    include "../../php/sql/Sql.php";
    foreach ($pdo->query("SELECT * FROM  user WHERE ID = ". $id . " LIMIT 1") as $row) {
        $name = $row["Username"];
        $Kunde  = $row["Kunde"];
        $rang = $row["Rang"];
    }

}else {
    $id = null;
    $rang = 0;
}
?>
<script src="js/pages/add/Useradd.js"></script>
<style>
    .input-field label {
    color: #000;
}
    .input-field input:focus + label {
    color: #4caf50;
}
    .input-field input[type=text]:focus {
    border-bottom: 1px solid #4caf50;
        box-shadow: 0 1px 0 0 #4caf50;
    }
    .input-field input[type=text].valid {
    border-bottom: 1px solid #0f9d58;
        box-shadow: 0 1px 0 0 #0f9d58;
    }
    .input-field input[type=text].invalid {
    border-bottom: 1px solid #8b1014;
        box-shadow: 0 1px 0 0 #8b1014;
    }
    .input-field .prefix.active {
    color: #66bb6a;
}
</style>

<div style="padding-left: 1vw; padding-top: 2vh;" class=" row">
    <form class="center-align col s12">
        <div class="row">
            <div  class="text-lighten-3 input-field col s5">
                <input value="<?php if($id != null) echo $name ?>" min="3" max="100" id="name" type="text" class=" validate">
                <?php if($id == null) echo ' <label for="name">Username</label>'?>
            </div>
            <div class="input-field col s5">
                <input value="" min="6" max="100" id="password" type="password" class="validate">
                <label for="password">Neues-Password</label>
            </div>

            <div class="input-field col s5">
                <select id="kunde">

                    <option value="-1" <?php if($id == null) echo 'selected' ?>>Keinen Kunden Verkünft </option>
                    <?php
                    $i = 0;
                    foreach ($pdo->query("SELECT * FROM adresse ORDER BY ID") as $row) {
                        if($id == null){
                            echo '<option value="'.$row["ID"].'">#'.$row["ID"] .' - '. $row["vorname"] .', '. $row["nachname"] .'</option>';
                        }else {
                            if($Kunde == $row["ID"]){
                                echo '<option selected value="'.$row["ID"].'">#'.$row["ID"] .' - '. $row["vorname"] .', '. $row["nachname"] .'</option>';
                            }else {
                                echo '<option value="'.$row["ID"].'">#'.$row["ID"] .' - '. $row["vorname"] .', '. $row["nachname"] .'</option>';
                            }
                        }

                    }

                    ?>
                </select>
                <label>Kunden Wählen</label>
            </div>

            <div class="input-field col s5">
                <select id="rang">

                    <option value="-1" <?php if($rang == 0)  ?>>Keinen Rang Verkünft</option>
                    <?php
                    $i = 0;


                    foreach ($pdo->query("SELECT * FROM rang ORDER BY ID") as $row) {
                            if($rang == $row["ID"]){
                                echo '<option selected value="'.$row["ID"].'">'.$row["Name"] .'</option>';
                            }else {
                                echo '<option value="'.$row["ID"].'">'.$row["Name"] .'</option>';
                            }
                    }

                    ?>
                </select>
                <label>Rang Wählen</label>
            </div>
    </form>
</div>


    <div class="center-align row">
        <div class="col s12 m4 l2"><p></p></div>
        <?php
            if($id != null){
        ?>
                <div class="col s12 m4 l8"><p><button class="btn waves-effect waves-light" onclick="updateformula(document.getElementById('kunde'), document.getElementById('name'),document.getElementById('password'),<?php echo $id;?>, document.getElementById('rang'), true);">Update<i class="material-icons right">arrow_forward</i></p></button></div>
        <?php
            }else {
        ?>
                <div class="col s12 m4 l8"><p><button class="btn waves-effect waves-light" onclick="requstformula(document.getElementById('kunde'), document.getElementById('name'),document.getElementById('password'), document.getElementById('rang') );">Senden<i class="material-icons right">arrow_forward</i></p></button></div>
        <?php
            }
        ?>
        <div class="col s12 m4 l2"><p></p></div>
    </div>
</div>
