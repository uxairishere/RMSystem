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

    $Restuarents = "";
    $Restuarents2 = "1";
    $curr_price = 20000;


    if (isset($_POST['Restuarents'])) {
        $Restuarents = $_POST['Restuarents'];
        $Restuarents2 = $Restuarents;
    }
    if (isset($_POST['price'])) {
        $curr_price = $_POST['price'];
    }
    ?>

    <?php if (isset($_SESSION['name'])) {  ?>
        <div class="row">
            <div class="text-center" style=" padding: 1rem; background-color: black; border-radius: 12px; width: 80%; margin: 10rem auto 2rem auto;">
                <h3 style="font-weight: 800; color:aliceblue">Predictive Menu</h3>
            </div>
            <?php

            /*		
            Reference:
            https://www.digitalvidya.com/blog/apriori-algorithms-in-data-mining/
            Step 1
            Create a frequency table of all the items that occur in all the transactions. Now, prune the frequency table to include only those items having total number of order. 
            */

            $row_pt = mysqli_query($link, "SELECT COUNT(*) AS `count` FROM `order` WHERE `user_id`='" . $_SESSION['user_id'] . "'");
            while ($r = mysqli_fetch_array($row_pt)) {
                $pt = $r[0];

                /*		
            Step 2
            Create a data set having frequency distinct (unique) table of all the items order that occur in all the transactions. 
            */
            }
            $pm = "SELECT distinct (`food_menu_id`), COUNT(*) AS `count` FROM `order` WHERE `user_id`='" . $_SESSION['user_id'] . "' GROUP BY `food_menu_id` order by `count` desc limit 5";
            $p = 1;
            $row_pm = mysqli_query($link, $pm);
            while ($rowpm = mysqli_fetch_array($row_pm)) {
                $pmv1[$p] = $rowpm[0];
                $pmv2[$p] = $rowpm[1];
                //echo $pmv1[$p]."------";
                //echo $pmv2[$p]."<br>";

                $p = $p + 1;

                /*
            Step 3
            Obtaining probability of food to be order by considering all two previous steps.
            Apply the same threshold support of 50% and consider the items that exceed 50% (in this case 3 and above).
            */

                $food_query = "SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic,f.price,r.res_description, f.rating, f.reviews from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and r.restaurant_id=$Restuarents2 and f.food_menu_id=$rowpm[0]";
                //echo $food_query;
                $row_food_query = mysqli_query($link, $food_query);
                while ($rowfood = mysqli_fetch_array($row_food_query)) {

                    $chance = 100 * $rowpm[1] / $pt;
                    //echo round($chance, 0)."%";
                    // echo "<h4>".$rowfood[1]." - Ordered ".$rowpm[1]." Time already & Now ". round($chance, 0)."% Chances</h4>";
            ?>

                    <div class="row home-cards" style="width:90%; margin: 1rem auto; background-color: white; padding: 1rem; border-radius: 12px;">
                        <div class="col-md-4 home-food-cover" style="background-image: url('<?php echo $rowfood[8] ?>'); border-radius: 12px"></div>
                        <div class="col-md-8">

                            <a href="viewOrder.php?foodid=<?php echo $rowfood[0]; ?>">
                                <h3><?php echo $rowfood[1];  ?></h3>
                            </a>
                            <h4><?php echo $rowfood[7]; ?></h4>
                            <h4 style="color: green; font-weight: 700;">Rs. <?php echo $rowfood[9]; ?></h4>
                            <!-- ratings  -->
                            <?php for ($i = 0; $i < $rowfood[11]; $i++) { ?>
                                <i class="fa fa-star" style="color: gold;"></i>
                            <?php } ?>
                            <?php echo '(' . $rowfood[12] . ')'; ?>
                            <form id="mainatt2" name="mainatt2" method="POST" action="addToCart.php">
                                <input type="text" name="foodprice" value="<?php echo $rowfood[9]; ?>" style="display: none;"></input>

                                <!-- incre decre  -->
                                <div class="input-group incre-group">
                                    <button class="btn grad-btn-danger2 decre" type="button" id="decrement"><i class="bi bi-dash"></i></button>
                                    <input type="number" id="fperson" class="fperson" name="fperson" readonly>
                                    <button class="btn grad-btn-3 incre"  type="button" id="increment"><i class="bi bi-plus"></i></button>
                                </div>

                                <input type="hidden" id="food_image" name="food_image" value="<?php echo $rowfood[8]; ?>">
                                <input type="hidden" id="food_name" name="food_name" value="<?php echo $rowfood[1]; ?>">
                                <input type="hidden" id="food_id" name="food_id" value="<?php echo $rowfood[0]; ?>">
                                <input type="hidden" id="user_id" name="user_id" value="<?php if (isset($_SESSION['user_id'])) {
                                                                                            echo $_SESSION['user_id'];
                                                                                        } ?>">
                                <?php if (!isset($_SESSION['user_id'])) { ?>
                                    <a class="btn grad-btn-2" href="login.php">ADD TO CART <i class="fa fa-shopping-cart"></i>+</a>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-warning">ADD TO CART <i class="fa fa-shopping-cart"></i>+</button>

                                <?php } ?>
                                <!-- rating area  -->
                            </form>



                        </div>

                    </div>

            <?php  }
            }  ?>
        </div>
        </div>
    <?php  }   ?>

    <?php include('footer.php') ?>

        <!-- incr decr  -->
        <script>
        let counter = 0;

        function increment() {
            counter++;
        }

        function decrement() {
            counter--;
        }

        function get() {
            return counter;
        }

        const inc = document.getElementsByClassName("incre");
        const input = document.getElementsByClassName("fperson");
        const dec = document.getElementsByClassName("decre");

        for (let i = 0; i < inc.length; i++) {
            inc[i].addEventListener("click", () => {
                increment();
                input[i].value = get();
            });

            dec[i].addEventListener("click", () => {
                if (input[i].value > 0) {
                    decrement();
                }
                input[i].value = get();
            });
        }
    </script>