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

    <div style="width: 90%; margin: 0rem auto; padding: 12rem 0 0 0; border-radius: 12px;">
        <div id="jssor_1" style="position:relative;margin:0 auto;top:-20px;left:0px;width:980px;height:320px;overflow:hidden;visibility:hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:420px;overflow:hidden;  border-radius: 12px;">
                <div class="slide-cover-1 slide-cover">
                    <!-- <img data-u="image" src="img/011.jpg" /> <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a> -->
                </div>
                <div class="slide-cover-2 slide-cover">
                    <!-- <img data-u="image" src="img/012.jpg" /> <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a> -->
                </div>
                <div class="slide-cover-3 slide-cover">
                    <!-- <img data-u="image" src="img/013.jpg" /> <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a> -->
                </div>
                <div class="slide-cover-4 slide-cover">
                    <!-- <img data-u="image" src="img/014.jpg" /> <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a> -->
                </div>

            </div>
            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                    </svg>
                </div>
            </div>
            <!-- Arrow Navigator -->
            <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                    <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                    <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                </svg>
            </div>
            <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                    <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                    <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                </svg>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jssor_1_slider_init();
    </script>




    <div>
        <div class="home_page_wrapper" style="width: 95%; margin: 0 auto; padding: 0 0 5rem 0;">

            <script>
                function doSearch(text) {
                    if (window.find(text)) {
                        console.log(window.find(text));
                    }
                }
            </script>


            <div class="row" style=" padding: 1rem;color: black; border-width: 3px; ">
                <div class="col-md-12 text-center">

                    <h1 style="font-weight: 700;">Hungry in <span class="text-success">راولپنڈی</span>? We got you buddy!</h1>
                    <h4 align="right">Table Reservation <img src="images/table_reserve.png" align="right" style="margin-top:-40px; margin-left:10px" width="90px"></h4>
                </div>

                <div class="filters_container text-center" style="margin: 6rem auto;">
                    <h4 style="font-weight: 800;">Filters to find best food for you!</h4>
                    <form id="mainatt1" name="mainatt1" method="post" action="" onSubmit="return validate(this);" enctype="multipart/form-data">
                        <select id="Restuarents" name="Restuarents" class="btn btn-primary">
                            <option value="0">Select Restaurant </option>
                            <?php
                            $q2 = "select res_name, restaurant_id from restaurant";
                            $row2 = mysqli_query($link, $q2);
                            while ($result2 = mysqli_fetch_array($row2)) { ?>
                                <option value="<?php echo $result2['restaurant_id']; ?>" <?php if ($Restuarents2 == $result2['restaurant_id']) echo "selected"; ?>><?php echo $result2['res_name']; ?></option>
                            <?php  }   ?>
                        </select>

                        <select name="price" id="price" class="btn btn-primary">
                            <option selected value="5000">
                                Rs. 5000</option>
                            <option value="2000">
                                Rs. 2000</option>
                            <option value="1000">
                                Rs. 1000</option>
                            <option value="500">
                                Rs. 500</option>
                            <option value="250">
                                Rs. 250</option>
                        </select>
                        <button style="padding: 0.5rem 5rem" type="submit" class="btn btn-success">Find</button>

                    </form>
                </div>

                <?php
                $food_query = "SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic,f.price,r.res_description, f.rating, f.reviews from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and r.restaurant_id=$Restuarents2 and f.price<=$curr_price";
                //echo $food_query;
                $row_food_query = mysqli_query($link, $food_query);
                $card_orders = [];
                while ($rowfood = mysqli_fetch_array($row_food_query)) { ?>

                    <div class="col-md-6">
                        <div class="row home-cards" style="width:90%; margin: 1rem auto; background-color: white; padding: 1rem; border-radius: 12px;">
                            <div class="col-md-4 home-food-cover" style="background-image: url('<?php echo $rowfood[8] ?>'); border-radius: 12px"></div>
                            <div class="col-md-8">
                                
                                <a href="viewOrder.php?foodid=<?php echo $rowfood[0]; ?>">
                                    <h3><?php echo $rowfood[1];  ?></h3>
                                </a>
                                <h4><?php echo $rowfood[7]; ?></h4>
                                <h4 style="color: green; font-weight: 700;">Rs. <?php echo $rowfood[9]; ?></h4>
                                <!-- ratings  -->
                                <?php for($i = 0; $i < $rowfood[11]; $i++){ ?>
                                    <i class="fa fa-star" style="color: gold;"></i>
                                <?php } ?>
                                <?php echo '(' . $rowfood[12] . ')'; ?>
                                <form id="mainatt2" name="mainatt2" method="POST" action="addToCart.php">
                                    <input type="text" name="foodprice" value="<?php echo $rowfood[9]; ?>" style="display: none;"></input>
                                    <select class="btn btn-primary" id="fperson" name="fperson">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>

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
                    </div>


                <?php  }   ?>
            </div>


            <!-- PREDICTIVE MENU  -->
            <?php if (isset($_SESSION['name'])) {  ?>
                <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
                    <h3 class="jumbotron">Predictive Menu </h3>

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
                    $pm = "SELECT distinct (`food_menu_id`), COUNT(*) AS `count` FROM `order` WHERE `user_id`='" . $_SESSION['user_id'] . "' GROUP BY `food_menu_id` order by `count` desc limit 5
";
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

                        $food_query = "SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and f.food_menu_id=$rowpm[0]";
                        //echo $food_query;
                        $row_food_query = mysqli_query($link, $food_query);
                        while ($rowfood = mysqli_fetch_array($row_food_query)) {

                            $chance = 100 * $rowpm[1] / $pt;
                            //echo round($chance, 0)."%";
                            // echo "<h4>".$rowfood[1]." - Ordered ".$rowpm[1]." Time already & Now ". round($chance, 0)."% Chances</h4>";
                    ?>

                            <div class="col-md-4">
                                <h3><?php echo $rowfood[1];   ?></h3>
                                <form id="mainatt2" name="mainatt2" method="POST" action="order.php">
                                    Food for number of persons: <select class="btn btn-primary" id="fperson" name="fperson">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    <input type="hidden" id="food_name" name="food_name" value="<?php echo $rowfood[1]; ?>">
                                    <input type="hidden" id="food_id" name="food_id" value="<?php echo $rowfood[0]; ?>">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                    <input type="submit" name="submit" value="Place order" class="btn btn-primary" <?php if (!$_SESSION['user_id']) { ?>disabled title="please log in for order placement" <?php } ?>>
                                </form>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        Chef Name: <br>
                                        <h4><?php echo $rowfood[4]; ?>
                                    </div>
                                    <div class="col-md-4">Restaurant Name: <br>
                                        <h4><?php echo $rowfood[7]; ?></h4>
                                    </div>
                                    <div class="col-md-4"><img src="<?php echo $rowfood[8]; ?>" style="border-radius:10px;" height="165" width="167" /></div>
                                </div>
                            </div>

                    <?php  }
                    }  ?>
                </div>
            <?php  }   ?>
        </div>

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>