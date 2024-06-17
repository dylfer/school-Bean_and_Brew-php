<?php
$stmt1 = $mysqli->prepare("SELECT id, username FROM s WHERE username = ?"); $stmt->bind_param("s", $_SESSION["username"]);
$stmt1->execute(); $stmt->store_result();


?>