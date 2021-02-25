<?php
session_start();
if(!isset($_SESSION['login'])){
    ?>
    <script type="text/javascript" src="acp/js/pages/login/login.js"></script>
    <div class="row">
        <div class="col s12"><p>Bitte logge dich ein:</p></div>
        <div class="col s12"><div class="input-field col s6">Username: <input placeholder="" id="user" type="text" class="validate black-text"></div></div>
        <div class="col s12"><div class="input-field col s6">Passwort: <input  id="pw" type="password" class="validate"></div></div>
        <div class="col s6"><a onclick="login(document.getElementById('user').value, document.getElementById('pw').value)" class="waves-effect waves-light btn">Einloggen</a> <a onclick="loadMainPageUser('user/login/registrieren.php')" class="red waves-effect waves-light btn">Registrieren</a></div>
        </div>
    </div>
    <?php
}else {
    echo "<script>loadMainPageUser('Shop.php')</script>";
}
?>