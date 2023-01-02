<!-- <link rel="stylesheet" href="./files/index.css"> -->

<?php
session_start();
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
    }
}
$_SESSION['timeout'] = time();
include('include/header.php');
include('header.php');

 ?>
<img src="images/bg.jpg" class="fixed-top" width="520" style="position: fixed; z-index:-1; right: 0;" />

<div class="about-container container text-center">
  <!-- dev  -->
  <h1>Developers</h1>
  <div class="row text-center" style="margin: 0 auto;">
    <div class="col-md-4">
      <img src="images/jawad.jpeg" alt="jadu" width="200">
    </div>
    <div class="col-md-4">
    <img src="images/umair.jpg" alt="umair" width="200">
    </div>
    <div class="col-md-4">
    <img src="images/hammad.jpeg" alt="hammad" width="200">
    </div>
  </div>

  <h2>Each developer role</h2>
  <p>Each developer has contributed equally in during the project development and also in project documentation. Each developer has expertise in developing web apps using php core and bootstrap framwork.</p>
  <h2>About MSR</h2>
  <p>Fully authorized and authenticated php core website. Where user can add to cart food items and can order it to desired location. The payment is integrated with stripe payment gatway and provides excellent user experice.</p>
  <h2>Find Us?</h2>
  <a href="" class="btn"><i class="fa fa-facebook"></i></a>
  <a href="" class="btn"><i class="fa fa-github"></i></a>
  <a href="" class="btn"><i class="fa fa-instagram"></i></a>
  <a href="" class="btn "><i class="fa fa-linkedin"></i></a>



</div>

<?php require('footer.php') ?>


