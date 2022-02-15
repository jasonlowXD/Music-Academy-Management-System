<?php
session_start();
$userID = $_SESSION["userID"];
$response = array();
$classID = $_POST['classID'];
$classGroupID = $_POST['classGroupID'];

//this date is user clicked and selected date from the calendar (original date)
$selectedCalendarDate = $_POST['selectedCalendarDate'];

//this date is user input new date
$startDate = $_POST['startDate'];
$day = $_POST['day'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$location = $_POST['location'];
$desc = $_POST['desc'];

$dayCode = '';
switch ($day) {
    case 'Sunday':
        $dayCode = '0';
        break;
    case 'Monday':
        $dayCode = '1';
        break;
    case 'Tuesday':
        $dayCode = '2';
        break;
    case 'Wednesday':
        $dayCode = '3';
        break;
    case 'Thrusday':
        $dayCode = '4';
        break;
    case 'Friday':
        $dayCode = '5';
        break;
    case 'Saturday':
        $dayCode = '6';
        break;
}

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $selectedCalendarDateTime = $selectedCalendarDate . '00:00:00';
    $calendarDate = new DateTime($selectedCalendarDate);
    $userInputdate = new DateTime($startDate);
    $interval = new DateInterval('P7D');

    $sql = "SELECT * FROM CLASS WHERE CLASSGROUP_ID = '$classGroupID' AND CLASS_ID >= '$classID' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_class_id = $row["CLASS_ID"];
        $db_start_datetime = $row["START_DATETIME"];
        $db_attendance = $row["ATTENDANCE"];
        $split_datetime = explode(" ", $db_start_datetime);
        $db_date = $split_datetime[0];
        $db_date = new DateTime($db_date);

        // IF CLASS NO ATTENDANCE, THEN CAN EDIT 
        // IF CURRENT LOOP DATABASE DATE IS MORE OR EQUAL TO USER SELECTED DATE
        if ($db_attendance == null && $db_date >= $calendarDate) {

            $date = $userInputdate->format('Y-m-d');
            $start_datetime = $date . ' ' . $startTime . ':00';
            $end_datetime = $date . ' ' . $endTime . ':00';
            $sql2 = "UPDATE CLASS SET START_DATETIME ='$start_datetime', END_DATETIME = '$end_datetime', CLASS_DAY = '$dayCode', CLASS_LOCATION = '$location', CLASS_DESC = '$desc' WHERE CLASS_ID = '$db_class_id' AND CLASSGROUP_ID = '$classGroupID'";
            if (mysqli_query($conn, $sql2)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'Classes are successful edited!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'update class error!';
                break;
            }
            $userInputdate->add($interval);
        } else if ($db_attendance != null) {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'Cannot edit due to this class attendance is already set!';
            break;
        }
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
