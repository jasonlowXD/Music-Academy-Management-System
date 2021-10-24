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
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <!-- page css -->
    <link href="../dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="../dist/css/pages/tab-page.css" rel="stylesheet">
    <!-- Footable CSS -->
    <link href="../assets/node_modules/footable/css/footable.core.css" rel="stylesheet">
    <link href="../assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />


</head>

<body class="skin-blue-dark fixed-layout">
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
                                            <tr>
                                                <td>1</td>
                                                <td>Parent A</td>
                                                <td>1/1/2021</td>
                                                <td>540</td>
                                                <td><span class="label label-success">Paid</span></td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="AInvoiceEdit.php" type="button" class="btn btn-outline-success">Details</a>
                                                        <a href="AReceipt.php" type="button" class="btn btn-outline-info">Receipt</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Parent B</td>
                                                <td>1/1/2021</td>
                                                <td>150</td>
                                                <td><span class="label label-success">Paid</span></td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="AInvoiceEdit.php" type="button" class="btn btn-outline-success">Details</a>
                                                        <a href="AReceipt.php" type="button" class="btn btn-outline-info">Receipt</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>AABB</td>
                                                <td>1/1/2021</td>
                                                <td>320</td>
                                                <td><span class="label label-danger">Unpaid</span></td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="AInvoiceEdit.php" type="button" class="btn btn-outline-success">Details</a>
                                                        <a href="AReceipt.php" type="button" class="btn btn-outline-info">Receipt</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Parent A</td>
                                                <td>1/2/2021</td>
                                                <td>120</td>
                                                <td><span class="label label-danger">Unpaid</span></td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="AInvoiceEdit.php" type="button" class="btn btn-outline-success">Details</a>
                                                        <a href="AReceipt.php" type="button" class="btn btn-outline-info">Receipt</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Parent B</td>
                                                <td>1/2/2021</td>
                                                <td>150</td>
                                                <td><span class="label label-success">Paid</span></td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="AInvoiceEdit.php" type="button" class="btn btn-outline-success">Details</a>
                                                        <a href="AReceipt.php" type="button" class="btn btn-outline-info">Receipt</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>asdsad</td>
                                                <td>1/2/2021</td>
                                                <td>150</td>
                                                <td><span class="label label-danger">Unpaid</span></td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="AInvoiceEdit.php" type="button" class="btn btn-outline-success">Details</a>
                                                        <a href="AReceipt.php" type="button" class="btn btn-outline-info">Receipt</a>
                                                    </div>
                                                </td>
                                            </tr>
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