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
    <title>Make Payment</title>
    <!-- page css -->
    <link href="../dist/css/tab-page.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/file-upload.css" rel="stylesheet">
    <style>
        input[type=number].no-spinner::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
                                <?php
                                $invoice_id = $_GET["invoice_id"];
                                $userID = $_SESSION["userID"];
                                $userEmail = $_SESSION["email"];
                                $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                if ($conn) {
                                    $sql = "SELECT * FROM INVOICE WHERE INVOICE_ID = '$invoice_id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $invoice_amount = $row["INVOICE_AMOUNT"];
                                    }
                                    $sql2 = "SELECT * FROM PAYMENT_RECEIPT WHERE INVOICE_ID = '$invoice_id'";
                                    $result2 = $conn->query($sql2);
                                    $receipt_total_amount = 0;
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $receipt_amount = $row2["RECEIPT_AMOUNT"];
                                        $receipt_total_amount += $receipt_amount;
                                    }
                                    $amount_left = $invoice_amount - $receipt_total_amount;
                                } else {
                                    die("FATAL ERROR");
                                }

                                $conn->close();
                                ?>
                                <h4 class="card-title">INVOICE #<?php echo $invoice_id ?> PAYMENT SUMMARY</h4>
                                <hr>
                                <h5 class="card-title">Choose payment Option</h5>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="nav-item">
                                        <a href="#card" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
                                            <span class="visible-xs"><i class="fa fa-credit-card"></i></span>
                                            <span class="hidden-xs">Pay with Card</span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="nav-item">
                                        <a href="#onlineBank" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs"><i class="fa fa-bank"></i></span>
                                            <span class="hidden-xs">Online Banking</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    <!-- online banking tab -->
                                    <div role="tabpanel" class="tab-pane" id="onlineBank">
                                        <div class="mt-2">
                                            <a href="https://www.pbebank.com/" target="_blank" rel="noopener noreferrer" class=" ml-2">
                                                <img src="../dist/images/pbe.png" alt="pbe">
                                            </a>
                                            <a href="https://www.maybank2u.com.my/" target="_blank" rel="noopener noreferrer" class=" ml-2">
                                                <img src="../dist/images/maybank.png" alt="maybank" style="width:150px;">
                                            </a>
                                            <a href="https://www.cimbclicks.com.my/" target="_blank" rel="noopener noreferrer" class=" ml-2">
                                                <img src="../dist/images/cimb.png" alt="cimb" style="width:100px;">
                                            </a>
                                            <a href="https://www.rhbgroup.com/index.html" target="_blank" rel="noopener noreferrer" class=" ml-2">
                                                <img src="../dist/images/rhb.png" alt="rhb">
                                            </a>
                                        </div>
                                        <br />
                                        <p>For online banking, please fill in the name and account number as below:</p>
                                        <p><span class="font-weight-bold">Name: Music Academy Bank </span></p>
                                        <p><span class="font-weight-bold">Public Bank Account: 123456789</span></p>
                                        <p>Once you have done your online banking, please send a screenshot of your payment proof to admin.</p>
                                        <p>Or you can choose to manual upload yourself the payment proof through this link: <a href="PReceipt.php?invoice_id=<?= $invoice_id ?>" target="_blank" rel="noopener noreferrer">click here</a></p>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class=" font-weight-bold">Amount left to pay (RM)</label>
                                                    <input type="text" class="form-control" value="<?php echo $amount_left ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- card payment tab -->
                                    <div role="tabpanel" class="tab-pane active" id="card">
                                        <div class="row ml-2">
                                            <div class="col-md-12">
                                                <h4 class="card-title mt-3">General Info</h4>
                                                <h1><i class="fa fa-lg fa-cc-visa" style="color:blue;"></i> <i class="fa fa-lg fa-cc-mastercard" style="color:indianred;"></i> </h1>
                                                <p>Once you have done your online payment by credit/debit card, please send a screenshot of your payment proof to admin.</p>
                                            </div>
                                            <div class="col-md-12">
                                                <?php
                                                require("../stripe_config.php");
                                                $invoice_amount_for_stripe = $amount_left * 100;
                                                ?>
                                                <form id="paymentForm" method="post" action="makePayment.php?invoice_id=<?= $invoice_id ?>">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label>Amount left to pay (RM)</label>
                                                                <input type="text" class="form-control" name="amount" value="<?php echo $amount_left ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if ($invoice_amount_for_stripe > 0) {
                                                    ?>
                                                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $publishableKey ?>" data-amount="<?php echo $invoice_amount_for_stripe ?>" data-name="Music Academy" data-description="Invoice #<?php echo $invoice_id ?> payment" data-currency="myr" data-email="<?php echo $userEmail ?>">
                                                        </script>
                                                        <a href="PInvoice.php" type="button" class="btn btn-danger">Cancel</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="PInvoice.php" type="button" class="btn btn-primary">Return</a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!-- <input type="hidden" class="form-control" name="amount" value="<?php echo $invoice_amount ?>"> -->

                                                    <!-- <div class="form-group input-group m-t-30">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control no-spinner" name="card_num" placeholder="Card Number" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-7 col-md-7">
                                                            <div class="form-group">
                                                                <label>EXPIRATION DATE</label>
                                                                <input type="text" class="form-control" name="expire_date" data-mask="99/99" placeholder="MM/YY" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-5 col-md-5 pull-right">
                                                            <div class="form-group">
                                                                <label>CV CODE</label>
                                                                <input type="number" class="form-control no-spinner" name="cvc" placeholder="CVC" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>NAME OF CARD</label>
                                                                <input type="text" class="form-control" name="name_of_card" placeholder="FULLNAME" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Total Amount (RM)</label>
                                                                <input type="text" class="form-control" name="totalAmount" value="<?php echo $invoice_amount ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-group">
                                                        <button type="submit" class="btn btn-info"><span><i class="fa fa-money"></i> </span>Make Payment</button> -->
                                                    <!-- <a href="PInvoice.php" type="button" class="btn btn-danger">Cancel</a> -->
                                                    <!-- </div> -->
                                                </form>
                                            </div>

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
            ?? 2021 Music Academy Management System
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
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // edit invoice form
        // $("#paymentForm").submit(function(e) {
        //     e.preventDefault();
        //     $('html, body').css("cursor", "wait");
        //     $.ajax({
        //             url: $("#paymentForm").attr('action'),
        //             type: $("#paymentForm").attr('method'),
        //             data: $("#paymentForm").serialize(),
        //             dataType: 'json'
        //         })
        //         .done(function(response) {
        //             if (response.status == 'success') {
        //                 window.location.href = "PPaymentDone.php";
        //                 $('html, body').css("cursor", "auto");
        //             } else {
        //                 Swal.fire(
        //                     response.title,
        //                     response.message,
        //                     response.status
        //                 )
        //                 $('html, body').css("cursor", "auto");
        //             }
        //         }).fail(function(xhr, textStatus, errorThrown) {
        //             Swal.fire(
        //                 'Oops...',
        //                 'Something went wrong with ajax!',
        //                 'error'
        //             )
        //             $('html, body').css("cursor", "auto");
        //             console.log(xhr);
        //         })
        // })
    </script>

</body>

</html>