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
    <title>Edit Parent&Children</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/pages/file-upload.css" rel="stylesheet">
    <link href="../dist/css/pages/tab-page.css" rel="stylesheet">

</head>

<body class="skin-blue-dark fixed-layout">
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
                        <h4 class="text-themecolor">Edit Parent & Children</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="ACalendar.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="AParent.php">Parent&Children</a></li>
                                <li class="breadcrumb-item active">Edit Parent&Children</li>
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
                                <ul class="nav nav-tabs" role="tablist" id="parentTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#editParent" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Edit Parent</span>
                                        </a>
                                    </li>

                                    <!-- for children nav-link, get children data from database, use looping to display based on number of children -->
                                    <!-- loop1 -->
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Children 1" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-pencil-alt"></i></span> <span class="hidden-xs-down">Children 1</span>
                                        </a>
                                    </li>
                                    <!-- loop2 -->
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Children 2" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-pencil-alt"></i></span> <span class="hidden-xs-down">Children 2</span>
                                        </a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- edit parent tab -->
                                    <div class="tab-pane active" id="editParent" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-material" id="editParentForm">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Parent Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="example-text" class="form-control text-muted" placeholder="enter parent name" value="Parent ABC" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-email">Parent Email</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="email" id="example-email" name="example-email" class="form-control text-muted" placeholder="enter parent email" value="ParentABC@abc.com" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-phone">Parent Phone Number</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-phone" name="example-phone" class="form-control text-muted" placeholder="enter parent phone" value="+6012-3456789" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <a href="AParent.php" type="button" class="btn btn-primary waves-effect waves-light">Return</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- edit children tab -->
                                    <!-- get children name from database, use children number(i) looping to display id(Children+i) and form id(editChildrenForm+i) which i is number of children -->
                                    <!-- loop1 -->
                                    <div class="tab-pane" id="Children 1" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-material childrenForm" id="editChildrenForm1">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Children Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="example-text" class="form-control" placeholder="enter child name" value="Children A" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-age">Children Age</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-age" name="example-age" class="form-control" placeholder="enter child age" value="15" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Course</label>
                                                    <select class='form-control' name='course' required>
                                                        <option selected value='1'>Piano Grade 1</option>
                                                        <option value='2'>Piano Grade 2</option>
                                                        <option value='3'>Guitar Grade 1</option>
                                                    </select>
                                                </div>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Teacher</label>
                                                    <select class='form-control' name='teacher' required>
                                                        <option selected value='teacher A'>teacher A</option>
                                                        <option value='teacher B'>teacher B</option>
                                                        <option value='teacher C'>teacher C</option>
                                                    </select>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light delete-children-btn">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- loop2 -->
                                    <div class="tab-pane" id="Children 2" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-material childrenForm" id="editChildrenForm2">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Children Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="example-text" class="form-control" placeholder="enter child name" value="Children B" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-age">Children Age</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="number" id="example-age" name="example-age" class="form-control" placeholder="enter child age" value="12" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Course</label>
                                                    <select class='form-control' name='course' required>
                                                        <option value='1'>Piano Grade 1</option>
                                                        <option selected value='2'>Piano Grade 2</option>
                                                        <option value='3'>Guitar Grade 1</option>
                                                    </select>
                                                </div>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Teacher</label>
                                                    <select class='form-control' name='teacher' required>
                                                        <option value='teacher A'>teacher A</option>
                                                        <option selected value='teacher B'>teacher B</option>
                                                        <option value='teacher C'>teacher C</option>
                                                    </select>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light delete-children-btn">Delete</button>
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
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#editParentForm").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Confirm Edit?',
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // DO EDIT PARENT HERE THEN FIRE SWAL
                    Swal.fire(
                        'Done!',
                        'Parent Edited.',
                        'success'
                    ).then(() => {
                        window.location.href = "AParent.php";
                    })
                }
            })
        })

        $('.childrenForm').each(function(e) {
            var formid = $(this).closest('form').attr('id');
            var childrenName = $(this).parent().parent().attr('id');
            // console.log(formid)
            // console.log(childrenName)
            $('#' + formid).submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Confirm Edit?',
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, confirm!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // DO EDIT CHILDREN HERE THEN FIRE SWAL
                        Swal.fire(
                            'Done!',
                            childrenName + ' Edited.',
                            'success'
                        ).then(() => {
                            window.location.href = "AParent.php";
                        })
                    }
                })
            })

            $('#' + formid).on('click', '.delete-children-btn', function(e) {
                e.preventDefault();
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
                        // DO DELETE CHILDREN HERE THEN FIRE SWAL
                        Swal.fire(
                            'Done!',
                            childrenName + ' Deleted.',
                            'success'
                        ).then(() => {
                            window.location.href = "AParent.php";
                        })
                    }
                })
            })

        });
    </script>

</body>

</html>