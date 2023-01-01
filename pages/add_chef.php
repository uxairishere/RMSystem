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



    if ((isset($_POST['Chefname'])) && (isset($_POST['ChefDesc']))) {
        $q = "INSERT INTO `msr`.`chef` (`chef_id`, `chef_name`, `chef_rating`, `chef_desc`, `vote`) VALUES (NULL, '" . $_POST['Chefname'] . "', '0', '" . $_POST['ChefDesc'] . "', '0');";
        mysqli_query($link, $q) or die("could not insert into database");
    ?>
        <script type="text/javascript">
            window.location.href = 'all_chef.php';
        </script>
    <?php
    }
    ?>
    <div class="row container" style="padding-top: 15rem; padding-bottom: 5rem; margin: 0 auto;">
        <div class="col-md-6">
            <img src="images/addchef.jpg" alt="Chef Images..." style="width: 100%;">
        </div>
        <div class="col-md-6 text-center">
            <form id="mainatt1" class="add-chef-form" name="mainatt1" method="post" action="">
                <h1> Add Chef</h1>
                <input type="text" class="textbox form-control" id="Chefname" name="Chefname" placeholder="Chef Name" required />
                <input type="text" class="textbox form-control" id="ChefDesc" name="ChefDesc" placeholder="Chef Description" required />
                <input type="reset" id="reset" title="reset" value="reset" class="btn grad-btn-4">
                <input type="submit" id="submit" title="Register New Chef" value="Register New Chef" class="btn grad-btn-4"></td>
            </form>
        </div>

    </div>

    <?php include 'footer.php'; ?>

</body>

</html>