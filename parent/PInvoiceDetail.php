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
    <title>Invoice Details</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <!-- page css -->
    <link href="../dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="../dist/css/pages/tab-page.css" rel="stylesheet">

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
                        <h4 class="text-themecolor">Invoice Details</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="PCalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="PInvoice.php">Invoice</a></li>
                                <li class="breadcrumb-item active">Invoice Details</li>
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
                                <div id="invoicePrint">
                                    <h3><b>INVOICE</b> <span class="pull-right">#1</span></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-left">
                                                <address>
                                                    <h3> &nbsp;<b class="text-danger">Music Academy</b></h3>
                                                    <p class="text-muted m-l-5">E 104, Dharti-2,
                                                        <br /> Nr' Viswakarma Temple,
                                                        <br /> Talaja Road,
                                                        <br /> Bhavnagar - 364002
                                                    </p>
                                                </address>
                                            </div>
                                            <div class="pull-right text-right">
                                                <address>
                                                    <h3>To,</h3>
                                                    <h4 class="font-bold">Parent ABC,</h4>
                                                    <p class="text-muted m-l-30">E 104, Dharti-2,
                                                        <br /> Nr' Viswakarma Temple,
                                                        <br /> Talaja Road,
                                                        <br /> Bhavnagar - 364002
                                                    </p>
                                                    <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> 01-01-2021</p>
                                                </address>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive m-t-40">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>Description</th>
                                                            <th class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td>Piano Grade 1</td>
                                                            <td class="text-right"> RM 120 </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">2</td>
                                                            <td>Piano Grade 1</td>
                                                            <td class="text-right"> RM 120 </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">3</td>
                                                            <td>Guitar Grade 2</td>
                                                            <td class="text-right"> RM 300 </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="pull-right m-t-30 text-right">
                                                <hr>
                                                <h3><b>Total :</b> RM 540</h3>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right button-group">
                                    <a href="PInvoice.php" type="button" class="btn btn-primary">Return</a>
                                    <a href="PPayment.php" type="button" class="btn btn-info">Proceed to Payment</a>
                                    <button onclick="printDiv('invoicePrint')" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
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
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // print invoice
        function printDiv(invoicePrint) {
            var contents = document.getElementById(invoicePrint).innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><link href="../dist/css/style.css" rel="stylesheet">');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>

</body>

</html>