<?php 
//no of foods
$fperson= $_REQUEST['fperson'];
$user_id= $_REQUEST['user_id'];
$order= $_POST['food_id'];
$food_name= $_REQUEST['food_name'];
$food_image = $_REQUEST['food_image'];
$food_price = $_REQUEST['foodprice'];
$food_quantity = $_REQUEST['fperson'];
$total_price = $fperson * $food_price;

$order_date = "5678";

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
$q2="INSERT INTO `msr`.`order` (`order_id`, `food_menu_id`, `food_quantity`, `user_id`, `rating_status`,`order_status`, `order_date`) VALUES (NULL ,'$order', '$food_quantity', '$user_id', 0, 'In Process', CURRENT_DATE())";

mysqli_query($link,$q) or die("could not insert into database");
mysqli_query($link,$q2) or die("could not insert into database");

// header("Location: http://localhost/jawadfyp/pages/index.php");
exit(header("Location: index.php"));
?>
