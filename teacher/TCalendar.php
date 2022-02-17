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
    <title>Teacher index</title>
    <!-- Calendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css" rel="stylesheet" />
    <!-- <link href="../assets/node_modules/calendar/dist/fullcalendar.css" rel="stylesheet" /> -->
    <!-- Page plugins css -->
    <link href="../assets/node_modules/clockpicker/dist/jquery-clockpicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <style>
        .datepicker {
            z-index: 1600 !important;
            /* has to be larger than 1050 */
        }

        .fc .fc-popover {
            z-index: 1040 !important;
        }
    </style>
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
                        <h4 class="text-themecolor">Class Calendar</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="TCalendar.php">Home</a></li>
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
                            <div class="card-body calender-sidebar">
                                <div id="calendar"></div>
                            </div>
                            <div class="card-body">
                                <div class="row text-left">
                                    <div class="col-md-12">
                                        <h4><strong>Class color code:</strong></h4>
                                    </div>
                                    <div class="col-md-12">
                                        <i class="fa fa-square text-primary"></i> Default
                                        <i class="fa fa-square text-success m-l-10"></i> Child present
                                        <i class="fa fa-square text-danger m-l-10"></i> Child absent
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $userID = $_SESSION["userID"];
                ?>
                <!-- CREATE CLASS EVENT MODAL-->
                <div class="modal fade none-border" id="add-event-modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title add-header"><strong>Add New Class</strong></h4>
                                <button type="button" class="close cancel-event" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form class="add-modal-form" id="addClassForm" method="post" action="addClass.php">
                                <div class="modal-body">
                                    <div class="add-class-body">
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Child</label>
                                                    <select class='form-control addClass_child_option' name='child' required>
                                                        <option hidden disabled selected value=""> -- select a child -- </option>
                                                        <?php
                                                        $conn = mysqli_connect("localhost", "root", "", "music_academy");
                                                        if ($conn) {
                                                            $sql = "SELECT * FROM CHILD WHERE TEACHER_ID = '$userID' AND CHILD_STATUS ='active'";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $child_id = $row["CHILD_ID"];
                                                                $child_name = $row["CHILD_NAME"];
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
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Course</label>
                                                    <div class="addClass_course_option">
                                                        <input class='form-control' type='text' name='course' placeholder="Select a child first" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Class duration (min)</label>
                                                    <div class="addClass_duration_option">
                                                        <input class='form-control' type='text' name='duration' placeholder="Select a child first" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Start Date</label>
                                                    <input class='form-control addClass_startDate' type='text' name='startDate' value="" readonly />
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='form-group'>
                                                    <label class='control-label'>End Date</label>
                                                    <input type="text" name="endDate" class="form-control mydatepicker addClass_endDate" placeholder="yyyy-mm-dd" required>
                                                </div>
                                            </div>
                                            <div class='col-md-4'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Day Repeat</label>
                                                    <input class='form-control addClass_day' type='text' name='day' value="" readonly />
                                                </div>
                                            </div>
                                            <div class='col-md-4'>
                                                <div class='form-group'>
                                                    <label class="control-label">Start Time</label>
                                                    <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                        <input type="text" class="form-control addClass_startTime" value="" name="startTime" placeholder="Select time" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-4'>
                                                <div class='form-group'>
                                                    <label class='control-label'>End Time</label>
                                                    <input class='form-control addClass_endTime' type='text' name='endTime' value="" readonly />
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Location</label>
                                                    <input class='form-control addClass_location' placeholder='Academy or Insert Online Link here' type='text' name='location' value="" required />
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='form-group'>
                                                    <label class='control-label'>Description</label>
                                                    <input class='form-control addClass_desc' placeholder='Description here' type='text' name='desc' value="" required />
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary cancel-event waves-effect" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success create-event waves-effect waves-light">Create Class</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- EDIT & DELETE CLASS EVENT MODAL-->
                <div class="modal fade none-border" id="edit-event-modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title edit-header"><strong>Class Details</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist" id="">
                                <li class="nav-item" id="editClassTabLink">
                                    <a class="nav-link active" data-toggle="tab" href="#editClass" role="tab">
                                        <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Class Edit</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#editAttandance" role="tab">
                                        <span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Attendance</span>
                                    </a>
                                </li>
                                <!-- respond reschedule request tab link -->
                                <li class="nav-item" id="rescheduleTabLink">
                                    <a class="nav-link" data-toggle="tab" href="#rescheduleRequest" role="tab">
                                        <span class="hidden-sm-up"><i class="ti-help"></i></span> <span class="hidden-xs-down">Reschedule Request</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <!-- edit class tab -->
                                <div class="tab-pane active" id="editClass" role="tabpanel">
                                    <form class="edit-modal-form" id="editClassForm" method="post">
                                        <div class="modal-body">
                                            <div class='row'>
                                                <input class='editClass_classID' type='hidden' name='classID' readonly />
                                                <input class='editClass_classGroupID' type='hidden' name='classGroupID' readonly />
                                                <input class='editClass_selectedCalendarDate' type='hidden' name='oldDate' readonly />
                                                <input class='editClass_selectedCalendarTime' type='hidden' name='oldTime' readonly />

                                                <div class='col-md-4'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Child</label>
                                                        <input class='form-control editClass_child' type='text' name='child' readonly />
                                                    </div>
                                                </div>
                                                <div class='col-md-4'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Course</label>
                                                        <input class='form-control editClass_course' type='text' name='course' readonly />
                                                    </div>
                                                </div>
                                                <div class='col-md-4'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Class duration (min)</label>
                                                        <input class='form-control editClass_duration' type='text' name='duration' readonly />
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Class Date</label>
                                                        <input type="text" name="startDate" class="form-control mydatepicker editClass_startDate" required />
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Class Day</label>
                                                        <input class='form-control editClass_day' type='text' name='day' readonly />
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class="control-label">Start Time</label>
                                                        <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                            <input type="text" class="form-control editClass_startTime" name="startTime" placeholder="Select time" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>End Time</label>
                                                        <input class='form-control editClass_endTime' type='text' name='endTime' readonly />
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Location</label>
                                                        <input class='form-control editClass_location' placeholder='Academy or Insert Online Link here' type='text' name='location' required />
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Description</label>
                                                        <input class='form-control editClass_desc' placeholder='Description here' type='text' name='desc' required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light">Delete</button>
                                            <span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light edit-event'><i class='fa fa-check'></i> Save</button></span>
                                        </div>
                                    </form>
                                </div>
                                <!-- edit attendance tab -->
                                <div class="tab-pane" id="editAttandance" role="tabpanel">
                                    <form method="post" id="editAttendanceForm" class="edit-attendance-form">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Today's Attendance</label>
                                                        <input class='editAttendance_classID' type='hidden' name='classID' readonly />
                                                        <div data-toggle="buttons">
                                                            <label class="btn btn-success">
                                                                <input type="radio" class="editAttandance_input" name="attendance" autocomplete="off" value="present"> Present
                                                            </label>
                                                            <label class="btn btn-danger">
                                                                <input type="radio" class="editAttandance_input" name="attendance" autocomplete="off" value="absent"> Absent
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- respond reschedule request tab -->
                                <div class="tab-pane" id="rescheduleRequest" role="tabpanel">
                                    <div class="modal-body">
                                        <div class='d-none' id="noRequestDiv">
                                            <p>no request from parent</p>
                                        </div>
                                        <div class='d-none' id="requestRespondTable">
                                            <div class="table-responsive">
                                                <table id="rescheduleListTable" class="table table-hover" data-page-size="5">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5%;">#</th>
                                                            <th style="width:25%;">Parent</th>
                                                            <th style="width:30%;">New Date & Time</th>
                                                            <th style="width:30%;">Description</th>
                                                            <th style="width:5%;">Status</th>
                                                            <th style="width:5%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>leong jun kit</td>
                                                            <td>2021-09-30 11:00</td>
                                                            <td>child urgent sick child urgent sick child urgent sick</td>
                                                            <td><span class="label label-danger">Rejected</span></td>
                                                            <td>
                                                                <div class="btn-group-vertical">
                                                                    <button type="button" class="btn btn-sm btn-info mb-1" disabled> Accept</button>
                                                                    <button type="button" class="btn btn-sm btn-danger mt-1" disabled>Reject</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>jason low jia wei</td>
                                                            <td>2021-10-05 10:00</td>
                                                            <td>not free that day</td>
                                                            <td><span class="label label-warning">Pending</span></td>
                                                            <td>
                                                                <div class="btn-group-vertical">
                                                                    <button type="button" id="accept" class="btn btn-sm btn-info mb-1"> Accept</button>
                                                                    <button type="button" id="reject" class="btn btn-sm btn-danger mt-1">Reject</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <!-- <script src='../assets/node_modules/calendar/dist/fullcalendar.min.js'></script> -->
    <!-- fullcalendar bundle -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script>
    <!-- Sweet-Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="../assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <script>
        // CLOCKPICKER
        // https://weareoutman.github.io/clockpicker/
        $('.clockpicker').clockpicker();


        // add the responsive classes after page initialization
        window.onload = function() {
            $('.fc-toolbar.fc-header-toolbar').addClass('row col-12');
        };

        //FULLCALENDAR V5
        document.addEventListener('DOMContentLoaded', function() {
            var day, dayName, fulldate, datestring, timeString;
            var id, classGroupID, teacher, child, course, duration, startDate, endDate, startTime, endTime, loca, desc, attendance;

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                slotDuration: '00:15:00',
                slotMinTime: '08:00:00',
                slotMaxTime: '19:00:00',
                initialView: 'dayGridMonth',
                height: 'auto',
                windowResize: function(view) {
                    if (window.innerWidth >= 768) {
                        calendar.changeView('dayGridMonth');
                    } else if (window.innerWidth >= 400) {
                        calendar.changeView('timeGridWeek');
                    } else if (window.innerWidth < 400) {
                        calendar.changeView('timeGridDay');
                    }
                },
                handleWindowResize: true,
                longPressDelay: 100,
                selectable: true,
                editable: false,
                droppable: false,
                dayMaxEvents: 3, // allow "more" link when too many events
                eventMaxStack: 3,
                slotEventOverlap: false,

                dateClick: function(info) {
                    fulldate = info.date;
                    // console.log(fulldate);
                    day = fulldate.getDay(); //get the day (0=sunday, 1=monday...)
                    switch (day) {
                        case 0:
                            dayName = 'Sunday';
                            break;
                        case 1:
                            dayName = 'Monday';
                            break;
                        case 2:
                            dayName = 'Tuesday';
                            break;
                        case 3:
                            dayName = 'Wednesday';
                            break;
                        case 4:
                            dayName = 'Thrusday';
                            break;
                        case 5:
                            dayName = 'Friday';
                            break;
                        case 6:
                            dayName = 'Saturday';
                            break;
                    }
                    // console.log(dayName);

                    //calendar week view and day view dateStr is "2021-10-13T10:30:00+08:00", need use split function to get date only
                    //toTimeString() will get "00:00:00 GMT+0800 (Malaysia Time)", need use split function to get time only

                    datestring = info.dateStr;
                    var finalDateString = datestring.split("T")[0];
                    // console.log(finalDateString);

                    timeString = info.date.toTimeString();
                    var finalTimeString = timeString.split(" ")[0];
                    var finalTimeString = finalTimeString.split(":")[0] + ':' + finalTimeString.split(":")[1];
                    // console.log(finalTimeString);

                    var $modal = $('#add-event-modal');
                    var addform = $modal.find('#addClassForm');
                    addform.find(".addClass_startDate").val(finalDateString);
                    addform.find(".addClass_startTime").val(finalTimeString);
                    addform.find(".addClass_day").val(dayName);

                    addform.find('.addClass_endDate').datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                        todayHighlight: true,
                        clearBtn: true,
                    });
                    addform.find('.addClass_endDate').datepicker('setStartDate', finalDateString);
                },

                // CREATE NEW EVENT FUNCTION
                select: function(arg) {
                    // console.log(arg);                 

                    var $modal = $('#add-event-modal');
                    var addform = $modal.find('#addClassForm');
                    $modal.modal({
                        backdrop: 'static'
                    });

                    addform.find(".addClass_course_option").html('<input type = "text" name = "course" class="form-control" value="" placeholder="Select a child first" readonly>');
                    addform.find(".addClass_duration_option").html('<input type = "text" name = "duration" class="form-control" value="" placeholder="Select a child first" readonly>');

                    // get course info after selected child
                    $(document).on('change', 'select.addClass_child_option', function() {
                        var childSelected = $(this).val();
                        $.ajax({
                                url: 'getChildCourseInfo.php',
                                type: 'POST',
                                data: {
                                    child_id: childSelected
                                },
                                dataType: 'json',
                            })
                            .done(function(response) {
                                addform.find(".addClass_course_option").html(response.course_output);
                                addform.find(".addClass_duration_option").html(response.duration_output);

                                duration = addform.find(".addClass_duration_input").val();
                                startTime = addform.find(".addClass_startTime").val();
                                var startTimeMoment = moment(startTime, 'HH:mm'); //convert from value to moment format
                                var startTimeStr = startTimeMoment.format('HH:mm');
                                var endTime = startTimeMoment.add(duration, 'm').format('HH:mm');
                                addform.find(".addClass_endTime").val(endTime);


                            }).fail(function(xhr, textStatus, errorThrown) {
                                console.log(xhr.responseText);
                            })
                    });

                    // SET NEW ENDTIME WHEN CLOCKPICKER CHANGED IN STARTTIME 
                    $('.clockpicker').clockpicker().find('.addClass_startTime').change((e) => {
                        // console.log(e.currentTarget.value);
                        duration = addform.find(".addClass_duration_input").val();
                        startTime = e.currentTarget.value;
                        var startTimeMoment = moment(startTime, 'HH:mm'); //convert from value to moment format
                        var startTimeStr = startTimeMoment.format('HH:mm');
                        var endTime = startTimeMoment.add(duration, 'm').format('HH:mm');
                        addform.find(".addClass_endTime").val(endTime);
                    });


                    addform.off("submit").on('submit', function(e) {
                        // console.log("on submit");
                        e.preventDefault();
                        $('html, body').css("cursor", "wait");
                        var formData = new FormData(this);
                        $.ajax({
                            url: addform.attr('action'),
                            type: addform.attr('method'),
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: 'json'
                        }).done(function(response) {
                            if (response.status == 'success') {
                                Swal.fire(
                                    response.title,
                                    response.message,
                                    response.status
                                ).then(() => {
                                    // location.reload();
                                    $modal.modal('hide');
                                    addform[0].reset();
                                    calendar.unselect();
                                })
                                $('html, body').css("cursor", "auto");
                            } else {
                                // console.log(response.message)
                                Swal.fire(
                                    response.title,
                                    response.message,
                                    response.status
                                )
                                $('html, body').css("cursor", "auto");
                            }
                        }).fail(function(xhr, textStatus, errorThrown) {
                            Swal.fire(
                                'Oops...',
                                'Something went wrong with ajax!',
                                'error'
                            )
                            $('html, body').css("cursor", "auto");
                            console.log(xhr);
                        })
                        calendar.refetchEvents();
                    });
                    addform[0].reset();
                    calendar.unselect();
                    calendar.refetchEvents();
                },

                // EDIT/DELETE EVENT FUNCTION
                eventClick: function(info) {
                    // console.log("edit&delete here");
                    var $modal = $('#edit-event-modal');
                    var editform = $modal.find('#editClassForm');
                    var editAttendanceForm = $modal.find('#editAttendanceForm');

                    $modal.modal({
                        backdrop: 'static'
                    });

                    // GET EXISTING VALUE of selected event
                    var eventObj = info.event;
                    // console.log(info.event.start.getDay()); 
                    day = eventObj.start.getDay(); //get the day (0=sunday, 1=monday...)
                    switch (day) {
                        case 0:
                            dayName = 'Sunday';
                            break;
                        case 1:
                            dayName = 'Monday';
                            break;
                        case 2:
                            dayName = 'Tuesday';
                            break;
                        case 3:
                            dayName = 'Wednesday';
                            break;
                        case 4:
                            dayName = 'Thrusday';
                            break;
                        case 5:
                            dayName = 'Friday';
                            break;
                        case 6:
                            dayName = 'Saturday';
                            break;
                    }
                    id = eventObj.id;

                    // console.log(eventObj);

                    var childCourse = eventObj.title.split(",");
                    child = childCourse[0];
                    course = childCourse[1];

                    var datestringInfo = eventObj.start;
                    var datestringMoment = moment(datestringInfo, "YYYY-MM-DD");
                    datestring = datestringMoment.format('YYYY-MM-DD')

                    var startTimeInfo = eventObj.start;
                    var startTimeMoment = moment(startTimeInfo, 'HH:mm'); //convert to moment object
                    startTime = startTimeMoment.format('HH:mm');

                    var endTimeInfo = eventObj.end;
                    var endTimeMoment = moment(endTimeInfo, 'HH:mm'); //convert to moment object
                    endTime = endTimeMoment.format('HH:mm');

                    classGroupID = eventObj.extendedProps[0].classGroup;
                    teacher = eventObj.extendedProps[0].teacher;
                    duration = eventObj.extendedProps[0].duration;
                    loca = eventObj.extendedProps[0].location;
                    desc = eventObj.extendedProps[0].description;

                    // EDIT FORM VALUE DISPLAY 
                    editform.find(".editClass_classID").val(id);
                    editform.find(".editClass_classGroupID").val(classGroupID);
                    editform.find(".editClass_selectedCalendarDate").val(datestring);
                    editform.find(".editClass_selectedCalendarTime").val(startTime);

                    editform.find(".editClass_child").val(child);
                    editform.find(".editClass_course").val(course);
                    editform.find(".editClass_duration").val(duration);
                    editform.find(".editClass_startDate").val(datestring);
                    editform.find(".editClass_day").val(dayName);
                    editform.find(".editClass_startTime").val(startTime);
                    editform.find(".editClass_endTime").val(endTime);
                    editform.find(".editClass_location").val(loca);
                    editform.find(".editClass_desc").val(desc);

                    // EDIT ATTENDANCE FORM VALUE DISPLAY 
                    attendance = eventObj.extendedProps[0].attendance;
                    editAttendanceForm.find(".editAttendance_classID").val(id);
                    if (attendance != null) {
                        editAttendanceForm.find('input[name = "attendance"][value = "' + attendance + '"]').prop('checked', true);
                    } else {
                        editAttendanceForm.find('input[name = "attendance"]').prop('checked', false);
                    }

                    editform.find('.editClass_startDate').datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                        todayHighlight: true,
                        clearBtn: true,
                    });

                    // SET NEW DAY WHEN DATEPICKER CHANGED IN STARTDATE 
                    $('.editClass_startDate').datepicker().change((e) => {
                        // console.log(e.currentTarget.value);
                        var eventDate = e.currentTarget.value;
                        var date = new Date(eventDate).getDay(); //To avoid timezone issues
                        var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                        var day = weekday[date];
                        // console.log(day);
                        editform.find(".editClass_day").val(day);
                    });

                    // SET NEW ENDTIME WHEN CLOCKPICKER CHANGED IN STARTTIME 
                    $('.clockpicker').clockpicker().find('.editClass_startTime').change((e) => {
                        // console.log(e.currentTarget.value);
                        duration = editform.find(".editClass_duration").val();
                        startTime = e.currentTarget.value;
                        var startTimeMoment = moment(startTime, 'HH:mm'); //convert from value to moment format
                        var startTimeStr = startTimeMoment.format('HH:mm');
                        var endTime = startTimeMoment.add(duration, 'm').format('HH:mm');
                        editform.find(".editClass_endTime").val(endTime);
                    });

                    // EDIT CLASS DETAILS EVENT
                    editform.off("submit").on('submit', function(e) {
                        // console.log("edit start");
                        e.preventDefault();
                        var formData = new FormData(this);

                        Swal.fire({
                            title: 'Confirm Edit?',
                            icon: 'warning',
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'This Class Only!',
                            showDenyButton: true,
                            denyButtonColor: '#009c75',
                            denyButtonText: 'This and following class!',
                            showCloseButton: true
                        }).then((result) => {
                            // EDIT ONLY CURRENT SELECTED CLASS
                            if (result.isConfirmed) {
                                $('html, body').css("cursor", "wait");
                                $.ajax({
                                    url: 'editSingleClass.php',
                                    type: editform.attr('method'),
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    dataType: 'json'
                                }).done(function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire(
                                            response.title,
                                            response.message,
                                            response.status
                                        ).then(() => {
                                            $modal.modal('hide');
                                            editform[0].reset();
                                            calendar.unselect();
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
                                }).fail(function(xhr, textStatus, errorThrown) {
                                    Swal.fire(
                                        'Oops...',
                                        'Something went wrong with ajax!',
                                        'error'
                                    )
                                    $('html, body').css("cursor", "auto");
                                    console.log(xhr);
                                })
                                calendar.refetchEvents();
                            }
                            // EDIT CURRENT AND FOLLOWING WITH SAME CLASSGROUP CLASS
                            else if (result.isDenied) {
                                $('html, body').css("cursor", "wait");
                                $.ajax({
                                    url: 'editMultipleClass.php',
                                    type: editform.attr('method'),
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    dataType: 'json'
                                }).done(function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire(
                                            response.title,
                                            response.message,
                                            response.status
                                        ).then(() => {
                                            $modal.modal('hide');
                                            calendar.unselect();
                                        })
                                        $('html, body').css("cursor", "auto");
                                    } else {
                                        Swal.fire(
                                            response.title,
                                            response.message,
                                            response.status
                                        )
                                        // console.log(response.message)
                                        $('html, body').css("cursor", "auto");
                                    }
                                }).fail(function(xhr, textStatus, errorThrown) {
                                    Swal.fire(
                                        'Oops...',
                                        'Something went wrong with ajax!',
                                        'error'
                                    )
                                    $('html, body').css("cursor", "auto");
                                    console.log(xhr);
                                })
                                calendar.refetchEvents();
                            }
                        })
                        calendar.refetchEvents();
                    });

                    // EDIT ATTENDANCE EVENT
                    editAttendanceForm.off("submit").on('submit', function(e) {
                        e.preventDefault();
                        var id = editAttendanceForm.find(".editAttendance_classID").val();
                        var attend = editAttendanceForm.find(".editAttandance_input:checked").val();
                        // console.log(id)
                        // console.log(attend)
                        Swal.fire({
                            title: 'Confirm Edit Attendance?',
                            icon: 'warning',
                            allowOutsideClick: false,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, confirm!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('html, body').css("cursor", "wait");
                                $.ajax({
                                    url: 'editAttendance.php',
                                    type: editAttendanceForm.attr('method'),
                                    data: {
                                        classID: id,
                                        attendance: attend
                                    },
                                    dataType: 'json'
                                }).done(function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire(
                                            response.title,
                                            response.message,
                                            response.status
                                        ).then(() => {
                                            $modal.modal('hide');
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
                                }).fail(function(xhr, textStatus, errorThrown) {
                                    Swal.fire(
                                        'Oops...',
                                        'Something went wrong with ajax!',
                                        'error'
                                    )
                                    $('html, body').css("cursor", "auto");
                                    console.log(xhr);
                                })
                                calendar.refetchEvents();
                            }
                        });
                        calendar.refetchEvents();
                    });

                    // DELETE EVENT
                    $modal.find('.delete-event').off('click').click(function(e) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Confirm Delete?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'This class only!',
                            showDenyButton: true,
                            denyButtonColor: '#009c75',
                            denyButtonText: 'This and following class!',
                            showCloseButton: true
                        }).then((result) => {
                            // DELETE ONLY CURRENT SELECTED CLASS
                            if (result.isConfirmed) {
                                // console.log(id);
                                $('html, body').css("cursor", "wait");
                                $.ajax({
                                    url: 'deleteSingleClass.php',
                                    type: 'POST',
                                    data: {
                                        classID: id,
                                        classGroupID: classGroupID
                                    },
                                    dataType: 'json'
                                }).done(function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire(
                                            response.title,
                                            response.message,
                                            response.status
                                        ).then(() => {
                                            $modal.modal('hide');
                                            editform[0].reset();
                                            calendar.unselect();
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
                                }).fail(function(xhr, textStatus, errorThrown) {
                                    Swal.fire(
                                        'Oops...',
                                        'Something went wrong with ajax!',
                                        'error'
                                    )
                                    $('html, body').css("cursor", "auto");
                                    console.log(xhr);
                                })
                                calendar.refetchEvents();
                            }
                            // DELETE CURRENT AND FOLLOWING WITH SAME CLASSGROUP CLASS 
                            else if (result.isDenied) {
                                $('html, body').css("cursor", "wait");
                                $.ajax({
                                    url: 'deleteMultipleClass.php',
                                    type: 'POST',
                                    data: {
                                        classID: id,
                                        classGroupID: classGroupID,
                                        selectedDate: datestring
                                    },
                                    dataType: 'json'
                                }).done(function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire(
                                            response.title,
                                            response.message,
                                            response.status
                                        ).then(() => {
                                            $modal.modal('hide');
                                            editform[0].reset();
                                            calendar.unselect();
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
                                }).fail(function(xhr, textStatus, errorThrown) {
                                    Swal.fire(
                                        'Oops...',
                                        'Something went wrong with ajax!',
                                        'error'
                                    )
                                    $('html, body').css("cursor", "auto");
                                    console.log(xhr);
                                })
                                calendar.refetchEvents();
                            }
                        })
                        calendar.refetchEvents();
                    });


                    // CHECK THE EVENT GOT RESCHEDULE REQUEST OR NOT, IF GOT REQUEST THEN DISPLAY THE REQUEST TABLE
                    // console.log(eventObj.classNames[0])
                    if (eventObj.classNames[0] == 'bg-warning' || eventObj.classNames[0] == 'bg-success' || eventObj.classNames[0] == 'bg-danger') {
                        // console.log('warning here')
                        $("#requestRespondTable").removeClass('d-none');
                        $("#noRequestDiv").addClass('d-none');
                    } else if (eventObj.classNames[0] == 'bg-primary') {
                        // console.log('others here')
                        $("#noRequestDiv").removeClass('d-none');
                        $("#requestRespondTable").addClass('d-none');
                    }

                    var rescheduleListTable = $modal.find('#rescheduleListTable');

                    // ACCEPT RESCHEDULE EVENT
                    rescheduleListTable.on('click', '#accept', function() {
                        var $row = $(this).closest("tr"); // Finds the closest row <tr> 
                        var $rowId = $row.find("td:nth-child(1)"); // Finds the 1st <td> element

                        //row id
                        console.log($rowId.text());
                        Swal.fire(
                            'Accepted!',
                            'id ' + $rowId.text() + ' request has been accepted.',
                            'success'
                        )

                    });

                    // REJECT RESCHEDULE EVENT
                    rescheduleListTable.on('click', '#reject', function() {
                        var $row = $(this).closest("tr"); // Finds the closest row <tr> 
                        var $rowId = $row.find("td:nth-child(1)"); // Finds the 2nd <td> element
                        //row id
                        console.log($rowId.text());
                        Swal.fire(
                            'Rejected!',
                            'id ' + $rowId.text() + ' request has been rejected.',
                            'success'
                        )

                    });

                    calendar.refetchEvents();
                },
                events: 'loadClass.php',
            });

            calendar.render();
        });
    </script>

</body>

</html>