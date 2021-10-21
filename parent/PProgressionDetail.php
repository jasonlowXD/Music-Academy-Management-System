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
    <title>Progression Detail</title>
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
                        <h4 class="text-themecolor">Progression Detail</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="PCalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="PProgression.php">Progression</a></li>
                                <li class="breadcrumb-item active">Progression Detail</li>
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
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Children A, 20210201 class video</h4>
                                <hr>
                                <!-- if file type is img -->
                                <!-- <img class="img-fluid" src="../img/neko.jpg"> -->

                                <!-- if file type is video -->
                                <video class="img-fluid" controls="controls" preload="true">
                                    <source src="where the video is" type="video/mov" />
                                    <source src="../img/1080p.mp4" type="video/mp4" />
                                    <source src="where the video is" type="video/oog" />
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <h4 class="card-title">Comments</h4>
                            </div>
                            <!-- ============================================================== -->
                            <!-- Comment widgets -->
                            <!-- ============================================================== -->
                            <div class="comment-widgets m-b-20 commentDiv">

                                <!-- Comment by own account (can delete) -->
                                <div class="d-flex flex-row comment-row border-bottom deletableCommentDiv">
                                    <div class="comment-text w-100">
                                        <div class="d-flex no-block">
                                            <h5 class="mr-auto"><strong>Parent ABC</strong></h5>
                                            <div class="ml-auto">
                                                <button type="button" id="deleteCommentBtn" class="btn btn-default btn-lg p-0">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                                </span>
                                            </div>
                                        </div>
                                        <p class="m-b-5 m-t-10">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry..</p>
                                    </div>
                                </div>

                                <!-- Comment by other user (cannot delete) -->
                                <div class="d-flex flex-row comment-row border-bottom">
                                    <div class="comment-text w-100">
                                        <div class="d-flex">
                                            <h5><strong>Teacher ABC</strong></h5>
                                        </div>
                                        <p class="m-b-5 m-t-10">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row comment-row border-bottom">
                                    <div class="comment-text w-100">
                                        <div class="d-flex">
                                            <h5><strong>Admin</strong></h5>
                                        </div>
                                        <p class="m-b-5 m-t-10">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- comment input -->
                            <div class="card-body border-top">
                                <form action="" class="commentForm">
                                    <div class="row">
                                        <div class="col-8">
                                            <textarea placeholder="Type your comment here" class="form-control border-0"></textarea>
                                        </div>
                                        <div class="col-4 text-right">
                                            <button type="submit" class="btn btn-info btn-circle btn-lg"><i class="fa fa-paper-plane-o"></i> </button>
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

    <script>
        // delete selected comment div
        $(document).on('click', '#deleteCommentBtn', function(e) {
            console.log($(this));
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
                    // DO DELETE PROGRESSION HERE THEN FIRE SWAL
                    $(this).parents('.deletableCommentDiv').remove();
                    Swal.fire(
                        'Deleted!',
                        'Your comment has been deleted.',
                        'success'
                    ).then(() => {
                        // window.location.href = "AProgressionDetail.php";
                    })
                }
            })
        })


        // add new comment
        $(".commentForm").on('submit', function(e) {
            e.preventDefault();
            var user = $("#userProfile").text();
            // console.log(user);
            var commentContent = $(".commentForm textarea").val();
            $('.commentForm textarea').val('');
            // console.log(commentContent);
            var commentLayout = '<div class="d-flex flex-row comment-row border-bottom deletableCommentDiv">' +
                '<div class="comment-text w-100">' +
                '<div class="d-flex no-block">' +
                '<h5 class="mr-auto"><strong>' + user + '</strong></h5>' +
                '<div class="ml-auto">' +
                '<button type="button" id="deleteCommentBtn" class="btn btn-default btn-lg p-0">' +
                '<i class="fa fa-trash-o"></i>' +
                '</button>' +
                '</span>' +
                '</div>' +
                '</div>' +
                '<p class="m-b-5 m-t-10">' + commentContent + '</p>' +
                '</div>' +
                '</div>';

            // add new comment to database here then append
            $(".commentDiv").append(commentLayout);
        })
    </script>

</body>

</html>