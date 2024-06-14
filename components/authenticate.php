<?php
include 'DB_conect.php';
session_start();
if ($_SESSION["username"] == "" and $_SESSION["session_id"] == "") {
    header("Location: login.php");
}else{

}
?>