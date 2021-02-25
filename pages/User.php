<?php
session_start();
include "../acp/php/sql/Sql.php";
include "../acp/php/rang/Rang.php";

$login = false;
if(isset($_SESSION['login'])){
    $rang = new Rang($_SESSION['rang'], $pdo);

    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
   foreach ($pdo->query("SELECT * FROM user WHERE ID = $id") as $row) {
		$kunde = $row["Kunde"];
   }
   if($kunde == null) {
       $kunde = -1;
   }
}else{
    echo "Du musst eingeloggt seinen, um deinen Account verwalten zu können.";
    exit();
}

if(isset($_GET["bid"])){
    $bid = $_GET["bid"];
}
?>
<script src="acp/js/pages/add/Useradd.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<script>
    $(document).ready(function(){
        $('.tabs').tabs();
    });
</script>


<div class="row ">
    <div class="col s12 ">
        <ul class="tabs b2dfdb teal lighten-3">
            <li onclick="loadSubPageAccount('acp/pages/add/KundenAdd.php?id=<?php echo $kunde;?>&usid=<?php echo $id;?>')" class="tab col s3 "><a class="black-text active" href="#test1">Allgemeine Account Daten</a></li>
            <li onclick="loadSubPageAccount('pages/user/UserDataChange.php')"class="tab col s3"><a class="black-text">Einlog Daten</a></li>
            <li onclick="loadSubPageAccount('pages/user/BestellteArtikel.php')"class="tab col s6"><a class="black-text" ">Bestellte Artikel</a></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col s12 m4 l12 center"><p><h4><?php echo "Hallo $name, Deine User-ID ist: $id"; ?></h4></p></div>
</div>

<div id="sub-sel">

</div>
<script>
    loadSubPageAccount("acp/pages/add/KundenAdd.php?id=<?php echo $kunde;?>&usid=<?php echo $id;?>")
</script>

</div>

<?php if(isset($_GET["bid"])){ ?>
<div id="Alert" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Deine Bestellung</h4>
        <br/>
        <p>Danke für den kauf Bei uns <?php echo $name;?>,<br/>
            <br/>
            Du kannst den Einkauf im Reiter Bestellte Artikel nun verfallten.
            <br/>
            <br/>
            Mit dem Einkauf im Shops erklärst du dich mit den Datenschutz Bestimmung Einverstanden, so wie mit dem Impressum. Darüber stimmst du den AGB’s zu.
            <br/>
            <br/>
            Sollst du Probleme haben wende dich an den Support.
        </p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Gelesen</a>
    </div>

    <script>
        $(document).ready(function(){
            $('.modal').modal();
            var instance = M.Modal.getInstance(document.getElementById("Alert"));
            instance.open()
        });
    </script>
    <?php } ?>