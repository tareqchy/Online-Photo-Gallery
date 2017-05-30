<?php 
include("header.php"); 

// Connecting db
$mysqli = new mysqli($sql_login_host, $sql_login_user, $sql_login_pass, $sql_login_db);

if(isset($_POST['album']))
{
    // Taking Form Data
    $name = $_POST['album'];
    $photo = $_FILES['coverphoto']['name'];
     
    // Upload Folder Name
    $uploaddir = 'uploads/';
    
    // The exact location where the photo will be stored
    $uploadfile = $uploaddir . $photo;
    
    // Taking User Id From SESSION
    $user_id = $_SESSION['user_id'];
    
    // If Upload Successfull
    if (move_uploaded_file($_FILES['coverphoto']['tmp_name'], $uploadfile)) {
        
    // Insert Album Information into DB    
    $mysqli->query("INSERT INTO album VALUES(null,'$name','$photo',$user_id)");
    $success = 1;

    } else {
        echo "Not uploaded";
    }
  
}

?>
    <div class="row">
        <div class="col-sm-4">
        <?php  if(isset($success)){ ?>
                <h4 class="text-success">New Album Created Successfully.</h4>
        <?php } ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label for="exampleInputEmail1">Album Name</label>
            <input name="album" type="text" class="form-control" id="exampleInputEmail1" placeholder="Album name">
            </div>

            <div class="form-group">
            <label for="exampleInputFile">File photocover</label>
            <input name="coverphoto" type="file" id="exampleInputFile">
            <p class="help-block">Example block-level help text here.</p>
            </div>
            <button type="submit" class="btn btn-default">Add New Album</button>
        </form>
        </div>
    </div>
 <?php include("footer.php"); ?>
    
                  