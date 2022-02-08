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
    <title>Child List</title>
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
                        <h4 class="text-themecolor">Child List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="PCalendar.php">Home</a></li>
                                <li class="breadcrumb-item active">Child</li>
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
                                <h4 class="card-title">Child List</h4>
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
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Teacher</th>
                                                <th>Course</th>
                                                <th>Status</th>
                                                <th data-sort-ignore="true">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $children_num = 0;
                                            $userID = $_SESSION["userID"];
                                            $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                            if ($conn) {
                                                $sql = "SELECT * FROM CHILD LEFT JOIN TEACHER ON CHILD.TEACHER_ID = TEACHER.TEACHER_ID LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID WHERE PARENT_ID = '$userID' ORDER BY CHILD_ID DESC";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    $children_num++;
                                                    $child_id = $row["CHILD_ID"];
                                                    $child_name = $row["CHILD_NAME"];
                                                    $child_age = $row["CHILD_AGE"];
                                                    $teacher_name = $row["TEACHER_NAME"];
                                                    $course_id = $row["COURSE_ID"];
                                                    $course_name = $row["COURSE_NAME"];
                                                    $child_status = $row["CHILD_STATUS"];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $children_num; ?></td>
                                                        <td><?php echo $child_name; ?></td>
                                                        <td><?php echo $child_age; ?></td>
                                                        <td><?php echo $teacher_name; ?></td>
                                                        <td><?php echo $course_name; ?></td>
                                                        <?php
                                                        if ($child_status == "active") {
                                                        ?>
                                                            <td><span class="label label-success"><?php echo $child_status; ?></span></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td><span class="label label-danger"><?php echo $child_status; ?></span></td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td><a href="PCourseDetails.php?course_id=<?= $course_id ?>" type="button" class="btn btn-outline-success"><i class="ti-info-alt" style="font-size:18px;" aria-hidden="true"></i></a></td>
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
                                                <td>Children A</td>
                                                <td>12</td>
                                                <td>Teacher ABC</td>
                                                <td>Piano Grade 1</td>
                                                <td><a href="PCourseDetails.php" type="button" class="btn btn-outline-success"><i class="ti-info-alt" style="font-size:18px;" aria-hidden="true"></i></a></td>
                                            </tr> -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="8">
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