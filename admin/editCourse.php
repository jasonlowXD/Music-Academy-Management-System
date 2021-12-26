<?php
$nameCrash = false;
session_start();
$response = array();
$userID = $_SESSION["userID"];
$course_id = $_GET["course_id"];
$courseName = $_POST['courseName'];
$courseFee = $_POST['courseFee'];
$courseDuration = $_POST['courseDuration'];
$courseDesc = htmlspecialchars($_POST['courseDesc']);
$courseStatus = $_POST['courseStatus'];

$conn = mysqli_connect("localhost", "root", "", "music_academy");

if ($conn) {

    $sql = "SELECT * FROM COURSE WHERE COURSE_ID = '$course_id' AND ADMIN_ID = '$userID'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $db_course_name = $row["COURSE_NAME"];
        $db_course_fee = $row["COURSE_FEE"];
        $db_course_duration = $row["COURSE_DURATION"];
        $db_course_desc = $row["COURSE_DESC"];
        $db_course_status = $row["COURSE_STATUS"];
    }

    // IF NOTHING CHANGE
    if ($courseName == $db_course_name && $courseFee == $db_course_fee && $courseDuration ==  $db_course_duration && $courseDesc ==  $db_course_desc && $courseStatus == $db_course_status) {
        $response['title']  = 'Nothing Changed!';
        $response['status']  = 'info';
        $response['message'] = 'All info are same!';
    }

    // IF GOT CHANGE, CHECK GOT CRASH COURSE NAME IN DATABASE OR NOT
    else {
        if ($courseName != $db_course_name) {
            // CHECK COURSE NAME IN COURSE TABLE 
            $sql2 = "SELECT COUNT(*) FROM COURSE WHERE ADMIN_ID = '$userID' AND COURSE_NAME =  '$courseName' ";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
                $course_count = $row2["COUNT(*)"];
            }

            // IF COURSE NAME CRASH IN DATABASE
            if ($course_count > 0) {
                $nameCrash = true;
            }
        }

        if ($nameCrash) {
            $response['title']  = 'Error course name';
            $response['status']  = 'error';
            $response['message'] = 'Course name is existed in database!';
        }

        // IF NO CRASH, UPDATE COURSE INFO
        else {
            $sql3 = "UPDATE COURSE SET COURSE_NAME ='$courseName', COURSE_FEE = '$courseFee', COURSE_DURATION = '$courseDuration', COURSE_DESC = '$courseDesc', COURSE_STATUS = '$courseStatus' WHERE COURSE_ID = '$course_id' AND ADMIN_ID = '$userID' ";

            if (mysqli_query($conn, $sql3)) {
                $response['title']  = 'Done!';
                $response['status']  = 'success';
                $response['message'] = 'Course edited!';
            } else {
                $response['title']  = 'Error!';
                $response['status']  = 'error';
                $response['message'] = 'mysql error';
            }
        }
    }
} else {
    die("FATAL ERROR");
}

$conn->close();
echo json_encode($response);
