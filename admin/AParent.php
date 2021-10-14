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
                                        <a class="nav-link active" data-toggle="tab" href="#teacherlist" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Parent List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addteacher" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-plus"></i></span> <span class="hidden-xs-down">Add New Parent</span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- parent list panel -->
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
                                                <table id="mytable" class="table m-t-5 table-hover contact-list toggle-arrow-tiny" data-page-size="5">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th data-sort-ignore="true">Action</th>
                                                            <th data-hide="all">Children 1</th>
                                                            <th data-hide="all">Children 2</th>
                                                            <th data-hide="all">Children 3</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>parenta</td>
                                                            <td>parentA@gmail.com</td>
                                                            <td>+123 456 789</td>
                                                            <td>
                                                                <div class="button-group">
                                                                    <a href="AParentEdit.php" type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i>Edit</a>
                                                                    <button type="button" class="btn btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                                </div>
                                                            </td>
                                                            <td>childrena</td>
                                                            <td>childrenb</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>parentb</td>
                                                            <td>aaa@gmail.com</td>
                                                            <td>+1 789</td>
                                                            <td>
                                                                <div class="button-group">
                                                                    <button type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i>Edit</button>
                                                                    <button type="button" class="btn btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                                </div>
                                                            </td>
                                                            <td>kida</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>dsa</td>
                                                            <td>bba@gmail.com</td>
                                                            <td>+666</td>
                                                            <td>
                                                                <div class="button-group">
                                                                    <button type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i>Edit</button>
                                                                    <button type="button" class="btn btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                                </div>
                                                            </td>
                                                            <td>cccc</td>
                                                            <td>dddd</td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>tdsa</td>
                                                            <td>cca@gmail.com</td>
                                                            <td>+777</td>
                                                            <td>
                                                                <div class="button-group">
                                                                    <button type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i>Edit</button>
                                                                    <button type="button" class="btn btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                                </div>
                                                            </td>
                                                            <td>eeee</td>
                                                            <td>ddaaa</td>
                                                            <td>qpqpq</td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>gdsg</td>
                                                            <td>hhh@gmail.com</td>
                                                            <td>+999</td>
                                                            <td>
                                                                <div class="button-group">
                                                                    <button type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i>Edit</button>
                                                                    <button type="button" class="btn btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                                </div>
                                                            </td>
                                                            <td>yyyy</td>
                                                            <td>qqqqq</td>
                                                        </tr>
                                                        <tr>
                                                            <td>6</td>
                                                            <td>tre</td>
                                                            <td>ttt@gmail.com</td>
                                                            <td>+444</td>
                                                            <td>
                                                                <div class="button-group">
                                                                    <button type="button" class="btn btn-outline-info"><i class="ti-pencil-alt" aria-hidden="true"></i>Edit</button>
                                                                    <button type="button" class="btn btn-outline-danger" id="delete-row-btn"><i class="ti-trash" aria-hidden="true"></i>Delete</button>
                                                                </div>
                                                            </td>
                                                            <td>kkkkk</td>
                                                            <td>Cllll</td>
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
                                    <!-- add parent panel -->
                                    <div class="tab-pane" id="addteacher" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-material">
                                                <!-- parent form -->
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text">Parent Name</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text" name="example-text" class="form-control" placeholder="enter parent name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-email">Parent Email</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="email" id="example-email" name="example-email" class="form-control" placeholder="enter parent email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-phone">Parent Phone Number</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-phone" name="example-phone" class="form-control" placeholder="enter parent phone" required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- children form -->
                                                <div class="childrenDiv">
                                                    <div id="cloneChildrenForm">
                                                        <hr class="m-t-40">
                                                        <div class="d-flex no-block align-items-center" id="childrenHeaderDiv">
                                                            <h4 class="card-title">Children Info</h4>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-md-12" for="example-text">Children Name</span>
                                                                </label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="example-text" name="example-text[]" class="form-control" placeholder="enter child name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-md-12" for="example-age">Children Age</span>
                                                                </label>
                                                                <div class="col-md-12">
                                                                    <input type="number" id="example-age" name="example-age[]" class="form-control" placeholder="enter child age" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label class='control-label'>Select Course</label>
                                                            <select class='form-control' name='course[]' required>
                                                                <option hidden disabled selected value=""> -- select a course -- </option>
                                                                <option value=''>Piano Grade 1</option>
                                                                <option value=''>Piano Grade 2</option>
                                                                <option value=''>Guitar Grade 1</option>
                                                            </select>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label class='control-label'>Select Teacher</label>
                                                            <select class='form-control' name='teacher[]' required>
                                                                <option hidden disabled selected value=""> -- select a teacher -- </option>
                                                                <option value='teacher A'>teacher A</option>
                                                                <option value='teacher B'>teacher B</option>
                                                                <option value='teacher C'>teacher C</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <button type="reset" class="btn btn-dark waves-effect waves-light">Reset</button>
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

        //delete button
        $('#mytable').footable().on('click', '#delete-row-btn', function(e) {
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
                    //get the footable object
                    var footable = $('#mytable').data('footable');
                    //get the row we are wanting to delete
                    var row = $(this).parents('tr:first');
                    //delete the TEACHER AND FIRE SWAL
                    footable.removeRow(row);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });

        // Accordion
        // -----------------------------------------------------------------
        $('#mytable').footable().on('footable_row_expanded', function(e) {
            $('#mytable tbody tr.footable-detail-show').not(e.row).each(function() {
                $('#mytable').data('footable').toggleDetail(this);
            });
        });

        // clone children input
        var i = 1;
        $('#addChildren').click(function() {
            i++;
            var clone = $('#cloneChildrenForm').clone().find('input').val('').end();
            clone.attr("id", "cloneChildrenForm-" + i);

            var removebtn = '<button type="button" id="' + i + '" class="btn btn-danger btn-xs ml-auto btn_remove"><i class="fa fa-times"></i></button>';

            clone.find('#childrenHeaderDiv').append(removebtn);

            $('.childrenDiv').append(clone);
        });

        //remove children clone
        $(document).on('click', '.btn_remove', function() {
            var btn_id = $(this).attr("id");
            console.log(btn_id);
            $('#cloneChildrenForm-' + btn_id).remove();
            i--;
        });
    </script>

</body>

</html>