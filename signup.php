<?php 
require_once("config/db.php");

// Connecting db
$mysqli = new mysqli($sql_login_host, $sql_login_user, $sql_login_pass, $sql_login_db);

if(isset($_POST['username']))
{
    // Taking Form Data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypting Password with MD5
    
    // Running Query To check Duplication 
    $result = $mysqli->query("SELECT * FROM users where username='$username' or email='$email'");
    
    // Counting Result
    $found = $result->num_rows;
    
    if($found>0)
        $error = "Sorry! The Username or Email Already Exists.";
    else
    {
        // Inserting Data Into Users Table
        $mysqli->query("INSERT INTO users VALUES(null,'$username','$email','$password')");
        $success = 1;      
    }
    
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Signup - Online Photo Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">  
</head>
<body>
    
    <div class="container">
        <h1 class="text-center">Online Photo Gallery</h1>
        <div class="col-sm-4 col-sm-offset-4 signup_form">
            <?php  if(isset($success)){ ?>
                
                    <h3 class="label-success">Successfully Registered.</h3>
                    <a href="login.php">Login Now</a>
                
            <?php }else{ ?>
                    <label class="label-danger"><?php if(isset($error)) echo $error; ?></label>
                    <h3 class="text-center">Sign up</h3>
                    <form method="post">
                    <div class="form-group">
                    <label for="exampleInputName">Username</label>
                    <input name="username" type="text" class="form-control" id="exampleInputName" placeholder="Name">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
                    <a href="login.php">Login</a>
                    </form>
                    
            <?php } ?>
        </div>
    </div>
    
    
    
    
      <script src="js/jquery-1.12.3.js"></script>   
      <script src="js/bootstrap.min.js"></script>   
</body>
</html>