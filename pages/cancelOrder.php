<?php

session_start(); 
// include('header.php');
include('include/connection.php');
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        header("Location: index.php");
    }
}
$_SESSION['timeout'] = time(); 

$order_id = $_GET['id'];

$q = "UPDATE usercartorder
SET order_status = 'Cancelled'
WHERE id = $order_id";

$row_food_query = mysqli_query($link, $q) or die("could not perform action on database");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Canceled</title>
</head>
<?php include('header.php'); ?>
<body>
    <div class="text-center">
        <div class="row" style="width: 80%; margin: 15rem auto 10rem auto;">
            <div class="col-md-5">
                <img src="images/cancel.jpg" width="400" />
            </div>
            <div class="col-md-7 text-center">
                <h1 style="padding-top: 10rem; width: 80%; margin: 0 auto; font-weight: 700;" class="text-success">Your order has been Canceled successfully!</h1>
                <a class="btn grad-btn-4" href="/rms">Find more food</a>
            </div>
        </div>
    </div>
</body>
<?php include('footer.php'); ?>


</html>