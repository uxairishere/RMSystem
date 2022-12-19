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
    <div class="container" style="background-color:#FDF5EC">

        <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">


            <h1> Add Food Menu </h1>
            <form id="mainatt1" name="mainatt1" method="POST" action="add_food_DB.php" enctype="multipart/form-data">


                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">

                    <tr>
                        <td>Select image to upload:</td>
                        <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                    </tr>
                    <tr>
                        <td>Food Menu Name </td>
                        <td><input type="text" class="textbox" id="Foodtname" name="Foodtname" placeholder="Food Menu Name" required />
                        </td>
                    </tr>
                    <tr>
                        <td>Select Chef</td>
                        <td> <select id="Chef" name="Chef" style="width:300px;" class="btn btn-primary">
                                <?php

                                $q2 = "SELECT * FROM `chef`";
                                $row = mysqli_query($link, $q2);

                                while ($result = mysqli_fetch_array($row)) { ?>

                                    <option value="<?php echo $result[0]; ?>"><?php echo $result[1]; ?></option>
                                <?php  }  ?>
                            </select></td>
                    </tr>

                    <tr>
                        <td>Select Restuarent</td>
                        <td> <select id="Restuarent" name="Restuarent" style="width:300px;" class="btn btn-primary">
                                <?php

                                $q3 = "SELECT * FROM `restaurant` ORDER BY `restaurant`.`restaurant_id` ASC";
                                $row3 = mysqli_query($link, $q3);

                                while ($result3 = mysqli_fetch_array($row3)) { ?>

                                    <option value="<?php echo $result3[0]; ?>"><?php echo $result3[1]; ?></option>
                                <?php  }  ?>
                            </select></td>
                    </tr>

                    <tr>
                        <td>Price </td>
                        <td><input type="number" class="textbox" id="Foodprice" name="Foodprice" placeholder="Price" required />
                        </td>
                    </tr>


                    <tr>
                        <td></td>

                        <td><input type="reset" id="reset" title="reset" value="reset" class="btn btn-primary"> &nbsp;
                            <input type="submit" id="submit" title="Register New Food" value="Register New Food" class="btn btn-primary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>






    <?php if($_GET){ ?>
        <div class="row alert alert-success text-center" style="width: 80%; margin: 2rem auto;">
            <h4 class=""><?php echo $_GET['success']; ?></h4>
        </div>
    <?php } ?>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>