<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="files/bootstrap.min.css" rel="stylesheet">
<link href="files/ie10-viewport-bug-workaround.css" rel="stylesheet">
<link href="files/navbar-fixed-top.css" rel="stylesheet">
</head>
<body>
  
<?php 
 session_start(); 

if (!$_SESSION['user_id']==11) {
header("location:index.php");
} 

 
$inactive = 360; // Set timeout period in seconds
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();
        header("Location: index.php");
    }
}   
include('header_admin.php');
include('include/connection.php');
 
?>
    <div class="container" style="background-color:#FDF5EC">
     
     <div class="row" style=" padding: 1rem;color: black; border-width: 3px; border-style: solid; border-image:linear-gradient(to bottom,#996249,rgba(0, 0, 0, 0)) 1 100%;">
     <h1 > All Orders</h1>
 
                      <table width="100%" class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                <th>Sr.</th>
                                <th>Food Name</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                
                                <th>Status</th>
                                <th>Action</th>
                                 </tr>
                                 </thead>
                                <tbody>
                                <?php 
     
$a=1;
$q2="SELECT `order`.`order_id`, `order`.`user_id`, `order`.`food_quantity`,`order`.`order_date`, `order`.`order_status`,`food_menu`.`food_menu_id`,`food_menu`.`food_menu_name` FROM `order`,`food_menu` WHERE `order`.`food_menu_id`=`food_menu`.`food_menu_id` order by `order`.`order_date` asc";

$row_food_query=mysqli_query($link,$q2) or die("could not perform action on database");
//echo $q2;
while ($rowfood=mysqli_fetch_array($row_food_query)) {
 ?>
                                <tr>
                                <td><?php echo $a;?></td>
                                <td><?php echo $rowfood[6];?></td>
                                
                                <td><?php echo $rowfood[3];?></td>
                                <td><?php echo $rowfood[2];?></td>
                                <td><?php if($rowfood[4]=='In Process'){
								echo "<span style='color:red'>";
								} echo $rowfood[4];?></span></td>
                                <td><?php if($rowfood[4]=='Delevered'){
								 
								} else {?><a href="all_order_action.php?id=<?php echo $rowfood[0];?>">Complete</a><?php }?></td>
                                </tr>
                                <?php $a=$a+1;
}?>
                          </table>  
        </div>   
  
<div class="row">
<h4 class="jumbotron">All rights reserved - copy rights 2022</h4>
</div>
</div>

 
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
   <script src="../vendor/jquery/jquery.min.js"></script>
 <link rel="stylesheet" type="text/css" href="../vendor/datatables/css/jquery.dataTables.css">
 <script type="text/javascript" charset="utf8" src="../vendor/datatables/js/jquery.dataTables.js"></script>
 
<script>
$(document).ready(function() {

 
    $('#example').DataTable( {
	columnDefs: [
    { className: "dt-body-left", "targets": [ 1,2,3,4,5 ] }
  ],
      
		dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },'csv',
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
          
			
			{ extend: 'pdfHtml5',  pageSize: 'A4', customize: function (doc) { doc.defaultStyle.fontSize = 9;
			 //doc.styles.tableHeader.text-alig:left;orientation: 'landscape',
			 doc.styles.tableHeader.fontSize = 10;
			 //2,3,4,etc doc.styles.tableHeader.fontSize = 1; //2, 3, 4, etc 
			 doc.styles.tableHeader.alignment ='left';
			 
			}
			
			 }, 'print'
			
        ]
		
    } );
	 
} );

</script>
<?php include 'footer.php';?>
</body>
</html>