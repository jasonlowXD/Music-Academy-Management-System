<?php

$nameCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$courseName = $_POST['courseName'];
$courseFee = $_POST['courseFee'];
$courseDuration = $_POST['courseDuration'];
$courseDesc = htmlspecialchars($_POST['courseDesc']);

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    // CHECK GOT CRASH COURSE NAME IN DATABASE OR NOT

    // CHECK COURSE NAME IN COURSE TABLE 
    $sql = "SELECT COUNT(*) FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_NAME =  '$courseName' ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $course_count = $row["COUNT(*)"];
    }

    // IF COURSE NAME CRASH IN DATABASE
    if ($course_count > 0) {
        $nameCrash = true;
    }

    if ($nameCrash) {
        $response['title']  = 'Error!';
        $response['status']  = 'error';
        $response['message'] = 'Course name is existed in database!';
    }

    // IF ALL NO CRASH, ADD NEW COURSE
    else {
        $courseStatus = 'active';
        $sql2 = "INSERT INTO COURSE (COURSE_ID,ADMIN_ID,COURSE_NAME,COURSE_FEE,COURSE_DURATION,COURSE_DESC,COURSE_STATUS) 
        VALUES ('','$userID','$courseName','$courseFee','$courseDuration','$courseDesc','$courseStatus')";

        if (mysqli_query($conn, $sql2)) {
            $response['title']  = 'Done!';
            $response['status']  = 'success';
            $response['message'] = 'New course is added!';
        } else {
            $response['title']  = 'Error!';
            $response['status']  = 'error';
            $response['message'] = 'mysql error';
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
