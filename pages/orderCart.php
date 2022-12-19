<?php
$food_desc = $_REQUEST['food_desc'];
$user_id = $_REQUEST['user_id'];
$price = $_REQUEST['grand_total'];

session_start();
include('header.php');
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

$q = "INSERT INTO usercartorder (price, user_id, orderdesc) VALUES ('$price', '$user_id', '$food_desc')";

mysqli_query($link, $q) or die("could not insert into database");
?>

<body>
    <div class="text-center">
        <h1>Your order has been places successfully</h1>
    </div>
</body>
<?php include('footer.php'); ?>

</html>