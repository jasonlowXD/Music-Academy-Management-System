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
    <title>Manage teacher</title>
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
                        <h4 class="text-themecolor">Teacher Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item active">Teacher</li>
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
                                <ul class="nav nav-tabs" role="tablist" id="teacherTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#teacherlist" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Teacher List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addteacher" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-plus"></i></span> <span class="hidden-xs-down">Add New Teacher</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- teacher list panel -->
                                    <div class="tab-pane active" id="teacherlist" role="tabpanel">
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
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Status</th>
                                                            <th data-sort-ignore="true">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $userID = $_SESSION["userID"];
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql = "SELECT * FROM TEACHER WHERE ADMIN_ID = '$userID'";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $teacher_id = $row["TEACHER_ID"];
                                                                $teacher_name = $row["TEACHER_NAME"];
                                                                $teacher_email = $row["TEACHER_EMAIL"];
                                                                $teacher_phone = $row["TEACHER_PHONE_NUM"];
                                                                $teacher_status = $row["TEACHER_STATUS"];
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $teacher_id; ?></td>
                                                                    <td><?php echo $teacher_name; ?></td>
                                                                    <td><?php echo $teacher_email; ?></td>
                                                                    <td><?php echo $teacher_phone; ?></td>
                                                                    <?php
                                                                    if ($teacher_status == "active") {
                                                                    ?>
                                                                        <td><span class="label label-success"><?php echo $teacher_status; ?></span></td>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <td><span class="label label-danger"><?php echo $teacher_status; ?></span></td>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <td>
                                                                        <a href="ATeacherEdit.php?teacher_id=<?= $teacher_id ?>" type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" style="font-size:18px;" aria-hidden="true"></i></a>
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
                                                            <td>2</td>
                                                            <td>tasd</td>
                                                            <td>aaa@gmail.com</td>
                                                            <td>+1 789</td>
                                                            <td><span class="label label-danger">Inactive</span></td>
                                                            <td>
                                                                <a href="ATeacherEdit.php" type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" style="font-size:18px;" aria-hidden="true"></i></a>
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
                                    <!-- add teacher panel -->
                                    <div class="tab-pane" id="addteacher" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-control-line" id="addTeacherForm" method="post" action="addTeacher.php">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Teacher Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="teacherName" class="form-control" placeholder="enter teacher name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="emailDiv">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-email">Teacher Email</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="email" id="emailInput" name="teacherEmail" class="form-control" placeholder="enter teacher email (xxx@xxx.xxx)" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                                                            <span id="emailFeedback"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="phoneDiv">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-phone">Teacher Phone Number</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="phoneInput" name="teacherPhone" class="form-control" placeholder="01x-xxxxxxx OR 011-xxxxxxxx" pattern="^(01)[02-46-9][-][0-9]{7}$|^(01)[1][-][0-9]{8}$" required>
                                                            <span id="phoneFeedback"></span>
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

        $("#addTeacherForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#addTeacherForm").attr('action'),
                    type: $("#addTeacherForm").attr('method'),
                    data: $("#addTeacherForm").serialize(),
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
                            location.reload();
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
    </script>

</body>

</html>