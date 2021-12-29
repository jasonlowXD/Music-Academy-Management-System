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
    <title>Manage Parent&Children</title>
    <!-- Footable CSS -->
    <link href="../assets/node_modules/footable/css/footable.core.css" rel="stylesheet">
    <link href="../assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <!-- page css -->
    <link href="../dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="../dist/css/pages/tab-page.css" rel="stylesheet">
    <style>
        .childrenTable th {
            padding-top: 0px !important;
            padding-bottom: 5px !important;
            border-top: 0px !important;
            border-bottom: 1px solid #d9d9d9;
        }

        .childrenTable td {
            padding-top: 5px !important;
            padding-bottom: 3px !important;
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
                        <h4 class="text-themecolor">Parent & Children Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item active">Parent&Children</li>
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
                                        <a class="nav-link active" data-toggle="tab" href="#parentlist" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Parent List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addParent" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-plus"></i></span> <span class="hidden-xs-down">Add New Parent</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- parent list panel -->
                                    <div class="tab-pane active" id="parentlist" role="tabpanel">
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
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Status</th>
                                                            <th data-sort-ignore="true">Action</th>
                                                            <th data-hide="all">Children</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $userID = $_SESSION["userID"];
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql = "SELECT * FROM PARENT WHERE ADMIN_ID = '$userID'";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $parent_id = $row["PARENT_ID"];
                                                                $parent_name = $row["PARENT_NAME"];
                                                                $parent_email = $row["PARENT_EMAIL"];
                                                                $parent_phone = $row["PARENT_PHONE_NUM"];
                                                                $parent_status = $row["PARENT_STATUS"];
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $parent_id; ?></td>
                                                                    <td><?php echo $parent_name; ?></td>
                                                                    <td><?php echo $parent_email; ?></td>
                                                                    <td><?php echo $parent_phone; ?></td>
                                                                    <?php
                                                                    if ($parent_status == "active") {
                                                                    ?>
                                                                        <td><span class="label label-success"><?php echo $parent_status; ?></span></td>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <td><span class="label label-danger"><?php echo $parent_status; ?></span></td>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <td>
                                                                        <a href="AParentEdit.php?parent_id=<?= $parent_id ?>" type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                                    </td>
                                                                    <!-- children table part  -->
                                                                    <td>
                                                                        <table class="childrenTable">
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Age</th>
                                                                                <th>Course</th>
                                                                                <th>Teacher</th>
                                                                                <th>Status</th>
                                                                                <th>Relationship</th>
                                                                            </tr>
                                                                            <?php

                                                                            $sql2 = "SELECT * FROM CHILD LEFT JOIN TEACHER ON CHILD.TEACHER_ID = TEACHER.TEACHER_ID LEFT JOIN COURSE ON CHILD.COURSE_ID = COURSE.COURSE_ID LEFT JOIN PARENT ON CHILD.PARENT_ID = PARENT.PARENT_ID WHERE CHILD.PARENT_ID = '$parent_id' ";
                                                                            $result2 = $conn->query($sql2);
                                                                            while ($row2 = $result2->fetch_assoc()) {
                                                                                $child_name = $row2["CHILD_NAME"];
                                                                                $child_age = $row2["CHILD_AGE"];
                                                                                $course_name = $row2["COURSE_NAME"];
                                                                                $teacher_name = $row2["TEACHER_NAME"];
                                                                                $child_status = $row2["CHILD_STATUS"];
                                                                                $relationship = $row2["PARENT_RELATIONSHIP"];
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $child_name; ?></td>
                                                                                    <td><?php echo $child_age; ?></td>
                                                                                    <td><?php echo $course_name; ?></td>
                                                                                    <td><?php echo $teacher_name; ?></td>
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
                                                                                    <td><?php echo $relationship; ?></td>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                            ?>
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
                                                            <td>parenta</td>
                                                            <td>parentA@gmail.com</td>
                                                            <td>+123 456 789</td>
                                                            <td><span class="label label-success">Active</span></td>
                                                            <td>
                                                                <a href="AParentEdit.php" type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" style="font-size:18px;" aria-hidden="true"></i></a>
                                                            </td>
                                                            <td>
                                                                <table class="childrenTable">
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Age</th>
                                                                        <th>Course</th>
                                                                        <th>Teacher</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>childrenABC</td>
                                                                        <td>15</td>
                                                                        <td>Piano Grade 1</td>
                                                                        <td>teacher A</td>
                                                                        <td><span class="label label-success">Active</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>childrenBBC</td>
                                                                        <td>15</td>
                                                                        <td>Piano Grade 1</td>
                                                                        <td>teacher A</td>
                                                                        <td><span class="label label-danger">Inactive</span></td>
                                                                    </tr>
                                                                </table>
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
                                    <!-- add parent panel -->
                                    <div class="tab-pane" id="addParent" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-control-line" id="addParentForm" method="post" action="addParent.php">
                                                <!-- parent form -->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Parent Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="parentName" class="form-control" placeholder="enter parent name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="emailDiv">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-email">Parent Email</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="email" id="emailInput" name="parentEmail" class="form-control" placeholder="enter teacher email (xxx@xxx.xxx)" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                                                            <span id="emailFeedback"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="phoneDiv">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-phone">Parent Phone Number</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="phoneInput" name="parentPhone" class="form-control" placeholder="01x-xxxxxxx OR 011-xxxxxxxx" pattern="^(01)[02-46-9][-][0-9]{7}$|^(01)[1][-][0-9]{8}$" required>
                                                            <span id="phoneFeedback"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Relationship</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="parentRelationship" class="form-control" placeholder="Relationship with children (ex: mother)" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- children form -->
                                                <div class="childrenDiv">
                                                    <div id="cloneChildrenForm">
                                                        <hr class="m-t-40">
                                                        <div class="d-flex no-block align-items-center" id="childrenHeaderDiv">
                                                            <h4 class="card-title">Child Info</h4>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-md-12" for="example-text">Child Name</span>
                                                                </label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="example-text" name="childrenName[]" class="form-control" placeholder="enter child name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-md-12" for="example-age">Child Age</span>
                                                                </label>
                                                                <div class="col-md-12">
                                                                    <input type="number" id="example-age" name="childrenAge[]" class="form-control" placeholder="enter child age" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label class='control-label'>Select Course</label>
                                                            <select class='form-control' name='childrenCourse[]' required>
                                                                <option hidden disabled selected value=""> -- select a course -- </option>
                                                                <?php
                                                                $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                                if ($conn) {
                                                                    $sql3 = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_STATUS ='active'";
                                                                    $result3 = $conn->query($sql3);
                                                                    while ($row3 = $result3->fetch_assoc()) {
                                                                        $course_id = $row3["COURSE_ID"];
                                                                        $course_name = $row3["COURSE_NAME"];
                                                                ?>
                                                                        <option value="<?php echo $course_id ?>"><?php echo $course_name ?></option>
                                                                <?php
                                                                    }
                                                                } else {
                                                                    die("FATAL ERROR");
                                                                }
                                                                $conn->close();
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label class='control-label'>Select Teacher</label>
                                                            <select class='form-control' name='childrenTeacher[]' required>
                                                                <option hidden disabled selected value=""> -- select a teacher -- </option>
                                                                <?php
                                                                $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                                if ($conn) {
                                                                    $sql4 = "SELECT * FROM TEACHER WHERE ADMIN_ID = '$userID' AND TEACHER_STATUS ='active'";
                                                                    $result4 = $conn->query($sql4);
                                                                    while ($row4 = $result4->fetch_assoc()) {
                                                                        $teacher_id = $row4["TEACHER_ID"];
                                                                        $teacher_name = $row4["TEACHER_NAME"];
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
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <button type="reset" id="btnReset" class="btn btn-dark waves-effect waves-light">Reset</button>
                                                    <button type="button" id="addChildren" class="btn btn-primary waves-effect waves-light">Add Children</button>
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

        $('#btnReset').click(function() {
            emailRemoveClass();
            phoneRemoveClass();
        });

        // Accordion
        // -----------------------------------------------------------------
        $('#mytable').footable().on('footable_row_expanded', function(e) {
            $('#mytable tbody tr.footable-detail-show').not(e.row).each(function() {
                $('#mytable').data('footable').toggleDetail(this);
            });
        });
        // clone children input UI
        var i = 1;
        $('#addChildren').click(function() {
            i++;
            var clone = $('#cloneChildrenForm').clone().find('input').val('').end();
            clone.attr("id", "cloneChildrenForm-" + i);

            var removebtn = '<button type="button" id="' + i + '" class="btn btn-danger btn-xs ml-auto btn_remove"><i class="fa fa-times"></i></button>';

            clone.find('#childrenHeaderDiv').append(removebtn);

            $('.childrenDiv').append(clone);
        });

        //remove children clone UI
        $(document).on('click', '.btn_remove', function() {
            var btn_id = $(this).attr("id");
            console.log(btn_id);
            $('#cloneChildrenForm-' + btn_id).remove();
        });


        $("#addParentForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#addParentForm").attr('action'),
                    type: $("#addParentForm").attr('method'),
                    data: $("#addParentForm").serialize(),
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
                    // alert(errorThrown);
                    // console.log(xhr);
                    $('html, body').css("cursor", "auto");
                })
        })


        // TEST GET MULTIPLE CHILDREN VALUE
        // https://stackoverflow.com/questions/2627813/how-to-get-an-array-with-jquery-multiple-input-with-the-same-name
        // $('#addParentForm').on('submit', function() {
        //     var form = $('#addParentForm');

        //     var childrenName = form.find('input[name="childrenName[]"]');
        //     var childrenAge = form.find('input[name="childrenAge[]"]');
        //     var childrenCourse = form.find('select[name="childrenCourse[]"]');
        //     var childrenTeacher = form.find('select[name="childrenTeacher[]"]');

        //     var name = childrenName.map(function() {
        //         return $(this).val()
        //     }).get();
        //     console.log(name);

        //     var age = childrenAge.map(function() {
        //         return $(this).val()
        //     }).get();
        //     console.log(age);

        //     // var course = childrenCourse.val();

        //     var course = childrenCourse.map(function() {
        //         return $(this).find(":selected").val();
        //     }).get();
        //     console.log(course);

        //     var teacher = childrenTeacher.map(function() {
        //         return $(this).find(":selected").val();
        //     }).get();
        //     console.log(teacher);

        //     return false;
        // });
    </script>

</body>

</html>