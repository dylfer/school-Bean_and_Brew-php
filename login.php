<?php 
// use Firebase\JWT\JWT;
// require "../vendor/autoload.php";

include 'components/session.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
  if (isset($_SESSION["authenticated"])){
    if ($_SESSION["authenticated"] == true) {
      header("Location: dashboard.php");
      die();
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
  // TODO add check for email in username so sigin with either email or username
  
  // Prepare and bind the SQL statement 
  $stmt = $mysqli->prepare("SELECT id, password, token_secret FROM users WHERE username = ?"); $stmt->bind_param("s", $username); 

  // Get the form data 
  $username = $_POST['username']; $password = $_POST['password']; 

  // Execute the SQL statement 
  $stmt->execute(); $stmt->store_result(); 

  // Check if the user exists 
  if ($stmt->num_rows > 0) { 

    // Bind the result to variables 
    $stmt->bind_result($id, $hashed_password, $token_secret); 

    // Fetch the result 
    $stmt->fetch(); 
    $stmt->close(); 

    // Verify the password 
    if (hash_hmac('sha256', $password, $token_secret) == $hashed_password){ 

      // Set the session variables 
      // $token = JWT::encode(["id"=>session_id(),"username"=>$username,"user_id"=>$user_id],$token_secret,'HS512');# add more to payload TOOD get user_id
      $token = "test";
      $session_id = session_id();
      $bool = true;
      $stmt_login = $mysqli->prepare("UPDATE clients SET token=?, user_id=?, login_status=? WHERE session_id=? "); $stmt_login->bind_param("ssss", $token, $user_id, $bool, $session_id);
      $stmt_login->execute();
      $stmt_login->close();
      $_SESSION['authenticated'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['token'] = $token;
      $_SESSION['user_id'] = $user_id;
      $_COOKIE['token'] = $token;
      // Redirect to the user's dashboard 
      header("Location: /school-Bean_and_Brew-php/dashboard.php"); 
      die(); 
    } else { 
      $response =  "invalid crdentials!"; 
    } 
  } else { 
    $response = "invalid crdentials!"; 
  } 
  // Close the connection 
}else{  
  $response = "";
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
include 'components/DB_close.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="description" content="login" />
    <meta name="keywords" content="login" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="flex justify-center items-center w-screen flex-col overflow-x-hidden scrollbar-none">
    <?php
      include 'components/nav.php'; 
    ?>
    <div class="h-screen grow flex items-center justify-center" >
      <div class=" bg-slate-800 rounded-xl p-3">
        <h3 class="text-center text-2xl text-white mb-3">Login</h3>
        <form class="flex flex-col items-center justify-center bg-slate" action="login.php" method="POST">
          
          <label for="username" class="sr-only">Username:</label>
          <input
          id="username"
          class="p-2 m-2"
          name="username"
          type="text"
          placeholder="Username"
          required
          autofocus
          />
          <label for="password" class="sr-only">Password:</label>
          <input
          id="password"
          class="p-2 m-2"
          name="password"
          type="password"
          placeholder="Password"
          required
          />
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf']; ?>">
          <button
          name="login"
          class="rounded bg-gray-700 m-1 text-white p-2 hover:bg-gray-900 rounded"
          type="submit"
          value="Login"
          >login</button>
        </form>
        <?php echo $response ?>
      </div>
      </div>
      <?php
      include 'components/footer.php';
      ?>
  </body>
  </html>
  