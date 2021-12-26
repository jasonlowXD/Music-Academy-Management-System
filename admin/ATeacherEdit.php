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
    <title>Edit teacher</title>
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
                        <h4 class="text-themecolor">Edit Teacher</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="ATeacher.php">Teacher</a></li>
                                <li class="breadcrumb-item active">Edit Teacher</li>
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
                <?php
                $userID = $_SESSION["userID"];
                $teacher_id = $_GET["teacher_id"];
                $conn = mysqli_connect("localhost", "root", "", "music_academy");

                if ($conn) {
                    $sql = "SELECT * FROM TEACHER WHERE TEACHER_ID = '$teacher_id' AND ADMIN_ID = '$userID'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $teacher_name = $row["TEACHER_NAME"];
                        $teacher_email = $row["TEACHER_EMAIL"];
                        $teacher_phone = $row["TEACHER_PHONE_NUM"];
                        $teacher_status = $row["TEACHER_STATUS"];
                    }
                } else {
                    die("FATAL ERROR");
                }
                $conn->close();
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Edit Teacher Information</h5>
                                <form class="form-control-line" id="editTeacherForm" method="post" action="editTeacher.php?teacher_id=<?= $teacher_id ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Name</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="example-text" name="teacherName" class="form-control text-muted" placeholder="enter teacher name" value="<?php echo $teacher_name; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="emailDiv">
                                        <div class="row">
                                            <label class="col-md-12" for="example-email">Teacher Email</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="email" id="emailInput" name="teacherEmail" class="form-control text-muted" placeholder="enter teacher email (xxx@xxx.xxx)" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" value="<?php echo $teacher_email; ?>" required>
                                                <span id="emailFeedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="phoneDiv">
                                        <div class="row">
                                            <label class="col-md-12" for="example-phone">Teacher Phone Number</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="phoneInput" name="teacherPhone" class="form-control text-muted" placeholder="01x-xxxxxxx OR 011-xxxxxxxx" pattern="^(01)[02-46-9][-][0-9]{7}$|^(01)[1][-][0-9]{8}$" value="<?php echo $teacher_phone; ?>" required>
                                                <span id="phoneFeedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12">Teacher Status</span>
                                            </label>
                                            <div class="col-md-12">
                                                <select class='form-control' name='teacherStatus' required>
                                                    <?php
                                                    if ($teacher_status == "active") {
                                                    ?>
                                                        <option selected value='active'>Active</option>
                                                        <option value='inactive'>Inactive</option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value='active'>Active</option>
                                                        <option selected value='inactive'>Inactive</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                        <a href="ATeacher.php" type="button" class="btn btn-primary waves-effect waves-light">Return</a>
                                    </div>
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
        $("#editTeacherForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#editTeacherForm").attr('action'),
                    type: $("#editTeacherForm").attr('method'),
                    data: $("#editTeacherForm").serialize(),
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        emailRemoveClass();
                        phoneRemoveClass();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        ).then(() => {
                            window.location.href = "ATeacher.php";
                        })
                        $('html, body').css("cursor", "auto");
                    } else if (response.status == 'error' && response.title == 'Error email') {
                        emailAddClass(response.message);
                        phoneRemoveClass();
                        $('html, body').css("cursor", "auto");
                    } else if (response.status == 'error' && response.title == 'Error phone') {
                        phoneAddClass(response.message);
                        emailRemoveClass();
                        $('html, body').css("cursor", "auto");
                    } else {
                        emailRemoveClass();
                        phoneRemoveClass();
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
                    // alert(errorThrown);
                })
        })

        // $("#editTeacherForm").submit(function(e) {
        //     e.preventDefault();
        //     Swal.fire({
        //         title: 'Confirm Edit?',
        //         icon: 'warning',
        //         allowOutsideClick: false,
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, confirm!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // DO EDIT TEACHER HERE THEN FIRE SWAL
        //             Swal.fire(
        //                 'Done!',
        //                 'Teacher Edited.',
        //                 'success'
        //             ).then(() => {
        //                 window.location.href = "ATeacher.php";
        //             })
        //         }
        //     })
        // })
    </script>

</body>

</html>