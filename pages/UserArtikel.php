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
            <li onclick="loadSubPageAccount('pages/user/UserArtikelVerwalten.php')"class="tab col s6"><a class="black-text">Eingende Artikel</a></li>
            <li onclick="loadSubPageAccount('pages/user/UserArtikelMangement.php')"class="tab col s6"><a class="black-text">Eingende Artikel Verwalten</a></li>
        </ul>
    </div>
</div>


<div id="sub-sel">

</div>
<script>
    loadSubPageAccount('pages/user/UserArtikelVerwalten.php');
</script>

</div>