<?php 
include('include/connection.php');

$Username=$_POST['Username'];
$email=$_POST['email'];
$cell_no=$_POST['cell_no'];
$Password=$_POST['Password'];
$Address=$_POST['Address'];
//echo "INSERT INTO `proj_user` (`user_id`, `user_name`, `email`, `cell`, `user_pwd`, `user_role`, `remarks`, `Address`) VALUES (NULL, '$Username', '$email','$cell_no',NULL, NULL,'$Password','$Address'";

// check if email exists 
function isAvailable($email,$link)
  {
       $sql = "SELECT email FROM proj_user WHERE email='$email'" ;

       $result = mysqli_query($link,$sql) ;

       if( mysqli_num_rows( $result ) > 0 )
       {
            return true;
       }
       return false;
}

// image upload 
$target_dir = "images/profiles/";
$target_file_name = rand() . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $target_file_name;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if(!isAvailable($email,$link)){
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    // upload data into DB 
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      mysqli_query($link,"INSERT INTO `proj_user` (`user_id`, `user_name`, `email`, `cell`, `user_pwd`, `user_role`, `remarks`, `Address`,`image`) VALUES ('', '$Username', '$email','$cell_no','$Password',NULL, NULL,'$Address', '$target_file_name');")or die("could not insert into database");
session_start();
 $last_id = mysqli_insert_id($link);
$_SESSION['name']=$_POST['Username'];
$_SESSION['user_id']=$last_id;
$_SESSION['email']=$_POST['email'];
$_SESSION['image']=$target_file_name;
header("Location: index.php");
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}else{
    header("Location: user_reg.php?error=Email already exists!");
    
}


// echo "There was an error while creating account (please check image size or format)";
