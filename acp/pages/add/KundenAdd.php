<?php
session_start();
include "../../php/sql/Sql.php";
include "../../php/rang/Rang.php";

$rang = new Rang($_SESSION['rang'], $pdo);
if (!isset($_SESSION['login'])){
    echo "<script>location.reload()</script>";
    exit();
}

$tmpid = 0;
if(isset($_GET["id"])) {
    if($_GET["id"] == -1){
        $id = null;
        $usid = $_GET['usid'];

        $tmpid = -1;
    }else {
        $id = $_GET["id"];
        include "../../php/sql/Sql.php";
        foreach ($pdo->query("SELECT * FROM  adresse WHERE ID = ". $id . " LIMIT 1") as $row) {

            $vorname = $row["vorname"];
            $nachname = $row["nachname"];
            $telefon  = $row["tefonnummer"];
            $fax = $row["faxnummer"];
            $adresse = $row["starsse"];
            $hausnummer = $row["hausnnumer"];
            $plz = $row["plz"];
            $mail = $row["email"];
            $date = $row["geburtstag"];
            $iban= $row["iban"];
        }
        if($vorname == null){
            $id = null;
        }
    }

}else {
    $id = null;
}

?>
<script src="/Web-Shop/acp/js/pages/add/Kundeadd.js"></script>
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
                    <input value="<?php if($id != null) echo $vorname ?>" min="3" max="100" id="name" type="text" class=" validate">
                    <?php if($id == null) echo '<label for="name">Vorname</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $nachname ?>" min="3" max="100" id="nname" type="text" class="validate">
                    <?php if($id == null) echo '<label for="nname">Nachname</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $telefon ?>" min="6" max="21" id="tel" type="tel" class="validate">
                    <?php if($id == null) echo '<label for="tel">Telefonnummer</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $fax ?>" min="6" max="12" id="fax" type="text" class="validate">
                    <?php if($id == null) echo '<label for="fax">Fax</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $adresse ?>" min="3" max="100" id="Adress" type="text" class="validate">
                    <?php if($id == null) echo '<label for="Adress">Starße</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $hausnummer ?>" min="1" max="10" id="Adress_num" type="text" class="validate">
                    <?php if($id == null) echo '<label for="c">Hausnummer</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $plz ?>" min="5" max="5" id="Adress_plz" type="text" class="validate">
                    <?php if($id == null) echo '<label for="Adress_plz">PLZ</label>'?>
                </div>
                <div class="input-field col s5">
                    <input value="<?php if($id != null) echo $mail ?>" min="3" max="100" id="mail" type="email" class="validate">
                    <?php if($id == null) echo '<label for="mail">Mail</label>'?>
                </div>
                <div class="input-field col s10">
                    <input value="<?php if($id != null) echo $date ?>" id="date" type="date" class="validate">
                </div>
                <div class="input-field col s10">
                    <input value="<?php if($id != null) echo $iban ?>" id="bank" type="text" class="validate">
                    <?php if($id == null) echo '<label for="bank">Bankverbindung</label>'?>
                </div>
        </form>
    </div>
    <div id="output">

    </div>
    <div class="center-align row">
        <div class="col s12 m4 l2"><p></p></div>
        <?php if($tmpid == -1) {?>
        <div class="col s12 m4 l8"><p><button onclick="requstformulaUser(document.getElementById('nname'), document.getElementById('name'), document.getElementById('tel'), document.getElementById('fax'),
                    document.getElementById('Adress'), document.getElementById('Adress_num'), document.getElementById('Adress_plz'), document.getElementById('mail'),
                    document.getElementById('date'), document.getElementById('bank'), <?php echo $usid;?>);"
                                             class="btn waves-effect waves-light" type="submit" name="action">Adress-Daten anlegen<i class="material-icons right">arrow_forward</i></button></div>
        <?php } else if($id != null && $id != -1) {?>
            <div class="col s12 m4 l8"><p><button onclick="updateformula(document.getElementById('nname'), document.getElementById('name'), document.getElementById('tel'), document.getElementById('fax'),
	                                                   document.getElementById('Adress'), document.getElementById('Adress_num'), document.getElementById('Adress_plz'), document.getElementById('mail'),
	                                                   document.getElementById('date'), document.getElementById('bank'), <?php echo $id;?>);"
                                                  class="btn waves-effect waves-light" type="submit" name="action">Kunden Daten updaten<i class="material-icons right">arrow_forward</i></button></div>
        <?php } else {?>
        <div class="col s12 m4 l8"><p><button onclick="requstformula(document.getElementById('nname'), document.getElementById('name'), document.getElementById('tel'), document.getElementById('fax'),
	                                                   document.getElementById('Adress'), document.getElementById('Adress_num'), document.getElementById('Adress_plz'), document.getElementById('mail'),
	                                                   document.getElementById('date'), document.getElementById('bank'));"
                                              class="btn waves-effect waves-light" type="submit" name="action">Kunden Daten Anlegen<i class="material-icons right">arrow_forward</i></button></div>
        <?php }?>
        <div class="col s12 m4 l2"><p></div>
    </div>



