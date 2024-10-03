<?php
include 'DB_conect.php';
// ??
$_COOKIE["session_id"] = $_SESSION["session_id"];


$stmt = $mysqli->prepare("SELECT id, username FROM users WHERE username = ?"); $stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute(); $stmt->store_result(); 
$stmt->bind_result($id, $username);
$stmt->fetch();


if ($_SESSION["username"] == $username and $_SESSION["user_id"] == $id and $id == $user_id and session_id($session_id) == $session_id and $loged_in == true) {
    $valid = true;
}else{
    // inconsistency in session data (username, user_id, session_id, login_status)
    header("Location: login.php");
}

$stmt->close();  $mysqli->close();
?>