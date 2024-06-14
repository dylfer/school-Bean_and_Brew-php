<?php 
include 'functions/uuid.php';
session_start(); 
if (isset($_POST['login'])) { 

include 'DB_conect.php';


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

// Verify the password 
if (password_verify($password, $hashed_password)) { 

// Set the session variables 
$_SESSION['loggedin'] = true; $_SESSION['id'] = $id; $_SESSION['username'] = $username; $_SESSION["session_id"] = guidv4();

// Redirect to the user's dashboard 
header("Location: dashboard.php"); exit; } else { $response =  "Incorrect password!"; } } else { $response = "User not found!"; } 

// Close the connection 
$stmt->close(); $mysqli->close(); }else{
  $response = ""
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta name="description" content="login" />
    <meta name="keywords" content="login" />
    <style>
      body {
        display: flex;
        justify-content: center;
        height: 100vh;
        margin: 0;
      }
      .card {
        width: 300px;
      }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="text-center">
    <?php
      include 'components/nav.php'; 
    ?>
    <div class="card mx-auto mt-5 bg-light">
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
        <input
          name="login"
          class="btn btn-lg btn-primary btn-block"
          type="submit"
          value="Login"
        />
      </form>
      <?php echo $response ?>
    </div>
    <?php
      include 'components/footer.php';
    ?>
  </body>
</html>
