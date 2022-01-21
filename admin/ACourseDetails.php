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
    <title>Course Details</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <style>
        .border-right {
            border-right: 2px solid #d1d1d1   !important;
        }
    </style>

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
                        <h4 class="text-themecolor">Course Details</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="ACourse.php">Course</a></li>
                                <li class="breadcrumb-item active">Course Details</li>
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
                                $course_id = $_GET["course_id"];
                                $userID = $_SESSION["userID"];
                                $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                if ($conn) {
                                    $sql = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_ID = '$course_id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $course_name = $row["COURSE_NAME"];
                                        $course_fee = $row["COURSE_FEE"];
                                        $duration_per_class = $row["DURATION_PER_CLASS"];
                                        $course_status = $row["COURSE_STATUS"];
                                        $course_desc = $row["COURSE_DESC"];
                                        $course_desc = str_replace("\n", "<br/>", $course_desc);
                                ?>
                                        <div class="row">
                                            <div class="col-md-4 border-right">
                                                <h4><strong>Course Name</strong></h4>
                                                <p class="text-muted"><?php echo $course_name; ?></p>
                                            </div>
                                            <div class="col-md-4 border-right">
                                                <h4><strong>Course Fee per Month (RM)</strong></h4>
                                                <p class="text-muted"><?php echo $course_fee; ?></p>
                                            </div>
                                            <div class="col-md-4">
                                                <h4><strong>Duration Per Class (min)</strong></h4>
                                                <p class="text-muted"><?php echo $duration_per_class; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <h4><strong>Description</strong></h4>
                                                <p class="text-muted text-justify"><?php echo $course_desc; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-4">
                                            <div class="col-md-6 border-right">
                                                <h4><strong>Course Status</strong></h4>
                                                <?php
                                                if ($course_status == "active") {
                                                ?>
                                                    <h4><span class="label label-success"><?php echo $course_status; ?></span></h4>
                                                <?php
                                                } else {
                                                ?>
                                                    <h4><span class="label label-danger"><?php echo $course_status; ?></span></h4>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <h4><strong>Current active teacher</strong></h4>
                                                <ul>
                                                    <?php
                                                    $sql2 = "SELECT * FROM TEACHER_COURSE LEFT JOIN TEACHER ON TEACHER.TEACHER_ID = TEACHER_COURSE.TEACHER_ID WHERE TEACHER_COURSE.COURSE_ID = '$course_id' AND TEACHER.TEACHER_STATUS = 'active'";
                                                    $result2 = $conn->query($sql2);
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                        $teacher_name = $row2["TEACHER_NAME"];
                                                    ?>
                                                        <li class="text-muted">
                                                            <?php echo $teacher_name; ?>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="button-group">
                                            <a href="ACourseEdit.php?course_id=<?= $course_id ?>" type="button" class="btn btn-info waves-effect waves-light">Edit Course</a>
                                            <a href="ACourse.php" type="button" class="btn btn-primary waves-effect waves-light">Return</a>
                                        </div>
                                <?php
                                    }
                                } else {
                                    die("FATAL ERROR");
                                }

                                $conn->close();
                                ?>

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

</body>

</html>