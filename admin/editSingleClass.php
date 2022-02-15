<?php
session_start();
$userID = $_SESSION["userID"];
$response = array();
$classID = $_POST['classID'];
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

    $sql = "SELECT * FROM CLASS WHERE CLASS_ID = '$classID' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_attendance = $row["ATTENDANCE"];
    }

    // IF CLASS NO ATTENDANCE, THEN CAN EDIT 
    if ($db_attendance == null ) {
        $start_datetime = $startDate . ' ' . $startTime . ':00';
        $end_datetime = $startDate . ' ' . $endTime . ':00';

        $sql = "UPDATE CLASS SET START_DATETIME ='$start_datetime', END_DATETIME = '$end_datetime', CLASS_DAY = '$dayCode', CLASS_LOCATION = '$location', CLASS_DESC = '$desc' WHERE CLASS_ID = '$classID'";
        if (mysqli_query($conn, $sql)) {
            $response['title']  = 'Done!';
            $response['status']  = 'success';
            $response['message'] = 'Class successfully edited!';
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'update class error!';
        }
    }else{
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'Cannot edit due to this class attendance is already set!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
