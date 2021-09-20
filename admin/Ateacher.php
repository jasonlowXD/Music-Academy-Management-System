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
                        <h4 class="text-themecolor">Teacher Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="Aindex.php">Home</a></li>
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
                                            <span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Add Teacher</span>
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
                                                        <input id="table-search" type="text" placeholder="Search" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive ">
                                                <table id="mytable" class="table m-t-5 table-hover contact-list" data-page-size="5">
                                                    <thead>
                                                        <tr>
                                                            <th>Profile Pic</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <img src="../assets/images/users/4.jpg" alt="user" width="40" class="img-circle" />
                                                            </td>
                                                            <td>teacher A</td>
                                                            <td>teachera@gmail.com</td>
                                                            <td>+123 456 789</td>
                                                            <td>
                                                                <a href="AeditTeacher.php" type="button" class="btn btn-xl btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i> Edit</a>
                                                                <button type="button" class="btn btn-xl btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <img src="../assets/images/users/4.jpg" alt="user" width="40" class="img-circle" />
                                                            </td>
                                                            <td>tasd</td>
                                                            <td>aaa@gmail.com</td>
                                                            <td>+1 789</td>
                                                            <td>
                                                                <button type="button" class="btn btn-xl btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i> Edit</button>
                                                                <button type="button" class="btn btn-xl btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <img src="../assets/images/users/4.jpg" alt="user" width="40" class="img-circle" />
                                                            </td>
                                                            <td>dsa</td>
                                                            <td>bba@gmail.com</td>
                                                            <td>+789</td>
                                                            <td>
                                                                <button type="button" class="btn btn-xl btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i> Edit</button>
                                                                <button type="button" class="btn btn-xl btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <img src="../assets/images/users/4.jpg" alt="user" width="40" class="img-circle" />
                                                            </td>
                                                            <td>tdsa</td>
                                                            <td>cca@gmail.com</td>
                                                            <td>+89</td>
                                                            <td>
                                                                <button type="button" class="btn btn-xl btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i> Edit</button>
                                                                <button type="button" class="btn btn-xl btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <img src="../assets/images/users/4.jpg" alt="user" width="40" class="img-circle" />
                                                            </td>
                                                            <td>tdsa</td>
                                                            <td>cca@gmail.com</td>
                                                            <td>+89</td>
                                                            <td>
                                                                <button type="button" class="btn btn-xl btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i> Edit</button>
                                                                <button type="button" class="btn btn-xl btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <img src="../assets/images/users/4.jpg" alt="user" width="40" class="img-circle" />
                                                            </td>
                                                            <td>tdsa</td>
                                                            <td>cca@gmail.com</td>
                                                            <td>+89</td>
                                                            <td>
                                                                <button type="button" class="btn btn-xl btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i> Edit</button>
                                                                <button type="button" class="btn btn-xl btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                            </td>
                                                        </tr>
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
                                            <form class="form-material">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="example-text" class="form-control" placeholder="enter your name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-email">Email</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="email" id="example-email" name="example-email" class="form-control" placeholder="enter your email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-phone">Phone</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-phone" name="example-phone" class="form-control" placeholder="enter your phone">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-12">Gender</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control">
                                                                <option>Select Gender</option>
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-12">Profile Image</label>
                                                        <div class="col-sm-12">
                                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                                                    <input type="file" name="..."> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-sm-12">Department</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control">
                                                                <option>Select Department</option>
                                                                <option>Computer</option>
                                                                <option>Mechanical</option>
                                                                <option>Electrical</option>
                                                                <option>Medical</option>
                                                                <option>BCA/MCA</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="position">Position</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="position" name="position" class="form-control" placeholder="e.g. Asst. Professor">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12">Description</label>
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="url">Website URL</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="url" name="url" class="form-control" placeholder="your website">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                                                <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
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
        $('a[data-toggle="tab"]').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href");
            sessionStorage.setItem('selectedTab', id)
        });
        var selectedTab = sessionStorage.getItem('selectedTab');
        if (selectedTab != null) {
            $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
        }

        ///////////////////////////////////////////////////////////////
        // footable
        $('#mytable').footable();
        $('#table-entries').on('change', function(e) {
            e.preventDefault();
            var pageSize = $(this).val();
            $('#mytable').data('page-size', pageSize);
            $('#mytable').trigger('footable_initialized');
        });

        // Search input
        $('#table-search').on('input', function(e) {
            e.preventDefault();
            addrow.trigger('footable_filter', {
                filter: $(this).val()
            });
        });

        var addrow = $('#mytable');

        addrow.footable().on('click', '#delete-row-btn', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //get the footable object
                    var footable = addrow.data('footable');
                    //get the row we are wanting to delete
                    var row = $(this).parents('tr:first');
                    //delete the row
                    footable.removeRow(row);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    </script>

</body>

</html>