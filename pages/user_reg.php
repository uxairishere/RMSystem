<?php
session_start();
include('header.php');
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        //header("Location: index.php");
    }
}
$_SESSION['timeout'] = time();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/jpeg" href="images/favi.jpg">
    <script>
        $(document).ready(function() {
            $("#email").keyup(function() {
                var email = $("#email").val().trim();
                if (email != '') {
                    $("#email_response").show();
                    $.ajax({
                        url: 'email_check.php',
                        type: 'post',
                        data: {
                            email: email
                        },
                        success: function(response) {
                            if (response > 0) {
                                $("#email_response").html("<span class='not-exists'>* email Already in use.</span>");
                                $("#email").val('');
                            } else {
                                $("#email_response").html("<span class='exists'>Available.</span>");
                            }
                        }
                    });
                } else {
                    $("#email_response").hide();
                }
            });
        });
    </script>
</head>
<title>User Registration</title>

<body>
    <div class="createacc-container text-center row">
        <div class="col-md-6">
            <img src="images/signup.jpg" width="100%" />
        </div>
        <div class="col-md-6">
            <h1 class="create-h1" style="margin-top: 7rem;">Create Account!</h1>
            <form id="mainatt1" name="mainatt1" method="post" action="user_regaction.php" enctype="multipart/form-data">
                <!-- file upload  -->
                <input type="file" class="form-control acc-input" name="fileToUpload" id="fileToUpload">
                <!-- username  -->
                <input type="text" class="form-control acc-input" id="Username" name="Username" placeholder="Username" required />
                <!-- email  -->
                <input type="email" class="form-control acc-input" name="email" id="email" placeholder="Email" required>
                <!-- phone  -->
                <input type="tel" class="form-control acc-input" name="cell_no" id="cell_no" placeholder="Cell No" title="use 11 digit like 03xx-xxxxxxx" pattern="^\d{11}$" required>
                <!-- address  -->
                <input type="text" class="form-control acc-input" name="Address" id="Address" placeholder="Address" required>
                <!-- password  -->
                <input type="Password" class="form-control acc-input" name="Password" id="Password" placeholder="Password" required>
                <!-- submit  -->
                <input type="reset" id="reset" title="reset" value="reset" class="btn btn-primary">
                <input type="submit" id="submit" title="Register New User" value="Register New User" class="btn btn-primary">
            </form>
            <?php if ($_GET) { ?>
            <div class="alert alert-danger text-center" style="width: 90%; margin: 1rem auto;">
                <h3 class="text-warning"><?php echo $_GET['error']; ?></h3>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
<?php include('footer.php'); ?>
</html>