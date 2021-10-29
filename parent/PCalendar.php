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
    <title>Parent index</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css" rel="stylesheet" />
    <!-- <link href="../assets/node_modules/calendar/dist/fullcalendar.css" rel="stylesheet" /> -->
    <!-- Page plugins css -->
    <link href="../assets/node_modules/clockpicker/dist/jquery-clockpicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="../assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                        <h4 class="text-themecolor">Class Calendar</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="PCalendar.php">Home</a></li>
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
                        </div>
                    </div>
                </div>

                <!-- CLASS DETAIL EVENT MODAL-->
                <div class="modal fade none-border" id="event-detail-modal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title edit-header"><strong>Class Details</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist" id="myTabs">
                                <li class="nav-item" id="classDetailTabLink">
                                    <a class="nav-link active" data-toggle="tab" href="#classdetail" role="tab">
                                        <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Class Details</span>
                                    </a>
                                </li>
                                <!-- respond reschedule request tab link -->
                                <li class="nav-item" id="rescheduleTabLink">
                                    <a class="nav-link" data-toggle="tab" href="#makeRescheduleRequest" role="tab">
                                        <span class="hidden-sm-up"><i class="ti-marker-alt"></i></span> <span class="hidden-xs-down">Make Reschedule Request</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <!-- class detail tab -->
                                <div class="tab-pane active" id="classdetail" role="tabpanel">
                                    <div class="modal-body ">
                                        <div class="table-responsive">
                                            <table class="table class-detail-table">
                                                <tbody>
                                                    <tr>
                                                        <td width="200">Teacher :</td>
                                                        <td class="teacherName"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Children :</td>
                                                        <td class="childrenName"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Course :</td>
                                                        <td class="courseName"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Duration (min) :</td>
                                                        <td class="duration"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date :</td>
                                                        <td class="date"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Start Time :</td>
                                                        <td class="startTime"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>End Time :</td>
                                                        <td class="endTime"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location :</td>
                                                        <td class="location"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Description :</td>
                                                        <td class="desc"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Attendance :</td>
                                                        <td class="attendance">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                                <!-- respond reschedule request tab -->
                                <div class="tab-pane" id="makeRescheduleRequest" role="tabpanel">
                                    <div class="modal-body">
                                        <form class="newRequest-modal-form">
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Selected Date</label>
                                                        <input type="text" name="selectedDate" class="form-control mydatepicker" disabled />
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Selected Time</label>
                                                        <input class='form-control' type='text' name='selectedTime' disabled />
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>New Date</label>
                                                        <input type="text" id="bdate" name="newDate" class="form-control mydatepicker" placeholder="yyyy-mm-dd" required />
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class="control-label">New Time</label>
                                                        <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                            <input type="text" class="form-control" name="newTime" placeholder="Select time" required />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Description</label>
                                                        <input class='form-control' placeholder='Description here' type='text' name='desc' required />
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                        </form>

                                        <hr>
                                        <div class='d-none' id="requestRespondTable">
                                            <h4><strong>Request Respond</strong></h4>
                                            <div class="table-responsive ">
                                                <table id="rescheduleListTable" class="table m-t-5 table-hover contact-list" data-page-size="5">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th width="130">New Date</th>
                                                            <th width="130">New Time</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>2021-09-30</td>
                                                            <td>11:00</td>
                                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis sollicitudin orci, vitae convallis est. Cras tempor, lectus feugiat placerat condimentum, sem nisi vehicula ex, fermentum tincidunt eros velit nec felis. </td>
                                                            <td><span class="label label-danger">Rejected</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>2021-10-05</td>
                                                            <td>10:00</td>
                                                            <td>not free that day</td>
                                                            <td><span class="label label-warning">Pending</span></td>
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

        // Date Picker
        $('.mydatepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        });

        // add the responsive classes after page initialization
        window.onload = function() {
            $('.fc-toolbar.fc-header-toolbar').addClass('row col-12');
        };

        //FULLCALENDAR V5
        document.addEventListener('DOMContentLoaded', function() {
            var day, dayName, fulldate, datestring;
            var teacher, children, course, duration, startTime, location, desc;

            var dataEvent = dummyData();

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
                longPressDelay: 1000,
                selectable: false,
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

                    datestring = info.dateStr;
                    // console.log(datestring);
                },

                // EDIT/DELETE EVENT FUNCTION
                eventClick: function(info) {
                    var $modal = $('#event-detail-modal');
                    var detailTable = $modal.find('.class-detail-table');

                    $modal.modal({
                        backdrop: 'static'
                    });

                    // GET VALUE from selected event
                    var eventObj = info.event;
                    // console.log(info.event.start.getDay()); 
                    var day = eventObj.start.getDay(); //get the day (0=sunday, 1=monday...)
                    var dayName;
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
                    var id = eventObj.id;
                    // var id = eventObj.groupId;
                    // var eventGroupId = calendar.getEvents().filter(function(event) {
                    //     return event.groupId === id;
                    // });
                    // console.log(eventGroupId);
                    var teacherChildren = eventObj.title.split(",");
                    teacher = teacherChildren[0];
                    children = teacherChildren[1];

                    var datestringInfo = eventObj.start;
                    var datestringMoment = moment(datestringInfo, "YYYY-MM-DD");
                    var datestring = datestringMoment.format('YYYY-MM-DD')

                    duration = 60;
                    var startTimeInfo = eventObj.start;
                    var startTimeMoment = moment(startTimeInfo, 'HH:mm'); //convert to moment object
                    startTime = startTimeMoment.format('HH:mm');

                    var endTime = startTimeMoment.add(duration, 'm').format('HH:mm');
                    // console.log(startTime);

                    location = eventObj.extendedProps.location;
                    var locationHTML = '<a href="https://apps.google.com/meet/" class="remove">' + location + '</a>'
                    desc = eventObj.extendedProps.description;

                    // SET DATA VALUE INTO UI CLASS DETAILS
                    detailTable.find(".teacherName").text(teacher);
                    detailTable.find(".childrenName").text(children);
                    detailTable.find(".courseName").text('Piano grade 1');
                    detailTable.find(".duration").text(duration);
                    detailTable.find(".date").text(datestring);
                    detailTable.find(".startTime").text(startTime);
                    detailTable.find(".endTime").text(endTime);
                    detailTable.find(".remove").remove();
                    detailTable.find(".location").append(locationHTML);
                    detailTable.find(".desc").text(desc);

                    var attendance = eventObj.extendedProps.attendance;
                    // console.log(attendance);
                    var presentHTML = '<h4 class="remove"><span class="label label-success">Present</span></h4>';
                    var absentHTML = '<h4 class="remove"><span class="label label-danger">Absent</span></h4>';
                    var nullAttendHTML = '<span class="remove">-</span>';
                    if (attendance == '1') {
                        detailTable.find(".attendance").append(presentHTML);
                    } else if (attendance == '0') {
                        detailTable.find(".attendance").append(absentHTML);
                    } else if (attendance == '') {
                        detailTable.find(".attendance").append(nullAttendHTML);
                    }

                    // CHECK THE EVENT GOT RESCHEDULE REQUEST OR NOT, IF GOT REQUEST THEN DISPLAY THE REQUEST TABLE
                    // console.log(eventObj.classNames[0])
                    if (eventObj.classNames[0] == 'bg-warning') {
                        // console.log('warning here')
                        $("#requestRespondTable").removeClass('d-none');
                    } else if (eventObj.classNames[0] == 'bg-success' || eventObj.classNames[0] == 'bg-danger' || eventObj.classNames[0] == 'bg-primary') {
                        // console.log('others here')
                        $("#requestRespondTable").addClass('d-none');
                    }
                    // SET SELECTED DATE AND TIME IN RESCHEDULE REQUEST FORM UI
                    var newRequestForm = $modal.find('.newRequest-modal-form');
                    newRequestForm.find("input[name='selectedDate']").val(datestring);
                    newRequestForm.find("input[name='selectedTime']").val(startTime);

                    // NEW RESCHEDULE REQUEST SUBMIT
                    newRequestForm.on('submit', function() {

                        Swal.fire({
                            title: 'Submit Request?',
                            icon: 'warning',
                            allowOutsideClick: false,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, confirm!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log("submitted");
                                newRequestForm[0].reset();
                                $modal.modal('hide');
                                Swal.fire(
                                    'Done!',
                                    'The request is sent to the ' + teacher,
                                    'success'
                                )
                            }
                        })
                        return false;
                    });
                },
                events: dataEvent,
            });

            calendar.render();
        });

        function dummyData() {
            var dataEvent = [{
                id: 1,
                title: 'teacher A,children B',
                start: '2021-10-04T10:00:00',
                end: '2021-10-04T11:00:00',
                className: 'bg-danger',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: '0'
                }
            }, {
                id: 2,
                title: 'teacher A,children B',
                start: '2021-10-11T10:00:00',
                end: '2021-10-11T11:00:00',
                className: 'bg-success',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: '1'
                }
            }, {
                id: 3,
                title: 'teacher A,children B',
                start: '2021-10-18T10:00:00',
                end: '2021-10-18T11:00:00',
                className: 'bg-warning',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 4,
                title: 'teacher A,children B',
                start: '2021-10-25T10:00:00',
                end: '2021-10-25T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 5,
                title: 'teacher A,children B',
                start: '2021-11-01T10:00:00',
                end: '2021-11-01T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 6,
                title: 'teacher A,children B',
                start: '2021-11-08T10:00:00',
                end: '2021-11-08T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 7,
                title: 'teacher A,children B',
                start: '2021-11-15T10:00:00',
                end: '2021-11-15T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 8,
                title: 'teacher A,children B',
                start: '2021-11-22T10:00:00',
                end: '2021-11-22T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 9,
                title: 'teacher A,children B',
                start: '2021-11-29T10:00:00',
                end: '2021-11-29T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 10,
                title: 'teacher A,children B',
                start: '2021-12-06T10:00:00',
                end: '2021-12-06T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 11,
                title: 'teacher A,children B',
                start: '2021-12-13T10:00:00',
                end: '2021-12-13T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 12,
                title: 'teacher A,children B',
                start: '2021-12-20T10:00:00',
                end: '2021-12-20T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 13,
                title: 'teacher A,children B',
                start: '2021-12-27T10:00:00',
                end: '2021-12-27T11:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 1,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 14,
                title: 'teacher C,children A',
                start: '2021-10-07T14:00:00',
                end: '2021-10-07T15:00:00',
                className: 'bg-warning',
                extendedProps: {
                    classGroup: 2,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 15,
                title: 'teacher C,children A',
                start: '2021-10-14T14:00:00',
                end: '2021-10-14T15:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 2,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 16,
                title: 'teacher C,children A',
                start: '2021-10-21T14:00:00',
                end: '2021-10-21T15:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 2,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 17,
                title: 'teacher C,children A',
                start: '2021-10-28T14:00:00',
                end: '2021-10-28T15:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 2,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 18,
                title: 'teacher B,children A',
                start: '2021-10-18T13:00:00',
                end: '2021-10-18T14:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 3,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 19,
                title: 'teacher B,children A',
                start: '2021-10-18T15:00:00',
                end: '2021-10-18T16:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 4,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }, {
                id: 20,
                title: 'teacher B,children A',
                start: '2021-10-18T17:00:00',
                end: '2021-10-18T18:00:00',
                className: 'bg-primary',
                extendedProps: {
                    classGroup: 5,
                    location: 'www.google.com',
                    description: 'learn beginner things',
                    attendance: ''
                }
            }];

            return dataEvent;
        }
    </script>

</body>

</html>