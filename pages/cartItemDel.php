delete item in cart
<?php 

$food_id = $_REQUEST['food_id'];

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
$q="DELETE FROM usercart WHERE id=$food_id";
mysqli_query($link,$q) or die("could not insert into database");
// header("Location: http://localhost/jawadfyp/pages/index.php");
exit(header("Location: cartItems.php"));
?>
