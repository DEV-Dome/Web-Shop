<?php
session_start();
include "acp/php/sql/CreateTable.php";
include "acp/php/rang/DefaultValuePermission.php";
include "acp/php/rang/Rang.php";

$login = false;
if(isset($_SESSION['login'])){
    $login = true;
    $rang = new Rang($_SESSION['rang'], $pdo);

    foreach ($pdo->query("SELECT * FROM user WHERE ID =". $_SESSION["id"]) as $row) {
        $kunde = $row["Kunde"];
    }
    if($kunde == null) {
        $kunde = -1;
    }
}else {
    $rang = new Rang(-1, $pdo);

    $kunde = -2;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="acp/css/materialize.min.css"  media="screen,projection"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="acp/js/pages/login/logout.js"></script>
</head>
<body class="#b2dfdb teal lighten-4">
<div style=" width: 100vw;">
    <nav class="nav-extended #4db6ac teal lighten-2">
        <div class="nav-wrapper ">
            <a href="" style="padding-left: 1vw;" class="brand-logo">Shop</a>
            <ul class="right hide-on-med-and-down">
                <li onclick="loadMainPageUser('Warenkorb.php')"><a><i  class="material-icons">shopping_cart</i></a></li>
                <?php if($rang->hasPermission("acp.use")) {?><li onclick="location.href = 'acp/' "><a><i  class="material-icons">settings_applications</i></a></li><?php }?>
                <?php if($login) {?><li onclick="logout(false);"><a><i  class="material-icons">power_settings_new</i></a></li><?php }?>
                <?php if(!$login) {?><li onclick="loadMainPageUser('user/login/login.php');"><a><i  class="material-icons">person</i></a></li><?php }?>
            </ul>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab" onclick="loadMainPageUser('Shop.php')"><a>Shop</a></li>
                <li class="tab" onclick="loadMainPageUser('User.php')"><a>Account</a></li>
                <li class="tab" onclick="loadMainPageUser('UserArtikel.php')"><a>Eigende Artikel</a></li>
                <li class="tab right" onclick="loadMainPageUser('dsgvo/impressum.php')"><a>Impressum</a></li>
                <li class="tab right" onclick="loadMainPageUser('dsgvo/datenschutz.php')"><a>Datenschutz</a></li>
            </ul>
        </div>
    </nav>
</div>
<div id="page_value" class="" style=" ">
<script>loadMainPageUser('Shop.php')</script>
</div>


<div id="Alert" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Willkommen</h4>
        <br/>
        <p>Willkommen im Shop <?php echo $_SESSION["name"];?>,<br/>
            <br/>
            wir freuen uns das du dich bei uns angemeldet hast allerdings musst Deinen Account noch Deine Adressendaten und eine Zahlungsmethode hinzu, damit alle Funktion nutzen kannst.
            <br/>
            <br/>
            Mit dem Verwenden des Shops erklärst du dich mit den Datenschutz Bestimmung Einverstanden, so wie mit dem Impressum. Darüber stimmst du den AGB’s zu.
            <br/>
            <br/>
            Sollst du Probleme haben wende dich an den Support.
        </p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Gelesen</a>
    </div>
</div>

<?php if($kunde == -1) {?>
<script>
    $(document).ready(function(){
        $('.modal').modal();
        var instance = M.Modal.getInstance(document.getElementById("Alert"));
        instance.open()
    });
</script>
<?php }?>

<script type="text/javascript" src="acp/js/materialize.min.js"></script>
</body>
</html>
