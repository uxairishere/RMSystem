<?php 
session_start(); 
include('header.php');
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        header("Location: index.php");
    }
}
$_SESSION['timeout'] = time();   
?>
<div class="container">
   <div class="row">
   <div class="panel-body">  
<?php 
if (isset($_SESSION['user_id'])) {
include('include/connection.php');
$uid=$_SESSION['user_id'];
$count=0;
$q2="SELECT `order`.`order_id`, `order`.`user_id`, `order`.`food_quantity`,`order`.`order_date`, `order`.`order_status`,`food_menu`.`food_menu_id`,`food_menu`.`food_menu_name`,`order`.`rating_status`,`food_menu`.`chef_id` FROM `order`,`food_menu` WHERE `order`.`food_menu_id`=`food_menu`.`food_menu_id` and `user_id`= $uid order by `order`.`order_date` desc";
$row_food_query=mysqli_query($link,$q2) or die("could not insert into database");
//mysqli_query($link,$q2) or die("could not perform action on database");
//echo $q2;
echo "<h2>Order History</h2>";
while ($rowfood=mysqli_fetch_array($row_food_query)) {
$count=$count+1;
echo "<hr /><h4> Ordere".$count.":<br> <br>".$rowfood[6]." ";
echo " for ".$rowfood[2]. " person dated: ".$rowfood[3]." status: ".$rowfood[4]."</h4>";
//echo $rowfood[7];
if($rowfood[7]==0){

?>

<form id="mainatt2" name="mainatt2" method="POST" action="order_rating.php">
  
         
        <input type="hidden" id="food_id" name="food_id" value="<?php echo $rowfood[0]; ?>">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" id="chef_id" name="chef_id" value="<?php echo $rowfood[8]; ?>">
        
       <h4>Please rate the chef (Optional):</h4>
        <select class="btn btn-primary" id="rating" name="rating">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          
        </select>
      
        <input type="submit" name="submit" id="brating"  value="Rate the Chef" class="btn btn-primary">
        </form>


<?php
}
else echo " ";
}


 } 
   
 ?>
    </div></div></div>
    <div class="container">
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div></div>
<?php include 'footer.php';?>
</body>
</html>