
<?php
    session_start();
    if (!$_SESSION['user_id'] == 11) {
        header("location:index.php");
    }
    // include('header.php');
    $inactive = 360; // Set timeout period in seconds
    if (isset($_SESSION['timeout'])) {
        $session_life = time() - $_SESSION['timeout'];
        if ($session_life > $inactive) {
            session_destroy();
        }
    }
    $_SESSION['timeout'] = time();
    include('include/header.php');


    // Imageupload 
    $target_dir = "images/food/";
    $target_file_name = rand() . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $target_file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
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
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }



    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $Chef = $_POST['Chef'];
        $foodPrice = $_POST['Foodprice'];

        $q = "INSERT INTO food_menu (food_menu_id, food_menu_name, chef_id, restaurant_id, food_type, pic, price) VALUES (NULL, '" . $_POST['Foodtname'] . "', '" . $_POST['Chef'] . "', '" . $_POST['Restuarent'] . "', 'a', '$target_file', '$foodPrice');";


        mysqli_query($link, $q) or die("could not insert into database");
        echo "DATA INSERTED SUCCESSFULLY";
    }else{
      echo "Sorry, there was an error uploading your file.";

    }

    header("location:add_food.php?success=Food entered successfully!");
    
    ?>
