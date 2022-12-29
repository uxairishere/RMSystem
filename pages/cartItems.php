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

// getting the card items 
if (isset($_SESSION['user_id'])) {
    include('include/connection.php');
    $user_id = $_SESSION['user_id'];
    $q2 = "SELECT * from usercart WHERE email=$user_id";
    $result = mysqli_query($link, $q2) or die("could not perform action on database");

    // globals 
    $grand_total = 0;
    $foods_desc = 'Order: ';
?>


    <body style="background-color: #F5F7FA;">
        <div class="cart-conatiner" style="width: 90%; margin: 0 auto;">
            <h1 class="text-center">Your Cart Items</h1>
            <!-- cards  -->
            <div class="card-container row" style="padding: 5rem 0;">
                <?php while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                    <div class="card-body col-md-4" style="margin: 0 0 2rem 0;;">
                        <!-- container  -->
                        <div class="row" style="background-color: white; width: 90%; margin: 0 auto; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; height: 20rem; border-radius: 12px;">
                            <!-- wrapper  -->
                            <div class="col-md-8">
                                <h1><?php echo $row['product'] ?></h1>
                                <p>Total items: <?php echo $row['quantity'] ?></p>
                                <p>Rs. <?php echo $row['price'] ?></p>
                            </div>
                            <div class="col-md-4">
                                <img style="width: 100%; margin: 2rem 0 0 0; border-radius: 12px" src="<?php echo $row['foodimage'] ?>" />
                                <form action="cartItemDel.php" class="text-right">
                                    <input type="hidden" id="food_id" name="food_id" value="<?php echo $row['id']; ?>">
                                    <button class="btn btn-danger" style="width: 100%; margin: 1rem 0 0 0">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                    $grand_total += $row['price'];
                    $curr_desc = $row['quantity'] . " " . $row['product'] . " , ";
                    $foods_desc = $foods_desc . " " . $curr_desc;
                } ?>
            </div>

            <!-- confirm order  -->
            <div class="cart-confirm-container text-center  " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; padding: 2rem 0; margin: 1rem auto 4rem auto; border-radius: 12px; background-color: white;">
                <h2 style="font-weight: 700;">Our Rider is ready! Please confirm your order</h2>
                <h2>Your Grand Total: <span style="color: green"><?php echo $grand_total; ?> Rupees</span></h2>
                <form action="orderCart.php" method="POST">
                    <input type="hidden" id="food_desc" name="food_desc" value="<?php echo $foods_desc; ?>">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" id="grand_total" name="grand_total" value="<?php echo $grand_total; ?>">
                    <button type="submit" class="btn btn-success" style="padding: 0.5rem 4rem;">Confirm order</button>
                </form>
            </div>

            <!-- ongoing orders  -->
            <?php

            $q3 = "SELECT * from usercartorder WHERE user_id=$user_id AND order_status='In Process!'";
            $result_ongoing = mysqli_query($link, $q3) or die("could not perform action on database");

            ?>
            <div class="cart-ending text-center" style="padding: 2rem 0;">
                <h2>Your ongoing orders</h2>
                <?php while ($row = mysqli_fetch_array($result_ongoing, MYSQLI_ASSOC)) { ?>
                <div class="cart-ongoing" style="background-color: white; padding: 2rem 0; border-radius: 12px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; margin: 0 0 3rem 0;">
                <h3>Your <?php echo $row['orderdesc'] ?></h3>
                <h3>Amount: <?php echo $row['price'] ?> Rupees</h3>
                <h3 style="color: green;">Status: <?php echo $row['order_status'] ?></h3>
                <a href="./cancelOrder.php?id=<?php echo $row['id'];  ?>" class="btn grad-btn-danger" style="width: 20%; margin: 0 auto;">Cancel order</a>
                </div>
                <?php } ?>

            </div>

        </div>
    </body>
<?php
}
include('footer.php');
?>