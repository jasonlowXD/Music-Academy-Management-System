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
    <title>Manage course</title>
    <!-- page css -->
    <link href="../dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="../dist/css/pages/tab-page.css" rel="stylesheet">
    <link href="../assets/node_modules/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
    <!-- Footable CSS -->
    <link href="../assets/node_modules/footable/css/footable.core.css" rel="stylesheet">
    <link href="../assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <link href="../dist/css/style.css" rel="stylesheet">

    <style>
        .teacherTable td {
            padding: 0px !important;
            border-top: 0px !important;
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
                        <h4 class="text-themecolor">Course Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item active">Course</li>
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="courseTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#courselist" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Course List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addcourse" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-plus"></i></span> <span class="hidden-xs-down">Add New Course</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- course list panel -->
                                    <div class="tab-pane active" id="courselist" role="tabpanel">
                                        <div class="p-20">
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
                                                <table id="mytable" class="table m-t-5 table-hover contact-list toggle-arrow-tiny" data-page-size="5">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Fee per month (RM)</th>
                                                            <th>Duration (min)</th>
                                                            <th>Status</th>
                                                            <th data-sort-ignore="true">Action</th>
                                                            <th data-hide="all">Current active teacher</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $course_num = 0;
                                                        $userID = $_SESSION["userID"];
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID' ORDER BY COURSE_NAME";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $course_num++;
                                                                $course_id = $row["COURSE_ID"];
                                                                $course_name = $row["COURSE_NAME"];
                                                                $course_fee = $row["COURSE_FEE"];
                                                                $duration_per_class = $row["DURATION_PER_CLASS"];
                                                                $course_status = $row["COURSE_STATUS"];
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $course_num; ?></td>
                                                                    <td><?php echo $course_name; ?></td>
                                                                    <td><?php echo $course_fee; ?></td>
                                                                    <td><?php echo $duration_per_class; ?></td>
                                                                    <?php
                                                                    if ($course_status == "active") {
                                                                    ?>
                                                                        <td><span class="label label-success"><?php echo $course_status; ?></span></td>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <td><span class="label label-danger"><?php echo $course_status; ?></span></td>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <td>
                                                                        <a href="ACourseDetails.php?course_id=<?= $course_id ?>" type="button" class="btn btn-outline-success"><i class="ti-info-alt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                                        <a href="ACourseEdit.php?course_id=<?= $course_id ?>" type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                                    </td>

                                                                    <!-- teacher table part  -->
                                                                    <td>
                                                                        <table class="teacherTable">
                                                                            <tr>
                                                                                <td>
                                                                                    <ul>
                                                                                        <?php
                                                                                        $sql2 = "SELECT * FROM TEACHER_COURSE LEFT JOIN TEACHER ON TEACHER.TEACHER_ID = TEACHER_COURSE.TEACHER_ID WHERE TEACHER_COURSE.COURSE_ID = '$course_id' AND TEACHER.TEACHER_STATUS = 'active'";
                                                                                        $result2 = $conn->query($sql2);
                                                                                        while ($row2 = $result2->fetch_assoc()) {
                                                                                            $teacher_name = $row2["TEACHER_NAME"];
                                                                                        ?>
                                                                                            <li>
                                                                                                <?php echo $teacher_name; ?>
                                                                                            </li>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </ul>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        } else {
                                                            die("FATAL ERROR");
                                                        }

                                                        $conn->close();
                                                        ?>

                                                        <!-- <tr>
                                                            <td>1</td>
                                                            <td>Piano Grade 1</td>
                                                            <td>150</td>
                                                            <td>30</td>
                                                            <td><span class="label label-success">Active</span></td>
                                                            <td>
                                                                <div class="button-group">
                                                                    <a href="ACourseDetails.php" type="button" class="btn btn-outline-success"><i class="ti-info-alt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                                    <a href="ACourseEdit.php" type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr> -->

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
                                    <!-- add course panel -->
                                    <div class="tab-pane" id="addcourse" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-control-line" id="addCourseForm" method="post" action="addCourse.php">
                                                <div class="form-group">
                                                    <div class="row" id="courseNameDiv">
                                                        <label class="col-md-12" for="example-text">Course Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="courseNameInput" name="courseName" class="form-control" placeholder="enter course name" required>
                                                            <span id="courseNameFeedback"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Course Fee per Month (RM)</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-text" name="courseFee" class="form-control" placeholder="enter course fee" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Duration Per Class (min)</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-text" name="duration" class="form-control" placeholder="enter duration" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12">Description</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="courseDesc" rows="5" placeholder="enter course description (max: 500 words)" maxlength="500" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Teacher</label>
                                                    <select id="teacher_selector" class='select2 select2-multiple' name='courseTeacher[]' style="width: 100%" multiple="multiple">
                                                        <?php
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql3 = "SELECT * FROM TEACHER WHERE ADMIN_ID = '$userID' AND TEACHER_STATUS ='active'";
                                                            $result3 = $conn->query($sql3);
                                                            while ($row3 = $result3->fetch_assoc()) {
                                                                $teacher_id = $row3["TEACHER_ID"];
                                                                $teacher_name = $row3["TEACHER_NAME"];
                                                        ?>
                                                                <option value="<?php echo $teacher_id ?>"><?php echo $teacher_name ?></option>
                                                        <?php
                                                            }
                                                        } else {
                                                            die("FATAL ERROR");
                                                        }
                                                        $conn->close();
                                                        ?>
                                                    </select>
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

    <script src="../assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script>
        // tab panel javascript
        // $('a[data-toggle="tab"]').click(function(e) {
        //     e.preventDefault();
        //     $(this).tab('show');
        // });

        // $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
        //     var id = $(e.target).attr("href");
        //     sessionStorage.setItem('selectedTab', id)
        // });
        // var selectedTab = sessionStorage.getItem('selectedTab');
        // if (selectedTab != null) {
        //     $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
        // }

        ///////////////////////////////////////////////////////////////
        // For select 2
        $(".select2").select2();

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

        $('#btnReset').click(function() {
            courseNameRemoveClass();
            $("#teacher_selector").val("");
            $("#teacher_selector").trigger("change");
        });

        // Accordion
        // -----------------------------------------------------------------
        $('#mytable').footable().on('footable_row_expanded', function(e) {
            $('#mytable tbody tr.footable-detail-show').not(e.row).each(function() {
                $('#mytable').data('footable').toggleDetail(this);
            });
        });

        $("#addCourseForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#addCourseForm").attr('action'),
                    type: $("#addCourseForm").attr('method'),
                    data: $("#addCourseForm").serialize(),
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
                            location.reload();
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
                    // alert(errorThrown);
                })
        })
    </script>

</body>

</html>