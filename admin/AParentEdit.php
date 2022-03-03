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
    <title>Edit Parent & Child</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/file-upload.css" rel="stylesheet">
    <link href="../dist/css/tab-page.css" rel="stylesheet">

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
                        <h4 class="text-themecolor">Edit Parent & Child</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="AParent.php">Parent & Child</a></li>
                                <li class="breadcrumb-item active">Edit Parent & Child</li>
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
                $parent_id = $_GET["parent_id"];
                $conn = mysqli_connect("localhost", "root", "", "music_academy");

                if ($conn) {
                    $sql = "SELECT * FROM PARENT WHERE PARENT_ID = '$parent_id' AND ADMIN_ID = '$userID'";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $parent_name = $row["PARENT_NAME"];
                        $parent_email = $row["PARENT_EMAIL"];
                        $parent_phone = $row["PARENT_PHONE_NUM"];
                        $parent_status = $row["PARENT_STATUS"];
                        $parent_relationship = $row["PARENT_RELATIONSHIP"];
                    }
                } else {
                    die("FATAL ERROR");
                }
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="parentTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#editParent" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Edit Parent</span>
                                        </a>
                                    </li>

                                    <?php
                                    $children = 0;
                                    $childId = array();
                                    $childName = array();
                                    $childAge = array();
                                    $childCourse = array();
                                    $childTeacher = array();
                                    $childStatus = array();
                                    if ($conn) {
                                        $sql2 = "SELECT * FROM CHILD WHERE PARENT_ID = '$parent_id'";
                                        $result2 = $conn->query($sql2);
                                        while ($row2 = $result2->fetch_assoc()) {
                                            $childId[] = $row2["CHILD_ID"];
                                            $childName[] = $row2["CHILD_NAME"];
                                            $childAge[] = $row2["CHILD_AGE"];
                                            $childTeacher[] = $row2["TEACHER_ID"];
                                            $childCourse[] = $row2["COURSE_ID"];
                                            $childStatus[] = $row2["CHILD_STATUS"];
                                            $children++;
                                        }
                                    } else {
                                        die("FATAL ERROR");
                                    }
                                    // echo $children;
                                    ?>

                                    <!-- for children nav-link, get children data from database, use looping to display based on number of children -->
                                    <?php
                                    for ($x = 0; $x < $children; $x++) {
                                        // echo  $childId[$x];
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#<?php echo $childId[$x] ?>" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-pencil-alt"></i></span> <span class="hidden-xs-down"><?php echo $childName[$x] ?></span>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <!-- loop1 -->
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Children ABC" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-pencil-alt"></i></span> <span class="hidden-xs-down">Children ABC</span>
                                        </a>
                                    </li> -->

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addChildren" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-plus"></i></span> <span class="hidden-xs-down">Add New Child</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- edit parent tab -->
                                    <div class="tab-pane active" id="editParent" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-control-line" id="editParentForm" method="post" action="editParent.php?parent_id=<?= $parent_id ?>">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Parent Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="parentName" class="form-control text-muted" placeholder="enter parent name" value="<?php echo $parent_name; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="emailDiv">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-email">Parent Email</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="email" id="emailInput" name="parentEmail" class="form-control text-muted" placeholder="enter teacher email (xxx@xxx.xxx)" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" value="<?php echo $parent_email; ?>" required>
                                                            <span id="emailFeedback"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="phoneDiv">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-phone">Parent Phone Number</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="phoneInput" name="parentPhone" class="form-control text-muted" placeholder="01x-xxxxxxx OR 011-xxxxxxxx" pattern="^(01)[02-46-9][-][0-9]{7}$|^(01)[1][-][0-9]{8}$" value="<?php echo $parent_phone; ?>" required>
                                                            <span id="phoneFeedback"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Relationship</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="parentRelationship" class="form-control text-muted" placeholder="Relationship with children (ex: mother)" value="<?php echo $parent_relationship; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12">Parent Status</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <select class='form-control' name='parentStatus' required>
                                                                <?php
                                                                if ($parent_status == "active") {
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
                                                    <a href="AParent.php" type="button" class="btn btn-primary waves-effect waves-light">Return</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- edit children tab -->
                                    <!-- get child id from database, use child id as div id for each tab and set form id as editChildrenForm(i) which i is child id -->
                                    <?php
                                    for ($x = 0; $x < $children; $x++) {
                                        // echo  $childId[$x];
                                    ?>
                                        <div class="tab-pane" id="<?php echo $childId[$x] ?>" role="tabpanel">
                                            <div class="p-20">
                                                <form class="form-control-line childrenForm" id="editChildrenForm<?php echo $childId[$x] ?>" method="post" action="editChild.php?child_id=<?= $childId[$x] ?>">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-md-12" for="example-text">Child Name</span>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="example-text" name="childName" class="form-control text-muted" placeholder="enter child name" value="<?php echo $childName[$x] ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-md-12" for="example-age">Child Age</span>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input type="number" id="example-age" name="childAge" class="form-control text-muted" placeholder="enter child age" value="<?php echo $childAge[$x] ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Select Course</label>
                                                        <select class='form-control course_option text-muted' name='childCourse' required>
                                                            <?php
                                                            if ($conn) {
                                                                $sql2_5 = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID'";
                                                                $result2_5 = $conn->query($sql2_5);
                                                                while ($row2_5 = $result2_5->fetch_assoc()) {
                                                                    $course_id = $row2_5["COURSE_ID"];
                                                                    $course_name = $row2_5["COURSE_NAME"];
                                                                    $course_status = $row2_5["COURSE_STATUS"];
                                                                    if ($childCourse[$x] == $course_id && $course_status == 'inactive') {
                                                            ?>
                                                                        <option hidden value="<?php echo $course_id ?>" selected> <?php echo $course_name ?> </option>
                                                                    <?php
                                                                    }
                                                                }

                                                                $sql3 = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_STATUS ='active'";
                                                                $result3 = $conn->query($sql3);
                                                                while ($row3 = $result3->fetch_assoc()) {
                                                                    $course_id = $row3["COURSE_ID"];
                                                                    $course_name = $row3["COURSE_NAME"];
                                                                    if ($childCourse[$x] == $course_id) {
                                                                    ?>
                                                                        <option value="<?php echo $course_id ?>" selected><?php echo $course_name ?></option>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <option value="<?php echo $course_id ?>"><?php echo $course_name ?></option>

                                                            <?php
                                                                    }
                                                                }
                                                            } else {
                                                                die("FATAL ERROR");
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Select Teacher</label>
                                                        <select class='form-control teacher_option text-muted' name='childTeacher' required>
                                                            <?php
                                                            if ($conn) {
                                                                $sql3_5 = "SELECT * FROM TEACHER WHERE ADMIN_ID = '$userID'";
                                                                $result3_5 = $conn->query($sql3_5);
                                                                while ($row3_5 = $result3_5->fetch_assoc()) {
                                                                    $teacher_id = $row3_5["TEACHER_ID"];
                                                                    $teacher_name = $row3_5["TEACHER_NAME"];
                                                                    $teacher_status = $row3_5["TEACHER_STATUS"];
                                                                    if ($childTeacher[$x] == $teacher_id) {
                                                            ?>
                                                                        <option hidden value="<?php echo $teacher_id ?>" selected> <?php echo $teacher_name ?> </option>
                                                                    <?php
                                                                    }
                                                                }

                                                                $course_id = $childCourse[$x];

                                                                $sql4 = "SELECT * FROM TEACHER LEFT JOIN TEACHER_COURSE ON TEACHER.TEACHER_ID = TEACHER_COURSE.TEACHER_ID LEFT JOIN COURSE ON TEACHER_COURSE.COURSE_ID = COURSE.COURSE_ID 
                                                                WHERE TEACHER.ADMIN_ID = '$userID' AND TEACHER.TEACHER_STATUS ='active' AND TEACHER_COURSE.COURSE_ID = '$course_id' AND COURSE.COURSE_STATUS = 'active'";
                                                                $result4 = $conn->query($sql4);
                                                                while ($row4 = $result4->fetch_assoc()) {
                                                                    $teacher_id = $row4["TEACHER_ID"];
                                                                    $teacher_name = $row4["TEACHER_NAME"];
                                                                    if ($childTeacher[$x] == $teacher_id) {
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
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Child Status</label>
                                                        <select class='form-control' name='childStatus' required>
                                                            <?php
                                                            if ($childStatus[$x] == "active") {
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
                                                    <div class="button-group">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                        <a href="AParent.php" type="button" class="btn btn-primary waves-effect waves-light">Return</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <!-- add new children tab -->
                                    <div class="tab-pane" id="addChildren" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-control-line" id="addChildForm" method="post" action="addChild.php?parent_id=<?= $parent_id ?>">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Child Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="childrenName" class="form-control" placeholder="enter child name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-age">Child Age</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-age" name="childrenAge" class="form-control" placeholder="enter child age" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Course</label>
                                                    <select class='form-control course_option' name='childrenCourse' required>
                                                        <option hidden disabled selected value=""> -- select a course -- </option>
                                                        <?php
                                                        if ($conn) {
                                                            $sql5 = "SELECT * FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_STATUS ='active'";
                                                            $result5 = $conn->query($sql5);
                                                            while ($row5 = $result5->fetch_assoc()) {
                                                                $course_id = $row5["COURSE_ID"];
                                                                $course_name = $row5["COURSE_NAME"];
                                                        ?>
                                                                <option value="<?php echo $course_id ?>"><?php echo $course_name ?></option>
                                                        <?php
                                                            }
                                                        } else {
                                                            die("FATAL ERROR");
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Teacher</label>
                                                    <select class='form-control teacher_option' name='childrenTeacher' required>
                                                        <option hidden disabled selected value=""> -- select a course first -- </option>
                                                    </select>
                                                </div>
                                                <div class="button-group">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <a href="AParent.php" type="button" class="btn btn-primary waves-effect waves-light">Return</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $conn->close(); ?>
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

    <script>
        // get teacher after select course 
        $(document).on('change', 'select.course_option', function() {
            var childFormid = $(this).closest("div[id]").attr("id");
            var courseSelected = $(this).val();
            $.ajax({
                    url: 'getTeacher.php',
                    type: 'POST',
                    data: {
                        course_id: courseSelected
                    },
                    dataType: 'json',
                })
                .done(function(response) {
                    $('#' + childFormid).find(".teacher_option").html(response.output);
                }).fail(function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                })
        });

        $("#editParentForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#editParentForm").attr('action'),
                    type: $("#editParentForm").attr('method'),
                    data: $("#editParentForm").serialize(),
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
                            window.location.href = "AParent.php";
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

        $('.childrenForm').each(function(e) {
            var formid = $(this).closest('form').attr('id');
            var childrenName = $(this).parent().parent().attr('id');
            // console.log(formid)
            // console.log(childrenName)
            $('#' + formid).submit(function(e) {
                e.preventDefault();
                $('html, body').css("cursor", "wait");
                $.ajax({
                        url: $('#' + formid).attr('action'),
                        type: $('#' + formid).attr('method'),
                        data: $('#' + formid).serialize(),
                        dataType: 'json'
                    })
                    .done(function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                response.title,
                                response.message,
                                response.status
                            ).then(() => {
                                window.location.href = "AParent.php";
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
                        console.log(xhr.responseText);
                    })
            })
        });

        $("#addChildForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $('#addChildForm').attr('action'),
                    type: $('#addChildForm').attr('method'),
                    data: $('#addChildForm').serialize(),
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        ).then(() => {
                            window.location.href = "AParent.php";
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