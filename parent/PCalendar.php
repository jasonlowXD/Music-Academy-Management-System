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
                            <div class="card-body">
                                <div class="row text-left">
                                    <div class="col-md-12">
                                        <h4><strong>Class color code:</strong></h4>
                                    </div>
                                    <div class="col-md-12">
                                        <i class="fa fa-square text-primary"></i> Default
                                        <i class="fa fa-square text-success m-l-10"></i> Child present
                                        <i class="fa fa-square text-danger m-l-10"></i> Child absent
                                        <i class="fa fa-square text-warning m-l-10"></i> Pending reschedule request
                                    </div>
                                </div>
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
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table" id="class_detail_table>">
                                                <tbody>
                                                    <tr>
                                                        <td width="35%"><strong>Teacher :</strong></td>
                                                        <td class="teacher"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Child :</strong> </td>
                                                        <td class="child"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Course :</strong></td>
                                                        <td class="course"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Duration (min) :</strong></td>
                                                        <td class="duration"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Date :</strong></td>
                                                        <td class="date"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Start Time :</strong></td>
                                                        <td class="startTime"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>End Time :</strong></td>
                                                        <td class="endTime"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Location :</strong></td>
                                                        <td class="location"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Description :</strong></td>
                                                        <td class="desc"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Attendance :</strong></td>
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
                                        <form class="newRequest-modal-form" id="requestForm" method="post" action="addRequest.php">
                                            <div class='row'>
                                                <input class='request_classID' type='hidden' name='classID' readonly />
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Original Date</label>
                                                        <input type="text" name="originalDate" class="form-control originalDate" readonly />
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Original Time</label>
                                                        <input type='text' name='originalTime' class="form-control originalTime" readonly />
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>New Date</label>
                                                        <input type="text" name="newDate" class="form-control mydatepicker request_date" placeholder="yyyy-mm-dd" required />
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <div class='form-group'>
                                                        <label class="control-label">New Time</label>
                                                        <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                            <input type="text" class="form-control request_time" name="newTime" placeholder="Select time" required />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='col-md-12'>
                                                    <div class='form-group'>
                                                        <label class='control-label'>Reason</label>
                                                        <input class='form-control request_desc' placeholder='Reason here' type='text' name='desc' required />
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                        </form>


                                        <div id="requestRespondTable">
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
                selectable: false,
                editable: false,
                droppable: false,
                dayMaxEvents: 3, // allow "more" link when too many events
                eventMaxStack: 3,
                slotEventOverlap: false,

                // VIEW EVENT DETAILS & REQUEST RESCHEDULE
                eventClick: function(info) {
                    var $modal = $('#event-detail-modal');
                    var detailTable = $modal.find('#class_detail_table');

                    $modal.modal({
                        backdrop: 'static'
                    });

                    // GET VALUE from selected event
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
                    var startTime12hourFormat = startTimeMoment.format('h:mm a');

                    var endTimeInfo = eventObj.end;
                    var endTimeMoment = moment(endTimeInfo, 'HH:mm'); //convert to moment object
                    endTime = endTimeMoment.format('HH:mm');
                    var endTime12hourFormat = endTimeMoment.format('h:mm a');


                    teacher = eventObj.extendedProps[0].teacher;
                    duration = eventObj.extendedProps[0].duration;
                    loca = eventObj.extendedProps[0].location;
                    desc = eventObj.extendedProps[0].description;

                    // SET DATA VALUE INTO UI CLASS DETAILS
                    $(".teacher").text(teacher);
                    $(".child").text(child);
                    $(".course").text(course);
                    $(".duration").text(duration);
                    $(".date").text(datestring);
                    $(".startTime").text(startTime12hourFormat);
                    $(".endTime").text(endTime12hourFormat);

                    // CHECK THE LOCATION IS LINK OR NOT 
                    // console.log(loca.includes("http"))
                    if (loca.includes("http")) {
                        var locationHTML = '<a href="' + loca + '" target="_blank" rel="noopener noreferrer"">' + loca + '</a>';
                        $(".location").html(locationHTML);
                    } else {
                        $(".location").text(loca);
                    }

                    $(".desc").text(desc);

                    // SET ATTENDANCE STATUS 
                    attendance = eventObj.extendedProps[0].attendance;
                    // console.log(attendance);
                    var presentHTML = '<h4><span class="label label-success">Present</span></h4>';
                    var absentHTML = '<h4><span class="label label-danger">Absent</span></h4>';
                    var nullAttendHTML = '<span>-</span>';

                    if (attendance == 'present') {
                        $(".attendance").html(presentHTML);
                    } else if (attendance == 'absent') {
                        $(".attendance").html(absentHTML);
                    } else if (attendance == '' || attendance == null) {
                        $(".attendance").html(nullAttendHTML);
                    }

                    // SET SELECTED DATE AND TIME IN RESCHEDULE REQUEST FORM UI
                    var newRequestForm = $modal.find('#requestForm');
                    newRequestForm[0].reset();
                    newRequestForm.find(".request_classID").val(id);
                    newRequestForm.find(".originalDate").val(datestring);
                    newRequestForm.find(".originalTime").val(startTime);

                    newRequestForm.find('.request_date').val('');
                    newRequestForm.find('.request_time').val('');
                    newRequestForm.find('.request_desc').val('');

                    newRequestForm.find('.request_date').datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                        todayHighlight: true,
                        clearBtn: true,
                    });
                    newRequestForm.find('.request_date').datepicker('setStartDate', datestring);

                    var bg_color = eventObj.classNames[0];
                    // console.log(bg_color);

                    // IF CLASS ATTENDANCE IS PRESENT OR ALREADY GOT PENDING REQUEST, REQUEST FORM DISABLE 
                    if (bg_color == 'bg-warning' || bg_color == 'bg-success') {
                        newRequestForm.find("input").prop('disabled', true);
                        newRequestForm.find("button").prop('disabled', true);
                    }
                    // IF ATTENDANCE IS ABSENT OR DEFAULT CLASS, REQUEST FORM ENABLE 
                    else if (bg_color == 'bg-danger' || bg_color == 'bg-primary') {
                        newRequestForm.find("input").prop('disabled', false);
                        newRequestForm.find("button").prop('disabled', false);
                    }


                    // NEW RESCHEDULE REQUEST SUBMIT
                    newRequestForm.off("submit").on('submit', function(e) {
                        // console.log('request submit')
                        e.preventDefault();
                        var formData = new FormData(this);
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
                                $('html, body').css("cursor", "wait");
                                $.ajax({
                                    url: newRequestForm.attr('action'),
                                    type: newRequestForm.attr('method'),
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

                    // LOAD RESCHEDULE REQUEST ON THE CLASS SELECTED 
                    $.ajax({
                        url: 'loadRescheduleRequest.php?classID=' + id,
                        dataType: "json"
                    }).done(function(response) {
                        $('#requestRespondTable').html(response.output);
                    }).fail(function(xhr, textStatus, errorThrown) {
                        console.log(xhr);
                    })

                    calendar.refetchEvents();
                },
                events: 'loadClass.php',
            });

            calendar.render();
        });
    </script>

</body>

</html>