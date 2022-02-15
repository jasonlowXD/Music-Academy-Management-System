<?php
session_start();
$userID = $_SESSION["userID"];
$response = array();
$classID = $_POST['classID'];
$attendance = $_POST['attendance'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {

    $sql = "UPDATE CLASS SET ATTENDANCE ='$attendance' WHERE CLASS_ID = '$classID'";
    if (mysqli_query($conn, $sql)) {
        $response['title']  = 'Done!';
        $response['status']  = 'success';
        $response['message'] = 'Attendance updated successful!';
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'update attendance error!';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
