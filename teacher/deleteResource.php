<?php
session_start();
$response = array();
$userID = $_SESSION["userID"];
$resource_id = $_POST["resource_id"];

$conn = mysqli_connect("localhost", "root", "", "music_academy");
if ($conn) {
    $sql = "DELETE FROM LEARNING_RESOURCE WHERE RESOURCE_ID = '$resource_id' AND TEACHER_ID = '$userID'";
    if (mysqli_query($conn, $sql)) {
        $response['title']  = 'Delete Success!';
        $response['status']  = 'success';
        $response['message'] = 'Your file has been deleted!';
    } else {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'mysql error';
    }
} else {
    die("FATAL ERROR");
}
$conn->close();
echo json_encode($response);
