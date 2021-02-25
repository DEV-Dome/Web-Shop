<?php
session_start();
include "../../../acp/php/sql/Sql.php";
include "../../../acp/php/rang/Rang.php";

$rang = new Rang($_SESSION['rang'], $pdo);
if (!isset($_SESSION['login']) || !$rang->hasPermission("artikel.user.add")){
    echo "<script>location.reload()</script>";
    exit();
}

$id = $_SESSION['id'];

?>
<script src="acp/js/pages/add/ArtikelImgAdd.js"></script>


<div style="padding-left: 1vw; padding-top: 2vh;" class=" row">
    <div class="row">
        <div class="input-field col s5">
            <select id="artikel">

                <option value="-1" >Keinen Arkitel Verkünft</option>
                <?php
                $i = 0;


                foreach ($pdo->query("SELECT * FROM artikel WHERE Owner = $id ORDER BY artikelnr") as $row) {
                    if($rang == $row["ID"]){
                        echo '<option selected value="'.$row["artikelnr"].'">'.$row["name"] .'</option>';
                    }else {
                        echo '<option value="'.$row["artikelnr"].'">'.$row["name"] .'</option>';
                    }
                }

                ?>
            </select>
            <label>Arkitel Wählen</label>
        </div>
        <div class="input-field col s5"><input id="img" type="file" accept="image/*"></div>
        <div class="col s12 m4 l8"><p><button onclick="sendImg(document.getElementById('img').files[0].slice(), document.getElementById('artikel').value)" class="btn waves-effect waves-light" >Senden<i class="material-icons right">arrow_forward</i></p></button></div>

    </div>
</div>