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
    <title>Admin index</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="../assets/node_modules/calendar/dist/fullcalendar.css" rel="stylesheet" />
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
                        <h4 class="text-themecolor">Calendar</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="Aindex.php">Home</a></li>
                                <li class="breadcrumb-item active">Calendar</li>
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

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body b-l calender-sidebar">
                                        <!-- modify in cal-init.js -->
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CREATE CLASS MODAL-->
                <div class="modal fade none-border" id="add-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title add-header"><strong>Add New Class</strong></h4>
                                <button type="button" class="close cancel-event" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form class="add-modal-form">
                                <div class="modal-body">
                                    <div class="add-class-body">
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Teacher</label>
                                                    <select class='form-control' name='teacher'>
                                                        <option hidden disabled selected value> -- select a teacher -- </option>
                                                        <option value=''>teacher A</option>
                                                        <option value=''>teacher B</option>
                                                        <option value=''>teacher C</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Select Parent</label>
                                                    <select class='form-control' name='teacher'>
                                                        <option hidden disabled selected value> -- select a parent -- </option>
                                                        <option value=''>Parent A</option>
                                                        <option value=''>Parent B</option>
                                                        <option value=''>Parent C</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Class Name</label>
                                                    <input class='form-control' placeholder='Insert Class Name' type='text' name='title' />
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Category</label>
                                                    <select class='form-control' name='category'>
                                                        <option value='bg-danger'>Danger</option>
                                                        <option value='bg-success'>Success</option>
                                                        <option value='bg-purple'>Purple</option>
                                                        <option value='bg-primary'>Primary</option>
                                                        <option value='bg-dark'>Dark</option>
                                                        <option value='bg-info'>Info</option>
                                                        <option value='bg-warning'>Warning</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary cancel-event waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success create-event waves-effect waves-light">Create Class</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- EDIT & DELETE CLASS MODAL-->
                <div class="modal fade none-border" id="edit-event">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title edit-header"><strong>Edit Class</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form class="edit-modal-form">
                                <div class="modal-body">
                                    <label>Edit Class</label>
                                    <div class='input-group'>
                                        <input class='form-control' type=text name='title' value='' />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                                    <span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->
                <!-- ============================================================== -->
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
    <!-- Calendar JavaScript -->
    <script src="../assets/node_modules/calendar/jquery-ui.min.js"></script>
    <script src="../assets/node_modules/moment/moment.js"></script>
    <script src='../assets/node_modules/calendar/dist/fullcalendar.min.js'></script>
    <!-- <script src="../assets/node_modules/calendar/dist/cal-init.js"></script> -->

    <script>
        ! function($) {
            "use strict";
            var CalendarApp = function() {
                this.$calendar = $('#calendar'),
                    this.$calendarObj = null
            };

            /* on click exist class & edit or delete class*/
            CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                    // console.log("edit&delete here");
                    var $this = this;
                    var $modal = $('#edit-event');
                    var editform = $modal.find('.edit-modal-form');
                    editform.find("input[name='title']").val(calEvent.title);

                    $modal.modal({
                        backdrop: 'static'
                    });

                    $modal.find('.delete-event').off('click').click(function() {
                        $this.$calendarObj.fullCalendar('removeEvents', function(ev) {
                            return (ev._id == calEvent._id);
                        });
                        $modal.modal('hide');
                    });
                    
                    editform.off("submit").on('submit', function() {
                        // console.log("run start");
                        calEvent.title = editform.find("input[type=text]").val();
                        $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                        $modal.modal('hide');
                        // console.log("run done");
                        return false;
                    });
                },

                /* select day & add new class */
                CalendarApp.prototype.onSelect = function(start, end, allDay) {
                    // console.log("add here");
                    var $this = this;
                    var $modal = $('#add-event');
                    var addform = $modal.find('.add-modal-form');
                    $modal.modal({
                        backdrop: 'static'
                    });

                    addform.off('submit').on('submit', function() {
                        // console.log("on submit");
                        var title = addform.find("input[name='title']").val();
                        var beginning = addform.find("input[name='beginning']").val();
                        var ending = addform.find("input[name='ending']").val();
                        var categoryClass = addform.find("select[name='category'] option:checked").val();

                        if (title !== null && title.length != 0) {
                            $this.$calendarObj.fullCalendar('renderEvent', {
                                title: title,
                                start: start,
                                end: end,
                                allDay: false,
                                className: categoryClass
                            }, true);
                            $modal.modal('hide');
                        } else {
                            alert('You have to give a title to your event');
                        }
                        return false;
                    });

                    $modal.find('.create-event').off('click').click(function() {
                        addform.submit();
                    });

                    addform[0].reset();
                    $this.$calendarObj.fullCalendar('unselect');
                },

                /* Initializing */
                CalendarApp.prototype.init = function() {
                    /*  Initialize the calendar  */
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();
                    var form = '';
                    var today = new Date($.now());
                    var defaultEvents = [{
                            title: 'Released Ample Admin!',
                            start: new Date($.now() + 506800000),
                            className: 'bg-info'
                        }, {
                            title: 'This is today check date',
                            start: today,
                            end: today,
                            className: 'bg-danger'
                        }, {
                            title: 'This is your birthday',
                            start: new Date($.now() + 848000000),
                            className: 'bg-info'
                        }, {
                            title: 'your meeting with john',
                            start: new Date($.now() - 1099000000),
                            end: new Date($.now() - 919000000),
                            className: 'bg-warning'
                        }, {
                            title: 'your meeting with john',
                            start: new Date($.now() - 1199000000),
                            end: new Date($.now() - 1199000000),
                            className: 'bg-purple'
                        }, {
                            title: 'your meeting with john',
                            start: new Date($.now() - 399000000),
                            end: new Date($.now() - 219000000),
                            className: 'bg-info'
                        },
                        {
                            title: 'Hanns birthday',
                            start: new Date($.now() + 868000000),
                            className: 'bg-danger'
                        }, {
                            title: 'Like it?',
                            start: new Date($.now() + 348000000),
                            className: 'bg-success'
                        }
                    ];
                    var $this = this;
                    $this.$calendarObj = $this.$calendar.fullCalendar({
                        slotDuration: '00:15:00',
                        /* If we want to split day time each 15minutes */
                        minTime: '08:00:00',
                        maxTime: '19:00:00',
                        defaultView: 'month',
                        handleWindowResize: true,

                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay,listWeek'
                        },
                        events: defaultEvents,
                        editable: false,
                        droppable: false, // this allows things to be dropped onto the calendar !!!
                        eventLimit: true, // allow "more" link when too many events
                        selectable: true,
                        select: function(start, end, allDay) {
                            $this.onSelect(start, end, allDay);
                        },
                        eventClick: function(calEvent, jsEvent, view) {
                            $this.onEventClick(calEvent, jsEvent, view);
                        },

                    });
                },

                //init CalendarApp
                $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

        }(window.jQuery),

        //initializing CalendarApp
        function($) {
            "use strict";
            $.CalendarApp.init()
        }(window.jQuery);
    </script>

</body>

</html>