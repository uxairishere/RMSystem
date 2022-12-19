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
<div class="container" style="background-color:#FDF5EC">
     
     <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
     
     
     <h1 > Add Chef</h1>
      <form id="mainatt1" name="mainatt1" method="post" action="">
                       
                        
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                <tr>
                                <td>Chef Name</td>
                                	<td><input type="text" class="textbox" id="Chefname" name="Chefname" placeholder="Chefname"  required />
            </td>
                                  
                                </tr>
                                 <tr>
                                <td>Chef Description</td>
                                	<td><input type="text" class="textbox" id="ChefDesc" name="ChefDesc" placeholder="ChefDesc"  required />
            </td>
                                  
                                </tr>
                               
                                
                                <tr>
                                <td></td>
                                	
                                    <td><input  type="reset" id="reset" title="reset" value="reset" class="btn btn-primary"> &nbsp;<input  type="submit" id="submit" title="Register New Chef" value="Register New Chef" class="btn btn-primary" ></td>
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