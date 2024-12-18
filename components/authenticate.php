<?php
// use Firebase\JWT\JWT;
// require "../vendor/autoload.php";
if ( ! isset($_SESSION["authenticated"])){
    $_SESSION["authenticated"] = false;
    try{
        unset($_SESSION["username"]);
        unset($_SESSION["token"]);
        unset($_SESSION["user_id"]);
    }catch (Exception $e) {
        
    }
    // echo "";
}

if ( $_SESSION["authenticated"] == false) {
    try{
        // TODO try unset auith session data (might not even be set)
        $_SESSION["authenticated"] = false;
        unset($_SESSION["username"]);
        unset($_SESSION["token"]);
        unset($_SESSION["user_id"]);
    }catch (Exception $e) {
        
    }
    // echo "e";
    header("Location: login.php");
    die();
}
$session_id = session_id();
$stmt_session = $mysqli->prepare("SELECT login_status, user_id FROM clients WHERE session_id=?"); $stmt_session->bind_param("s", $session_id);
$stmt_session->execute(); $stmt_session->store_result();
$loged_in = $user_id = null;
$stmt_session->bind_result($loged_in, $user_id);
$stmt_session->fetch();
$stmt_session->close();
if ($loged_in == false) {
    // TODO unset auth session data 
    // echo $user_id;
    // echo "a";
    header("Location: login.php");
    die();
}

$stmt_auth = $mysqli->prepare("SELECT token_secret FROM users WHERE id = ? AND  username = ?"); $stmt_auth->bind_param("is", $user_id, $_SESSION["username"]);
$stmt_auth->execute(); $stmt_auth->store_result(); 

if ($stmt_auth->num_rows > 0 ) {
    $token_secret = null;
    $stmt_auth->bind_result($token_secret);
    $stmt_auth->fetch();
    $stmt_auth->close();
    // $token = JWT::encode($_SESSION,$token_secret,'HS512');
    $token = "test";
    if( $_SESSION["token"] != $_COOKIE["token"]){
        $d = date('Y-m-d H:i:s');
        $stmt_session = $mysqli->prepare("UPDATE clients SET malicious_level=malicious_level+1 , ban_time=?  WHERE ip_address=? "); $stmt_session->bind_param("ss", $d,$_SERVER['REMOTE_ADDR']);
        $stmt_session->execute();
        $stmt_session->close();
        // TODO clear auth session data 
        header("Location: login.php");
        die();
    };
    if ($_SESSION["token"] == $token) {// use jwt to verify token
        $valid_auth = true;
    }
    else{
        // invalid token
        // TODO clear auth session data 
        // echo "b";
        header("Location: login.php");
        die();
    };

}else{
    // inconsistency in session data (username, user_id, session_id, login_status)
    // TODO clear auth session data 
    // echo $_SESSION["token"];
    // echo $_SESSION["user_id"];
    // echo "na";
    header("Location: login.php");
    die();
    
};
