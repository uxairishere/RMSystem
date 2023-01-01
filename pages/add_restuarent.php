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
    if (!$_SESSION['user_id'] == 11) {
        header("location:index.php");
    }
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



    if ((isset($_POST['Restuarentname'])) && (isset($_POST['RestuarentDesc']))) {


        $q = "INSERT INTO `msr`.`restaurant` (`restaurant_id`, `res_name`, `res_description`, `city_id`) VALUES (NULL, '" . $_POST['Restuarentname'] . "', '" . $_POST['RestuarentDesc'] . "', '1');";
        mysqli_query($link, $q) or die("could not insert into database");
    ?>
        <script type="text/javascript">
            window.location.href = 'all_restuarent.php';
        </script>
    <?php
    }
    ?>
    <div class="container row" style="margin: 0 auto; padding: 10rem 0;">
        <div class="col-md-6">
            <img src="images/addresturant.jpg" alt="Res loading..." style="width: 100%;">
        </div>
        <div class="col-md-6 text-center">
        <form id="mainatt1" class="resturant-form" name="mainatt1" method="post" action="">
            <h1>Add Restuarent </h1>

            <input type="text" class="textbox form-control" id="Restuarentname" name="Restuarentname" placeholder="Restuarent Name" required />

            <input type="text" class="textbox form-control" id="RestuarentDesc" name="RestuarentDesc" placeholder="Resturant Desc" required />

            <input type="reset" id="reset" title="reset" value="reset" class="btn grad-btn-4">
            <input type="submit" id="submit" title="Register New Restuarent" value="Register New Restuarent" class="btn grad-btn-4">
        </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>