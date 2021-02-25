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
$safepw = mySha512(xss_clean($_GET["password"]), $salt, 10000);
include "../sql/CreateTable.php";
include "../rang/Rang.php";

foreach($pdo->query("SELECT * FROM user WHERE Username = '". $name . "' LIMIT 1") as $row) {
    if($safepw == $row["Password"]){
        session_start();
        $_SESSION["name"] = $name;
        $_SESSION["id"] = $row["ID"];
        $_SESSION['rang'] = $row["Rang"];
        $_SESSION['login'] = true;
        echo "Login";
        exit();
    }else{
        echo "Falsche einlogg daten!";
        exit();
    }
}
echo "Falsche einlogg daten!";
?>
