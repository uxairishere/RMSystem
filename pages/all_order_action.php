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
//include('header.php');
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
    }
}
$_SESSION['timeout'] = time();   
 
include('include/connection.php');
 $id = $_GET['id'];
$q2="UPDATE `usercartorder` SET `order_status`='Delevered' WHERE `usercartorder`.`id`='".$_GET['id']."'";

$row_food_query=mysqli_query($link,$q2) or die("could not perform action on database");
 echo $q2;
 
 header("Location: all_order.php");
 ?>
 
        