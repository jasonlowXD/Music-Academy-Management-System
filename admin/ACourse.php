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
                                                <table id="mytable" class="table m-t-5 table-hover contact-list" data-page-size="5">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Fee per month (RM)</th>
                                                            <th>Duration (min)</th>
                                                            <th>Status</th>
                                                            <th data-sort-ignore="true">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $userID = $_SESSION["userID"];
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID'";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $course_id = $row["COURSE_ID"];
                                                                $course_name = $row["COURSE_NAME"];
                                                                $course_fee = $row["COURSE_FEE"];
                                                                $course_duration = $row["COURSE_DURATION"];
                                                                $course_status = $row["COURSE_STATUS"];
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $course_id; ?></td>
                                                                    <td><?php echo $course_name; ?></td>
                                                                    <td><?php echo $course_fee; ?></td>
                                                                    <td><?php echo $course_duration; ?></td>
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
                                            <form class="form-material" id="addCourseForm" method="post" action="addCourse.php">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Course Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="courseName" class="form-control" placeholder="enter course name" required>
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
                                                        <label class="col-md-12" for="example-text">Course Duration (min)</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-text" name="courseDuration" class="form-control" placeholder="enter course duration" required>
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

                                                <div class="button-group">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <button type="reset" class="btn btn-dark waves-effect waves-light">Reset</button>
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
                    if (response.title == 'Done!') {
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