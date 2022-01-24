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
    <title>Learning Resource</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <link href="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="text-themecolor">Learning Resource</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="PCalendar.php">Home</a></li>
                                <li class="breadcrumb-item active">Learning Resource</li>
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
                                <h4 class="card-title">Learning Resource List</h4>
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
                                                <th>Child</th>
                                                <th>Upload by</th>
                                                <th>Title</th>
                                                <th>Url</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $resource_num = 0;
                                            $userID = $_SESSION["userID"];
                                            $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                            if ($conn) {
                                                $sql = "SELECT * FROM LEARNING_RESOURCE LEFT JOIN CHILD ON LEARNING_RESOURCE.CHILD_ID = CHILD.CHILD_ID LEFT JOIN TEACHER ON LEARNING_RESOURCE.TEACHER_ID = TEACHER.TEACHER_ID WHERE CHILD.PARENT_ID = '$userID' ORDER BY LEARNING_RESOURCE.RESOURCE_ID DESC";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch_assoc()) {
                                                    $resource_num++;
                                                    $resource_id = $row["RESOURCE_ID"];
                                                    $child_name = $row["CHILD_NAME"];
                                                    $teacher_name = $row["TEACHER_NAME"];
                                                    $resource_title = $row["RESOURCE_TITLE"];
                                                    if ($row["RESOURCE_URL"] != null) {
                                                        $url = $row["RESOURCE_URL"];
                                                    } else {
                                                        $url = '-';
                                                    }
                                                    if ($row["RESOURCE_FILEPATH"] != null) {
                                                        $filepath = $row["RESOURCE_FILEPATH"];
                                                    } else {
                                                        $filepath = '-';
                                                    }

                                            ?>
                                                    <tr>
                                                        <td><?php echo $resource_num; ?></td>
                                                        <td><?php echo $child_name; ?></td>
                                                        <td><?php echo $teacher_name; ?></td>
                                                        <td><?php echo $resource_title; ?></td>
                                                        <?php
                                                        if ($url == '-') {
                                                        ?>
                                                            <td><?php echo $url; ?></td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td><a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $url; ?></a></td>
                                                        <?php
                                                        }
                                                        if ($filepath == '-') {
                                                        ?>
                                                            <td><?php echo $filepath; ?></td>
                                                        <?php
                                                        } else {
                                                            $path_parts = pathinfo($filepath);
                                                            $file_name = $path_parts['basename']
                                                        ?>
                                                            <td><a href="<?php echo $filepath; ?>" target="_blank" rel="noopener noreferrer"><?php echo $file_name; ?></a></td>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                die("FATAL ERROR");
                                            }
                                            $conn->close();
                                            ?>
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

        //set entries
        $('#table-entries').on('change', function(e) {
            e.preventDefault();
            var pageSize = $(this).val();
            $('#mytable').data('page-size', pageSize);
            $('#mytable').trigger('footable_initialized');
        });

        // var addrow = $('#mytable');
        // Search input
        $('#table-search').on('input', function(e) {
            e.preventDefault();
            $('#mytable').trigger('footable_filter', {
                filter: $(this).val()
            });
        });
    </script>

</body>

</html>