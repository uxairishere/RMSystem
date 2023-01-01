<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

<body>
    <div style="padding: 3rem 0;">
        <?php
        session_start();
        if (!$_SESSION['user_id'] == 11) {
            header("location:index.php");
        }
        include('header.php');
        $inactive = 360; // Set timeout period in seconds
        if (isset($_SESSION['timeout'])) {
            $session_life = time() - $_SESSION['timeout'];
            if ($session_life > $inactive) {
                session_destroy();
            }
        }
        $_SESSION['timeout'] = time();
        include('include/header.php');

        ?>

    </div>
    <div class="row container" style="margin: 5rem auto;">
        <div class="col-md-6">
            <img src="images/addfood.jpg" alt="food upload image..." style="width: 100%;">
        </div>
        <div class="col-md-6 text-center">
            
            
        <form id="mainatt1" class="add-food-form" name="mainatt1" method="POST" action="add_food_DB.php" enctype="multipart/form-data">
        <h1> Add More Food! </h1>

            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
            <input type="text" class="textbox form-control" id="Foodtname" name="Foodtname" placeholder="Food Name" required />
            <!-- select chef  -->
            <select id="Chef" name="Chef" class="form-control" >
                <?php

                $q2 = "SELECT * FROM `chef`";
                $row = mysqli_query($link, $q2);

                while ($result = mysqli_fetch_array($row)) { ?>

                    <option value="<?php echo $result[0]; ?>"><?php echo $result[1]; ?></option>
                <?php  }  ?>
            </select>

            <!-- resturant  -->
            <select id="Restuarent" name="Restuarent" class="form-control">
                <?php

                $q3 = "SELECT * FROM `restaurant` ORDER BY `restaurant`.`restaurant_id` ASC";
                $row3 = mysqli_query($link, $q3);

                while ($result3 = mysqli_fetch_array($row3)) { ?>

                    <option value="<?php echo $result3[0]; ?>"><?php echo $result3[1]; ?></option>
                <?php  }  ?>
            </select>
            <input type="number" class="textbox form-control" id="Foodprice" name="Foodprice" placeholder="Price" required />
            <input type="reset" id="reset" title="reset" value="reset" class="btn grad-btn-4">
            <input type="submit" id="submit" title="Register New Food" value="Register New Food" class="btn grad-btn-4">
        </form>
        </div>
    </div>






    <?php if ($_GET) { ?>
        <div class="row alert alert-success text-center" style="width: 80%; margin: 2rem auto;">
            <h4 class=""><?php echo $_GET['success']; ?></h4>
        </div>
    <?php } ?>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>