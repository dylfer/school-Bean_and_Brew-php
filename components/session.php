<?php
include 'functions/uuid.php';
if (session_id() != NULL) {

    $stmt_session = $mysqli->prepare("SELECT  login_status, user_id,ip_adress, user_agent FROM clients WHERE session_id = ?"); $stmt->bind_param("s", session_id());
    $stmt_session->execute(); $stmt_session->store_result();

    if ($stmt_session->num_rows > 0 ) {
        $stmt_session->bind_result($loged_in,$user_id,$ip,$agent);
        $stmt_session->fetch();
        $stmt_session->close();
        if($ip != $_SERVER['REMOTE_ADDR']){
            // create new session - proxy or vpn detected -  TODO: add client id carry over
            // destroy session
            $stmt_session = $mysqli->prepare("SELECT client_id FROM clients WHERE session_id = ?"); $stmt->bind_param("s", session_id());
            $stmt_session->bind_result($client_id);
            $stmt_session->fetch();
            $stmt_session->close();
            session_destroy();

            // create new session -use client id
            session_start();
            $session_id = uuid();
            session_id($session_id);
            $_COOKIE["session_id"] = $session_id;
            // ?ai $stmt_session = $mysqli->prepare("UPDATE clients SET session_id = value1, column2 = value2 VALUES (?, ?, ?)"); $stmt->bind_param("sss", $username, $email, $password);
        }else if (){
            // user agent changes
        }else if (){
            // seasion expires
        }else{
            // update session data
            $stmt_session = $mysqli->prepare("UPDATE clients SET column1 = value1, column2 = value2 VALUES (?, ?, ?)"); $stmt->bind_param("sss", $username, $email, $password);
    
        }
    }else{
    // create new session
    //$_SERVER['REMOTE_ADDR']
    $session_id = uuid();
    session_id($session_id);
    $_COOKIE["session_id"] = $session_id;
    $stmt_session = $mysqli->prepare("INSERT INTO clients (session_id,pages,ip_adress) VALUES (?, ?, ?)"); $stmt->bind_param("sss", $username, $email, $password);     
    }
}else{
    // start session
}


?>