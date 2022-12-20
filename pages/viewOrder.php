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

$query = "SELECT * from food_menu where food_menu_id='$food_id'";
$row_food_query = mysqli_query($link, $query);

?>
<div style="padding: 10rem 0;">
    <?php while ($row = mysqli_fetch_array($row_food_query, MYSQLI_ASSOC)){ ?>
        <div class=" container">
            <div class="view-food-cover" style="background-image: url('<?php echo $row['pic'] ?>');">
                <!-- <img src="<?php echo $row['pic'] ?>" width="100%" height="100rem"/> -->
            </div>
            <div class="text-center">
                <h1><?php echo $row['food_menu_name'] ?></h1>
            </div>
        </div>
    <?php } ?>
</div>