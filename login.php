<?php 
include 'functions/uuid.php';

include 'components/session.php';
if (isset($_POST['login'])) { 


  // Prepare and bind the SQL statement 
  $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?"); $stmt->bind_param("s", $username); 

  // Get the form data 
  $username = $_POST['username']; $password = $_POST['password']; 

  // Execute the SQL statement 
  $stmt->execute(); $stmt->store_result(); 

  // Check if the user exists 
  if ($stmt->num_rows > 0) { 

    // Bind the result to variables 
    $stmt->bind_result($id, $hashed_password); 

    // Fetch the result 
    $stmt->fetch(); 
    $stmt->close(); 

    // Verify the password 
    if (hash_hmac('sha256', $password, 'test') == $hashed_password){ 

      // Set the session variables 
      $_SESSION['loggedin'] = true; $_SESSION['username'] = $username; session_id(uuidv4()); $_SESSION['user_id'] = $id;

      $session_id = session_id();
      $t = true;
      $stmt_session = $mysqli->prepare("UPDATE clients SET user_id = ?, login_status = ? WHERE session_id == ?;"); $stmt->bind_param("sss", $user_id, $t, $session_id);
      $stmt_session->execute();
      $stmt_session->close();
      // Redirect to the user's dashboard 
      header("Location: dashboard.php"); 
      exit; 
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
  <body class="text-center flex justify-center h-screen m-0">
    <?php
      include 'components/nav.php'; 
    ?>
    <div class=" mx-auto mt-5 bg-light">
      <form class="card-body form-signin" action="login.php" method="post">
        <h3 class="text-center mb-3">Login</h3>
        <label for="username" class="sr-only">Username:</label>
        <input
          id="username"
          class="form-control"
          name="username"
          type="text"
          placeholder="Username"
          required
          autofocus
        />
        <label for="password" class="sr-only">Password:</label>
        <input
          id="password"
          class="form-control"
          name="password"
          type="password"
          placeholder="Password"
          required
        />
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf']; ?>">
        <button
          name="login"
          class="btn btn-lg btn-primary btn-block"
          type="submit"
          value="Login"
        >login</button>
      </form>
      <?php echo $response ?>
    </div>
    <?php
      include 'components/footer.php';
    ?>
  </body>
</html>
