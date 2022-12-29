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

    if (!$_SESSION['user_id'] == 11) {
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
    include('header.php');
    include('include/connection.php');

    ?>
    <h1>ev</h1>
    <div class="text-center home-cards admin-orders-container row" style=" padding: 5rem; margin: 5rem auto; width: 90%; border-radius: 12px;">
        <div class="col-md-3">
        <img src="images/burger.png" width="200"/>
        </div>
        <div style="font-weight: 700;" class="col-md-9 ">
            <h1 style="font-weight: 700; color: white;">Hi Admin!</h1>
            <h4 style="font-weight: 700; color: white;">Here are all the orders and your customers are hungry. Do make sure the food is been delivered to everyone who's hungry. On completion click the order completing button so that you can manage more the orders which are not delivered</h4>
        </div>
    </div>
    <div class="text-center orders-table home-cards" style=" padding: 5rem; margin: 5rem auto; width: 90%; border-radius: 12px;">

        <div class="row " style=" padding: 1rem;color: black; ">
            <h1> All Orders</h1>

            <table width="100%" class="table table-striped table-bordered table-hover" id="example">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $a = 1;
                    $q2 = "SELECT *, `proj_user`.`user_name`  FROM usercartorder, proj_user WHERE `proj_user`.`user_id`=`usercartorder`.`user_id` order by `order_date` asc";

                    $row_food_query = mysqli_query($link, $q2) or die("could not perform action on database");
                    //echo $q2;
                    while ($rowfood = mysqli_fetch_array($row_food_query, MYSQLI_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo $rowfood['orderdesc']; ?></td>

                            <td><?php echo $rowfood['order_date']; ?></td>
                            <td><?php echo $rowfood['user_name']; ?></td>
                            <td><?php echo $rowfood['price']; ?></td>

                            <td><?php if ($rowfood['order_status'] == 'In Process!') {
                                    echo "<span style='color:red'>";
                                }
                                echo $rowfood['order_status']; ?></span></td>
                            <td><?php if ($rowfood['order_status'] == 'Delevered') {
                                } else { ?><a class="btn btn-primary" href="all_order_action.php?id=<?php echo $rowfood['id']; ?>">Complete</a><?php } ?></td>
                        </tr>
                    <?php $a = $a + 1;
                    } ?>
            </table>
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


            $('#example').DataTable({
                columnDefs: [{
                    className: "dt-body-left",
                    "targets": [1, 2, 3, 4, 5]
                }],

                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    }, 'csv',
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },


                    {
                        extend: 'pdfHtml5',
                        pageSize: 'A4',
                        customize: function(doc) {
                            doc.defaultStyle.fontSize = 9;
                            //doc.styles.tableHeader.text-alig:left;orientation: 'landscape',
                            doc.styles.tableHeader.fontSize = 10;
                            //2,3,4,etc doc.styles.tableHeader.fontSize = 1; //2, 3, 4, etc 
                            doc.styles.tableHeader.alignment = 'left';

                        }

                    }, 'print'

                ]

            });

        });
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>