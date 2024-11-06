<?php 
// use Firebase\JWT\JWT;
// require "../vendor/autoload.php";
$error = "";
$sucsess = "";
include 'components/session.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if (isset($_SESSION["authenticated"])){
        if ($_SESSION["authenticated"] == true) {
        //   header("Location: dashboard.php");
        //   die();
        }
      }
    if ( ! isset($_SESSION["csrf"]) || ! isset($_POST['csrf_token'])){
        $error = "missing crsf token";
        header("Location: /school-bean_and_brew-php/register.php");
        die();
    }
    if ($_POST['csrf_token'] !== $_SESSION['csrf']) {
        $error = "Invalid CSRF token";
        header("Location: /school-bean_and_brew-php/register.php");
        die();
    }
    
    $error = False;
    $username = htmlspecialchars(stripslashes(trim($_POST['username']))); $email = htmlspecialchars(stripslashes(trim($_POST['email']))); $password = htmlspecialchars(stripslashes(trim($_POST['password']))); 


    $password_number = preg_match('@[0-9]@', $password);
    $password_uppercase = preg_match('@[A-Z]@', $password);
    $password_lowercase = preg_match('@[a-z]@', $password);
    $password_specialChars = preg_match('@[^\w]@', $password);


    
    if (! $password_specialChars ){
        $error = 'Password must contain at least one special character';
    }

    if (! $password_uppercase){
        $error = 'Password must contain at least one uppercase letter';
    }
    if (! $password_lowercase){
        $error = 'Password must contain at least one lowercase letter';
    }
    if (! $password_number){
        $error = 'Password must contain at least one number';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }

    if (! $error){
        $token_secret = bin2hex(random_bytes(32));
        $password = hash_hmac('sha256', $password, $token_secret);
        try{
            $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, token_secret) VALUES (?, ?, ?, ?)"); $stmt->bind_param("ssss", $username, $email, $password,$token_secret);
            $stmt->execute();
            $stmt->close();

        }catch (Exception $e) {
            $error = "username or email is already in use";
        }

        if (! $error){
            $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? AND email = ?"); $stmt->bind_param("ss", $username, $email);
            $stmt->execute(); $stmt->store_result();
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();

            #login code
            // $token = JWT::encode(["id"=>session_id(),"username"=>$username,"user_id"=>$user_id],$token_secret,'HS512');# add more to payload TOOD get user_id
            $token = "test";
            $id = session_id();
            $t = true;
            $stmt_login = $mysqli->prepare("UPDATE clients SET token=?, user_id=?, login_status=? WHERE session_id=? "); $stmt_login->bind_param("ssss", $token, $user_id, $t, $id);
            $stmt_login->execute();
            $stmt_login->close();

            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['token'] = $token;
            $_SESSION['user_id'] = $user_id;
            setcookie('token', $token);
            $sucsess = "New account created successfully!";
            header("location:/school-bean_and_brew-php/dashboard.php"); 
        }
    }
    // echo $error;
    // echo $sucsess;

} else{

    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
include 'components/DB_close.php';
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
        <body class="flex justify-center items-center w-screen flex-col overflow-x-hidden scrollbar-none">
        <?php
            include 'components/nav.php';   
        ?>
        <div class="h-screen grow flex items-center justify-center">

            <div class="bg-slate-800 rounded-xl p-3">
                <h1 class="text-white text-2xl text-center">register</h1>
                <form class="flex flex-col items-center justify-center" action="register.php" method="POST">
                    <input class="p-2 m-2" type="text" id="username" name="username" placeholder="username" required>
                    <input class="p-2 m-2" type="email" id="email" name="email" placeholder="email" required>
                    <input class="p-2 m-2" type="password" id="password" name="password" placeholder="password" required>
                    <input class="p-2 m-2" type="password" id="conf_password" name="conf_password" placeholder="confirm password" required>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf']; ?>">
                    <p class="text-red-800 text-xl"><?= $error;?></p>
                    <p class="text-green-800 text-xl"><?= $sucsess;?></p>
                    <button class="rounded bg-grey-700 p-1 m-1 text-white" type="submit" value="Login">submit</button>
                </form>
            </div>
            </div>
            <?php
            include 'components/footer.php';
            ?>  
        </body>
</html>
