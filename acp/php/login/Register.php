<?php
$salt = 'bQ423hbHM8Sbdb9pjquUQU1IWxcxnybBSjqnyBJ23HjqnI3WbkxUQsxnPw813jkq';

function mySha512($str, $salt, $iterations) {
    for ($x=0; $x<$iterations; $x++) {
        $str = hash('sha512', $str . $salt);
    }
    return $str;
}

include "../security/XSS.php";

$name = xss_clean($_GET["name"]);
$pw = xss_clean($_GET["password"]);
$pww = xss_clean($_GET["passwordw"]);

if($pw !== $pww){
    echo "Die passwörter sind nicht gleich!";
}

include "../sql/CreateTable.php";

foreach($pdo->query("SELECT * FROM user WHERE Username = '". $name . "' LIMIT 1") as $row) {
    echo "Den Usernamen gibt es schon! wählen ein andern.";
    exit();
}


$safepw = mySha512($pw, $salt, 10000);
$pdo->query("INSERT INTO user (Username, Password, Rang) VALUE ('$name', '$safepw', 2)");
echo "Du hast dich erfolgriech Registert.";
