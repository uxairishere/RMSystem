<?php 
$fperson= $_REQUEST['fperson'];
$user_id= $_REQUEST['user_id'];
$order= $_POST['food_id'];
$food_name= $_REQUEST['food_name'];

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

$q2="select f.food_menu_id,f.food_menu_name,f.chef_id,f.restaurant_id,c.chef_id,c.Chef_name,c.Chef_desc,r.restaurant_id,r.res_name,f.pic,f.price from food_menu f,chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and f.food_menu_id=$order";

$row_food_query=mysqli_query($link,$q2) or die("could not perform action on database");
//echo $q2;
while ($rowfood=mysqli_fetch_array($row_food_query)) {
echo "<h2>You Successfully placed order </h2><h3> ".$rowfood[1]." </h3>";
echo "<p>Total unit : ";
echo $fperson. " <br>";
echo "<p>Price per unit: Rs ". $rowfood[10];
echo "<p><b>Total amount: Rs ".$fperson*$rowfood[10];

?>
<form id="mainatt2" name="mainatt2" method="POST" action="order2.php">
  
        <input type="hidden" id="fperson" name="fperson" value="<?php echo $fperson; ?>">
        <input type="hidden" id="food_id" name="food_id" value="<?php echo $order; ?>">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" id="chef_id" name="chef_id" value="<?php echo $chef_id; ?>">
        
      
      <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
        <input type="submit" name="submit" id="brating"  value="Confirm Order" class="btn btn-primary">
        </form>
<?php
echo "</p></b><h3>Cooked by ".$rowfood[5]. " </h2>".$rowfood[5]. " is famous for <b>'".$rowfood[6]."'</b> in restaurant  <b>  '".$rowfood[8]."'";
$chef_id=$rowfood[4];
?><img src="<?php echo $rowfood[9];?>" align="left" style="margin-right:49px;"  height="165" width="167"/><?php
}
?>
    <form id="mainatt2" name="mainatt2" method="POST" action="order1.php">
  
        <input type="hidden" id="fperson" name="fperson" value="<?php echo $fperson; ?>">
        <input type="hidden" id="food_id" name="food_id" value="<?php echo $order; ?>">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="hidden" id="chef_id" name="chef_id" value="<?php echo $chef_id; ?>">
        
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
  else {
  echo "please login to procced";
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