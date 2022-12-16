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
if (!$_SESSION['user_id']==11) {
header("location:index.php");
} 
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
 

 
if ((isset($_POST['Chefname'])) && (isset($_POST['ChefDesc']))) {
 $q="INSERT INTO `msr`.`chef` (`chef_id`, `chef_name`, `chef_rating`, `chef_desc`, `vote`) VALUES (NULL, '".$_POST['Chefname']."', '0', '".$_POST['ChefDesc']."', '0');";
 mysqli_query($link,$q) or die("could not insert into database");
?>
<script type="text/javascript">
window.location.href = 'all_chef.php';
</script>
<?php
 }
?>
<div class="container">
 <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
        <h3 class="jumbotron" >Predictive Menu <img src="images/predic.png" align="right" style="margin-top:-20px;"  width="70px"></h3> 
        <?php
        $row_pt=mysqli_query($link,"SELECT COUNT(*) AS `count` FROM `order` WHERE `user_id`='".$_SESSION['user_id']."'");
		while ($r=mysqli_fetch_array($row_pt)) {
		$pt=$r[0];
		 
		//echo $pt;
		}
		$pm="SELECT distinct (`food_menu_id`), COUNT(*) AS `count` FROM `order` WHERE `user_id`='".$_SESSION['user_id']."' GROUP BY `food_menu_id` order by `count` desc limit 5
";
		$p=1;
		$row_pm=mysqli_query($link,$pm);
         while ($rowpm=mysqli_fetch_array($row_pm)) {
		$pmv1[$p]=$rowpm[0];
		$pmv2[$p]=$rowpm[1];
		//echo $pmv1[$p]."------";
		//echo $pmv2[$p]."<br>";
		
		 $p=$p+1;
		 
		
         $food_query="SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and f.food_menu_id=$rowpm[0]";
        //echo $food_query;
         $row_food_query=mysqli_query($link,$food_query);
         while ($rowfood=mysqli_fetch_array($row_food_query)) {
		
		 $chance=100*$rowpm[1]/$pt;
		  //echo round($chance, 0)."%";
		 echo "<h4>".$rowfood[1]." - Ordered ".$rowpm[1]." Time already & Now ". round($chance, 0)."% Chances</h4>";
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
        <input type="submit" name="submit"  value="Place order" class="btn btn-primary" <?php if(!$_SESSION['user_id']){?>disabled  title="please log in for order placement" <?php 
		
		}?> >
        </form> 
        </div>   
        <div class="col-md-8" >
             <div class="row">
             <div class="col-md-4" >
             Chef Name: <br>
             <h4><?php echo $rowfood[4];?>
             </div> 
             <div class="col-md-4">Restaurant Name: <br><h4><?php echo $rowfood[7];?></h4></div>
             <div class="col-md-4"><img src="<?php echo $rowfood[8];?>" style="border-radius:10px;"  height="165" width="167"/></div>
             </div></div> 
 
             <?php  } }  ?>  </div>    
        
        
        
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div></div>
<?php include 'footer.php';?>
</body>
</html>