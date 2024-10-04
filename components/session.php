<?php
include 'functions/uuid.php';
$stmt_malicious = $mysqli->prepare("SELECT malicious_level,last_updated,client_id,ban_time  FROM clients WHERE session_id = ?"); $stmt->bind_param("s", session_id());
$stmt_malicious->execute(); $stmt_malicious->store_result();
if ($stmt_malicious->num_rows > 0 ) {
    $stmt_malicious->bind_result($malicious_level,$last_updated,$client_id,$ban_time);
    $stmt_malicious->fetch();
    $stmt_malicious->close();
    if($malicious_level > 3){
        if ($malicious_level > 5){
            if ($malicious_level > 6){

                if ($malicious_level > 10){
                    // band ip
                    header("Location: /school-Bean_and_Brew-php/band.php?duration=lifetime&reason=malicious_activity");
                }
                header("Location: /school-Bean_and_Brew-php/band.php?duration=1d&reason=malicious_activity&warning=next_ban_is_lifetime");
            }
            if ($ban_time + 1h <= date('Y-m-d H:i:s')){
                pass
            }
            header("Location: /school-Bean_and_Brew-php/band.php?duration=1h&reason=malicious_activity&warning=next_ban_is_lifetime");
        }
        header("Location: /school-Bean_and_Brew-php/band.php?duration=20m&reason=malicious_activity");
    }
}
if (session_id() != NULL) {

    $stmt_session = $mysqli->prepare("SELECT  login_status, user_id,pages,last_request,ip_address, user_agent FROM clients WHERE session_id=?"); $stmt->bind_param("s", session_id());
    $stmt_session->execute(); $stmt_session->store_result();

    if ($stmt_session->num_rows > 0 ) {
        $stmt_session->bind_result($loged_in,$user_id,$pages,$last_request,$ip,$agent);
        $stmt_session->fetch();
        $stmt_session->close();
        if($ip != $_SERVER['REMOTE_ADDR']){
            // create new session - proxy or vpn detected -  TODO: add client id carry over
            // destroy session
            $session_id = session_id();
            if ($session_id != "") {
                $session_id = $_COOKIE["session_id"];
            }
            $stmt_session = $mysqli->prepare("SELECT client_id FROM clients WHERE session_id=?"); $stmt->bind_param("s", session_id());
            $stmt_session->bind_result($client_id);
            $stmt_session->fetch();
            $stmt_session->close();
            if($_COOKIE["client_id"] != $client_id && isset($_COOKIE["client_id"])){
                // cookie tampering kill session
                session_destroy();
                unset($_COOKIE['client_id']);
                unset($_COOKIE['session_id']);
                $stmt_session = $mysqli->prepare("UPDATE clients SET malicious_level=malicious_level+1 , ban_time=?  WHERE ip_address=? "); $stmt->bind_param("ss", date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR'];);
                $stmt_session->fetch();
                $stmt_session->close();
            }
            session_destroy();

            // create new session -use client id
            session_start();
            $session_id = uuidv4();
            session_id($session_id);
            $_COOKIE["session_id"] = $session_id;
            // ?ai $stmt_session = $mysqli->prepare("UPDATE clients SET session_id = value1, column2 = value2 VALUES (?, ?, ?)"); $stmt->bind_param("sss", $username, $email, $password);
        }else if ($_SERVER["HTTP_USER_AGENT"] != $agent){
            // user agent changes
        }else if (){
            // seasion expires
        }else{
            // update session data
            $stmt_session = $mysqli->prepare("UPDATE clients SET column1=value1, column2=value2 WHERE "); $stmt->bind_param("sss", $username, $email, $password);
    
        }
    }else{
    // create new session
    //$_SERVER['REMOTE_ADDR']
    $session_id = uuidv4();
    session_id($session_id);
    $_COOKIE["session_id"] = $session_id;
    $stmt_session = $mysqli->prepare("INSERT INTO clients (session_id,client_id,pages,ip_address,user_agent) VALUES (?, ?, ?, ?, ?)"); $stmt->bind_param("sssss", $session_id, $client_id, json_encode($pages), $_SERVER['REMOTE_ADDR'], $agent);
    $stmt_session->execute();
    $stmt_session->close();
    }
}else{
    // start session
    session_start();
    $session_id = uuidv4();
    session_id($session_id);
    $_COOKIE["session_id"] = $session_id;
    $client_id = uuidv4();
    $_COOKIE["client_id"] = $client_id;
    $_SESSION["client_id"] = $client_id;
    $pages = array();
    $pages.push($_SERVER['REQUEST_URI']);
    $agent = $_SERVER["HTTP_USER_AGENT"];
    // set values used below 
    $stmt_session = $mysqli->prepare("INSERT INTO clients (session_id,client_id,pages,ip_address,user_agent) VALUES (?, ?, ?, ?, ?)"); $stmt->bind_param("sssss", $session_id, $client_id, json_encode($pages), $_SERVER['REMOTE_ADDR'], $agent);
    $stmt_session->execute();
    $stmt_session->close();
}


?>