<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<style>
    .jumbotron {
    padding: 0.1em 0.2em;
    h3 {
        font-size: 2em;
    }
    p {
        font-size: 1.2em;
        .btn {
            padding: 0.5em;
        }
    }
</style>
</head>
<body>
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

$Restuarents="";
$Restuarents2="1";


if (isset($_POST['Restuarents'])) {
$Restuarents=$_POST['Restuarents'];
$Restuarents2=$Restuarents;
}

?>

<div id="jssor_1" style="position:relative;margin:0 auto;top:-20px;left:0px;width:980px;height:320px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:420px;overflow:hidden;">
            <div>
                <img data-u="image" src="img/011.jpg" />  <a class="navbar-brand" href="index.php" ><img align="left" src="img/msr.png" width="120" /></a>
            </div>
            <div>
                <img data-u="image" src="img/012.jpg" />  <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a>
            </div>
            <div>
                <img data-u="image" src="img/013.jpg" />  <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a>
            </div>
            <div>
                <img data-u="image" src="img/014.jpg" />  <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a>
            </div>
          
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
            </svg>
        </div>
</div>
<script type="text/javascript">jssor_1_slider_init();</script>
   
   
 
    
     <div class="container" style="background-color:#FDF5EC">
      <div class="row">
             </div>
             <input type="text" id="SearchTxt" /><input type="button" id="SearchBtn" value="Search" onclick="doSearch(document.getElementById('SearchTxt').value)" />
    <div style="font-size:20px">
        Search for Price
    </div>
    <script>
        function doSearch(text) {
            if (window.find(text)) {
                console.log(window.find(text));
            }
        }
    </script>


     <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
     <div class="col-md-12" > <h3>Pakistani Food</h3> <h4 align="right">Table Reservation <img src="images/table_reserve.png" align="right" style="margin-top:-40px; margin-left:10px"  width="90px"></h4> <hr  style="  color: black; border-width: 1px; border-style: solid;"></div>
      <form id="mainatt1" name="mainatt1" method="post" action="" onSubmit="return validate(this);" enctype="multipart/form-data">      
        <select id="Restuarents" name="Restuarents" class="btn btn-primary" onChange="this.form.submit()">
        <option value="0">Select Restaurant </option>
		<?php
        $q2="select res_name, restaurant_id from restaurant";
        $row2=mysqli_query($link,$q2);
        while ($result2=mysqli_fetch_array($row2)) {?>
        <option value="<?php echo $result2['restaurant_id'];?>"  <?php if($Restuarents2==$result2['restaurant_id']) echo "selected";?>><?php echo $result2['res_name'];?></option>
        <?php  }   ?>
        </select>
        </form> 
        
         
		 <?php
         $food_query="SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic,f.price,r.res_description from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and r.restaurant_id=$Restuarents2";
        //echo $food_query;
         $row_food_query=mysqli_query($link,$food_query);
         while ($rowfood=mysqli_fetch_array($row_food_query)) {?>
            
       <div class="col-md-4">
       <h3><?php echo $rowfood[1];  ?></h3>
       Price per unit: Rs. <?php echo $rowfood[9];?>
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
     <input type="hidden" id="user_id" name="user_id" value="<?php if(isset($_SESSION['user_id'])){ echo $_SESSION['user_id'];} ?>">
        <input type="submit" name="submit"  value="Place order" class="btn btn-primary" <?php if(isset($_SESSION['user_id'])){ echo "";}else {?>disabled  title="please log in for order placement" <?php }?> >
        </form> 
        </div>   
        <div class="col-md-8" >
             <div class="row">
             <div class="col-md-4" >
             Chef Name: <br>
             <h4><?php echo $rowfood[4];?>
             </div> 
             <div class="col-md-4">Restaurant Name: <br><h4><?php echo $rowfood[7];?></h4>Restaurant Speciality: <br><h4><?php echo $rowfood[10];?></h4></div>
             <div class="col-md-4"><img src="<?php echo $rowfood[8];?>" style="border-radius:10px;"  height="165" width="167"/></div></div></div> 
             <h1 ><?php //echo "hahhahhhahah".$order;   ?> </h1>
             <?php  }   ?>  </div> 
             
             <?php  if (isset($_SESSION['name'])) {  ?>
 <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
        <h3 class="jumbotron" >Predictive Menu  </h3> 
        
        <?php
		
/*		
Reference:
https://www.digitalvidya.com/blog/apriori-algorithms-in-data-mining/

Step 1
Create a frequency table of all the items that occur in all the transactions. Now, prune the frequency table to include only those items having total number of order. 
*/

        $row_pt=mysqli_query($link,"SELECT COUNT(*) AS `count` FROM `order` WHERE `user_id`='".$_SESSION['user_id']."'");
		while ($r=mysqli_fetch_array($row_pt)) {
		$pt=$r[0];
		 
/*		
Step 2
Create a data set having frequency distinct (unique) table of all the items order that occur in all the transactions. 
*/

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
		 
/*
Step 3
Obtaining probability of food to be order by considering all two previous steps.
Apply the same threshold support of 50% and consider the items that exceed 50% (in this case 3 and above).
*/	

         $food_query="SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and f.food_menu_id=$rowpm[0]";
        //echo $food_query;
         $row_food_query=mysqli_query($link,$food_query);
         while ($rowfood=mysqli_fetch_array($row_food_query)) {
		
		 $chance=100*$rowpm[1]/$pt;
		//echo round($chance, 0)."%";
		// echo "<h4>".$rowfood[1]." - Ordered ".$rowpm[1]." Time already & Now ". round($chance, 0)."% Chances</h4>";
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
        <?php  }   ?> 
       
        
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div></div>

<?php include 'footer.php';?>
</body>
</html>