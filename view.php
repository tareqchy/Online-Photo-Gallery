<?php 
// Including Common Header
include("header.php"); 


// Connecting Database
$mysqli = new mysqli($sql_login_host, $sql_login_user, $sql_login_pass, $sql_login_db);

// Taking Album ID from URL
$album_id = $_GET['album_id'];

// When Deleting the Album
if(isset($_POST['delete_album']))
{
    // Running Delete Query
    $mysqli->query("DELETE FROM album WHERE id=$album_id");
    
    // Redirecting to Homepage
    Header("Location: index.php");
}

// When Update the Album Name
if(isset($_POST['album_name']))
{
    // Taking Form Data
    $album_name = $_POST['album_name'];
    
    // Running Update Query
    $mysqli->query("UPDATE album SET name='$album_name' WHERE id=$album_id");   
}

// When New Photo Uploaded
if(isset($_FILES['photo']))
{
    // Name of the Upload Folder
    $uploaddir = 'uploads/';
    
    // Name of the Uploaded Photo
    $name = $_FILES['photo']['name']; 
    
    // The Final Path Where the Photo will be Stored
    $uploadfile = $uploaddir . $name;

    
    // Taking User ID from SESSION
    $user_id = $_SESSION['user_id'];

    // If The Upload is Successfull
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
        
        // Inserting Data into Database    
        $mysqli->query("INSERT INTO photos VALUES(null,'$name',$album_id,$user_id)");
        $success = "Successfully Uploaded.";

    } 
    else {
        $error = "Upload Failed! Please Try Again.";
    }
  
}

// Fetching The Album Information From DB
$result_album = $mysqli->query("SELECT * FROM album WHERE id=$album_id");

// Keep the Album data into array
$album = $result_album->fetch_array(MYSQLI_ASSOC);

// Fetching All Photo Under The Album From DB
$result_photo = $mysqli->query("SELECT * FROM photos WHERE album_id=$album_id");
?>  
    <div class="row">
      <div class="col-sm-12">
             
            <form method="post">
                   <input type="text" name="album_name" value="<?php echo $album['name']; ?>" />
                   <button type="submit" class="btn btn-success">Update</button>
            </form>
            <form method="post">
                  <button name="delete_album" type="submit" class="btn btn-danger">Delete This Album</button>
            </form>
          <h3>All Photos under <?php echo $album['name']; ?></h3>  
          <button class="btn btn-warning" data-toggle="modal" data-target="#myModal">Upload New Photo</button>
      </div>
    </div>
    <div class="row photogallery">
     <?php while($row = $result_photo->fetch_array(MYSQLI_ASSOC)) { ?>     
      <div class="col-sm-3 col-md-3">
        <img src="uploads/<?php echo $row['name']; ?>" /> 
      </div>
    <?php } ?>
    </div>

<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload New Photo</h4>
          <?php if(isset($success)){ ?>
                <h3 class="text-success"><?php echo $success; ?></h3>
          <?php } ?>
          <?php if(isset($error)){ ?>
                <h3 class="text-danger"><?php echo $error; ?></h3>
          <?php } ?>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <input name="photo" type="file" class="form-control" />
              <button type="submit" class="btn btn-primary">Upload</button>
          </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <?php include("footer.php"); ?>