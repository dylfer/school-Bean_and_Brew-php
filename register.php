<?php 
include 'components/session.php';
if (isset($_POST['register'])) { 
$error = False;
$username = htmlspecialchars(stripslashes(trim($_POST['username']))); $email = htmlspecialchars(stripslashes(trim($_POST['email']))); $password = htmlspecialchars(stripslashes(trim($_POST['password']))); 

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
}
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

if (! $error)
$stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)"); $stmt->bind_param("sss", $username, $email, $password);

$password = hash_hmac('sha256', $password, 'test');
if ($stmt->execute()) {$sucsess = "New account created successfully!"; } else { echo "Error: " . $stmt->error; }




// Close the connection 
$stmt->close();
} else{
    $sucsess = "";
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

        <link href="stlye.css" rel="stylesheet" type="text/css" />
    </head>
        <body class="flex justify-center items-center w-screen h-screen">
        <?php
            include 'components/nav.php';   
        ?>
            <div class="bg-slate-800 rounded-xl p-3">
                <h1 class="text-white text-center">register</h1>
                <form class="flex flex-col items-center justify-center" action="login.php" method="POST">
                    <input class="p-2 m-2" type="text" id="username" name="username" placeholder="username" required>
                    <input class="p-2 m-2" type="email" id="email" name="email" placeholder="email" required>
                    <input class="p-2 m-2" type="password" id="password" name="password" placeholder="password" required>
                    <input class="p-2 m-2" type="password" id="conf_password" name="conf_password" placeholder="confirm password" required>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf']; ?>">
                    <p class="text-red"><?= $sucsess;?></p>
                    <button class="rounded bg-grey-700 p-1 m-1 text-white" type="submit " value="Login">submit</button>
                </form>
            </div>
            <?php
            include 'components/footer.php';
        ?>  
        </body>
</html>

