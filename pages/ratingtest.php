<?php 
include('include/connection.php');
if(isset($_POST['submit_rating'])){
    $pre_rating = $_POST['pre_rating'];;
    $curr_rating = $_POST['rating'];
    $foodid = $_POST['food_id'];
    $reviews = $_POST['reviews'];

    $up_rating = ((int)$pre_rating + (int)$curr_rating) / 2;
    
    $rate_query = "UPDATE food_menu
    SET rating = '$up_rating' WHERE food_menu_id='$foodid'";

    $rate_query2 = "UPDATE food_menu
    SET reviews = reviews + 1 WHERE food_menu_id='$foodid'";

    $success = mysqli_query($link, $rate_query);
    $success2 = mysqli_query($link, $rate_query2);

    echo 'current rating '.$curr_rating;
    echo 'previous rating '. $pre_rating;

    echo 'UPDATED rating '. $up_rating;

    echo 'RATED SUCCESSFULLY';
}?>