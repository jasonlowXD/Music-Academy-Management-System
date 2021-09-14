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
    <!-- page css -->
    <link href="../dist/css/pages/footable-page.css" rel="stylesheet">
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
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="Aindex.php">
                        <!-- Logo icon -->
                        <b class="m-l-5 m-r-5">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <i class="fa fa-music"></i>
                            <!-- Dark Logo icon -->
                            <!-- <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" /> -->
                            <!-- Light Logo icon -->
                            <!-- <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> -->
                        </b>
                        <!--End Logo icon -->
                        <span class="hidden-xs"><span class="font-bold">MUSIC</span> ACADEMY</span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Notifications -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-bell"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Notifications -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="hidden-md-down">Admin &nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <!-- text-->
                                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="../index.php" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">--- MANAGEMENT</li>
                        <li> <a class="waves-effect waves-dark" href="Aindex.php"><i class="icon-calender"></i><span class="hide-menu">Calendar</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="Ateacher.php"><i class="icon-people"></i><span class="hide-menu">Teacher</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="javascript:void(0)"><i class="icon-user"></i><span class="hide-menu">Parent</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="javascript:void(0)"><i class="ti-credit-card"></i><span class="hide-menu">Invoice</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="javascript:void(0)"><i class="ti-receipt"></i><span class="hide-menu">Payment Receipt</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="javascript:void(0)"><i class="icon-folder"></i><span class="hide-menu">Learning Resource</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="javascript:void(0)"><i class="icon-graduation"></i><span class="hide-menu">Student Progression</span></a>
                        </li>

                        <li class="nav-small-cap">--- SETTINGS</li>
                        <li> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-settings text-info"></i><span class="hide-menu">Account Settings</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="../index.php" aria-expanded="false"><i class="icon-logout text-danger"></i><span class="hide-menu">Log Out</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
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
                        <h4 class="text-themecolor">Teacher List</h4>
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
                                <h4 class="card-title">Teacher list</h4>
                                <div class="mt-5">

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
                                </div>
                                <tbody>
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
                                            <tr>
                                                <td>
                                                    <img src="../assets/images/users/4.jpg" alt="user" width="40" class="img-circle" />
                                                </td>
                                                <td>teacher A</td>
                                                <td>teachera@gmail.com</td>
                                                <td>+123 456 789</td>
                                                <td>
                                                    <button type="button" class="btn btn-xl btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i> Edit</button>
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
                                        <td colspan="2">
                                            <button type="button" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add New Teacher</button>

                                        </td>
                                        <!-- Add New Teacher modal -->
                                        <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Add New Teacher</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <from class="form-horizontal form-material">
                                                            <div class="form-group">
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Type name">
                                                                </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Email">
                                                                </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Phone">
                                                                </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Designation">
                                                                </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Age">
                                                                </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Date of joining">
                                                                </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <input type="text" class="form-control" placeholder="Salary">
                                                                </div>
                                                                <div class="col-md-12 m-b-20">
                                                                    <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light"><span><i class="icon-cloud-upload m-r-5"></i>Upload Profile Pic</span>
                                                                        <input type="file" class="upload">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </from>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Save</button>
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
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
    <!-- Footable -->
    <script src="../assets/node_modules/footable/js/footable.all.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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