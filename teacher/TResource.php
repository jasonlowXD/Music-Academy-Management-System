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
    <title>Manage Learning Resource</title>
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
                        <h4 class="text-themecolor">Learning Resource Management</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="TCalendar.php">Home</a></li>
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="teacherTab">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#resourceTab" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Resource List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addResourceTab" role="tab">
                                            <span class="hidden-sm-up"><i class="ti-plus"></i></span> <span class="hidden-xs-down">Add Resource</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <!-- Resource panel -->
                                    <div class="tab-pane active" id="resourceTab" role="tabpanel">
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
                                                            <th>Child</th>
                                                            <th>Title</th>
                                                            <th>Url</th>
                                                            <th>File</th>
                                                            <th data-sort-ignore="true">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $resource_num = 0;
                                                        $userID = $_SESSION["userID"];
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql = "SELECT * FROM LEARNING_RESOURCE LEFT JOIN CHILD ON LEARNING_RESOURCE.CHILD_ID = CHILD.CHILD_ID WHERE LEARNING_RESOURCE.TEACHER_ID = '$userID' ORDER BY LEARNING_RESOURCE.RESOURCE_ID DESC";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $resource_num++;
                                                                $resource_id = $row["RESOURCE_ID"];
                                                                $child_name = $row["CHILD_NAME"];
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
                                                                    ?>

                                                                    <?php
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
                                                                    <td>
                                                                        <div class="button-group">
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#editModal"><i class="ti-pencil-alt" style="font-size:18px;" aria-hidden="true"></i></button>
                                                                            <button type="button" class="btn btn-outline-danger" id="delete-row-btn"><i class="ti-trash" style="font-size:18px;" aria-hidden="true"></i></button>
                                                                        </div>
                                                                    </td>
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

                                    <!-- add resource panel -->
                                    <div class="tab-pane" id="addResourceTab" role="tabpanel">
                                        <div class="p-20">
                                            <form enctype="multipart/form-data" class="form-control-line" id="addResourceForm" method="post" action="addResource.php">
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Child</label>
                                                    <select class='form-control' name='child' required>
                                                        <option hidden disabled selected value=""> -- select a child -- </option>
                                                        <?php
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql2 = "SELECT * FROM CHILD WHERE TEACHER_ID = '$userID' AND CHILD_STATUS ='active'";
                                                            $result2 = $conn->query($sql2);
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                                $child_id = $row2["CHILD_ID"];
                                                                $child_name = $row2["CHILD_NAME"];
                                                        ?>
                                                                <option value="<?php echo $child_id ?>"><?php echo $child_name ?></option>
                                                        <?php

                                                            }
                                                        } else {
                                                            die("FATAL ERROR");
                                                        }
                                                        $conn->close();
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12" for="example-text3">Resource Title</span>
                                                        </label>
                                                        <div class="col-md-12">
                                                            <input type="text" id="example-text3" name="title" class="form-control" placeholder="enter resource title" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <label class="col-md-12">Resource Url</label>
                                                        <div class="col-md-12">
                                                            <input type="url" id="example-url" name="url" class="form-control" placeholder="example:  https://www.youtube.com/">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="resourceFileDiv">
                                                    <div class="row">
                                                        <label class="col-sm-12">Resource File</label>
                                                        <div class="col-sm-12 fileinput fileinput-new input-group" data-provides="fileinput">
                                                            <div class="form-control" data-trigger="fileinput">
                                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                <span class="fileinput-filename"></span>
                                                            </div>
                                                            <span class="input-group-addon btn btn-default btn-file">
                                                                <span class="fileinput-new">Select file (only accept pdf or image file, max 2MB)</span>
                                                                <span class="fileinput-exists">Change</span>
                                                               
                                                                <!-- get file data from this below input -->
                                                                <input type="file" id="resourceFileInput" name="resourceFile" accept="image/jpeg,image/png,application/pdf">
                                                            </span>
                                                            <a href="javascript:void(0)" id="btnFileRemove" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                        <span class="col-sm-12" id="resourceFileFeedback"></span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                                    <button type="reset" id="btnReset" class="btn btn-dark waves-effect waves-light">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- edit receipt modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Edit Resource</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form class="form-material" id="editResourceForm">
                                <div class="modal-body">
                                    <div class='form-group'>
                                        <label class='control-label col-md-12'>Select Child</label>
                                        <div class="col-md-12">
                                            <select class='form-control text-muted' name='children' required>
                                                <option selected value='Children A'>Children A</option>
                                                <option value='Children B'>Children B</option>
                                                <option value='Children C'>Children C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" for="example-text3">Resource Title</span>
                                        </label>
                                        <div class="col-md-12">
                                            <input type="text" id="example-text3" name="example-text" class="form-control" placeholder="enter Resource title" value="Topic 1 resource with Url" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Resource Url</label>
                                        <div class="col-md-12">
                                            <input type="url" id="example-url" name="example-url" class="form-control" placeholder="example:  https://www.youtube.com/" value="https://www.youtube.com/">
                                        </div>
                                    </div>
                                    <div class="form-group" id="resourceFileDiv">
                                        <label class="col-sm-12">Resource File</label>
                                        <div class="col-sm-12 fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">Select file</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="hidden">
                                                <!-- get file data from this below input -->
                                                <input type="file" id="resourceFileInput" name="...">
                                            </span>
                                            <a href="javascript:void(0)" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        <span id="resourceFileFeedback"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </form>
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
    <!-- Date Picker Plugin JavaScript -->
    <script src="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

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

        $('#btnFileRemove').click(function() {
            resourceFileRemoveClass();
            $("#resourceFileInput").val('');
        });

        $('#btnReset').click(function() {
            resourceFileRemoveClass();
            $("#resourceFileInput").val('');
        });

        $("#addResourceForm").submit(function(e) {
            e.preventDefault();
            $('html, body').css("cursor", "wait");
            var formData = new FormData(this);
            $.ajax({
                    enctype: 'multipart/form-data',
                    url: $("#addResourceForm").attr('action'),
                    type: $("#addResourceForm").attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json'
                })
                .done(function(response) {
                    if (response.status == 'success') {
                        resourceFileRemoveClass();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        ).then(() => {
                            location.reload();
                        })
                        $('html, body').css("cursor", "auto");
                    } else if (response.status == 'error' && response.title == 'Error resource file') {
                        resourceFileAddClass(response.message);
                        $('html, body').css("cursor", "auto");
                    } else {
                        resourceFileRemoveClass();
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
                    console.log(xhr);
                })
        })

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

        // edit receipt form
        $("#editResourceForm").submit(function(e) {
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
                    // DO EDIT RECEIPT HERE THEN FIRE SWAL
                    Swal.fire(
                        'Done!',
                        'Resource Edited.',
                        'success'
                    ).then(() => {
                        window.location.href = "TResource.php";
                    })
                }
            })
        })
    </script>

</body>

</html>