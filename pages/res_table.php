<?php 
session_start(); 
include('header.php');
$inactive = 360; // Set timeout period in seconds
if(isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
       //header("Location: index.php");
    }
}
$_SESSION['timeout'] = time();   
if ($_SESSION['name']=="") {
?>
<script>
window.location.href = "index.php";
</script>
<style>
.img-fluid {
  max-width: 100%;
  height: auto;
  display: block;
}

</style>
<?php
} 
?>
<div class="container">
 
<?php 
include('include/connection.php');
date_default_timezone_set('Asia/Karachi'); 
$tdate = date("Y:m:d H:i:s"); 
$tdate2 = date("Y:m:d"); 
$uid=$_SESSION['user_id'];



//$q="INSERT INTO `pssr`.`res_table` (`res_id`, `res_tid`, `res_status`, `res_by_uid`, `res_time`, `timestmp`) VALUES (NULL, '$res_tid', '1', '$uid', '$res_time', NOW());";
//SELECT t.t_no, r.res_tid, r.res_status, r.res_by_uid, r.res_time, r.timestmp FROM table_t t, res_table r where t.t_no= r.res_tid and r.res_by_uid=11
//DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')<=DATE_FORMAT('$tdate','%Y:%m:%d %H:%i:%s')
//and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')<=DATE_FORMAT('NOW()','%Y:%m:%d %H:%i:%s') 

$count=0;
$q2="SELECT t.t_no, r.res_tid, r.res_status, r.res_by_uid, r.res_time, r.timestmp FROM table_t t, res_table r where t.t_no= r.res_tid and r.res_status=1 and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')>=DATE_FORMAT('$tdate','%Y:%m:%d %H:%i:%s')  ";
 
//fit hay SELECT t.t_no, r.res_tid, r.res_status, r.res_by_uid, r.res_time, r.timestmp FROM table_t t, res_table r where t.t_no= r.res_tid and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')>=DATE_FORMAT('2019:04:14 19:40:26','%Y:%m:%d %H:%i:%s')

$row_food_query=mysqli_query($link,$q2) or die("could not query database");
//mysqli_query($link,$q2) or die("could not perform action on database");
//echo $q2;
echo "<h2>Table Reservation</h2>";
while ($rowfood=mysqli_fetch_array($row_food_query)) {
$count=$count+1; ?>
<div class="row">
<div class="col-md-6" ><p><img align="left" src="images/table.jpg" width="220"  class="img-responsive" style="opacity: 0.7;
  filter: alpha(opacity=50)" /></p>
<?php echo "<hr /><tr><td> Table";
echo  " reserved on dated: ".$rowfood[4]."<br> status: Reserved </td></tr></div></div>";
}
?>
 <div class="row"><div class="col-md-12" ><hr></div></div>
 <div class="row"><div class="col-md-12" >
<form id="mainatt2" name="mainatt2" method="POST" action="res_t_action.php">
<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
 
        <h3>Please select table from available table list:</h3></div></div><div class="row">
        <select class="btn btn-primary" id="res_tid" name="res_tid" required>
		 <?php
            $q3="SELECT `t_no`,`t_desc` FROM `table_t` where `t_no` not in (SELECT t.t_no FROM table_t t, res_table r where t.t_no= r.res_tid and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')>=DATE_FORMAT('$tdate','%Y:%m:%d %H:%i:%s'))";
             $row3=mysqli_query($link,$q3);
			
             while ($result3=mysqli_fetch_array($row3)) {?>
             <div class="col-md-3" ><p><img align="left" src="images/table.jpg" class="img-fluid"/></p>
<?php echo "<hr /><tr><td> Table".$result3[1]." ";
echo  "Available: ".$result3[0]."<br> Status:Not Reserved </td></tr></div>";
  

?>

            <option value="<?php echo $result3[0];?>"><?php echo $result3[1];?></option>
             <?php  }  ?>
             </select>
        <input type="datetime-local" class="textbox" id="res_time" name="res_time" required/>
        <input type="submit" name="submit" id="Reserv"  value="Reserv This Table" class="btn btn-primary" <?php if(!$_SESSION['user_id']){?>disabled  title="please log in to Reserv This Table"<?php }// echo "<h1>".$q3;?>>
</form>
</div> 
<?php
 
$ro=mysqli_query($link,$q3) or die("could not query database");
//mysqli_query($link,$q2) or die("could not perform action on database");
//echo $q2;
//echo $q3; 
echo "<h4>Table Available for Reservation</h4>";
while ($rof=mysqli_fetch_array($ro)) {
  ?>
<div class="row">
<div class="col-md-3" ><p><img align="left" src="images/make-a-reservation-on.jpg" width="220"  class="img-fluid" style="opacity: 0.7;
  filter: alpha(opacity=50)" /></p>
<?php echo "<hr /><tr><td> Table".$rof[0]." </td></tr>";
 
?>
</div></div>
<?php
 
}
?> 
</div> 
<div class="container">
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div></div>
<?php include 'footer.php';?>
</body>
</html>