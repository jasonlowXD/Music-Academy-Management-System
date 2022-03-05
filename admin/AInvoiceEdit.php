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
    <title>Manage Invoice Details</title>
    <!-- page css -->
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
                        <h4 class="text-themecolor">Invoice Details</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="AInvoice.php">Invoice</a></li>
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
                                $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                if ($conn) {
                                    $sql = "SELECT * FROM INVOICE LEFT JOIN PARENT ON INVOICE.PARENT_ID = PARENT.PARENT_ID WHERE INVOICE.INVOICE_ID = '$invoice_id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $parent_id = $row["PARENT_ID"];
                                        $parent_name = $row["PARENT_NAME"];
                                        $invoice_date = $row["INVOICE_DATE"];
                                        $invoice_amount = $row["INVOICE_AMOUNT"];
                                        $invoice_status = $row["INVOICE_STATUS"];
                                        $invoice_desc = $row["INVOICE_DESC"];
                                    }
                                } else {
                                    die("FATAL ERROR");
                                }

                                $conn->close();
                                ?>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="teacherTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#invoiceDetails" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#editInvoice" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-pencil"></i></span> <span class="hidden-xs-down">Edit</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- invoice details panel -->
                                    <div class="tab-pane active" id="invoiceDetails" role="tabpanel">
                                        <div class="p-20">
                                            <div id="invoicePrint">
                                                <h3><b>INVOICE</b> <span class="pull-right">#<?php echo $invoice_id; ?></span></h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="pull-left">
                                                            <address>
                                                                <h3><b class="text-danger">Music Academy</b></h3>
                                                                <p class="text-muted m-l-5">No 1234, Jalan SK 1/1
                                                                    <br /> Kampung Baru Seri Kembangan,
                                                                    <br /> 43300 Seri Kembangan,
                                                                    <br /> Selangor.
                                                                </p>
                                                            </address>
                                                        </div>
                                                        <div class="pull-right text-right">
                                                            <address>
                                                                <h3>To,</h3>
                                                                <h4 class="font-bold"><?php echo $parent_name; ?></h4>
                                                                <p class="m-t-30"><b>Invoice Date :</b> <i class="fa fa-calendar mr-1"></i><?php echo $invoice_date; ?></p>
                                                            </address>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="table-responsive m-t-40">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Description</th>
                                                                        <th class="text-right">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $split_newline_desc = explode("\n", $invoice_desc);
                                                                    $num_of_desc = count($split_newline_desc) - 1; //remove the last \n due to it is blank
                                                                    for ($i = 0; $i < $num_of_desc; $i++) {
                                                                        $split_desc = explode(",", $split_newline_desc[$i]);
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $i + 1 ?></td>
                                                                            <td><?php echo $split_desc[0] ?></td>
                                                                            <td class="text-right"> RM <?php echo $split_desc[1] ?> </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="pull-right m-t-30 text-right">
                                                            <hr>
                                                            <h3><b>Total :</b> RM <?php echo $invoice_amount; ?></h3>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right button-group">
                                                <a href="AInvoice.php" type="button" class="btn btn-primary">Return</a>
                                                <button onclick="printDiv('invoicePrint')" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- edit invoice panel -->
                                    <div class="tab-pane" id="editInvoice" role="tabpanel">
                                        <div class="p-20">
                                            <form class="" id="editInvoiceForm" method="post" action="editInvoice.php?invoice_id=<?= $invoice_id ?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Invoice Number</label>
                                                            <input type="text" name="invoiceID" class="form-control text-muted" value="<?php echo $invoice_id; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Invoice Date</label>
                                                            <input type="text" name="invoiceDate" class="form-control text-muted" value="<?php echo $invoice_date; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Parent Name</label>
                                                            <input type="hidden" name="invoiceParentID" value="<?php echo $parent_id; ?>" readonly>
                                                            <input type="text" name="invoiceParent" class="form-control text-muted" value="<?php echo $parent_name; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <div class="desc_div">
                                                                <?php
                                                                for ($i = 0; $i < $num_of_desc; $i++) {
                                                                    $split_desc = explode(",", $split_newline_desc[$i]);
                                                                ?>
                                                                    <div class="row mb-2" id="desc-<?php echo $i ?>">
                                                                        <div class="col-md-7 col-sm-7 col-12">
                                                                            <input type="text" name="invoiceDescName[]" class="form-control" value="<?php echo $split_desc[0] ?>" required>
                                                                        </div>
                                                                        <div class="d-flex no-block align-items-end col-md-5 col-sm-5 col-12">
                                                                            <label class="mr-3">RM</label>
                                                                            <input type="number" name="invoiceDescPrice[]" min=0 oninput="validity.valid||(value='');" class="form-control amount_change" value="<?php echo $split_desc[1] ?>" required>
                                                                            <?php
                                                                            if ($i > 0) {
                                                                            ?>
                                                                                <span id="buttonDiv">
                                                                                    <button type="button" id="<?php echo $i ?>" class="ml-3 btn btn-danger btn-xs btn_remove"><i class="fa fa-times"></i></button>
                                                                                </span>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>

                                                                <!-- for input new desc and clone -->
                                                                <div class="row mb-2 d-none" id="clonedesc">
                                                                    <div class="col-md-7 col-sm-7 col-12">
                                                                        <input type="text" name="" class="form-control inputdescName" placeholder="Enter item">
                                                                    </div>
                                                                    <div class="d-flex no-block align-items-end col-md-5 col-sm-5 col-12">
                                                                        <label class="mr-3">RM</label>
                                                                        <input type="number" name="" min=0 oninput="validity.valid||(value='');" class="form-control inputnumber">
                                                                        <span id="buttonDiv"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="m-1 mt-3">
                                                                <button type="button" id="addDesc" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Total Amount (RM)</label>
                                                            <input type="number" name="totalAmount" min=0 oninput="validity.valid||(value='');" class="form-control text-muted total_amount" value="<?php echo $invoice_amount; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="form-control" name="invoiceStatus" required>
                                                                <?php
                                                                if ($invoice_status == "unpaid") {
                                                                ?>
                                                                    <option selected value='unpaid'>Unpaid</option>
                                                                    <option value='paid'>Paid</option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value='unpaid'>Unpaid</option>
                                                                    <option selected value='paid'>Paid</option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
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

        //remove existing desc UI
        $(document).on('click', '.btn_remove', function() {
            var btn_id = $(this).attr("id");
            // console.log(btn_id);
            $('#desc-' + btn_id).remove();
            var sum = 0;
            $(".amount_change").each(function() {
                sum += Number($(this).val());
            });
            $(".total_amount").val(sum);
        });

        // clone desc input UI
        var i = 1;
        $('#addDesc').click(function() {
            i++;
            var clone = $('#clonedesc').clone().find('input').val('').end().find('select').val('').end();
            clone.attr("id", "clonedesc-" + i);
            clone.removeClass("d-none");
            clone.find('input').prop('required', true);
            clone.find('.inputdescName').attr('name', 'invoiceDescName[]');
            clone.find('.inputnumber').attr('name', 'invoiceDescPrice[]');
            clone.find('.inputnumber').addClass('amount_change');

            var removebtn = '<button type="button" id="' + i + '" class="ml-3 btn btn-danger btn-xs btn_remove_clone"><i class="fa fa-times"></i></button>';

            clone.find('#buttonDiv').append(removebtn);

            $('.desc_div').append(clone);
        });

        //remove desc clone UI
        $(document).on('click', '.btn_remove_clone', function() {
            var btn_id = $(this).attr("id");
            // console.log(btn_id);
            $('#clonedesc-' + btn_id).remove();
            var sum = 0;
            $(".amount_change").each(function() {
                sum += Number($(this).val());
            });
            $(".total_amount").val(sum);
        });

        // auto calculate total amount based the amount from desc 
        $(document).on('change keyup mouseup click', '.amount_change', function() {
            var sum = 0;
            $(".amount_change").each(function() {
                sum += Number($(this).val());
            });
            $(".total_amount").val(sum);
        });


        // edit invoice form
        $("#editInvoiceForm").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Confirm Edit?',
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('html, body').css("cursor", "wait");
                    $.ajax({
                        url: $("#editInvoiceForm").attr('action'),
                        type: $("#editInvoiceForm").attr('method'),
                        data: $("#editInvoiceForm").serialize(),
                        dataType: 'json'
                    }).done(function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            ).then(() => {
                                location.reload();
                            })
                            $('html, body').css("cursor", "auto");
                        } else {
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            )
                            $('html, body').css("cursor", "auto");
                        }
                    }).fail(function(xhr, textStatus, errorThrown) {
                        Swal.fire(
                            'Oops...',
                            'Something went wrong with ajax!',
                            'error'
                        )
                        $('html, body').css("cursor", "auto");
                        console.log(xhr);
                    })
                }
            })
        })
    </script>

</body>

</html>