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
    <title>Practice Progress Detail</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <!-- page css -->
    <link href="../dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="../dist/css/pages/tab-page.css" rel="stylesheet">
    <!-- Footable CSS -->
    <link href="../assets/node_modules/footable/css/footable.core.css" rel="stylesheet">
    <link href="../assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <!-- Emoji CSS -->
    <link href="../emojionearea/dist/emojionearea.css" rel="stylesheet">

</head>

<body class="skin-green-dark fixed-layout">
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
        <?php require_once("TTopbar.php") ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php require_once("TSideBar.php") ?>
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
                        <h4 class="text-themecolor">Practice Progress Detail</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="TCalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="TPractice.php">Practice</a></li>
                                <li class="breadcrumb-item active">Practice Detail</li>
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
                    <div class="col-md-12 col-sm-12 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $progress_id = $_GET["progress_id"];
                                $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                if ($conn) {
                                    $sql = "SELECT * FROM PRACTICE_PROGRESS LEFT JOIN CHILD ON PRACTICE_PROGRESS.CHILD_ID = CHILD.CHILD_ID WHERE PROGRESS_ID = '$progress_id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $child_name = $row["CHILD_NAME"];
                                        $progress_course = $row["PROGRESS_COURSE"];
                                        $progress_title = $row["PROGRESS_TITLE"];
                                        $progress_datetime = date_create($row["PROGRESS_DATETIME"]);
                                        $datetime_display = date_format($progress_datetime, 'Y-m-d g:ia');

                                        if ($row["PROGRESS_FILEPATH"] != null) {
                                            $filepath = $row["PROGRESS_FILEPATH"];
                                        } else {
                                            $filepath = '-';
                                        }

                                ?>
                                        <div class="d-flex no-block align-items-center justify-content-between">
                                            <h4 class="card-title mr-auto"><?php echo $child_name; ?></h4>
                                            <a href="TPractice.php" type="button" class="btn btn-primary btn-xs waves-effect waves-light ml-auto"><i class="fa fa-arrow-left"></i></a>
                                        </div>

                                        <h3 class="card-title text-info"><?php echo $progress_course; ?>, <?php echo $progress_title; ?></h3>
                                        <small class="card-title text-primary">Last modified: <?php echo $datetime_display; ?></small>

                                        <hr>
                                        <!-- if file type is img -->
                                        <!-- <img class="img-fluid" src="../img/neko.jpg"> -->

                                        <!-- if file type is video -->
                                        <video class="img-fluid" controls="controls" preload="true">
                                            <?php
                                            $path_parts = pathinfo($filepath);
                                            $file_type = $path_parts['extension'];
                                            switch ($file_type) {
                                                case "mp4": ?>
                                                    <source src="<?php echo $filepath; ?>" type="video/mp4" />
                                                <?php break;
                                                case "webm": ?>
                                                    <source src="<?php echo $filepath; ?>" type="video/webm" />
                                                <?php break;
                                                default: ?> Your browser does not support the video tag.
                                            <?php
                                            }
                                            ?>
                                        </video>

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
                    <div class="col-md-12 col-sm-12 col-lg-4">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Comments</h4>
                            </div>
                            <!-- ============================================================== -->
                            <!-- Comment widgets -->
                            <!-- ============================================================== -->
                            <div class="comment-widgets m-b-10 commentDiv">

                                <?php
                                $userID = $_SESSION["userID"];
                                $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                if ($conn) {
                                    $sql2 = "SELECT * FROM COMMENT LEFT JOIN TEACHER ON COMMENT.TEACHER_ID = TEACHER.TEACHER_ID LEFT JOIN PARENT ON COMMENT.PARENT_ID = PARENT.PARENT_ID WHERE COMMENT.PROGRESS_ID = '$progress_id' ORDER BY COMMENT.COMMENT_DATETIME ASC";
                                    $result2 = $conn->query($sql2);

                                    // IF NO COMMENT 
                                    if ($result2->num_rows == 0) {
                                ?>
                                        <div id="no_comment_div" class="comment-row pb-1 border-bottom">
                                            <div class="comment-text w-100">
                                                <p>No comment here...</p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    // IF GOT COMMENT 
                                    else {

                                        while ($row2 = $result2->fetch_assoc()) {
                                            $comment_id = $row2["COMMENT_ID"];
                                            $teacher_id = $row2["TEACHER_ID"];
                                            $teacher_name = $row2["TEACHER_NAME"];
                                            $parent_id = $row2["PARENT_ID"];
                                            $parent_name = $row2["PARENT_NAME"];
                                            $comment_content = $row2["COMMENT_CONTENT"];
                                            $comment_content = str_replace("\n", "<br/>", $comment_content);
                                            $comment_datetime = date_create($row2["COMMENT_DATETIME"]);
                                            $datetime_display = date_format($comment_datetime, 'Y-m-d g:ia');


                                            // IF THE COMMENT IS MAKE BY TEACHER (CURRENT USER)
                                            if ($teacher_id != null && $teacher_id == $userID && $parent_id == null) {
                                        ?>

                                                <div id="<?php echo $comment_id ?>" class="comment-row pb-1 border-bottom deletableCommentDiv">
                                                    <div class="comment-text w-100">
                                                        <div class="d-flex no-block">
                                                            <h5 class="mr-auto"><strong><?php echo $teacher_name; ?></strong></h5>
                                                            <div class="ml-auto">
                                                                <button type="button" id="" class=" deleteCommentBtn btn btn-danger btn-xs waves-effect waves-light">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <p class="m-b-10 m-t-10"><?php echo $comment_content; ?></p>
                                                        <small class=" text-primary"><?php echo $datetime_display; ?></small>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            // IF THE COMMENT IS MAKE BY PARENT 
                                            else if ($parent_id != null && $teacher_id == null) {
                                            ?>

                                                <div class="comment-row pb-1 border-bottom">
                                                    <div class="comment-text w-100">
                                                        <div class="d-flex">
                                                            <h5><strong><?php echo $parent_name; ?></strong></h5>
                                                        </div>
                                                        <p class="m-b-10 m-t-10"><?php echo $comment_content; ?></p>
                                                        <small class="text-primary"><?php echo $datetime_display; ?></small>
                                                    </div>
                                                </div>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>

                            </div>

                            <!-- comment input -->
                            <div class="card-body border-top">
                                <form action="addComment.php" method="post" id="addCommentForm">
                                    <div class="row">
                                        <div class="col-10 p-r-0">
                                            <input type="hidden" name="progressID" value="<?php echo $progress_id; ?>">
                                            <textarea id="commentTextarea" placeholder="Type your comment here" name="content" class="form-control border-0" rows="3"></textarea>
                                        </div>
                                        <div class="col-2 p-l-0 text-right">
                                            <button type="submit" class="btn btn-info btn-circle waves-effect waves-light"><i class="fa fa-paper-plane-o"></i> </button>
                                        </div>
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
    <script src="../dist/js/pages/mask.js"></script>
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Emoji-->
    <script src="../emojionearea/dist/emojionearea.js"></script>

    <script>
        $(document).ready(function() {
            $("#commentTextarea").emojioneArea();
        });


        $("#addCommentForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            $.ajax({
                    url: $("#addCommentForm").attr('action'),
                    type: $("#addCommentForm").attr('method'),
                    data: $("#addCommentForm").serialize(),
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        $('#addCommentForm #commentTextarea').val('');
                        $(".emojionearea-editor").html('');
                        $("#no_comment_div").remove();
                        $(".commentDiv").append(response.output);
                    } else {
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        )
                    }
                    $('html, body').css("cursor", "auto");
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
        });

        // delete comment after user click
        $(document).on('click', '.deleteCommentBtn', function() {
            // console.log($(this).parents().eq(3).attr('id'));
            var comment_id = $(this).parents().eq(3).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            type: "GET",
                            url: "deleteComment.php",
                            data: {
                                comment_id: comment_id,
                            }
                        }).done(function(response) {
                            // console.log(response);
                            $("#" + comment_id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Your comment has been deleted.',
                                'success'
                            );

                            // IF THE DIV IS EMPTY, SET NO COMMENT DIV INSIDE 
                            // console.log($.trim($('.commentDiv').html()).length);
                            if (!$.trim($('.commentDiv').html()).length) {
                                $(".commentDiv").html(' <div id="no_comment_div" class="comment-row pb-1 border-bottom">' +
                                    '<div class="comment-text w-100">' +
                                    '<p>No comment here...</p>' +
                                    '</div>' +
                                    '</div>');
                            }
                        })
                        .fail(function(xhr, textStatus, errorThrown) {
                            console.log(xhr.responseText);
                        })
                }
            })
        })
    </script>

</body>

</html>