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
$q2="SELECT t.t_no, r.res_tid, r.res_status, r.res_by_uid, r.res_time, r.timestmp FROM table_t t, res_table r where t.t_no= r.res_tid and r.res_status=1 and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')>=DATE_FORMAT('2019:04:15 10:35:53','%Y:%m:%d %H:%i:%s') and r.res_by_uid= $uid order by r.timestmp desc";
$row_food_query=mysqli_query($link,$q2) or die("could not insert into database");
//mysqli_query($link,$q2) or die("could not perform action on database");
//echo $q2;
echo "<h2>Table Reservation History </h2>";
while ($rowfood=mysqli_fetch_array($row_food_query)) {
$count=$count+1;
echo "<hr /><h4> Reservation".$count.":<br> <br>".$rowfood[5]." ";
echo "Date and Time of Reservation:".$rowfood[4]."</h4>"; ?>
 
<div class="col-md-12" ><p><img align="left" src="images/table.jpg" width="320"  class="img-responsive" style="opacity: 0.7;
  filter: alpha(opacity=50)" /></p>
 
</div><?php
}
} 
   
 ?>
    </div></div>
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div></div>
<?php include 'footer.php';?>
</body>
</html>