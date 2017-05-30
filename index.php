<?php
/*
* Coded By: Tareq Mahmud Chowdhury 
* Github: https://github.com/tareqchy 
*/ 

// Loading Common Header
include("header.php"); 

// Connecting Database
$mysqli = new mysqli($sql_login_host, $sql_login_user, $sql_login_pass, $sql_login_db);

// Taking user id from SESSION
$user_id = $_SESSION['user_id'];

// Fetching All Album from DB for the logged in User
$result = $mysqli->query("SELECT * FROM album WHERE user_id=$user_id");
?> 
<div class="row">
    <?php while($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>    
      <div class="col-sm-4 col-md-4">
        <div class="thumbnail">
          <img src="uploads/<?php echo $row['photo']; ?>" />
          <div class="caption">
            <h3><?php echo $row['name']; ?></h3>
            <p><a href="view.php?album_id=<?php echo $row['id']; ?>" class="btn btn-primary" role="button">View</a> </p>
              
          </div>
        </div>
      </div>
      <?php } ?>

</div>
 <?php include("footer.php"); ?>