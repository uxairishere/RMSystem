<?php 
$user_id= $_REQUEST['user_id'];
$res_tid= $_REQUEST['res_tid'];
$res_time= $_POST['res_time'];
session_start(); 
include('include/connection.php');
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        header("Location: index.php");
    }
}
$_SESSION['timeout'] = time();
echo $chef_id."<br>";
//INSERT INTO `msr`.`res_table` (`res_id`, `res_tid`, `res_status`, `res_by_uid`, `res_time`, `timestmp`) VALUES (NULL, '$res_tid', '1', '$user_id', '$res_time', NOW());
$q="INSERT INTO `msr`.`res_table` (`res_id`, `res_tid`, `res_status`, `res_by_uid`, `res_time`, `timestmp`) VALUES (NULL, '$res_tid', '1', '$user_id', '$res_time', NOW())";
 
//$q2="UPDATE `chef` SET `chef_rating`=`chef_rating`+1,`vote`=`vote`+$rating WHERE `chef_id`=$chef_id";

$query=mysqli_query($link,$q) or die("could not insert into database");
//mysqli_query($link,$q2) or die("could not insert into database");
  echo $q;
 // echo $q2;

if($query == true)
		{
			echo "<script>alert('Reservation successful!')</script>";
 		}else
		{
				echo "<script>alert('Reservation Error!')</script>";
		} 
		//header("Location: index.php");
?>
<script>
window.location.href = "res_table.php";
 
</script>

