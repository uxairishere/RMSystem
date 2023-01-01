<?php
// require('connection.php');
require('../config.php');
// \Stripe\Stripe::setVerifySslCerts(false);
$token = $_POST['stripeToken'];
$amount = $_POST['grand_total'];
$user_id = $_POST['user_id'];
$desc = $_POST['food_desc'];
$data = \Stripe\Charge::create(array(
    "amount" => $amount,
    "currency" => "usd",
    "description" => $desc,
    "source" => $token,
));

// after payment success 
require('include/connection.php');
$q = "INSERT INTO usercartorder (price, user_id, orderdesc, payment) VALUES ('$amount', '$user_id', '$desc', 'Paid!')";
mysqli_query($link, $q) or die("could not insert into database");
include('header.php');
?>
<div class="pay-container row" style="width: 80%; margin: 0 auto; padding:7rem 0;">
    <div class="col-md-4">
        <img src="images/cart.png" width="80%" />
    </div>
    <div class="col-md-8 text-center">
        <h1 style="margin-top: 15rem;">Payment Successfull</h1>
        <p>Your payments are secure powered by stripe and we will not share your information with anyone.</p>
        <a class="btn btn-warning" href="index.php">Shop more</a>
    </div>
</div>
<?php include('footer.php'); ?>
