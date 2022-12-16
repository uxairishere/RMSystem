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
 <!DOCTYPE html>
 <html lang="en">

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

     <style>
         /* Container */
         .container {
             margin: 0 auto;
             width: 70%;
         }

         /* Registration */
         #div_reg {
             border: 1px solid gray;
             border-radius: 3px;
             width: 470px;
             height: 370px;
             box-shadow: 0px 2px 2px 0px gray;
             margin: 0 auto;
         }

         #div_reg h1 {
             margin-top: 0px;
             font-weight: normal;
             padding: 10px;
             background-color: cornflowerblue;
             color: white;
             font-family: sans-serif;
         }

         #div_reg div {
             clear: both;
             margin-top: 10px;
             padding: 5px;
         }

         #div_reg .textbox {
             width: 96%;
             padding: 7px;
         }

         #div_reg input[type=submit] {
             padding: 7px;
             width: 100px;
             background-color: lightseagreen;
             border: 0px;
             color: white;
         }

         /* Response */
         .response {
             padding: 6px;
             display: none;
         }

         .not-exists {
             color: green;
         }

         .exists {
             color: red;
         }
     </style>

 </head>
 <title>User Registration</title>

 <body style="background-image:url(images/bg.jpg);  background-repeat: no-repeat; background-position: 0 0;    background-size: cover;">





     <div class="container"> <br><br>
         <div align="right"></div>
         <br>
         <br>&nbsp;
         <div class="row" id="ismail">
             <div style="margin: 0 auto; width:440px;">
                 <div class="panel panel-primary">

                     <form id="mainatt1" name="mainatt1" method="post" action="user_regaction.php" enctype="multipart/form-data">


                         <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
                         <tr>
                         <td>Select image to upload:</td>
                         <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                         </tr>
                         
                         <tr>
                                 <td>User Name</td>
                                 <td><input type="text" class="textbox" id="Username" name="Username" placeholder="Username" required />
                                 </td>
                             </tr>

                             <tr>

                                 <td>Email</td>
                                 <td><input type="email" name="email" id="email" placeholder="Email" required>
                                     <div id="email_response" class="response"></div>
                                 </td>
                                 <!-- This can be used for email validation
                        <input type="email" pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$" required> -->
                             </tr>
                             <tr>
                                 <td>Cell No</td>
                                 <td><input type="tel" name="cell_no" id="cell_no" placeholder="Cell No" title="use 11 digit like 03xx-xxxxxxx" pattern="^\d{11}$" required></td>

                             </tr>
                             <tr>
                                 <td>Address</td>
                                 <td><input type="text" name="Address" id="Address" placeholder="Address" required></td>

                             </tr>
                             <tr>
                                 <td>Password</td>
                                 <td><input type="Password" name="Password" id="Password" placeholder="Password" required></td>

                             </tr>
                             <tr>
                                 <td></td>

                                 <td><input type="reset" id="reset" title="reset" value="reset" class="btn btn-primary"> &nbsp;<input type="submit" id="submit" title="Register New User" value="Register New User" class="btn btn-primary"></td>
                             </tr>

                         </table>
                     </form>
                     <div class="alert alert-danger text-center" style="width: 90%; margin: 1rem auto;">
                     <h3 class="text-warning"><?php if($_GET) echo $_GET['error']; ?></h3>
                     </div>

                     <!-- /.table-responsive -->

                 </div>
                 <!-- /.panel-body -->
             </div>
             <!-- /.panel -->
         </div>
         <!-- /.col-lg-12 -->
     </div>



     </div>

     </div><br>

     <?php include 'footer.php'; ?>


 </body>

 </html>