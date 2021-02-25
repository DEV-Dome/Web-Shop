<?php
session_start();
if(isset($_SESSION['WB'])){
    array_splice($_SESSION['WB'], $_GET["id"], 1);
}
echo "artikel entfernt";