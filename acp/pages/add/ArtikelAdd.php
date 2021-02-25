<?php
session_start();
include "../../php/sql/Sql.php";
include "../../php/rang/Rang.php";

$rang = new Rang($_SESSION['rang'], $pdo);
if (!isset($_SESSION['login'])){
    echo "<script>location.reload()</script>";
    exit();
}


include "../../php/sql/Sql.php";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    include "../../php/sql/Sql.php";
    foreach ($pdo->query("SELECT * FROM  artikel WHERE artikelnr = ". $id . " LIMIT 1") as $row) {
        $name = $row["name"];
        $beschreibung = $row["beschreibung"];
        $preis  = $row["preis"];
        $bestand  = $row["bestand"];
    }

}else {
    $id = null;
}

?>
<script src='/Web-Shop/acp/js/pages/add/ArtikelAdd.js'></script>
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
                    <input value="<?php if($id != null) echo $name ?>" min="3" max="30" id="name" type="text" class=" validate">
                    <?php if($id == null) echo ' <label for="beschreibung">Name</label>'?>
                </div>
                <div  class="text-lighten-3 input-field col s5">
                    <input value="<?php if($id != null) echo $beschreibung ?>" min="3" max="500" id="beschreibung" type="text" class=" validate">
                    <?php if($id == null) echo ' <label for="beschreibung">Beschreibung</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $preis ?>" min="1" max="10" id="preis" type="text" class="validate">
                    <?php if($id == null) echo ' <label for="preis">preis</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $bestand ?>" min="1" max="100000" id="bestand" type="NUMBER" class="validate">
                    <?php if($id == null) echo ' <label for="bestand">Bestand</label>'?>
                </div>
        </form>
    </div>

    <div class="center-align row">
        <div class="col s12 m4 l2"><p></p></div>
        <?php
        if($id != null){
            ?>
            <div class="col s12 m4 l8"><p><button class="btn waves-effect waves-light" onclick="updateformula(document.getElementById('name'), document.getElementById('beschreibung'), document.getElementById('preis'),document.getElementById('bestand'),<?php echo $id;?> );">Update<i class="material-icons right">arrow_forward</i></p></button></div>
            <?php
        }else {
            ?>
            <div class="col s12 m4 l8"><p><button class="btn waves-effect waves-light" onclick="requstformula(document.getElementById('name'),document.getElementById('beschreibung'), document.getElementById('preis'),document.getElementById('bestand') );">Senden<i class="material-icons right">arrow_forward</i></p></button></div>
            <?php
        }
        ?>
        <div class="col s12 m4 l2"><p></p></div>
    </div>
</div>