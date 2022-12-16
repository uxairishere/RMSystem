<?php
 
 $dbhost = "localhost";
	 $dbuser = "root";
	 $dbpass = "";
	 $dbname = "msr";
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysql_select_db($dbname);
	$loc = $_POST['loc']; 
 
$row=mysql_query("select count(*) as email from proj_user where email='".$email."'");
 
while($result=mysql_fetch_array($row)){
 echo $result[0];}

 
?>