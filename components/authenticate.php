<?php
include 'DB_conect.php';
session_start();

$stmt1 = $mysqli->prepare("SELECT session_id, login_status FROM clients WHERE session_id = ?"); $stmt->bind_param("s", $_SESSION["session_id"]);
$stmt1->execute(); $stmt->store_result();
if ($stmt->num_rows > 0 and $stmt1->num_rows > 0) {
    $stmt1->bind_result($session_id,$loged_in,$user_id);
    $stmt1->fetch();

    $stmt = $mysqli->prepare("SELECT id, username FROM users WHERE username = ?"); $stmt->bind_param("s", $_SESSION["user_id"]);
    $stmt->execute(); $stmt->store_result(); 
    $stmt->bind_result($id, $username);
    $stmt->fetch();
    

    if ($_SESSION["username"] == $username and $_SESSION["user_id"] == $id and $_SESSION["session_id"] == $session_id and $loged_in == true) {
        $valid = true;
    }else{
        header("Location: login.php");
    }
}else{
    header("Location: login.php");
}
$stmt->close();$stmt1->close();  $mysqli->close();
?>