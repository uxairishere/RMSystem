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
if ($_SESSION['name'] == "") {
?>
  <script>
    window.location.href = "index.php";
  </script>
  <style>
    .img-fluid {
      max-width: 100%;
      height: auto;
      display: block;
    }
  </style>
<?php
}
?>
<div class="container text-center" style="padding-bottom: 5rem;">

  <?php
  include('include/connection.php');
  date_default_timezone_set('Asia/Karachi');
  $tdate = date("Y:m:d H:i:s");
  $tdate2 = date("Y:m:d");
  $uid = $_SESSION['user_id'];



  //$q="INSERT INTO `pssr`.`res_table` (`res_id`, `res_tid`, `res_status`, `res_by_uid`, `res_time`, `timestmp`) VALUES (NULL, '$res_tid', '1', '$uid', '$res_time', NOW());";
  //SELECT t.t_no, r.res_tid, r.res_status, r.res_by_uid, r.res_time, r.timestmp FROM table_t t, res_table r where t.t_no= r.res_tid and r.res_by_uid=11
  //DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')<=DATE_FORMAT('$tdate','%Y:%m:%d %H:%i:%s')
  //and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')<=DATE_FORMAT('NOW()','%Y:%m:%d %H:%i:%s') 

  $count = 0;
  $q2 = "SELECT t.t_no, r.res_tid, r.res_status, r.res_by_uid, r.res_time, r.timestmp FROM table_t t, res_table r where t.t_no= r.res_tid and r.res_status=1 and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')>=DATE_FORMAT('$tdate','%Y:%m:%d %H:%i:%s')  ";

  //fit hay SELECT t.t_no, r.res_tid, r.res_status, r.res_by_uid, r.res_time, r.timestmp FROM table_t t, res_table r where t.t_no= r.res_tid and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')>=DATE_FORMAT('2019:04:14 19:40:26','%Y:%m:%d %H:%i:%s')

  $row_food_query = mysqli_query($link, $q2) or die("could not query database");
  //mysqli_query($link,$q2) or die("could not perform action on database");
  //echo $q2;
  echo "<h2 style='padding-top: 8rem'>Table Reservation</h2>"; ?>

  <div class="row">
    <div class="col-md-12">
      <form id="mainatt2" name="mainatt2" method="POST" action="res_t_action.php">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

        <h3>Please select table from available table list:</h3>
    </div>
  </div>
  <div class="row">
    <select class="btn grad-btn-4" id="res_tid" name="res_tid" required>
      <?php
      $q3 = "SELECT `t_no`,`t_desc` FROM `table_t` where `t_no` not in (SELECT t.t_no FROM table_t t, res_table r where t.t_no= r.res_tid and DATE_FORMAT(r.res_time,'%Y:%m:%d %H:%i:%s')>=DATE_FORMAT('$tdate','%Y:%m:%d %H:%i:%s'))";
      $row3 = mysqli_query($link, $q3);

      while ($result3 = mysqli_fetch_array($row3)) { ?>
        <div class="col-md-3">
          <p><img align="left" src="images/table.jpg" class="img-fluid" /></p>
          <?php echo "<hr /><tr><td> Table" . $result3[1] . " ";
          echo  "Available: " . $result3[0] . "<br> Status:Not Reserved </td></tr></div>";


          ?>

          <option value="<?php echo $result3[0]; ?>"><?php echo $result3[1]; ?></option>
        <?php  }  ?>
    </select>

    <input style="width:30rem; padding: 2rem 1rem; display: inline-block;" type="datetime-local" class="textbox form-control" id="res_time" name="res_time" required />
    <input type="submit" name="submit" id="Reserv" value="Reserv This Table" class="btn grad-btn-4" <?php if (!$_SESSION['user_id']) { ?>disabled title="please log in to Reserv This Table" <?php } ?>>
    </form>
    <script>
      var today = new Date().toISOString().slice(0, 16);
      document.getElementsByName("res_time")[0].min = today;
    </script>
  </div>
  <?php

  $ro = mysqli_query($link, $q3) or die("could not query database");
  //mysqli_query($link,$q2) or die("could not perform action on database");
  //echo $q2;
  //echo $q3; 
  echo "<h4>Table Available for Reservation</h4>";
  ?>
  <div class="row">

    <?php while ($rof = mysqli_fetch_array($ro)) {
    ?>
      <div class="col-md-3">
        <p><img align="left" src="images/tbl<?php echo $rof[0]; ?>.jpg" width="220" height="150" class="img-fluid" style=" border-radius: 12px;
  filter: alpha(opacity=50)" /></p>
        <?php echo "<hr /><tr><td> Table:" . $rof[0] . " </td></tr>";

        ?>
      </div>
    <?php
    }
    ?>
  </div>

  <!-- Already reserved tables  -->
  <h1 style="padding-top: 5rem;">Already reserved tables</h1>
  <?php
  while ($rowfood = mysqli_fetch_array($row_food_query)) {
    $count = $count + 1; ?>
    <div class="col-md-12 home-cards orders-table" style=" margin: 3rem auto; padding: 3rem; border-radius: 12px;">

      <img src="images/burger.png" width="200" style="position: absolute; right: 0; opacity: 0.2;" />


      <p><img align="left" src="images/tbl<?php echo $rowfood[1]; ?>.jpg" width="220" class="img-responsive" style="border-radius: 12px; height: 150px" /></p>
    <?php
    $timestamp = strtotime($rowfood[4]);
    $date = date('d-m-Y', $timestamp);
    $time = date('Gi.s', $timestamp);

    echo "<tr>
            <td> 
              <h3 style='font-weight: 700; margin: 0'> Table No: " . $rowfood[1] . "
              <br/> Date: " . $date . "<br>Time: " . $time . "<br>
              status: <span class='text-success'>Reserved<span></h3>
            </td>
          </tr>
    </div>";
  }
    ?>
    </div>
    <?php include 'footer.php'; ?>
    </body>

    </html>