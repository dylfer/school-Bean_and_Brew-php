<?php
include 'functions/uuid.php';
include 'components/DB_conect.php';


function ban($malicious_level,$ban_time){
    if($malicious_level >= 20){
        if ($malicious_level >= 30){
            if ($malicious_level >= 40){

                if ($malicious_level >= 50){
                    // band ip
                    header("Location: /school-Bean_and_Brew-php/band.php?duration=lifetime&reason=malicious_activity");
                }
                if (strtotime($ban_time) + 86400 > strtotime(date('Y-m-d H:i:s'))) {
                    header("Location: /school-Bean_and_Brew-php/band.php?duration=1d&reason=malicious_activity&warning=next_ban_is_lifetime");
                }
            }
            if (strtotime($ban_time) + 3600 > strtotime(date('Y-m-d H:i:s'))) {
                header("Location: /school-Bean_and_Brew-php/band.php?duration=1h&reason=malicious_activity&warning=next_ban_is_lifetime");
            }
        }
        if (strtotime($ban_time) + 1200 > strtotime(date('Y-m-d H:i:s'))) {
            header("Location: /school-Bean_and_Brew-php/band.php?duration=20m&reason=malicious_activity");
        }
    }
}
$stmt_malicious = $mysqli->prepare("SELECT malicious_level,client_id,ban_time  FROM clients WHERE ip = ?"); $stmt_session->bind_param("s", $_SERVER['REMOTE_ADDR']);
$stmt_malicious->execute(); $stmt_malicious->store_result();
if ($stmt_malicious->num_rows > 0 ) {
    $stmt_malicious->bind_result($malicious_level,$last_updated,$client_id,$ban_time);
    $stmt_malicious->fetch();
    $stmt_malicious->close();
    ban($malicious_level,$ban_time);
}
function manage_session($mysqli){
    if (session_id() != NULL) {
        $session_id = session_id();
        $stmt_session = $mysqli->prepare("SELECT  login_status, user_id,pages,last_request,ip_address, user_agent FROM clients WHERE session_id=?"); $stmt_session->bind_param("s", $session_id);
        $stmt_session->execute(); $stmt_session->store_result();

        if ($stmt_session->num_rows > 0 ) {
            $loged_in = $user_id = $pages = $last_request = $ip = $agent = null;
            $stmt_session->bind_result($loged_in,$user_id,$pages,$last_request,$ip,$agent);
            $stmt_session->fetch();
            $stmt_session->close();
            $pages = json_decode($pages);
            if($ip != $_SERVER['REMOTE_ADDR']){
                // create new session - proxy or vpn detected -  TODO: add client id carry over
                // destroy session
                
                if ($session_id = "") {
                    $session_id = $_COOKIE["session_id"];
                }
                $stmt_session = $mysqli->prepare("SELECT client_id FROM clients WHERE session_id=?"); $stmt_session->bind_param("s", $session_id);
                $stmt_session->execute(); $stmt_session->store_result();
                $client_id = null;
                $stmt_session->bind_result($client_id);
                $stmt_session->fetch();
                $stmt_session->close();
                session_destroy();
                if($_COOKIE["client_id"] != $client_id && isset($_COOKIE["client_id"])){
                    // cookie tampering kill session
                    unset($_COOKIE['client_id']);
                    unset($_COOKIE['session_id']);
                    $stmt_session = $mysqli->prepare("UPDATE clients SET malicious_level=malicious_level+1 , ban_time=?  WHERE ip_address=? "); $stmt_session->bind_param("ss", date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR']);
                    $stmt_session->execute();
                    $stmt_session->close();
                    // TODO create new session and track posible hyjacking/malishous activity
                }
                

                // create new session -use client id
                // $previous_sid = $session_id;//TODO for tracking posible hyjacking/malishous activity
                session_start();
                $session_id = uuidv4();
                session_id($session_id);
                setcookie('session_id', $session_id, time() + 3600);
                $stmt_session = $mysqli->prepare("INSERT INTO clients (session_id,client_id,pages,ip_address,user_agent) VALUES (?, ?, ?, ?, ?)"); $stmt_session->bind_param("sssss", $session_id, $client_id, $pages, $_SERVER['REMOTE_ADDR'], $agent);
                $stmt_session->execute();
                $stmt_session->close();
                // TODO create new session and track posible hyjacking/malishous activity
                
            }else if ($_SERVER["HTTP_USER_AGENT"] != $agent){
                // user agent changes - tampering or stolen session 
                    session_destroy();
                    unset($_COOKIE['client_id']);
                    unset($_COOKIE['session_id']);
                    $stmt_session = $mysqli->prepare("UPDATE clients SET malicious_level=malicious_level+1 , ban_time=?  WHERE ip_address=? "); $stmt_session->bind_param("ss", date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR']);
                    $stmt_session->execute();
                    $stmt_session->close();
                    // TODO create new session and track posible hyjacking/malishous activity
            // }else if($last_request>1 hour ){ //TODO
            //     // sesion timeout, posible hyjacking
            // }else if($client_id != $_COOKIE["client_id"]){
            //     // user id changes - tampering or stolen session 
            // }else if($user_id != $_SESSION["user_id"]){
            //     // user id tampering. atempt to authenticate with difrent account
            

            }else{
                // update session data 
                $pages[] = $_SERVER['REQUEST_URI'];
                $stmt_session = $mysqli->prepare("UPDATE clients SET pages=? WHERE session_id = ?"); $stmt_session->bind_param("sss", $pages, $session_id);
                $stmt_session->execute();
                $stmt_session->close();
        
            }
        }else{
            // create new session
            //$_SERVER['REMOTE_ADDR']
            unset($_COOKIE['client_id']);
            unset($_COOKIE['session_id']);
            $stmt_session = $mysqli->prepare("UPDATE clients SET malicious_level=malicious_level+10 , ban_time=?  WHERE ip_address=? "); $stmt_session->bind_param("ss", date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR']);
            $stmt_session->execute();
            $stmt_session->close();
            $session_id = uuidv4();
            session_id($session_id);
            $client_id = uuidv4();
            $_COOKIE["client_id"] = $client_id;
            $_SESSION["client_id"] = $client_id;
            setcookie('session_id', $session_id, time() + 3600);
            $pages = array();
            $pages[] = $_SERVER['REQUEST_URI'];
            $agent = $_SERVER["HTTP_USER_AGENT"];
            // set values used below 
            $pages = json_encode($pages);
            $stmt_session = $mysqli->prepare("INSERT INTO clients (session_id,client_id,pages,ip_address,user_agent) VALUES (?, ?, ?, ?, ?)"); $stmt_session->bind_param("sssss", $session_id, $client_id, $pages, $_SERVER['REMOTE_ADDR'], $agent);
            $stmt_session->execute();
            $stmt_session->close();
        }
    }else{
        // start session
        if (isset($_COOKIE["session_id"])){
            session_id($_COOKIE["session_id"]);
            manage_session($mysqli);

        }else if (isset($_COOKIE["client_id"])){
            session_start();
            $client_id = $_COOKIE["client_id"];
            $session_id = uuidv4();
            session_id($session_id);
            setcookie('session_id', $session_id, time() + 3600);
            $pages = array();
            $pages[] = $_SERVER['REQUEST_URI'];
            $agent = $_SERVER["HTTP_USER_AGENT"];
            // set values used below 
            $pages = json_encode($pages);
            $stmt_session = $mysqli->prepare("INSERT INTO clients (session_id,client_id,pages,ip_address,user_agent) VALUES (?, ?, ?, ?, ?)"); $stmt_session->bind_param("sssss", $session_id, $client_id, $pages, $_SERVER['REMOTE_ADDR'], $agent);
            $stmt_session->execute();
            $stmt_session->close();
        }else{
            session_start();
            $session_id = uuidv4();
            session_id($session_id);
            $client_id = uuidv4();
            $_COOKIE["client_id"] = $client_id;
            $_SESSION["client_id"] = $client_id;
            setcookie('session_id', $session_id, time() + 3600);
            $pages = array();
            $pages[] = $_SERVER['REQUEST_URI'];
            $agent = $_SERVER["HTTP_USER_AGENT"];
            // set values used below 
            $pages = json_encode($pages);
            $stmt_session = $mysqli->prepare("INSERT INTO clients (session_id,client_id,pages,ip_address,user_agent) VALUES (?, ?, ?, ?, ?)"); $stmt_session->bind_param("sssss", $session_id, $client_id, $pages, $_SERVER['REMOTE_ADDR'], $agent);
            $stmt_session->execute();
            $stmt_session->close();
        }
    }
}
manage_session($mysqli);