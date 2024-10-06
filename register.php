<?php 
include 'components/session.php';
if (isset($_POST['register'])) { 


// Prepare and bind the SQL statement 
$stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)"); $stmt->bind_param("sss", $username, $email, $password); 

// Get the form data 
$username = $_POST['username']; $email = $_POST['email']; $password = $_POST['password']; 

// Hash the password 
$password = hash_hmac('sha256', $password, 'test');


// Execute the SQL statement 
if ($stmt->execute()) {$sucsess = "New account created successfully!"; } else { echo "Error: " . $stmt->error; } 




// Close the connection 
$stmt->close(); $mysqli->close(); 
} else{
    $sucsess = "";
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
    <body>
        <?php
            include 'components/nav.php';   
        ?>
        <form action="register.php" method="post">
            <label class="sr-only" for="username">Username:</label> 
            <input id="username"  required="" type="text" /> 
            <label class="sr-only" for="email">Email:</label>
            <input id="email" name="email" required="" type="email" />
            <label class="sr-only" for="password">Password:</label>
            <input id="password" name="password" required="" type="password" />
            <input name="register" type="submit" value="Register" />
            <?php echo $sucsess; ?>
        </form>
        <?php
            include 'components/footer.php';
        ?>  
    </body>
</html>

