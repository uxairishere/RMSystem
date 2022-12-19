<?php 
//no of foods
$fperson= $_REQUEST['fperson'];
$user_id= $_REQUEST['user_id'];
$order= $_POST['food_id'];
$food_name= $_REQUEST['food_name'];
$food_image = $_REQUEST['food_image'];
$food_price = $_REQUEST['foodprice'];
$total_price = $fperson * $food_price;

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

// add into table 
$q="INSERT INTO usercart (product, email, price, quantity, foodimage) VALUES ('$food_name', '$user_id', '$total_price', '$fperson', '$food_image')";
mysqli_query($link,$q) or die("could not insert into database");
// header("Location: http://localhost/jawadfyp/pages/index.php");
exit(header("Location: index.php"));
?>
