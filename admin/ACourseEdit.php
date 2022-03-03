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
    <title>Edit course</title>
    <link href="../assets/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="text-themecolor">Edit Course</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="ACourse.php">Course</a></li>
                                <li class="breadcrumb-item active">Edit Course</li>
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
                $course_id = $_GET["course_id"];
                $conn = mysqli_connect("localhost", "root", "", "music_academy");

                if ($conn) {
                    $sql = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_ID = '$course_id'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $course_name = $row["COURSE_NAME"];
                        $course_fee = $row["COURSE_FEE"];
                        $duration_per_class = $row["DURATION_PER_CLASS"];
                        $course_desc = $row["COURSE_DESC"];
                        $course_status = $row["COURSE_STATUS"];
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
                                <h5 class="card-title text-uppercase">Edit Course Information</h5>
                                <form class="form-control-line" id="editCourseForm" method="post" action="editCourse.php?course_id=<?= $course_id ?>">
                                    <div class="form-group">
                                        <div class="row" id="courseNameDiv">
                                            <label class="col-md-12" for="example-text">Course Name</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="text" id="courseNameInput" name="courseName" class="form-control text-muted" placeholder="enter course name" value="<?php echo $course_name; ?>" required>
                                                <span id="courseNameFeedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Course Fee per Month (RM)</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="number" id="example-text" name="courseFee" class="form-control text-muted" placeholder="enter course fee" value="<?php echo $course_fee; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-text">Duration Per Class (min)</span>
                                            </label>
                                            <div class="col-md-12">
                                                <input type="number" id="example-text" name="duration" class="form-control text-muted" placeholder="enter duration" value="<?php echo $duration_per_class; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control text-muted" name="courseDesc" rows="5" placeholder="enter course description (max: 500 words)" maxlength="500" required><?php echo $course_desc; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='control-label'>Select Teacher</label>
                                        <select id="teacher_selector" class='select2 select2-multiple' name='courseTeacher[]' style="width: 100%" multiple="multiple">
                                            <?php
                                            $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                            if ($conn) {
                                                $sql2 = "SELECT * FROM TEACHER WHERE ADMIN_ID = '$userID' AND TEACHER_STATUS ='active'";
                                                $result2 = $conn->query($sql2);
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    $flag = false;
                                                    $teacher_id = $row2["TEACHER_ID"];
                                                    $teacher_name = $row2["TEACHER_NAME"];

                                                    $sql3 = "SELECT * FROM TEACHER_COURSE WHERE COURSE_ID = '$course_id'";
                                                    $result3 = $conn->query($sql3);
                                                    while ($row3 = $result3->fetch_assoc()) {
                                                        $bridge_teacher_id = $row3["TEACHER_ID"];
                                                        if ($teacher_id == $bridge_teacher_id) {
                                                            $flag = true;
                                                            break;
                                                        } else {
                                                            $flag = false;
                                                        }
                                                    }
                                                    if ($flag == true) {
                                            ?>
                                                        <option value="<?php echo $teacher_id ?>" selected><?php echo $teacher_name ?></option>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <option value="<?php echo $teacher_id ?>"><?php echo $teacher_name ?></option>
                                            <?php
                                                    }
                                                }
                                            } else {
                                                die("FATAL ERROR");
                                            }
                                            $conn->close();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-md-12" for="example-phone">Course Status</span>
                                            </label>
                                            <div class="col-md-12">
                                                <select class='form-control' name='courseStatus' required>
                                                    <?php
                                                    if ($course_status == "active") {
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
                                        <a href="ACourse.php" type="button" class="btn btn-primary waves-effect waves-light">Return</a>
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
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../assets/select2/dist/js/select2.full.min.js" type="text/javascript"></script>


    <script>
        // For select 2
        $(".select2").select2();

        $("#editCourseForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#editCourseForm").attr('action'),
                    type: $("#editCourseForm").attr('method'),
                    data: $("#editCourseForm").serialize(),
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        courseNameRemoveClass();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        ).then(() => {
                            window.location.href = "ACourse.php";
                        })
                        $('html, body').css("cursor", "auto");
                    } else if (response.status == 'error' && response.title == 'Error course name') {
                        courseNameAddClass(response.message);
                        $('html, body').css("cursor", "auto");
                    } else {
                        courseNameRemoveClass();
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