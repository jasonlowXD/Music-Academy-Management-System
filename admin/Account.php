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
    <title>Account Setting</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">

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
                        <h4 class="text-themecolor">Account Setting</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item active">Account</li>
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
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12">
                                        <h4><strong>Name</strong></h4>
                                        <p><?php echo $_SESSION["name"] ?></p>
                                    </div>
                                </div>
                                <hr>
                                <!-- /.row -->
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12">
                                        <h4><strong>Email Address</strong></h4>
                                        <p> <?php echo $_SESSION["email"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Edit Account Information</h5>
                                <form class="form-control-line" id="editAccountForm" method="post" action="editAccount.php">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Name</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" class="form-control text-muted" placeholder="enter admin name" value="<?php echo $_SESSION["name"] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="emailDiv">
                                        <div class="row">
                                            <label class="col-md-12" for="example-email">Admin Email</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="email" id="emailInput" name="email" class="form-control text-muted" placeholder="enter admin email (xxx@xxx.xxx)" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" value="<?php echo $_SESSION["email"] ?>" required>
                                                <span id="emailFeedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Change Password</h5>
                                <form class="form-control-line" id="editPasswordForm" method="post" action="editPass.php">
                                    <div class="form-group" id="oldPassDiv">
                                        <div class="row">
                                            <label class="col-md-12" for="example-old-password">Old Password</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="password" id="oldPassInput" name="oldPassword" class="form-control text-muted" placeholder="enter old password" value="" required>
                                                <span id="oldPassFeedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="newPassDiv">
                                        <div class="row">
                                            <label class="col-md-12" for="example-new-password">New Password</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="password" id="newPassInput" name="newPassword" class="form-control text-muted" placeholder="enter new password" value="" required>
                                                <span id="newPassFeedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                                </form>
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
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#editAccountForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                    url: $("#editAccountForm").attr('action'),
                    type: $("#editAccountForm").attr('method'),
                    data: $("#editAccountForm").serialize(),
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        emailRemoveClass();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        ).then(() => {
                            location.reload();
                        })
                    } else if (response.status == 'error') {
                        emailAddClass(response.message);
                    } else {
                        emailRemoveClass();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        )
                    }
                })
                .fail(function() {
                    Swal.fire(
                        'Oops...',
                        'Something went wrong with ajax !',
                        'error'
                    ).then(() => {
                        location.reload();
                    })
                })

        })

        $("#editPasswordForm").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Confirm Change Password?',
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            url: $("#editPasswordForm").attr('action'),
                            type: $("#editPasswordForm").attr('method'),
                            data: $("#editPasswordForm").serialize(),
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status == 'error' && response.title == 'Error new password') {
                                oldPassRemoveClass();
                                newPassAddClass(response.message);
                            } else if (response.status == 'error' && response.title == 'Error old password') {
                                newPassRemoveClass();
                                oldPassAddClass(response.message);
                            } else if (response.status == 'success') {
                                oldPassRemoveClass();
                                newPassRemoveClass();
                                Swal.fire(
                                    response.title,
                                    response.message,
                                    response.status
                                ).then(() => {
                                    location.reload();
                                })
                            }
                        })
                        .fail(function() {
                            Swal.fire(
                                'Oops...',
                                'Something went wrong with ajax !',
                                'error'
                            ).then(() => {
                                location.reload();
                            })
                        })
                }
            })
        })
    </script>

</body>

</html>