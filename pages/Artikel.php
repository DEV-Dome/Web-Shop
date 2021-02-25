<?php
session_start();
include "../acp/php/sql/Sql.php";
include "../acp/php/rang/Rang.php";

$login = false;
if(isset($_SESSION['login'])){
    $login = true;
    $rang = new Rang($_SESSION['rang'], $pdo);
}else {
    $rang = new Rang(-1, $pdo);
}

$id = $_GET["id"];
foreach ($pdo->query("SELECT * FROM artikel WHERE artikelnr like ". $id) as $row) {
    $beschreibung = $row["beschreibung"];
    $name = $row["name"];
}
?>

<div class="row">
    <div class="col s12 m4 l12 center"><p><h3><?php echo $name; ?></h3></p></div>
</div>

<div class="row">
    <div class="col s12 m4 l12">
        <div class="col s12 m4 l6">
            <div class="row">
                <div class="col s12 m12">
                    <div class="card #4db6ac teal lighten-2  ">
                        <div class="card-content white-text">
                            <span class="card-title">Bilder:</span>
                            <hr>
                            <div class="carousel">
                                <?php

                                foreach ($pdo->query("SELECT * FROM artikel_img WHERE artikelnr like " . $id) as $row) {
                                    $out = $row['img'];
                                    echo " <a class='carousel-item' href='#one'><img  src='$out'></a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 m4 l6">
            <div  class="col s12 m4 l12">
                <div class="row">
                    <div  class="col s12 m12">
                        <div class="card #4db6ac teal lighten-2  ">
                            <div class="card-content white-text">
                                <?php if(!$login) { ?>
                                <span class="card-title">[Du bist nicht eingelogt] Kaufen: </span>
                                    <br/>
                                    <br />
                                    <p><a onclick="loadMainPage('login.php')" class="waves-effect waves-light btn #1e88e5 blue darken-1"><i class="material-icons left">person</i>Einloggen</a></p><br />
                                    <p><a onclick="addWarenkorb(<?php echo $id; ?>)" class="waves-effect waves-light btn #1e88e5 blue darken-1"><i class="material-icons left #1e88e5 ">shopping_cart</i>in den Warenkorb</a></p>
                                    <?php
                                }else {
                                    ?>
                                    <span class="card-title">Kaufen:</span>
                                    <br />
                                    <p><a onclick="" class="waves-effect waves-light btn #1e88e5 blue darken-1"><i class="material-icons left">attach_money</i>Sofort Kaufen</a></p><br />
                                    <p><a onclick="addWarenkorb(<?php echo $id; ?>)" class="waves-effect waves-light btn #1e88e5 blue darken-1 "><i class="material-icons left" >shopping_cart</i>in den Warenkorb</a></p>
                                    <?php
                                } ?>
                                <br/> <br/> <hr> <br/>
                                <p><a onclick="loadMainPage('Warenkorb.php')" class="waves-effect waves-light btn"><i class="material-icons left">shopping_cart</i>Warenkorb Anzeigen</a></p><br/>
                                <p><a class="waves-effect waves-light btn"><i class="material-icons left">help</i>Support erhalten</a></p><br/>
                                <p><a class="waves-effect waves-light btn #f44336 red"><i class="material-icons left">report_problem</i>Artikel Melden</a></p><br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div  class="col s12 m4 l12">
            <div class="row">
                <div  class="col s12 m12">
                    <div class="card #4db6ac teal lighten-2  ">
                        <div class="card-content white-text">
                            <span class="card-title">Beschreibung:</span>
                            <hr>
                            <p><?php echo $beschreibung; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








</div>



<script>
    M.AutoInit();
</script>
