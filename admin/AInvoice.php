<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Manage invoice</title>
    <!-- Footable CSS -->
    <link href="../assets/footable/css/footable.core.css" rel="stylesheet">
    <link href="../assets/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- page css -->
    <link href="../dist/css/footable-page.css" rel="stylesheet">
    <link href="../dist/css/tab-page.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/file-upload.css" rel="stylesheet">


</head>

<body class="skin-default-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php require_once("ATopbar.php") ?>
        <?php
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $userID = $_SESSION["userID"];
        $date = new DateTime();
        $currentDate = $date->format('Y-m-d');
        $currentYearMonth = $date->format('Y-m');
        $monthName = date('F');

        $conn = mysqli_connect("localhost", "root", "", "music_academy");
        if ($conn) {
            $sql = "SELECT INVOICE_DATE FROM INVOICE WHERE ADMIN_ID = '$userID' ORDER BY INVOICE_ID DESC LIMIT 1";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $db_latest_date = $row["INVOICE_DATE"];
            }
            $latest_YearMonth = date("Y-m", strtotime($db_latest_date));

            // COMPARE YEAR AND MONTH ONLY 
            if ($currentYearMonth > $latest_YearMonth) {
                $sql2 = "SELECT * FROM PARENT WHERE ADMIN_ID = '$userID' AND PARENT_STATUS = 'active'";
                $result2 = $conn->query($sql2);
                while ($row2 = $result2->fetch_assoc()) {
                    $parent_id = $row2["PARENT_ID"];
                    $parent_name = $row2["PARENT_NAME"];
                    $desc = '';
                    $total_fee = 0;

                    $sql3 = "SELECT * FROM CHILD LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID WHERE CHILD.PARENT_ID = '$parent_id' AND CHILD.CHILD_STATUS = 'active'";
                    $result3 = $conn->query($sql3);
                    if ($result3->num_rows > 0) {
                        while ($row3 = $result3->fetch_assoc()) {
                            $child_name = $row3["CHILD_NAME"];
                            $course_name = $row3["COURSE_NAME"];
                            $course_fee = $row3["COURSE_FEE"];
                            $desc .= $child_name . ' ' . $course_name . ',' . $course_fee . '\n';
                            $total_fee += $course_fee;
                        }

                        $status = 'unpaid';

                        // ADD NEW INVOICE FOR EACH PARENT & NOTIFY PARENT
                        $sql4 = "INSERT INTO INVOICE (INVOICE_ID,ADMIN_ID,PARENT_ID,INVOICE_DATE,INVOICE_STATUS,INVOICE_AMOUNT,INVOICE_DESC)
                        VALUES ('','$userID','$parent_id','$currentDate','$status','$total_fee','$desc')";

                        // NOTIFY PARENT
                        $title = 'New invoice alert';
                        $content = 'Your ' . $monthName . ' invoice is here, please check!';
                        $status = 'unseen';
                        $parent_link = 'PInvoice.php';

                        $sql5 = "INSERT INTO NOTIFICATION (NOTIFICATION_ID,ADMIN_ID,TEACHER_ID,PARENT_ID,TITLE,CONTENT,VIEW_STATUS,DATETIME,LINK) 
                        VALUES ('',NULL,NULL,'$parent_id','$title','$content','$status',CURRENT_TIMESTAMP(),'$parent_link')";


                        if (mysqli_query($conn, $sql4) && mysqli_query($conn, $sql5)) {
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }
            }
        } else {
            die("FATAL ERROR");
        }
        $conn->close();
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php require_once("ASideBar.php") ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Invoice Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Invoices</h4>
                                <hr>
                                <div class="d-flex">
                                    <div class="mr-auto">
                                        <label class="form-inline">Show &nbsp;
                                            <select id="table-entries">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select> &nbsp; entries
                                        </label>
                                    </div>
                                    <div class="ml-auto">
                                        <div class="form-group">
                                            <input id="table-search" style="margin-left:0px !important;" type="text" placeholder="Search" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive ">
                                    <table id="mytable" class="table m-t-5 table-hover contact-list" data-page-size="5">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Parent</th>
                                                <th>Date</th>
                                                <th>Amount(RM)</th>
                                                <th>Status</th>
                                                <th data-sort-ignore="true">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                            if ($conn) {
                                                $sql5 = "SELECT * FROM INVOICE LEFT JOIN PARENT ON INVOICE.PARENT_ID = PARENT.PARENT_ID WHERE INVOICE.ADMIN_ID = '$userID' ORDER BY INVOICE.INVOICE_ID DESC";
                                                $result5 = $conn->query($sql5);
                                                while ($row5 = $result5->fetch_assoc()) {
                                                    $invoice_id = $row5["INVOICE_ID"];
                                                    $parent_name = $row5["PARENT_NAME"];
                                                    $invoice_date = $row5["INVOICE_DATE"];
                                                    $invoice_amount = $row5["INVOICE_AMOUNT"];
                                                    $invoice_status = $row5["INVOICE_STATUS"];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $invoice_id; ?></td>
                                                        <td><?php echo $parent_name; ?></td>
                                                        <td><?php echo $invoice_date; ?></td>
                                                        <td><?php echo $invoice_amount; ?></td>
                                                        <?php
                                                        if ($invoice_status == "paid") {
                                                        ?>
                                                            <td><span class="label label-success"><?php echo $invoice_status; ?></span></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td><span class="label label-danger"><?php echo $invoice_status; ?></span></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td>
                                                            <div class="button-group">
                                                                <a href="AInvoiceEdit.php?invoice_id=<?= $invoice_id ?>" type="button" class="btn btn-outline-success"><i class="ti-info-alt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                                <a href="AReceipt.php?invoice_id=<?= $invoice_id ?>" type="button" class="btn btn-outline-info"><i class="ti-receipt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>


                                            <?php
                                                }
                                            } else {
                                                die("FATAL ERROR");
                                            }
                                            $conn->close();
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="text-right">
                                                        <ul class="pagination"> </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2021 Music Academy Management System
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/jasny-bootstrap.js"></script>
    <script src="../dist/js/mask.js"></script>
    <!-- Footable -->
    <script src="../assets/footable/js/footable.all.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // footable
        $('#mytable').footable();
        $('#table-entries').on('change', function(e) {
            e.preventDefault();
            var pageSize = $(this).val();
            $('#mytable').data('page-size', pageSize);
            $('#mytable').trigger('footable_initialized');
        });

        var addrow = $('#mytable');

        // Search input
        $('#table-search').on('input', function(e) {
            e.preventDefault();
            addrow.trigger('footable_filter', {
                filter: $(this).val()
            });
        });
    </script>

</body>

</html>