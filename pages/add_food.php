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
include('header_admin.php');
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
    }
}
$_SESSION['timeout'] = time();   
include('include/header.php');
 

 
if ((isset($_POST['Restuarent'])) && (isset($_POST['Foodtname']))) {
$Chef=$_POST['Chef'];

 $q="INSERT INTO `msr`.`food_menu` (`food_menu_id`, `food_menu_name`, `chef_id`, `restaurant_id`, `food_type`, `pic`) VALUES (NULL, '".$_POST['Foodtname']."', '".$_POST['Chef']."', '".$_POST['Restuarent']."', 'a', '');";
 
 
 mysqli_query($link,$q) or die("could not insert into database");
?>
<script type="text/javascript">
window.location.href = 'all_restuarent.php';
</script>
<?php
 }
?>
<div class="container" style="background-color:#FDF5EC">
     
     <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
     
     
     <h1 > Add Food Menu </h1>
      <form id="mainatt1" name="mainatt1" method="post" action="">
                       
                        
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <tr>
                                <td>Food Menu Name </td>
                                	<td><input type="text" class="textbox" id="Foodtname" name="Foodtname" placeholder="Food Menu Name"   required />
            					</td>  
                                </tr>
                               <tr><td>Select Chef</td><td> <select id="Chef" name="Chef" style="width:300px;" class="btn btn-primary">
							   <?php
                                                    
                                    $q2="SELECT * FROM `chef`";
                                    $row=mysqli_query($link,$q2);
                                    
                                    while ($result=mysqli_fetch_array($row)) {?>
    
                             <option value="<?php echo $result[0];?>"><?php echo $result[1];?></option>
                              <?php  }  ?>
                            </select></td></tr>
                        
                                  <tr><td>Select Restuarent</td><td> <select id="Restuarent" name="Restuarent" style="width:300px;" class="btn btn-primary">
							   <?php
                                                    
                                    $q3="SELECT * FROM `restaurant` ORDER BY `restaurant`.`restaurant_id` ASC";
                                    $row3=mysqli_query($link,$q3);
                                    
                                    while ($result3=mysqli_fetch_array($row3)) {?>
    
                             <option value="<?php echo $result3[0];?>"><?php echo $result3[1];?></option>
                              <?php  }  ?>
                            </select></td></tr>
                               
                                
                                <tr>
                                <td></td>
                                	
                                    <td><input  type="reset" id="reset" title="reset" value="reset" class="btn btn-primary"> &nbsp;<input  type="submit" id="submit" title="Register New Food" value="Register New Food" class="btn btn-primary" ></td>
                                </tr>
                                
                          </table> </form> 
        </div>   
         
 
        
 
 
        
        
        
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div>

</div>
<?php include 'footer.php';?>
</body>
</html>