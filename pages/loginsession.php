<?php 
	//session_start();
    
 	$email=$_POST['email'];
	$pwd=$_POST['user_pwd'];

include('include/connection.php');
$row=mysqli_query($link,"SELECT * FROM proj_user WHERE email='$email' and user_pwd='$pwd' ");
$result=mysqli_fetch_array($row);
session_start();

{
if($result>0)
{

$_SESSION['user_id']=$result[0];
$_SESSION['name']=$result[1];
$_SESSION['proj_id']=$result[5];
$_SESSION['role']=$result[3];
$_SESSION['image']=$result['image'];

if($result[0]==11){header("Location:all_order.php");}else
header("Location:index.php");
}
else {
 ?><head>
<link rel="icon" type="image/png" href="images/favicon.png">
</head>

 <link href="CSS/Survey.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style11 {color: #FF0000}
-->
</style>
<body style="background-image:url(images/bg.jpg);  background-repeat: no-repeat; background-position: 0 0;    background-size: cover;">
<div align="center">
 <div align="center"><img  src="img/msr.png"  width="300"  /></div>
 <h2 align="center" class="style3">MSR</h2>
 <div align="center" class="style10 style11"><strong>Warning</strong></div>

<div align="center" class="style10 style11"><strong>
<?php 
echo "</br>Invalid User Name and Password";
?>
<?php echo "</br></br><a "."class="."'"."style9"."'"."href=\"javascript:history.go(-1)\">Go Back</a>"; ?>
</strong></div>
</div>
<?php
}}
 
?>
</body>