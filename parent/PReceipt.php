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
    <title>Payment Receipt</title>
    <!-- Footable CSS -->
    <link href="../assets/node_modules/footable/css/footable.core.css" rel="stylesheet">
    <link href="../assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- page css -->
    <link href="../dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="../dist/css/pages/tab-page.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <link href="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <style>
        .datepicker {
            z-index: 1600 !important;
            /* has to be larger than 1050 */
        }
    </style>

</head>

<body class="skin-megna-dark fixed-layout">
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
        <?php require_once("PTopbar.php") ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php require_once("PSideBar.php") ?>
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
                        <h4 class="text-themecolor">Payment Receipt Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="PCalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="PInvoice.php">Invoice</a></li>
                                <li class="breadcrumb-item active">Payment Receipt</li>
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
                                <?php
                                $invoice_id = $_GET["invoice_id"];
                                ?>
                                <h4 class="card-title">Receipt of Invoice #<?php echo $invoice_id ?></h4>
                                <hr>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="teacherTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#receiptTab" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Receipt</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addReceiptTab" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-plus"></i></span> <span class="hidden-xs-down">Upload Receipt</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- Receipt panel -->
                                    <div class="tab-pane active" id="receiptTab" role="tabpanel">
                                        <div class="p-20">
                                            <div class="table-responsive ">
                                                <table id="mytable" class="table m-t-5 table-hover contact-list" data-page-size="5">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date</th>
                                                            <th>Amount(RM)</th>
                                                            <th>Description</th>
                                                            <th>Type</th>
                                                            <th data-sort-ignore="true">File</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $receipt_num = 0;
                                                        $userID = $_SESSION["userID"];
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql = "SELECT * FROM PAYMENT_RECEIPT WHERE INVOICE_ID = '$invoice_id' ORDER BY RECEIPT_ID DESC";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $receipt_num++;
                                                                $receipt_id = $row["RECEIPT_ID"];
                                                                $receipt_date = $row["RECEIPT_DATE"];
                                                                $receipt_amount = $row["RECEIPT_AMOUNT"];
                                                                $receipt_desc = $row["RECEIPT_DESC"];
                                                                $receipt_type = $row["RECEIPT_TYPE"];
                                                                if ($row["RECEIPT_FILEPATH"] != null) {
                                                                    $receipt_filepath = $row["RECEIPT_FILEPATH"];
                                                                } else {
                                                                    $receipt_filepath = '-';
                                                                }
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $receipt_num; ?></td>
                                                                    <td><?php echo $receipt_date; ?></td>
                                                                    <td><?php echo $receipt_amount; ?></td>
                                                                    <td><?php echo $receipt_desc; ?></td>
                                                                    <td><?php echo $receipt_type; ?></td>

                                                                    <?php
                                                                    if ($receipt_filepath == '-') {
                                                                    ?>
                                                                        <td><?php echo $receipt_filepath; ?></td>
                                                                    <?php
                                                                    } else {
                                                                        $path_parts = pathinfo($receipt_filepath);
                                                                        $file_name = $path_parts['basename']
                                                                    ?>
                                                                        <td><a href="<?php echo $receipt_filepath; ?>" target="_blank" rel="noopener noreferrer"><?php echo $file_name; ?></a></td>
                                                                    <?php
                                                                    }
                                                                    ?>
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
                                                            <td colspan="2">
                                                                <a href="PInvoice.php" type="button" class="btn btn-primary">Return</a>
                                                            </td>
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

                                    <!-- add receipt panel -->
                                    <div class="tab-pane" id="addReceiptTab" role="tabpanel">
                                        <div class="p-20">
                                            <form enctype="multipart/form-data" class="form-material" id="addReceiptForm" method="post" action="addReceipt.php">
                                                <input type="hidden" name="invoiceID" class="form-control" value="<?php echo $invoice_id ?>" readonly>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12">Receipt Date</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" name="receiptDate" class="form-control mydatepicker" placeholder="yyyy-mm-dd" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12">Amount (RM)</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" name="amount" class="form-control" placeholder="enter receipt amount" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12">Description</label>
                                                        <div class="col-md-12">
                                                            <input class="form-control" name="desc" placeholder="enter receipt description" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-12">Type</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="receiptType" class="form-control" value="online" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="receiptFileDiv">
                                                    <div class="row">
                                                        <label class="col-sm-12">Upload Receipt File</label>
                                                        <div class="col-sm-12 fileinput fileinput-new input-group" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput">
                                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                <span class="fileinput-filename"></span>
                                                            </div>
                                                            <span class="input-group-addon btn btn-default btn-file">
                                                                <span class="fileinput-new">Select file (only accept pdf or image file, max 2MB)</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <!-- get file data from this below input -->
                                                                <input type="file" id="receiptFileInput" name="receiptFile" accept="image/jpeg,image/png,application/pdf">
                                                            </span>
                                                            <a href="javascript:void(0)" id="btnFileRemove" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                        <span class="col-sm-12" id="receiptFileFeedback"></span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <button type="reset" id="btnReset" class="btn btn-dark waves-effect waves-light">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
    <script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="../assets/node_modules/popper/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/pages/jasny-bootstrap.js"></script>
    <script src="../dist/js/pages/mask.js"></script>
    <!-- Footable -->
    <script src="../assets/node_modules/footable/js/footable.all.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <script>
        // Date Picker
        $('.mydatepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        // footable
        $('#mytable').footable();

        $('#btnFileRemove').click(function() {
            receiptFileRemoveClass();
            $("#receiptFileInput").val('');
        });

        $('#btnReset').click(function() {
            receiptFileRemoveClass();
            $("#receiptFileInput").val('');
        });

        $("#addReceiptForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            var formData = new FormData(this);
            $.ajax({
                    enctype: 'multipart/form-data',
                    url: $("#addReceiptForm").attr('action'),
                    type: $("#addReceiptForm").attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        receiptFileRemoveClass();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        ).then(() => {
                            location.reload();
                        })
                        $('html, body').css("cursor", "auto");
                    } else if (response.status == 'error' && response.title == 'Error receipt file') {
                        receiptFileAddClass(response.message);
                        $('html, body').css("cursor", "auto");
                    } else {
                        receiptFileRemoveClass();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        )
                        $('html, body').css("cursor", "auto");
                    }
                })
                .fail(function(xhr, textStatus, errorThrown) {
                    Swal.fire(
                        'Oops...',
                        'Something went wrong with ajax!',
                        'error'
                    )
                    $('html, body').css("cursor", "auto");
                    console.log(xhr);
                })
        })
    </script>

</body>

</html>