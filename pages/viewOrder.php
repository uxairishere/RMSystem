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
include('include/header.php');

$food_id = $_GET['foodid'];

$query = "SELECT f.food_menu_id,f.food_menu_name, f.chef_id,f.restaurant_id, c.chef_name,c.chef_id,r.restaurant_id,r.res_name,f.pic,f.price,r.res_description, f.rating, f.reviews from food_menu f, chef c, restaurant r where f.chef_id=c.chef_id and r.restaurant_id=f.restaurant_id and food_menu_id=$food_id";
$row_food_query = mysqli_query($link, $query);

?>
<div style="padding: 12rem 0;">
    <?php while ($row = mysqli_fetch_array($row_food_query)) { ?>
        <div class="row container" style="width: 80%; margin: 0 auto;">
            <div class=" col-md-4 view-food-cover" style="background-image: url('<?php echo $row[8] ?>');">
                
            </div>
            <div class="col-md-8 ">
                <h1><?php echo $row[1] ?></h1>
                <h3><?php echo $row[7] ?></h3>
                <h4><?php echo $row[10] ?></h4>
                <h4>Rating: <span class="text-success"><?php echo $row[11] ?></span> <i class="fa fa-star" style="color: gold;"></i> <?php echo '(' . $row[12] . ')'; ?></h4>
                <h4>Chef: <?php echo $row[4] ?></h4>
                <h4>Rs. <span class="text-success"><?php echo $row[9] ?></span></h4>
            <!-- stars start  -->
            <form method="POST" action="ratingtest.php">
                <span class="star-rating star-5">
                    <input type="radio" name="rating" value="1"><i></i>
                    <input type="radio" name="rating" value="2"><i></i>
                    <input type="radio" name="rating" value="3"><i></i>
                    <input type="radio" name="rating" value="4"><i></i>
                    <input type="radio" name="rating" value="5"><i></i>
                    <input type="hidden" name="pre_rating" value="<?php echo $row[11]; ?>">
                    <input type="hidden" name="reviews" value="<?php echo $row[12]; ?>">
                    <input type="hidden" name="food_id" value="<?php echo $row[0]; ?>">
                </span>
                <br/>
                <input class="btn btn-warning" style="margin-top: 2rem;" type="submit" name="submit_rating" value="Submit Rating" />
            </form>
            <!-- stars end  -->
            </div>

        </div>
    <?php } ?>
</div>
<?php include('footer.php'); ?>