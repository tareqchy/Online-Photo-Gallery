<?php
require_once("config/db.php");

if(isset($_POST['email']))
{   
    // Taking Login Form Data
    $email = $_POST['email'];
    $p = md5($_POST['password']);
    
    // Connecting Database
    $mysqli = new mysqli($sql_login_host, $sql_login_user, $sql_login_pass, $sql_login_db);
    
    // Running Query
    $result = $mysqli->query("SELECT * FROM users where email='$email' and password='$p'"); 
    
    
    // Counting Result
    $found = $result->num_rows;
     
    // If results found logged in successfully
    if($found>0)
    {
        // Taking User Data From Query Result
        $row = $result->fetch_array(MYSQLI_ASSOC); 
         
        // Starting session
        session_start();
        $_SESSION['user_id'] = $row['id']; // Keeping User ID in SESSION for Future Use
                               
        header("Location: index.php"); // Return to the homepage
    }
    else
        $error = "Sorry! Invalid username or password.";  // Login failed 
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Login - Online Photo Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet"> 
    </head>
<body>
    <div class="container">
        <h1 class="text-center">Online Photo Gallery</h1>
        <div class="col-sm-4 col-sm-offset-4 login_form">
            <h3 class="text-center">User Login</h3>
            <?php if(isset($error)) { ?>
            <label class="label-danger"><?php echo $error; ?></label>
            <?php } ?>
          <form method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
            <a href="signup.php">Signup</a>
        </form>
        
        </div>
    
    </div>
    
      <script src="js/jquery-1.12.3.js"></script>   
      <script src="js/bootstrap.min.js"></script>   
</body>
</html>