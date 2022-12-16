<?php 

$user_id= $_REQUEST['user_id'];
$chef_id= $_REQUEST['chef_id'];
$order= $_POST['food_id'];
$rating=$_REQUEST['rating'];
session_start(); 
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
 
 
$q="UPDATE `order` SET `rating_status` = '1' WHERE `order_id` = $order";
//INSERT INTO `msr`.`order` (`order_id`, `food_menu_id`, `food_quantity`, `user_id`, `order_date`) VALUES (NULL, '1', '2', '7', CURRENT_DATE());
$q2="UPDATE `chef` SET `chef_rating`=`chef_rating`+1,`vote`=`vote`+$rating WHERE `chef_id`=$chef_id";

mysqli_query($link,$q) or die("could not insert into database");
mysqli_query($link,$q2) or die("could not insert into database");
 // echo $q;
 // echo $q2;

header("Location: orderhistory.php");
    ?>
	</div></div></div>
    <div class="container">
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div></div>
<?php include 'footer.php';?>
</body>
</html>