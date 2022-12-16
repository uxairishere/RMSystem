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
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
    }
}
$_SESSION['timeout'] = time();   
 
 
include('include/connection.php');
 
 
 
?>
 
   
 
   
 
    
     <div class="container" style="background-color:#FDF5EC">
     
     <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
     
     
     <h1 > All Restuarent</h1>
     
                       
                        
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <tr>
                                <th>Sr.</th>
                                <th>Restuarent Name</th>
                                <th>Restuarent Description</th>
                               
                                </tr>
                                <?php 
     
$a=1;
$q2="SELECT * FROM `restaurant` ORDER BY `restaurant`.`restaurant_id` DESC";

$row_food_query=mysqli_query($link,$q2) or die("could not perform action on database");
//echo $q2;
while ($rowfood=mysqli_fetch_array($row_food_query)) {
 ?>
                                <tr>
                                <td><?php echo $a;?></td>
                                <td><?php echo $rowfood[1];?></td>
                                <td><?php echo $rowfood[2];?></td>
                                
                                </tr>
                                <?php $a=$a+1;
}?>
                          </table>  
        </div>   
         
 
        
 
 
        
        
        
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div>

</div>
<?php include 'footer.php';?>

</body>
</html>