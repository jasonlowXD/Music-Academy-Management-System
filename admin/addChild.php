<?php
$emailCrash = false;
$phoneCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$parent_id = $_GET["parent_id"];
$childrenName = $_POST['childrenName'];
$childrenAge = $_POST['childrenAge'];
$childrenCourse = $_POST['childrenCourse'];
$childrenTeacher = $_POST['childrenTeacher'];
$childStatus = 'active';

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "INSERT INTO CHILD (CHILD_ID,PARENT_ID,TEACHER_ID,COURSE_ID,CHILD_NAME,CHILD_AGE,CHILD_STATUS) 
    VALUES ('','$parent_id','$childrenTeacher','$childrenCourse','$childrenName','$childrenAge','$childStatus')";

    if (mysqli_query($conn, $sql)) {
        $response['title']  = 'Done!';
        $response['status']  = 'success';
        $response['message'] = 'New child added!';
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
