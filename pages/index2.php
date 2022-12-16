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

  include('header.php');
  
  $inactive = 20; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        //header("Location: index.php");
    }
}
$_SESSION['timeout'] = time();   
?>
 <?php include('include/header.php');?>


<?php

$loc=" ";
$loc1=" ";
$loc2="1";
$Restuarents=" ";
$Restuarents2="1";
$loc=$_POST['loc'];
if (isset($_POST['loc'])) {
 
$loc1=$loc;
$Restuarents2="";
}
$Restuarents=$_POST['Restuarents'];
if (isset($_POST['Restuarents'])) {
$Restuarents2=$Restuarents;
}


$food_menu=" ";
$food_menu2=" ";
if(isset($_POST['food_menu']))
{
$food_menu2=$_POST['food_menu'];
}

 
?>

 <div id="jssor_1" style="position:relative;margin:0 auto;top:-20px;left:0px;width:980px;height:420px;overflow:hidden;visibility:hidden;">
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
            <div>
                <img data-u="image" src="img/015.jpg" />  <a class="navbar-brand" href="index.php" ><img align="left" src="img/msr.png" width="120" /></a>
            </div>
            <div>
                <img data-u="image" src="img/016.jpeg" />  <a class="navbar-brand" href="index.php"><img align="left" src="img/msr.png" width="120" /></a>
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
   <div class="container">
   <h1 class="jumbotron">Pakistani Food</h1>
   <div class="row">
   <div class="panel-body">
                        
<form id="mainatt1" name="mainatt1" method="post" action="" onSubmit="return validate(this);" enctype="multipart/form-data">
<select id="loc" name="loc" class="btn btn-primary" onChange="this.form.submit()">
<option value="">Select Location</option>
		<?php
        $q="select distinct(city_name), city_id from location ORDER BY `city_id` ASC";
        $row=mysql_query($q);
        while ($result=mysql_fetch_array($row)) {?>
        <option value="<?php echo $result['city_id'];?>"  <?php if($loc1==$result['city_id']) echo "selected";?>><?php echo $result['city_name'];?></option>
        <?php  }  ?>
</select> 
      
<select id="Restuarents" name="Restuarents" class="btn btn-primary" onChange="this.form.submit()">
<option value="">Select Restuarents</option>
		<?php
        $q2="select res_name, restaurant_id from restaurant where city_id=$loc";
        $row2=mysql_query($q2);
        while ($result2=mysql_fetch_array($row2)) {?>
        <option value="<?php echo $result2['restaurant_id'];?>"  <?php if($Restuarents2==$result2['restaurant_id']) echo "selected";?>><?php echo $result2['res_name'];?></option>
        <?php  }   ?>
</select>
      
<select id="food_menu" name="food_menu" class="btn btn-primary" onChange="this.form.submit()">
     <option value="">Select Food</option>
		<?php
        $qfood_menu_name_="select food_menu_name, food_menu_id,chef_id from food_menu where restaurant_id=$Restuarents";
        $rowfood_menu_name_=mysql_query($qfood_menu_name_);
        while ($rowfood=mysql_fetch_array($rowfood_menu_name_)) {?>
<option value="<?php echo $rowfood['food_menu_id'];?>"<?php if($food_menu2==$rowfood['food_menu_id']) echo "selected";?>><?php echo $rowfood['food_menu_name'];?></option>
      <?php  }   ?>
</select>
<!--<button type="submit" class="btn btn-primary">Show Restuarents</button> -->
</form> 
 
</div></div></div>
             <div class="container" style="background-color:#FDF5EC">
             <div class="row">
             <?php
			 $food_query="SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and r.restaurant_id=$Restuarents2";
			 //echo $food_query;
			 $row_food_query=mysql_query($food_query);
			 while ($rowfood=mysql_fetch_array($row_food_query)) {?>
             
             <div class="col-md-4">
               <h3><?php echo $rowfood[1];?></h3>
             </div>   
             <div class="col-md-8" style=" padding: 1rem;
                          color: black;
                          border-width: 3px;
                          border-style: solid;
                          border-image: 
                            linear-gradient(
                              to bottom, 
                              red, 
                              rgba(0, 0, 0, 0)
                            ) 1 100%;">
             <div class="row">
             <div class="col-md-4" >
             Chef Name: <br>
             <h4><?php echo $rowfood[4];?></h4></div> 
             <div class="col-md-4">Restuarent Name: <br><h4><?php echo $rowfood[7];?></h4></div>
             <div class="col-md-4"><img src="<?php echo $rowfood[8];?>"  height="165" width="167"/></div></div></div>
               <?php  }   ?> <?php  //echo $food_menu2;   ?></div></div>
                 
    
<div class="container">
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4></div></div>
 
<?php include 'footer.php';?>
</body>
</html>